<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Directory;
use App\Models\User;
use App\Contracts\DirectoryContract;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Auth;
use Session;
use Symfony\Component\Console\Input\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DirectoryExport;
use App\Models\DirectoryCategory;
use GuzzleHttp\Client;

class DirectoryController extends BaseController
{
    protected $DirectoryRepository;

    /**
     * StateManagementController constructor.
     * @param StateRepository $DirectoryRepository
     */

    public function __construct(DirectoryContract $DirectoryRepository)
    {
        $this->DirectoryRepository = $DirectoryRepository;
    }

    /**
     * List all the states
     */
    public function index(Request $request)
    {

        $data = Directory::paginate(5);
        //dd($request->all);
        if (!empty($request->term)) {
            // dd($request->term);
            $directory = $this->DirectoryRepository->getSearchDirectory($request->term);

            //dd($data);
        } else {
            // $directory = $this->DirectoryRepository->listDirectory();

            $directory = Directory::paginate(5);
        }

        //$data = $this->DirectoryRepository->search($params);
        // $dummyDetails = User::paginate(25);
        //return view ( ‘welcome’ )->withUsers($dummyDetails);
        $this->setPageTitle('Directory', 'List of all Directory');
        return view('admin.directory.index', compact('directory', 'data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Directory', 'Create Directory');
        $dircategory = $this->DirectoryRepository->getDirectorycategories();
        return view('admin.directory.create', compact('dircategory'));
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
            'email'      =>  'required|max:191',
            'password'      =>  'required|max:191',
            'address'      =>  'required|max:191',
            'lat'      =>  'required|max:191',
            'lon'      =>  'required|max:191',
            'mobile'      =>  'required|max:191',
            'pin'      =>  'required|max:191',
            'description'      =>  'required|max:191',
            'service_description'      =>  'required|max:191',
            'opening_hour'      =>  'required|max:191',
            'website'      =>  'required|max:191',
            'facebook_link'      =>  'required|max:191',
            'twitter_link'      =>  'required|max:191',
            'instagram_link'      =>  'required|max:191',
            'establish_year'      =>  'required|max:191',
            'ABN'      =>  'required|max:191',
            'monday'      =>  'required|max:191',
            'tuesday'      =>  'required|max:191',
            'wednesday'      =>  'required|max:191',
            'thursday'      =>  'required|max:191',
            'friday'      =>  'required|max:191',
            'saturday'      =>  'required|max:191',
            'sunday'      =>  'required|max:191',
            'public_holiday'      =>  'required|max:191',
            'category_tree'      =>  'required|max:191',
            'image'     =>  'required|mimes:jpg,jpeg,png|max:1000',

        ]);


        $params = $request->except('_token');

        $state = $this->DirectoryRepository->createDirectory($params);

        if (!$state) {
            return $this->responseRedirectBack('Error occurred while creating Directory.', 'error', true, true);
        }
        return $this->responseRedirect('admin.directory.index', 'Directory has been created successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetdirectory = $this->DirectoryRepository->findDirectoryById($id);
        $directory = $this->DirectoryRepository->getDirectorycategories();
        $this->setPageTitle('Directory', 'Edit Directory : ' . $targetdirectory->name);
        return view('admin.directory.edit', compact('targetdirectory', 'directory'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name'      =>  'nullable|string|min:1',
            'email'      => 'nullable|string|min:1',
            'password'      =>  'nullable|string|min:1',
            'address'      => 'nullable|string|min:1',
            'lat'      =>  'nullable|string|min:1',
            'lon'      =>  'nullable|string|min:1',
            'mobile'      =>  'nullable|string|min:1',
            'pin'      =>  'nullable|string|min:1',
            'description'      => 'nullable|string|min:1',
            'service_description'      =>  'nullable|string|min:1',
            'opening_hour'      =>  'nullable|string|min:1',
            'website'      =>  'nullable|string|min:1',
            'facebook_link'      => 'nullable|string|min:1',
            'twitter_link'      =>  'nullable|string|min:1',
            'instagram_link'      => 'nullable|string|min:1',
            'establish_year'      => 'nullable|string|min:1',
            'ABN'      => 'nullable|string|min:1',
            'monday'      =>  'nullable|string|min:1',
            'tuesday'      =>  'nullable|string|min:1',
            'wednesday'      => 'nullable|string|min:1',
            'thursday'      =>  'nullable|string|min:1',
            'friday'      => 'nullable|string|min:1',
            'saturday'      =>  'nullable|string|min:1',
            'sunday'      =>  'nullable|string|min:1',
            'public_holiday'      => 'nullable|string|min:1',
            'category_tree'      =>  'nullable|string|min:1',
            'category_id'      =>  'nullable|integer',
            'image'     =>  'required|mimes:jpg,jpeg,png|max:50000',

        ]);

        $params = $request->except('_token');

        $targetstate = $this->DirectoryRepository->updateDirectory($params);

        if (!$targetstate) {
            return $this->responseRedirectBack('Error occurred while updating Directory.', 'error', true, true);
        }
        return $this->responseRedirectBack('Directory has been updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $targetdirectory = $this->DirectoryRepository->deleteDirectory($id);

        if (!$targetdirectory) {
            return $this->responseRedirectBack('Error occurred while deleting State.', 'error', true, true);
        }
        return $this->responseRedirect('admin.directory.index', 'Directory has been deleted successfully', 'success', false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {

        $params = $request->except('_token');

        $targetdirectory = $this->DirectoryRepository->updateDirectoryStatus($params);

        if ($targetdirectory) {
            return response()->json(array('message' => 'Directory status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $targetdirectory = $this->DirectoryRepository->detailsDirectory($id);
        $directory = $targetdirectory[0];

        $this->setPageTitle('Directory', 'Directory Details : ' . $directory->name);
        return view('admin.directory.details', compact('directory'));
    }

    public function search(Request $request)
    {
        $q = Input::get('q');
        if ($q != "") {
            $user = Directory::where('name', 'LIKE', '%' . $q . '%')->orWhere('email', 'LIKE', '%' . $q . '%')->paginate(5)->setPath('');
            $pagination = $user->appends(array(
                'q' => Input::get('q')
            ));
            if (count($user) > 0)
                return view('admin.directory.index')->withDetails($user)->withQuery($q);
        }
        return view('admin.directory.index')->withMessage('No Details found. Try to search again !');
        // return view('admin.directory.index', compact('data', 'request'));
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
                        // $storeData = 0;
                        // if(isset($importData[5]) == "Carry In") $storeData = 1;

                        // ALTER TABLE `directories` CHANGE `category_id` `category_id` VARCHAR(255) NULL DEFAULT NULL;
                        // make all fields null

                        $commaSeperatedCats = '';
                        foreach (explode(',', $importData[15]) as $cateKey => $catVal) {
                            $catExistCheck = DirectoryCategory::where('title', $catVal)->first();
                            if ($catExistCheck) {
                                $insertDirCatId = $catExistCheck->id;
                                $commaSeperatedCats .= $insertDirCatId . ',';
                            } else {
                                $dirCat = new DirectoryCategory();
                                $dirCat->title = $catVal;
                                $dirCat->slug = null;
                                $dirCat->save();
                                $insertDirCatId = $dirCat->id;

                                $commaSeperatedCats .= $insertDirCatId . ',';
                            }
                        }
                        // dd($commaSeperatedCats);

                        $insertData = array(
                            "name" => isset($importData[0]) ? $importData[0] : null,
                            "address" => isset($importData[1]) ? $importData[1] : null,
                            "mobile" => isset($importData[2]) ? $importData[2] : null,
                            "website" => isset($importData[3]) ? $importData[3] : null,
                            "email" => isset($importData[4]) ? $importData[4] : null,
                            "establish_year" => isset($importData[5]) ? $importData[5] : null,
                            "ABN" => isset($importData[6]) ? $importData[6] : null,
                            "monday" => isset($importData[7]) ? $importData[7] : null,
                            "tuesday" => isset($importData[8]) ? $importData[8] : null,
                            "wednesday" => isset($importData[9]) ? $importData[9] : null,
                            "thursday" => isset($importData[10]) ? $importData[10] : null,
                            "friday" => isset($importData[11]) ? $importData[11] : null,

                            "saturday" => isset($importData[12]) ? $importData[12] : null,
                            "sunday" => isset($importData[13]) ? $importData[13] : null,
                            "public_holiday" => isset($importData[14]) ? $importData[14] : null,
                            "category_id" => isset($commaSeperatedCats) ? $commaSeperatedCats : null,
                            "category_tree" => isset($importData[16]) ? $importData[16] : null,
                            "url" => isset($importData[17]) ? $importData[17] : null,

                            // "password" => isset($importData[2]) ? $importData[2] : null,
                            // "mobile" => isset($importData[3]) ? $importData[3] : null,
                            // "address" => isset($importData[4]) ? $importData[4] : null,
                            // "pin" => isset($importData[5]) ? $importData[5] : null,
                            // "lat" => isset($importData[6]) ? $importData[6] : null,
                            // "lon" => isset($importData[7]) ? $importData[7] : null,
                            // "description" => isset($importData[8]) ? $importData[8] : null,
                            // "service_description" => isset($importData[9]) ? $importData[9] : null,
                            //"opening_hour" => isset($importData[10]) ? $importData[10] : null,

                            // "facebook_link" => isset($importData[12]) ? $importData[12] : null,

                            // "twitter_link" => isset($importData[13]) ? $importData[13] : null,
                            // "instagram_link" => isset($importData[14]) ? $importData[14] : null,




                            // "status" => isset($importData[27]) ? $importData[27] : null,
                        );
                        // echo '<pre>';print_r($insertData);exit();
                        Directory::insertData($insertData);
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
        return redirect()->route('admin.directory.index');
    }

    public function export()
    {
        return Excel::download(new DirectoryExport, 'directory.xlsx');
    }
    // csv upload

    public function dataFix(Request $request)
    {
        $data = Directory::paginate(5);
        $directory = Directory::paginate(5);
        $this->setPageTitle('Fix Directories with Rating, Reviews, Images etc', 'List of all Directory');
        return view('admin.directory.fix', compact('directory', 'data'));
    }

    public function test(Request $request)
    {
        $query = $request->get('query');
        $key = $request->get('key');
        $c = new Client();
        $res = $c->get("https://maps.googleapis.com/maps/api/place/textsearch/json", ['query' => ['query' => $query, 'key' => $key]]);
        return $res->getBody();
    }
}
