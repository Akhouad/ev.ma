<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function event(){
        return $this->belongsTo('App\Event');
    }

    public function intervention(){
        return $this->hasOne('App\Intervention', 'user_id', 'intervenant');
    }
}
