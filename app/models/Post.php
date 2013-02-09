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

  public function afterNew()
  {
    $this->created_at = time();
  }

  public function beforeSave()
  {
    $this->updated_at = time();
  }
}
