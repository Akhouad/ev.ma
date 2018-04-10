<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    public function add($name, $postal_code, $city_id, $venue_lat, $venue_lng){
        $v->name = $name;
        $v->slug = str_slug($name, "-");
        $v->adress_1 = $postal_code;
        $v->city_id = $city_id;
        $v->lat = $venue_lat;
        $v->lng = $venue_lng;
        $v->save();
    }

    public function city(){
        return $this->belongsTo('App\City');
    }
}
