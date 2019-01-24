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
//    return response()->json([
//        'status' => 'Laravel API working fine...',
//        'time' => new \Carbon\Carbon()
//    ]);
    return view('welcome');
});

Route::get('/ping', function () {
    return response()->json([
        'status' => 200,
        'message' => 'OK',
        'data' =>
            [
                'time' => new \Carbon\Carbon()
            ]
    ]);
//    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Route::resource('users', 'UsersController');
Route::get('users', 'UsersController@index');
Route::get('users/get', 'UsersController@getUsersForTable')->name('usersget');
