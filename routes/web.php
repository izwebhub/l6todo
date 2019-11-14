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
    return view('login');
})->name('login');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/app/doLogin', 'AppController@doLogin')->name('app.doLogin');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/app/dashboard', 'AppController@dashboard')->name('app.dashboard');

    Route::middleware(['auth', 'admin'])->group(function () {
        // Categories codes
        Route::get('/app/categories/index', 'CategoryController@index')->name('app.categories.index');
        Route::post('/app/categories/save', 'CategoryController@save')->name('app.categories.save');
        Route::post('/app/categories/update', 'CategoryController@update')->name('app.categories.update');
        Route::get('/app/categories/edit/{id}', 'CategoryController@edit')->name('app.categories.edit');
        Route::post('/app/categories/delete/{id}', 'CategoryController@destroy')->name('app.categories.delete');
        Route::post('/app/categories/change/status/{id}', 'CategoryController@changeStatus')->name('app.categories.change.status');

        // Users codes
        Route::get('/app/users/index', 'UserController@index')->name('app.users.index');
        Route::post('/app/users/save', 'UserController@save')->name('app.users.save');
        Route::post('/app/users/update', 'UserController@update')->name('app.users.update');
        Route::get('/app/users/edit/{id}', 'UserController@edit')->name('app.users.edit');
        Route::post('/app/users/delete/{id}', 'UserController@destroy')->name('app.users.delete');
        Route::post('/app/users/change/status/{id}', 'UserController@changeStatus')->name('app.users.change.status');
        Route::get('/app/users/change/password/{id}', 'UserController@changePassword')->name('app.users.change.password');
        Route::post('/app/users/change/password/save', 'UserController@savePassword')->name('app.users.change.password.save');
    });

    //Logout
    Route::get('/app/logout', 'AppController@logout')->name('app.logout');

    // Settings
    Route::post('/app/settings/password/save', 'SettingsController@changePassword')->name('app.settings.password.save');

    // BackOff
    Route::get('/app/redirectWith', 'AppController@redirectWith')->name('app.redirectWith');
    Route::get('/app/redirectWith/delete', 'AppController@redirectWithDelete')->name('app.redirectWith.delete');
});
