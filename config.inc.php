<?php
/**
 * Config
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

//資料庫資訊
define('DB_HOST', 'localhost'); //主機
define('DB_NAME', '3day-forum'); //資料庫
define('DB_USER', ''); //帳號
define('DB_PASS', ''); //密碼

//絕對路徑
if(!defined('ABSPATH')){
	define('ABSPATH', dirname(__FILE__) . '/');
}

//除錯模式
define('DEBUG', FALSE);

//Facebook API
define('FB_APP_ID', '');
define('FB_SECRET', '');

//Cookie 密鑰
define('COOKIE_SECRET_KEY', 'my-3day-forum');
