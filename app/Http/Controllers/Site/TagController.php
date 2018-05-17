<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    public function index(Request $request, $limit){
        if($request->ajax()){
            $tags = Tag::get()->sortByDesc(function($tag){
                        return $tag->events->count();
                    });
            $tags = array_slice($tags->toArray(), 0, $limit, true);
            return response($tags, 200)->header('Content-Type', 'text/json');
        }
    }
}
