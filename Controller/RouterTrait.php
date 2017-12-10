<?php

namespace Awurth\Slim\Helper\Controller;

use Slim\Http\Response;

trait RouterTrait
{
    /**
     * Generates a URL from a route.
     *
     * @param string $route
     * @param array  $params
     * @param array  $queryParams
     *
     * @return string
     */
    protected function path($route, array $params = [], array $queryParams = [])
    {
        return $this->container['router']->pathFor($route, $params, $queryParams);
    }

    /**
     * Generates a relative URL from a route.
     *
     * @param string $route
     * @param array  $params
     * @param array  $queryParams
     *
     * @return string
     */
    protected function relativePath($route, array $params = [], array $queryParams = [])
    {
        return $this->container['router']->relativePathFor($route, $params, $queryParams);
    }

    /**
     * Redirects to a route.
     *
     * @param Response $response
     * @param string   $route
     * @param array    $params
     *
     * @return Response
     */
    protected function redirect(Response $response, $route, array $params = [])
    {
        return $response->withRedirect($this->container['router']->pathFor($route, $params));
    }

    /**
     * Redirects to a url.
     *
     * @param Response $response
     * @param string   $url
     *
     * @return Response
     */
    protected function redirectTo(Response $response, $url)
    {
        return $response->withRedirect($url);
    }
}
