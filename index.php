<?php
/**
 * 3Day Fourum
 * 
 * @package 3day-fourm
 * @author Aotoki
 * @version 1.0
 */

/* 載入設定檔 */
 
require_once('config.inc.php');
 
/**
 * 載入必要函式庫 
 */

//Slim Framework 
require_once(ABSPATH . 'lib/Slim/Slim.php');
 
//ActiveMongo
require_once(ABSPATH . 'lib/ActiveMongo/ActiveMongo.php');

//Facebook API
require_once(ABSPATH . 'lib/Facebook/facebook.php');

/* 載入起動器 */
require_once('bootstrap.php');

?>
