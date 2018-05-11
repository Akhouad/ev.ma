<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Intervention;
use Illuminate\Support\facades\Storage;

class UserController extends Controller
{

    public function index(Request $request, $user_id, $contains){
        if($request->ajax()){
            $users = User::where('id', '!=', $user_id)
                ->where('fullname', 'like', '%' . $contains . '%')
                ->orderBy('fullname', 'asc')
                ->get();
            return response($users, 200)->header('Content-Type', 'text/plain');
        }
    }

    // public static function create($request){
    //     $data = $request->input();
    //     $user = new User();
    //     $user->fullname = $data['fullname'];
    //     $user->email = $data['email'];
    //     $user->username = explode('@', $data['email'])[0];
    //     // check if username is not unique
    //     if( User::where('username', $user->username)->get() != null ){
    //         $user->username = $user->username . '_' . (User::orderBy('created_at', 'desc')->first())->id;
    //     }
    //     if($request->file()['avatar'] != null){
    //         $path = Storage::putFile('public/images/avatars', $request->file()['avatar']);
    //         $filename = str_replace('public/images/avatars/', '', $path);
    //         $user->avatar = $filename;
    //     }else{
    //         $user->avatar = substr($user->username, 0, 1) . '.png';
    //     }

    //     $user->is_speaker = (isset($intervenant)) ? 1 : 0;
    //     $user->save();
    //     return $user->id;
    // }
}
