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
    self::respondJSON(\Aotoki\Forum::getForums());
  }

  public static function getChildForums($forumID)
  {
    self::respondJSON(\Aotoki\Forum::getForums($forumID));
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
