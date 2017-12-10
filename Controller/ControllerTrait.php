<?php

namespace Awurth\Slim\Helper\Controller;

use Slim\Exception\NotFoundException;
use Slim\Http\Request;
use Slim\Http\Response;

trait ControllerTrait
{
    /**
     * Creates a new NotFoundException.
     *
     * @param Request  $request
     * @param Response $response
     *
     * @return NotFoundException
     */
    protected function notFoundException(Request $request, Response $response)
    {
        return new NotFoundException($request, $response);
    }

    /**
     * Gets request parameters.
     *
     * @param Request  $request
     * @param string[] $params
     * @param string   $default
     *
     * @return string[]
     */
    protected function params(Request $request, array $params, $default = null)
    {
        $data = [];
        foreach ($params as $param) {
            $data[$param] = $request->getParam($param, $default);
        }

        return $data;
    }

    /**
     * Writes text in the response body.
     *
     * @param Response $response
     * @param string   $data
     * @param int      $status
     *
     * @return int
     */
    protected function write(Response $response, $data, $status = 200)
    {
        return $response->withStatus($status)->getBody()->write($data);
    }
}
