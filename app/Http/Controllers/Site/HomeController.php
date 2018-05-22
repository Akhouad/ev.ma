<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\City;
use App\Event;
use App\User;
use App\Organizer;
use App\Site\Search;

class HomeController extends Controller
{
    public function index(Request $request){
        $categories = Category::get();
        $footer_cities = City::where('prior', 1)->get();
        $key = $request->get('search');

        if($key && strlen($key) > 0){
            
            if($request->get('advanced') == 'true'){
                $validatedData = $request->validate([
                    'search' => 'required|max:255',
                    'category' => 'required|exists:categories,id',
                    'city' => 'required|exists:cities,id',
                    'start_date' => 'nullable|date',
                    'end_date' => 'nullable|required_with:start_date|date|after:start_date'
                ]);
            }
            
            $results = Search::search($request);
            return view('site.home', compact('categories', 'footer_cities', 'results'));        
        }

        return view('site.home', compact('categories', 'footer_cities'));
    }

    public static function formatDate($date){
        $months = ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'];
        $m = date('m', strtotime($date));
        $m = $months[$m - 1];
        return date('d', strtotime($date)) . ' ' . $m;
    }
}
