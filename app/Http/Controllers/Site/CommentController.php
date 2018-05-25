<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rating;
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request){
        $data = $request->input();
        if($data['rating'] != null){
            $rate = new Rating();
            $rate->user_id = $data['user_id'];
            $rate->event_id = $data['event_id'];
            $rate->rating = $data['rating'];
            $rate->ip_address = $request->ip();
            $rate->save();
        }

        $comment = new Comment();
        $comment->user_id = $data['user_id'];
        $comment->event_id = $data['event_id'];
        $comment->comment = $data['comment'];
        $comment->rating_id = ($data['rating'] != null) ? $rate->id : null;
        $comment->ip_address = $request->ip();
        $comment->save();

        return redirect(route('event-page', ['id' => $data['event_id'], 'slug' => $request->slug]));
    }

    public function report(Request $request){
        $data = $request->post();
        $comment = Comment::find($data['comment_id']);
        $comment->reported++;
        $comment->save();
        
        return redirect(route('event-page', ['id' => $request->id, 'slug' => $request->slug]));
    }
}
