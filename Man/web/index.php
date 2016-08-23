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



/** 系统常量定义 **/
require __DIR__.'/../vendor/autoload.php';
define('BASEDIR', realpath(__DIR__.'/../').DIRECTORY_SEPARATOR);    // 项目文件系统根目录
define('ROOTDIR', realpath(__DIR__));           // URL根路径
define('CONFDIR', BASEDIR.'lib'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR);

/** 启动项目文件 **/
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Lib\Core\Config;

// config文件加载
Config::init();

/** 根据 DEBUG 判断是否显示错误信息 **/
if(Config::get('app', 'DEBUG'))
    ini_set('display_error', '1');
else
    ini_set('display_error', '0');

// Eloquent ORM 数据库配置装载
$capsule = new Capsule;
//$capsule->addConnection($config['database']['connections']['mysql']);
$capsule->addConnection(Config::get('database', 'connections.mysql'));
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();


$request = Request::createFromGlobals();

// AppCore参数准备
$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();
$dispatcher = new EventDispatcher();
$dispatcher->addListener('response', function(Core\ResponseEvent $event){
    $response = $event->getResponse();

    if($response->isRedirection() || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'),'html')) || 'html'!==$event->getRequest()->getRequestFormat()){
        return;
    }
    $response->setContent($response->getContent().'GA CODE');
});

$appCore = new \Lib\Core\AppCore($controllerResolver, $argumentResolver, $dispatcher);
$response = $appCore->handle($request);

$response->send();