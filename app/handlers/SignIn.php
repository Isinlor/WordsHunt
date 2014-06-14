<?php
namespace app\handlers;

class SignIn
{
    public function __construct()
    {
        //ToroHook::add("after_handler", function () { echo "After"; });
    }
    public function get($provider = '')
    {
        $container = \PimpleSingleton::get();
        $twig = $container['twig'];
        $hybridAuth = $container['hybridAuth'];

        $providersConf = $container['hybridAuthConf']['providers'];

        if (isset($providersConf[$provider]['enabled']) && $providersConf[$provider]['enabled']) {
            // automatically try to login
            $provider = $hybridAuth->authenticate('Facebook');

            // last check if user is connected
            if ($provider->isUserConnected()) {
                // get the user profile
                $user_profile = $provider->getUserProfile();
                try {
                    $user = \app\models\Users::one($provider->id.'ID = ?', $user_profile->identifier);
                } catch (\Pheasant\NotFoundException $e) {
                    $user = new \app\models\Users(array($provider->id.'ID' => $user_profile->identifier));
                    $user->email = $user_profile->emailVerified;
                    $user->firstName = $user_profile->firstName;
                    $user->save();
                }
                \app\models\User::authorize($user->id);
            }
        } elseif ($provider == 'auth') {
            \Hybrid_Endpoint::process();
            exit;
        }
        echo $twig->render('signin.html');
    }
}
