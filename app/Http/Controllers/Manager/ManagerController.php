<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Event;
use App\City;
use App\Organizer;
use Auth;

class ManagerController extends Controller
{
    public function index(){
        $organizer = Organizer::where('user_id', Auth::user()->id)->first();
        $events = Event::where("organizer_id", $organizer->id)->get();
        $pending_events = Event::where('status', 'pending')->get();
        return view('manager/home', compact('events', 'pending_events'));
    }

    public function validation(){
        $pending_events = Event::where('status', 'pending')->get();
        return view('manager/validation', compact('pending_events'));
    }
}
