<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\DealContract;
use App\Contracts\DirectoryCategoryContract;
use App\Contracts\BussinessLeadContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class DealController extends BaseController
{
    /**
     * @var DealContract
     */
    protected $dealRepository;
    /**
     * @var DirectoryCategoryContract
     */
    protected $DirectoryCategoryRepository;
    /**
     * @var BussinessLeadContract
     */
    protected $BusinessLeadRepository;


    /**
     * NotificationController constructor.
     * @param DealContract $dealRepository
     */
    public function __construct(DealContract $dealRepository,DirectoryCategoryContract $DirectoryCategoryRepository,BussinessLeadContract $BusinessLeadRepository)
    {
        $this->dealRepository = $dealRepository;
        $this->DirectoryCategoryRepository = $DirectoryCategoryRepository;
        $this->BusinessLeadRepository = $BusinessLeadRepository;
        
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $deals = $this->dealRepository->listDeals();

        $this->setPageTitle('Deal', 'List of all deals');
        return view('admin.deal.index', compact('deals'));
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->DirectoryCategoryRepository->listdirectoryCategories();
        $businesses = $this->BusinessLeadRepository->listBusinesssLead();

        $this->setPageTitle('Deal', 'Create Deal');
        return view('admin.deal.create', compact('categories','businesses'));
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
            'image'     =>  'required|mimes:jpg,jpeg,png|max:2000',
        ]);

        $params = $request->except('_token');
        
        $deal = $this->dealRepository->createDeal($params);

        if (!$deal) {
            return $this->responseRedirectBack('Error occurred while creating deal.', 'error', true, true);
        }
        return $this->responseRedirect('admin.deal.index', 'Deal has been added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetDeal = $this->dealRepository->findDealById($id);
        $categories = $this->categoryRepository->listCategories();
        $businesses = $this->businessRepository->listBusinesss();
        
        $this->setPageTitle('Deal', 'Edit Deal : '.$targetDeal->title);
        return view('admin.deal.edit', compact('targetDeal','categories','businesses'));
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
        ]);

        $params = $request->except('_token');

        $deal = $this->dealRepository->updateDeal($params);

        if (!$deal) {
            return $this->responseRedirectBack('Error occurred while updating deal.', 'error', true, true);
        }
        return $this->responseRedirectBack('Deal has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $deal = $this->dealRepository->deleteDeal($id);

        if (!$deal) {
            return $this->responseRedirectBack('Error occurred while deleting deal.', 'error', true, true);
        }
        return $this->responseRedirect('admin.deal.index', 'Deal has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $deal = $this->dealRepository->updateDealStatus($params);

        if ($deal) {
            return response()->json(array('message'=>'Deal status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $deals = $this->dealRepository->detailsDeal($id);
        $deal = $deals[0];

        $this->setPageTitle('Deal', 'Deal Details : '.$deal->title);
        return view('admin.deal.details', compact('deal'));
    }
}
