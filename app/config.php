<?php

Pheasant::setup('mysql://test:@localhost:3306/wordstree');

// $migrator = new \Pheasant\Migrate\Migrator();
// $migrator->create('words', \app\models\Words::schema());
// $migrator->create('users', \app\models\Users::schema());

use \Pimple;
class PimpleSingleton
{
    /**
     * Returns the *Singleton* instance of Pimple class.
     *
     * @staticvar Singleton $instance The *Singleton* instances of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function get()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new pimple();
        }

        return $instance;
    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct()
    {
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }
}

$container = PimpleSingleton::get();
$container['twig'] = function () {
    // view config
    $loader = new \Twig_Loader_Filesystem('../views');
    $twig = new \Twig_Environment($loader, array(
        'cache' => '../cache/views',
        'auto_reload' => true,
    ));
    $twig->addGlobal('publicDir', strstr($_SERVER['SCRIPT_NAME'], '/index.', true));

    return $twig;
};
$container['hybridAuthConf'] = array(
                                     "base_url" => "http://localhost/isinlor/WordsTree/app/public/index.php/sign-in/auth",
                                     "providers" => array (
                                                           "Google" => array (
                                                                              "enabled" => true,
                                                                              "keys" => array (
                                                                                               "id" => "",
                                                                                               "secret" => ""
                                                                                               )
                                                                              ),
                                                           "Facebook" => array (
                                                                                "enabled" => true,
                                                                                "keys" => array (
                                                                                                 "id" => "",
                                                                                                 "secret" => ""
                                                                                                 )
                                                                                ),
                                                           )
);
$container['hybridAuth'] = function ($c) {
    $hybridAuth = new Hybrid_Auth( $c['hybridAuthConf'] );

    return $hybridAuth;
};
