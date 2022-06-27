<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Contracts\BlogContract;
use App\Contracts\PincodeContract;
use App\Contracts\SearchContract;
use App\Contracts\SuburbContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\DirectoryCategory;
use Auth;

class ArticleController extends BaseController
{
	/**
     * @var BlogContract
     */
    protected $blogRepository;
    /**
     * @var SearchContract
     */
    protected $SearchRepository;
    /**
     * @var PincodeContract
     */
    protected $PincodeRepository;
    /**
     * @var SuburbContract
     */
    protected $SuburbRepository;


    /**
     * PageController constructor.
     * @param BlogContract $blogRepository
     * @param SearchContract $SearchRepository
     */
    public function __construct(BlogContract $blogRepository, SearchContract $SearchRepository,PincodeContract $PincodeRepository ,SuburbContract $SuburbRepository ){
        $this->blogRepository = $blogRepository;
        $this->SearchRepository = $SearchRepository;
        $this->PincodeRepository = $PincodeRepository;
        $this->SuburbRepository = $SuburbRepository;
    }

    public function index(Request $request){

        // dd($request->all());

        $pinCode = (isset($request->pincode) && $request->pincode!='')?$request->pincode:'';

        $keyword = (isset($request->keyword) && $request->keyword!='')?$request->keyword:'';
        $categoryId = (isset($request->blog_category_id) && $request->blog_category_id!='')?$request->blog_category_id:'';
        $suburb = (isset($request->suburb_id) && $request->suburb_id!='')?$request->suburb_id:'';


        //$deals = $this->dealRepository->getDealsByPinCode($pinCode);
        $blogs = $this->blogRepository->searchBlogsData($pinCode,$categoryId,$keyword,$suburb);
        $latestBlogs = $this->blogRepository->latestBlogs();
       // $categories = $this->blogRepository->getBlogcategories();
    //    $categories = $this->blogRepository->getBlogcategories();
    $categories = DirectoryCategory::orderBy('title')->get();
       $pin=$this->PincodeRepository->listPincode();
       $suburb=$this->SuburbRepository->listSuburb();

      // $tags = $this->blogRepository->getBlogtags();

    	$this->setPageTitle('Blog List', 'List of blogs');
        return view('site.blog.index', compact('blogs','latestBlogs','categories','pin','suburb'));
    }

    /**
     * @param $id
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id,$slug)
    {
        $blogs = $this->blogRepository->detailsBlog($id);
        $blog = $blogs[0];

        $relatedBlogs = $this->blogRepository->getRelatedBlogs($blog->blog_category_id, $blog->id);

        $latestBlogs = $this->blogRepository->latestBlogs();
        $categories = $this->blogRepository->getBlogcategories();

        $this->setPageTitle($blog->title, 'Blog Details : '.$blog->title);
        return view('site.blog.details', compact('blog','relatedBlogs','latestBlogs','categories'));
    }

    /**
     * @param $id
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categoryWiseList($id,$slug){
        $blogs = $this->blogRepository->categoryWiseBlogs($id);

        $latestBlogs = $this->blogRepository->latestBlogs();
        $categories = $this->blogRepository->getBlogcategories();

        $this->setPageTitle('Category Wise Blogs', 'Category wise list of blogs');
        return view('site.blog.category_wise', compact('blogs','latestBlogs','categories'));
    }
}
