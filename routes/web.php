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
Route::resource('/dijkstra', 'RouteController');
Route::get('/polyline', 'MapsController@polyline')->name('polyline');
Route::get('/polyline1', 'MapsController@polyline1')->name('polyline1');
Route::resource('/route', 'RouteController');
Route::get('/route/{id}', 'RouteController@routedetail');
// Route::post('cabang/update', 'CabangController@update');