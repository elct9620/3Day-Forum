<?php
/**
 * Thread Model
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

namespace Aotoki;

class Thread extends \BaseMongoRecord {
  protected $subject;
  protected $content;
  protected $author;
  protected $forum;

  protected $created_at;
  protected $updated_at;

  public static function getThreads($forumID, $page = 1)
  {
    $threads = self::find(array('forum' => new \MongoId($forumID)));

    if(count($threads) <= 0) {
      return false;
    }

    $data = array();

    foreach($threads as $thread) {
      array_push($data, array(
        'id' => $thread->_id,
        'subject' => $thread->subject,
        'content' => $thread->content,
        'author' => User::getNickname($thread->author),
        'created_at' => $thread->created_at,
        'updated_at' => $thread->updated_at
      ));
    }

    return $data;
  }

  public static function getThread($threadID)
  {
    $thread = self::findOne(array('_id' => new \MongoId($threadID)));

    if(count($thread) != 1) {
      return false;
    }

    return array(
       'id' => $thread->_id,
        'subject' => $thread->subject,
        'content' => $thread->content,
        'author' => User::getNickname($thread->author),
        'updated_at' => $thread->updated_at
    );
  }

  public static function create($forumID, $subject, $content, $author)
  {
    if(!Forum::exists($forumID)) {
      return array(
        'error' => 400,
        'message' => 'Forum doesn\'t exists, ' . $forumID
      );
    }

    $thread = new Thread;
    $thread->forum = new \MongoId($forumID);
    $thread->subject = $subject;
    $thread->content = $content;
    $thread->author = $author;

    if(!$thread->save()) {
      return array(
        'error' => 500,
        'message' => "Create thread failed!"
      );
    }

    return array(
      'id' => $thread->_id,
      'forum' => (string) $thread->forum,
      'subject' => $thread->subject,
      'content' => $thread->content,
      'author' => User::getNickname($thread->author),
      'updated_at' => $thread->updated_at
    );
  }

  public static function exists($threadID)
  {
    return count(self::findOne(array('_id' => new \MongoId($threadID)))) === 1;
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
