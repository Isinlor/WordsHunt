<?php
namespace app\models;

use \Pheasant;
use \Pheasant\Types;

class Users extends \Pheasant\DomainObject
{
  public function properties()
  {
    return array(
      'id'    => new Types\Integer(11, 'primary auto_increment'),
      'email'  => new Types\String(255, 'required'),
      'firstName'  => new Types\String(255, 'required'),
      'GoogleID'  => new Types\String(255),
      'FacebookID'  => new Types\String(255),
    );
  }
  public function relationships()
  {
    return array(
      'Words' => Words::hasOne('id')
    );
  }
  public static function isAuthorised()
  {
  	return isset($_SESSION['id']);
  }
  public static function authorize($id)
  {
  	if ( session_id() === '') { session_start(); }
  	$_SESSION['id'] = $id;
  }
}
