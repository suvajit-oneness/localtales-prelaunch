<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\Collection;
use App\Contracts\CollectionContract;
class CollectionController extends BaseController {




    /**
     * @var CollectionContract
     */
    protected $collectionRepository;
    


    /**
     * CollectionController constructor.
     * @param CollectionContract $collectionRepository
    
     */
    public function __construct(CollectionContract $collectionRepository ){
        $this->collectionRepository = $collectionRepository;
       
    }
    public function index(Request $request)
    {
        // dd($request->all());
        // if (!empty($request->postcode) || !empty($request->keyword)) {
        //     // DB::enableQueryLog();

        //     $keyword = $request->keyword;
        //     $postcode = $request->postcode;

        //     /* $data = DB::table('collections')
        //         ->when($keyword, function($query) use ($keyword){
        //             $query->where('name', 'like', '%' . $keyword .'%');
        //         })
        //         ->when($pinCode, function($query) use ($pinCode){
        //             $query->where('address', 'LIKE', '%' . $pinCode . '%');
        //         })
        //         // ->where('pin_code', 'LIKE', '%'.$request->postcode.'%')
        //         // ->orWhere('title', 'LIKE', '%'.$request->keyword.'%')
        //         // ->orWhere('address', 'LIKE', '%'.$request->keyword.'%')
        //         // ->orWhere('short_description', 'LIKE', '%'.$request->keyword.'%')
        //         // ->orWhere('pin_code', 'LIKE', '%'.$request->keyword.'%')
        //         ->get(); */

        //     $data = DB::table('collections')
        //     ->when($postcode, function ($query, $postcode) {
        //         return $query->where('title', $postcode);
        //     })
        //     ->get();

        //     // dd(DB::getQueryLog($data));
        // } else {
        //     $data = DB::table('collections')->get();
        // }
         if (!empty($request->pin_code) || !empty($request->keyword)) {

        $pinCode = (isset($request->pin_code) && $request->pin_code!='')?$request->pin_code:'';

        $keyword = (isset($request->keyword) && $request->keyword!='')?$request->keyword:'';
         $data = $this->collectionRepository->searchCollectionData($pinCode,$keyword);
         } else {
            $data = DB::table('collections')->get();
        }
        $this->setPageTitle('Collection ', 'Collection page');
        return view('site.collection.index', compact('data', 'request'));
    }
    
    public function searchDirectoryData($categoryId,$keyword,$pinCode,$establish_year,$monday,$tuesday,$wednesday,$thursday,$friday,$saturday,$sunday,$public_holiday){
        $blogs = Directory::
        when($categoryId!='', function($query) use ($categoryId){
            $query->where('category_id', '=', $categoryId);
        })
        ->when($keyword, function($query) use ($keyword){
            $query->where('name', 'like', '%' . $keyword .'%');
        })
        ->when($pinCode, function($query) use ($pinCode){
            $query->where('address', 'LIKE', '%' . $pinCode . '%');
        })
        ->when($establish_year, function($query) use ($establish_year){
            $query->where('establish_year', 'like', '%' . $establish_year .'%');
        })
        ->when($monday, function($query) use ($monday){
            $query->where('monday', 'like', '%' . $monday .'%');
        })
        ->when($tuesday, function($query) use ($tuesday){
            $query->where('tuesday', 'like', '%' . $tuesday .'%');
        })
        ->when($wednesday, function($query) use ($wednesday){
            $query->where('wednesday', 'like', '%' . $wednesday .'%');
        })
        ->when($thursday, function($query) use ($thursday){
            $query->where('thursday', 'like', '%' . $thursday .'%');
        })
        ->when($friday, function($query) use ($friday){
            $query->where('friday', 'like', '%' . $friday .'%');
        })

        ->when($saturday, function($query) use ($saturday){
            $query->where('saturday', 'like', '%' . $saturday .'%');
        })
        ->when($sunday, function($query) use ($sunday){
            $query->where('sunday', 'like', '%' . $sunday .'%');
        })
        ->when($public_holiday, function($query) use ($public_holiday){
            $query->where('public_holiday', 'like', '%' . $public_holiday .'%');
        })
        ->paginate(8);
       //dd($blogs);
        return $blogs;
    }
}