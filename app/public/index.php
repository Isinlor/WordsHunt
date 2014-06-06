<?php
$loader = require '../../vendor/autoload.php';
$loader->add('app\\', dirname(dirname(__DIR__)));

require '../config.php';

use ToroPHP\Toro;
use ToroPHP\ToroHook;
use ToroPHP\ToroUtil;

ToroHook::add("404", function($v) {
    echo "Not found <pre>";
    var_dump($v);
});

$handlers = 'app\handlers\\';
$api = $handlers.'api\\';

Toro::serve(array(
    '/' => $handlers.'Main',
    '/words' => $handlers.'Words',
    '/sign-in' => $handlers.'SignIn',
    '/sign-in/:string' => $handlers.'SignIn',
    '/api/save/:string' => $api.'Save'
));