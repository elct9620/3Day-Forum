<?php
/**
 * Post Model
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

namespace Aotoki;

class Post extends \BaseMongoRecord {
  protected $content;
  protected $author;
  protected $thread;

  protected $created_at;
  protected $updated_at;

  public static function getPosts($threadID, $page)
  {
    $posts = self::find(array('thread' => new \MongoId($threadID)));

    if(count($posts) <= 0) {
      return false;
    }

    $data = array();

    foreach($posts as $post) {
      array_push($data, array(
        'id' => $post->_id,
        'content' => nl2br($post->content),
        'author' => User::getUser($post->author),
        'updated_at' => $post->updated_at
      ));
    }

    return $data;

  }

  public static function create($threadID, $content, $author)
  {

    if(!Thread::exists($threadID)) {
      return array(
        'error' => 400,
        'message' => 'Thread doesn\'t exists.'
      );
    }

    $post = new Post;
    $post->thread = new \MongoId($threadID);
    $post->content = $content;
    $post->author = $author;

    if(!$post->save()) {
      return array(
        'error' => 500,
        'message' => 'Create post failed.'
      );
    }

    return array(
      'id' => $post->_id,
      'content' => nl2br($post->content),
      'author' => User::getUser($post->author),
      'updated_at' => $post->updated_at
    );
  }

  public static function delete($postID, $user)
  {
    $post = self::findOne(array("_id" => new \MongoId($postID)));

    if(count($post) !== 1) {
      return array(
        'error' => 404,
        'message' => "Post not found"
      );
    }

    if(!(bool)$user->is_admin && ($user->email != $post->author)) {
      return array(
        'error' => 403,
        'message' => "You can't delete post"
      );
    }

    $post->destroy();

    return array(
      'thread' => (string) $post->thread
    );
  }

  public function afterNew()
  {
    $this->created_at = time();
  }

  public function beforeSave()
  {
    $this->updated_at = time();
  }
}
