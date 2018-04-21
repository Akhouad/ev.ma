<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Intervention;
use Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $pending_events = Event::where('status', 'pending')->get();
        $event = Event::where('id', $id)->where('organizer_id', Auth::user()->organizer->id)->first();
        $intervenants = Intervention::where('event_id', $event->id)->get();
        return view("manager/events/schedule", compact('pending_events', 'event', 'intervenants'));
    }
}
