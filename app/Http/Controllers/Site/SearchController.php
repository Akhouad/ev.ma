<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\City;

class SearchController extends Controller
{
    public function index(){
        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        $cities = City::get();
        return view('site.search', compact('categories', 'footer_cities', 'cities'));
    }
}
