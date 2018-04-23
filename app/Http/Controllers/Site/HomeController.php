<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\City;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        return view('site.home', compact('categories', 'footer_cities'));
    }
}
