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
})->name('index');
Route::get('/register', function () {
    return view('register');
});

Route::post('login','UserController@login')->name('login');
Route::post('register','UserController@store')->name('register');

Route::group(['middleware' => ['user.loggedin'],'as'=>'user.'], function () {
    Route::get('logout','UserController@logout')->name('logout');
    Route::get('dashboard','UserController@getDashboard')->name('dashboard');
    Route::resource('user', 'UserController')->parameters([
        'user' => 'username',
    ])->except(['store']);
});
