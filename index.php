<?php
/**
 * Describe my file.
 *
 * @author Benjamin
 * @see
 * @deprecated
 */

use Hb\TodolistComposer\Router;

// Include the composer's autoloader. Allow to load classes from deps (vendor)
// and our app in src.
require_once __DIR__ . '/vendor/autoload.php';

/** @var Twig\Environment $twig The twig's env to render templates. */
$twig = require_once __DIR__ . '/twig.php';
/** @var Symfony\Component\Routing\RouteCollection $routes */
$routes = require_once __DIR__ . '/routes.php';
/** @var Doctrine\DBAL\Driver\Connection $db */
$db = require_once __DIR__ . '/db.php';

$router = new Router($routes, $twig, $db);

$router->callController();
