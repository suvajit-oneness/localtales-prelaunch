<?php
namespace App\Repositories;
use Illuminate\Support\Str;
use App\Models\HelpCategory;
use App\Models\HelpArticle;
use App\Models\HelpSubCategory;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\HelpCategoryContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class HelpCategoryRepository extends BaseRepository implements HelpCategoryContract
{
    use UploadAble;

    /**
     * BlogCategoryRepository constructor.
     * @param BlogCategory $model
     */
    public function __construct(HelpCategory $model)
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
    public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findCategoryById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Blogcategory|mixed
     */
    public function createCategory(array $params)
    {
        try {

            $collection = collect($params);

            $category = new HelpCategory;
            $category->title = $collection['title'];
            $category->description = $collection['description'];
            $slug = Str::slug($collection['title'], '-');
            $slugExistCount = HelpCategory::where('slug', $slug)->count();
            if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
            $category->slug = $slug;

            $category->save();

            return $category;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCategory(array $params)
    {
        $category = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');

        $category->title = $collection['title'];
        $category->description = $collection['description'];
        $slug = Str::slug($collection['title'], '-');
        $slugExistCount = HelpCategory::where('slug', $slug)->count();
        if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $category->slug = $slug;
        // $profile_image = $collection['image'];
        // $imageName = time().".".$profile_image->getClientOriginalName();
        // $profile_image->move("categories/",$imageName);
        // $uploadedImage = $imageName;
        // $category->image = $uploadedImage;

        $category->save();

        return $category;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteCategory($id)
    {
        $category = $this->findOneOrFail($id);
        $category->delete();
        return $category;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCategoryStatus(array $params){
        $category = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $category->status = $collection['check_status'];
        $category->save();

        return $category;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsCategory($id)
    {
        $categories = HelpCategory::where('id',$id)->get();

        return $categories;
    }
    public function getSearchCategories(string $term)
    {
        return HelpCategory::where([['title', 'LIKE', '%' . $term . '%']])->paginate(25);
    }


    public function getSearchSubCategories(string $term)
    {
        return HelpArticle::where([['title', 'LIKE', '%' . $term . '%']])->paginate(25);
    }
}
