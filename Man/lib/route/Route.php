<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/23
 * Time: 16:20
 */

namespace Lib\Route;

use FastRoute\RouteCollector;


trait Route
{
    protected $routes;
    public $route;
    public $controllersPath;

//    public function __construct(RouteCollector $routes)
//    {
//        $this->routes = $routes;
//    }

    public function setRoutes(RouteCollector $routes){
//        self::routes = $routes;
        $this->routes = $routes;
    }

    public function get($url, $path, $routes = self::routes){
        $routes->addRoute('GET', $url, $path);
    }

    public function post($url, $path, $routes = self::routes){
        $routes->addRoute('POST', $url, $path);
    }
}