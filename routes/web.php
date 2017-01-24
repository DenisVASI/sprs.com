<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', ['as' => 'posts', 'uses' => 'HomePageController@index']);

Route::get('/registration', ['as' => 'posts', 'uses' => 'RegistrationController@index']);
Route::post('/registration', 'RegistrationController@create');

Route::get('/login', ['as' => 'posts', 'uses' => 'LoginController@index']);
Route::post('/login', 'LoginController@loginUser');

Route::get('/{id}', 'ProfileController@showPage')->where('id', '[0-9]+');
Route::post('/{id}', 'ProfileController@showTrack')->where('id', '[0-9]+');

Route::get('/new_order', 'NewOrderController@createOrder');
Route::post('/new_order', 'NewOrderController@addOrder');

Route::get('/admin_panel', 'AdminPanelController@index');
Route::get('/log_out', function (){
    Session::flush();
    return redirect('/');
});
Route::post('/admin_panel','AdminPanelController@orderProcessing');

Route::get('/getTrack', 'GetTrackController@indexTrack');
Route::post('/getTrack', 'GetTrackController@showTrack');
Route::get('test', 'ProfileController@getTable');
//Оставлять последним
Route::get('/{pageNotFount}', function (){
    return redirect('/');
});
   