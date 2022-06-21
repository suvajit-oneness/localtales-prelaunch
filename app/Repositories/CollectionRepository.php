<?php
namespace App\Repositories;

use App\Models\Collection;
use App\Models\Suburb;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\CollectionContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Str;
/**
 * Class CollectionRepository
 *
 * @package \App\Repositories
 */
class CollectionRepository extends BaseRepository implements CollectionContract
{
    use UploadAble;

    /**
     * BlogCategoryRepository constructor.
     * @param Collection $model
     */
    public function __construct(Collection $model)
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
    public function listCollection(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findCollectionById(int $id)
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
    public function createCollection(array $params)
    {
        try {

            $collection = collect($params);

            $col= new Collection;
            $col->title = $collection['title'];
            $col->short_description = $collection['short_description'];
            $col->bottom_content = $collection['bottom_content'];
            $col->description = $collection['description'];
            $col->pin_code = $collection['pin_code'];
            $col->address = $collection['address'];
            $col->suburb_id = $collection['suburb_id'];
            $col->meta_title = $collection['meta_title'];
            $col->meta_key = $collection['meta_key'];
            $col->meta_description = $collection['meta_description'];
            $col->rating = $collection['rating'];


            $slug = Str::slug($collection['title'], '-');
            $slugExistCount = Collection::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $col->slug = $slug;

            $profile_image = $collection['image'];
            $imageName = time().".".$profile_image->getClientOriginalName();
            $profile_image->move("Collection/",$imageName);
            $uploadedImage = $imageName;
            $col->image = $uploadedImage;


            $col->save();

            return $col;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCollection(array $params)
    {
        $col = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');

        $col->title = $collection['title'];
        $col->short_description = $collection['short_description'];
        $col->bottom_content = $collection['bottom_content'];
        $col->description = $collection['description'];
        $col->pin_code = $collection['pin_code'];
        $col->address = $collection['address'];
        $col->suburb_id = $collection['suburb_id'];
        $col->meta_title = $collection['meta_title'];
        $col->meta_key = $collection['meta_key'];
        $col->meta_description = $collection['meta_description'];
        $col->rating = $collection['rating'];

        $slug = Str::slug($collection['title'], '-');
        $slugExistCount = Collection::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $col->slug = $slug;

        $profile_image = $collection['image'];
        $imageName = time().".".$profile_image->getClientOriginalName();
        $profile_image->move("Collection/",$imageName);
        $uploadedImage = $imageName;
        $col->image = $uploadedImage;


        $col->save();

        return $col;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCollection($id)
    {
        $state = $this->findOneOrFail($id);
        $state->delete();
        return $state;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCollectionStatus(array $params){
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
    public function detailsCollection($id)
    {
        $categories = Collection::where('id',$id)->get();

        return $categories;
    }



        // csv upload

        public function getAllSuburb(){
            return Suburb::all();
        }

    /**
     * @return mixed
     */
    public function getSearchCollection(string $term)
    {
        return Collection::where([['title', 'LIKE', '%' . $term . '%']])
        ->orWhere('address', 'LIKE', '%' . $term . '%')
        ->orWhere('pin_code', 'LIKE', '%' . $term . '%')
        ->get();
    }
    
    /**
     * @param $pinCode
     * @param $keyword
     * @return mixed
     */
    
    
    public function searchCollectionData($pinCode,$keyword){
        
         $col = Collection::
        when($pinCode, function($query) use ($pinCode){
            $query->where('pin_code', '=', $pinCode);
        })
       
        ->when($keyword, function($query) use ($keyword){
            $query->where('title', 'like', '%' . $keyword .'%');
        })
        ->paginate(5)
        ->appends(request()->query());
        return $col;
        
    }

    }



