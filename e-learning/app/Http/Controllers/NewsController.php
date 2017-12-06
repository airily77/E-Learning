<?php

namespace App\Http\Controllers;


class NewsController extends Controller{
    public function __construct(){
        $this->middleware('manager');
    }
    public function index(){
        return view('newspage');
    }
}