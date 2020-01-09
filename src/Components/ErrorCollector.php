<?php

namespace Rpc\Components;

use Phalcon\Di\Injectable;

class ErrorCollector extends Injectable
{
    /**
     * @param \Phalcon\Forms\Form|\Phalcon\Mvc\Model $form
     * @return string[][]
     */
    public function collect($form): array
    {
        $errors = [];

        /* @var $message \Phalcon\Messages\MessageInterface */
        foreach ($form->getMessages() as $message) {
            $errors[] = [
                'field' => $message->getField(),
                'message' => $message->getMessage(),
            ];
        }

        return $errors;
    }
}
