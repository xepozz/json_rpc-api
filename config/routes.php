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
$router->add('/shorten2', [
    'controller' => 'shorten2',
    'action'     => 'index',
]);
$router->add('/shorten3', [
    'controller' => 'shorten3',
    'action'     => 'index',
]);

//$router->add('/reset-password/{code}/{email}', [
//    'controller' => 'user_control',
//    'action'     => 'resetPassword',
//]);
