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

    public static function get(string $path, array $handler): void {
        self::add('GET', $path, $handler);
    }

    public static function post(string $path, array $handler): void {
        self::add('POST', $path, $handler);
    }

    public static function put(string $path, array $handler): void {
        self::add('PUT', $path, $handler);
    }

    public static function delete(string $path, array $handler): void {
        self::add('DELETE', $path, $handler);
    }
}