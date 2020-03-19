<?php

use Illuminate\Support\Facades\Route;

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

// *******************************************************************************************
// all admin routes.
// *******************************************************************************************

Route::group(["prefix" => "admin", "namespace" => "backend"], function() {
	// admin login routes.
    Route::get('/login', 'LoginController@index');
    Route::post('/login', 'LoginController@login');
    // admin logout route.
    Route::get('/logout', 'LoginController@logout');

    // admin authenticated routes routes.
    Route::group(['middleware' => ['admin']], function () {
    	Route::get('/', 'AdminController@index');
        Route::prefix('users')->group(function () {
            Route::get('/', 'AdminController@listUsers');
            Route::get('/add', 'AdminController@getUser');
            Route::post('/add', 'AdminController@addUser');
            Route::get('/edit/{id}', 'AdminController@editUser');
            Route::post('/update', 'AdminController@updateUser');

            Route::get('/delete/{id}', 'AdminController@deleteUser');
        });
    });
});

// *******************************************************************************************
// all other users related routes
// *******************************************************************************************

// home page route.
Route::get('/', 'frontend\HomeController@index');
// authenticated routes.
Auth::routes();

Route::group(["namespace" => "frontend"], function() {
	// user login and register routes.
    Route::post('/user/login', 'LoginController@login');
    Route::post('/user/register', 'LoginController@register');
    // user logout route.
    Route::get('/logout', 'LoginController@logout');
    // forget password routes.
    Route::get('forget/password', 'LoginController@getForget');
    Route::post('email/password', 'LoginController@forgetPassword');
    Route::get('reset/password/{token}', 'LoginController@getReset');
    Route::post('/update/password', 'LoginController@reset');

    // authenticated routes.
    Route::group(['middleware' => ['auth']], function () {
    	Route::get('/test', 'HomeController@test');
    });
});
