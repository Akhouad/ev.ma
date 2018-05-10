<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Event;
use App\Intervention;
use App\Intervenant;
use App\User;

class IntervenantController extends Controller
{
    public function index(Request $request, $id){
        if($request->ajax()){
            $intervenants = Intervenant::get($id);
            return response()->json($intervenants);
        }
        
        $event = Event::where('id', $id)->first();
        $pending_events = Event::where('status', 'pending')->get();
        return view('manager.events.intervenants', compact('event', 'pending_events'));
    }

    public static function store(Request $request){
        $intervenant = new Intervenant();
        $intervenant->user_id = $request->post('user_id');
        $intervenant->deleted_at = null;
        $intervenant->save();

        UserController::enable_speaker($request->post('user_id'));
    }

    public function create($event_id, Request $request){
        $user_id = UserController::create($request);
        InterventionController::create($user_id, $event_id);
        $intervenant = new Intervenant();
        $intervenant->user_id = $user_id;
        $intervenant->save();
        return redirect(route('event-intervenants', ['id' => $event_id]));
    }

    public static function destroy($user_id){
        $intervenant = Intervenant::where('user_id', $user_id)->first();
        $intervenant->deleted_at = date('Y-m-d H:i:s');
        $intervenant->save();

        UserController::disable_speaker($user_id);
    }

    public static function is_deleted($user_id){
        $i = Intervenant::where('user_id', $user_id)->where('deleted_at', null)->first();
        return ($i != null) ? false : true;
    }

    public static function recover($user_id){
        $i = Intervenant::where('user_id', $user_id)->first();
        $i->deleted_at = null;
        $i->save();
    }
}
