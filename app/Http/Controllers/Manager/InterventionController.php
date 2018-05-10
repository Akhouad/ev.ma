<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Event;
use App\Intervention;
use App\Intervenant;

class InterventionController extends Controller
{
    public function index(Request $request, $id){
        $intervenants = Intervenant::get($id);
        return response()->json($intervenants);
    }

    public function store(Request $request) {
        // Add validation
        // = user_id > required_unless no form data 
        // email, fullname 
        // check if he's a new intervenant
        
        // if user_id / user - User::find(userid)
        // else user - User::add
        // User->enableintervenant / Intervention.create 
        
        $check_new = Intervention::where('user_id', $request->post('user_id'))->get();
        if(count($check_new) == 0){
            IntervenantController::store($request);
        }

        // check if he's a deleted intervenant
        if( IntervenantController::is_deleted($request->post('user_id')) ){
            IntervenantController::recover($request->post('user_id'));
        }

        $i = Intervention::where('event_id', $request->post('event_id'))
            ->where('user_id', $request->post('user_id'))
            ->first();

        $intervention = new Intervention();
        
        if($i == null){
            $intervention->user_id = $request->post("user_id");
            $intervention->event_id = $request->post('event_id');
            $intervention->deleted_at = NULL;
            $intervention->save();
            return $this->index($request, $request->post('event_id'));
        }
        else{
            if($i->deleted_at != null){
                $i->deleted_at = null;
                $i->save();
                return $this->index($request, $request->post('event_id'));
            }

            return $this->index($request, $request->post('event_id'));
        }
    }
    
    public function destroy(Request $request, $event_id, $user_id){
        $i = Intervention::where('user_id', $user_id)->where('event_id', $event_id)->first();
        $i->deleted_at = date("Y-m-d H:i:s");
        $i->save();

        // check if this user is still a speaker
        $check_intervenant = Intervention::where('user_id', $user_id)->where('deleted_at', null)->get();
        if(count($check_intervenant) == 0){
            IntervenantController::destroy($user_id);
        }

        return $this->index($request, $event_id);
    }

    // called in intervenantController
    public static function create($user_id, $event_id){
        $intervention = new Intervention();
        $intervention->user_id = $user_id;
        $intervention->event_id = $event_id;
        $intervention->save();
    }
}
