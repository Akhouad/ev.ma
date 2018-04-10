<?php

namespace App\Http\Controllers\Manager;
use App\Venue;
use App\User;
use App\Intervention;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function getVenues($city_id){
        $venues = Venue::join('cities', 'cities.id', '=', 'venues.city_id')
                        ->where('venues.city_id', $city_id)
                        ->select('cities.lat AS city_lat', 'cities.lng AS city_lng', 'venues.*')
                        ->get();
        return response($venues, 200)->header('Content-Type', 'text/plain');
    }

    public function getUsers($user_id, $contains){
        $users = User::where('id', '!=', $user_id)
                        ->where('fullname', 'like', '%' . $contains . '%')
                        ->orderBy('fullname', 'asc')
                        ->get();
        return response($users, 200)->header('Content-Type', 'text/plain');
    }

    public function addIntervenant($event_id, Request $request){
        $i = Intervention::where('event_id', $event_id)
                            ->where('user_id', $request->post('user_id'))->first();
        
        $intervention = new Intervention();
        if($i == null){
            $intervention->user_id = $request->post("user_id");
            $intervention->event_id = $event_id;
            $intervention->save();
            return $this->getIntervenants($event_id);
        }
        else{
            return $this->getIntervenants($event_id);
        }
    }

    public function getIntervenants($event_id){
        return response((new Intervention())->getIntervenants($event_id), 200)->header('Content-Type', 'text/plain');
    }

    public function deleteIntervenant($event_id, $user_id){
        Intervention::where('user_id', $user_id)->where('event_id', $event_id)->delete();
        return $this->getIntervenants($event_id);
    }
}
