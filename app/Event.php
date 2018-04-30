<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function type(){
        return $this->belongsTo('App\Type');
    }

    public function venue(){
        return $this->belongsTo('App\Venue');
    }

    public function organizer(){
        return $this->belongsTo('App\Organizer');
    }

    public function tags(){
        return $this->hasMany('App\EventTags');
    }

    public function categories(){
        return $this->hasMany('App\EventCategory');
    }

    public function interventions(){
        return $this->hasMany('App\Intervention');
    }

    public static function publish($id){
        $event = Event::where('id', $id)->first();
        $event->status = "published";
        $event->save();
    }

    public static function unpublish($id){
        $event = Event::where('id', $id)->first();
        $event->status = "pending";
        $event->save();
    }

    public function options(){
        return $this->hasMany('App\EventsOption');
    }

    public function images(){
        return $this->hasMany('App\Image');
    }

    public function schedules(){
        return $this->hasMany('App\Schedule');
    }

    public function city(){
        return $this->belongsTo('App\City');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function attendings(){
        return $this->hasMany('App\Attending');
    }

    public function checkins(){
        return $this->hasMany('App\Checkin');
    }
}
