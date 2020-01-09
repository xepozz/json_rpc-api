<?php

namespace Rpc\Exceptions\Rpc;

use Throwable;

class ParseErrorException extends \Exception
{
    public function __construct($message = 'Parse error', Throwable $previous = null)
    {
        parent::__construct($message, -32700, $previous);
    }
}
