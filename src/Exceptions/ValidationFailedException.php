<?php

namespace Rpc\Exceptions;

use Rpc\Exceptions\Rpc\UserException;
use Throwable;

class ValidationFailedException extends UserException
{
    public function __construct(string $message = '', array $data = null, Throwable $previous = null)
    {
        parent::__construct($message, -32001, $data, $previous);
    }
}
