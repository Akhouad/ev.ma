<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Category;
use App\City;
use App\Type;
use App\Tag;

class CategoryController extends Controller
{
    public function index(Request $request, $limit = null){
        $cats = Category::with('events')->get()->sortByDesc(function($cat){
            return $cat->events->count();
        });

        if($request->ajax()){
            $cats = array_slice($cats->toArray(), 0, $limit, true);
            return response($cats, 200)->header('Content-Type', 'text/json');
        }

        $types = Type::index();
        $tags = Tag::index();

        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        return view('site.categories', compact('categories', 'footer_cities', 'types', 'tags', 'cats'));
    }

    public function show(Request $request){
        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        $category = Category::where('slug', $request->category)->first();
        $results['events'] = [];
        foreach($category->events as $e){ $results['events'][] = $e->event; }
        
        return view('site.home', compact('categories', 'footer_cities', 'results'));
    }
}
