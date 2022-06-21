<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Suburb;
use App\Models\User;
use App\Contracts\SuburbContract;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Auth;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuburbExport;

class SuburbManagementController extends BaseController
{
    protected $SuburbRepository;

    /**
     * StateManagementController constructor.
     * @param SuburbRepository $SuburbRepository
     */

    public function __construct(SuburbContract $SuburbRepository)
    {
        $this->SuburbRepository = $SuburbRepository;
    }

    /**
     * List all the states
     */
    public function index(Request $request)
    {
        $data =  Suburb::paginate(5);
        if (!empty($request->term)) {
            // dd($request->term);
             $suburb = $this->SuburbRepository->getSearchSuburb($request->term);

            // dd($categories);
         } else {
        $suburb = $this->SuburbRepository->listSuburb();
         }
        $this->setPageTitle('Suburb', 'List of all suburb');
        return view('admin.suburb.index', compact('suburb','data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Suburb', 'Create suburb');
        $pin = $this->SuburbRepository->getAllpincode();
        return view('admin.suburb.create',compact('pin'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',

        ]);
        $slug = Str::slug($request->name, '-');
        $slugExistCount = Suburb::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);

        // send slug
        request()->merge(['slug' => $slug]);

        $params = $request->except('_token');

        $suburb = $this->SuburbRepository->createSuburb($params);

        if (!$suburb) {
            return $this->responseRedirectBack('Error occurred while creating state.', 'error', true, true);
        }
        return $this->responseRedirect('admin.suburb.index', 'Suburb has been created successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $suburb = $this->SuburbRepository->findSuburbById($id);

        $this->setPageTitle('Suburb', 'Edit Suburb : '.$suburb->title);
        $pin = $this->SuburbRepository->getAllpincode();
        return view('admin.suburb.edit', compact('suburb','pin'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',

        ]);
        $slug = Str::slug($request->name, '-');
        $slugExistCount = Suburb::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $params = $request->except('_token');

        $targetstate = $this->SuburbRepository->updateSuburb($params);

        if (!$targetstate) {
            return $this->responseRedirectBack('Error occurred while updating state.', 'error', true, true);
        }
        return $this->responseRedirectBack('State has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $targetstate = $this->SuburbRepository->deleteSuburb($id);

        if (!$targetstate) {
            return $this->responseRedirectBack('Error occurred while deleting State.', 'error', true, true);
        }
        return $this->responseRedirect('admin.suburb.index', 'State has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $targetstate = $this->SuburbRepository->updateSuburbStatus($params);

        if ($targetstate) {
            return response()->json(array('message'=>'State status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $targetsuburb= $this->SuburbRepository->detailsSuburb($id);
        $suburb = $targetsuburb[0];

        $this->setPageTitle('Suburb', 'Suburb Details : '.$suburb->name);
        return view('admin.suburb.details', compact('suburb'));
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
                            "name" => isset($importData[0]) ? $importData[0] : null,
                          
                            "pin_code" => isset($importData[1]) ? $importData[1] : null,
                              "description" => isset($importData[2]) ? $importData[2] : null,

                        );
                        // echo '<pre>';print_r($insertData);exit();
                        Suburb::insertData($insertData);
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

        return redirect()->route('admin.suburb.index');
    }
    // csv upload
    
    
    
     public function export()
    {
        return Excel::download(new SuburbExport, 'suburb.xlsx');
    }
}
