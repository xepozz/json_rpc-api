<?php

namespace Rpc\Http\Rpc;

class ErrorObject implements \JsonSerializable
{
    private int $code;
    private string $message;
    private ?array $data;

    public function __construct(int $code, string $message, array $data = null)
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    public function jsonSerialize()
    {
        $vars = [
            'code' => $this->code,
            'message' => $this->message,
        ];
        if ($this->data !== null) {
            $vars['data'] = $this->data;
        }

        return $vars;
    }
}
