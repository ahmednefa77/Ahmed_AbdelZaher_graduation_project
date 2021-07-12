<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table='sliders';
    protected $fillable = [
        'id','image','title','text','created_at','updated_at'
    ];
}
