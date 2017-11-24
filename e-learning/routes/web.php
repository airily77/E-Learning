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

Route::group(['middleware' =>[ 'web']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/login','Auth\LoginController@Login');
});
Route::get('/video', function () {
    $results = \database\connectors\ScrollimageData::getCurrentImages();
    return view('video', ['images'=>$results]);
});
Route::get('/quiz','QuizController@index')->name('quiz');

Route::group(['middleware' => ['web','userdata']], function () {
    Route::get('/course','CourseController@course')->name('course');
});
Auth::routes();
