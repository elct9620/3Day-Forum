<?php
/**
 * Bootstrap
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

// Set Timezone
date_default_timezone_set("Asia/Taipei");

// Using Composer Autoload
require 'vendor/autoload.php';

// Prepare app
$app = new \Slim\Slim(array(
    'mode' => SLIM_MODE,
    'debug' => DEBUG,

    'cookies.httponly' => true,
    'cookies.secret_key' => COOKIE_SECRET,

    'templates.path' => 'app/views',
    'log.level' => 4,
    'log.enabled' => true,
    'log.writer' => new \Slim\Extras\Log\DateTimeFileWriter(array(
        'path' => 'logs',
        'name_format' => 'y-m-d'
    ))
));

// Prepare view
\Slim\Extras\Views\Twig::$twigOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('cache'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);

$app->view(new \Slim\Extras\Views\Twig());

// Setting Up Basic View Info
$app->view()->setData('css_path', 'public/assets/css');
$app->view()->setData('js_path', 'public/assets/js');
$app->view()->setData('img_path', 'public/assets/images');

// Create Database Connection
$server = "mongodb://";
if(DB_USER && DB_PASS) {
  $server .= DB_USER . ':' . DB_PASS . '@';
}
$server .= DB_HOST . '/';

try {
  BaseMongoRecord::$connection = new MongoClient($server);
  BaseMongoRecord::$database = DB_NAME;
} catch (Exception $e) {
  exit($e->getMessage());
}

unset($server); // Release

// Load Routers
include 'router.php';

// Run App
$app->run();
