<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/example', function () {
    return view('example');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', 'HomeController@Index');

// 订单管理
Route::get('/Order/List', 'OrderController@ListPage');
Route::post('/Order/List', 'OrderController@ListData');
Route::get('/Order/Detail/{orderID}', 'OrderController@Detail');
Route::get('/Order/Edit/{orderID}', 'OrderController@Edit');