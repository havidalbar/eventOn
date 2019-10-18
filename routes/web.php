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
Route::get('/', function(){
    return view('welcome');
})->name('index');

Route::get('/login', 'TamuController@lihatHalamanLogin');
Route::get('/register', 'TamuController@lihatHalamanRegistrasi');

Route::post('login','TamuController@login')->name('login');
Route::post('registrasi','TamuController@registrasi')->name('register');

Route::group(['middleware' => ['user.loggedin'],'as'=>'user.'], function () {
    Route::get('logout','MemberController@logout')->name('logout');
    Route::get('dashboard','MemberController@getDashboard')->name('dashboard');
    Route::resource('user', 'MemberController')->parameters([
        'user' => 'username',
    ])->except(['store']);
});
Route::get('/login', function () {
    return view('masuk');
});

