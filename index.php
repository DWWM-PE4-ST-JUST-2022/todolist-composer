<?php

// Include the composer's autoloader. Allow to load classes from deps (vendor) and our app in src.
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

// Use to render the template `index.html.twig` locate in templates directory and echo the output to browser.
echo $twig->render('index.html.twig', [
    // Create a variable named `title` with `Hello` value.
    'title' => 'Hello',
]);
