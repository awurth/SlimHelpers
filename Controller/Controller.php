<?php

namespace Awurth\Slim\Helper\Controller;

use Psr\Http\Message\ResponseInterface as Response;

abstract class Controller extends ContainerAwareController
{
    use ControllerTrait;
    use RouterTrait;
    use SecurityTrait;

    /**
     * Adds a flash message.
     *
     * @param string $name
     * @param string $message
     */
    protected function flash($name, $message)
    {
        $this->container['flash']->addMessage($name, $message);
    }

    /**
     * @param Response $response
     * @param string   $template
     * @param array    $params
     *
     * @return Response
     */
    protected function render(Response $response, $template, array $params = [])
    {
        return $this->container['twig']->render($response, $template, $params);
    }
}
