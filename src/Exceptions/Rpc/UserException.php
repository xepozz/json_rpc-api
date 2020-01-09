<?php

namespace Rpc\Exceptions\Rpc;

use Throwable;

class UserException extends \Exception
{
    protected ?array $data;

    public function __construct($message = '', $code = -32000, array $data = null, Throwable $previous = null)
    {
        if ($code < -32099 || $code > -32000) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Expected that $code must be between -32099 and -32000, got %d',
                    $code
                )
            );
        }
        $this->data = $data;
        parent::__construct($message, $code, $previous);
    }
}
