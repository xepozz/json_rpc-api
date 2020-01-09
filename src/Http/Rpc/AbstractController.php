<?php

namespace Rpc\Http\Rpc;

use Phalcon\Mvc\Controller;
use Rpc\Exceptions\Rpc\UserException;

class AbstractController extends Controller
{
    protected function error($content)
    {
        return $this->createResponse(null, $content);
    }

    protected function success($content)
    {
        return $this->createResponse($content, null);
    }

    protected function createResponse($result, $error)
    {
        $this->response->setHeader('Content-Type', 'application/json');

        if ($error instanceof UserException) {
            $errorObject = new ErrorObject($error->getCode(), (string)$error->getMessage(), $error->getData());
        } elseif ($error instanceof \Throwable) {
            $errorObject = new ErrorObject($error->getCode(), (string)$error->getMessage());
        } else {
            $errorObject = new ErrorObject(-32000, (string)$error);
        }

        return $this->response->setJsonContent(
            (new ResponseBuilder())
                ->withId($error === null ? $this->request->getPost('id') : null)
                ->withError($errorObject)
                ->withResult($result)
                ->asArray()
        );
    }
}
