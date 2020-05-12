<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'KategoriController@index');



Route::resource('/kategori', 'KategoriController');
Route::resource('/sub-menu', 'SubMenuController');
Route::resource('/users', 'UsersController');

Auth::routes();
Route::get('/kategori/export_excel', 'KategoriController@export_excel');
Route::get('/home', 'HomeController@index')->name('home');
Route::any('/laporan', 'LaporanController@index');
Route::any('/beranda', 'HomeController@index');

Route::get('/ka/{kategori}', 'KadarAirController@index');
Route::post('/ka/store', 'KadarAirController@store');
Route::get('/other/{tipe}/{kategori}', 'OtherController@index');
Route::post('/other/store', 'OtherController@store');
Route::get('/kk/{kategori}', 'KadarKotorController@index');
Route::post('/kk/store', 'KadarKotorController@store');

Route::get('/alb/{kategori}', 'AlbController@index');
Route::post('/alb/store', 'AlbController@store');
