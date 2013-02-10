<?php
/**
 * Post API Controller
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

namespace Aotoki\Api;

class PostController extends \Aotoki\BaseController {

  public static function getPosts()
  {
    $app = self::getApp();
    $req = $app->request();

    $threadID = $req->get('threadID');
    $page = $req->get('page');
    $page = $page ? $page : 1;

    self::respondJSON(\Aotoki\Post::getPosts($threadID, (int) $page));
  }

  public static function create()
  {
    $app = self::getApp();
    $req = $app->request();
    $user = self::currentUser();

    // Backbone JSON
    $data = json_decode($req->getBody());

    $threadID = $data->threadID;
    $content = htmlspecialchars($data->content);
    $author = $user->email;

    self::respondJSON(\Aotoki\Post::create($threadID, $content, $author));
  }

  public static function update($postID)
  {

  }

  public static function destroy($postID)
  {

  }

}
