<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Contracts\EventContract;
use App\Contracts\CategoryContract;
use App\Contracts\DealContract;
use App\Contracts\BusinessContract;
use App\Contracts\NotificationContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;

class ApiController extends BaseController
{
	/**
     * @var EventContract
     */
    protected $eventRepository;
	/**
     * @var DealContract
     */
    protected $dealRepository;
    /**
     * @var CategoryContract
     */
    protected $categoryRepository;
    /**
     * @var NotificationContract
     */
    protected $notificationRepository;
    /**
     * @var BusinessContract
     */
    protected $businessRepository;

	/**
     * PageController constructor.
     * @param EventContract $eventRepository
     * @param DealContract $dealRepository
     * @param CategoryContract $categoryRepository
     * @param NotificationContract $notificationRepository
     */
    public function __construct(EventContract $eventRepository, DealContract $dealRepository, CategoryContract $categoryRepository, NotificationContract $notificationRepository, BusinessContract $businessRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->dealRepository = $dealRepository;
        $this->categoryRepository = $categoryRepository;
        $this->notificationRepository = $notificationRepository;
        $this->businessRepository = $businessRepository;
        
    }

    /**
     * This method is for getting all category list
	 * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories(){
    	$categories = $this->categoryRepository->listCategories();

    	return response()->json(compact('categories'));
    }

    /**
     * This method is for getting event and deals list pin code wise in home page
     * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
     */
    public function getAllHomeData(Request $request){
    	$pinCode = (isset($request->pin) && $request->pin!='')?$request->pin:'3000';
        $categoryId = (isset($request->category_id) && $request->category_id!='')?$request->category_id:'';
        $keyword = (isset($request->keyword) && $request->keyword!='')?$request->keyword:'';

        $deals = $this->dealRepository->searchDealsData($pinCode,$categoryId,$keyword);
        $events = $this->eventRepository->searchEventsData($pinCode,$categoryId,$keyword);
        $businesses = $this->businessRepository->getTrendingBusinessByPinCode($pinCode);
        $categories = $this->categoryRepository->listCategories();
        
        return response()->json(compact('deals','events','businesses','categories'));
    }

    /**
     * This method is for getting notification data
     * @return \Illuminate\Http\JsonResponse
     */
    public function notifications(){
        $notifications = $this->notificationRepository->listNotifications();

        return response()->json(compact('notifications'));
    }

    /**
     * This method is for getting user's saved data
     * @param int $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserSavedData($user_id){
        $userDeals = $this->dealRepository->userDeals($user_id);
        $userEvents = $this->eventRepository->userEvents($user_id);
        $UserBusinesses = $this->businessRepository->UserBusinesses($user_id);

        $events = array();
        $deals = array();
        $businesses = array();

        foreach($userEvents as $userEvent){
            array_push($events, $userEvent->event);
        }

        foreach($userDeals as $userDeal){
            array_push($deals, $userDeal->deal);
        }

        foreach($UserBusinesses as $UserBusiness){
            array_push($businesses, $UserBusiness->business);
        }

        return response()->json(compact('events','deals','businesses'));
    }
}