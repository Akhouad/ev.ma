<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Event;
use Auth;

class CommentController extends Controller
{
    public function index($id){
        $pending_events = Event::where('status', 'pending')->get();
        $event = Event::where('id', $id)->first();
        return view('manager.events.comments', compact('pending_events', 'event'));
    }

    public function destroy(Request $request, $id){
        $data = $request->input();
        $comments = explode(',', $data['comments_ids']);
        foreach($comments as $c){
            $comment = Comment::where('id', $c)->first();
            $comment->deleted_at = date("Y-m-d H:i:s");
            $comment->save();
        }
        return redirect(route('event-comments', ['id' => $id]));
    }
}
