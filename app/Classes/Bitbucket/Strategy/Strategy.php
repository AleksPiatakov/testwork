<?php

namespace App\Classes\Bitbucket\Strategy;

use App\Classes\Bitbucket\DTO\Configs;
use App\Classes\Bitbucket\Exceptions\ConsoleCommandException;

abstract class Strategy
{
    /**
     * @var Configs
     */
    protected $config;

    /**
     * @var array
     */
    private $history = [];
    /**
     * @var string
     */
    protected $currentRepoPath;

    public function __construct(Configs $config)
    {
        $this->config = $config;
        $this->init();
        $this->cloneRepository();
    }

    protected function init(): void
    {
        $this->currentRepoPath = $this->config->getRepoFolder() . '/' . $this->getBody()->repository->name . '.git/';
    }

    abstract public function execute(...$arg);

    /**
     * @param string $command
     * @param string|null $path
     * @return false|string
     * @throws ConsoleCommandException
     */
    protected function runCommand(string $command, ?string $path = null)
    {
        $descriptorspec = [
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];
        $pipes = [];
        $resource = proc_open($command, $descriptorspec, $pipes, $path, [
            'bypass_shell' => true,
        ]);

        $stdout = stream_get_contents($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        foreach ($pipes as $pipe) {
            fclose($pipe);
        }

        $status = trim(proc_close($resource));
        if ($status) {
            throw new ConsoleCommandException($stderr . "\n" . $stdout); //Not all errors are printed to stderr, so include std out as well.
        }

        return $stdout;
    }

    public function getHistoryInfo(): array
    {
        return $this->history;
    }

    private function cloneRepository()
    {
        if (!is_dir($this->currentRepoPath) && !is_file($this->currentRepoPath . '/HEAD')) {
            $this->makeDirectory($this->currentRepoPath);
            $this->runCommand('git clone --mirror ' . $this->getBucketRepoLink(), $this->currentRepoPath);
        }
    }

    protected function deploy(string $deployBranch)
    {
        $dbName = $this->config->generateDbName($deployBranch);
        foreach ($this->config->getDeployPaths($deployBranch) as $deployPath) {
            if (!is_dir($deployPath)) {
                $this->runCommand("git worktree add -f {$deployPath} {$deployBranch}", $this->currentRepoPath);
                $this->runCommand('cp .htaccess-default .htaccess', $deployPath);
                $this->createEnv($deployPath, [
                    'APP_NAME' => $this->config->getAppNameEnv(),
                    'DB_DATABASE' => $dbName,
                    'DB_HOST' => 'localhost',
                    'DB_USERNAME' => getenv('DB_USERNAME'),
                    'DB_PASSWORD' => getenv('DB_PASSWORD'),
                    'TELEGRAM_API_KEY' => $this->config->getTelegramApiKeyEnv(),
                    'TELEGRAM_CHAT_ID' => $this->config->getTelegramChatIdEnv()
                ]);
                $this->dropDb($dbName);
                $this->createDb($dbName);
                $this->dumpDb($dbName);
            } else {
                $this->runCommand("cd {$deployPath} &&  GIT_WORK_TREE={$deployPath} git checkout -f {$deployBranch}");
            }
            $this->composerInstall($deployPath);

            $this->config->callAfterProcess($this, $deployBranch);

            $this->history[] = "{$deployPath} was checkout. Current branch: {$deployBranch}";
        }
    }

    protected function makeDirectory(string $path, int $mode = 0755, bool $recursive = true, bool $force = true): bool
    {
        if ($force) {
            return @mkdir($path, $mode, $recursive);
        }
        return mkdir($path, $mode, $recursive);
    }

    protected function getBucketRepoLink(): string
    {
        return "git@bitbucket.org:solomonocompany/{$this->getBody()->repository->name}.git";
    }

    protected function getBody()
    {
        return $this->config->getBody();
    }

    protected function createDb(string $DbName)
    {
        return $this->runCommand(
            sprintf(
                'mysql -h%s -u%s -p%s -e "CREATE DATABASE %s DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci"',
                getenv('DB_HOST'),
                getenv('DB_USERNAME'),
                getenv('DB_PASSWORD'),
                $DbName
            )
        );
    }

    protected function dropDb(string $DbName)
    {
        return $this->runCommand(
            sprintf(
                'mysql -h%s -u%s -p%s -e "DROP DATABASE IF EXISTS %s"',
                getenv('DB_HOST'),
                getenv('DB_USERNAME'),
                getenv('DB_PASSWORD'),
                $DbName
            )
        );
    }

    protected function dumpDb(string $dbName)
    {
        return $this->runCommand(sprintf(
            'mysql -h%s -u%s -p%s %s < %s',
            getenv('DB_HOST'),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD'),
            $dbName,
            $this->config->getPathDb()
        ));
    }

    protected function createEnv(string $deployPath, array $replace = [])
    {
        $env = file_get_contents($deployPath . '/.env-default');
        foreach ($replace as $key => $value) {
            $env = preg_replace("/($key)=(.*)/\n", "$1={$value}", $env);
        }
        return file_put_contents($deployPath . '/.env', $env);
    }

    protected function composerInstall(string $path)
    {
        return $this->runCommand('COMPOSER_HOME="/usr/local/bin/composer" php /usr/local/bin/composer install', $path);
    }
}
