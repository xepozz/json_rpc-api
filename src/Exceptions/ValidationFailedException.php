<?php

namespace Rpc\Exceptions;

use Rpc\Exceptions\Rpc\UserException;
use Throwable;

class ValidationFailedException extends UserException
{
    public function __construct($message = '', $code = -32001, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
