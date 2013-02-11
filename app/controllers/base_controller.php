<?php
/**
 * Base Controller
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

namespace Aotoki;

class BaseController {
  public static function getApp()
  {
    return \Slim\Slim::getInstance();
  }

  public static function respondJSON($data)
  {
    $app = self::getApp();

    $res = $app->response();
    $res['Content-Type'] = 'application/json';

    if(isset($data['error'])) {
      $app->response()->status((int) $data['error']);
      $data = array(
        'error' => (string) $data['message']
      );
    }

    echo json_encode($data);
  }

  public static function authorizeUser()
  {
    $app = self::getApp();
    $req = $app->request();

    $authorized = false;

    if(isset($_SESSION['email'])) {
      $user = \Aotoki\User::findOne(array('email' => $_SESSION['email']));

      if(count($user) === 1) {
        $authorized = true;
      }

    }

    if($req->isAjax()) {

      if(!$authorized) {
        $app->response()->status(403);
        self::respondJSON(array(
          'error' => 'Must Login First'
        ));
        $app->stop();
      }

    } else {
      if(!$authorized) {
        $app->flush('error', 'Must Login First');
        $app->reidrect($app->urlFor('home'));
      }
    }

  }

  public static function currentUser()
  {
    if(isset($_SESSION['email'])) {

      $user = \Aotoki\User::findOne(array('email' => $_SESSION['email']));

      if(count($user) === 1) {
        return $user;
      }

    }

    return false;
  }

}
