<?php
/**
 * Forum Model
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

namespace Aotoki;

class Forum extends BaseMongoRecord {
  protected $slug;
  protected $name;
  protected $parent;
}
