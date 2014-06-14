<?php
namespace app\handlers\api;

class Save
{
function __construct()
{
        \ToroPHP\ToroHook::add("before_handler", function () {
            if (!\app\models\User::isAuthorised()) {
                header('Location:'.strstr($_SERVER['SCRIPT_NAME'], '/index.', true).'/index.php/sign-in');
            }
        });
}
    public function get($word)
    {
        // create new word
        $words = new \app\models\Words();
        $words->id = $_SESSION['id'];
        $words->word = $word;
        $words->translation = $word;

        // save word
        $words->save();

        //echo 'alert(\'hello '.$word.' world\');';
    }
}
