<?php
/**
 * User API Controller
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

namespace Aotoki\Api;

class UserController extends \Aotoki\BaseController {

  public static function updateNickname()
  {
    $app = self::getApp();
    $req = $app->request();
    $user = self::currentUser();

    $new_nickname = $req->post('nickname');

    $user->nickname = htmlspecialchars($new_nickname);

    $data = array(
      'nickname' => $user->nickname
    );

    if(!$user->save()) {
      $data = array(
        'error' => 400,
        'message' => 'Update failed'
      );
    }

    self::respondJSON($data);

  }

}
