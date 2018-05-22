<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use App\Event;
use App\Category;
use App\City;

class TagController extends Controller
{
    public function index(Request $request, $limit){
        if($request->ajax()){
            $tags = Tag::get()->sortByDesc(function($tag){
                        return $tag->events->count();
                    });
            $tags = array_slice($tags->toArray(), 0, $limit, true);
            return response($tags, 200)->header('Content-Type', 'text/json');
        }
    }
    
    public function show(Request $request){
        $tag = Tag::where('name', $request->tag)->first();
        $results['events'] = [];
        $used_events = [];
        foreach($tag->events as $e){
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
            if($event != null) 
                $results['events'][] = $event; 
        }
        
        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        return view('site.home', compact('categories', 'footer_cities', 'results'));        
    }
}
