<?php

use Core\Application;
use Core\Router;

$routes = require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
include_once __DIR__ . DIRECTORY_SEPARATOR . 'Includes' . DIRECTORY_SEPARATOR . 'UrlGenerator.php';
define('PROJECT_NAME', 'BornTask');

$application = new Application();
echo $application->run(new Router());