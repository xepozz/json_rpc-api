<?php

namespace Api\Controllers;

use Api\Components\ErrorCollector;
use Api\Exceptions\ValidationFailedException;
use Api\Forms\CreateLinkForm;
use Api\Http\Rpc\AbstractController;
use Api\Service\UrlGenerator;

class ShortenController extends AbstractController
{
    public function index(array $params)
    {
        /* @var $urlGenerator \Api\Service\UrlGenerator */
        $urlGenerator = $this->getDI()->get(UrlGenerator::class);

        $form = new CreateLinkForm();
        if (!$form->isValid($params)) {
            /* @var $collector \Api\Components\ErrorCollector */
            $collector = $this->getDI()->get(ErrorCollector::class);

            return $this->error(new ValidationFailedException($collector->collect($form)));
        }
        $link = $params['link'];

        try {
            return $this->success($urlGenerator->generate($link));
        } catch (ValidationFailedException $e) {
            return $this->error($e);
        }
    }
}
