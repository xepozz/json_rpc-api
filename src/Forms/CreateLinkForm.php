<?php

declare(strict_types=1);

namespace Rpc\Forms;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;

class CreateLinkForm extends Form
{
    public function initialize()
    {
        $password = new Text('link');
//        $password->addValidators(
//            [
//                new StringLength(
//                    [
//                        'min' => 8,
//                        'messageMinimum' => 'Password is too short. Minimum 8 characters',
//                    ]
//                ),
//            ]
//        );
        $this->add($password);
    }
}
