<?php

namespace App\Controller;

use App\Core\View;
use App\Models\Contact;
use Exception;

class MainController
{
    /**
     * model contact
     * @var Contact
     */
    private Contact $contactModel;

    public function __construct() {
        $this->contactModel = new Contact();
    }

    /**
     * @throws Exception
     */
    public function showContacts(): void
    {
        $view = new View('views');
        $contacts = $this->contactModel->getAll();
        $view->render('contacts', ['contacts' => $contacts]);
    }

    /**
     * @throws Exception
     */
    public function loadAddContact(): void
    {
        $view = new View('views');
        $view->render('create');
    }

    public function createContact(): never
    {
        $request = $this->parseRequestBody();
        $this->contactModel->create($request);
        header("Location: /");
        exit();
    }

    public function loadEditContact(int $id)
    {
        $contact = $this->contactModel->getById($id);
        $view = new View('views');
        $view->render('edit', [
            'contact' => $contact
        ]);
    }

    public function editContact(int $id): never
    {
        $request = $this->parseRequestBody();
        $request['id'] = $id;
        $result = $this->contactModel->update($request);

        if ($result) {
            header("Location: /");
            exit();
        }

        header("Location: /edit/$id");
        exit();
    }

    public function deleteContact(): void
    {
        $request = $this->parseRequestBody();
        $status = $this->contactModel->deleteById($request['id']);
        echo $status;
    }

    public function parseRequestBody(): array
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contentType = $_SERVER['CONTENT_TYPE'];
            $body = file_get_contents('php://input');

            if ($contentType === 'application/json') {
                $data = json_decode($body, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    return $data;
                }
            } else {
                parse_str($body, $params);

                return $params;
            }
        }

        return [];
    }
}