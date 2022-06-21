<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\AboutContract;
use App\Contracts\ContactContract;
use App\Contracts\EventContract;
use App\Contracts\DealContract;
use App\Contracts\DirectoryContract;
use App\Contracts\DirectoryCategoryContract;
use App\Contracts\FaqContract;
use App\Contracts\BlogContract;
use App\Contracts\FaqModuleContract;
use App\Contracts\SuburbContract;
use App\Contracts\PincodeContract;
use App\Models\Directory;
use App\Models\State;
use App\Models\Blog;
use App\Models\PinCode;
use App\Models\DirectoryCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use Auth;
use Symfony\Component\Console\Input\Input;
class ContentController extends BaseController
{
    protected $AboutRepository;
    /**
     * ContentController constructor.
     */
    public function __construct(AboutContract $AboutRepository,ContactContract $ContactRepository,FaqModuleContract $FaqModuleRepository,FaqContract $FaqRepository,DealContract $dealRepository,EventContract $eventRepository,DirectoryContract $DirectoryRepository
    ,BlogContract $blogRepository,SuburbContract $SuburbRepository,DirectoryCategoryContract $DirectoryCategoryRepository,PincodeContract $PincodeRepository )
    {
        $this->AboutRepository = $AboutRepository;
        $this->ContactRepository = $ContactRepository;
        $this->FaqRepository = $FaqRepository;
        $this->FaqModuleRepository = $FaqModuleRepository;
        $this->dealRepository = $dealRepository;
        $this->eventRepository = $eventRepository;
        $this->DirectoryRepository = $DirectoryRepository;
        $this->blogRepository = $blogRepository;
        $this->SuburbRepository = $SuburbRepository;
        $this->DirectoryCategoryRepository =$DirectoryCategoryRepository;
        $this->PincodeRepository =$PincodeRepository;
    }

    public function index(){
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about(){
        $this->setPageTitle('About', 'About Local Tales');
        $about = $this->AboutRepository->listaboutus();
        return view('site.about.index',compact('about'));
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact(){
        $this->setPageTitle('Contact', 'Local Tales');
        $content = $this->ContactRepository->listcontactus();
        return view('site.contact.index',compact('content'));
    }
     /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function faq(){
        $this->setPageTitle('Faq', 'Local Tales');
        $faq = $this->FaqRepository->listfaq();
        $content = $this->FaqModuleRepository->listfaq();
        return view('site.faq.index',compact('content','faq'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function state(Request $request,$pincode){
        $this->setPageTitle('PostCode', 'Local Tales');
        $event = $this->eventRepository->listEvents();
        $content = $this->dealRepository->listDeals();
        //$dir =  $this->DirectoryRepository->listDirectory();
       // $dir = DB::table('directories')->where('pin', '=', 3094)->get();
         $pinCode = (isset($request->pincode) && $request->pincode!='')?$request->pincode:'';

        // $keyword = (isset($request->keyword) && $request->keyword!='')?$request->keyword:'';
        // $categoryId = (isset($request->blog_category_id) && $request->blog_category_id!='')?$request->blog_category_id:'';
        // $suburb = (isset($request->suburb_id) && $request->suburb_id!='')?$request->suburb_id:'';


        //$deals = $this->dealRepository->getDealsByPinCode($pinCode);
       // $dir = $this->DirectoryRepository->searchDirectorybypincode($pincode);
        $dir=Directory::where('address', 'LIKE', '%' . $pincode . '%')->paginate(6);
       //$dir=DB::select('select * from directories where address LIKE '%$request->address%'');
       // SELECT * FROM directories WHERE address LIKE '%$request->address%'
       // where('address', 'LIKE', $request->address)
        $article=$this->blogRepository->searchBlogs($pincode);
        //dd($blogs);
        //$blogs=Blog::where('pincode', 'LIKE', '%' . $pincode . '%')->get();
        $suburb=$this->SuburbRepository->searchSuburb($pincode);
        $latestBlogs = $this->blogRepository->listBlogs();
        $cat = $this->DirectoryRepository->getDirectorycategories();
        $params = $request->except('_token');

        // $name = $request->route('name');

        //$resp = $this->searchRepository->Storesearch($params);
        return view('site.postcode.index',compact('content','event','dir','latestBlogs','suburb','cat','article'));
    }

    public function postcodeindex(Request $request){
        $this->setPageTitle('PostCode', 'Local Tales');

        if (!empty($request->state_id) || !empty($request->pin)) {
            $stateId = (isset($request->state_id) && $request->state_id!='')?$request->state_id:'';
            $keyword = (isset($request->pin) && $request->pin!='')?$request->pin:'';
            $pin = $this->PincodeRepository->searchPostcodeData($stateId, $keyword);
        } else {
            $pin = DB::table('pin_codes')->orderBy('pin')->paginate(9);
        }

        $state=State::orderBy('name')->get();
        return view('site.postcode.home',compact('pin', 'state'));
    }

     /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postcode(Request $request,$pincode){
        $this->setPageTitle('PostCode', 'Local Tales');
        $event = $this->eventRepository->listEvents();
        $content = $this->dealRepository->listDeals();
        //$dir =  $this->DirectoryRepository->listDirectory();
       // $dir = DB::table('directories')->where('pin', '=', 3094)->get();
         $pinCode = (isset($request->pincode) && $request->pincode!='')?$request->pincode:'';

        // $keyword = (isset($request->keyword) && $request->keyword!='')?$request->keyword:'';
        // $categoryId = (isset($request->blog_category_id) && $request->blog_category_id!='')?$request->blog_category_id:'';
        // $suburb = (isset($request->suburb_id) && $request->suburb_id!='')?$request->suburb_id:'';


        //$deals = $this->dealRepository->getDealsByPinCode($pinCode);
       // $dir = $this->DirectoryRepository->searchDirectorybypincode($pincode);
        $dir=Directory::where('address', 'LIKE', '%' . $pincode . '%')->paginate(8);
       //$dir=DB::select('select * from directories where address LIKE '%$request->address%'');
       // SELECT * FROM directories WHERE address LIKE '%$request->address%'
       // where('address', 'LIKE', $request->address)
        $article=$this->blogRepository->searchBlogs($pincode);
        //dd($blogs);
        //$blogs=Blog::where('pincode', 'LIKE', '%' . $pincode . '%')->get();
        $suburb=$this->SuburbRepository->searchSuburb($pincode);
        $latestBlogs = $this->blogRepository->listBlogs();
        $cat = $this->DirectoryRepository->getDirectorycategories();
        $params = $request->except('_token');
       // $data = PinCode::where('id', 'LIKE', '%'.$id.'%');
        // $name = $request->route('name');
        //$resp = $this->searchRepository->Storesearch($params);
        return view('site.postcode.index',compact('content','event','dir','latestBlogs','suburb','cat','article', 'pincode'));
    }

 /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function suburb(Request $request,$pincode){
        $this->setPageTitle('Suburb', 'Local Tales');
        $event = $this->eventRepository->listEvents();
        $content = $this->dealRepository->listDeals();
        //$dir =  $this->DirectoryRepository->listDirectory();
       // $dir = DB::table('directories')->where('pin', '=', 3094)->get();
         $pinCode = (isset($request->pincode) && $request->pincode!='')?$request->pincode:'';

        // $keyword = (isset($request->keyword) && $request->keyword!='')?$request->keyword:'';
        // $categoryId = (isset($request->blog_category_id) && $request->blog_category_id!='')?$request->blog_category_id:'';
        // $suburb = (isset($request->suburb_id) && $request->suburb_id!='')?$request->suburb_id:'';


        //$deals = $this->dealRepository->getDealsByPinCode($pinCode);
       // $dir = $this->DirectoryRepository->searchDirectorybypincode($pincode);
        $dir=Directory::where('address', 'LIKE', '%' . $pincode . '%')->paginate(6);
       //$dir=DB::select('select * from directories where address LIKE '%$request->address%'');
       // SELECT * FROM directories WHERE address LIKE '%$request->address%'
       // where('address', 'LIKE', $request->address)
        $article=$this->blogRepository->searchBlogs($pincode);
        //dd($blogs);
        //$blogs=Blog::where('pincode', 'LIKE', '%' . $pincode . '%')->get();
        $suburb=$this->SuburbRepository->searchSuburb($pincode);
        $latestBlogs = $this->blogRepository->listBlogs();
        $cat = $this->DirectoryRepository->getDirectorycategories();
        $params = $request->except('_token');

        // $name = $request->route('name');

        //$resp = $this->searchRepository->Storesearch($params);
        return view('site.postcode.suburb-index',compact('content','event','dir','latestBlogs','suburb','cat','article','pincode'));
    }

    public function category($id){
        $this->setPageTitle('Category', 'Local Tales');
        $event = DirectoryCategory::where('id', $id)->get();
        $latestBlogs = $this->blogRepository->listBlogs();
        $cat = $this->DirectoryCategoryRepository->listdirectoryCategories();
        $faq = $this->FaqRepository->listfaq();
        $suburb = $this->SuburbRepository->listSuburb();
        return view('site.category.index',compact('event','latestBlogs','faq','suburb','cat'));
    }

    public function categoryindex(){
        $this->setPageTitle('Faq', 'Local Tales');
        $cat = DirectoryCategory::paginate(12);
       
        return view('site.category.home',compact('cat'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms(){
        $this->setPageTitle('Terms Of Use', 'Local Tales - Terms Of Use');
        return view('site.content.terms');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privacy(){
        $this->setPageTitle('Privacy Policy', 'Local Tales - Privacy Policy');
        return view('site.content.privacy');
    }

    public function search(Request $request){

        // dd($request->all());
        $cat = $this->DirectoryRepository->getDirectorycategories();
        $keyword = (isset($request->title) && $request->title!='')?$request->title:'';
        $directoryId = (isset($request->category_id) && $request->category_id!='')?$request->category_id:'';
        $dir = $this->DirectoryRepository->searchDirectoryData($directoryId,$keyword);
        $latestdir = $this->DirectoryRepository->listDirectory();
        $categories = $this->blogRepository->getBlogcategories();

        //$pin=$this->PincodeRepository->listPincode();
        $suburb=$this->SuburbRepository->listSuburb();
        $this->setPageTitle('Directory List', 'List of blogs');
        return view('site.postcode.details', compact('dir','latestdir','categories','suburb','cat'));
    }

     /**
     * @param $id
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id,$slug)
    {
        $blogs = $this->DirectoryRepository->detailsDirectory($id);
        $blog = $blogs[0];

        $relatedBlogs = $this->blogRepository->getRelatedBlogs($blog->blog_category_id, $blog->id);

        $latestBlogs = $this->blogRepository->latestBlogs();
        $categories = $this->blogRepository->getBlogcategories();

        $this->setPageTitle($blog->title, 'Directory Details : '.$blog->title);
        return view('site.postcode.details-page', compact('blog','relatedBlogs','latestBlogs','categories'));
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function directory(){
        $this->setPageTitle('Faq', 'Local Tales');
        $event = $this->eventRepository->listEvents();
        $content = $this->dealRepository->listDeals();
        $dir =  $this->DirectoryRepository->listDirectory();
        $suburb = $this->SuburbRepository->listSuburb();
        $latestBlogs = $this->blogRepository->listBlogs();
        $cat = $this->DirectoryRepository->getDirectorycategories();
        return view('site.postcode.index',compact('content','event','dir','latestBlogs','suburb','cat'));
    }


}
