<?php
define('APP_NAME', 'SampleApp');

define('BASE_PATH', str_replace('public', '', __DIR__));
define('LIBRARY_PATH', BASE_PATH . 'vendor');
define('SRC_PATH', BASE_PATH . 'src');
define('APP_PATH', SRC_PATH . '/' . APP_NAME);
define('CORE_PATH', SRC_PATH . '/ThrowawayDCI');
define('RESOURCE_PATH', APP_PATH . '/Resources');
define('VIEW_PATH', RESOURCE_PATH . '/View');
define('CONFIG_PATH', RESOURCE_PATH . '/config');

//define('DEBUG_MODE', false);
define('DEBUG_MODE', true);

if (DEBUG_MODE) {
    error_reporting(E_ALL | E_STRICT);
}

date_default_timezone_set('UTC');

include_once(CORE_PATH . '/Application.php');
$app = new ThrowawayDCI\Application();
$app->run();