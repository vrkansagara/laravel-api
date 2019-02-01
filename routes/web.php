<?php

Route::get('language/{language}', 'LanguageController@changeLanguage')->name('language');

Auth::routes();

Route::get('dashboard', 'HomeController@index')->name('dashboard')->middleware('auth');
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


Route::resource('users', 'UsersController');
//Route::get('users/get', 'UsersController@getUsersForTable')->name('usersget');


if (hash_equals(env('APP_NAME'), 'local')) {
    Route::get('sample', 'SampleController@indexAction')->name('sample');
    Route::post('sample/submit', 'SampleController@submitAction')->name('sample.submit');

}
