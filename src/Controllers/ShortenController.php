<?php

namespace Rpc\Controllers;

use Phalcon\Mvc\Controller;
use Rpc\Forms\CreateLinkForm;

class ShortenController extends Controller
{
    public function index(array $params)
    {
        $form = new CreateLinkForm();
        if ($this->request->isPost() && !$form->isValid($this->request->getPost())) {
            return $this->collectErrors($form);
        }
        $link = $params['link'];

        return $link;
    }

    private function collectErrors(CreateLinkForm $form): array
    {
        $errors = [];
        foreach ($form->getMessages() as $message) {
            $errors[] = (string)$message;
        }

        return $errors;
    }
}
