<?php

namespace App\Command;

use App\Entity\AdminUser;
use App\Security\AdminUserGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AdminCreateUserCommand extends Command
{
    protected static $defaultName = 'app:admin:create-user';

    /**
     * @var AdminUserGenerator
     */
    private $generator;

    /**
     * AdminCreateUserCommand constructor.
     * @param AdminUserGenerator $generator
     */
    public function __construct(AdminUserGenerator $generator)
    {
        parent::__construct();
        $this->generator = $generator;
    }

    protected function configure()
    {
        $this
            ->setDescription('Create a new Admin user.')
            ->addArgument('email', InputArgument::OPTIONAL, 'User\'s email.')
            ->addArgument('password', InputArgument::OPTIONAL, 'User\'s password.')
            ->addOption('super-admin', 's', InputOption::VALUE_NONE, 'Is admin super?')
        ;
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        
        $email = $input->getArgument('email');
        
        if (null === $email) {
            $email = $io->ask('Admin\'s email', null, function ($value) {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    throw new InvalidArgumentException('Invalid email.');
                }

                return $value;
            });
            $input->setArgument('email', $email);
        }
        
        $io->text('Admin\'s email: '.$email);

        $password = $input->getArgument('password');

        if (null === $password) {
            $password = $io->ask('Admin\'s password', null, function ($value) {
                if (empty($value)) {
                    throw new InvalidArgumentException('Invalid password.');
                }

                return $value;
            });
            $input->setArgument('password', $password);
        }

        $io->text('Admin\'s password: '.$password);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $adminUser = $this->generator->createAdmin(
            $input->getArgument('email'),
            $input->getArgument('password')
        );

        if ($input->getOption('super-admin')) {
            $this->generator->promoteSuperAdmin($adminUser);
        }

        $io->success('Admin user created.');
    }
}
