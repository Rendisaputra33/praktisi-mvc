<?php

namespace App\Controller;

use App\Core\View;
use Exception;

class MainController
{
    /**
     * @throws Exception
     */
    public function showContacts(): void
    {
        $view = new View('views');
        $view->render('contacts', ['name' => 'Rendi Saputra']);
    }
}