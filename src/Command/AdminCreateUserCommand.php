<?php

namespace App\Command;

use App\Entity\AdminUser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AdminCreateUserCommand extends Command
{
    protected static $defaultName = 'app:admin:create-user';

    protected function configure()
    {
        $this
            ->setDescription('Create a new Admin user.')
            ->addArgument('email', InputArgument::OPTIONAL, 'User\'s email.')
            ->addArgument('password', InputArgument::OPTIONAL, 'User\'s password.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $adminUser = new AdminUser();
        $adminUser->setEmail($input->getArgument('email'));
        $adminUser->setPassword($input->getArgument('password'));

        $io->success('Admin user created.');
    }
}
