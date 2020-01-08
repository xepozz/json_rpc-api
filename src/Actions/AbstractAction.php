<?php

namespace Rpc\Actions;

use GuzzleHttp\Client;
use Psr\Http\Message\StreamInterface;
use Rpc\Exceptions\BadRequestException;
use Throwable;

abstract class AbstractAction
{
    public function request(array $params)
    {
        try {
            $client = new Client(
                [
                    'base_uri' => 'http://nginx:8080',
                    'timeout' => 2,
                    'allow_redirects' => false,
                ]
            );

            $body = $client
                ->request('GET', 'rpc', $params)
                ->getBody();

            return $this->decode($body);
        } catch (Throwable $e) {
            throw new BadRequestException($e->getMessage(), $e->getCode(), $e);
        }
    }

    abstract public function getActionName(): string;

    private function decode(StreamInterface $body)
    {
        $options = JSON_UNESCAPED_UNICODE;

        return json_decode($body, true, 512, $options);
    }
}
