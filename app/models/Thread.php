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
  protected $id;
  protected $subject;
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
        'author' => $thread->author,
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
        'author' => $thread->author,
        'created_at' => $thread->created_at,
        'updated_at' => $thread->updated_at
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
