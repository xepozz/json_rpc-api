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
                $request = $app->request;
                $actionName = $request->getPost('method');
                $actionParams = $request->getPost('params');

                $router->handle('/' . $actionName);

                $controllerClass = $router->getControllerName();

                $controller = new $controllerClass();

                return call_user_func_array(
                    [
                        $controller,
                        $router->getActionName(),
                    ],
                    [$actionParams]
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
