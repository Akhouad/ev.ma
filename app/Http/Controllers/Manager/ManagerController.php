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

    public function index(){      
        $events = Event::where("organizer_id", Auth::user()->organizer->id)->paginate($this->events_count);
        $pending_events = Event::where('status', 'pending')->get();
        return view('manager/home', compact('events', 'pending_events'));
    }

    public function validation(){
        $events = Event::where('status', 'pending')->paginate($this->events_count);
        $pending_events = Event::where('status', 'pending')->get();
        return view('manager/validation', compact('events', 'pending_events'));
    }

    public function show($events, $destination, $search_key){
        $pending_events = Event::where('status', 'pending')->get();
        return view('manager/' . $destination, compact('events', 'pending_events', 'search_key'));
    }

    public function search(Request $request){
        $validatedData = $request->validate([
            'recherche' => 'required|max:255'
        ]);
        $destination = (explode('/', $request->header('referer'))[4] != null) ? 'validation' : 'home' ;
        $search_key = $request->post('recherche');

        if($destination == 'validation'){
            $events = Event::where('name', 'like', '%' . $search_key . '%')
                            ->where('status', 'pending')
                            ->paginate($this->events_count);
        }else{
            $events = Event::where('name', 'like', '%' . $search_key . '%')
                            ->paginate($this->events_count);
        }

        return $this->show($events, $destination, $search_key);
    }
}
