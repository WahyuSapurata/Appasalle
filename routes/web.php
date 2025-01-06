<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('/', 'Dashboard@index')->name('home.index');

    Route::group(['prefix' => 'login', 'middleware' => ['guest'], 'as' => 'login.'], function () {
        Route::get('/login-admin', 'Auth@show')->name('login-admin');

        Route::post('/login-proses-admin', 'Auth@login_proses_admin')->name('login-proses-admin');

        Route::get('/login-user', 'Auth@user')->name('login-user');
        Route::post('/login-proses-user', 'Auth@login_proses_user')->name('login-proses-user');

        Route::get('/login-kolektor', 'Auth@login_kolektor')->name('login-kolektor');
        Route::post('/login-proses-kolektor', 'Auth@login_proses_kolektor')->name('login-proses-kolektor');

        Route::get('/login-monitoring', 'Auth@login_monitoring')->name('login-monitoring');
        Route::post('/login-proses-monitoring', 'Auth@login_proses_monitoring')->name('login-proses-monitoring');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['auth.admin'], 'as' => 'admin.'], function () {
        Route::get('/dashboard-admin', 'Dashboard@dashboard_admin')->name('dashboard-admin');

        Route::get('/tunggakan', 'TagihanController@index')->name('tunggakan');

        Route::get('/transaksi', 'TransaksiController@index')->name('transaksi');
        Route::post('/update-transaksi/{uuid}', 'TransaksiController@update_transaksi')->name('update-transaksi');

        Route::get('/warga', 'WargaController@index')->name('warga');
        Route::post('/add-warga', 'WargaController@add')->name('add-warga');
        Route::get('/detail-warga/{uuid}', 'WargaController@detail')->name('detail-warga');
        Route::post('/update-warga/{uuid}', 'WargaController@edit')->name('update-warga');
        Route::delete('/delete-warga/{uuid}', 'WargaController@delete')->name('delete-warga');

        Route::post('/import', 'WargaController@import')->name('import');

        Route::get('/umkm', 'UmkmController@index')->name('umkm');
        Route::post('/add-umkm', 'UmkmController@add')->name('add-umkm');
        Route::get('/detail-umkm/{uuid}', 'UmkmController@detail')->name('detail-umkm');
        Route::post('/update-umkm/{uuid}', 'UmkmController@edit')->name('update-umkm');
        Route::delete('/delete-umkm/{uuid}', 'UmkmController@delete')->name('delete-umkm');

        Route::post('/import-umkm', 'UmkmController@import')->name('import-umkm');

        Route::post('/add-menu', 'MenuUmkmController@add')->name('add-menu');
        Route::get('/get-menu/{uuid_umkm}', 'MenuUmkmController@get')->name('get-menu');
        Route::delete('/delete-menu/{uuid}', 'MenuUmkmController@delete')->name('delete-menu');

        Route::get('/user', 'User@index')->name('user');
        Route::post('/add-user', 'User@add')->name('add-user');
        Route::get('/profil-admin/{uuid}', 'User@profil')->name('profil-admin');
        Route::post('/update-user/{uuid}', 'User@edit')->name('update-user');
        Route::delete('/delete-user/{uuid}', 'User@delete')->name('delete-user');

        Route::get('/search', 'SearchController@search')->name('search');

        Route::get('/chart', 'Dashboard@chart')->name('chart');
    });

    Route::group(['prefix' => 'kolektor', 'middleware' => ['auth.kolektor'], 'as' => 'kolektor.'], function () {
        Route::get('/dashboard-kolektor', 'Dashboard@dashboard_kolektor')->name('dashboard-kolektor');

        Route::get('/profil', 'ProfilUser@ptofil_kolektor')->name('profil');

        Route::get('/transaksi', 'TransaksiController@transaksi_kolektor')->name('transaksi');
        Route::get('/detail-transaksi/{uuid}', 'TransaksiController@detail_transaksi_kolektor')->name('detail-transaksi');

        Route::get('/warga', 'WargaController@warga_kolektor')->name('warga');
        Route::get('/pembayaran/{uuid}', 'WargaController@pembayaran_warga_kolektor')->name('pembayaran');

        Route::post('/add-transaksi', 'TransaksiController@proses_transaksi_kolektor')->name('add-transaksi');
        Route::get('/qris-transaksi/{uuid}', 'TransaksiController@qris_transaksi_kolektor')->name('qris-transaksi');
        Route::get('/bukti-transaksi/{uuid}', 'TransaksiController@bukti_transaksi_kolekor')->name('bukti-transaksi');
        Route::post('/upload-bukti/{uuid}', 'TransaksiController@upload_bukti_kolektor')->name('upload-bukti');
        Route::get('/proses-transaksi/{uuid}', 'TransaksiController@proses_kolektor')->name('proses-transaksi');
    });

    Route::group(['prefix' => 'monitoring', 'middleware' => ['auth.monitoring'], 'as' => 'monitoring.'], function () {
        Route::get('/dashboard-monitoring', 'Dashboard@dashboard_monitoring')->name('dashboard-monitoring');

        Route::get('/chart', 'Dashboard@chart')->name('chart');

        // Route::get('/profil', 'ProfilUser@ptofil_kolektor')->name('profil');
    });

    Route::group(['prefix' => 'user', 'middleware' => ['auth.user'], 'as' => 'user.'], function () {
        Route::get('/dashboard-user', 'Dashboard@dashboard_user')->name('dashboard-user');

        Route::get('/profil', 'ProfilUser@index')->name('profil');

        Route::get('/umkm', 'UmkmController@umkm_warga')->name('umkm');
        Route::get('/detail-umkm/{uuid}', 'UmkmController@detail_umkm_user')->name('detail-umkm');

        Route::get('/tagihan', 'TagihanController@tagihan_warga')->name('tagihan');
        Route::get('/detail-tagihan/{uuid}', 'TagihanController@detail_tagihan')->name('detail-tagihan');
        Route::get('/pembayaran', 'TagihanController@bayar_tagihan')->name('pembayaran');

        Route::post('/add-transaksi', 'TransaksiController@proses_transaksi')->name('add-transaksi');
        Route::get('/qris-transaksi/{uuid}', 'TransaksiController@qris_transaksi')->name('qris-transaksi');
        Route::get('/bukti-transaksi/{uuid}', 'TransaksiController@bukti_transaksi')->name('bukti-transaksi');
        Route::post('/upload-bukti/{uuid}', 'TransaksiController@upload_bukti')->name('upload-bukti');
        Route::get('/proses-transaksi/{uuid}', 'TransaksiController@proses')->name('proses-transaksi');
        Route::get('/riwayat-transaksi', 'TransaksiController@riwayat_transaksi')->name('riwayat-transaksi');
    });

    Route::get('/logout', 'Auth@logout')->name('logout');
    Route::get('/logout-user', 'Auth@logout_user')->name('logout-user');
    Route::get('/logout-kolektor', 'Auth@logout_kolektor')->name('logout-kolektor');
    Route::get('/logout-monitoring', 'Auth@logout_monitoring')->name('logout-monitoring');
});
