<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Extensions\UserDataProvider;
use App\User;
use App\Extensions\Manager;
use database\connectors\UserData;
use database\connectors\ManagerData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



public function index(){
    return view('admin');
}

}