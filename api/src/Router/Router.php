<?php

namespace App\Router;

use App\Core\Response;

class Router
{
    protected $routes = [];

    protected function addRoute(string $uri, string $controller, string $method): void
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => strtoupper($method)
        ];
    }

    public function get(string $uri, string $controller)
    {
        $this->addRoute($uri, $controller, 'get');
    }
    public function post(string $uri, string $controller)
    {
        $this->addRoute($uri, $controller, 'post');
    }
    public function put(string $uri, string $controller)
    {
        $this->addRoute($uri, $controller, 'put');
    }
    public function delete(string $uri, string $controller)
    {
        $this->addRoute($uri, $controller, 'delete');
    }
    /**
     * Routes the incoming request
     */
    public function route()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if (
                $uri == $route['uri'] &&
                $method == $route['method']
            ) {
                require($route['controller']);
                die();
            }
        }

        Response::withStatus(404, 'Not found');
    }
}
