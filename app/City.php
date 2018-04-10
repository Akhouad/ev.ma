<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function venues(){
        return $this->hasMany('App\Venue');
    }
}
