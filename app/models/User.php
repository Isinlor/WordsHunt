<?php
namespace app\models;

class User
{
  public static function isAuthorised()
  {
    if ( session_id() === '') { session_start(); }

    return isset($_SESSION['id']);
  }
  public static function authorize($id)
  {
    if ( session_id() === '') { session_start(); }
    $_SESSION['id'] = $id;
  }
}
