<?php
declare(strict_types=1);


use Phalcon\Mvc\Router;

/**
 * @var $router Router
 */

$router->add('/shorten', [
    'controller' => 'shorten',
    'action'     => 'index',
]);
$router->add('/shorten2', [
    'controller' => 'shorten',
    'action'     => 'index',
]);

//$router->add('/reset-password/{code}/{email}', [
//    'controller' => 'user_control',
//    'action'     => 'resetPassword',
//]);
