<?php

declare(strict_types=1);

namespace Rpc\Providers;

use Exception;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Router;
use Rpc\App;

class RouterProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'router';

    /**
     * @param DiInterface $di
     * @return void
     */
    public function register(DiInterface $di): void
    {
        /** @var App $application */
        $application = $di->getShared(App::APPLICATION_PROVIDER);
        /** @var string $basePath */
        $basePath = $application->getRootPath();
        $di->set(
            $this->providerName,
            function () use ($basePath) {
                $router = new Router();
                $routes = $basePath . '/config/routes.php';
                if (!file_exists($routes) || !is_readable($routes)) {
                    throw new Exception($routes . ' file does not exist or is not readable.');
                }
                require_once $routes;

                return $router;
            }
        );
    }
}
