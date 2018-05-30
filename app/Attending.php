<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attending extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public static function create($user_id, $request){
        $attending = new Attending();
        $attending->user_id = $user_id;
        $attending->event_id = $request->id;
        $attending->ip_address = $request->ip();
        $attending->save();
    }
}
