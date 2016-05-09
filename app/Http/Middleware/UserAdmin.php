<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class UserAdmin
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
        if(!Auth::check() || Auth::user()->customer){
            abort(404);
        }

        return $next($request);
    }
}
