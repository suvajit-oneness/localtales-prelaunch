<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Suburb extends Model
{
    protected $fillable = [
        'name', 'slug','pin_code', 'status'
    ];

    public function pincode() {
        return $this->belongsTo('App\Models\PinCode', 'pin_code', 'id');
    }

    public static function insertData($data) {
        $value = DB::table('suburbs')->where('name', $data['name'])->where('pin_code', $data['pin_code'])->get();
        if($value->count() == 0) {
           DB::table('suburbs')->insert($data);
        }
    }
}
