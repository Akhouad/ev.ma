<?php

namespace App\Site;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Event;
use App\User;
use App\Organizer;

class Search extends Model
{
    public static function search(Request $request){
        $key = $request->get('search');
        $results = [];

        if($request->get('advanced') == 'true'){
            $search_type = $request->get('search-type');
            $category = $request->get('category');
            $city = $request->get('city');
            $start_date = $request->get('start_date');
            $end_date = $request->get('end_date');

            if($search_type == 'event'){
                $results['events'] = Event::where('name', 'like', '%' . $key . '%')
                                            ->where('deleted_at', null)
                                            ->where('status', 'published')
                                            ->get();
                if($category != 'all' || $city != '109'){
                    $results['events'] = $results['events']->filter(function($e) use($category){
                        return ( $category != 'all' ) ? $e->categories->contains('category_id', $category) : true;
                    })->filter(function($e) use($city){
                        return ( $city != '109' ) ? $e->venue->city->id == $city : true;
                    });
                }
                $results['events'] = $results['events']->filter(function($e) use($start_date, $end_date){
                    $start = ($start_date != null) ? date('d-m-Y', strtotime($e->start_timestamp)) == date('d-m-Y', strtotime($start_date)) : true ;
                    $end = ($end_date != null) ? date('d-m-Y', strtotime($e->end_timestamp)) == date('d-m-Y', strtotime($end_date)) : true ;
                    return $start && $end;
                });
                
            }else if ($search_type == 'user'){
                $results['users'] = User::where('fullname', 'like', '%' . $key . '%')->get();
            }else if ($search_type == 'organizer'){
                $results['organizers'] = Organizer::where('name', 'like', '%' . $key . '%')->get();
            }

            return $results;
        }
        
        $results['events'] = Event::where('name', 'like', '%' . $key . '%')
                                    ->where('deleted_at', null)
                                    ->where('status', 'published')
                                    ->get();
        $results['users'] = User::where('fullname', 'like', '%' . $key . '%')->get();
        $results['organizers'] = Organizer::where('name', 'like', '%' . $key . '%')->get();
        return $results;
    }
}
