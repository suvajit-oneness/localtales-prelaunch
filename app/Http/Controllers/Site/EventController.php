<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Contracts\EventContract;
use App\Contracts\CategoryContract;
use App\Contracts\EventformatContract;
use App\Contracts\LanguageContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;

class EventController extends BaseController
{
    /**
     * @var EventContract
     */
    protected $eventRepository;
    /**
     * @var CategoryContract
     */
    protected $categoryRepository;
    /**
     * @var EventformatContract
     */
    protected $eventformatRepository;
    /**
     * @var LanguageContract
     */
    protected $languageRepository;


    /**
     * EventController constructor.
     * @param EventContract $eventRepository
     * @param CategoryContract $categoryRepository
     * @param EventformatContract $eventformatRepository
     * @param LanguageContract $languageRepository
     */
    public function __construct(EventContract $eventRepository,CategoryContract $categoryRepository,EventformatContract $eventformatRepository,LanguageContract $languageRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->categoryRepository = $categoryRepository;
        $this->eventformatRepository = $eventformatRepository;
        $this->languageRepository = $languageRepository;

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $pinCode = (isset($request->pin) && $request->pin!='')?$request->pin:'3094';
        $eventDate = (isset($request->event_date) && $request->event_date!='')?$request->event_date:'';
        $keyword = (isset($request->keyword) && $request->keyword!='')?$request->keyword:'';
        $categoryId = (isset($request->category_id) && $request->category_id!='')?$request->category_id:'';
        $eventformatId = (isset($request->format_id) && $request->format_id!='')?$request->format_id:'';
        $languageId = (isset($request->language_id) && $request->language_id!='')?$request->language_id:'';
        $isPaid = (isset($request->is_paid) && $request->is_paid!='')?$request->is_paid:'';
        $isRecurring = (isset($request->is_recurring) && $request->is_recurring!='')?$request->is_recurring:'';
        //$events = $this->eventRepository->getEventsByPinCode($pinCode);
        $events = $this->eventRepository->filterEventsData($pinCode,$eventDate,$keyword,$categoryId,$eventformatId,$languageId,$isPaid,$isRecurring);

        $categories = $this->categoryRepository->listCategories();
        $eventformats = $this->eventformatRepository->listEventformats();
        $languages = $this->languageRepository->listLanguages();

        $this->setPageTitle('Event', 'List of all event');
        return view('site.event.index', compact('events','pinCode','categories','eventformats','languages','categoryId','languageId','eventformatId','eventDate','isPaid','isRecurring','keyword'));
    }

     /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id,$slug)
    {
        $events = $this->eventRepository->detailsEvent($id);
        $event = $events[0];

        $eventSaved = 0;

        if(Auth::guard('user')->check()){
            $user_id = Auth::guard('user')->user()->id;

            $eventSavedResult = $this->eventRepository->checkUserEvents($id,$user_id);

            if(count($eventSavedResult)>0){
                $eventSaved = 1;
            }else{
                $eventSaved = 0;
            }
        }

        $this->setPageTitle($event->title, 'Event Details : '.$event->title);
        return view('site.event.details', compact('event','eventSaved'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveUserEvent($id){
        $user_id = Auth::user()->id;

        $this->eventRepository->saveUserEvent($id,$user_id);

        return $this->responseRedirectBack( 'You have saved this event' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteUserEvent($id){
        $user_id = Auth::user()->id;

        $this->eventRepository->deleteUserEvent($id,$user_id);

        return $this->responseRedirectBack( 'You have removed this event from your list' ,'success',false, false);
    }
}
