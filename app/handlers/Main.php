<?php
namespace app\handlers;

class Main
{
    public function __construct()
    {
        //ToroHook::add("after_handler", function () { echo "After"; });
    }
    public function get()
    {
        $container = \PimpleSingleton::get();
        $twig = $container['twig'];
        echo $twig->render('index.html');
    }
}
