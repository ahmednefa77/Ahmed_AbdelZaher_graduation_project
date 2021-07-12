<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $fillable = [
        'id','name','price','sale','category_id','image','details','created_at','updated_at'
    ];
    public function category()
    {
        return $this->belongsTo('App\Models\Category',"category_id","id");
    }
    public function offer()
    {
        return $this->hasMany('App\Models\Offer','product_id','id');
    }
}
