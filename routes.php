<?php

// Use this file to define all existing routes and corresponding controllers.

use Hb\TodolistComposer\Controller\HomeController;
use Hb\TodolistComposer\Controller\ShowController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Create the routes' list.
$routes = new RouteCollection();

// Declare first route (home).
$routes->add('home', new Route('/', [
    // Config the class that will be used as route's controller.
    '_controller' => HomeController::class,
    // You can use the `::class` magic static property on a class to get
    // a string with the fullname of the class (namespace + it name).
]));

// Declare To do show route.
$routes->add('show_todo', new Route('/todo/{id}', [
    '_controller' => ShowController::class,
]));

// Return the routes' list at the end of the file.
return $routes;
