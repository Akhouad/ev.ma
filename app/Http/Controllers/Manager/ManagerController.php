<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Event;
use App\City;
use App\Organizer;
use Auth;

class ManagerController extends Controller
{
    private $events_count = 20;

    private function pending_events(){
        return Event::where('status', 'pending')->get();
    }
    public function index($events = null, $search_key = null){
        if($events == null)      
            $events = Event::where("organizer_id", Auth::user()->organizer->id)
                            ->orderBy('start_timestamp', 'asc')
                            ->paginate($this->events_count);
        $pending_events = $this->pending_events();
        return view('manager/home', compact('events', 'pending_events', 'search_key'));
    }

    public function validation($events = null, $search_key = null){
        if($events == null)
            $events = Event::where('status', 'pending')
                            ->orderBy('start_timestamp', 'asc')
                            ->paginate($this->events_count);
        $pending_events = $this->pending_events();
        return view('manager/validation', compact('events', 'pending_events', 'search_key'));
    }

    // methods below are used to search events

    public function show($events, $source, $search_key){
        if($source == 'validation') return $this->validation($events, $search_key);
        else return $this->index($events, $search_key);
    }

    public function search(Request $request){
        $validatedData = $request->validate([
            'recherche' => 'required|max:255'
        ]);

        $source = ($request->input('events-type') == 'validation') ? 'validation' : 'home' ;
        $search_key = $request->input('recherche');

        if($source == 'validation'){
            $events = Event::where('name', 'like', '%' . $search_key . '%')
                            ->where('status', 'pending')
                            ->orderBy('start_timestamp', 'asc')
                            ->paginate($this->events_count);
        }else{
            $events = Event::where('name', 'like', '%' . $search_key . '%')
                            ->orderBy('start_timestamp', 'asc')
                            ->where("organizer_id", Auth::user()->organizer->id)
                            ->paginate($this->events_count);
        }

        return $this->show($events, $source, $search_key);
    }
}
