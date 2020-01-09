<?php

declare(strict_types=1);

namespace Api\Forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Callback;

class CreateLinkForm extends Form
{
    public function initialize()
    {
        $password = new Text('link');
        $password->addValidators(
            [
                new Callback(
                    [
                        'callback' => function ($data) {
                            $pattern = '#^https?://[\w\-.]+/?[.*]#';

                            return preg_match($pattern, $data['link']) === 1;
                        },
                        'message' => ':field even number of products are accepted',
                    ]
                ),
            ]
        );
        $this->add($password);
    }
}
