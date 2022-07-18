<?php

use Hb\TodolistComposer\Router;

// Include the composer's autoloader. Allow to load classes from deps (vendor)
// and our app in src.
require_once __DIR__ . '/vendor/autoload.php';

$twig = require_once __DIR__ . '/twig.php';
$routes = require_once __DIR__ . '/routes.php';
$db = require_once __DIR__ . '/db.php';

$router = new Router($routes, $twig, $db);

$router->callController();
