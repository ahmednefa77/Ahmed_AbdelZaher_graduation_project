<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table='offers';
    protected $fillable = [
        'id','product_id','quantity','price_before','price_after','created_at','updated_at'
    ];
    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id',"id");
    }
}
