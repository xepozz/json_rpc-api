<?php

namespace Rpc;

use Cake\Utility\Inflector;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Micro;

class App extends Micro
{
    const APPLICATION_PROVIDER = 'app';
    private string $rootPath;

    public function __construct(string $rootPath)
    {
        $this->rootPath = $rootPath;
        $this->di = new FactoryDefault();

        $this->di->setShared(App::APPLICATION_PROVIDER, $this);
        $this->initProviders();
        $this->init();
    }

    private function initProviders()
    {
        $filename = dirname(__DIR__) . '/config/providers.php';
        if (!file_exists($filename) || !is_readable($filename)) {
            throw new \Exception('File providers.php does not exist or is not readable.');
        }
        $providers = include_once $filename;
        foreach ($providers as $providerClass) {
            /** @var ServiceProviderInterface $provider */
            $provider = new $providerClass;
            $provider->register($this->getDI());
        }
    }

    private function init()
    {
        $app = $this;
        $this->map(
            '/',
            function () use ($app) {
                $method = 'shorten';
                $controller = Inflector::camelize($method);
                $body = $app->request;
                $actionAlias = $body->getPost('method');
                $app->router->handle('/' . $actionAlias);
//            $controller = $app->dispatcher->dispatch();
                print_r(count($app->router->getRoutes()));
                print_r('method: ' . $method);
                print_r('result: ' . $app->router->getControllerName());
                exit();

                return $app->dispatcher->forward();

                return $_POST;
            }
        );
    }

    /**
     * @return string
     */
    public function getRootPath(): string
    {
        return $this->rootPath;
    }
}
