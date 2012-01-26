<?php
/**
 * Bootstrap
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

/* 修正時區 */
date_default_timezone_set("Asia/Taipei");
 
/* 初始化 Slim Framework */
$app = new Slim(array(
	'mode' => 'production',
	'http.version' => '1.1',
	'debug' => DEBUG,
	'templates.path' => ABSPATH . 'vendor/themes',
	'cookies.secret_key' => COOKIE_SECRET_KEY,
));

/* 初始化資料庫 */
if(DB_USER || DB_PASS){
	ActiveMongo::connect(DB_NAME, DB_HOST, DB_USER, DB_PASS);
}else{
	ActiveMongo::connect(DB_NAME, DB_HOST);
}

/* 載入基本資訊 */
$basePath = str_replace('/index.php', '', $app->request()->getRootUri()) . '/';
$baseURL = "http://{$_SERVER['HTTP_HOST']}/{$basePath}";

$app->view()->setData('basePath', $basePath);
$app->view()->setData('baseURL', $baseURL);
$app->view()->setData('app', $app);

/* 讀取  App 邏輯 */
require_once(ABSPATH . 'app/Template.php');

/* 讀取 App 模型 */
require_once(ABSPATH . 'app/models/Users.php');
require_once(ABSPATH . 'app/models/Forums.php');
require_once(ABSPATH . 'app/models/Thread.php');
require_once(ABSPATH . 'app/models/Posts.php');

/* 讀取 App 介面 */
require_once(ABSPATH . 'app/web/Post.php');
require_once(ABSPATH . 'app/web/User.php');
require_once(ABSPATH . 'app/web/Home.php');

/* 運行 */
$app->run();
