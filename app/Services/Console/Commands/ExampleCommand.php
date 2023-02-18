<?php

declare(strict_types=1);

namespace App\Services\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class ExampleCommand extends Command
{
    private OutputInterface $output;

    protected function configure(): void
    {
        $this
            ->setName('example:command')
            ->setDescription('Example command description')
            ->setHelp('Example command helpers. To more info see: https://symfony.com/doc/current/console.html');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->output = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->output->success('Whoa!');
        // ... put here the code to create the user

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}