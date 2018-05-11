<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Intervenant extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public static function create($event_id, $user_id){
        $intervenant = new Intervenant();
        $intervenant->user_id = $user_id;
        $intervenant->save();
    }

    public static function store($user_id){
        $intervenant = new Intervenant();
        $intervenant->user_id = $user_id;
        $intervenant->save();
    }
    
    public static function destroy($user_id){
        $intervenant = Intervenant::where('user_id', $user_id)->first();
        $intervenant->deleted_at = date('Y-m-d H:i:s');
        $intervenant->save();
    }
    
    public static function get($event_id){
        return Intervention::join('users', 'users.id', '=', 'interventions.user_id')
                        ->orderBy('interventions.created_at', 'desc')
                        ->where('interventions.event_id', $event_id)
                        ->where('interventions.deleted_at', null)
                        ->get();
    }
}
