<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    public function city(){
        return $this->belongsTo('App\City');
    }

    public function events(){
        return $this->hasMany('App\Event');
    }
}
