<?php

// Init twig.

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

// Location of Twig template files.
$loader = new FilesystemLoader(
    __DIR__ . '/templates'
);

// Init and configure Twig's environment object.
return new Environment($loader, [
    // Set debug to true while dev.
    'debug' => true,
    // Write the transpiled templates to this directory.
    'cache' => __DIR__ . '/cache',
]);
