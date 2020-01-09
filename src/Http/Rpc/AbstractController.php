<?php

namespace Api\Http\Rpc;

use Api\Exceptions\Rpc\UserException;
use Phalcon\Mvc\Controller;

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
        } elseif ($error !== null) {
            $errorObject = new ErrorObject(-32000, (string)$error);
        } else {
            $errorObject = null;
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
