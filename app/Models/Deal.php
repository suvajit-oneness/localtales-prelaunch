<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'title', 'image', 'address', 'lat', 'lon', 'expiry_date', 'short_description', 'description', 'category_id', 'business_id', 'price', 'promo_code',  'how_to_redeem', 'status'
     ];

     //hasOne relation with Category Model
     public function category(){
         return $this->hasOne(Category::class, 'id', 'category_id');
     }

     //hasOne relation with Category Model
    //  public function business(){
    //      return $this->hasOne(BusinessLead::class, 'id', 'business_id');
    //  }
}
