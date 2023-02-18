<?php

declare(strict_types=1);

namespace App\Logger\Processor;

use Monolog\Processor\ProcessorInterface;

final class BodyProcessor implements ProcessorInterface
{
    private array $body;

    public function __construct()
    {
        $this->body = array_merge($_REQUEST, json_decode(file_get_contents('php://input'), true) ?? []);
    }

    public function __invoke(array $record): array
    {
        $record['extra']['body'] = $this->body;

        return $record;
    }

}