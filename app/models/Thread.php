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
  protected $topic;
  protected $author;

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
