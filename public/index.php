<?php

use MiladRahimi\PhpRouter\Router;

require 'vendor/autoload.php';

define('VIEWS', dirname(__DIR__). DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

$router = new Router($_GET['url']);

$router->get('/',  'App\Controller\PageController::index');
$router->get('/page/{id}',  'App\Controller\PageController::show');

$router->run();


