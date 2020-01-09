<?php

namespace Rpc\Exceptions\Rpc;

use Throwable;

class InvalidMethodParametersException extends \Exception
{
    public function __construct($message = 'Invalid params', Throwable $previous = null)
    {
        parent::__construct($message, -32602, $previous);
    }
}
