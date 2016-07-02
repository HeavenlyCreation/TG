<?php
require __DIR__.'/../vendor/autoload.php';

define("BASEDIR", realpath(__DIR__.'/../'));

//echo "Hello World!";

//$a = new Tg\Helper\Functions();
//echo "<br/>".$a->test();


use Luracast\Restler\Restler;
use Luracast\Restler\Format\HtmlFormat;

<<<<<<< HEAD
HtmlFormat::$viewPath = 'F:/GitHub/TG/Man/Views';   //__DIR__ . '/views';
HtmlFormat::$template = 'twig';
HtmlFormat::$view = "/Layouts/test.tg";
=======
HtmlFormat::$viewPath = BASEDIR.'/Man/Views';   //__DIR__ . '/views';
HtmlFormat::$template = 'twig';
// HtmlFormat::$view = "/Layouts/test";
>>>>>>> origin/master

$r = new Restler();
$r->setSupportedFormats('JsonFormat', 'HtmlFormat');
$r->addAPIClass('Man\\Controllers\\Test');
$r->handle();


//$t = new Man\Controllers\Test();
//$t->aa("bb");

