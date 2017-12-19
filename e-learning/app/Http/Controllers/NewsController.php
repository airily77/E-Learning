<?php

namespace App\Http\Controllers;


use database\connectors\ArticleData;

class NewsController extends Controller{
    public function index($id){
        return view('newspage',['article'=>ArticleData::getArticle($id)]);
    }
}