<?php

declare(strict_types=1);

namespace Rpc;

use Cake\Utility\Inflector;
use Phalcon\Mvc\Micro;

class Application
{
    public static function create(Micro $app)
    {
        return function () use ($app){
            $method = 'shorten';
            $controller = Inflector::camelize($method);
            var_dump($app->router->getRoutes());
//            $controller = $app->getDI()->get('Rpc\\Controllers\\'.$controller.'Controller');
//            /* @var $controller \Phalcon\Mvc\Controller */
        };
    }
}
