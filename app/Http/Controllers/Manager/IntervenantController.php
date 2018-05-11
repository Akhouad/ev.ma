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

    public function create($event_id, Request $request){
        $user = User::create($request);
        Intervenant::create($event_id, $user->id);
        Intervention::create($user->id, $event_id);
        return redirect(route('event-intervenants', ['id' => $event_id]));
    }
}
