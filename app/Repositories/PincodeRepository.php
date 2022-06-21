<?php
namespace App\Repositories;

use App\Models\PinCode;
use App\Models\State;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\PincodeContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Str;
/**
 * Class PincodeRepository
 *
 * @package \App\Repositories
 */
class PincodeRepository extends BaseRepository implements PincodeContract
{
    use UploadAble;

    /**
     * PincodeRepository constructor.
     * @param PinCode $model
     */
    public function __construct(PinCode $model)
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
    public function listPincode(string $order = 'pin', string $sort = 'asc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findPincodeById(int $id)
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
    public function createPincode(array $params)
    {
        try {

            $collection = collect($params);

            $pin = new PinCode;
            $pin->pin = $collection['pin'];
            $pin->description = $collection['description'];
            $pin->state_id = $collection['state_id'];

            $pin->save();

            return $pin;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updatePincode(array $params)
    {
        $pin = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');

        $pin->pin = $collection['pin'];
        $pin->description = $collection['description'];
        $pin->state_id = $collection['state_id'];

        // $profile_image = $collection['image'];
        // $imageName = time().".".$profile_image->getClientOriginalName();
        // $profile_image->move("categories/",$imageName);
        // $uploadedImage = $imageName;
        // $category->image = $uploadedImage;

        $pin->save();

        return $pin;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deletePincode($id)
    {
        $pin = $this->findOneOrFail($id);
        $pin->delete();
        return $pin;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updatePincodeStatus(array $params){
        $pin = $this->findOneOrFail($params['id']);
        $collection = collect($params)->except('_token');
        $pin->status = $collection['check_status'];
        $pin->save();

        return $pin;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function detailsPincode($id)
    {
        $pin = PinCode::where('id',$id)->get();

        return $pin;
    }

    public function getAllState()
    {
        return State::all();
    }

     /**
     * @return mixed
     */
    public function getSearchpin(string $term)
    {
        return PinCode::where([['pin', 'LIKE', '%' . $term . '%']])

        ->get();
    }
    
    
      public function searchPostcodeData($stateId,$keyword){
         $pin = PinCode::
         when($stateId!='', function($query) use ($stateId){
            $query->where('state_id', '=', $stateId);
        })
        ->when($keyword, function($query) use ($keyword){
            $query->where('pin', 'like', '%' . $keyword .'%');
        })
       
        // ->orderBy('id', 'desc')
       
        ->paginate(5)
        ->appends(request()->query());

    //   dd($blogs);
        return $pin;
    }

}
