<?php


use Phalcon\Mvc\Micro;

error_reporting(E_ALL);
$rootPath = dirname(__DIR__);

try {
    require_once $rootPath . '/vendor/autoload.php';

    Dotenv\Dotenv::create($rootPath)->load();

//    $container = new Di();
    $application = new Micro();
//    $application->setDI($container);
    $application->get('/rpc', \Rpc\Application::create($application));
    $application->handle($_SERVER['REQUEST_URI']);
} catch (Exception $e) {
    echo $e->getMessage(), '<br>';
    echo nl2br(htmlentities($e->getTraceAsString()));
}
