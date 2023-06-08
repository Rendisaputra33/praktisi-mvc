<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Controller\MainController;
use App\Core\Application;
use App\Core\Router;

$application = Application::build(dirname(__DIR__));

Router::get('/', [MainController::class, 'showContacts']);
Router::get('/create', [MainController::class, 'loadAddContact']);
Router::get('/edit/{id}', [MainController::class, 'loadEditContact']);
Router::post('/delete', [MainController::class, 'deleteContact']);
Router::post('/create', [MainController::class, 'createContact']);
Router::post('/edit/{id}', [MainController::class, 'editContact']);

$application->run();