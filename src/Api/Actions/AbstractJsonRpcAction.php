<?php

namespace Rpc\Api\Actions;

use Datto\JsonRpc\Client;

abstract class AbstractJsonRpcAction
{
    public function request(array $params): Client
    {
        return (new Client())->query(mt_rand(), $this->getActionName(), $params);
    }

    abstract public function getActionName(): string;
}
