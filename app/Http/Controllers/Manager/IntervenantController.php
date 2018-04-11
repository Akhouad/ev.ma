<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Event;

class IntervenantController extends Controller
{
    public function index($id){
        abort_if(! Auth::user()->is_organizer, 404);
        $event = Event::where('id', $id)->first();
        $pending_events = Event::where('status', 'pending')->get();
        return view('manager.events.intervenants', compact('event', 'pending_events'));
    }
}
