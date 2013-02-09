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
}
