<?php

namespace App\Classes\Bitbucket;

use App\Classes\Bitbucket\DTO\Configs;
use App\Classes\Bitbucket\Strategy\Strategy;
use App\Logger\Log;
use Psr\Log\LoggerInterface;
use stdClass;

class BitbucketWebhook
{
    public const LOG_CHANNEL = 'webhookBucket';

    /**
     * Server and execution environment parameters ($_SERVER).
     *
     * @var array
     */
    private $server = [];

    /**
     * Headers (taken from the $_SERVER).
     *
     * @var array
     */
    private $headers = [];

    /**
     * @var stdClass
     */
    private $body;

    /**
     * Deploy constructor.
     *
     * @param array $server
     * @param stdClass $body
     */
    public function __construct(array $server, stdClass $body)
    {
        $this->server = $server;
        $this->headers = $this->setHeaders($server);
        $this->body = $body;
    }

    public static function log(): LoggerInterface
    {
        return Log::stack([self::LOG_CHANNEL, 'single']);
    }

    public function execute()
    {
        try {
            $config = $this->getConfigs();
            $strategy = $this->getStrategy($config);
            $strategy->execute();
        } catch (\Throwable $e) {
            self::log()->error($e->getMessage(), [
                'event' => $this->getEvent(),
                'file' => $e->getFile() . ':' . $e->getLine()
            ]);
            throw $e;
        }

        self::log()->info('Auto Deploy was success', $strategy->getHistoryInfo());
    }

    public function getEvent()
    {
        return $this->getHeader('X_EVENT_KEY');
    }

    public function getServer(): array
    {
        return $this->server;
    }

    private function setHeaders(array $server): array
    {
        $headers = [];
        foreach ($server as $key => $value) {
            if (str_starts_with($key, 'HTTP_')) {
                $headers[substr($key, 5)] = $value;
            }
        }
        return $headers;
    }

    private function getHeader(string $key)
    {
        return $this->headers[$key] ?? null;
    }

    /**
     * @return Configs
     * @throws Exceptions\ConfigsException
     */
    private function getConfigs(): Configs
    {
        return new Configs(require_once Configs::path(), $this->body, $this->getEvent());
    }

    /**
     * @param Configs $config
     * @return Strategy
     */
    private function getStrategy(Configs $config): Strategy
    {
        $strategyClass = $config->getStrategyClass();

        return new $strategyClass($config);
    }
}
