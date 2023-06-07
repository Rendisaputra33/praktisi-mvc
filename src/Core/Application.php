<?php

namespace App\Core;

class Application
{
    public static string $dir;

    private function __construct(string $dir) {
        self::$dir = $dir;
    }

    public function run(): void
    {
        Router::run();
    }

    public static function build(string $rootDir): Application
    {
        return new Application($rootDir);
    }
}