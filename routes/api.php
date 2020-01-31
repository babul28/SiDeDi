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
Route::post('auth/forget/', 'Api\ForgotPassword')->name('auth.forgetPassword');
Route::post('auth/reset/', 'Api\ResetPassword')->name('auth.resetPassword');

/**
 * Class Endpoint
 */
Route::post('class/join', 'Api\ClassesController@join')->name('class.join');

/**
 * Answers EndPoint
 */
Route::get('answer', 'Api\AnswersController@index')->name('answer.index');
Route::get('answer/{answer}', 'Api\AnswersController@show')->name('answer.show');
Route::post('answer', 'Api\AnswersController@store')->name('answer.store');


/**
 * Students EndPoint
 */
Route::post('student', 'Api\StudentController@store')->name('student.store');

/**
 * Authentication EndPoint
 */
Route::group(['middleware' => 'auth:api'], function () {

    /**
     * Class Profile
     */
    Route::get('profile', 'Api\ProfileController@index');
    Route::put('profile', 'Api\ProfileController@update');
    Route::put('profile/photo', 'Api\ProfileController@updateImage');

    /**
     * Class Endpoint
     */
    Route::apiResource('class', 'Api\ClassesController');
    Route::put('class/{class}/image', 'Api\ClassesController@updateImage');

    /**
     * Class Endpoint
     */
    Route::get('report', 'Api\ReportController@index')->name('report.index');
    Route::get('report/{class}', 'Api\ReportController@show')->name('report.show');

    /**
     * Students EndPoint
     */
    Route::get('student', 'Api\StudentController@index')->name('student.index');
    Route::get('student/{student}', 'Api\StudentController@show')->name('student.show');
});
