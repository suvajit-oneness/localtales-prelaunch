<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Contracts\DirectoryContract;
use App\Contracts\BusinessContract;
use App\Contracts\DirectoryCategoryContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Directory;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class BusinessController extends BaseController
{
    /**
     * @var DirectoryContract
     */
    protected $DirectoryRepository;
    /**
     * @var DirectoryCategoryContract
     */
    protected $categoryRepository;

    protected $businessRepository;
    /**
     * @var DirectoryCategoryContract
     */
    /**
     * BusinessController constructor.
     * @param BusinessContract $businessRepository
     */
    public function __construct(DirectoryContract $DirectoryRepository,DirectoryCategoryContract $DirectoryCategoryRepository,BusinessContract $businessRepository)
    {
        $this->DirectoryRepository = $DirectoryRepository;
        $this->DirectoryCategoryRepository = $DirectoryCategoryRepository;
        $this->businessRepository = $businessRepository;

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function index(Request $request)
    {
        
        // dd($request->all());
        //$pinCode = (isset($request->pin) && $request->pin!='')?$request->pin:'';
       // $businesses = $this->DirectoryRepository->getDirectoryByPinCode($pinCode);
        $categoryId = (isset($request->category_id) && $request->category_id!='')?$request->category_id:'';
        $keyword = (isset($request->keyword) && $request->keyword!='')?$request->keyword:'';
        $pinCode = (isset($request->address) && $request->address!='')?$request->address:'';
        $establish_year = (isset($request->establish_year) && $request->establish_year!='')?$request->establish_year:'';
        $opening_hour = (isset($request->opening_hour) && $request->opening_hour!='')?$request->opening_hour:'';
        $sort = (isset($request->sort) && $request->sort!='') ? $request->sort : '';

        //$suburb = (isset($request->suburb_id) && $request->suburb_id!='')?$request->suburb_id:'';

        $businesses = array();
        //$deals = $this->dealRepository->getDealsByPinCode($pinCode);
        $businesses_datas = $this->DirectoryRepository->searchDirectoryData($categoryId,$keyword,$pinCode,$establish_year,$opening_hour, $sort);



        //dd($businesses);
       // $dir =  $this->DirectoryRepository->listDirectory();
        $dir =  Directory::paginate(15);
         $categories = $this->DirectoryRepository->getDirectorycategories($pinCode);
        //  dd($categories[0]);
        $this->setPageTitle('Directory', 'List of all Directory');
        return view('site.business.index', compact('businesses_datas','pinCode','dir','categories'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details(Request $request,$id)
    {
        $businesses = $this->DirectoryRepository->detailsBusiness($id);
        $business = $businesses[0];

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
           // dd($user_id);
            $ip = $_SERVER['REMOTE_ADDR'];
            $businessSavedResult = $this->businessRepository->checkUserBusinesses($id,$user_id,$ip);

            if(count($businessSavedResult)>0){
                $businessSaved = 1;
            }else{
                $businessSaved = 0;
            }
        }
        // else{
        // return redirect()->to('login')->withInput()->with('errmessage', 'Please Login to access restricted area.');
        // }
        $review =  $this->DirectoryRepository->showreview($id);

       // dd($cat);
        $this->setPageTitle($business->title, 'Directory Details : '.$business->title);
        return view('site.business.details', compact('business', 'businessSaved', 'review'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveUserBusiness(Request $request,$id){
        //  dd($id);
       if (Auth::guard('user')->check())  {
        //   dd('here');
           
          //$user_id = Auth::user()->id;
          $user_id = auth()->guard('user')->id();
        $ip = $_SERVER['REMOTE_ADDR'];
         $this->businessRepository->saveUserBusiness($id,$user_id,$ip);
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
    public function deleteUserBusiness($id){
        $ip = $_SERVER['REMOTE_ADDR'];
        $user_id = Auth::user()->id;
        $this->businessRepository->deleteUserBusiness($id,$user_id,$ip);

        return $this->responseRedirectBack( 'You have removed this directory from your list' ,'success',false, false);
    }


     /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function question(Request $request)
    {

        return view('site.question');
    }

}
