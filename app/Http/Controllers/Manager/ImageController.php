<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Image;
use Illuminate\Support\Facades\Input;

class ImageController extends Controller
{
    public function index($id){
        $pending_events = Event::where('status', 'pending')->get();
        $event = Event::where('id', $id)->first();
        return view('manager.events.images', compact('pending_events', 'event'));
    }

    public function store($event_id){
        if(!empty(Input::file()["images"])){
            foreach(Input::file()['images'] as $img){
                $image = new Image();
                $filename = $image->storeImage($img);
                $image->setEventId($event_id);
            }
        }
        return redirect()->back();
    }

    public function delete($id){
        echo $id;
    }
}
