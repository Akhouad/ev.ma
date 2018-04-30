<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    protected $fillable = ['category_id'];

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
