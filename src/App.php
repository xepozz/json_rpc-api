<?php

namespace Rpc;

use Phalcon\Di\FactoryDefault;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Micro;

class App extends Micro
{
    const APPLICATION_PROVIDER = 'app';
    private string $rootPath;

    public function __construct(string $rootPath)
    {
        parent::__construct(new FactoryDefault());

        $this->rootPath = $rootPath;
        $this->di->setShared(App::APPLICATION_PROVIDER, $this);

        $this->initProviders();
        $this->init();
    }

    private function initProviders()
    {
        $filename = $this->getRootPath() . '/config/providers.php';

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
        $router = $app->getDI()->get('router');
        $this->map(
            '/',
            function () use ($app, $router) {
                /* @var \Phalcon\Mvc\Router $router */
                $body = $app->request;
                $actionAlias = $body->getPost('method');
                $str = '/' . $actionAlias;
                $res = $router->handle($str);
////            $controller = $app->dispatcher->dispatch();
//                print_r(PHP_EOL . count($router->getRoutes()));
//                print_r(PHP_EOL . 'Handle ' . $str);
//                print_r(PHP_EOL . 'method: ' . $method);
//                print_r("\n");
//                print_r('result: ' . $router->getControllerName());


                $controllerClass = $router->getControllerName();

                $controller = new $controllerClass();

                return call_user_func_array(
                    [
                        $controller,
                        $router->getActionName(),
                    ],
                    []
                );
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
