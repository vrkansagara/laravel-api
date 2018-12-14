<?php

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;

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


Route::get('/ping', function () {
    return Carbon::now();
});

Route::group(['middleware' => ['api'], 'prefix'=>'auth'], function () {

    Route::post('login', ['name'=>'auth.login','uses'=>'AuthController@login']);
    Route::post('logout', ['name'=>'auth.logout','uses'=>'AuthController@logout']);
    Route::post('register', ['name'=>'auth.register','uses'=>'AuthController@register']);

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('refresh', ['name'=>'auth.refresh','uses'=>'AuthController@refreshToken']);
    });


});



Route::group(['middleware' => ['auth:api']], function () {

    Route::get('user', function (Request $request) {
        return $request->user();
    });
    Route::resource('permission','PermissionController');
    Route::resource('role','RoleController');
    Route::resource('passport-token','PassportTokenController');
    Route::resource('users','UserController');

});


Route::group(['middleware' => ['role:super-admin']], function () {
    //
});

Route::group(['middleware' => ['permission:publish articles']], function () {
    //
});

Route::group(['middleware' => ['role:super-admin','permission:publish articles']], function () {
    //
});

Route::group(['middleware' => ['role_or_permission:super-admin']], function () {
    //
});

Route::group(['middleware' => ['role_or_permission:publish articles']], function () {
    //
});
