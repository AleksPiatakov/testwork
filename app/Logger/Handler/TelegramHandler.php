<?php

namespace App\Logger\Handler;

use App\Classes\Cache\Cache;
use App\Classes\Cache\Contracts\Store;
use Monolog\Handler\TelegramBotHandler;

class TelegramHandler extends TelegramBotHandler
{
    private array $firedMessages = [];

    protected function write(array $record): void
    {
        $key = $this->keyGenerate($record);

        if (false === $this->keyExist($key)) {
            $this->firedMessages[$key] = $record;
            Cache::store(Store::MEMCACHED)->add($key, $record, 240);
            $this->send($record['formatted']);
        }
    }

    private function keyExist(string $key): bool
    {
        return isset($this->firedMessages[$key]) || Cache::has($key);
    }

    private function keyGenerate($record): string
    {
        $key = sprintf(
            '%s-%s-%s-%s',
            $record['extra']['server'],
            $record['level'],
            $record['message'],
            $record['channel']
        );
        return md5($key);
    }
}
