<?php

namespace Awurth\Slim\Helper\Twig;

use Slim\Csrf\Guard;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CsrfExtension extends AbstractExtension
{
    /**
     * @var Guard
     */
    protected $csrf;

    /**
     * @var string
     */
    protected $name;

    /**
     * Constructor.
     *
     * @param Guard  $csrf
     * @param string $name
     */
    public function __construct(Guard $csrf, $name = 'csrf')
    {
        $this->csrf = $csrf;
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction($this->name, [$this, 'csrfFields'], ['is_safe' => ['html']])
        ];
    }

    /**
     * Gets the HTML for the CSRF fields.
     *
     * @return string
     */
    public function csrfFields()
    {
        return '
            <input type="hidden" name="'.$this->csrf->getTokenNameKey().'" value="'.$this->csrf->getTokenName().'">
            <input type="hidden" name="'.$this->csrf->getTokenValueKey().'" value="'.$this->csrf->getTokenValue().'">
        ';
    }
}
