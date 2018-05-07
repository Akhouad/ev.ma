<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Campaign;
use Auth;
use Mail;
use Session;
use App\Mail\CampaignMail;

class EmailController extends Controller
{
    public function store($id, $campaign_id){
        $campaign = Campaign::where('id', $campaign_id)->first();
        
        if($campaign->send_to == 0) // participants de cet evenement
        {
            foreach($campaign->event->checkins as $checkin){
                $mail_data = array('name'=> title_case($checkin->user->fullname), "body" => $campaign->message);
                
                Mail::send('emails.mail', $mail_data, function($message) use($checkin, $campaign) {
                    $message->to($checkin->user->email, $checkin->user->username)->subject($campaign->subject);
                    $message->from($campaign->event->organizer->user->email, '[Ev.ma] - ' . $campaign->event->organizer->user->fullname);
                });
            }
        }else // les participants de tous les evenements
        {
            $events = $campaign->event->organizer->events;
            $emails = [];

            foreach($events as $event){
                foreach($event->checkins as $checkin){
                    $emails[] = $checkin->user->email;
                }
            }

            Mail::to($emails)->queue(new CampaignMail($campaign->message));

            // $mail_data = array('name'=> title_case($checkin->user->fullname), "body" => $campaign->message);
            // Mail::send('emails.mail', $mail_data, function($message) use($checkin, $campaign) {
            //     $message->to($emails, $checkin->user->username)->subject($campaign->subject);
            //     $message->from($campaign->event->organizer->user->email, '[Ev.ma] - ' . $campaign->event->organizer->user->fullname);
            // });
        }
        
        Session::flash('alert-class', 'alert-success');         
        Session::flash('alert-message', 'Emails bien envoyés!'); 
        return redirect(route('event-campaigns', ['id' => $id]));
    }
}
