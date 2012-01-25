<?php
/**
 * Config
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

//資料庫資訊
define('DB_HOST', 'ds029837.mongolab.com:29837'); //主機
define('DB_NAME', 'heroku_app2621958'); //資料庫
define('DB_USER', 'heroku_app2621958'); //帳號
define('DB_PASS', 't6k5lq6molupaa48sk4ohdg16r'); //密碼

//絕對路徑
if(!defined('ABSPATH')){
	define('ABSPATH', dirname(__FILE__) . '/');
}

//除錯模式
define('DEBUG', FALSE);

//Facebook API
define('FB_APP_ID', '279922215405957');
define('FB_SECRET', 'dd08b8a868e246d45330d18671eb3f21');

//Cookie 密鑰
define('COOKIE_SECRET_KEY', 'my-3day-forum');
