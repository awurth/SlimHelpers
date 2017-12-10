<?php

namespace Awurth\Slim\Helper\Exception;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RequestResponseException extends Exception
{
    /**
     * @var ServerRequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * Constructor.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param string                 $message
     * @param int                    $code
     */
    public function __construct(ServerRequestInterface $request, ResponseInterface $response, $message = '', $code = 0)
    {
        parent::__construct($message, $code);

        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Gets the request.
     *
     * @return ServerRequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Sets the request.
     *
     * @param ServerRequestInterface $request
     */
    public function setRequest(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * Gets the response.
     *
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets the response.
     *
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->response = $response;
    }
}
