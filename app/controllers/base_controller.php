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

    echo json_encode($data);
  }
}
