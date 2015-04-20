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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('landing', function() {
    return view('masterpages.master_landing');
});

Route::get('dashboard', function() {
    return view('adminAdminDashboard');
});

Route::get('home','adminAdminDashboardController@index');

Route::get('addUser','createUserController@index');
Route::post('addUser', 'createUserController@storeUser');

Route::get('updateUser','createUserController@updateUserindex');
Route::post('updateUser','createUserController@updateUserindexstore');

Route::post('test','createUserController@searchUserAccountDetailsByID');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);