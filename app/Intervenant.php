<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervenant extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public static function get($event_id){
        return Intervention::join('users', 'users.id', '=', 'interventions.user_id')
                        ->orderBy('interventions.created_at', 'desc')
                        ->where('interventions.event_id', $event_id)
                        ->where('interventions.deleted_at', null)
                        ->get();
    }
}
