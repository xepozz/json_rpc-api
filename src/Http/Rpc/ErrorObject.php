<?php

namespace Rpc\Http\Rpc;

class ErrorObject
{
    public int $code;
    public string $message;

    public function __construct(int $code, string $message)
    {
        $this->code = $code;
        $this->message = $message;
    }
}
