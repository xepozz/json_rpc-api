<?php

namespace Rpc\Exceptions\Rpc;

use Throwable;

class MethodNotFoundException extends \Exception
{
    public function __construct($message = '', Throwable $previous = null)
    {
        parent::__construct($message, -32601, $previous);
    }
}
