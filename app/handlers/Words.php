<?php
namespace app\handlers;

class Words
{
    public function __construct()
    {
        \ToroPHP\ToroHook::add("before_handler", function () {
            if (!\app\models\User::isAuthorised()) {
                header('Location:'.strstr($_SERVER['SCRIPT_NAME'], '/index.', true).'/index.php/sign-in');
            }
        });
    }
    public function get()
    {
        $words = \app\models\Words::all()->getIterator();
        $container = \PimpleSingleton::get();
        $twig = $container['twig'];
        echo $twig->render('words.html', array('words' => $words));
    }
}
