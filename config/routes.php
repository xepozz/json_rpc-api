<?php

declare(strict_types=1);

use Api\Controllers\ShortenController;
use Phalcon\Mvc\Router;

/**
 * @var $router Router
 */

$router->add('/shorten', [
    'controller' => ShortenController::class,
    'action'     => 'index',
]);
