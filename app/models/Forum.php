<?php
/**
 * Forum Model
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

namespace Aotoki;

class Forum extends \BaseMongoRecord {

  protected $slug;
  protected $name;
  protected $parent;

  public static function getForums($parent = null)
  {
    $id = null;
    if($parent) {
      $id = new \MongoId($parent);
    }

    $forums = self::find(array('parent' => $id));

    if(count($forums) <= 0) {
      return false;
    }

    $data = array();

    foreach($forums as $forum) {
      array_push($data, array(
        'id' => $forum->_id,
        'name' => $forum->name,
        'slug' => $forum->slug
      ));
    }

    return $data;
  }

  public static function exists($forumID)
  {
    return count(self::findOne(array('_id' => new \MongoId($forumID)))) === 1;
  }

  public static function validatesSlug($slug)
  {
    $forums = self::find(array('slug' => $slug));

    if(count($forums) > 0) {
      return false;
    }

    return true;
  }

}
