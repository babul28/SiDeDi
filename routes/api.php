<?php

use App\Http\Resources\UserResource;
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

Route::get('questions/', 'Api\ShowQuestion');
Route::post('register/', 'Api\RegisterUser');
Route::post('login/', 'Api\LoginUser');

Route::apiResource('class', 'Api\ClassesController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return new UserResource($request->user());
});
