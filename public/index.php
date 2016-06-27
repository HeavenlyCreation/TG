<?php
require __DIR__.'/../vendor/autoload.php';

echo "Hello World!";

$a = new Tg\Helper\Functions();
echo "<br/>".$a->test();
