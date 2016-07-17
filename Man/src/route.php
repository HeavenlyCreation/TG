<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/10
 * Time: 14:40
 */

$routes->addRoute('GET', '/user', '\Man\Controllers\UserController@indexAction');
$routes->addRoute('GET', '/users', '\Man\Controllers\UserController@GetInfos');
// {id} must be a number (\d+)
$routes->addRoute('GET', '/user/{id:\d+}', '\Man\Controllers\UserController@GetInfo');
// The /{title} suffix is optional
//$routes->addRoute('GET', '/articles/{id:\d+}[/{title}]', '\Man\Controllers\UserController@indexAction');

$routes->addRoute('GET', '/worker/{id:\d+}', '\Man\Controllers\WorkerController@index');


//
$routes->addRoute('GET', '/bye/{id:\d+}[/{title}]', '');

//return $routes;