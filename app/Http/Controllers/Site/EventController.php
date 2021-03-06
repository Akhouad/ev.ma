<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Category;
use App\City;
use App\Attending;
use Auth;
use App\EventsOption;

class EventController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            if($request->type != null){
                if($request->type == 'now' || $request->type == 'coming'){
                    $operator = ($request->type == 'now') ? '=' : '>';
                    $events = Event::join('venues', 'venues.id', '=', 'events.venue_id')
                                ->join('cities', 'venues.city_id', '=', 'cities.id')
                                ->select(
                                    'venues.id AS venues_id', 'events.id AS id',
                                    'events.slug AS slug',
                                    'events.name as name', 'events.start_timestamp AS start_timestamp', 
                                    'cities.name AS city', 'events.cover AS cover')
                                ->where('events.deleted_at', null)
                                ->where('events.status', 'published')
                                ->whereDate('events.start_timestamp', $operator, \Carbon::today()->toDateString())
                                ->get();
                }else if($request->type == 'near'){
                    $events = Event::join('venues', 'venues.id', '=', 'events.venue_id')
                                ->join('cities', 'venues.city_id', '=', 'cities.id')
                                ->select(
                                    'venues.id AS venues_id', 'events.id AS id',
                                    'events.slug AS slug',
                                    'events.name as name', 'events.start_timestamp AS start_timestamp', 
                                    'cities.name AS city', 'events.cover AS cover')
                                ->where('events.deleted_at', null)
                                ->where('events.status', 'published')
                                ->where('cities.id', Auth::user()->city->id)
                                ->get();
                }
            }else{
                $events = Event::join('venues', 'venues.id', '=', 'events.venue_id')
                            ->join('cities', 'venues.city_id', '=', 'cities.id')
                            ->select(
                                'venues.id AS venues_id', 'events.id AS id',
                                'events.slug AS slug',
                                'events.name as name', 'events.start_timestamp AS start_timestamp', 
                                'cities.name AS city', 'events.cover AS cover')
                            ->where('events.deleted_at', null)
                            ->where('events.status', 'published')
                            ->get();
            }

            foreach($events as $e){
                if($e->start_timestamp == '0000-00-00 00:00:00'){
                    $options = EventsOption::where('event_id', $e->id)->where('label', 'recurrent')->first();
                    $options = unserialize($options->value);
                    $start_time = $options['time_from'];
                    $start_date = $options['date_from'];
                    $e->start_timestamp = date('Y-m-d H:i:s', strtotime("$start_date $start_time") );
                }
            }
            return response($events, 200)->header('Content-Type', 'text/json');
        }
    }

    public function show($slug, $event_id){
        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        $event = Event::where('id', $event_id)->where('slug', $slug)->first();
        if($event->start_timestamp == '0000-00-00 00:00:00'){
            $options = EventsOption::where('event_id', $event->id)->where('label', 'recurrent')->first();
            $options = unserialize($options->value);
            $start_time = $options['time_from'];
            $start_date = $options['date_from'];
            $event->start_timestamp = date('Y-m-d H:i:s', strtotime("$start_date $start_time") );
        }
        return view('site.event', compact('event', 'footer_cities', 'categories'));
    }

    public function book(Request $request){
        $data = $request->post();
        Attending::create(Auth::id(), $request);
        return redirect(route('event-page', ['id' => $request->id, 'slug' => $request->slug]));
    }

    public function latest(Request $request, $limit){
        if($request->ajax()){
            $events = Event::join('venues', 'venues.id', '=', 'events.venue_id')
                        ->join('cities', 'venues.city_id', '=', 'cities.id')
                        ->leftJoin('events_options', 'events_options.event_id', 'events.id')
                        ->select(
                            'venues.id AS venues_id', 'events.id AS id',
                            'events.slug AS slug',
                            'events.name as name', 'events.start_timestamp AS start_timestamp', 
                            'cities.name AS city', 'events.cover AS cover',
                            'events_options.value AS option')
                        ->distinct()
                        ->limit($limit)
                        ->orderByDesc('events.created_at')
                        ->get();
                        
            foreach($events as $e){
                if( $e->option != null ){
                    $e->option = json_encode(unserialize($e->option));
                }
            }
            return response($events, 200)->header('Content-Type', 'text/plain');   
        }
    }

    public function nearest(Request $request, $city, $limit){
        if($request->ajax()){
            $events = Event::join('venues', 'venues.id', '=', 'events.venue_id')
                        ->join('cities', 'venues.city_id', '=', 'cities.id')
                        ->leftJoin('events_options', 'events_options.event_id', 'events.id')
                        ->select(
                            'venues.id AS venues_id', 'events.id AS id',
                            'events.slug AS slug',
                            'events.name as name', 'events.start_timestamp AS start_timestamp', 
                            'cities.name AS city', 'events.cover AS cover',
                            'events_options.value AS option')
                        ->where('cities.slug', $city)
                        ->distinct()
                        ->limit($limit)
                        ->orderByDesc('events.created_at')
                        ->get();
                        
            foreach($events as $e){
                if( $e->option != null ){
                    $e->option = json_encode(unserialize($e->option));
                }
            }
            return response($events, 200)->header('Content-Type', 'text/plain');   
        }
    }
}
