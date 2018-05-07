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

    public static function getIntervenants($event_id){
        return Intervention::join('users', 'users.id', '=', 'interventions.user_id')
                        ->orderBy('interventions.created_at', 'desc')
                        ->where('event_id', $event_id)->get();
    }
}
