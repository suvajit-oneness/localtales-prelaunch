<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\DirectoryCategoryContract;
use Illuminate\Http\Request;
use App\Models\DirectoryCategory;
use App\Models\ActivityLogCsv;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Session;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DirectoryCategoryExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session as FacadesSession;

class DirectoryCategoryController extends BaseController
{
    protected $DirectoryCategoryRepository;

    public function __construct(DirectoryCategoryContract $DirectoryCategoryRepository)
    {
        $this->DirectoryCategoryRepository = $DirectoryCategoryRepository;
    }

    public function index(Request $request)
    {
        $this->setPageTitle('Category', 'List of all categories');

        if (!empty($request->term)) {
            $categories = DirectoryCategory::where('type', 1)->where('parent_category', 'like', '%'.$request->term.'%')->latest('id')->paginate(25);
        } else {
            $categories = DirectoryCategory::where('type', 1)->latest('id')->paginate(25);
        }

        return view('admin.dircategory.index', compact('categories'));

        /* if (!empty($request->term)) {

            $categories = $this->DirectoryCategoryRepository->getSearchCategory($request->term);
        } else {
            $categories = DirectoryCategory::paginate(5);
        }
        $data =  DirectoryCategory::paginate(5);
        $this->setPageTitle('Category', 'List of all categories');
        return view('admin.dircategory.index', compact('categories', 'data')); */
    }

    public function create()
    {
        $this->setPageTitle('Category', 'Create category');
        return view('admin.dircategory.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'title' => 'required|string|min:1|max:255',
            'image' => 'required|mimes:jpg,jpeg,png,bmp,svg,gif',
            'description' => 'required|string|min:1',
            'short_content' => 'nullable|string|min:1',
            'medium_content' => 'nullable|string|min:1',
            'long_content' => 'nullable|string|min:1',
        ]);

        $category = new DirectoryCategory;
        $category->type = 1;
        $category->parent_category = !empty($request->title) ? $request->title : '';

        // generate slug
        $slug = Str::slug($request->title, '-');
        $slugExistCount = DirectoryCategory::where('parent_category_slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $category->parent_category_slug = $slug;

        // image
        if (!empty($request->image)) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = mt_rand().'_'.time().".".$ext;
            $image->move("categories/",$imageName);
            $category->parent_category_image = $imageName;
        }

        $category->description = !empty($request->description) ? $request->description : '';
        $category->short_content = !empty($request->short_content) ? $request->short_content : '';
        $category->medium_content = !empty($request->medium_content) ? $request->medium_content : '';
        $category->long_content = !empty($request->long_content) ? $request->long_content : '';
        $category->save();

        return $this->responseRedirect('admin.dircategory.index', 'Primary Category created successfully', 'success', false, false);

        // dd($category);

        // if (!$category) {
        //     return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
        // }

        // return $this->responseRedirect('admin.dircategory.index', 'Primary Category created successfully', 'success', false, false);






        /*
        $category->title = $collection['title'];
        $category->description = $collection['description'];
        $category->short_content = $collection['short_content'];
        $category->medium_content = $collection['medium_content'];
        $category->long_content = $collection['long_content'];
        $slug = Str::slug($collection['title'], '-');
        $slugExistCount = BlogCategory::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $category->slug = $slug;
        if(!empty($params['image'])){
        $profile_image = $collection['image'];
    // $imageName = time().".".$profile_image->getClientOriginalName();
            $ext= $profile_image->getClientOriginalExtension();
        $imageName = mt_rand().'_'.time().".".$ext;
        $profile_image->move("categories/",$imageName);
        $uploadedImage = $imageName;
        $category->image = $uploadedImage;
        }
        if(!empty($params['medium_content_image'])){
            foreach (($params['medium_content_image']) as $imagefile) {
            //$profile_image = $collection['medium_content_image'];
            $imageName = time().".".$imagefile->getClientOriginalName();
            $imagefile->move("categories/",$imageName);
            $uploadedImage = $imageName;
            $category->medium_content_image = $uploadedImage;
            }
        }
        if(!empty($params['long_content_image'])){
            foreach (($params['long_content_image']) as $imagefile) {
            // $profile_image = $collection['long_content_image'];
            $imageName = time().".".$imagefile->getClientOriginalName();
            $imagefile->move("categories/",$imageName);
            $uploadedImage = $imageName;
            $category->long_content_image = $uploadedImage;
            }

        }
        $category->save();
        */



        /*
        $slug = Str::slug($request->name, '-');
        $slugExistCount = DirectoryCategory::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);

        // send slug
        request()->merge(['slug' => $slug]);
        $params = $request->except('_token');

        if ($request->image) {
            $params['image'] = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/admin/uploads/directorycategory/images/', $params['image']);
        }

        $category = $this->DirectoryCategoryRepository->createdirectoryCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.dircategory.index', 'Primary Category created successfully', 'success', false, false);
        */
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        // $targetCategory = $this->DirectoryCategoryRepository->finddirectoryCategoryById($id);
        $category = DirectoryCategory::findOrFail($id);
        $this->setPageTitle('DirectoryCategory', 'Edit Category : ' . $category->parent_category);
        return view('admin.dircategory.edit', compact('category'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|min:1|max:255',
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp,svg,gif',
            'description' => 'required|string|min:1',
            'short_content' => 'nullable|string|min:1',
            'medium_content' => 'nullable|string|min:1',
            'long_content' => 'nullable|string|min:1',
        ]);

        $category = DirectoryCategory::findOrFail($request->id);
        $category->type = 1;
        $category->parent_category = !empty($request->title) ? $request->title : '';

        // generate slug
        /* if ($category->title != $request->title) {
            $slug = Str::slug($request->title, '-');
            $slugExistCount = DirectoryCategory::where('parent_category_slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $category->parent_category_slug = $slug;
        } */

        // image
        if (!empty($request->image)) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = mt_rand().'_'.time().".".$ext;
            $image->move("categories/",$imageName);
            $category->parent_category_image = $imageName;
        }

        $category->description = !empty($request->description) ? $request->description : '';
        $category->short_content = !empty($request->short_content) ? $request->short_content : '';
        $category->medium_content = !empty($request->medium_content) ? $request->medium_content : '';
        $category->long_content = !empty($request->long_content) ? $request->long_content : '';
        $category->save();

        return $this->responseRedirect('admin.dircategory.index', 'Primary Category edited successfully', 'success', false, false);

        /* 
        $this->validate($request, [
            'title'      =>  'required|string|min:1',

        ]);
        $slug = Str::slug($request->title, '-');
        $slugExistCount = DirectoryCategory::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);
        $params = $request->except('_token');

        if ($request->image) {
            $params['image'] = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/admin/uploads/directorycategory/images/', $params['image']);
        }

        $category = $this->DirectoryCategoryRepository->updatedirectoryCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while updating category.', 'error', true, true);
        }
        return $this->responseRedirectBack('Category has been updated successfully', 'success', false, false);
        */
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
        return $this->responseRedirect('admin.dircategory.index', 'Category has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $category = $this->DirectoryCategoryRepository->updatedirectoryCatStatus($params);

        if ($category) {
            return response()->json(array('message' => 'Category status has been successfully updated'));
        }
    }

    public function details($id)
    {
        $category = DirectoryCategory::findOrFail($id);
        $this->setPageTitle('Category Details: ' . $category->parent_category, 'Category Details : ' . $category->parent_category);

        return view('admin.dircategory.details', compact('category'));

        /* $categories = $this->DirectoryCategoryRepository->detailsdirectoryCategory($id);
        $category = $categories[0];

        $this->setPageTitle('DirectoryCategory', 'Category Details : ' . $category->title);
        return view('admin.dircategory.details', compact('category')); */
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
                        $count = $total= 0;
                        $successArr = $failureArr =[];
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
                                if ($slugExistCount > 0) $slug = $slug . '-' . ($slugExistCount + 1);

                                $insertData = array(
                                    "title" => $titleValue,
                                    "slug" => $slug,
                                    "image" => isset($importData[1]) ? $importData[1] : null,
                                );

                                $resp =DirectoryCategory::insertData($insertData,$count,$successArr,$failureArr);
                                $count = $resp['count'];
                                $successArr = $resp['successArr'];
                                $failureArr = $resp['failureArr'];
                                $total++;
                            }
                        }

                        
                    }
                   // Session::flash('message', 'Import Successful.');
                       $store = new ActivityLogCsv;
                        $store->user_id =  Auth::guard('admin')->user()->id;
                        $store->csv_file_location = $location . "/" . $filename;
                        $store->total_rows = $total;
                        $store->success_count = $count;
                        $store->success_array = (count($resp['successArr']) > 0) ? json_encode($resp['successArr']) : '';
                        $store->failure_count = $total - $count;
                        $store->failure_array = (count($resp['failureArr']) > 0) ? json_encode($resp['failureArr']) : '';
                        $store->csv_type = 'directory category';
                        $store->save();
                   if($count==0){
                            FacadesSession::flash('csv', 'Already Uploaded. ');
                        }
                        else{
                             FacadesSession::flash('csv', 'Import Successful. '.$count.' Data Uploaded');
                        }
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

    public function upload_bulk_images(Request $request)
    {
        foreach ($request->image as $image) {
            $name = $image->getClientOriginalName();
            $image->move(public_path() . '/admin/uploads/directorycategory/images/', $name);
        }
        File::flash('image_uploaded', 'All images imported Successfully.');
        return redirect()->back();
    }
}
