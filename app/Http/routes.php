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
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
//get('/specialists',['as'=>'specialists', 'uses'=>'Specialist@index']);
$router->resource('specialists','SpecilistController');
Route::get('specialists/region','SpecilistController@getRegion');
Route::post('specialists/city_first','SpecilistController@getCity_first');
Route::post('specialists/city_second','SpecilistController@getCity_second');
Route::post('specialists/city_third','SpecilistController@getCity_third');
//Route::get('attaches/{dateImg}/{filename}/{width}/{height}/{type?}/{anchor?}', 'ImageController@whResize');
//Route::get('attaches/{dateImg}/{filename}/', 'ImageController@fullImage');

Route::resource('image', 'ImageController');