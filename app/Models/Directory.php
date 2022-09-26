<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    protected $fillable = [
        'name', 'image','email','password','mobile','address','pin','lat','lon','description','service_description','opening_hour','website','facebook_link','twitter_link','instagram_link','url','public_holiday','status'
    ];
    public function category() {
        return $this->belongsTo('App\Models\DirectoryCategory', 'category_id', 'id');
    }
    public function pin() {
        return $this->belongsTo('App\Models\PinCode', 'pin', 'id');
    }
    public static function insertData($data, $count, $successArr, $failureArr) {
        $value = DB::table('directories')->where('name', $data['name'])->get();
        if($value->count() == 0) {
           DB::table('directories')->insert($data);
            array_push($successArr, $data['name']);
            $count++;
        } else {
            array_push($failureArr, $data['name']);
        }

        // return $count;

        $resp = [
            "count" => $count,
            "successArr" => $successArr,
            "failureArr" => $failureArr
        ];
        return $resp;
    }
}
