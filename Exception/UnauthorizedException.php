<?php

namespace Awurth\Slim\Helper\Exception;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UnauthorizedException extends RequestResponseException
{
    /**
     * Constructor.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param string                 $message
     */
    public function __construct(ServerRequestInterface $request, ResponseInterface $response, $message = 'Unauthorized.')
    {
        parent::__construct($request, $response, $message, 401);
    }
}
