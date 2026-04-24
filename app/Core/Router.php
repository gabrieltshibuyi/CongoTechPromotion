<?php

namespace App\Core;

final class Router
{
    private array $routes = [];

    public function __construct(private readonly string $baseUrl = '')
    {
    }

    public function get(string $uri, array|callable $action): void
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, array|callable $action): void
    {
        $this->addRoute('POST', $uri, $action);
    }

    public function dispatch(string $uri, string $method): void
    {
        $path = $this->normalizePath($uri);
        $route = $this->routes[$method][$path] ?? null;

        if ($route === null) {
            http_response_code(404);
            echo 'Page introuvable';
            return;
        }

        if (is_callable($route)) {
            $route();
            return;
        }

        [$controllerClass, $controllerMethod] = $route;
        $controller = new $controllerClass();
        $controller->{$controllerMethod}();
    }

    private function addRoute(string $method, string $uri, array|callable $action): void
    {
        $path = $this->cleanPath($uri);
        $this->routes[$method][$path] = $action;
    }

    private function normalizePath(string $uri): string
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';

        $prefixes = [];

        if ($this->baseUrl !== '') {
            $prefixes[] = $this->baseUrl . '/public';
            $prefixes[] = $this->baseUrl;
        } else {
            $prefixes[] = '/public';
        }

        foreach ($prefixes as $prefix) {
            if ($prefix !== '' && str_starts_with($path, $prefix)) {
                $path = substr($path, strlen($prefix)) ?: '/';
                break;
            }
        }

        return $this->cleanPath($path);
    }

    private function cleanPath(string $path): string
    {
        $normalized = '/' . trim($path, '/');

        return $normalized === '//' ? '/' : $normalized;
    }
}
