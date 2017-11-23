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
        if( ! Auth::guard('users')->check()){
            return redirect()->intended('/');
        }else{
            return $next($request);
        }
    }
}
