<?php

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});
Route::middleware('auth')->get('logout', function () {
    Auth::logout();
    return redirect(route('login'))->withInfo('You have successfully logged out!');
})->name('logout');
// Get authenticated user
Route::get('users/auth', function () {
    return response()->json(['user' => Auth::check() ? Auth::user() : false]);
});
Route::name('js.')->group(function () {
    Route::get('dynamic.js', 'JsController@dynamic')->name('dynamic');
});
Route::get('/logout-manual', function () {
    Auth::logout();
})->name('logout-manual');

Route::name('admin.')->prefix('admin')->group(function () {
    // Route::get('dashboard', 'DashboardController')->name('dashboard');
    Route::get('users/roles', 'UserController@roles')->name('users.roles');
    Route::post('permisos/find', 'UserController@findPermission')->name('permisos.find');
    Route::post('users/updateroles', 'UserController@updateRoles')->name('users.updatesroles');
    Route::resource('users', 'UserController', [
        'names' => [
            'index' => 'users'
        ]
    ]);
});

// Route::get('profile','UserController@profile')->name('profile');
Route::post('profile', 'UserController@update_avatar')->name('profile');
//any routes manager by Vue routes
Route::get('/{any}', 'AppController@index')->where('any', '.*');
