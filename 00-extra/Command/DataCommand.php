<?php

namespace My\FrontendBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Bundle\DoctrineBundle\Command\DoctrineCommand;

class DataCommand extends DoctrineCommand
{

    protected function configure()
    {
        $this
          ->setName('data:slug')
          ->setDescription('Lorem....')
          ->setHelp(<<<EOT
Opis...
EOT
          );
    }

    /**
     * Execute the command
     *
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $manager = $this->getContainer()->get('doctrine')->getEntityManager();

        $output->writeln('============================');
        $output->writeln('update:slug');
        $output->writeln('============================');
    }

}
