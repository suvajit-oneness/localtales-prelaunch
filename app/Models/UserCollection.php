<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCollection extends Model
{
    protected $table = 'user_collections';

	protected $fillable = [
	   'user_id', 'collection_id'
	];

	//hasOne relation with Event Model
	public function collectionDetails(){
	      return $this->hasOne(Collection::class, 'id', 'collection_id');
	}
}
