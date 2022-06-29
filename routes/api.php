<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware('throttle:60,1')->prefix('users')->group(function () {


    Route::post('signup','\App\Http\Controllers\AuthController@Signup');
    Route::post('signin','\App\Http\Controllers\AuthController@Signin');
    Route::get('holofair','\App\Http\Controllers\AuthController@show');


});





