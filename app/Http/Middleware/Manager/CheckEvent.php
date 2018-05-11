<?php

namespace App\Http\Middleware\Manager;

use Closure;
use Auth;

class CheckEvent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( !is_numeric($request->id) ) return abort(404, 'Evenement introuvable');
        $event = \App\Event::where('id', $request->id)->first();
        if($event == null) return abort(404, 'Evenement introuvable');
        if( Auth::user()->is_admin == 0 ){
            if($event->organizer->user_id != Auth::id())
                return abort(401, 'Evenement introuvable.');                
        }

        return $next($request);
    }
}
