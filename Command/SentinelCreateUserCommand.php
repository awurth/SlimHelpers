<?php

namespace Awurth\Slim\Helper\Command;

use Cartalyst\Sentinel\Sentinel;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class SentinelCreateUserCommand extends Command
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @var Sentinel
     */
    protected $sentinel;

    /**
     * Constructor.
     *
     * @param Sentinel    $sentinel
     * @param array       $options
     * @param string|null $name
     */
    public function __construct(Sentinel $sentinel, array $options = [], $name = null)
    {
        parent::__construct($name);

        $this->sentinel = $sentinel;
        $this->options = array_replace([
            'user_role' => 'user',
            'admin_role' => 'admin'
        ], $options);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        if (null === $this->getName()) {
            $this->setName('user:create');
        }

        $this
            ->setDescription('Create a new user')
            ->setDefinition([
                new InputArgument('username', InputArgument::REQUIRED, 'The username'),
                new InputArgument('email', InputArgument::REQUIRED, 'The email'),
                new InputArgument('password', InputArgument::REQUIRED, 'The password'),
                new InputOption('admin', null, InputOption::VALUE_NONE, 'Set the user as admin')
            ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('admin')) {
            $role = $this->sentinel->findRoleByName($this->options['admin_role']);
        } else {
            $role = $this->sentinel->findRoleByName($this->options['user_role']);
        }

        $user = $this->sentinel->registerAndActivate([
            'username' => $input->getArgument('username'),
            'email' => $input->getArgument('email'),
            'password' => $input->getArgument('password'),
            'permissions' => []
        ]);

        $role->users()->attach($user);

        return 0;
    }

    /**
     * {@inheritdoc}
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $questions = [];

        if (!$input->getArgument('username')) {
            $question = new Question('Please choose a username:');
            $question->setValidator(function ($username) {
                if (empty($username)) {
                    throw new Exception('Username can not be empty');
                }

                return $username;
            });
            $questions['username'] = $question;
        }

        if (!$input->getArgument('email')) {
            $question = new Question('Please choose an email:');
            $question->setValidator(function ($email) {
                if (empty($email)) {
                    throw new Exception('Email can not be empty');
                }

                return $email;
            });

            $questions['email'] = $question;
        }

        if (!$input->getArgument('password')) {
            $question = new Question('Please choose a password:');
            $question->setValidator(function ($password) {
                if (empty($password)) {
                    throw new Exception('Password can not be empty');
                }

                return $password;
            });

            $question->setHidden(true);
            $questions['password'] = $question;
        }

        foreach ($questions as $name => $question) {
            $answer = $this->getHelper('question')->ask($input, $output, $question);
            $input->setArgument($name, $answer);
        }
    }
}
