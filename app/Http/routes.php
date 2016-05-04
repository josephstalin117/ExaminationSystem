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
Route::get('/usermanage/student', 'UserManageController@index');
Route::post('/usermanage/student/update', 'UserManageController@studentUpdate');
Route::get('/usermanage/student/delete/{id}', 'UserManageController@studentDelete');
Route::post('/usermanage/student/create', 'UserManageController@studentCreate');

//paper manage
Route::get('/papers', 'PaperController@index');
Route::post('/paper/create', 'PaperController@create');
Route::get('/paper/edit/{id}', 'PaperController@edit');
Route::post('/question/create', 'QuestionController@create');

//exam manage
Route::get('exam/papers', 'ExamController@papers');

//api
Route::group(['prefix' => 'api'], function () {
    //user
    Route::resource('usermanage', 'UserManageController@show');
    Route::resource('usermanage/delete', 'UserManageController@destroy');
    //paper
    Route::resource('paper/delete', 'PaperController@destroy');
});
