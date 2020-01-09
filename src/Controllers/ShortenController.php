<?php

namespace Rpc\Controllers;

use Rpc\Components\ErrorCollector;
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
            /* @var $collector \Rpc\Components\ErrorCollector */
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
