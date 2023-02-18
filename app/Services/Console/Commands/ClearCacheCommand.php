<?php

declare(strict_types=1);

namespace App\Services\Console\Commands;

use App\Classes\Cache\Cache;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class ClearCacheCommand extends Command
{
    private OutputInterface $output;

    private array $cacheConfig = [];

    protected function configure(): void
    {
        $this
            ->setName('cache:clear')
            ->setDescription('Flush the application cache')
            ->addOption('store', null, InputOption::VALUE_OPTIONAL, 'Option');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->cacheConfig = require ROOT_DIR . '/config/cache.php';
        $this->output = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $storeKeys = array_keys($this->cacheConfig['stores']);

        if (($store = $input->getOption('store')) === null) {
            foreach ($storeKeys as $store) {
                Cache::store($store)->flush();
                $this->output->info("{$store} store is cleared");
            }
            return Command::SUCCESS;
        }

        if (false === in_array($store, $storeKeys)) {
            $this->output->error("{$store} store is not defined in config/cache.php");
            return Command::INVALID;
        }

        Cache::store($store)->flush();
        $this->output->info("{$store} store is cleared");
        return Command::SUCCESS;
    }
}