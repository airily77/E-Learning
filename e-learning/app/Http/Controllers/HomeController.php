<?php

namespace App\Http\Controllers;

use database\connectors\ArticleData;
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
        $news  = ArticleData::getActiveArticles();
        return view('home', ['images'=>$results,'news'=>$news]);
    }

    public function __construct(){
        $this->middleware('web');
    }
}
