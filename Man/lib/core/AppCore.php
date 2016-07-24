<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/16
 * Time: 11:00
 */

namespace Lib\Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use FastRoute\RouteCollector;
//use \Lib\Route\Route;

class AppCore
{
    protected $controllerResolver;
    protected $argumentResolver;
    protected $dispatcher;
    
    public function __construct(ControllerResolverInterface $controllerResolver, ArgumentResolverInterface $argumentResolver, EventDispatcher $dispatcher)
    {
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
        $this->dispatcher = $dispatcher;
    }

    public function handle(Request $request)
    {
        $frDispatcher = \FastRoute\simpleDispatcher(function(RouteCollector $routes) {
//            Route::setRoutes($routes);
            include BASEDIR.'/src/route.php';
        });

        // Fetch method and URI from somewhere
        $httpMethod = $request->server->get('REQUEST_METHOD');
        $uri = $request->getPathInfo();

        $routeInfo = $frDispatcher->dispatch($httpMethod, $uri);

        $response = new Response();
        try{
            switch ($routeInfo[0]) {
                case \FastRoute\Dispatcher::NOT_FOUND:
                    // ... 404 Not Found
//                    $response = new Response('Not Found', 404);
                    $response->sendContent('Not Found');
                    $response->setStatusCode(Response::HTTP_NOT_FOUND);
                    break;
                case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                    // $allowedMethods = $routeInfo[1];
                    // ... 405 Method Not Allowed
//                    $response = new Response('Method Not Allowed', 405);
                    $response->sendContent('Method Not Allowed');
                    $response->setStatusCode(Response::HTTP_METHOD_NOT_ALLOWED);
                    break;
                case \FastRoute\Dispatcher::FOUND:
                    $handler = $routeInfo[1];
                    $vars = $routeInfo[2];
                    // ... call $handler with $vars
                    $vars['_controller'] = str_replace('@', '::', $handler);
                    $request->attributes->add($vars);
                    $controller = $this->controllerResolver->getController($request);
                    $arguments = $this->argumentResolver->getArguments($request, $controller);
                    $backContent = call_user_func_array($controller, $arguments);
                    $response->setContent($backContent);
                    $response->setStatusCode(Response::HTTP_OK);
                    break;
            }
        }catch(Exception $e){
//            $response = new Response('Nope, an error occurred', 500);
            $response->sendContent('Nope, an error occurred');
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

//        $this->dispatcher->dispatch('response', new ResponseEvent($response, $request));
        
        return $response;
    }
}