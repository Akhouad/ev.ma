<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function events(){
        return $this->belongsToMany('App\Event');
    }

    public static function get_by_user_event($user_id, $event_id){
        return Intervention::where('event_id', $event_id)
                            ->where('user_id', $user_id)
                            ->where('deleted_at', null)
                            ->first();
    }

    public static function create($user_id, $event_id){
        $intervention = new Intervention();
        $intervention->user_id = $user_id;
        $intervention->event_id = $event_id;
        $intervention->deleted_at = NULL;
        $intervention->save();
    }
}
