<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Category;
use App\City;

class EventController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $events = Event::join('venues', 'venues.id', '=', 'events.venue_id')
                        ->join('cities', 'venues.city_id', '=', 'cities.id')
                        ->select(
                            'venues.id AS venues_id', 'events.id AS id',
                            'events.slug AS slug',
                            'events.name as name', 'events.start_timestamp AS start_timestamp', 
                            'cities.name AS city', 'events.cover AS cover')
                        ->get();
            return response($events, 200)->header('Content-Type', 'text/plain');
        }
    }

    public function show($slug, $event_id){
        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        $event = Event::where('id', $event_id)->where('slug', $slug)->first();
        return view('site.event', compact('event', 'footer_cities', 'categories'));
    }

    public function attend(Request $request){
        $data = $request->input();
        $attend_type = $data['attend-type'];
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
