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
Route::post('/Order/Edit', 'OrderController@EditSave');
Route::post('/Order/GetAddress', 'OrderController@GetAddress');
Route::get('/Order/Add', 'OrderController@Add');
Route::post('/Order/Add', 'OrderController@AddSave');
Route::post('/Order/Del/{orderId}', 'OrderController@Del');

// 工人管理
Route::get('/Worker/List', 'WorkerController@ListPage');
Route::post('/Worker/List', 'WorkerController@ListData');
Route::get('/Worker/Detail/{workerID}', 'WorkerController@Detail');
Route::get('/Worker/Edit/{workerID}', 'WorkerController@Edit');
Route::post('/Worker/Edit/{workerID}', 'WorkerController@SaveData');
Route::get('/Worker/Add', 'WorkerController@Add');
Route::post('/Worker/Edit', 'WorkerController@SaveData');
Route::post('/Worker/Del/{workerId}', 'WorkerController@Del');
// 服务管理
// 服务类别
Route::get('/ProductCategory/List', 'ProductCategoryController@ListPage');
Route::post('/ProductCategory/List', 'ProductCategoryController@ListData');
Route::get('/ProductCategory/Detail/{productCategoryID}', 'ProductCategoryController@Detail');
Route::get('/ProductCategory/Edit/{productCategoryID}', 'ProductCategoryController@Edit');
Route::post('/ProductCategory/Edit', 'ProductCategoryController@EditSave');
Route::get('/ProductCategory/Add', 'ProductCategoryController@Add');
Route::post('/ProductCategory/Del/{productCategoryID}', 'ProductCategoryController@Del');
// 服务信息
Route::get('/Product/List', 'ProductController@ListPage');
Route::post('/Product/List', 'ProductController@ListData');
Route::get('/Product/Detail/{productID}', 'ProductController@Detail');
Route::get('/Product/Edit/{productID}', 'ProductController@Edit');
Route::post('/Product/Edit', 'ProductController@EditSave');
Route::get('/Product/Add', 'ProductController@Add');
Route::get('/Product/Del/{productId}', 'ProductController@Del');





Auth::routes();