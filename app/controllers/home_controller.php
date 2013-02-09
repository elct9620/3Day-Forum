<?php
/**
 * Home Controller
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

namespace Aotoki;

class HomeController extends BaseController {

  public static function home() {
    $app = self::getApp();

    $app->render('index.html');
  }

  public static function app($var) {
    echo $var;
  }
}
