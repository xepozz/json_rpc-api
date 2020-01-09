<?php

namespace Api;

use Api\Exceptions\Rpc\InvalidRequestException;
use Api\Exceptions\Rpc\MethodNotFoundException;
use Api\Exceptions\Rpc\ParseErrorException;
use Api\Http\Rpc\ErrorObject;
use Api\Http\Rpc\ResponseBuilder;
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

                if (!$request->isPost()) {
                    return $this->createErrorResponse(new InvalidRequestException());
                }
                if (!is_array($request->getPost())) {
                    return $this->createErrorResponse(new ParseErrorException());
                }
                if (empty($request->getPost('id'))) {
                    return $this->createErrorResponse(new InvalidRequestException());
                }
                if (empty($request->getPost('method')) || !is_string($request->getPost('method'))) {
                    return $this->createErrorResponse(new InvalidRequestException());
                }

                $actionParams = $request->getPost('params');
                $methodName = $request->getPost('method');
                $router->handle('/' . $methodName);

                $controllerClass = $router->getControllerName();
                $actionName = $router->getActionName();

                if ($controllerClass === null || !class_exists($controllerClass)) {
                    return $this->createErrorResponse(new MethodNotFoundException());
                }

                if (!method_exists($controllerClass, $actionName)) {
                    return $this->createErrorResponse(new MethodNotFoundException());
                }
                $controller = new $controllerClass();

                return call_user_func_array([$controller, $actionName], [$actionParams]);
            }
        );
    }

    protected function createErrorResponse($error)
    {
        $this->response->setHeader('Content-Type', 'application/json');

        if ($error instanceof \Throwable) {
            $errorObject = new ErrorObject($error->getCode(), (string)$error->getMessage());
        } else {
            $errorObject = new ErrorObject(-32000, (string)$error);
        }

        return $this->response->setJsonContent(
            (new ResponseBuilder())
                ->withId($error === null ? $this->request->getPost('id') : null)
                ->withError($errorObject)
                ->withResult(null)
                ->asArray()
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
