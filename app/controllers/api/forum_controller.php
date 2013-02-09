<?php
/**
 * Forum API Controller
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

namespace Aotoki\Api;

class ForumController extends \Aotoki\BaseController {

  public static function getForums()
  {
    $app = self::getApp();
    $req = $app->request();

    $parent = $req->get('parent');

    if($parent) {
      self::respondJSON(\Aotoki\Forum::getForums($parent));
    } else {
      self::respondJSON(\Aotoki\Forum::getForums());
    }
  }

  public static function create()
  {

  }

  public static function update()
  {

  }

  public static function destroy()
  {

  }

}
