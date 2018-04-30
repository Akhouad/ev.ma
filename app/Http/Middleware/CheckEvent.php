<?php

namespace App\Http\Middleware;

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
        if(\App\Event::where('id', $request->id)->where('slug', $request->slug)->first() == null){
            return redirect(route('homepage'));
        }

        return $next($request);
    }
}
