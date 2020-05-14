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

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Auth::routes();
Route::post('/login', 'Auth\LoginController@postLogin')->name('login');

// After login routes
Route::group(['middleware' => ['logincheck']], function () {

    // User dashboard
    Route::get('/home', 'UserController@index')->name('home');

});

