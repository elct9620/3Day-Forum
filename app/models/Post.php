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
  protected $master_post;

  protected $created_at;
  protected $updated_at;

  public static function getPosts($threadID, $page)
  {
    $posts = self::find(array('thread' => new \MongoId($threadID)));

    if(count($posts) <= 0) {
      return false;
    }

    $master_post = false;
    $data = array();

    foreach($posts as $post) {
      $new_data = array(
        'id' => $post->_id,
        'content' => $post->content,
        'author' => $post->author,
        'master_post' => (bool) $post->master_post,
        'created_at' => $post->created_at,
        'updated_at' => $post->updated_at
      );

      if(!$master_post && $post->master_post) {
        $master_post = $new_data;
        continue;
      }

      array_push($data, $new_data);
    }

    if($master_post) {
      array_unshift($data, $master_post);
    }

    return $data;

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
