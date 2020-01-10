<?php

declare(strict_types=1);

namespace Api\Forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Callback;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Url;

class CreateLinkForm extends Form
{
    public function initialize()
    {
        $link = new Text('link');
        $link->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'The :field is required',
                    ]
                ),
                new Url(
                    [
                        'message' => ':field contain invalid url',
                    ]
                ),
                new Callback(
                    [
                        'callback' => function ($data) {
                            $pattern = '#^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$#';

                            return preg_match($pattern, $data['link']) === 1;
                        },
                        'message' => ':field contain invalid url',
                    ]
                ),
            ]
        );
        $this->add($link);
    }
}
