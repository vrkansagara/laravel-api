<?php

Route::get('/','IndexController@index')->name('front.home');
Route::get('language/{language}', 'LanguageController@changeLanguage')->name('language');

Auth::routes();

Route::get('dashboard', 'HomeController@index')->name('dashboard');
Route::get('force/logout', 'Auth\\LoginController@logout')->name('force.logout');


Route::get('/ping', function () {
    return response()->json([
        'status' => 200,
        'message' => 'OK',
        'data' =>
            [
                'time' => new \Carbon\Carbon()
            ]
    ]);
});


// Manage User
Route::resource('users', 'UsersController');
Route::post('users/get', 'UsersController@getUserListForDataTable')->name('user.get.list');

// Manage Role
Route::resource('roles', 'RolesController');
Route::post('roles/get', 'RolesController@getRoleListForDataTable')->name('role.get.list');

// Manage Permission
//Route::resource('users', 'UsersController');
//Route::post('users/get', 'UsersController@getPermissionListForDataTable')->name('user.get.list');

// Manage User Profile
Route::resource('profile', 'UserprofileController');




if (hash_equals(env('APP_ENV'), 'local')) {
    Route::get('sample', 'SampleController@indexAction')->name('sample');
    Route::get('sample/page', 'SampleController@samplePageAction')->name('sample.page');
    Route::post('sample/submit', 'SampleController@submitAction')->name('sample.submit');

}
