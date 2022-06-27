<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\SubCategory;
use App\Models\User;
use App\Contracts\BlogContract;
use App\Contracts\DirectoryCategoryContract;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Auth;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BlogExport;
use DB;

class BlogController extends BaseController
{
    protected $BlogRepository;

    /**
     * BlogController constructor.
     * @param BlogRepository $BlogRepository
     */

    public function __construct(BlogContract $BlogRepository, DirectoryCategoryContract $directoryCategoryRepository)
    {
        $this->BlogRepository = $BlogRepository;
        $this->directoryCategoryRepository = $directoryCategoryRepository;
    }

    /**
     * List all the states
     */
    public function index(Request $request)
    {
        $data =  Blog::paginate(5);
        if (!empty($request->term)) {
            // dd($request->term);
            $blogs = $this->BlogRepository->getSearchBlog($request->term);

            // dd($categories);
        } else {
            $blogs = $this->BlogRepository->listBlogs();
        }
        $this->setPageTitle('Blog', 'List of all Blog');
        return view('admin.blog.index', compact('blogs', 'data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Blog', 'Create Blog');
        // $blogcat = $this->BlogRepository->getBlogcategories();
        $blogcat = $this->directoryCategoryRepository->listdirectoryCategories('title', 'asc');
        $blogsubcat = $this->BlogRepository->getBlogsubcategories();
        $suburb = $this->BlogRepository->getSuburb();
        $pin = $this->BlogRepository->getPincode();

        return view('admin.blog.create', compact('blogcat', 'blogsubcat', 'suburb', 'pin'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:1',
            'blog_category_id' => 'required|integer|min:1',
            'pincode' => 'required|integer|min:1',
            'suburb_id' => 'required|integer|min:1',
            'content' => 'required|string|min:1',
            'meta_title' => 'required|string',
            'meta_key' => 'required|string',
            'meta_description' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png|max:10000000',
            'banner_image' => 'required|mimes:jpg,jpeg,png|max:10000000',
            'image2' => 'required|mimes:jpg,jpeg,png|max:10000000',
        ]);

        $blog = $this->BlogRepository->createBlog($request->except('_token'));

        if (!$blog) {
            return $this->responseRedirectBack('Error occurred while creating Blog.', 'error', true, true);
        }
        return $this->responseRedirect('admin.blog.index', 'Blog has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetblog = $this->BlogRepository->findBlogById($id);
        $blogcat = $this->directoryCategoryRepository->listdirectoryCategories('title', 'asc');
        $blogsubcat = $this->BlogRepository->getBlogsubcategories();
        $suburb = $this->BlogRepository->getSuburb();
        $pin = $this->BlogRepository->getPincode();
        $this->setPageTitle('Blog', 'Edit Blog : ' . $targetblog->title);
        return view('admin.blog.edit', compact('targetblog', 'blogcat', 'blogsubcat', 'suburb', 'pin'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:1',
            'blog_category_id' => 'required|integer|min:1',
            'blog_sub_category_id' => 'required|integer|min:1',
            'pincode' => 'required|integer|min:1',
            'suburb_id' => 'required|integer|min:1',
            'content' => 'required|string|min:1',
            'meta_title' => 'required|string',
            'meta_key' => 'required|string',
            'meta_description' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png|max:10000000',
            'banner_image' => 'required|mimes:jpg,jpeg,png|max:10000000',
            'image2' => 'required|mimes:jpg,jpeg,png|max:10000000',
        ]);
        // $slug = Str::slug($request->name, '-');
        // $slugExistCount = Blog::where('slug', $slug)->count();
        // if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $params = $request->except('_token');

        $targetblog = $this->BlogRepository->updateBlog($params);

        if (!$targetblog) {
            return $this->responseRedirectBack('Error occurred while updating blog.', 'error', true, true);
        }
        return $this->responseRedirectBack('Blog has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $targetblog = $this->BlogRepository->deleteBlog($id);

        if (!$targetblog) {
            return $this->responseRedirectBack('Error occurred while deleting Blog.', 'error', true, true);
        }
        return $this->responseRedirect('admin.blog.index', 'Blog has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $targetblog = $this->BlogRepository->updateBlogStatus($params);

        if ($targetblog) {
            return response()->json(array('message' => 'Blog status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $targetblog = $this->BlogRepository->detailsBlog($id);
        $blog = $targetblog[0];

        $this->setPageTitle('Blog', 'Blog Details : ' . $blog->title);
        return view('admin.blog.details', compact('blog'));
    }


    public function csvStore(Request $request)
    {
        if (!empty($request->file)) {
            // if ($request->input('submit') != null ) {
            $file = $request->file('file');
            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");
            // 50MB in Bytes
            $maxFileSize = 50097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location = 'admin/uploads/csv';
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 10000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // Skip first row
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // echo '<pre>';print_r($importData_arr);exit();

                    // Insert into database



                    foreach ($importData_arr as $importData) {

                        $commaSeperatedCats = '';
                        foreach ($importData as $cateKey => $catVal) {
                            $catExistCheck = BlogCategory::where('title', $catVal)->first();
                            if ($catExistCheck) {
                                $insertDirCatId = $catExistCheck->id;
                                $commaSeperatedCats .= $insertDirCatId . ',';
                            } else {
                                $dirCat = new BlogCategory();
                                $dirCat->title = $catVal;
                                $dirCat->slug = null;
                                $dirCat->save();
                                $insertDirCatId = $dirCat->id;

                                $commaSeperatedCats .= $insertDirCatId . ',';
                            }
                        }

                        $commaSeperatedSubCats = '';
                        foreach ($importData as $cateKey => $catVal) {
                            $catExistCheck = SubCategory::where('title', $catVal)->first();
                            if ($catExistCheck) {
                                $insertDirCatId = $catExistCheck->id;
                                $commaSeperatedCats .= $insertDirCatId . ',';
                            } else {
                                $dirCat = new SubCategory();
                                $dirCat->title = $catVal;
                                $dirCat->slug = null;
                                $dirCat->save();
                                $insertDirCatId = $dirCat->id;

                                $commaSeperatedCats .= $insertDirCatId . ',';
                            }
                        }

                        if (!empty($importData[0])) {
                            // dd($importData[0]);
                            $titleArr = explode(',', $importData[0]);

                            // echo '<pre>';print_r($titleArr);exit();

                            foreach ($titleArr as $titleKey => $titleValue) {
                                // slug generate
                                $slug = Str::slug($titleValue, '-');
                                $slugExistCount = DB::table('blogs')->where('title', $titleValue)->count();
                                if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);

                                $insertData = array(
                                    "title" => $titleValue,

                                    "content" => isset($importData[1]) ? $importData[1] : null,
                                    "meta_title" => isset($importData[2]) ? $importData[2] : null,
                                    "meta_key" => isset($importData[3]) ? $importData[3] : null,
                                    "blog_category_id" => isset($commaSeperatedCats) ? $commaSeperatedCats : null,
                                    "blog_sub_category_id" => isset($commaSeperatedSubCats) ? $commaSeperatedSubCats : null,
                                    "slug" => $slug,


                                    "meta_description" => isset($importData[8]) ? $importData[8] : null,

                                );

                                Blog::insertData($insertData);
                            }
                        }
                    }
                    Session::flash('message', 'Import Successful.');
                } else {
                    Session::flash('message', 'File too large. File must be less than 50MB.');
                }
            } else {
                Session::flash('message', 'Invalid File Extension. supported extensions are ' . implode(', ', $valid_extension));
            }
        } else {
            Session::flash('message', 'No file found.');
        }
        return redirect()->route('admin.blog.index');
    }
    // csv upload

    public function export()
    {
        return Excel::download(new BlogExport, 'blog.xlsx');
    }
}
