<?php
namespace app\handlers;

class Auth
{
    public function __construct()
    {
        //ToroHook::add("after_handler", function () { echo "After"; });
    }
    public function get()
    {
        \Hybrid_Endpoint::process();
        exit;
    }
}
