<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function category(){
	    return $this->hasOne(DirectoryCategory::class, 'id', 'category_id');
	}
}