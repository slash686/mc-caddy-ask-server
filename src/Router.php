<?php

namespace Slash686\McCaddyAskServer;

use function Slash686\json_response;

class Router
{
    private $routes = [];
    public function get(string $uri, string $controller): void
    {
        $this->registerRoute('GET', $uri, $controller);
    }

    public function post(string $uri, string $controller): void
    {
        $this->registerRoute('POST', $uri, $controller);
    }

    public function route(string $uri, string $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                return require '../'.$route['controller'];
            }
        }

        json_response([], 404);
        die();
    }

    private function registerRoute(string $method, string $uri, string $controller): void
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }
}