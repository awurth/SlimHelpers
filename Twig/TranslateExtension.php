<?php

namespace Awurth\Slim\Helper\Twig;

use Illuminate\Translation\Translator;


class TranslateExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    /**
     * @var Translator
     */
    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function getName()
    {
        return 'slim_translator';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('trans', [$this->translator, 'trans'])
        ];
    }

    public function getGlobals()
    {
        return [
            'app' => ['locale' => $this->translator->getLocale()],
        ];
    }
}
