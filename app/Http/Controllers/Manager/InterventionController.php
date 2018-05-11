<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Event;
use App\Intervention;
use App\Intervenant;
use App\User;

class InterventionController extends Controller
{
    public function index(Request $request, $id){
        if($request->ajax()){
            $intervenants = Intervenant::get($id);
            return response()->json($intervenants);
        }
        return (new IntervenantController)->index($request, $id);
    }

    public function store(Request $request) {
        // Add validation
        // = user_id > required_unless no form data 
        // email, fullname 
        // check if he's a new intervenant
        
        // if user_id / user - User::find(userid)
        // else user - User::add
        // User->enableintervenant / Intervention.create 

        $validatedData = $request->validate([
            'user_id' => 'required_without_all:fullname,email|max:255|exists:users,id',
            'fullname' => 'required_without:user_id|max:255',
            'email' => 'required_without:user_id|max:255|email'
        ]);
        if( $request->post('user_id') != null ){
            $user = User::find($request->post('user_id'));
            
            $existed = Intervention::get_by_user_event($user->id, $request->post('event_id'));
            if($existed != null) { 
                return $this->index($request, $request->post('event_id')); 
            }
        }else{
            $user = User::create($request);
            Intervenant::store($user->id);
        }
        User::enable_speaker($user);

        $i = Intervention::get_by_user_event($user->id, $request->post('event_id'));
        
        if($i == null || $i->deleted_at == null){
            Intervention::create($user->id, $request->post('event_id'));
        }
        
        return $this->index($request, $request->post('event_id'));
    }
    
    public function destroy(Request $request, $event_id, $user_id){
        $i = Intervention::where('user_id', $user_id)
            ->where('event_id', $event_id)
            ->where('deleted_at', null)
            ->first();
        $i->deleted_at = date("Y-m-d H:i:s");
        $i->save();

        // check if this user is still a speaker
        $check_intervenant = Intervention::where('user_id', $user_id)->where('deleted_at', null)->get();
        if(count($check_intervenant) == 0){
            Intervenant::destroy($user_id);
            $user = User::find($user_id);
            User::disable_speaker($user);
        }

        return $this->index($request, $event_id);
    }
}
