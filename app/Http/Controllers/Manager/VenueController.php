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
}
