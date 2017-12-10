<?php

namespace Awurth\Slim\Helper\Controller;

abstract class RestController extends ContainerAwareController
{
    use ControllerTrait;
    use RestTrait;
    use SecurityTrait;
}
