<?php
$loader = require '../../vendor/autoload.php';
$loader->add('app\\', dirname(dirname(__DIR__)));

require '../config.php';

use ToroPHP\Toro;
use ToroPHP\ToroHook;
use ToroPHP\ToroUtil;

ToroHook::add("404", function() {
    echo "Not found";
});

$handlers = 'app\handlers\\';

Toro::serve(array(
    '/' => $handlers.'Main',
    '/api/save/:string' => $handlers.'ApiSave'
));