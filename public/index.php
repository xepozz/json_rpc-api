<?php


use Api\App;

error_reporting(E_ALL);
$rootPath = dirname(__DIR__);

try {
    require_once $rootPath . '/vendor/autoload.php';

    Dotenv\Dotenv::create($rootPath)->load();

    $application = new App($rootPath);


    $application->handle('');
} catch (Exception $e) {
    echo $e->getMessage(), '<br>';
    echo nl2br(htmlentities($e->getTraceAsString()));
}
