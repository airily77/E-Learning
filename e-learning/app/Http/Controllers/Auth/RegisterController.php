<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use database\connectors\UserData;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('managerdata');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    //TODO add user to course
    public function registerUser(Request $request){
        $password=$request->input('password');
        $pw2=$request->input('password2');
        if($password==$pw2){
            $account = $request->input('account');
            $username = $request->input('username');
            $department = $request->input('department');
            $status = $request->input('status');
            $position = $request->input('position');
            UserData::insertUser($account,$password,$status,$username,$department,$position);
            return view('management');
            //TODO alert successful
        }else{
            return view('register');
        }
    }
    public function registerView(){
        return view('register');
    }
}
