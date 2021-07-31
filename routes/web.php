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
    return view('home');
});

// Authentication routes
Auth::routes();
Route::post('/login', 'Auth\LoginController@postLogin')->name('login');

// After login routes
Route::group(['middleware' => ['logincheck']], function () {

    // User dashboard
    //Route::get('/home', 'UserController@index')->name('home');
    //Route::post('/home', 'UserController@save');

    // Student routes
    Route::get('/add-student', 'Backend\StudentController@index')->name('add-student');
    Route::get('/add-student/{id}', 'Backend\StudentController@edit')->name('add-student');
    Route::post('/add-student/{id}', 'Backend\StudentController@update')->name('add-student');
    Route::post('/add-student', 'Backend\StudentController@store')->name('add-student');
    Route::get('/student-list', 'Backend\StudentController@show')->name('student-list');
    Route::get('/student-destroy/{id}', 'Backend\StudentController@destroy')->name('student-destroy');

    // Student fees routes
    Route::get('/add-student-fee', 'Backend\StudentFeeController@index')->name('add-student-fee');
    Route::get('/add-student-fee/{id}', 'Backend\StudentFeeController@edit')->name('add-student-fee');
    Route::post('/add-student-fee/{id}', 'Backend\StudentFeeController@update')->name('add-student-fee');
    Route::post('/add-student-fee', 'Backend\StudentFeeController@store')->name('add-student-fee');
    Route::get('/student-fee-list', 'Backend\StudentFeeController@show')->name('student-fee-list');
    Route::get('/student-fee-destroy/{id}', 'Backend\StudentFeeController@destroy')->name('student-fee-destroy');

    // Fillable form elements routes
    Route::get('/get-classes', 'Common\api\SchoolController@getClasses');
    Route::get('/get-academic-years', 'Common\api\SchoolController@getAcademicYears');
    Route::get('/get-countries', 'Common\api\ResourceController@GetCountries');
    Route::get('/get-states/{country_id}', 'Common\api\ResourceController@GetStates');
    Route::get('/get-cities/{state_id}', 'Common\api\ResourceController@GetCities');
    
});

