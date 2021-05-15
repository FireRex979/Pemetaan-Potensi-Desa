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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('layouts.admin');
});
//Desa
Route::get('/admin/desa/home', 'DesaController@index')->name('desa.home');
Route::get('/admin/desa/create', 'DesaController@create')->name('desa.create');
Route::post('/admin/desa/store', 'DesaController@store')->name('desa.store');
Route::get('/admin/desa/show/{id}', 'DesaController@show')->name('desa.show');
Route::get('/admin/desa/get-batas-desa/{id}', 'DesaController@readBatasDesa')->name('desa.get_batas_desa');
Route::post('/admin/desa/update/{id}', 'DesaController@update')->name('desa.update');
Route::post('/admin/desa/delete', 'DesaController@delete')->name('desa.delete');

//Agama
Route::get('/admin/agama/home', 'AgamaController@index')->name('agama.home');
Route::post('/admin/agama/store', 'AgamaController@store')->name('agama.store');
Route::get('/admin/agama/edit/{id}', 'AgamaController@edit')->name('agama.edit');
Route::post('/admin/agama/update/{id}', 'AgamaController@update')->name('agama.update');
Route::post('/admin/agama/delete', 'AgamaController@delete')->name('agama.delete');
