<?php

namespace App\Http\Controllers\Auth;

use App\Extensions\UserDataProvider;
use App\Http\Controllers\Controller;
use App\User;
use App\Extensions\Manager;
use database\connectors\UserData;
use database\connectors\ManagerData;
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
        $this->middleware('web');
    }
    //TODO When you are trying to log in it should create a log for failed logins as well. I can't find any failed logins in the database this could be an error.
    public function login(Request $request){
        $account = $request['account'];
        $password = $request['pw'];
        if($this->checkUser($account)) {
            return $this->loginUser($account,$password);
        }else if ($this->checkManager($account)){
            return $this->loginManager($account,$password);
        }
    }
    private function checkUser($account){
        return !is_null(UserData::getUserId($account));
    }
    private function checkManager($account){
        return !is_null(($manager=ManagerData::getManagerByAccount($account)));
    }
    private function loginUser($account,$password){
        $userdata = ['account' => $account, 'password' => $password];
        if (Auth::guard('users')->attempt($userdata)) {
            $user = new User;
            $user->account = $account;
            $user->password = $password;
            Auth::guard('users')->login($user);
            Auth::guard('users')->authenticate();
            if (Auth::guard('users')->check()) {
                session()->put('pekka',$password);
                return redirect()->intended('/course');
            } else {
                //TODO create a popup that something went wrong try again.
            }
        } else {
            //TODO create another popup that something went wrong try again.
        }
    }
    private function loginManager($account,$allegedPw){
        $userdata = ['account' => $account, 'password' => $allegedPw];
        if (Auth::guard('managers')->validate($userdata)) {
            $manager = new Manager;
            $manager->account = $account;
            $manager->password = $allegedPw;
            Auth::guard('managers')->login($manager, true);
            if (Auth::guard('managers')->check()) {
                return redirect()->intended('dosomethinghere');
                //TODO redirect to manager course page that differences from normal course page.
            }
        } else {
            //TODO create a popup that something went wrong try again.
        }
    }

}
