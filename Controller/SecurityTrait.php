<?php

namespace Awurth\Slim\Helper\Controller;

use Awurth\Slim\Helper\Exception\AccessDeniedException;
use Awurth\Slim\Helper\Exception\UnauthorizedException;
use Slim\Http\Request;
use Slim\Http\Response;

trait SecurityTrait
{
    /**
     * Creates a new AccessDeniedException.
     *
     * @param Request  $request
     * @param Response $response
     * @param string   $message
     *
     * @return AccessDeniedException
     */
    protected function accessDeniedException(Request $request, Response $response, $message = 'Access denied.')
    {
        return new AccessDeniedException($request, $response, $message);
    }

    /**
     * Creates a new UnauthorizedException.
     *
     * @param Request  $request
     * @param Response $response
     * @param string   $message
     *
     * @return UnauthorizedException
     */
    protected function unauthorizedException(Request $request, Response $response, $message = 'Unauthorized.')
    {
        return new UnauthorizedException($request, $response, $message);
    }
}
