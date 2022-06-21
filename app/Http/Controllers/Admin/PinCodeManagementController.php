<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\PincodeContract;
use App\Models\PinCode;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PinCodeExport;
use App\Http\Controllers\BaseController;
class PinCodeManagementController extends BaseController
{
    protected $PincodeRepository;

    /**
     * StateManagementController constructor.
     * @param PincodeRepository $StateRepository
     */

    public function __construct(PincodeContract $PincodeRepository)
    {
        $this->PincodeRepository = $PincodeRepository;
    }

    /**
     * List all the states
     */
    public function index(Request $request)
    {
        $data =  PinCode::paginate(5);
        if (!empty($request->term)) {
            // dd($request->term);
             $pin = $this->PincodeRepository->getSearchpin($request->term);

            // dd($categories);
         } else {
        $pin = $this->PincodeRepository->listPincode();
         }
        $this->setPageTitle('PinCode', 'List of all state');
        $states = $this->PincodeRepository->getAllState();
        return view('admin.pin.index', compact('pin','states','data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('PinCode', 'Create Pincode');
        $states = $this->PincodeRepository->getAllState();
        return view('admin.pin.create',compact('states'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pin'      =>  'required|max:191',
            "state_id" => "required|integer",
        ]);


        $params = $request->except('_token');

        $state = $this->PincodeRepository->createPincode($params);

        if (!$state) {
            return $this->responseRedirectBack('Error occurred while creating state.', 'error', true, true);
        }
        return $this->responseRedirect('admin.pin.index', 'State has been created successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetpin = $this->PincodeRepository->findPincodeById($id);

        $this->setPageTitle('PinCode', 'Edit Pincode : '.$targetpin->pin);
        $states = $this->PincodeRepository->getAllState();
        return view('admin.pin.edit', compact('targetpin','states'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'pin'      =>  'required|max:191',
            "state_id" => "required|integer",
        ]);

        $params = $request->except('_token');

        $targetpin = $this->PincodeRepository->updatePincode($params);

        if (!$targetpin) {
            return $this->responseRedirectBack('Error occurred while updating Pincode.', 'error', true, true);
        }
        return $this->responseRedirectBack('Pincode has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $targetpin = $this->PincodeRepository->deletePincode($id);

        if (!$targetpin) {
            return $this->responseRedirectBack('Error occurred while deleting Pincode.', 'error', true, true);
        }
        return $this->responseRedirect('admin.pin.index', 'Pincode has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $targetpin = $this->PincodeRepository->updatePincodeStatus($params);

        if ($targetpin) {
            return response()->json(array('message'=>'Pincode status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $targetpin= $this->PincodeRepository->detailsPincode($id);
        $pin = $targetpin[0];

        $this->setPageTitle('PinCode', 'Pincode Details : '.$pin->pin);
        return view('admin.pin.details', compact('pin'));
    }



    public function csvStore(Request $request)
    {
        // dd($request->all());

        try {
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
                        $location = 'admin/uploads/pincode/csv';
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
                            // dd($num);
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

                        $insertData = [];
                        // Insert into database
                        foreach ($importData_arr as $importData) {
                            // $storeData = 0;
                            // if(isset($importData[2]) == "Carry In") $storeData = 1;

                            $insertData = array(
                                "pin" => isset($importData[0]) ? $importData[0] : null,
                                "description" => isset($importData[1]) ? $importData[1] : null,
                            );
                            // echo '<pre>';print_r($insertData);exit();
                            PinCode::insertData($insertData);
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
    
            return redirect()->route('admin.pin.index');
        } catch (\Exception $th) {
            return $th;
        }
    }
    
    
    
     public function export()
    {
        return Excel::download(new PinCodeExport, 'pincode.xlsx');
    }
    // csv upload
}
