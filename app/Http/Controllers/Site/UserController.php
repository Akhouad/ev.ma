<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index(Request $request, $city, $limit){
        if($request->ajax()){
            $users = User::join('cities', 'users.city_id', '=', 'cities.id')
                    ->where('cities.slug', '=', $city)
                    ->select('users.*')
                    ->limit($limit)
                    ->get();
            return response($users, 200)->header('Content-Type', 'text/plain');
        }
    }
}
