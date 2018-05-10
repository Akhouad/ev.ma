<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Venue;

class VenueController extends Controller
{
    public function index(Request $request, $city_id){
        if($request->ajax()){
            $venues = Venue::join('cities', 'cities.id', '=', 'venues.city_id')
                    ->where('venues.city_id', $city_id)
                    ->select('cities.lat AS city_lat', 'cities.lng AS city_lng', 'venues.*')
                    ->get();
            return response($venues, 200)->header('Content-Type', 'text/plain');
        }
    }

    public static function create($name, $postal_code, $city_id, $venue_lat, $venue_lng){
        $v = new Venue();
        $v->name = $name;
        $v->slug = str_slug($name, "-");
        $v->adress_1 = $postal_code;
        $v->city_id = $city_id;
        $v->lat = $venue_lat;
        $v->lng = $venue_lng;
        $v->save();
        return $v->id;
    }
}
