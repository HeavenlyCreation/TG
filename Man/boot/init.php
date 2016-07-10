<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/9
 * Time: 21:20
 */

require __DIR__.'/../vendor/autoload.php';
define("BASEDIR", realpath(__DIR__.'/../'));

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$response = new Response();