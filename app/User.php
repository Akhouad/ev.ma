<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'fullname', 'city_id', 'organizer_id', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function organizer(){
        return $this->hasOne('App\Organizer');
    }

    public function city(){
        return $this->belongsTo('App\City');
    }

    public static function create($request){
        $data = $request->input();
        $user = new User();
        $user->fullname = $data['fullname'];
        $user->email = $data['email'];
        $user->username = explode('@', $data['email'])[0];
        // check if username is not unique
        if( count(User::where('username', $user->username)->get()) != 0 ){
            $user->username = $user->username . '_' . ((User::orderBy('created_at', 'desc')->first())->id + 1);
        }
        if(isset($request->file()['avatar'])){
            $path = Storage::putFile('public/images/avatars', $request->file()['avatar']);
            $filename = str_replace('public/images/avatars/', '', $path);
            $user->avatar = $filename;
        }else{
            $user->avatar = substr($user->username, 0, 1) . '.png';
        }
        
        $user->save();
        return $user;
    }
    
    public static function enable_speaker($user){
        $user->is_speaker = 1;
        $user->save();
    }

    public static function disable_speaker($user){
        $user->is_speaker = 0;
        $user->save();
    }
}
