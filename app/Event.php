<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function type(){
        return $this->hasOne('App\Type');
    }

    public function venue(){
        return $this->hasOne('App\Venue');
    }

    public function organizer(){
        return $this->hasOne('App\Organizer');
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
}
