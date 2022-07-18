<?php

namespace Hb\TodolistComposer;

use Doctrine\DBAL\Connection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Twig\Environment;

class Router
{
    private UrlMatcher $urlMatcher;

    public function __construct(
        private RouteCollection $routes,
        private Environment $twig,
        private Connection $connection,
    ) {
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

        // Create UrlMatcher instance. It will be used to compare browser request
        // and routes list to choose the controller.
        $this->urlMatcher = new UrlMatcher($this->routes, new RequestContext());
    }

    /**
     * This method is use to send the controller
     */
    public function callController(): void
    {
        try {
            // Compare routes list and request, return info as associative array.
            $parameters = $this->urlMatcher->match($_SERVER['PATH_INFO']);
        } catch (\Symfony\Component\Routing\Exception\ResourceNotFoundException $e) {
            // If the route does not exist, it throw a ResourceNotFoundException.
            $this->render404Error();
        }

        // Retrieve the controller class for the route found by the matcher.
        $controllerClass = $parameters['_controller'];

        // Dynamically new object from a variable.
        // This create an instance of the controller class.
        // The controller need to be init with a Twig instance pass to the construct and the Dbal connection too.
        $controller = new $controllerClass(
            $this->twig,
            $this->connection,
        );

        // Call the invoke magic method of this object. Same as `$controller->__invoke();`
        echo $controller($parameters);
    }

    /**
     * PHPDoc used to send this method will never return anything.
     * @return never-return
     */
    private function render404Error(): void
    {
        // Display a 404 error page.
        http_response_code(404);
        echo $this->twig->render('404.html.twig', [
            // Set the title of the page as 404 message.
            'title' => 'Oops, Page not found - 404',
        ]);

        // Exit to completely stop the program.
        // We just need to print our 404 error.
        exit;
    }
}
