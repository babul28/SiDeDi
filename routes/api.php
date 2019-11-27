<?php

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

/**
 * get Questions EndPoint
 */
Route::get('questions/', 'Api\ShowQuestion')->name('questions');

/**
 * Auth EndPoint
 */
Route::post('register/', 'Api\RegisterUser')->name('auth.register');
Route::post('login/', 'Api\LoginUser')->name('auth.login');
//Forbidden Access
Route::get('login/', function () {
    return response()->json([
        'status' => 'Not Authorize',
        'message' => 'Access Forbidden!',
    ], 403);
})->name('login');

/**
 * Class Endpoint
 */
Route::post('class/join', 'Api\ClassesController@join')->name('class.join');

/**
 * Students EndPoint
 */
Route::get('student', 'Api\StudentController@index')->name('student.index');
Route::get('student/{student}', 'Api\StudentController@show')->name('student.show');
Route::post('student', 'Api\StudentController@store')->name('student.store');

/**
 * Answers EndPoint
 */
Route::get('answer', 'Api\AnswersController@index')->name('answer.index');
Route::get('answer/{answer}', 'Api\AnswersController@show')->name('answer.show');
Route::post('answer', 'Api\AnswersController@store')->name('answer.store');

/**
 * Authentication EndPoint
 */
Route::group(['middleware' => 'auth:api'], function () {

    /**
     * Class Endpoint
     */
    Route::apiResource('class', 'Api\ClassesController');

    /**
     * Class Endpoint
     */
    Route::get('report', 'Api\ReportController@index')->name('report.index');

    Route::bind('report', function($id) {
        return \App\Report::with('student.class')->findOrFail($id);
    });
    Route::get('report/{report}', 'Api\ReportController@show')->name('report.show');
});
