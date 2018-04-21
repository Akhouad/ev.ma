<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEvent;
use App\Http\Requests\EditEvent;
use App\Category;
use App\Type;
use App\Event;
use App\EventCategory;
use App\EventTags;
use App\Tag;
use App\Image;
use App\EventsOption;
use App\City;
use App\Venue;
use App\Organizer;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;


class EventController extends Controller
{
    public function add_index(){
        abort_if(! Auth::user()->is_organizer, 404);
        $categories = Category::get();
        $types = Type::get();
        $pending_events = Event::where('status', 'pending')->get();
        $cities = City::orderBy('name')->get();
        return view('manager.events.add', compact('categories', 'types', 'pending_events', 'cities'));
    }

    public function index($id){
        abort_if(! Auth::user()->is_organizer, 404);
        $pending_events = Event::where('status', 'pending')->get();
        $event = Event::where('id', $id)->where('organizer_id', Auth::user()->organizer->id)->firstOrFail();
        return view('manager.events.event', compact('pending_events', 'event'));
    }

    public function edit_index($id){
        abort_if(! Auth::user()->is_organizer, 404);
        $categories = Category::get();
        $types = Type::get();
        $pending_events = Event::where('status', 'pending')->get();
        $event = Event::where('id', $id)->where('organizer_id', Auth::user()->organizer->id)->firstOrFail();
        $tmp = EventCategory::where('event_id', $id)->select('category_id')->get();
        $event_categories = [];
        foreach($tmp as $t){ $event_categories[] = $t->category_id; }
        $venue = Venue::where('id', $event->venue_id)->first();
        $cities = City::orderBy('name')->get();
        $event_options = EventsOption::where('event_id', $id)->where('label', 'recurrent')->first();
        return view('manager.events.edit', compact('categories', 'types', 'pending_events', 'event', 'event_categories', 'cities', 'venue', 'event_options'));
    }

    public function store(StoreEvent $request){
        $data = $request->input();
        $e = new Event();
        
        if(!empty($request->file()["cover_original"])){
            $image = new Image();
            $filename = $image->storeImage($request->file()["cover_original"]);
            $e->cover = $filename;
            $e->cover_original = Input::file()["cover_original"]->getClientOriginalName();
        }
        
        $e->name = $data['name'];
        $e->slug = str_slug($data['name'], '-');
        $e->description = $data['description'];
        $e->youtube_url = $data['youtube_url'];
        
        // FIXED DATE
        if(isset($data['start_date']) && isset($data['end_date'])){
            $start_date = $data['start_date'];
            $start_time = $data['start_time'];
            $e->start_timestamp = date('Y-m-d H:i:s', strtotime("$start_date $start_time") );

            $end_date = $data['end_date'];
            $end_time = $data['end_time'];
            $e->end_timestamp = date('Y-m-d H:i:s', strtotime("$end_date $end_time") );
        }

        $e->type_id = $data['type_id'];
        $e->access_type = $data['access_type'];
        $e->tickets_url = $data['tickets_url'];
        $e->email = $data['email'];
        $e->website = $data['website'];
        $e->phone = $data['phone'];
        // $e->schedule
        // $e->is_sponsored
        // $e->is_editor_choice
        $e->organizer_id = Organizer::where('user_id', Auth::user()->id)->first()->id;
        $e->youtube = $data['youtube'];
        $e->facebook = $data['facebook'];
        $e->twitter = $data['twitter'];
        $e->is_organizer_owner = 1;
        $e->status_date = date("dd/mm/Y");
        $e->status = $data['submit'] == 'Publier' ? 'pending' : 'draft';
        
        // ADD VENUE
        if( empty($data['venue']['id']) ){
            $v = new Venue();
            $v->add($data['venue']['name'], $data['venue']['adress_1'], $data['venue']['city_id'], $data['venue']['lat'], $data['venue']['lng']);
            $e->venue_id = $v->id;
        }
        else $e->venue_id = $data['venue']['id'];

        $e->save();
        
        // RECURRENT
        if( isset($data['recurrent']) ){
            $options = [];

            $options['label'] = "recurrent";
            $options['value']['time_from'] = $data['recurrent']['time']['from'];
            $options['value']['time_to'] = $data['recurrent']['time']['to'];
            $options['value']['date_from'] = $data['recurrent']['date']['from'];
            $options['value']['date_to'] = $data['recurrent']['date']['to'];

            // weekly
            if( isset($data['recurrent']['weekly']) ){
                $options['value']['type'] = 'weekly';
                $options['value']['weekday'] = $data['recurrent']['weekly'];
            }
            // monthly
            else if( isset($data['recurrent']['monthly']) ){
                $options['value']['type'] = 'monthly';

                // day number
                if( isset($data['recurrent']['monthly']['day_number']) ){
                    $options['value']['monthly_type'] = 'day_number';
                    $options['value']['monthly']['day_number'] = $data['recurrent']['monthly']['day_number'];
                }
                // week number
                else if( isset($data['recurrent']['monthly']['week_number']) ){
                    $options['value']['monthly_type'] = 'week_number';
                    $options['value']['monthly']['week_number'] = $data['recurrent']['monthly']['week_number'];
                    $options['value']['monthly']['day'] = $data['recurrent']['monthly']['day'];
                }
            }else{
                $options['value']['type'] = 'daily';
            }

            $event_option = new EventsOption();
            $event_option->event_id = $e->id;
            $event_option->label = $options['label'];
            $event_option->value = serialize($options['value']);
            $event_option->save();
        }
        
        // ADD CATEGORIES
        if(isset($data['categories']) && count($data['categories']) > 0){
            $categories = [];
            foreach($data['categories'] as $category){
                $cat = new EventCategory(['category_id' => $category, 'event_id' => $e->id]);
                $categories[] = $cat;
            }
            $e->categories()->saveMany($categories);
        }

        // ADD EVENT OPTIONS
        if(!empty($data['plan']['date'])){
            $eo = new EventsOption();
            $eo->event_id = $e->id;
            $eo->label = "queued";
            $eo->value = date('Y-m-d', strtotime($data['plan']['date']));
            $eo->save();
        }

        // EDIT EVENT ID IN IMAGES TABLE
        if(!empty($request->file()["cover_original"])) $image->setEventId($e->id);

        // ADD TAGS
        $tags = new EventTags();
        $tags->addTags($data['tags'], $e->id);
        
        Session::flash('alert-class', 'alert-success');         
        Session::flash('alert-message', 'Èvènement bien ajouté!');         
        return redirect(route('manager'));
    }

    public function update($id, Request $request){
        $event = Event::where('id', $id)->where('organizer_id', Auth::user()->organizer->id)->firstOrFail();
        $venue = Venue::where('id', $event->venue_id)->first();
        $data = $request->input();

        if(!empty($request->file()["cover_original"])){
            $image = Image::where('event_id', $event->id)->first();
            $filename = $image->storeImage($request->file()["cover_original"]);
            $event->cover = $filename;
            $event->cover_original = Input::file()["cover_original"]->getClientOriginalName();
        }

        $event->name = ($event->name !== $data['name']) ? $data['name'] : $event->name;
        $event->slug = ($event->slug !== $data['slug']) ? $data['slug'] : $event->slug;
        $event->description = ($event->description !== $data['description']) ? $data['description'] : $event->description;
        $event->description = ($event->description !== $data['description']) ? $data['description'] : $event->description;

        // RECURRENT
        if( isset($data['recurrent']) ){
            $options = $event->options;
            foreach($options as $o){
                if($o->label == 'recurrent'){
                    $options_value = unserialize($o->value);
                    // dd($options, $data);
                    $options_value['time_from'] = ($options_value['time_from'] !== $data['recurrent']['time']['from']) ? $data['recurrent']['time']['from'] : $options_value['time_from'];
                    $options_value['time_to'] = ($options_value['time_to'] !== $data['recurrent']['time']['to']) ? $data['recurrent']['time']['to'] : $options_value['time_to'];
                    $options_value['date_from'] = ($options_value['date_from'] !== $data['recurrent']['date']['from']) ? $data['recurrent']['date']['from'] : $options_value['date_from'];
                    $options_value['date_to'] = ($options_value['date_to'] !== $data['recurrent']['date']['to']) ? $data['recurrent']['date']['to'] : $options_value['date_to'];
                    $options_value['type'] = (isset($data['recurrent']['monthly'])) ? 'monthly' : (isset($data['recurrent']['weekly']) ? 'weekly' : 'daily');

                    // weekly
                    if( isset($data['recurrent']['weekly']) ){
                        // dd($options_value, $data);
                        $options_value['weekday'] = $data['recurrent']['weekly']['day'];
                    }
                    // monthly
                    else if( isset($data['recurrent']['monthly']) ){
                        // day number
                        if( isset($data['recurrent']['monthly']['day_number']) ){
                            // dd($data, $options_value);
                            $options_value['monthly']['day_number'] = $data['recurrent']['monthly']['day_number'];
                        }
                        // week number
                        else if( isset($data['recurrent']['monthly']['week_number']) ){
                            $options_value['monthly']['week_number'] = $data['recurrent']['monthly']['week_number'];
                            $options_value['monthly']['day'] = $data['recurrent']['monthly']['day'];
                        }
                    }

                    // dd($options_value);
                    $o->value = serialize($options_value);
                    $o->save();
                }
            }
        }
        else{
            $start_date = $data['start_date'];
            $start_time = $data['start_time'];
            $event->start_timestamp = ($event->start_timestamp !== date('Y-m-d H:i:s', strtotime("$start_date $start_time")) ) ? date('Y-m-d H:i:s', strtotime("$start_date $start_time") ) : $event->start_timestamp;
            
            $end_date = $data['end_date'];
            $end_time = $data['end_time'];
            $event->end_timestamp = ($event->end_timestamp !== date('Y-m-d H:i:s', strtotime("$end_date $end_time")) ) ? date('Y-m-d H:i:s', strtotime("$end_date $end_time") ) : $event->end_timestamp;
        }

        $event->type_id = ($event->type_id !== $data['type_id']) ? $data['type_id'] : $event->type_id;
        $event->access_type = ($event->access_type !== $data['access_type']) ? $data['access_type'] : $event->access_type;
        $event->tickets_url = ($event->tickets_url !== $data['tickets_url']) ? $data['tickets_url'] : $event->tickets_url;

        $event->youtube_url = ($event->youtube_url !== $data['youtube_url']) ? $data['youtube_url'] : $event->youtube_url;
        $event->venue_id = ($event->venue_id !== $data['venue']['id']) ? $data['venue']['id'] : $event->venue_id;
        
        $event->email = ($event->email !== $data['email']) ? $data['email'] : $event->email;
        $event->phone = ($event->phone !== $data['phone']) ? $data['phone'] : $event->phone;
        $event->website = ($event->website !== $data['website']) ? $data['website'] : $event->website;
        $event->organizer_id = ($event->organizer_id !== Organizer::where('user_id', Auth::user()->id)->first()->id) ? Organizer::where('user_id', Auth::user()->id)->first()->id : $event->organizer_id;
        $event->facebook = ($event->facebook !== $data['facebook']) ? $data['facebook'] : $event->facebook;
        $event->twitter = ($event->twitter !== $data['twitter']) ? $data['twitter'] : $event->twitter;
        $event->youtube = ($event->youtube !== $data['youtube']) ? $data['youtube'] : $event->youtube;
        $event->save();
        return redirect()->back();
    }

    public function publishEvent($id){
        Event::publish($id);
        
        Session::flash('alert-class', 'alert-success');
        Session::flash('alert-message', 'Èvènement bien publié!');
        return redirect()->back();
    }

    public function unpublishEvent($id){
        Event::unpublish($id);
        
        Session::flash('alert-class', 'alert-success');
        Session::flash('alert-message', 'Vous venez de retirer la publication de cet événement!');
        return redirect()->back();
    }
}
