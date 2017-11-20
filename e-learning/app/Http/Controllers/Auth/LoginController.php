<?php

namespace App\Http\Controllers\Auth;

use App\Extensions\UserDataProvider;
use App\Http\Controllers\Controller;
use App\User;
use database\connectors\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
    }
    //TODO When you are trying to log in it should create a log for failed logins as well. I can't find any failed logins in the database this could be an error.
    public function login(Request $request){
        $account = $request['account'];
        $password= $request['pw'];
        $userdata = ['account'=>$account,'password'=>$password];
        if(Auth::validate($userdata)){
            $user = new User;
            $user->account= $account;
            $user->password = $password;
            Auth::login($user,true);
            if(Auth::check()){
                return redirect()->intended('/course');
            }else{
                //TODO create a popup that something went wrong try again.
            }
        }else {
            //TODO create another popup that something went wrong try again.
        }
    }

}
