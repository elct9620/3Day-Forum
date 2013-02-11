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

  public static function create()
  {
    $app = self::getApp();
    $req = $app->request();
    $user = self::currentUser();

    // Backbone JSON Parse
    $data = json_decode($req->getBody());

    $forumID = $data->forumID;
    $subject = htmlspecialchars($data->subject);
    $content = htmlspecialchars($data->content);
    $author = $user->email;

    self::respondJSON(\Aotoki\Thread::create($forumID, $subject, $content, $author));
  }

  public static function update($threadID)
  {

  }

  public static function destroy($threadID)
  {
    $user = self::currentUser();
    self::respondJSON(\Aotoki\Thread::delete($threadID, $user));
  }

}
