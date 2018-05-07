<?php

namespace App\Http\Middleware\Manager;

use Closure;
use Auth;

class CheckManager
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
        if(Auth::user()->is_organizer == 0){
            return redirect(route('homepage'));
        }
        
        return $next($request);
    }
}
