<?php

namespace Rpc\Controllers;

use Rpc\Exceptions\ValidationFailedException;
use Rpc\Forms\CreateLinkForm;
use Rpc\Http\Rpc\AbstractController;
use Rpc\Service\UrlGenerator;

class ShortenController extends AbstractController
{
    public function index(array $params)
    {
        /* @var $urlGenerator \Rpc\Service\UrlGenerator */
        $urlGenerator = $this->getDI()->get(UrlGenerator::class);

        $form = new CreateLinkForm();
        if (!$form->isValid($params)) {
            return $this->error($this->collectErrors($form));
        }
        $link = $params['link'];

        return $this->success($urlGenerator->generate($link));
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
