<?php
/**
 * User Controller
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

namespace Aotoki;

class UserController extends BaseController {

  public static function login()
  {
    $app = self::getApp();
    $req = $app->request();

    $assertion = $req->post('assertion');
    $auth_status = false;

    $user = null;

    try {
      $verifier = new \browserid\Verifier($req->getHost());
      $res = $verifier->verify($assertion);

      if($res->status == "okay") {
        $_SESSION['email'] = $res->email;

        $user = \Aotoki\User::findOne(array('email' => $res->email));

        if(count($user) != 1) {
          $user = new \Aotoki\User;
          $user->email = $res->email;
          $user->nickname = substr($res->email, 0, strpos($res->email, '@'));
          $user->save();
        }

        $auth_status = true;

      }

    } catch (Exception $e) {
      // Do no thing ...
    }

    if($req->isAjax()) {
      $data = array();

      if($auth_status) {
        $data = array(
          'email' => $user->email,
          'nickname' => $user->nickname,
          'gavatar' => md5(strtolower(trim($user->email)))
        );
      } else {
        $app->response()->status(400);
        $data = array(
          'error' => 'Login Failed'
        );
      }

      self::respondJSON($data);
    } else {
      if(!$auth_status) {
        $app->flush('error', 'Login failed');
      }

      $app->redirect($app->urlFor('home'));
    }

  }

  public static function logout()
  {
    $app = self::getApp();

    unset($_SESSION['email']);

    if($req->isAjax()) {
      self::respondJSON(array(
        'status' => 'okay'
      ));
    } else {
      $app->flush('notice', 'Logout Success');
      $app->redirect($app->urlFor('home'));
    }
  }

}
