<?php
require __DIR__.'/../vendor/autoload.php';

echo "Hello World!";

// $a = new Tg\Helper\Functions();
// echo "<br/>".$a->test();

use Luracast\Restler\Restler;
$r = new Restler();
$r->addAPIClass('//Man//Controllers//TestController');
$r->handle();
// $test = new Man\Controllers\TestController();
// $test->getAA();