<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\DirectoryCategoryContract;
use Illuminate\Http\Request;
use App\Models\DirectoryCategory;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DirectoryCategoryExport;
use Illuminate\Support\Facades\DB;

class DirectoryCategoryController extends BaseController
{
    /**
     * @var DirectoryCategoryContract
     */
    protected $DirectoryCategoryRepository;


    /**
     * PageController constructor.
     * @param DirectoryCategoryContract $categoryRepository
     */
    public function __construct(DirectoryCategoryContract $DirectoryCategoryRepository)
    {
        $this->DirectoryCategoryRepository = $DirectoryCategoryRepository;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        $data =  DirectoryCategory::paginate(5);
        if (!empty($request->term)) {
            // dd($request->term);
             $categories = $this->DirectoryCategoryRepository->getSearchCategory($request->term);

            // dd($categories);
         } else {
        $categories = $this->DirectoryCategoryRepository->listdirectoryCategories();
         }
        $this->setPageTitle('Category', 'List of all categories');
        return view('admin.dircategory.index', compact('categories','data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Category', 'Create category');
        return view('admin.dircategory.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|string|min:1',

        ]);
        $slug = Str::slug($request->name, '-');
        $slugExistCount = DirectoryCategory::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);

        // send slug
        request()->merge(['slug' => $slug]);
        $params = $request->except('_token');

        $category = $this->DirectoryCategoryRepository->createdirectoryCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.dircategory.index', 'Category has been created successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetCategory = $this->DirectoryCategoryRepository->finddirectoryCategoryById($id);

        $this->setPageTitle('DirectoryCategory', 'Edit Category : '.$targetCategory->title);
        return view('admin.dircategory.edit', compact('targetCategory'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|string|min:1',

        ]);
        $slug = Str::slug($request->title, '-');
        $slugExistCount = DirectoryCategory::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $params = $request->except('_token');

        $category = $this->DirectoryCategoryRepository->updatedirectoryCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while updating category.', 'error', true, true);
        }
        return $this->responseRedirectBack('Category has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $category = $this->DirectoryCategoryRepository->deletedirectoryCategory($id);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while deleting category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.dircategory.index', 'Category has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $category = $this->DirectoryCategoryRepository->updatedirectoryCatStatus($params);

        if ($category) {
            return response()->json(array('message'=>'Category status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $categories = $this->DirectoryCategoryRepository->detailsdirectoryCategory($id);
        $category = $categories[0];

        $this->setPageTitle('DirectoryCategory', 'Category Details : '.$category->title);
        return view('admin.dircategory.details', compact('category'));
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

                    // Insert into database
                    foreach ($importData_arr as $importData) {
                        if (!empty($importData[0])) {
                            // dd($importData[0]);
                            $titleArr = explode(',', $importData[0]);

                            // echo '<pre>';print_r($titleArr);exit();

                            foreach ($titleArr as $titleKey => $titleValue) {
                                // slug generate
                                $slug = Str::slug($titleValue, '-');
                                $slugExistCount = DB::table('directory_categories')->where('title', $titleValue)->count();
                                if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);

                                $insertData = array(
                                    "title" => $titleValue,
                                    "slug" => $slug
                                );

                                DirectoryCategory::insertData($insertData);
                            }
                        }

                        // dd($insertData);

                        // $insertData = array(
                        //     "title" => isset($importData[0]) ? $importData[0] : null,
                        //     "slug" => $slug
                        // );

                        // DirectoryCategory::insertData($insertData);
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
        return redirect()->route('admin.dircategory.index');
    }
    // csv upload
  public function export()
    {
        return Excel::download(new DirectoryCategoryExport, 'directorycat.xlsx');
    }

}
