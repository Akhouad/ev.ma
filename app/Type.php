<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function events(){
        return $this->hasMany('App\Event');
    }

    public static function index(){
        return Type::with('events')->get()->sortByDesc(function($type){
            return $type->events->count();
        });
    }
}
