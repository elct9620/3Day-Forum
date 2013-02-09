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
}
