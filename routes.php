<?php

// Use this file to define all existing routes and corresponding controllers.

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Create the routes' list.
$routes = new RouteCollection();

// Declare first route (home).
$routes->add('home', new Route('/', [
    // Config the class that will be used as route's controller.
    '_controller' => \Hb\TodolistComposer\Controller\HomeController::class,
    // You can use the `::class` magic static property on a class to get
    // a string with the fullname of the class (namespace + it name).
]));

// Return the routes' list at the end of the file.
return $routes;
