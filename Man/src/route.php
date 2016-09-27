<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/10
 * Time: 14:40
 */




//Route::get('/login', '\Man\Controllers\LoginController@index');

// 登陆
$routes->addRoute('GET', '/login', '\Man\Controllers\LoginController@index');
// 后台首页
$routes->addRoute('GET', '/home', '\Man\Controllers\HomeController@index');
// 工人列表
$routes->addRoute('GET', '/workers', '\Man\Controllers\workerController@index');
$routes->addRoute('POST', '/workers', '\Man\Controllers\workerController@Index2');
$routes->addRoute('GET', '/workerDetail/{workerID:\d+}', '\Man\Controllers\workerController@Detail');
// 订单列表
$routes->addRoute('GET', '/orders', '\Man\Controllers\OrderController@index');
$routes->addRoute('POST', '/orders', '\Man\Controllers\OrderController@index2');
$routes->addRoute('GET', '/detail/{orderID:\d+}', '\Man\Controllers\OrderController@Detail');


//$routes->addRoute('GET', '/user', '\Man\Controllers\UserController@indexAction');
//$routes->addRoute('GET', '/users', '\Man\Controllers\UserController@GetInfos');
//// {id} must be a number (\d+)
//$routes->addRoute('GET', '/user/{id:\d+}', '\Man\Controllers\UserController@GetInfo');
//// The /{title} suffix is optional
////$routes->addRoute('GET', '/articles/{id:\d+}[/{title}]', '\Man\Controllers\UserController@indexAction');
//
//$routes->addRoute('GET', '/worker/{id:\d+}', '\Man\Controllers\WorkerController@index');
//
//
//
//
//
////
//$routes->addRoute('GET', '/bye/{id:\d+}[/{title}]', '');





//return $routes;