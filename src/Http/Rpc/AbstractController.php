<?php

namespace Rpc\Http\Rpc;

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

    /**
     * @param $result
     * @param $error
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    protected function createResponse($result, $error)
    {
        $this->response->setHeader('Content-Type', 'application/json');

        return $this->response->setJsonContent(
            (new ResponseBuilder())
                ->withId($error === null ? $this->request->getPost('id') : null)
                ->withError(new ErrorObject(-32000, (string)$error))
                ->withResult($result)
                ->asArray()
        );
    }
}
