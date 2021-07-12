<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categorys';
    protected $fillable = [
        'id','name','viewinnav','created_at','updated_at'
    ];
    public function product()
    {
        return $this->hasMany('App\Models\Product','product_id',"id");
    }
}
