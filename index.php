<?php

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Include the composer's autoloader. Allow to load classes from deps (vendor)
// and our app in src.
require_once __DIR__ . '/vendor/autoload.php';

// Location of Twig template files.
$loader = new \Twig\Loader\FilesystemLoader(
        __DIR__ . '/templates'
);

// Init and configure Twig's environment object.
$twig = new \Twig\Environment($loader, [
    // Set debug to true while dev.
    'debug' => true,
    // Write the transpiled templates to this directory.
    'cache' => __DIR__ . '/cache',
]);

// Declare first route (home).
$route = new Route('/', [
    // Config the class that will be used as route's controller.
    '_controller' => \Hb\TodolistComposer\Controller\HomeController::class,
    // You can use the `::class` magic static property on a class to get
    // a string with the fullname of the class (namespace + it name).
]);

// Create the routes' list.
$routes = new RouteCollection();
$routes->add('home', $route);

// On some apache server, the PATH_INFO in $_SERVER is missing
// In that case, we have to recreate it.
if (!isset($_SERVER['PATH_INFO'])) {
    // $path = /composer/todolist/bonjour
    $path = parse_url($_SERVER['REQUEST_URI'])['path'];
    // $projectPath = /composer/todolist
    $projectPath = substr($_SERVER['SCRIPT_NAME'], 0, -10);
    // $result = /bonjour
    $result = substr($path, strlen($projectPath));
    $_SERVER['PATH_INFO'] = $result;
}

$context = new RequestContext();

// Create UrlMatcher instance. It will be used to compare browser request
// and routes list to choose the controller.
$matcher = new UrlMatcher($routes, $context);

try {
    // Compare routes list and request, return info as associative array.
    $parameters = $matcher->match($_SERVER['PATH_INFO']);
} catch (\Symfony\Component\Routing\Exception\ResourceNotFoundException $e) {
    // If the route does not exist, it throw a ResourceNotFoundException.

    // Display a 404 error page.
    http_response_code(404);
    echo $twig->render('404.html.twig', [
        // Set the title of the page as 404 message.
        'title' => 'Oops, Page not found - 404',
    ]);

    // Exit to completely stop the program.
    // We just need to print our 404 error.
    exit;
}

// Retrieve the controller class for the route found by the matcher.
$controllerClass = $parameters['_controller'];

// Dynamically new object from a variable.
// This create an instance of the controller class.
$controller = new $controllerClass();

// Call the invoke magic method of this object. Same as `$controller->__invoke();`
$controller();
