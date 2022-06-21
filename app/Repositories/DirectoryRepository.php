<?php
namespace App\Repositories;

use App\Models\Directory;
use App\Models\Review;
use App\Models\CollectionDirectory;
use App\Models\Suburb;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Contracts\DirectoryContract;
use App\Models\DirectoryCategory;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
/**
 * Class DirectoryRepository
 *
 * @package \App\Repositories
 */
class DirectoryRepository extends BaseRepository implements DirectoryContract
{
    use UploadAble;

    /**
     * BlogCategoryRepository constructor.
     * @param Directory $model
     */
    public function __construct(Directory $model)
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
    public function listDirectory(string $order = 'id', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findDirectoryById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return State|mixed
     */
    public function createDirectory(array $params)
    {
        try {
            $collection = collect($params);
            $dir = new Directory;
            $dir->name = $collection['name'];
            $dir->email = $collection['email'];
            $dir->password = $collection['password'];
            $dir->mobile = $collection['mobile'];
            $dir->category_id = $collection['category_id'];
            $dir->address = $collection['address'];
            $dir->pin = $collection['pin'];
            $dir->lat = $collection['lat'];
            $dir->lon = $collection['lon'];
            $dir->description = $collection['description'];
            $dir->service_description = $collection['service_description'];
            $dir->opening_hour = $collection['opening_hour'];
            $dir->website = $collection['website'];
            $dir->facebook_link = $collection['facebook_link'];
            $dir->twitter_link = $collection['twitter_link'];
            $dir->instagram_link = $collection['instagram_link'];
            $dir->establish_year = $collection['establish_year'];
            $dir->ABN = $collection['ABN'];
            $dir->monday = $collection['monday'];
            $dir->tuesday = $collection['tuesday'];
            $dir->wednesday = $collection['wednesday'];
            $dir->thursday = $collection['thursday'];
            $dir->friday = $collection['friday'];
            $dir->saturday = $collection['saturday'];
            $dir->sunday = $collection['sunday'];
            $dir->public_holiday = $collection['public_holiday	'];
            $dir->category_tree = $collection['category_tree'];
            $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("Directory/",$imageName);
            $uploadedImage = $imageName;
            $dir->image = $uploadedImage;

            // $profile_image = $collection['banner_image'];
            // $imageName = time().".".$profile_image->getClientOriginalName();
            // $profile_image->move("Directory/",$imageName);
            // $uploadedImage = $imageName;
            // $dir->banner_image = $uploadedImage;

            // $profile_image = $collection['image2'];
            // $imageName = time().".".$profile_image->getClientOriginalName();
            // $profile_image->move("Directory/",$imageName);
            // $uploadedImage = $imageName;
            // $dir->image2 = $uploadedImage;
            $dir->save();
            return $dir;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateDirectory(array $params)
    {
            $dir = $this->findOneOrFail($params['id']);
            $collection = collect($params)->except('_token');
            $dir->name = $collection['name'];
            $dir->email = $collection['email'];
            $dir->password = $collection['password'];
            $dir->mobile = $collection['mobile'];
            $dir->category_id = $collection['category_id'];
            $dir->address = $collection['address'];
            $dir->pin = $collection['pin'];
            $dir->lat = $collection['lat'];
            $dir->lon = $collection['lon'];
            $dir->description = $collection['description'];
            $dir->service_description = $collection['service_description'];
            $dir->opening_hour = $collection['opening_hour'];
            $dir->website = $collection['website'];
            $dir->facebook_link = $collection['facebook_link'];
            $dir->twitter_link = $collection['twitter_link'];
            $dir->instagram_link = $collection['instagram_link'];
            $dir->establish_year = $collection['establish_year'];
            $dir->ABN = $collection['ABN'];
            $dir->monday = $collection['monday'];
            $dir->tuesday = $collection['tuesday'];
            $dir->wednesday = $collection['wednesday'];
            $dir->thursday = $collection['thursday'];
            $dir->friday = $collection['friday'];
            $dir->saturday = $collection['saturday'];
            $dir->sunday = $collection['sunday'];
            //$dir->public_holiday = $collection['public_holiday	'];
            $dir->category_tree = $collection['category_tree'];
            $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("Directory/",$imageName);
            $uploadedImage = $imageName;
            $dir->image = $uploadedImage;

            // $profile_image = $collection['banner_image'];
            // $imageName = time().".".$profile_image->getClientOriginalName();
            // $profile_image->move("Directory/",$imageName);
            // $uploadedImage = $imageName;
            // $dir->banner_image = $uploadedImage;

            // $profile_image = $collection['image2'];
            // $imageName = time().".".$profile_image->getClientOriginalName();
            // $profile_image->move("Directory/",$imageName);
            // $uploadedImage = $imageName;
            // $dir->image2 = $uploadedImage;
            $dir->save();
            return $dir;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteDirectory($id)
    {
        $state = $this->findOneOrFail($id);
        $state->delete();
        return $state;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateDirectoryStatus(array $params){
        $state = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $state->status = $collection['check_status'];
        $state->save();

        return $state;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsDirectory($id)
    {
        $categories = Directory::where('id',$id)->get();

        return $categories;
    }



       /**
     * @return mixed
     */
    public function getDirectorycategories(){
        // $categories = DB::table('business_categories')->orderBy('title')->get();
        $categories = DirectoryCategory::orderBy('title')->get();
        // dd($categories[1]);

        return $categories;
    }
        public function latestdirectory(){
            $blogs = Directory::orderBy('created_at','asc')->take(4)->get();

            return $blogs;
        }


        /**
     *
     * @param $categoryId
     * @param $keyword
     * @return mixed
     */
    public function searchDirectoryData($categoryId,$keyword,$pinCode,$establish_year,$opening_hour, $sort){
        // dd($sort);
        if($sort=="time_asc") {$filterName = "id";$sortOrder = "asc";}
        elseif($sort=="time_desc") {$filterName = "id";$sortOrder = "desc";}
        else {$filterName = "id";$sortOrder = "asc";}

        $blogs = Directory::
        when($categoryId!='', function($query) use ($categoryId){
            //$query->where('category_id', '=', $categoryId);
            $query->where('category_id', 'like',  $categoryId .',%');
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
        ->when($opening_hour, function($query) use ($opening_hour){
            $query->where('opening_hour', 'like', '%' . $opening_hour .'%');
        })
        // ->orderBy('id', 'desc')
        ->orderBy($filterName, $sortOrder)
        ->paginate(16)
        ->appends(request()->query());

    //   dd($blogs);
        return $blogs;
    }

    public function searchDirectorybypincode(Request $request){
      // $blogs = DB::select('SELECT * FROM directories WHERE address like '%3094%'');
     // $blogs=DB::select('select * from directories where address = ?', [$request->address]);
    // when($pinCode, function($query) use ($pinCode){
        //     $query->where('address', '=', $pinCode);
        // })
        // ->get();
      // $blogs=Directory::where('address',$pinCode)->get();
     //   return $blogs;
       // $someVariable = Input::get("some_variable");

       // $results = DB::select( DB::raw("SELECT * FROM directories WHERE address = '$pinCode'") );
       $blogs=Directory::where('address', 'LIKE', $request->address);
        return $blogs;
    }
     /**
     * @param $pinCode
     * @return mixed
     */
    public function getDirectoryByPinCode($pinCode){
        //$businesses = Directory::with('category')->where('pin',$pinCode)->paginate(25);
        $dir=Directory::where('address', 'LIKE', '%' . $pinCode . '%')->paginate(10);
        return $dir;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsBusiness($id)
    {
        $businesses = Directory::where('id',$id)->get();

        return $businesses;
    }
     /**
     * @param $collectionId
     * @return mixed
     */
    public function directorywisecollection($collectionId){
        //dd()
        $blogs = CollectionDirectory::where('collection_id',$collectionId)->with('directory')->get();
        //select('color')->where('product_id', $productId)->first();

        return $blogs;
    }

     /**
     * This method is for search directory
     * @param
     *
     */
    public function Directorysearch(array $data)
    {
        $collectedData = collect($data);

        $resp = Directory::where('pin', 'like', '%'.$collectedData['query'].'%')->get();

        return $resp;
    }

    // public function getSearchDirectory(string $term)
    // {
    //     //dd($term);
    //     return Directory::where('name', 'LIKE', '%' . $term . '%')
    //         ->orWhere('email', 'LIKE', '%' . $term . '%')
    //         ->orWhere('address', 'LIKE', '%' . $term . '%')
    //         ->orWhere('mobile', 'LIKE', '%' . $term . '%')
    //         ->orWhere('category_id', 'LIKE', '%' . $term . '%')
    //         ->get();
    // }


    /**
     * @return mixed
     */
    public function getSearchDirectory(string $term)
    {
        return Directory::where([['name', 'LIKE', '%' . $term . '%']])
        ->orWhere('category_id', 'LIKE', '%' . $term . '%')
        ->orWhere('address', 'LIKE', '%' . $term . '%')
        ->orWhere('email', 'LIKE', '%' . $term . '%')
        ->get();
    }


    public function addReview(array $data){
        $collectedData = collect($data);

        $wishlistExists = Review::where('directory_id', $collectedData['directory_id'])->first();

        if ($wishlistExists) {
            $newEntry = Review::destroy($wishlistExists->id);
            return "removed";
        } else {
            $newEntry = new Review;

            $newEntry->name = $collectedData['name'];
            $newEntry->directory_id = $collectedData['directory_id'];
            $newEntry->email = $collectedData['email'];
            $newEntry->rating = $collectedData['rating'];
            $newEntry->comment = $collectedData['comment'];

            $newEntry->save();
            return "ReviewAdded";
        }

    }


    public function showreview($id){
        return Review::where('directory_id', $id)->get();
      }
    }



