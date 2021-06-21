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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/maps', 'MapsController');
Route::resource('/distance', 'DistanceController');
Route::resource('/cabang', 'CabangController');
Route::resource('/dijkstra', 'DijkstraController');
Route::resource('/saving', 'SavingController');
Route::get('/saving/ajax/{id}', 'SavingController@get_distance');
Route::resource('/distancematrix', 'MatrixController');
Route::get('/distancematrix/ajax/{id}', 'MatrixController@get_cabang');
Route::get('/distancematrix/distance', 'MatrixController@distance');
Route::resource('/rute', 'RuteController');
Route::resource('/rutedetail', 'RuteDetailController');
Route::get('/rute/ajax/{Kode_Cabang}', 'RuteController@get_cabang');
Route::get('/rute/getcabang/ajax', 'RuteController@getcabangajax');
Route::get('/polyline', 'MapsController@polyline')->name('polyline');
Route::get('/polyline1', 'MapsController@polyline1')->name('polyline1');
Route::resource('/route', 'RouteController');
Route::get('/route/{id}', 'RouteController@routedetail');
// Route::post('cabang/update', 'CabangController@update');