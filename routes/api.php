<?php

use App\Http\Controllers\UmatController;
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

Route::group(['middleware' => 'api', 'prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('logout', 'JWTAuthController@logout');
    Route::post('login', 'JWTAuthController@login');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'umat'], function () {
        Route::post('nik-verification/{umat?}', 'UmatController@nikVerification');
        Route::post('{umat}', 'UmatController@update');
    });

    Route::post('request-update-help', 'UmatController@sendHelpRequest');
    Route::apiResource('umat', 'UmatController', ['except' => ['index', 'destroy', 'update']]);
    Route::get('master-data', 'MasterDataController@index');
});

Route::apiResource('user', 'UserController', ['except' => ['index', 'destroy']]);
