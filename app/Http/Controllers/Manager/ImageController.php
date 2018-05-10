<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Image;
use Session;
use Illuminate\Support\Facades\Input;

class ImageController extends Controller
{
    public function index($id){
        $pending_events = Event::where('status', 'pending')->get();
        $event = Event::where('id', $id)->first();
        return view('manager.events.images', compact('pending_events', 'event'));
    }

    public function store(Request $request, $event_id){
        $validatedData = $request->validate([
            'images.*' => 'required|image|max:1000000'
        ]);

        $data = $request->images;
        if(!empty($data)){
            foreach($data as $img){
                $image = new Image();
                $filename = $image->storeImage($img);
                $image->setEventId($event_id);
            }
        }
        return redirect(route('event-images', ['id' => $event_id]));
    }

    public function delete(Request $request, $id){
        $data = $request->post();
        $images = explode(',', $data['images']);
        foreach($images as $image_id){
            $image = Image::where('id', $image_id)->first();
            $image->deleted_at = date("Y-m-d H:i:s");
            $image->save();
        }
        
        Session::flash('alert-class', 'alert-success');
        $message = (count($images) > 1) ? 'Images bien supprimées' : "Image bien supprimée";
        Session::flash('alert-message', $message);
        return redirect()->back();
        return redirect(route('event-images', ['id' => $id]));
    }
}
