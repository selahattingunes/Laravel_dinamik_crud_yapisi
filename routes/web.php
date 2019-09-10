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

Route::get('/', 'TestController@index')->name("crud_route_name");
Route::get('/create','TestController@create')->name("crud_route_name.create");
Route::post('/create','TestController@storage')->name("crud_route_name.storage");
Route::delete('/destroy','TestController@destroy')->name("crud_route_name.destroy");
