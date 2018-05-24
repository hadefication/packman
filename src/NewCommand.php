<?php

namespace Hadefication\Packman;

use Hadefication\Packman\Support\FileManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Hadefication\Packman\Support\Helper;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

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
            ->addArgument('name', InputArgument::OPTIONAL, 'The package name')
            ->addOption('vendor', null, InputOption::VALUE_OPTIONAL, 'The package vendor name', Helper::currentUser());
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

        if (empty($name)) {
            $helper = $this->getHelper('question');
            $question = new Question('Name your package: ', null);
            $name = $helper->ask($input, $output, $question);
            if (is_null($name)) {
                $output->writeln('<comment>I\'ll see my self out!</comment>');
                return;
            }
        }
        
        $vendor = $input->getOption('vendor');
        $directory = getcwd() . '/' . $name;
        $this->isPackageNameDoesNotExists($directory, $output);
        if (mkdir($directory)) {
            (new FileManager($name, $vendor, $directory))->generate();
            $output->writeln('<info>A new Laravel package named "'. $name .'" has been generated!</info>');
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
