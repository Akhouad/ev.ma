<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\User;

class ApiController extends Controller
{
    public function events(){
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

    public function usersByCity($city, $limit){
        $users = User::join('cities', 'users.city_id', '=', 'cities.id')
                        ->where('cities.slug', '=', $city)
                        ->limit($limit)
                        ->get();
        return response($users, 200)->header('Content-Type', 'text/plain');
    }
}
