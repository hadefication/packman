<?php

namespace Hadefication\Packman;

use Hadefication\Packman\Support\FileManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Hadefication\Packman\Support\Helper;

class NewCommand extends Command
{
    /**
     * Configure command settings
     *
     * @return void
     */
    public function configure()
    {
        $this->setName('new')
            ->setDescription('Generate a Laravel package boilerplate.')
            ->addArgument('name', InputArgument::REQUIRED, 'The package name')
            ->addOption('vendor', null, InputOption::VALUE_OPTIONAL, 'The package vendor name', $this->getDefaultVendorName())
            ->addOption('basic', null, InputOption::VALUE_OPTIONAL, 'Generate basic files only');
    }
  
    /**
     * Execute command
     *
     * @param  InputInterface  $input  the input interface object to use
     * @param  OutputInterface $output the output interface object to use
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $vendor = $input->getOption('vendor');
        $directory = getcwd() . '/' . $name;
        $this->isPackageNameDoesNotExists($directory, $output);
        if (mkdir($directory)) {
            (new FileManager($name, $vendor, $directory))->generate();
            $output->writeln('<info>A new Laravel package named "'. $name .'" has been generated!</info>');
        }
    }

    /**
     * Get the systems current logged in user as the default vendor
     *
     * @return string
     */
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

    /**
     * Verify if the current package already exists, if yes then
     * throw an error message else then move forward!
     *
     * @param  string directory                 the directory of the package
     * @param  OutputInterface $output          the output interface object to use
     * @return void
     */
    private function isPackageNameDoesNotExists($directory, OutputInterface $output)
    {
        if (is_dir($directory)) {
            $segments = explode('/', $directory);
            $output->writeln('Package "'.$segments[count($segments) - 1].'" already exists!');
            exit(1);
        }
    }
}
