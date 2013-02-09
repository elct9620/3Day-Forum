<?php
/**
 * Config
 *
 * @package 3day-forum
 * @author Aotoki
 * @version 2.0
 */

// Database Information (Mongo)
define('DB_HOST', 'localhost');
define('DB_NAME', '3day-forum');
define('DB_USER', '');
define('DB_PASS', '');

// Running Mode
if(getenv('SLIM_MODE') && in_array(getenv('SLIM_MODE'), array('test', 'development', 'production'))) {
  define('SLIM_MODE', getenv('SLIM_MODE'));
} else {
  define('SLIM_MODE', 'development');
}

// Debug Mode
define('DEBUG', true);

// Cookie Secret
define('COOKIE_SECRET', '3day-forum');
