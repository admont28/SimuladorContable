<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Request;
use Closure;
use Session;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next)
    {
        if($request->input('_token'))
        {
            if ( \Session::token() != $request->input('_token'))
            {
                \Log::error("Sesión expirada, redirigiendo.");
                flash('Tu sesión ha expirado. Por favor inténtalo nuevamente.')->warning();
                return redirect()->back()->withInput(Input::except('_token'))->withErrors($errors);
            }
        }
        return parent::handle($request, $next);
    }
}
