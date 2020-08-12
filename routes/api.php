<?php

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

Route::group(['prefix' => '/v1'], function ($api) {

    Route::prefix('/user')->group(function () {
        Route::post('/register', 'Api\v1\UserController@register');
        Route::post('/login', ['uses' => 'Api\v1\UserController@login']);

        Route::middleware('auth:api')->group(function () {
            Route::post('/change', 'Api\v1\UserController@change');
        });

        Route::get('/reset', 'Api\v1\UserController@reset');
    });

    Route::prefix('/email')->group(function () {
        Route::get('/verify/{key}', 'Api\v1\EmailController@verify');
    });

    Route::prefix('/goal')->group(function () {
        Route::middleware('auth:api')->group(function () {
            Route::post('/store', 'Api\v1\GoalController@store');
            Route::get('/index', 'Api\v1\GoalController@index');
            Route::post('/delete', 'Api\v1\GoalController@delete');
            //asd
        });
        Route::post('/{id}/check-in', 'Api\v1\GoalController@checkIn');
    });
});
