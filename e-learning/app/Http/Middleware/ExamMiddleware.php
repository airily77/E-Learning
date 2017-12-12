<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ExamMiddleware{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(!Auth::guard('users')->check()){
            return redirect()->intended('/');
        }else if (Auth::guard('users')->check()){
            return $next($request);
        }
    }
}
