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
use App\MOdels\Review;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\DB;

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
                        $count = $total = 0;
                        $successArr = $failureArr = [];
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
                        $resp =Directory::insertData($insertData, $count,$successArr,$failureArr);
                         $count = $resp['count'];
                        $successArr = $resp['successArr'];
                        $failureArr = $resp['failureArr'];
                        $total++;
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
                        $store->csv_type = 'directory';
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
        return redirect()->route('admin.directory.index');
    }

    public function export()
    {
        return Excel::download(new DirectoryExport, 'directory.xlsx');
    }
    // csv upload

    public function dataFix(Request $request)
    {
        $data = Directory::paginate(50);
        $directory = Directory::paginate(50);
        $this->setPageTitle('Fix Directories with Rating, Reviews, Images etc', 'List of all Directory');
        return view('admin.directory.fix', compact('directory', 'data'));
    }

    public function test(Request $request)
    {
        $query = $request->get('query') . ' NSW';

        //$key = "AIzaSyDPuZ9AcP4PHUBgbUsT6PdCRUUkyczJ66I";
       $key = "AIzaSyDegpPMIh4JJgSPtZwE6cfTjXSQiSYOdc4";
        $phone = $request->get('phone');
        $id = $request->get('id');
        $add = substr($request->get('add'), -4, strlen($request->get('add')));
        $queryUpdated = str_replace(' ', '%20', $query);

        $url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query='.$queryUpdated.'&key=" . $key;

        // dd($url);
        // $data = file_get_contents($url);
        // print_r($data);

        // dd($url);
        // $url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=Heathcote%20Medical%20Practice%20NSW&key=AIzaSyDPuZ9AcP4PHUBgbUsT6PdCRUUkyczJ66I";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);
        // print_r($data);

        if ($data) {
            // print_r($data);
            foreach ($data['results'] as $value) {
                $postcode = substr($value['formatted_address'], -15, -11);
                if ($add == $postcode) {
                    // print_r($value);

                    $dir = Directory::findOrFail($id);

                    $lat = $value['geometry']['location']['lat'];
                    $lng = $value['geometry']['location']['lng'];

                    $rating = $value['rating'];
                    $dir->rating = $rating;

                    $total_reviews =  $value['user_ratings_total'];
                    $dir->total_reviews = $total_reviews;

                    $place_id = $value['place_id'];
                    // echo $place_id;

                    $url2 = "https://maps.googleapis.com/maps/api/place/details/json?&place_id=$place_id&key=$key";
                    $ch2 =  curl_init();
                    curl_setopt($ch2, CURLOPT_URL, $url2);
                    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);

                    $det_data = json_decode(curl_exec($ch2), true)['result'];

                    if (isset($det_data['photos'])) {
                        // print_r($det_data['photos']);
                        $pht = $det_data['photos'][0]['photo_reference'];

                        $photo_url = "https://maps.googleapis.com/maps/api/place/photo?photo_reference=" . $pht . "&key=" . $key;
                    } else {
                        $photo_url = "https://maps.googleapis.com/maps/api/streetview?size=640x640&location=" . $lat . "," . $lng . "&fov=120&heading=0&key=" . $key;
                    }

                    $dir->image = $photo_url;

                    if (isset($det_data['opening_hours'])) {
                        $dir->monday = $det_data['opening_hours']['weekday_text'][0];
                        $dir->tuesday = $det_data['opening_hours']['weekday_text'][1];
                        $dir->wednesday = $det_data['opening_hours']['weekday_text'][2];
                        $dir->thursday = $det_data['opening_hours']['weekday_text'][3];
                        $dir->friday = $det_data['opening_hours']['weekday_text'][4];
                        $dir->saturday = $det_data['opening_hours']['weekday_text'][5];
                        $dir->sunday = $det_data['opening_hours']['weekday_text'][6];
                    }

                    $dir->save();
                    if ($total_reviews > 0) {
                        // echo "hi";
                        $dir_review = DB::table('directory_reviews')->where('dir_id', $id)->get();
                        if (count($dir_review) > 0) {
                            DB::table('directory_reviews')->where('dir_id', $id)->update([
                                'dir_name' => $request->get('query'),
                                'review_json' =>  json_encode($det_data['reviews']),
                            ]);
                        } else {
                            DB::table('directory_reviews')->insert([
                                'dir_id' => $id,
                                'dir_name' => $request->get('query'),
                                'review_json' =>  json_encode($det_data['reviews']),
                            ]);
                        }
                    }
                    break;
                }
            }
        } else
            print_r("NO");
    }
}
