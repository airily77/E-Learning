<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(Auth::guard('users')->check()){
            return $next($request);
        }else{
            dd(Auth::guard('users')->check(),Auth::guard('managers')->check(),Auth::guard('users')->id());
        }
    }
}
