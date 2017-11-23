<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use database\connectors\ManagerData;

Route::get('/', function () {
    $results = \database\connectors\ScrollimageData::getCurrentImages();
    return view('home', ['images'=>$results]);
});

Route::get('/course', function () {
    $results = \database\connectors\ScrollimageData::getCurrentImages();
    return view('course', ['images'=>$results]);
});

Route::get('/video', function () {
    $results = \database\connectors\ScrollimageData::getCurrentImages();
    return view('video', ['images'=>$results]);
});

Route::get('/quiz', function () {
    $results = \database\connectors\ScrollimageData::getCurrentImages();
    return view('quiz', ['images'=>$results]);
});