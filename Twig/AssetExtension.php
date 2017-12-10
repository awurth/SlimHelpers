<?php

namespace Awurth\Slim\Helper\Twig;

use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetExtension extends AbstractExtension
{
    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Constructor.
     *
     * @param Request $request
     * @param string  $basePath
     * @param string  $name
     */
    public function __construct(Request $request, $basePath = null, $name = 'asset')
    {
        $this->request = $request;
        $this->basePath = $basePath;
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction($this->name, [$this, 'asset'])
        ];
    }

    /**
     * Gets the path to the asset.
     *
     * @param string $path
     *
     * @return string
     */
    public function asset($path)
    {
        if (null !== $this->basePath) {
            return $this->request->getUri()->getBaseUrl().'/'.trim($this->basePath, '/').'/'.$path;
        }

        return $this->request->getUri()->getBaseUrl().'/'.$path;
    }
}
