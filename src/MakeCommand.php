<?php

namespace Hadefication\Packman;

use Hadefication\Packman\Support\Helper;
use Hadefication\Packman\Support\FileManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeCommand extends Command
{
    /**
     * Configure command settings
     *
     * @return void
     */
    public function configure()
    {
        $this->setName('make')->setDescription('Interactive mode to generate Laravel package boilerplate.');
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
        $helper = $this->getHelper('question');
        $name = $helper->ask($input, $output, $this->askAQuestion('Name your package: '));
        $vendor = $helper->ask($input, $output, $this->askAQuestion("Who's the package vendor [defaults to ". Helper::currentUser() . "]: ", Helper::currentUser()));

        if (is_null($name)) {
            $output->writeln('<comment>I\'ll see my self out!</comment>');
            return;
        }

        $name = Helper::kebabCase($name);

        $directory = getcwd() . '/' . $name;

        $this->isPackageNameDoesNotExists($directory, $output);

        if (mkdir($directory)) {
            (new FileManager($name, $vendor, $directory))->generate();
            $output->writeln('<info>A new Laravel package named "'. $name .'" has been generated!</info>');
        }
    }

    /**
     * Ask a question
     *
     * @param string $question
     * @param any $default
     * @return Question
     */
    private function askAQuestion($question, $default = null)
    {
        return new Question($question, $default);
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
