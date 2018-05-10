<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use Auth;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;

class CheckinController extends Controller
{
    public function index($id){
        $pending_events = Event::where('status', 'pending')->get();
        $event = Event::where('id', $id)->first();
        return view('manager.events.checkins', compact('pending_events', 'event'));
    }
    
    public function download($id){
        $event = Event::where('id', $id)->where('organizer_id', Auth::user()->organizer->id)->first();
        $data = [];
        $data[] = ["Full name", "Username", "Email", "City"];
        foreach($event->checkins as $c){
            $data[] = [$c->user->fullname, $c->user->username, $c->user->email, $c->user->city->name];
        }
        $data = collect($data);
        return Excel::download(new class($data) implements FromCollection{
            public function __construct($collection)
            {
                $this->collection = $collection;
            }
            public function collection()
            {
                return $this->collection;
            }
        },rtrim($event->slug, ".xlsx")."-checkins.xlsx");
    }
}
