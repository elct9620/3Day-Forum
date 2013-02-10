<?php
/**
 * User Model
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

namespace Aotoki;

class User extends \BaseMongoRecord {
  protected $email;
  protected $nickname;

  public static function getNickname($query, $id = false)
  {
    $user = null;
    if($id) {
      $user = self::findOne(array('_id'=> new \MongoId($query)));
    } else {
      $user = self::findOne(array('email' => $query));
    }

    if(count($user) != 1) {
      return false;
    }

    return $user->nickname;
  }

}
