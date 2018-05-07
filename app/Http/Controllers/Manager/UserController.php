<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Intervention;

class UserController extends Controller
{
    public function register_intervenant($event_id, Request $request){
        $data = $request->input();
        $user = new User();
        $user->fullname = $data['fullname'];
        $user->email = $data['email'];
        $user->username = explode('@', $data['email'])[0];
        $user->is_speaker = (isset($intervenant)) ? 1 : 0;
        $user->save();
        $intervention = new Intervention();
        $intervention->user_id = $user->id;
        $intervention->event_id = $event_id;
        $intervention->save();
        return redirect(route('event-intervenants', ['id' => $event_id]));
    }

    public function index(Request $request, $user_id, $contains){
        if($request->ajax()){
            $users = User::where('id', '!=', $user_id)
                ->where('fullname', 'like', '%' . $contains . '%')
                ->orderBy('fullname', 'asc')
                ->get();
            return response($users, 200)->header('Content-Type', 'text/plain');
        }
    }

    public function get(){
        $users = User::get();
        return response($users, 200)->header('Content-Type', 'text/plain');
    }
}
