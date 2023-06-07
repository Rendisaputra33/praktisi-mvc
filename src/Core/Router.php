<?php

namespace App\Core;

class Router
{
    private static array $routes = [];

    private static function add(string $method, string $path, array $handler): void {
        self::$routes[$method][] = [
            'path' => $path,
            'controller' => $handler[0],
            'method' => $handler[1]
        ];
    }

    /**
     * digunakan untuk mendaftarkan url dengan method get
     * @param string $path
     * @param array $handler
     * @return void
     */
    public static function get(string $path, array $handler): void {
        self::add('GET', $path, $handler);
    }

    /**
     * digunakan untuk mendaftarkan url dengan method post
     * @param string $path
     * @param array $handler
     * @return void
     */
    public static function post(string $path, array $handler): void {
        self::add('POST', $path, $handler);
    }

    /**
     * digunakan untuk mendaftarkan url dengan method put
     * @param string $path
     * @param array $handler
     * @return void
     */
    public static function put(string $path, array $handler): void {
        self::add('PUT', $path, $handler);
    }

    /**
     * digunakan untuk mendaftarkan url dengan method delete
     * @param string $path
     * @param array $handler
     * @return void
     */
    public static function delete(string $path, array $handler): void {
        self::add('DELETE', $path, $handler);
    }

    /**
     * digunakan untuk memecah path variable
     * @param string $pattern
     * @return string
     */
    private static function patternToRegex(string $pattern): string {
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $pattern);
        return str_replace('/', '\/', $pattern);
    }

    /**
     * digunakan untuk mencari fungsi mana yang akan dieksekusi
     * @param string $method
     * @param string $url
     * @return array|null
     */
    private static function resolve(string $method, string $url): ?array
    {
        $routes = self::$routes[$method] ?? [];

        foreach ($routes as $route) {
            $pattern = '#^' . self::patternToRegex($route['path']) . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                return [
                    'controller' => $route['controller'],
                    'method' => $route['method'],
                    'params' => $matches
                ];
            }
        }

        return null;
    }

    /**
     * digunakan untuk menjalankan applikasi
     * @return void
     */
    public static function run(): void {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUrl = $_SERVER['REQUEST_URI'];

        $route = self::resolve($requestMethod, $requestUrl);

        if ($route) {
            ['controller' => $controller, 'method' => $method, 'params' => $params] = $route;
            $controller = new $controller();

            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $params);
            } else {
                http_response_code(404);
                exit();
            }
        } else {
            http_response_code(404);
            exit();
        }
    }
}