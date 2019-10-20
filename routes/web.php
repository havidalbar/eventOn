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
        Route::post('update-akun', 'MemberController@updateAkun')->name('update-akun');
        Route::get('lihat-akun', 'MemberController@lihatAkun')->name('lihat-akun');
        Route::get('lihat-detail-acara/{id}', 'MemberController@lihatDetailAcara')->name('lihat-detail-acara');
        Route::get('lihat-kode-unik', 'MemberController@lihatKodeUnik')->name('lihat-kode-unik');
        Route::get('cari-acara', 'MemberController@cariAcara')->name('cari-acara');
        Route::post('daftar-panitia', 'MemberController@daftarPanitia')->name('daftar-panitia');
        Route::get('lihat-semua-acara', 'MemberController@lihatSemuaAcara')->name('lihat-semua-acara');
        Route::get('lihat-halaman-daftar-panitia', 'MemberController@lihatHalamanDaftarPanitia')->name('lihat-halaman-daftar-panitia');
        Route::post('upload-foto', 'UploadController@Upload')->name('upload-foto');

        Route::group(['prefix' => 'panitia', 'as' => 'panitia.', 'middleware' => ['panitia']], function () {
            Route::get('lihat-profil-panitia', 'PanitiaController@lihatProfilePanitia')->name('lihat-halaman-profile-panitia');

            Route::group(['prefix' => 'panitia.verif', 'as' => 'verif.', 'middleware' => ['panitia.verif']], function () {
                Route::get('lihat-halaman-tambah-acara', 'PanitiaController@lihatHalamanTambahAcara')->name('lihat-halaman-tambah-acara');
                Route::post('buat-acara', 'PanitiaController@buatAcara')->name('buat-acara');
                Route::post('hapus-acara', 'PanitiaController@hapusAcara')->name('hapus-acara');


            });
        });

        Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function () {
            Route::get('lihat-konfirmasi-pendaftaran', 'AdminController@lihatHalamanKonfirmasiPendaftaran')->name('lihat-halaman-konfirmasi-pendaftaran');
            Route::post('terima-panitia', 'AdminController@terimaPanitia')->name('terima-panitia');
            Route::post('tolak-panitia', 'AdminController@tolakPanitia')->name('tolak-panitia');
            Route::get('lihat-konfirmasi-pembayaran', 'AdminController@lihatHalamanKonfirmasiPendaftaran')->name('lihat-halaman-konfirmasi-pembayaran');
            Route::post('terima-pembayaran', 'AdminController@terimaPembayaran')->name('terima-pembayaran');
            Route::post('tolak-pembayaran', 'AdminController@tolakPembayaran')->name('tolak-pembayaran');
        });

        Route::group(['prefix' => 'panitia', 'as' => 'panitia.', 'middleware' => ['IsPanitia']], function () { });
    });
});
