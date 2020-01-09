<?php

namespace Rpc\Controllers;

use Rpc\Exceptions\ValidationFailedException;
use Rpc\Forms\CreateLinkForm;
use Rpc\Http\Rpc\AbstractController;

class ShortenController extends AbstractController
{
    public function index(array $params)
    {
        $form = new CreateLinkForm();
        if (!$form->isValid($this->request->getPost())) {
            return $this->error($this->collectErrors($form));
        }
        $link = $params['link'];

        return $this->success($link);
    }

    private function collectErrors(CreateLinkForm $form)
    {
        $errors = [];
        foreach ($form->getMessages() as $message) {
            $errors[] = [
                'field' => $message->getField(),
                'message' => $message->getMessage(),
            ];
        }

        return new ValidationFailedException($errors);
    }
}
