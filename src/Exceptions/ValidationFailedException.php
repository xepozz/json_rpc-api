<?php

namespace Api\Exceptions;

use Api\Exceptions\Rpc\UserException;
use Throwable;

class ValidationFailedException extends UserException
{
    public function __construct(array $data, Throwable $previous = null)
    {
        parent::__construct('Validation failed', -32001, $data, $previous);
    }
}
