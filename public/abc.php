<?php
require __DIR__.'/../vendor/autoload.php';

//$a = new Tg\Helper\Functions();
//echo $a->test();

//$dispatcher = FastRoute\Dispatcher\sim

use Luracast\Restler\Restler;

$r = new Restler();
$r->addAPIClass('Man\\Controllers\\Test');
$r->handle();