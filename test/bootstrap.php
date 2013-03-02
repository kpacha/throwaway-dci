<?php

define('APP_NAME', 'ThrowawayDCITest');
define('RESOURCE_PATH', __DIR__ . '/Resources');
//define('VIEW_PATH', RESOURCE_PATH . '/View');
define('CONFIG_PATH', RESOURCE_PATH . '/config');
define('LIBRARY_PATH', __DIR__ . '/../vendor');
define('SRC_PATH', __DIR__ . '/../src');

// add the framework autoloader
require_once LIBRARY_PATH . '/composer/ClassLoader.php';
$autoloader = new \Composer\Autoload\ClassLoader();
$autoloader->add("ThrowawayDCI", SRC_PATH);
$autoloader->add("SampleApp", SRC_PATH);
$autoloader->register();

$file = LIBRARY_PATH . '/autoload.php';
if (!file_exists($file)) {
    throw new \Exception('Install dependencies to run test suite. "php composer.phar install --dev"');
}

require_once $file;