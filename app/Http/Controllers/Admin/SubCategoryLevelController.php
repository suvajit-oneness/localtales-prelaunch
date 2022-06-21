<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\User;
use App\Contracts\SubCategoryLevelContract;
use App\Http\Controllers\BaseController;
use App\Models\SubCategoryLevel;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Auth;
use Session;

class SubCategoryLevelController extends BaseController
{
    protected $SubCategoryLevelRepository;

    /**
     * SubCategoryLevelController constructor.
     * @param SubCategoryLevelRepository $SubCategoryLevelRepository
     */

    public function __construct(SubCategoryLevelContract $SubCategoryLevelRepository)
    {
        $this->SubCategoryLevelRepository = $SubCategoryLevelRepository;
    }

    /**
     * List all the states
     */
    public function index(Request $request)
    {
        $data =  SubCategoryLevel::paginate(5);
        if (!empty($request->term)) {
            // dd($request->term);
             $subcatlevel = $this->SubCategoryLevelRepository->getSearchSubcategorylevel($request->term);

            // dd($categories);
         } else {
        $subcatlevel = $this->SubCategoryLevelRepository->listSubCategoryLevel();
         }
        $subcat = $this->SubCategoryLevelRepository->getSubCategory();
        $this->setPageTitle('Sub Category Level 2', 'List of all Sub Category Level 2');
        return view('admin.subcategorylevel.index', compact('subcatlevel','subcat','data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        $this->setPageTitle('Sub Category Level 2', 'Create Sub Category Level 2');
        $subcat = $this->SubCategoryLevelRepository->getSubCategory();
        return view('admin.subcategorylevel.create',compact('subcat'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',
            "sub_category_id" => "required|integer",
        ]);
        $slug = Str::slug($request->name, '-');
        $slugExistCount = State::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);

        // send slug
        request()->merge(['slug' => $slug]);

        $params = $request->except('_token');

        $state = $this->SubCategoryLevelRepository->createSubCategoryLevel($params);

        if (!$state) {
            return $this->responseRedirectBack('Error occurred while creating Sub Category Level 2.', 'error', true, true);
        }
        return $this->responseRedirect('admin.sub-category-level2.index', 'Sub Category Level 2 has been created successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetsubcat = $this->SubCategoryLevelRepository->findSubCategoryLevelById($id);
        $subcat = $this->SubCategoryLevelRepository->getSubCategory();
        $this->setPageTitle('Sub Category Level 2', 'Edit Sub Category Level 2 : '.$targetsubcat->title);
        return view('admin.subcategorylevel.edit', compact('targetsubcat','subcat'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',
            "sub_category_id" => "required|integer",
        ]);
        $slug = Str::slug($request->name, '-');
        $slugExistCount = State::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $params = $request->except('_token');

        $targetstate = $this->SubCategoryLevelRepository->updateSubCategoryLevel($params);

        if (!$targetstate) {
            return $this->responseRedirectBack('Error occurred while updating Sub Category Level 2.', 'error', true, true);
        }
        return $this->responseRedirectBack('Sub Category Level 2 has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $targetstate = $this->SubCategoryLevelRepository->deleteSubCategoryLevel($id);

        if (!$targetstate) {
            return $this->responseRedirectBack('Error occurred while deleting Sub Category Level 2.', 'error', true, true);
        }
        return $this->responseRedirect('admin.sub-category-level2.index', 'Sub Category Level 2 has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $targetstate = $this->SubCategoryLevelRepository->updateSubCategoryLevelStatus($params);

        if ($targetstate) {
            return response()->json(array('message'=>'Sub Category Level 2 status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $targetsubcat = $this->SubCategoryLevelRepository->detailsSubCategoryLevel($id);
        $subcat = $targetsubcat[0];

        $this->setPageTitle('Sub Category Level 2', 'Sub Category Level 2 Details : '.$subcat->title);
        return view('admin.subcategorylevel.details', compact('subcat'));
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
                        $storeData = 0;
                        if(isset($importData[5]) == "Carry In") $storeData = 1;

                        $insertData = array(
                            "title" => isset($importData[0]) ? $importData[0] : null,
                            "slug" => isset($importData[1]) ? $importData[1] : null,
                            "sub_category_id" => isset($importData[2]) ? $importData[2] : null,

                        );
                        // echo '<pre>';print_r($insertData);exit();
                        SubCategoryLevel::insertData($insertData);
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
        return redirect()->route('admin.sub-category-level2.index');
    }
    // csv upload
}
