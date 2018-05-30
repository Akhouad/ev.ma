<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\City;
use App\Event;

class CityController extends Controller
{
    public function index(){
        $categories = Category::get();
        $cities = City::orderBy('name')->get();
        $footer_cities = City::where('prior', 1)->get();
        return view('site.cities', compact('footer_cities', 'categories', 'cities'));
    }

    public function show($slug){
        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        $city = City::where('slug', $slug)->first();
        if(!isset($city)) return "404";

        $city_id = $city->id;
        $events = Event::join('venues', 'venues.id', '=', 'events.venue_id')
                    ->join('cities', 'cities.id', '=', 'venues.city_id')
                    ->where('venues.city_id', $city_id)
                    ->select(
                        'venues.id AS venues_id', 'events.id AS id',
                        'events.slug AS slug',
                        'events.name as name', 'events.start_timestamp AS start_timestamp', 
                        'cities.name AS city', 'events.cover AS cover')
                    ->where('events.deleted_at', null)
                    ->where('events.status', 'published')
                    ->get();
                    
        if(count($events) > 0){
            foreach($events as $e){
                $french_months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                                'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
                $e->start_timestamp = explode(' ', explode('-', $e->start_timestamp)[2])[0] . ' ' . $french_months[(int)explode('-', $e->start_timestamp)[1] - 1];
            }
            return view('site.city', compact('events', 'footer_cities', 'categories'));
        }else{
            return abort(401, 'Aucun événement sur cette ville.');
        }
    }
}
