<?php

namespace Rpc\Api;

use Datto\JsonRpc\Evaluator;
use Datto\JsonRpc\Examples\Library\Math;
use Datto\JsonRpc\Exceptions\ArgumentException;
use Phalcon\Mvc\Micro;

class Api implements Evaluator
{
    private Micro $app;

    public function __construct(Micro $app)
    {
        $this->app = $app;
    }

    public function evaluate($method, $arguments)
    {
        $router = new \Phalcon\Mvc\Router();
        $router->add('shorten', 'ShortenController::index');
        $this->app->setService('router', $router, true);

        return $this->app->handle($method);
    }

    private static function add($arguments)
    {
        @list($a, $b) = $arguments;
        if (!is_int($a) || !is_int($b)) {
            throw new ArgumentException();
        }

        return Math::add($a, $b);
    }
}
