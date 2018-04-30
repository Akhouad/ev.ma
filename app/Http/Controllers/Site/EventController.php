<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Category;
use App\City;

class EventController extends Controller
{
    public function show($slug, $event_id){
        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        $event = Event::where('id', $event_id)->where('slug', $slug)->first();
        return view('site.event', compact('event', 'footer_cities', 'categories'));
    }

    public function attend(Request $request){
        $data = $request->input();
        $attend_type = $data['attend-type'];
    }
}
