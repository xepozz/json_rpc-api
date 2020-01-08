<?php
declare(strict_types=1);


use Phalcon\Mvc\Router;

/**
 * @var $router Router
 */

$router->add('/shorten', [
    'controller' => \Rpc\Controllers\ShortenController::class,
    'action'     => 'index',
]);
