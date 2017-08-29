<?php

namespace Packman;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Packman\Support\FileManager;

class NewCommand extends Command
{

    public function configure()
    {
        $this->setName('new')
            ->setDescription('Generate a Laravel package boilerplate.')
            ->addArgument('name', InputArgument::REQUIRED, 'The package name')
            ->addOption('vendor', null, InputOption::VALUE_OPTIONAL, 'The package vendor name', $this->getDefaultVendorName());
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $vendor = $input->getOption('vendor');
        $directory = getcwd() . '/' . $name;

        $this->assertPackageNameDoesNotExists($directory, $output);

        if (mkdir($directory)) {
            (new FileManager($name, $vendor, $directory))->generate();
            $output->writeln('<info>'.ucfirst($name).' package has been generated, now start customizing!</info>');
        }
    }


    private function getDefaultVendorName()
    {
        if (!empty($_SERVER['USERNAME'])) {
            return $_SERVER['USERNAME'];
        } elseif (!empty($_SERVER['USER'])) {
            return $_SERVER['USER'];
        } elseif (get_current_user()) {
            return get_current_user();
        } else {
            return 'acme';
        }
    }

    private function assertPackageNameDoesNotExists($directory, OutputInterface $output)
    {
        if (is_dir($directory)) {
            $segments = explode('/', $directory);
            $output->writeln('Package "'.$segments[count($segments) - 1].'" already exists!');
            exit(1);
        }
    }
}
