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

// Route::resource('buku', 'Bukucontroller');
Route::get('/buku', 'Bukucontroller@index');
Route::post('/buku', 'Bukucontroller@store');
Route::get('/buku/{bukumodel}', 'Bukucontroller@show');
Route::patch('/buku/{bukumodel}', 'Bukucontroller@update');
Route::delete('/buku/{bukumodel}', 'Bukucontroller@destroy');