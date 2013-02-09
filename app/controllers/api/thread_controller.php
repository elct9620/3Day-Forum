<?php
/**
 * Thread API Controller
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

namespace Aotoki\Api;

class ThreadController extends \Aotoki\BaseController {

  public static function getThreads()
  {
    $app = self::getApp();
    $req = $app->request();

    $forumID = $req->get('forumID');
    $page = $req->get('page');
    $page = $page ? $page : 1;

    self::respondJSON(\Aotoki\Thread::getThreads($forumID, (int) $page));
  }

  public static function getThread($threadID)
  {
    self::respondJSON(\Aotoki\Thread::getThread($threadID));
  }

  public static function create($forumID)
  {

  }

  public static function update($threadID)
  {

  }

  public static function destroy($threadID)
  {

  }

}
