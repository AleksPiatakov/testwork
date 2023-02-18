<?php

namespace App\Logger\Formatter;

use Monolog\Formatter\NormalizerFormatter;
use Monolog\Logger;

class TelegramFormatter extends NormalizerFormatter
{
    public function __construct()
    {
        parent::__construct('Y-m-d H:i:s');
    }

    protected function emojiMap(): array
    {
        return [
            Logger::DEBUG => '👀',
            Logger::INFO => '‍🗨',
            Logger::NOTICE => '🥶',
            Logger::WARNING => ' ❗ ',
            Logger::ERROR => '🚨',
            Logger::CRITICAL => '🚨',
            Logger::ALERT => '🚨',
            Logger::EMERGENCY => '🚨',
        ];
    }

    public function format(array $record): string
    {
        $record = parent::format($record);
        $output = [
            "<a href=\"http://{$record['extra']['server']}\">{$record['extra']['server']}</a>⏱{$record['datetime']}",
            "<b>{$this->emojiMap()[$record['level']]}{$record['level_name']}</b>",
            "<b>Message:</b> {$record['message']}",
            "<b>Channel:</b> {$record['channel']}",
        ];

        if ($record['context']) {
            $output[] = "<b>Context:</b>";
            $output[] = $this->toJson($record['context'], true);
        }
        if ($record['extra']) {
            $output[] = "<b>Extra:</b>";
            $output[] = $this->toJson($record['extra'], true);
        }

        return implode(PHP_EOL, $output);
    }

    public function formatBatch(array $records): string
    {
        $message = '';
        foreach ($records as $record) {
            $message .= $this->format($record);
        }

        return $message;
    }
}
