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

//room manage
Route::get('/roommanage/rooms', 'RoomController@index');
Route::get('/roommanage/room/{room_id}/paper/{paper_id}', 'RoomController@scores');
Route::get('/roommanage/create', 'RoomController@create');
Route::post('/roommanage/store', 'RoomController@store');
Route::get('/roommanage/edit/{id}', 'RoomController@edit');

//paper manage
Route::get('/papers', 'PaperController@index');
Route::post('/paper/create', 'PaperController@create');
Route::get('/paper/edit/{id}', 'PaperController@edit');

//question manage
Route::get('/question/singles', 'QuestionController@list_singles');
Route::post('/question/create', 'QuestionController@create');
Route::get('/question/single/create', 'SingleController@create');
Route::get('/question/single/update/{id}', 'SingleController@update');
Route::post('/question/single/store/{id?}', 'SingleController@store');

//exam manage
Route::get('exam/rooms', 'ExamController@exam_rooms');
Route::post('exam/room/{room_id}/paper/{paper_id}/rate', 'ExamController@rate');
Route::get('exam/room/{room_id}/paper/{paper_id}', 'ExamController@exam');
Route::get('exam/scores', 'ExamController@user_scores');

//api
Route::group(['prefix' => 'api'], function () {
    //user
    Route::resource('usermanage', 'UserManageController@show');
    Route::resource('usermanage/search', 'UserManageController@search');
    Route::resource('usermanage/delete', 'UserManageController@destroy');
    //paper
    Route::resource('paper/delete', 'PaperController@destroy');
    Route::resource('papers/search', 'PaperController@search');
    //room
    Route::get('/roommanage/{room_id}/user/{user_id}', 'RoomController@add_user');
    Route::get('/roommanage/user/remove/{id}', 'RoomController@remove_user');
    Route::get('/roommanage/delete/{id}', 'RoomController@destroy');
    //single
    Route::get('/questionmanage/single/delete/{id}', 'SingleController@destroy');
});
