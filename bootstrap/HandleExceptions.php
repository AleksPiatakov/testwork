<?php

namespace Bootstrap;

use App\Exceptions\Handler\Handler;
use App\Logger\Log;
use ErrorException;
use Throwable;

class HandleExceptions
{

    /**
     * Set the error handling for the application.
     */
    public function registerErrorHandling(): void
    {
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);

        ini_set('ignore_repeated_errors', true);

        /**
         * You can add to php.ini to log all errors additional
         */
        //ini_set("log_errors", 1);
        //ini_set('error_log' , '/home/solomono/web/solomono.net/sites/dev/php.log');

        error_reporting(E_ALL);

        set_error_handler(function ($level, $message, $file = '', $line = 0) {
            $this->handleError($level, $message, $file, $line);
        });

        set_exception_handler(function ($e) {
            $this->handleException($e);
        });

        register_shutdown_function(function () {
            $this->handleShutdown();
        });
    }

    /**
     * Report PHP deprecations, or convert PHP errors to ErrorException instances.
     *
     * @param int $level
     * @param string $message
     * @param string $file
     * @param int $line
     * @param array $context
     * @return void
     *
     */
    protected function handleError($level, $message, $file = '', $line = 0, $context = [])
    {
        if (error_reporting() & $level) {
            if ($this->isDeprecation($level)) {
                $this->handleDeprecation($message, $file, $line);
                return;
            }

            $this->handleException(new ErrorException($message, 0, $level, $file, $line));
        }
    }

    /**
     * Determine if the error level is a deprecation.
     */
    protected function isDeprecation(int $level): bool
    {
        return in_array($level, [E_DEPRECATED, E_USER_DEPRECATED]);
    }

    /**
     * Reports a deprecation to the "deprecations" logger.
     *
     * @param string $message
     * @param string $file
     * @param int $line
     */
    protected function handleDeprecation($message, $file, $line): void
    {
        Log::warning(sprintf(
            '%s in %s on line %s',
            $message,
            $file,
            $line
        ));
    }

    /**
     * Handle an uncaught exception instance.
     */
    protected function handleException(Throwable $e): void
    {
        $handler = new Handler();

        $handler->report($e);

        $handler->render($e);
    }

    /**
     * Handle the PHP shutdown event.
     */
    protected function handleShutdown(): void
    {
        if (!is_null($error = error_get_last()) && $this->isFatal($error['type'])) {
            $this->handleException($this->fatalErrorFromPhpError($error, 0));
        }
    }

    /**
     * Determine if the error type is fatal.
     */
    protected function isFatal(int $type): bool
    {
        return in_array($type, [E_COMPILE_ERROR, E_CORE_ERROR, E_ERROR, E_PARSE]);
    }

    /**
     * Create a new fatal error instance from an error array.
     *
     * @param array $error
     * @param int|null $traceOffset
     * @return \Error
     */
    protected function fatalErrorFromPhpError(array $error, $traceOffset = null)
    {
        return new \Error($error['message'], 0);
    }
}
