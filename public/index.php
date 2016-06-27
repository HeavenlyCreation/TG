<?php
require __DIR__.'/../vendor/autoload.php';

define("BASEDIR", __DIR__."../");

//echo "Hello World!";

//$a = new Tg\Helper\Functions();
//echo "<br/>".$a->test();



use Luracast\Restler\Restler;

$r = new Restler();
$r->setSupportedFormats('JsonFormat', 'HtmlFormat');
$r->addAPIClass('Man\\Controllers\\Test');
$r->handle();


//$t = new Man\Controllers\Test();
//$t->aa("bb");

