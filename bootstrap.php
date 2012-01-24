<?php
/**
 * Bootstrap
 * 
 * @package 3day-forum
 * @author Aotoki
 * @version 1.0
 */

/* 初始化 Slim Framework */
$app = new Slim(array(
	'mode' => 'development',
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

/* 讀取  App 邏輯 */

/* 讀取 App 模型 */
require_once(ABSPATH . 'app/models/User.php');
/* 讀取 App 介面 */


/* 運行 */
$app->run();
