<?php

namespace App\Http\Middleware\Manager;

use Closure;

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
        if(\App\Event::where('id', $request->id)->first() == null){
            return redirect(route('manager'));
        }

        return $next($request);
    }
}
