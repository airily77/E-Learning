<?php
/**
 * Created by PhpStorm.
 * User: s1500631
 * Date: 16.11.2017
 * Time: 14.56
 */

namespace App\Http\Controllers\Session;


class SessionController{
    public static function createNewUserSession($request,$useraccountname){
        $ip = $request->ip();
        $datetime = date_create()->format('Y-m-d H:i:s');
        $request->session()->put($ip,$useraccountname);
        $request->session()->put($ip,$datetime);
    }
    public static function checkExisitingSessions($request){
        $ip = $request->ip();
        if(!($request->session()->pull($ip)==NULL)) return true;
    }
    public static function pullFromSession($request){
        $ip = $request->ip();
        if(!($request->session()->pull($ip)==NULL)) return $request->session()->pull($ip);
    }
}