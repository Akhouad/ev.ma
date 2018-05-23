<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\City;
use Auth;
use Hash;
use Session;
use Storage;
use App\User;

class SettingsController extends Controller
{
    public function index(){
        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        $cities = City::get();
        return view('site.settings.index', compact('categories', 'footer_cities', 'cities'));
    }

    public function password(){
        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        return view('site.settings.password', compact('categories', 'footer_cities'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'fullname' => 'required|max:255|min:5',
            'email' => 'required|max:255|min:8|email',
            'username' => 'required|max:255|min:5',
            'birthday' => 'nullable|date',
            'city' => 'exists:cities,id',
            'avatar' => 'nullable|image|max:1000000'
        ]);
        $data = $request->post();

        // Check if email / password are not uniques
        $existed = [];
        $existed['email'] = User::where('email', $data['email'])->where('id', '!=', Auth::user()->id)->first();
        $existed['username'] = User::where('email', $data['username'])->where('id', '!=', Auth::user()->id)->first();
        foreach($existed as $key => $e){
            if($e != null){
                Session::flash('alert-class', 'alert-danger');
                Session::flash('alert-message', 'Veuillez entrer un ' . $key . ' unique.');
                return redirect(route('settings'));
            }
        }

        // if avatar is changed
        if(!empty($request->file()["avatar"])){
            $path = Storage::putFile('public/images/avatars', $request->file()['avatar']);
            $filename = str_replace('public/images/avatars/', '', $path);
        }
        
        $user = User::find(Auth::user()->id);
        $user->fullname = $data['fullname'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->birthday = ($data['birthday'] != null) ? date('Y-m-d', strtotime($data['birthday'])) : $user->birthday;
        $user->city_id = $data['city'];
        $user->avatar = (isset($filename)) ? $filename : $user->avatar;
        $user->save();

        Session::flash('alert-class', 'alert-success');
        Session::flash('alert-message', 'Votre compte a été modifié avec succés.');
        return redirect(route('settings'));
    }

    public function update_password(Request $request){
        $validatedData = $request->validate([
            'current' => 'required|max:255',
            'new' => 'required|max:255|min:8',
            'confirm' => 'required|max:255|min:8|same:new',
        ]);
        $data = $request->post();
        if(!Hash::check($data['current'], Auth::user()->password)){
            Session::flash('alert-class', 'alert-danger');
            Session::flash('alert-message', 'Veuillez entrer votre ancien mot de passe correctement.');
            return redirect(route('password-settings'));
        }
        $user = Auth::user();
        $user->password = Hash::make($data['new']);
        $user->save();
        
        Session::flash('alert-class', 'alert-success');
        Session::flash('alert-message', 'Votre mot de passe a ètè modifiè avec succés.');
        return redirect(route('password-settings'));
    }
}
