<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table='profiles';
    protected $fillable = [
        'id','user_id','image','mobile','address','birthdate','aboutme','gender','created_at','updated_at'
    ];
    public function user()
    {
        return $this->belongsTo('App\User',"user_id","id");
    }
}
