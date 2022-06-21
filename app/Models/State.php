<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name', 'slug', 'status'
    ];

    public static function insertData($data) {
        $value = DB::table('states')->where('name', $data['name'])->where('slug', $data['slug'])->get();
        if($value->count() == 0) {
           DB::table('states')->insert($data);
        }
    }

}
