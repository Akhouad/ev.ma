<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Collection;
use Auth;
use Illuminate\Support\facades\Storage;

class CollectionController extends Controller
{
    private function pending_events(){
        return Event::where('status', 'pending')->get();
    }

    public function index(){
        $pending_events = $this->pending_events();
        $collections = Collection::where('user_id', Auth::id())
                        ->where('deleted_at', null)
                        ->get();
        return view('manager.collections', compact('pending_events', 'collections'));
    }

    // single collection page
    public function show(Request $request){
        $collection = Collection::find($request->id);
        $pending_events = $this->pending_events();
        $events = [];
        if($collection->events != null){
            foreach(unserialize($collection->events) as $ev_id){
                $events[] = Event::find($ev_id);
            }
        }   
        return view('manager.collection', compact('pending_events', 'collection', 'events'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|max:1000000',
            'description' => 'nullable|max:1000'
        ]);
        $data = $request->post();

        $collection = new Collection();
        $collection->name = $data['name'];
        $collection->slug = str_slug($data['name']);
        $collection->description = $data['description'];
        $collection->user_id = Auth::id();

        if(!empty($request->file())){
            $path = Storage::putFile('public/images/manager/collections', $request->file()['image']);
            $filename = str_replace('public/images/manager/collections/', '', $path);
            $collection->image = $filename;
        }

        $collection->save();
        return redirect(route('collections'));
    }

    public function update(Request $request){
        $data = $request->post();
        $events_ids = explode(',', $data['events']);
        $collection = Collection::find($data['collection_id']);

        if(isset($data['update-type']) && $data['update-type'] == 'delete'){
            $events = unserialize($collection->events);
            $new_events = [];
            foreach($events as $e){ if(!in_array($e, $events_ids)) $new_events[] = $e; }
            $collection->events = serialize($new_events);
        }else{
            if($collection->events == null){
                $collection->events = serialize($events_ids);
            }else{
                $events = unserialize($collection->events);
                foreach($events_ids as $event_id){ 
                    if(!in_array( $event_id, $events )){
                        $events[] = $event_id;
                    }
                }
                $collection->events = serialize($events);
            }
        }
        $collection->save();
        return redirect(route('collection', ['id' => $collection->id, 'slug' => $collection->slug]));
    }

    public function delete(Request $request){
        $collection = Collection::find($request->id);
        $collection->deleted_at = date('Y-m-d H:i:s');
        $collection->save();

        return redirect(route('collections'));
    }
}
