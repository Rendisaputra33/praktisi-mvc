<?php

namespace App\Core;

use Exception;

class View
{
    private string $viewsDir;

    public function __construct(string $viewsDir)
    {
        $this->viewsDir = rtrim($viewsDir, '/');
    }

    /**
     * @throws Exception
     */
    public function render(string $template, array $data = []): void
    {
        $file = Application::$dir . '/' . $this->viewsDir . '/' . $template . '.php';
        if (file_exists($file)) {
            extract($data);
            include $file;
        } else {
            throw new Exception('Template file not found: ' . $template);
        }
    }
}