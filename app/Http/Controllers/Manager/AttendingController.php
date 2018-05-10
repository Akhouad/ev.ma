<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use Auth;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;

class AttendingController extends Controller
{
    public function index($id){
        $pending_events = Event::where('status', 'pending')->get();
        $event = Event::where('id', $id)->first();
        return view('manager.events.attendings', compact('pending_events', 'event'));
    }

    public function download($id){
        $event = Event::where('id', $id)->where('organizer_id', Auth::user()->organizer->id)->first();
        $data = [];
        $data[] = ["Full name", "Username", "Email", "City"];
        foreach($event->attendings as $a){
            $data[] = [$a->user->fullname, $a->user->username, $a->user->email, $a->user->city->name];
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
        },rtrim($event->slug, ".xlsx")."-attendings.xlsx");
    }
}
