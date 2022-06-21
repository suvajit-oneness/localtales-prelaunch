<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Contracts\DealContract;
use App\Contracts\CategoryContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;

class DealController extends BaseController
{
    /**
     * @var DealContract
     */
    protected $dealRepository;
    /**
     * @var CategoryContract
     */
    protected $categoryRepository;


    /**
     * PageController constructor.
     * @param DealContract $dealRepository
     */
    public function __construct(DealContract $dealRepository,CategoryContract $categoryRepository)
    {
        $this->dealRepository = $dealRepository;
        $this->categoryRepository = $categoryRepository;

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $pinCode = (isset($request->pin) && $request->pin!='')?$request->pin:'3094';
        $expiryDate = (isset($request->expiry_date) && $request->expiry_date!='')?$request->expiry_date:'';
        $keyword = (isset($request->keyword) && $request->keyword!='')?$request->keyword:'';
        $categoryId = (isset($request->category_id) && $request->category_id!='')?$request->category_id:'';
        $minPrice = (isset($request->min_price) && $request->min_price!='')?$request->min_price:'';
        $maxPrice = (isset($request->max_price) && $request->max_price!='')?$request->max_price:'';

        //$deals = $this->dealRepository->getDealsByPinCode($pinCode);
        $deals = $this->dealRepository->filterDealsData($pinCode,$categoryId,$keyword,$expiryDate,$minPrice,$maxPrice);

        $categories = $this->categoryRepository->listCategories();

        $this->setPageTitle('Deal', 'List of all deal');
        return view('site.deal.index', compact('deals','pinCode','categories','expiryDate','keyword','categoryId','minPrice','maxPrice'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $deals = $this->dealRepository->detailsDeal($id);
        $deal = $deals[0];

        $dealSaved = 0;

        if(Auth::guard('user')->check()){
            $user_id = Auth::guard('user')->user()->id;

            $dealSavedResult = $this->dealRepository->checkUserDeals($id,$user_id);

            if(count($dealSavedResult)>0){
                $dealSaved = 1;
            }else{
                $dealSaved = 0;
            }
        }

        $this->setPageTitle($deal->title, 'Deal Details : '.$deal->title);
        return view('site.deal.details', compact('deal','dealSaved'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveUserDeal($id){
        $user_id = Auth::user()->id;

        $this->dealRepository->saveUserDeal($id,$user_id);

        return $this->responseRedirectBack( 'You have saved this event' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteUserDeal($id){
        $user_id = Auth::user()->id;

        $this->dealRepository->deleteUserDeal($id,$user_id);

        return $this->responseRedirectBack( 'You have removed this event from your list' ,'success',false, false);
    }
}
