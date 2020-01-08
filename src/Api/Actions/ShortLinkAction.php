<?php

namespace Rpc\Api\Actions;

class ShortLinkAction extends AbstractJsonRpcAction
{
    public function __construct()
    {
    }

    public function shorten(string $link)
    {
        $response = $this->request(['link' => $link]);

        return $response->encode();
    }

    public function getActionName(): string
    {
        return 'shorten';
    }
}
