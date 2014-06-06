<?php
namespace app\models;

use \Pheasant;
use \Pheasant\Types;

class Words extends \Pheasant\DomainObject
{
  public function properties()
  {
    return array(
      'entry_id'    => new Types\Integer(11, 'primary'),
      'id'    => new Types\Integer(11, 'required'),
      'word'  => new Types\String(255, 'required'),
      'translation'  => new Types\String(255, 'required'),
      'exp'  => new Types\Integer(11, 'default=0')
    );
  }
  public function relationships()
  {
    return array(
      'Users' => Users::hasOne('id')
    );
  }
}
