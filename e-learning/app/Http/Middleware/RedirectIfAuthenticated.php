<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

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
    public function handle($request, Closure $next, $guard = null){
        if (Auth::guard()->check()) {
            return redirect($request->path());
        }
        if (Auth::guest() && $request->path().equalTo('login')){
            return $next($request);
        }
        return $next($request);
    }
}
