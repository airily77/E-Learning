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
    Route::post('/login','Auth\LoginController@Login')->name('login');
    Route::post('/logout','Auth\LoginController@Logout')->name('logout');
    Route::post('/login','Auth\LoginController@Login');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/logout','Auth\LoginController@Logout');
});
Route::group(['middleware' => ['web','userdata']], function () {
    Route::get('/course','CourseController@course')->name('course');
    Route::get('/course/{coursetitle}','CourseController@specificCourse')->name('specific.course');
    Route::get('/course/video/{coursetitle}','CourseController@video')->name('video');
    Route::get('/exam/{coursetitle}/{examtitle}','ExamController@index')->name('exam');
    Route::post('/exam/postExam','ExamController@postExam')->name('postExam');
    Route::post('/course/content','CourseController@oneCourse')->name('getcourse');
});
Route::group(['middleware' => ['web','managerdata']], function () {
    Route::get('/news', 'NewsController@index')->name('newspage');
    Route::get('/exam/creation','ManagerController@examCreation')->name('examcreation');
    Route::get('/user/create','Auth\RegisterController@registerView')->name('register-view');
    Route::post('/user/create/post','Auth\RegisterController@registerUser')->name('create-user');
});
Auth::routes();
