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
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::post('/admin/login','Auth\LoginController@managerLogin')->name('managerLogin');
    Route::get('/article/{id}', 'NewsController@index')->name('newspage');
});
Route::group(['middleware' => ['web','userdata']], function () {
    Route::get('/course','CourseController@course')->name('course');
    Route::get('/course/{coursetitle}','CourseController@specificCourse')->name('specific.course');
    Route::get('/course/video/{coursetitle}','CourseController@video')->name('video');
    Route::get('/exam/{coursetitle}/{examtitle}','ExamController@index')->name('exam');
    Route::post('/exam/postExam','ExamController@postExam')->name('postExam');
    Route::post('/course/content/{data}','CourseController@oneCourse')->name('getcourse');
    Route::get('/user/settings','UserController@userSettings')->name('user-settings');
    Route::post('user/information/post','UserController@updateSettings')->name('user-settings-post');
    Route::get('/user/information','UserController@informationView')->name('user-information');
    Route::get('/user/changepassword','UserController@changePasswordView')->name('user-changepassword');
    Route::post('/user/changepassword/post','UserController@changePassword')->name('user-changepassword-post');
});
Route::group(['middleware' => ['web','managerdata']], function () {
    Route::get('/management','ManagerController@manager')->name('management');

    Route::get('/news/panel','ManagerController@newsPanel')->name('news-panel');
    Route::get('/news/create','ManagerController@createArcView')->name('createarc-view');
    Route::post('/news/create/post','ManagerController@createArticle')->name('create-arc-post');
    Route::get('/news/modify/{title}','ManagerController@modifyNews')->name('modify-news');
    Route::post('/news/modify/post','ManagerController@modifyNewsPost')->name('modify-arc-post');
    Route::post('/news/remove','ManagerController@removeArticle')->name('remove-arc');

    Route::get('/exam/panel','ManagerController@examPanel')->name('exam-panel');
    Route::get('/exam/creation','ManagerController@examCreation')->name('examcreation');
    Route::get('/modify/exam/{title}','ManagerController@modifyExam')->name('modify-exam');
    Route::post('create/exam/post','ManagerController@createExam')->name('create-exam-post');
    Route::post('/exam/remove','ManagerController@removeExam')->name('remove-exam');

    Route::get('/create/course','ManagerController@courseCreation')->name('coursecreation');
    Route::get('/panel/course','ManagerController@coursePanel')->name('course-panel');
    Route::post('/create/course/post','ManagerController@createCourse')->name('create-course-post');
    Route::post('/remove/course','ManagerController@removeCourse')->name('remove-course');

    Route::get('/user/panel','ManagerController@userPanel')->name('user-panel');
    Route::post('/user/remove','ManagerController@removeUser')->name('remove-user');
    Route::get('/user/create','Auth\RegisterController@registerView')->name('register-view');
    Route::post('/user/create/post','Auth\RegisterController@registerUser')->name('create-user');
    Route::post('/user/tocourse','ManagerController@userToCourse')->name('usertocourse');
    Route::post('/user/modify','ManagerController@modifyUser')->name('modify-user');
    Route::post('/user/modify/post','ManagerController@modifyUserPost')->name('modify-user-post');
    Route::post('/user/remove/course','ManagerController@removeUserCourse')->name('remove-user-course');
    Route::post('/user/remove/exam','ManagerController@removeUserExam')->name('remove-user-exam');

    Route::get('/scrollimage/panel','ManagerController@imagePanel')->name('image-panel');
    Route::get('/scrollimage/create/view','ManagerController@createImageview')->name('create-image-view');
    Route::post('/scrollimage/create/post','ManagerController@createImage')->name('create-image-post');
    Route::post('/scrollimage/remove','ManagerController@removeImage')->name('remove-image');
});
Auth::routes();
