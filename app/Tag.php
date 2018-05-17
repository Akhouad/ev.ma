<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function events(){
        return $this->belongsToMany('App\Event', 'event_tags');
    }

    public static function index(){
        return Tag::with('events')->get()->sortByDesc(function($tag){
            return $tag->events->count();
        });
    }
}
