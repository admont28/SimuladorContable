<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->rol != "profesor"){
                return redirect()->route(Auth::user()->rol.'.index');
            }elseif(Auth::user()->rol != "estudiante"){
                return redirect()->route(Auth::user()->rol.'.index');
            }else{
                return redirect('/');
            }
        }

        return $next($request);
    }
}
