<?php

namespace App\Exceptions\Handler;

use App\Logger\Log;
use Psr\Log\LogLevel;
use Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer;
use Throwable;

class Handler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        //ValidationException::class,
    ];

    /**
     * Report or log an exception.
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     */
    public function report(Throwable $e): void
    {
        if ($this->shouldntReport($e)) {
            return;
        }

        try {
            Log::log($this->defaultErrorLevelMap()[$this->getLogLevel($e)], $e->getMessage(), ['exception' => $e]);
        } catch (\Throwable $ex) {
            $this->render($ex);
            $this->render($e);
            throw $e;
        }
    }


    /**
     * Determine if the exception is in the "do not report" list.
     */
    private function shouldntReport(Throwable $e): bool
    {
        foreach ($this->dontReport as $type) {
            if ($e instanceof $type) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array<int, LogLevel::*>
     */
    private function defaultErrorLevelMap(): array
    {
        return [
            E_ERROR => LogLevel::CRITICAL,
            E_WARNING => LogLevel::WARNING,
            E_PARSE => LogLevel::ALERT,
            E_NOTICE => LogLevel::NOTICE,
            E_CORE_ERROR => LogLevel::CRITICAL,
            E_CORE_WARNING => LogLevel::WARNING,
            E_COMPILE_ERROR => LogLevel::ALERT,
            E_COMPILE_WARNING => LogLevel::WARNING,
            E_USER_ERROR => LogLevel::ERROR,
            E_USER_WARNING => LogLevel::WARNING,
            E_USER_NOTICE => LogLevel::NOTICE,
            E_STRICT => LogLevel::NOTICE,
            E_RECOVERABLE_ERROR => LogLevel::ERROR,
            E_DEPRECATED => LogLevel::NOTICE,
            E_USER_DEPRECATED => LogLevel::NOTICE,
        ];
    }

    private function getLogLevel(Throwable $e)
    {
        return method_exists($e, 'getSeverity')
            ? $e->getSeverity()
            : E_WARNING;
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render(Throwable $e)
    {
        if (
            in_array($this->getLogLevel($e), [
            E_NOTICE,
            E_USER_NOTICE,
            E_STRICT,
            E_DEPRECATED,
            E_USER_DEPRECATED
            ]) || strpos($e->getMessage(), 'Telegram API error.') !== false
        ) {
            return;
        }
        $renderer = new HtmlErrorRenderer(env('APP_DEBUG', true));

        $r = $renderer->render($e)->getAsString();
        echo ($r);
    }
}
