<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Event;
use App\Intervention;

class IntervenantController extends Controller
{
    public function index(Request $request, $id){
        if( $request->ajax() ) {
            $intervenants = (new Intervention())->getIntervenants($id);
            return response($intervenants, 200)->header('Content-Type', 'text/plain');
        }

        $event = Event::where('id', $id)->first();
        $pending_events = Event::where('status', 'pending')->get();
        return view('manager.events.intervenants', compact('event', 'pending_events'));
    }

    public function store(Request $request){
        $i = Intervention::where('event_id', $request->post('event_id'))
            ->where('user_id', $request->post('user_id'))
            ->first();


        $intervention = new Intervention();
        
        if($i == null){
            $intervention->user_id = $request->post("user_id");
            $intervention->event_id = $request->post('event_id');
            $intervention->save();
            return $this->index($request, $request->post('event_id'));
        }
        else{
            return $this->index($request, $request->post('event_id'));
        }
    }

    public function destroy(Request $request, $event_id, $user_id){
        Intervention::where('user_id', $user_id)->where('event_id', $event_id)->delete();
        return $this->index($request, $event_id);
    }
}
