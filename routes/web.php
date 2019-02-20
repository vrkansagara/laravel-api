<?php

includeRouteFiles(__DIR__ . '/local/');

Route::get('bootstrap/modal', 'BootstrapController@modalBox')->name('bootstrap.modalbox');

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



Route::get('/', 'IndexController@index')->name('front.home');
Route::get('language/{language}', 'LanguageController@changeLanguage')->name('language');

Route::get('force/logout', 'Auth\\LoginController@logout')->name('force.logout');
Route::get('login/{socialProvider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{socialProvider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.redirect');

Auth::routes();

Route::get('dashboard', 'HomeController@index')->name('dashboard');
// Manage User
Route::resource('users', 'UsersController');
Route::post('users/get', 'UsersController@getUserListForDataTable')->name('user.get.list');
Route::post('users/get/modalbox', 'UsersController@getUserListForModalBox')->name('user.get.list.modalbox');

// Manage Role
Route::resource('roles', 'RolesController');
Route::post('roles/get', 'RolesController@getRoleListForDataTable')->name('role.get.list');

// Manage Permission
Route::resource('permissions', 'PermissionsController');
Route::post('permissions/get', 'PermissionsController@getPermissionListForDataTable')->name('permission.get.list');

// Manage User Profile
Route::resource('profile', 'UserprofileController');
