<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'IndexController@Index');


// $app->get('/example', 'ExampleController@test');

$app->get('/ProductList', function () {
    return view('Custom.ProductList');
});
