<?php

declare(strict_types=1);

namespace admin\includes\solomono\app\models\cache;

use admin\includes\solomono\app\core\Model;
use App\Services\Console\Commands\ClearCacheCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Response;

final class cache extends Model
{
    public function select()
    {
        // TODO: Implement select() method.
    }

    public function clear()
    {
        $application = new Application();
        $application->add(new ClearCacheCommand());
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'cache:clear',
        ]);

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);
        return new Response();
    }
}