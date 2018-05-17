<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;

class TypeController extends Controller
{
    public function index(Request $request, $limit){
        if($request->ajax()){
            $types = Type::get()->sortByDesc(function($type){
                        return $type->events->count();
                    });
            $types = array_slice($types->toArray(), 0, $limit, true);
            return response($types, 200)->header('Content-Type', 'text/json');
        }
    }
}
