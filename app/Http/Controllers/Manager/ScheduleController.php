<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Intervention;
use App\Schedule;
use Auth;
use App\Http\Requests\StoreSchedule;

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
        $event = Event::where('id', $id)->first();
        return view("manager/events/schedule", compact('pending_events', 'event'));
    }

    public function create(StoreSchedule $request){
        $data = $request->input();
        $schedule = new Schedule();

        $date = $data['date'];
        $time = $data['time'];
        $schedule->time = date('Y-m-d H:i:s', strtotime("$date $time") );

        $schedule->event_id = $data['event_id'];
        $schedule->title = $data['title'];
        $schedule->description = $data['description'];
        $schedule->intervenant = isset($data['intervenant']) ? $data['intervenant'] : null;
        $schedule->save();

        return redirect(route('event-programme', ['id' => $data['event_id']]));
    }
    
    public function destroy($id, $schedule_id){
        $schedule = Schedule::where('id', $schedule_id)->first();
        $schedule->deleted_at = date("Y-m-d H:i:s");
        $schedule->save(); 
        return redirect(route('event-programme', ['id' => $id]));
    }
}
