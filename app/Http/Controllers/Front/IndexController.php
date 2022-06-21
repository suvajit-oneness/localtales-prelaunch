<?php

namespace App\Http\Controllers\Front;

use App\BusinessLeads;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use App\Models\Collection;
use App\Models\Setting;
use App\Models\Directory;
use App\Contracts\DirectoryContract;
use App\Contracts\BusinessContract;
use App\Contracts\BlogContract;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationData;
use Illuminate\Validation\Validator;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
class IndexController extends BaseController
{
    /**
     * @var DirectoryContract
     */
    protected $DirectoryRepository;
     /**
     * @var BlogContract
     */
    protected $BlogRepository;
    /**
     * HomeController constructor.
     * @param DirectoryContract $eventRepository
     * @param BlogContract $BlogRepository

     */
    public function __construct(DirectoryContract $DirectoryRepository, BlogContract $BlogRepository,BusinessContract $businessRepository)
    {
        $this->DirectoryRepository = $DirectoryRepository;
        $this->BlogRepository = $BlogRepository;
        $this->businessRepository = $businessRepository;
    }

    public function index(){
        $this->setPageTitle('Splash ', 'Splash Screen');
        $data=Setting::where('key', '=', 'Splash Screen')->get();
        return view('frontend.index',compact('data'));
    }
    public function collection(Request $request,$id){

        $this->setPageTitle('Collection ', 'Collection Screen');
        $data=Setting::where('key', '=', 'Collection')->get();
        $datas=Collection::limit(1)->get();
        $leaduser =  Collection::where('id', '!=', $id)->get();
        $dir=Collection::where('id', $id)->get();
       // dd($dir);
       $businessSaved = 0;

       // // if($request->ip){
       //     $ip = $_SERVER['REMOTE_ADDR'];
       //     $user_id = Auth::user()->id;
       //     $businessSavedResult = $this->businessRepository->checkUserBusinesses($id, $user_id,$ip);

       //     if(count($businessSavedResult)>0){
       //         $businessSaved = 1;
       //     }else{
       //         $businessSaved = 0;
       //     }
       // // }
           if(Auth::guard('user')->check()){
           $user_id = Auth::guard('user')->user()->id;
           //dd($user_id);
           $ip = $_SERVER['REMOTE_ADDR'];
           $businessSavedResult = $this->businessRepository->checkUserCollection($id,$user_id,$ip);

           if(count($businessSavedResult)>0){
               $businessSaved = 1;
           }else{
               $businessSaved = 0;
           }
       }
       
          $businesses = array();
        $categories = $this->DirectoryRepository->directorywisecollection($id);
        return view('frontend.collection',compact('data','datas','businessSaved','leaduser','dir','categories','id'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveUserCollection(Request $request,$id){

        if (Auth::guard('user')->check())  {
        //   dd('here');
           
          //$user_id = Auth::user()->id;
          $user_id = auth()->guard('user')->id();
        $ip = $_SERVER['REMOTE_ADDR'];

        $this->businessRepository->saveUserCollection($id,$user_id,$ip);
      //  dd($request->all());
        return $this->responseRedirectBack( 'You have saved this directory' ,'success',false, false);
        }
         else{
      return redirect()->to('login')->withInput()->with('errmessage', 'Please Login to access restricted area.');
        }
      
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteUserCollection($id){
        $ip = $_SERVER['REMOTE_ADDR'];
        $user_id = Auth::user()->id;
        $this->businessRepository->deleteUserCollection($id,$user_id,$ip);

        return $this->responseRedirectBack( 'You have removed this collection from your list' ,'success',false, false);
    }

    public function page($id){
        //dd($id);
        $this->setPageTitle('Collection ', 'Collection Screen');
        $categories = $this->DirectoryRepository->directorywisecollection($id);
        return view('frontend.collection-directory',compact('categories'));
    }
    public function businesssignup(Request $request){
        $this->setPageTitle('Business ', 'Business Signup');
        $dircategory = $this->DirectoryRepository->getDirectorycategories();
        $directory = $request->session()->get('directory');
        return view('frontend.business.signup',compact('dircategory','directory'));
    }
    // public function createStepOne(Request $request)
    // {
    //     $product = $request->session()->get('product');

    //     return view('products.create-step-one',compact('product'));
    // }
    public function businesssignuppage(Request $request){
        $this->setPageTitle('Business ', 'Business Signup');
        $dircategory = $this->DirectoryRepository->getDirectorycategories();
        $directory = $request->session()->get('directory');

        return view('frontend.business.signuppage',compact('dircategory','directory'));
    }
    public function businessstore(Request $request){
        $validatedData = $request->validate([
          //  'name'      =>  'required|min:1',
            'email'      =>  'required|email|min:1',
           // 'password'      =>  'required|min:1',
            'name'      =>  'required|string|min:1',


        ]);

        if(empty($request->session()->get('directory'))){
            $directory = new Directory();
            $directory->fill($validatedData);
            $request->session()->put('directory', $directory);
        }else{
            $directory = $request->session()->get('directory');
            $directory->fill($validatedData);
            $request->session()->put('directory', $directory);
        }

        return redirect()->route('business.signup');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name'      =>  'required|string',
            'email'      =>  'required|email',
           // 'password'      =>  'required|min:1',
            'address'      =>  'required|string',
           // 'lat'      =>  'required|min:1',
         //   'lon'      =>  'required|min:1',
            'mobile'      =>  'required|integer|digits:10',
            //'alternate_mobile'      =>  'required|integer|digits:10',
            'pin'      =>  'required|integer|digits:4',
            'description'      =>  'required|string',
            'service_description'      =>  'required|string',
            'opening_hour'      =>  'required',
            'website'      =>  'required|string',
            // 'facebook_link'      =>  'required|min:1',
            'twitter_link'      =>  'required|string',
            'primary_name'      =>  'required|string',
           'primary_email'      =>  'required|string',
           'primary_phone'      =>  'required|string',
            // 'monday'      =>  'required|min:1',
            // 'tuesday'      =>  'required|min:1',
            // 'wednesday'      =>  'required|min:1',
            // 'thursday'      =>  'required|min:1',
            // 'friday'      =>  'required|min:1',
            // 'saturday'      =>  'required|min:1',
            // 'sunday'      =>  'required|min:1',
            // 'public_holiday'      =>  'required|min:1',
            // 'category_id'      =>  'required|min:1',
           // 'image'     =>  'required|mimes:jpg,jpeg,png|max:1000',

        ]);

        if (!$validatedData->fails()) {
            if(empty($request->session()->get('directory'))){
                $directory = new Directory();
                $directory->fill($validatedData);
                $request->session()->put('directory', $directory);
            }else{
                $directory = $request->session()->get('directory');
                $directory->fill($validatedData);
                $request->session()->put('directory', $directory);
            }

            return redirect()->route('products.create.step.three');
        } else {
            return redirect()->route('business.signup.page')->withInput($request->all())->withErrors($validatedData->errors());
        }
    }

    public function pagestore(Request $request){
        //dd($request->all());
        // $validatedData = $request->validate([
        //     'name'      =>  'required|string',
        //     'email'      =>  'required|email',
        //    // 'password'      =>  'required|min:1',
        //     'address'      =>  'required|string',
        //    // 'lat'      =>  'required|min:1',
        //  //   'lon'      =>  'required|min:1',
        //     'mobile'      =>  'required|integer|digits:10',
        //     //'alternate_mobile'      =>  'required|integer|digits:10',
        //     'pin'      =>  'required|integer|digits:4',
        //     'description'      =>  'required|string',
        //     'service_description'      =>  'required|string',
        //     'opening_hour'      =>  'required',
        //     'website'      =>  'required|string',
        //     // 'facebook_link'      =>  'required|min:1',
        //     'twitter_link'      =>  'required|string',
        //     'primary_name'      =>  'required|string',
        //    'primary_email'      =>  'required|string',
        //    'primary_phone'      =>  'required|string',
            // 'monday'      =>  'required|min:1',
            // 'tuesday'      =>  'required|min:1',
            // 'wednesday'      =>  'required|min:1',
            // 'thursday'      =>  'required|min:1',
            // 'friday'      =>  'required|min:1',
            // 'saturday'      =>  'required|min:1',
            // 'sunday'      =>  'required|min:1',
            // 'public_holiday'      =>  'required|min:1',
            // 'category_id'      =>  'required|min:1',
           // 'image'     =>  'required|mimes:jpg,jpeg,png|max:1000',

        // ]);

        // if (!$validatedData->fails()) {

            $business = new Directory();
            $business->name = $request->name;
            $business->trading_name = $request->trading_name;
            $business->email = $request->email;
            $business->address = $request->address;
            $business->mobile = $request->mobile;
            $business->pin = $request->pin;
            $business->description = $request->description;
            $business->service_description = $request->service_description;
            $business->category_id = $request->category_id;
            $business->opening_hour = $request->opening_hour;
            $business->primary_name = $request->primary_name;
            $business->primary_email = $request->primary_email;
            $business->primary_phone = $request->primary_phone;
            $business->website = $request->website;
            $business->twitter_link = $request->twitter_link;
            $profile_image = $request['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("Directory/",$imageName);
            $uploadedImage = $imageName;
            $business->image = $uploadedImage;

            $business->save();

            // if(empty($request->session()->get('directory'))){
            //     $directory = new Directory();
            //     $directory->fill($validatedData);
            //     $request->session()->put('directory', $directory);
            // }else{
            //     $directory = $request->session()->get('directory');
            //     $directory->fill($validatedData);
            //     $request->session()->put('directory', $directory);
            // }

             return redirect()->route('products.create.step.three');
        // } else {
        //     return redirect()->route('business.signup')->withInput($request->all())->withErrors($validatedData->errors());
        // }
      }


        //$directory->save();

       // $request->session()->put('directory', $directory);




    public function createStepThree(Request $request)
    {
        $directory = $request->session()->get('directory');

        return view('frontend.business.thankyou',compact('directory'));
    }

    /**
     * Show the step One Form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCreateStepThree(Request $request)
    {
        $directory = $request->session()->get('directory');
        $directory->save();

        $request->session()->forget('directory');

        return redirect()->route('index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setPageTitle('Directory', 'Create Directory');
        $dircategory = $this->DirectoryRepository->getAllcategory();
        return view('admin.directory.create',compact('dircategory'));
    }

    public function categoryWiseDirectory(Request $request, $id)
    {
         //dd($id);
        $cat = $this->DirectoryRepository->getDirectorycategories();
      
       $categoryId = (isset($request->category_id) && $request->category_id!='')?$request->category_id:$id;
       $keyword = (isset($request->keyword) && $request->keyword!='')?$request->keyword:'';
       $pinCode = (isset($request->address) && $request->address!='')?$request->address:'';
       $establish_year = (isset($request->establish_year) && $request->establish_year!='')?$request->establish_year:'';
       $opening_hour = (isset($request->opening_hour) && $request->opening_hour!='')?$request->opening_hour:'';
       $sort = (isset($request->sort) && $request->sort!='') ? $request->sort : '';
       
       $businesses = array();
    
       $businesses_datas = $this->DirectoryRepository->searchDirectoryData($categoryId,$keyword,$pinCode,$establish_year,$opening_hour,$sort);
       $categories = $this->DirectoryRepository->getDirectorycategories($pinCode);
        $this->setPageTitle('Directory', 'Category wise Directory');
        $data = Directory::where('category_id', 'LIKE', '%'.$id.',%')->paginate(24)->appends(request()->query());
       
        return view('site.business.category', compact('data', 'id', 'cat','businesses_datas','categories'));
    }


    public function reviewstore(Request $request){


            $business = new Review();
            $business->name = $request->name;
            $business->directory_id = $request->directory_id;
            $business->email = $request->email;
            $business->rating = $request->rating;
            $business->comment = $request->comment;


            $business->save();

            // if(empty($request->session()->get('directory'))){
            //     $directory = new Directory();
            //     $directory->fill($validatedData);
            //     $request->session()->put('directory', $directory);
            // }else{
            //     $directory = $request->session()->get('directory');
            //     $directory->fill($validatedData);
            //     $request->session()->put('directory', $directory);
            // }

             return redirect()->back()->with('success','Review Added Successfully');
        // } else {
        //     return redirect()->route('business.signup')->withInput($request->all())->withErrors($validatedData->errors());
        // }
      }
}
