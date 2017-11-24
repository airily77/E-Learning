<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
        */
    public function index(){
        $results = \database\connectors\ScrollimageData::getCurrentImages();
        return view('home', ['images'=>$results]);
    }

    public function __construct(){
        $this->middleware('web');
    }
}
