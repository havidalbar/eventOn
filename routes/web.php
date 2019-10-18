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
Route::get('/', 'MemberController@lihatHalamanBeranda')->name('index');
Route::group(['prefix' => 'tamu', 'as' => 'tamu.'], function () {
    Route::group(['middleware' => ['user.toLogin']], function () {
        Route::get('login', 'TamuController@lihatHalamanLogin')->name('lihat-login');
        Route::post('login', 'TamuController@login')->name('login');
        Route::get('register', 'TamuController@lihatHalamanRegistrasi')->name('lihat-registrasi');
        Route::post('registrasi', 'TamuController@registrasi')->name('register');
    });
    Route::get('logout', 'MemberController@logout')->name('logout');

    Route::group(['middleware' => ['user.loggedin'], 'as' => 'user.'], function () {
        Route::post('updateAkun', 'MemberController@updateAkun')->name('update-akun');
        Route::get('lihatAkun', 'MemberController@lihatAkun')->name('lihat-akun');
        Route::get('lihatDetailAcara/{id}', 'MemberController@lihatDetailAcara')->name('lihat-detail-acara');
        Route::get('lihatKodeUnik', 'MemberController@lihatKodeUnik')->name('lihat-kode-unik');
        Route::get('cariAcara', 'MemberController@cariAcara')->name('cari-acara');
        Route::post('daftarPanitia', 'MemberController@daftarPanitia')->name('daftar-panitia');
        Route::get('lihatSemuaAcara', 'MemberController@lihatSemuaAcara')->name('lihat-semua-acara');
        Route::get('lihatHalamanDaftarPanitia', 'MemberController@lihatHalamanDaftarPanitia')->name('lihat-halaman-daftar-panitia');

        Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['IsAdmin']], function () {
            Route::get('lihatKonfirmasiPendaftaran', 'AdminController@lihatHalamanKonfirmasiPendaftaran')->name('lihat-halaman-konfirmasi-pendaftaran');
            Route::post('terimaPanitia', 'AdminController@terimaPanitia')->name('terima-panitia');
            Route::post('tolakPanitia', 'AdminController@tolakPanitia')->name('tolak-panitia');
            Route::get('lihatKonfirmasiPembayaran', 'AdminController@lihatHalamanKonfirmasiPendaftaran')->name('lihat-halaman-konfirmasi-pembayaran');
            Route::post('terimaPembayaran', 'AdminController@terimaPembayaran')->name('terima-pembayaran');
            Route::post('tolakPembayaran', 'AdminController@tolakPembayaran')->name('tolak-pembayaran');
        });

        Route::group(['prefix' => 'panitia', 'as' => 'panitia.', 'middleware' => ['IsPanitia']], function () { });
    });
});
