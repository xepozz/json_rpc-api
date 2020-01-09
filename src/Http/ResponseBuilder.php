<?php

namespace Rpc\Http;

class ResponseBuilder
{
    private string $jsonRpc = '2.0';
    private $id;
    private $result;
    private ?array $error;

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

    public function withError($error): self
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
