<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class UserMiddleware{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = null){
        Auth::guard('users')->id();
        if( ! Auth::guard('users')->check()){
            dd('thank the ugly god');
            return redirect()->intended('/');
        }else{
            dd(Auth::guard('users'));
            return $next($request);
        }
    }
}
