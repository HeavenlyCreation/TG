<?php

//use Symfony\Component\HttpFoundation\Request;   // 使用Request命名空间
//
//$loader = require_once __DIR__.'/../config/bootstrap.php.cache';   // bootstrap的自加载文件，包括autoload等
//
//require_once __DIR__.'/../config/AppKernel.php';   //bundle的加载
//
//$kernel = new AppKernel('yjf', true);   // 核心类AppKernel
//
//$kernel->loadClassCache();   // 加载classCache
//
//$request = Request::createFromGlobals();  // 获取$_REQUEST
//
//$response = $kernel->handle($request);   // 处理请求，将request转化为response
//
//$response->send();   // 发送response
//
//$kernel->terminate($request, $response);  // response的后续操作








require __DIR__.'/../vendor/autoload.php';
define("BASEDIR", realpath(__DIR__.'/../'));

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//
$request = Request::createFromGlobals();
//$routes = include __DIR__.'/../boot/route.php';
$map = array(
    '/test'  => 'test',
    '/bye'   => 'bye',
);


//$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
//    $r->addRoute('GET', '/users', 'get_all_users_handler');
//    // {id} must be a number (\d+)
//    $r->addRoute('GET', '/user/getinfo/{param:\d+}', 'UserController.GetInfo');
//    // The /{title} suffix is optional
//    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
//});
//
//// Fetch method and URI from somewhere
//$httpMethod = $_SERVER['REQUEST_METHOD'];
//$uri = $request->getPathInfo();
//
//// Strip query string (?foo=bar) and decode URI
//if (false !== $pos = strpos($uri, '?')) {
//    $uri = substr($uri, 0, $pos);
//}
//$uri = rawurldecode($uri);
//
//$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
//switch ($routeInfo[0]) {
//    case FastRoute\Dispatcher::NOT_FOUND:
//        // ... 404 Not Found
//        break;
//    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
//        $allowedMethods = $routeInfo[1];
//        // ... 405 Method Not Allowed
//        break;
//    case FastRoute\Dispatcher::FOUND:
//        $handler = $routeInfo[1];
//        $vars = $routeInfo[2];
//        // ... call $handler with $vars
//        break;
//}


$path = $request->getPathInfo();
if (isset($map[$path])) {
    ob_start();
    extract($request->query->all(), EXTR_SKIP);
    include sprintf( __DIR__ . '/../src/Views/%s.php', $map[$path]);
    $response = new Response(ob_get_clean());
} else {
    $response = new Response('Not Found', 404);
}

$response->send();

