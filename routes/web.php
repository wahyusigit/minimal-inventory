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
    return redirect('/login');
});

Route::get('/home', function () {
    return redirect('/admin/barang');
});

Route::get('/register', function () {
    return redirect('/login');
});

Route::post('/register', function () {
    return redirect('/login');
});

Route::group(['prefix'=>'admin'], function(){
	Route::get('/',['uses'=>'BarangController@index','as'=>'indexBarang']);
	Route::get('/penjualan',['uses'=>'PenjualanController@index','as'=>'indexPenjualan']);
	Route::post('/penjualan/add',['uses'=>'PenjualanController@addPenjualan','as'=>'addPenjualan']);
	Route::get('/penjualan/edit/{id}',['uses'=>'PenjualanController@editPenjualan','as'=>'editPenjualan']);
	Route::post('/penjualan/update',['uses'=>'PenjualanController@updatePenjualan','as'=>'updatePenjualan']);
	Route::get('/penjualan/delete/{id}',['uses'=>'PenjualanController@deletePenjualan','as'=>'deletePenjualan']);

	Route::get('/barang',['uses'=>'BarangController@index','as'=>'indexBarang']);
	Route::post('/barang_edit',['uses'=>'BarangController@updateBarang','as'=>'updateBarang']);
	Route::post('/barang',['uses'=>'BarangController@addBarang','as'=>'addBarang']);
	Route::post('/barang_delete',['uses'=>'BarangController@deleteBarang','as'=>'deleteBarang']);
	Route::post('/mutasibarang',['uses'=>'BarangController@addMutasiBarang','as'=>'addMutasiBarang']);
	Route::get('/barang_masuk',['uses'=>'BarangMasukController@index','as'=>'indexBarangMasuk']);
	Route::get('/barang_keluar',['uses'=>'BarangKeluarController@index','as'=>'indexBarangKeluar']);

	Route::get('/laporan',['uses'=>'LaporanController@index','as'=>'indexLaporan']);
	Route::get('/laporan/barang',['uses'=>'LaporanController@laporanBarang','as'=>'indexLaporanBarang']);
	Route::get('/laporan/penjualan',['uses'=>'LaporanController@laporanPenjualan','as'=>'indexLaporanPenjualan']);
	Route::post('/laporan/penjualan',['uses'=>'LaporanController@showLaporanPenjualan','as'=>'indexShowLaporanPenjualan']);
});

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});
