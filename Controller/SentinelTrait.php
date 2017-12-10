<?php

namespace Awurth\Slim\Helper\Controller;

use Awurth\Slim\Helper\Exception\AccessDeniedException;
use Awurth\Slim\Helper\Exception\UnauthorizedException;
use Slim\Http\Request;
use Slim\Http\Response;

trait SentinelTrait
{
    use SecurityTrait;

    /**
     * Throws an AccessDeniedException if the user doesn't have the required role.
     *
     * @param Request     $request
     * @param Response    $response
     * @param string      $role
     * @param string|null $message
     *
     * @throws UnauthorizedException
     * @throws AccessDeniedException
     */
    protected function requireRole(Request $request, Response $response, $role, $message = null)
    {
        $user = $this->container['sentinel']->getUser();

        if (null === $user) {
            throw $this->unauthorizedException($request, $response);
        }

        if (!$user->inRole($role)) {
            throw $this->accessDeniedException(
                $request,
                $response,
                null === $message ? 'Access denied: User must have role '.$role : $message
            );
        }
    }
}
