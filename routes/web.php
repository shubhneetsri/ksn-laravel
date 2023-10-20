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
    //echo Hash::make('111111');;die;
    return view('home');
});

// Authentication routes
Auth::routes();
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@postLogin')->name('login');

// After login routes
Route::group(['middleware' => ['logincheck']], function () {

    // User dashboard
    //Route::get('/home', 'UserController@index')->name('home');
    //Route::post('/home', 'UserController@save');

    // Student routes
    Route::get('/add-student', 'App\Http\Controllers\Admin\StudentController@index')->name('add-student');
    Route::get('/add-student/{id}', 'App\Http\Controllers\Admin\StudentController@edit')->name('add-student');
    Route::post('/add-student/{id}', 'App\Http\Controllers\Admin\StudentController@update')->name('add-student');
    Route::post('/add-student', 'App\Http\Controllers\Admin\StudentController@store')->name('add-student');
    Route::get('/student-list', 'App\Http\Controllers\Admin\StudentController@show')->name('student-list');
    Route::get('/student-destroy/{id}', 'App\Http\Controllers\Admin\StudentController@destroy')->name('student-destroy');

    // Student fees routes
    Route::get('/add-student-fee', 'App\Http\Controllers\Admin\StudentFeeController@index')->name('add-student-fee');
    Route::get('/add-student-fee/{id}', 'App\Http\Controllers\Admin\StudentFeeController@edit')->name('add-student-fee');
    Route::post('/add-student-fee/{id}', 'App\Http\Controllers\Admin\StudentFeeController@update')->name('add-student-fee');
    Route::post('/add-student-fee', 'App\Http\Controllers\Admin\StudentFeeController@store')->name('add-student-fee');
    Route::get('/student-fee-list', 'App\Http\Controllers\Admin\StudentFeeController@show')->name('student-fee-list');
    Route::get('/student-fee-destroy/{id}', 'App\Http\Controllers\Admin\StudentFeeController@destroy')->name('student-fee-destroy');

    // Fillable form elements routes
    Route::get('/get-classes', 'App\Http\Controllers\Common\api\SchoolController@getClasses');
    Route::get('/get-academic-years', 'App\Http\Controllers\Common\api\SchoolController@getAcademicYears');
    Route::get('/get-countries', 'App\Http\Controllers\Common\api\ResourceController@GetCountries');
    Route::get('/get-states/{country_id}', 'App\Http\Controllers\Common\api\ResourceController@GetStates');
    Route::get('/get-cities/{state_id}', 'App\Http\Controllers\Common\api\ResourceController@GetCities');
    Route::get('/get-fee-structure/{student_id}/{id}/{academic_year}', 'App\Http\Controllers\Common\api\SchoolController@getFeeStructure');
    
});

