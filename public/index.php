<?php

/**
 * @author Yuana 
 * @since May, 20 2018
 */

use App\App;

error_reporting(E_ALL | E_STRICT);
$rootDir = dirname(__FILE__, 2);

require $rootDir . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$app = new App($rootDir);
$app->setup();
$app->run();