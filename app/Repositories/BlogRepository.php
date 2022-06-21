<?php
namespace App\Repositories;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\SubCategory;
use App\Models\Blogtag;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\BlogContract;
use App\Models\PinCode;
use App\Models\Suburb;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Str;
/**
 * Class BlogRepository
 *
 * @package \App\Repositories
 */
class BlogRepository extends BaseRepository implements BlogContract
{
    use UploadAble;

    /**
     * BlogRepository constructor.
     * @param Blog $model
     */
    public function __construct(Blog $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBlogs(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findBlogById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Blog|mixed
     */
    public function createBlog(array $params)
    {
        try {
            $collection = collect($params);

            $blog = new Blog;
            $blog->title = $collection['title'];

            $blog->blog_category_id = $collection['blog_category_id'];
            $blog->blog_sub_category_id = $collection['blog_sub_category_id'];
            $blog->pincode = $collection['pincode'];
            $blog->suburb_id = $collection['suburb_id'];
            $blog->content = $collection['content'];
            $blog->meta_title = $collection['meta_title'];
            $blog->meta_key = $collection['meta_key'];
            $blog->meta_description = $collection['meta_description'];
            $blog->tag = $collection['tag'];

            // slug generate
            $slug = Str::slug($collection['title'], '-');
            $slugExistCount = Blog::where('title', $collection['title'])->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $blog->slug = $slug;

            $profile_image = $collection['banner_image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("Blogs/",$imageName);
            $uploadedImage = $imageName;
            $blog->banner_image = $uploadedImage;

            $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("Blogs/",$imageName);
            $uploadedImage = $imageName;
            $blog->image = $uploadedImage;

            $profile_image = $collection['image2'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("Blogs/",$imageName);
            $uploadedImage = $imageName;
            $blog->image2 = $uploadedImage;

            $blog->save();

            return $blog;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBlog(array $params)
    {
        $blog = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');

        $blog->title = $collection['title'];


        $blog->blog_category_id = $collection['blog_category_id'];
        $blog->blog_sub_category_id = $collection['blog_sub_category_id'];
        $blog->pincode = $collection['pincode'];
        $blog->suburb_id = $collection['suburb_id'];
        $blog->content = $collection['content'];
        $blog->meta_title = $collection['meta_title'];
        $blog->meta_key = $collection['meta_key'];
        $blog->meta_description = $collection['meta_description'];
        $blog->tag = $collection['tag'];
        $slug = Str::slug($collection['title'], '-');
        $slugExistCount = Blog::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $blog->slug = $slug;
        $profile_image = $collection['banner_image'];
        $imageName = time().".".$profile_image->getClientOriginalName();
        $profile_image->move("Blogs/",$imageName);
        $uploadedImage = $imageName;
        $blog->banner_image = $uploadedImage;

        $profile_image = $collection['image'];
        $imageName = time().".".$profile_image->getClientOriginalName();
        $profile_image->move("Blogs/",$imageName);
        $uploadedImage = $imageName;
        $blog->image = $uploadedImage;

        $profile_image = $collection['image2'];
        $imageName = time().".".$profile_image->getClientOriginalName();
        $profile_image->move("Blogs/",$imageName);
        $uploadedImage = $imageName;
        $blog->image2 = $uploadedImage;

        $blog->save();

        return $blog;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteBlog($id)
    {
        $blog = $this->findOneOrFail($id);
        $blog->delete();
        return $blog;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBlogStatus(array $params){
        $blog = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $blog->status = $collection['check_status'];
        $blog->save();

        return $blog;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsBlog($id){
        $blogs = Blog::with('category')->where('id',$id)->get();

        return $blogs;
    }

    /**
     * @return mixed
     */
    public function getBlogs(){
        //$blogs = Blog::with('category')->paginate(3);
        $blogs = Blog::orderBy('created_at','desc')->take(3)->get();

        return $blogs;
    }
    /**
     * @return mixed
     */
    public function getSearchBlog(string $term)
    {
        return Blog::where([['title', 'LIKE', '%' . $term . '%']])
        ->orWhere('blog_category_id', 'LIKE', '%' . $term . '%')
        ->orWhere('meta_title', 'LIKE', '%' . $term . '%')
        ->orWhere('meta_key', 'LIKE', '%' . $term . '%')
        ->get();
    }
    /**
     * @return mixed
     */
    public function getBlogcategories(){
        $categories = Blogcategory::orderBy('title')->get();
        return $categories;
    }
 /**
     * @return mixed
     */
    public function getBlogsubcategories(){
        $categories = Subcategory::get();

        return $categories;
    }

    /**
     * @return mixed
     */
    public function latestBlogs(){
        $blogs = Blog::orderBy('created_at','asc')->take(5)->get();

        return $blogs;
    }

    /**
     * @return mixed
     */
    // public function getBlogtags(){
    //     $tags = Blogtag::select('tag')
    //             ->groupBy('tag')
    //             ->orderByRaw('COUNT(*) DESC')
    //             ->limit(10)
    //             ->get();

    //     return $tags;
    // }

    /**
     * @param $categoryId
     * @param $id
     * @return mixed
     */
    public function getRelatedBlogs($categoryId,$id){
        $blogs = Blog::with('category')->where('blog_category_id',$categoryId)->where('id','!=',$id)->get();

        return $blogs;
    }

    /**
     * @param $categoryId
     * @return mixed
     */
    public function categoryWiseBlogs($categoryId){
        $blogs = Blog::with('category')->where('blog_category_id',$categoryId)->get();

        return $blogs;
    }
    public function getSuburb(){
        $suburb = Suburb::get();

        return $suburb;
    }
    public function getPincode(){
        $pin = PinCode::get();

        return $pin;
    }

     /**
     * @param $pinCode
     * @param $categoryId
     * @param $keyword
     * @return mixed
     */
    public function searchBlogsData($pinCode,$categoryId,$keyword,$suburb){
        $blogs = Blog::with('category')->where('status','=',1)->
        when($pinCode, function($query) use ($pinCode){
            $query->where('pincode', '=', $pinCode);
        })
        ->when($suburb, function($query) use ($suburb){
            $query->where('suburb_id', '=', $suburb);
        })
        ->when($categoryId!='', function($query) use ($categoryId){
            $query->where('blog_category_id', '=', $categoryId);
        })
        ->when($keyword, function($query) use ($keyword){
            $query->where('title', 'like', '%' . $keyword .'%');
        })
        ->get();

        return $blogs;
    }
    public function searchBlogs($pinCode){
        $blogs = Blog::
        when($pinCode, function($query) use ($pinCode){
            $query->where('pincode', '=', $pinCode);
        })
        ->get();

        return $blogs;
    }
}
