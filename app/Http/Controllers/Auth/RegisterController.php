<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\City;
use App\Category;
use App\Organizer;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(){
        $cities = City::orderBy('name')->get();
        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        return view('auth.register', compact('cities', 'categories', 'footer_cities'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => 'required|string|max:191',
            'username' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    /**
     * Where to redirect users after login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route('homepage');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = new User();
        $user->is_organizer = isset($data['organizer']) ? '1' : '0';
        $user->fullname = $data['fullname'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->avatar = substr($data['fullname'], 1, 1) . ".png";
        $user->city_id = $data['city'];
        $user->save();

        if(isset($data['organizer'])){
            $organizer = new Organizer();
            $organizer->user_id = $user->id;
            $organizer->name = $user->fullname;
            $organizer->slug = str_slug($user->fullname, '-');
            $organizer->email = $user->email;
            $organizer->avatar = $user->avatar;
            $organizer->save();
        }

        auth()->login($user);
        return $user;
    }
}
