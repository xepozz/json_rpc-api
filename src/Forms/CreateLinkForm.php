<?php

declare(strict_types=1);

namespace Rpc\Forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Url;

class CreateLinkForm extends Form
{
    public function initialize()
    {
        $password = new Text('link');
        $password->addValidators(
            [
                new Url(
                    [
                        "message" => ":field must be a url",
                    ]
                )
            ]
        );
        $this->add($password);
    }
}
