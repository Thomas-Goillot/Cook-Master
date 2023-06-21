<?php

namespace App;

class Router
{
    private $routes = [];

    public function addRoute($method, $path, $handler, $middleware = null)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    public function handleRequest($method, $uri)
    {
        $matchedRoute = null;
        $routeParams = [];

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $this->matchPath($route['path'], $uri, $routeParams)) {
                $matchedRoute = $route;
                break;
            }
        }

        if ($matchedRoute) {
            $authMiddleware = $matchedRoute['middleware'] ?? null;
            if ($authMiddleware && !$authMiddleware()) {
                return;
            }

            $handler = $matchedRoute['handler'];
            $handler(...$routeParams);
        } else {
            http_response_code(404);
            echo "Route non trouvée";
        }
    }

    private function matchPath($routePath, $requestPath, &$routeParams)
    {
        $routePath = trim($routePath, '/');
        $requestPath = trim($requestPath, '/');

        $routeSegments = explode('/', $routePath);
        $requestSegments = explode('/', $requestPath);

        if (count($routeSegments) !== count($requestSegments)) {
            return false;
        }

        $numSegments = count($routeSegments);

        for ($i = 0; $i < $numSegments; $i++) {
            $routeSegment = $routeSegments[$i];
            $requestSegment = $requestSegments[$i];

            if ($routeSegment !== $requestSegment && !preg_match('/^\{.+\}$/', $routeSegment)) {
                return false;
            }

            if (preg_match('/^\{.+\}$/', $routeSegment)) {
                $paramName = trim($routeSegment, '{}');
                $routeParams[$paramName] = $requestSegment;
            }
        }

        return true;
    }

}

