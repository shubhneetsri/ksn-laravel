<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-classes', 'Common\api\SchoolController@getClasses')->middleware('cors');
Route::get('/get-academic-years', 'Common\api\SchoolController@getAcademicYears')->middleware('cors');
Route::post('/register-student', 'Student\api\registerController@add')->middleware('cors');
