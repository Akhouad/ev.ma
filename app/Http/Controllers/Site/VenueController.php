<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Venue;
use App\Event;
use App\Category;
use App\City;

class VenueController extends Controller
{
    public function index(Request $request){
        $venue = Venue::where('slug', $request->slug)->first();
        $results['events'] = [];

        $used_events = [];
        foreach($venue->events as $e){
            if(in_array($e->id, $used_events)) { continue; }
            $used_events[] = $e->id;
            $event = Event::join('venues', 'venues.id', '=', 'events.venue_id')
                ->join('cities', 'venues.city_id', '=', 'cities.id')
                ->select(
                    'venues.id AS venues_id', 'events.id AS id',
                    'events.slug AS slug',
                    'events.name as name', 'events.start_timestamp AS start_timestamp', 
                    'cities.name AS city', 'events.cover AS cover')
                ->where('events.deleted_at', null)
                ->where('events.status', 'published')
                ->where('events.id', $e->id)
                ->first();  
                
            if($event != null) {
                $results['events'][] = $event; 
                
                if($event->start_timestamp == '0000-00-00 00:00:00'){
                    $options = EventsOption::where('event_id', $event->id)->where('label', 'recurrent')->first();
                    $options = unserialize($options->value);
                    $start_time = $options['time_from'];
                    $start_date = $options['date_from'];
                    $event->start_timestamp = date('Y-m-d H:i:s', strtotime("$start_date $start_time") );
                }
            }
        }
        
        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        return view('site.home', compact('categories', 'footer_cities', 'results'));        
    }
}
