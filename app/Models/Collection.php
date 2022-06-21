<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Collection extends Model
{
    protected $fillable = [
        'title', 'slug','short_description','status','bottom_content','description','pin_code','suburb_id','meta_title','meta_key','meta_description'
    ];

    public function suburb() {
        return $this->belongsTo('App\Models\Suburb', 'suburb_id', 'id');
    }

    public static function insertData($data) {
        $value = DB::table('collections')->where('title', $data['title'])->get();
        if($value->count() == 0) {
           DB::table('collections')->insert($data);
        }
    }
}

