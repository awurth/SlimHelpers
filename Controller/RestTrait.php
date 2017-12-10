<?php

namespace Awurth\Slim\Helper\Controller;

use Slim\Http\Response;

trait RestTrait
{
    use RouterTrait;

    /**
     * Returns a "400 Bad Request" response with JSON data.
     *
     * @param Response $response
     * @param mixed    $data
     *
     * @return Response
     */
    protected function badRequest(Response $response, $data)
    {
        return $this->json($response, $data, 400);
    }

    /**
     * Returns a "201 Created" response with a location header.
     *
     * @param Response $response
     * @param string   $route
     * @param array    $params
     *
     * @return Response
     */
    protected function created(Response $response, $route, array $params = [])
    {
        return $this->redirect($response, $route, $params)->withStatus(201);
    }

    /**
     * Writes JSON in the response body.
     *
     * @param Response $response
     * @param mixed    $data
     * @param int      $status
     *
     * @return Response
     */
    protected function json(Response $response, $data, $status = 200)
    {
        return $response->withJson($data, $status);
    }

    /**
     * Returns a "204 No Content" response.
     *
     * @param Response $response
     *
     * @return Response
     */
    protected function noContent(Response $response)
    {
        return $response->withStatus(204);
    }

    /**
     * Returns a "200 Ok" response with JSON data.
     *
     * @param Response $response
     * @param mixed    $data
     *
     * @return Response
     */
    protected function ok(Response $response, $data)
    {
        return $this->json($response, $data);
    }
}
