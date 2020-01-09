<?php

namespace Rpc\Http\Rpc;

class ResponseBuilder
{
    private string $jsonRpc = '2.0';
    private $id;
    private $result;
    private ?ErrorObject $error = null;

    public function withId($id): self
    {
        $new = clone $this;
        $new->id = $id;

        return $new;
    }

    public function withResult($result): self
    {
        $new = clone $this;
        $new->result = $result;

        return $new;
    }

    public function withError(?ErrorObject $error): self
    {
        $new = clone $this;
        $new->error = $error;

        return $new;
    }

    public function asArray(): array
    {
        return [
            'jsonrpc' => $this->jsonRpc,
            'id' => $this->id,
            'result' => $this->result,
            'error' => $this->error,
        ];
    }
}
