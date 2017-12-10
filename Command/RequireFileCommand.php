<?php

namespace Awurth\Slim\Helper\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RequireFileCommand extends Command
{
    /**
     * @var string
     */
    protected $path;

    /**
     * Constructor.
     *
     * @param string $path
     * @param string $name
     * @param string|null $description
     */
    public function __construct($path, $name, $description = null)
    {
        parent::__construct($name);

        $this->path = $path;
        $this->setDescription($description);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        self::requireFile($this->path);

        return 0;
    }

    /**
     * Requires a PHP file.
     *
     * @param string $path
     *
     * @return mixed
     */
    protected static function requireFile($path)
    {
        return require $path;
    }
}
