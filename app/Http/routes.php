<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

//profile
Route::get('/profile', 'ProfileController@index');
Route::post('/profile/update', 'ProfileController@update');

//user manage
Route::get('/usermanage/student', 'UserManageController@studentsList');
Route::get('/usermanage/teacher', 'UserManageController@teachersList');
Route::post('/usermanage/student/update', 'UserManageController@studentUpdate');
Route::get('/usermanage/student/delete/{id}', 'UserManageController@studentDelete');
Route::post('/usermanage/student/create', 'UserManageController@studentCreate');

//api
Route::group(['prefix' => 'api'], function () {
    //user
    Route::resource('usermanage', 'UserManageController@show');
});
