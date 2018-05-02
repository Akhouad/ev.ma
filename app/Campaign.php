<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public function event(){
        return $this->belongsTo('App\Event');
    }
}
