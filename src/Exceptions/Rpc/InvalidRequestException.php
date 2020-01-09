<?php

namespace Rpc\Exceptions\Rpc;

use Throwable;

class InvalidRequestException extends \Exception
{
    public function __construct($message = '', Throwable $previous = null)
    {
        parent::__construct($message, -32600, $previous);
    }
}
