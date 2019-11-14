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

Route::group([], function() {
    // Dashboard
    Route::get('/app/dashboard', 'AppController@dashboard')->name('app.dashboard');

    // Categories codes
    Route::get('/app/categories/index', 'CategoryController@index')->name('app.categories.index');

    //Logout
    Route::get('/app/logout', 'AppController@logout')->name('app.logout');
});
