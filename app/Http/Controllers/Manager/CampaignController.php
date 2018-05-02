<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Campaign;
use Auth;

class CampaignController extends Controller
{
    public function index($id){
        $pending_events = Event::where('status', 'pending')->get();
        $event = Event::where('id', $id)
                        ->where('organizer_id', Auth::user()->organizer->id)
                        ->first();
        return view('manager.events.email', compact('pending_events', 'event'));
    }

    public function store(Request $request){
        $data = $request->input();
        if($data['campaign_id'] != null){
            $campaign = Campaign::where('id', $data['campaign_id'])->first();
        }else{
            $campaign = new Campaign();
        }
        
        $campaign->name = $data['campaign_title'];
        $campaign->subject = $data['subject'];
        $campaign->message = $data['message'];
        $campaign->send_to = $data['send_to'];
        // ---
        $campaign->send_count = 0;
        $campaign->delivered_count = 0;
        // ---
        $campaign->organizer_id = $data['organizer_id'];
        $campaign->event_id = $data['event_id'];
        $campaign->user_id = $data['user_id'];
        $campaign->ip_address = $request->ip();
        $campaign->save();
        
        return redirect(route('event-campaigns', ['id' => $data['event_id']]));
    }

    public function destroy($id, $campaign_id){
        $campaign = Campaign::where('id', $campaign_id)->first();
        $campaign->deleted_at = date("Y-m-d H:i:s");
        $campaign->save();
        return redirect(route('event-campaigns', ['id' => $id]));
    }
}
