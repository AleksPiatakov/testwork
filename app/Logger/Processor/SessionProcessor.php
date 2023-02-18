<?php

declare(strict_types=1);

namespace App\Logger\Processor;

use Monolog\Processor\ProcessorInterface;

final class SessionProcessor implements ProcessorInterface
{
    public function __invoke(array $record): array
    {
        $record['extra']['session'] = $_SESSION ?? null;

        return $record;
    }

}