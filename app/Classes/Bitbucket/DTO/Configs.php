<?php

namespace App\Classes\Bitbucket\DTO;

use App\Classes\Bitbucket\Exceptions\ConfigsException;
use App\Classes\Bitbucket\Exceptions\StrategyException;
use App\Classes\Bitbucket\Strategy\Strategy;
use stdClass;

class Configs
{

    private const MAIN_CONFIG_KEY = 'main_config';

    /**
     * @var array
     */
    private $configs;

    /**
     * @var string
     */
    private $currentEvent;

    /**
     * @var string
     */
    private $repoPath;

    /**
     * @var stdClass
     */
    protected $body;

    public function __construct(array $configs, stdClass $body, ?string $currentEvent = null)
    {
        $this->configs = $configs;
        $this->body = $body;
        $this->currentEvent = $currentEvent;
        $this->init();
        $this->validate();
    }

    private function init()
    {
        if (!isset($this->body->repository->name)) {
            throw new StrategyException("Invalid payload data was received!Invalid RepoPath");
        }
        $this->repoPath = $this->body->repository->name;
    }

    public function getBody()
    {
        return $this->body;
    }

    public static function path(): string
    {
        return dirname(__FILE__, 2) . '/config.php';
    }

    /**
     * @return void
     * @throws ConfigsException
     */
    private function validate()
    {
        if (empty($this->currentEvent)) {
            throw new ConfigsException("Event is empty");
        }
        if (empty($this->repoPath)) {
            throw new ConfigsException("Repo Path config is empty \"{$this->repoPath}\" is missed from list");
        }
        if (empty($this->getCurrentEvent())) {
            throw new ConfigsException("Event config is empty \"{$this->currentEvent}\" is missed from list");
        }
        if (!isset($this->getCurrentEvent()['strategy'])) {
            throw new ConfigsException("Strategy is missed from list ");
        }
        if (!is_a($this->getCurrentEvent()['strategy'], Strategy::class, true)) {
            throw new ConfigsException(
                $this->configs[$this->currentEvent] . ' must be an instance of ' . Strategy::class
            );
        }
    }

    private function getMainConfig(?string $key = null)
    {
        return $key
            ? $this->configs[self::MAIN_CONFIG_KEY][$key]
            : $this->configs[self::MAIN_CONFIG_KEY];
    }

    private function getCurrentEvent(?string $key = null)
    {
        return $key
            ? $this->configs[$this->repoPath][$this->currentEvent][$key]
            : $this->configs[$this->repoPath][$this->currentEvent];
    }

    public function getStrategyClass(): string
    {
        return $this->getCurrentEvent('strategy');
    }

    public function isBranchExist(string $branch): bool
    {
        return isset($this->getCurrentEvent()[$branch]);
    }

    public function getDeployPaths(string $branch): array
    {
        return $this->getCurrentEvent($branch)['deployPath'];
    }

    public function callAfterProcess(Strategy $strategy, string $deployPath)
    {
        if (is_callable($method = $this->getCurrentEvent()[$deployPath]['afterProcess'])) {
            return $method($strategy, $method);
        }
    }

    public function getRepoFolder(): string
    {
        return $this->getMainConfig('git_repo_folder');
    }

    public function generateDbName(string $dbName): string
    {
        return sprintf($this->getMainConfig('new_db_name'), $dbName);
    }

    public function getAppNameEnv(): string
    {
        return $this->getMainConfig('env_app_name');
    }

    public function getTelegramApiKeyEnv(): string
    {
        return $this->getMainConfig('env_telegram_api_key');
    }

    public function getTelegramChatIdEnv(): string
    {
        return $this->getMainConfig('env_telegram_chat_id');
    }

    public function getPathDb(): string
    {
        return $this->getMainConfig('path_to_db_name');
    }
}
