<?php

namespace App\Logger;

use App\Logger\Formatter\TelegramFormatter;
use App\Logger\Handler\TelegramHandler;
use App\Logger\Processor\BodyProcessor;
use App\Logger\Processor\SessionProcessor;
use Monolog\Formatter\FormatterInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\FormattableHandlerInterface;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogHandler;
use Monolog\Logger;
use Monolog\Logger as Monolog;
use Monolog\Processor\GitProcessor;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\WebProcessor;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Throwable;

/**
 * @mixin Monolog
 */
class LogManager
{

    /**
     * The standard date format to use when writing logs.
     */
    private $dateFormat = 'Y-m-d H:i';

    /**
     * The Log levels.
     */
    private $levels = [
        'debug' => Monolog::DEBUG,
        'info' => Monolog::INFO,
        'notice' => Monolog::NOTICE,
        'warning' => Monolog::WARNING,
        'error' => Monolog::ERROR,
        'critical' => Monolog::CRITICAL,
        'alert' => Monolog::ALERT,
        'emergency' => Monolog::EMERGENCY,
    ];

    /**
     * The array of resolved channels.
     * @var array
     */
    private $channels = [];

    private $configs = [];

    public function __construct()
    {
        $this->configs = require_once dirname(__DIR__, 2) . '/config/logging.php';
    }

    /**
     * Get a log channel instance.
     */
    public function channel(?string $channel = null): LoggerInterface
    {
        return $this->driver($channel);
    }

    /**
     * Build an on-demand log channel.
     */
    public function build(array $config): LoggerInterface
    {
        unset($this->channels['ondemand']);

        return $this->get('ondemand', $config);
    }

    /**
     * Dynamically call the default driver instance.
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call(string $method, $parameters)
    {
        return $this->driver()->$method(...$parameters);
    }

    /**
     * Create a new, on-demand aggregate logger instance.
     */
    public function stack(array $channels, $channel = null): LoggerInterface
    {
        return $this->createStackDriver(compact('channels', 'channel'));
    }

    /**
     * Create an instance of any handler available in Monolog.
     * @throws \InvalidArgumentException
     */
    protected function createMonologDriver(array $config): LoggerInterface
    {

        if (!is_callable($config['handler'])) {
            throw new InvalidArgumentException($config['handler'] . ' must be closure');
        }
        $handler = call_user_func($config['handler']);
        if (!$handler instanceof HandlerInterface) {
            throw new InvalidArgumentException(get_class($handler) . ' must be an instance of ' . HandlerInterface::class);
        }

        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(
                $handler,
                $config
            )
        ]);
    }

    /**
     * Create a custom log driver instance.
     */
    protected function createCustomDriver(array $config): LoggerInterface
    {
        $factory = is_callable($via = $config['via']) ? $via : new $via();

        return $factory($config);
    }

    /**
     * Create an emergency log handler to avoid white screens of death.
     */
    protected function createEmergencyLogger(): LoggerInterface
    {
        $config = $this->configurationFor('emergency');

        $handler = new StreamHandler(
            $config['path'],
            $this->level(['level' => 'debug'])
        );

        return new Monolog('emergency', $this->prepareHandlers([$handler]), $this->prepareProcess());
    }

    private function createFormatter($formatter, array $with = []): FormatterInterface
    {
        if (is_callable($formatter)) {
            $formatter = call_user_func($formatter, ...$with);
        } elseif (is_string($formatter)) {
            $formatter = new $formatter(...$with);
        }
        if (!$formatter instanceof FormatterInterface) {
            throw new InvalidArgumentException(get_class($formatter) . ' must be an instance of ' . FormatterInterface::class);
        }

        return $formatter;
    }

    /**
     * Get a log driver instance.
     */
    private function driver(?string $driver = null): LoggerInterface
    {
        return $this->get($this->parseDriver($driver));
    }

    /**
     * Attempt to get the log from the local cache.
     */
    private function get(string $name, ?array $config = null): LoggerInterface
    {
        try {
            return $this->channels[$name] ?? with($this->resolve($name, $config), function ($logger) use ($name) {
                return $this->channels[$name] = $logger;
            });
        } catch (Throwable $e) {
            return tap($this->createEmergencyLogger(), function ($logger) use ($e) {
                $logger->emergency('Unable to create configured logger. Using emergency logger.', [
                    'exception' => $e,
                ]);
            });
        }
    }

    /**
     * Resolve the given log instance by name.
     * @throws \InvalidArgumentException
     */
    private function resolve($name, ?array $config = null): LoggerInterface
    {
        $config = $config ?? $this->configurationFor($name);

        if (is_null($config)) {
            throw new InvalidArgumentException("Log [{$name}] is not defined.");
        }

        $driverMethod = 'create' . ucfirst($config['driver']) . 'Driver';

        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}($config);
        }

        throw new InvalidArgumentException("Driver [{$config['driver']}] is not supported.");
    }

    /**
     * Get the log connection configuration.
     */
    private function configurationFor(string $name): array
    {
        return $this->configs['channels'][$name];
    }

    /**
     * Parse the driver name.
     */
    private function parseDriver(?string $driver = null): string
    {
        return $driver ?? $this->getDefaultDriver();
    }

    /**
     * Get the default log driver name.
     */
    private function getDefaultDriver(): string
    {
        return $this->configs['default'];
    }

    private function prepareLoggerArgs(callable $callable, array $channels): array
    {
        $items = array_map($callable, $channels);

        return array_merge([], ...$items);
    }

    /**
     * Extract the log channel from the given configuration.
     */
    private function parseChannel(array $config): string
    {
        return $config['name'] ?? getenv('APP_ENV');
    }

    /**
     * Prepare the handler for usage by Monolog.
     */
    private function prepareHandler(HandlerInterface $handler, array $config = []): HandlerInterface
    {
        if (Monolog::API !== 1 && (Monolog::API !== 2 || !$handler instanceof FormattableHandlerInterface)) {
            return $handler;
        }

        if (!isset($config['formatter'])) {
            $handler->setFormatter($this->formatter());
        } elseif ($config['formatter'] !== 'default') {
            $handler->setFormatter($this->createFormatter($config['formatter'], $config['formatter_with'] ?? []));
        }

        return $handler;
    }

    /**
     * Get a Monolog formatter instance.
     */
    private function formatter(): FormatterInterface
    {
        return tap(new LineFormatter(null, $this->dateFormat, true, true), function ($formatter) {
            //$formatter->includeStacktraces();
        });
    }

    /**
     * Parse the string level into a Monolog constant.
     * @param array $config
     * @return int
     * @throws \InvalidArgumentException
     */
    private function level(array $config): int
    {
        $level = $config['level'] ?? 'debug';

        if (isset($this->levels[$level])) {
            return $this->levels[$level];
        }

        throw new InvalidArgumentException('Invalid log level.');
    }

    /**
     * Create an aggregate log driver instance.
     * @see self::resolve
     */
    private function createStackDriver(array $config): LoggerInterface
    {
        if (is_string($config['channels'])) {
            $config['channels'] = explode(',', $config['channels']);
        }

        $channel = $config['channels'];

        $handlers = $this->prepareLoggerArgs(function ($channel) {
            return $channel instanceof LoggerInterface
                ? $channel->getHandlers()
                : $this->channel($channel)->getHandlers();
        }, $channel);

        $processors = $this->prepareLoggerArgs(function ($channel) {
            return $channel instanceof LoggerInterface
                ? $channel->getProcessors()
                : $this->channel($channel)->getProcessors();
        }, $channel);

        return new Monolog($this->parseChannel($config), $handlers, $processors);
    }

    /**
     * Create an instance of the "error log" log driver.
     * @param array $config
     * @return  LoggerInterface
     */
    private function createErrorlogDriver(array $config): LoggerInterface
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(new ErrorLogHandler(
                $config['type'] ?? ErrorLogHandler::OPERATING_SYSTEM,
                $this->level($config)
            )),
        ], $this->prepareProcess());
    }

    /**
     * Create an instance of the syslog log driver.
     */
    private function createSyslogDriver(array $config): LoggerInterface
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(new SyslogHandler(
                env('APP_ENV'),
                $config['facility'] ?? LOG_USER,
                $this->level($config)
            ), $config),
        ], $this->prepareProcess());
    }

    /**
     * Create an instance of the daily file log driver.
     */
    private function createDailyDriver(array $config): LoggerInterface
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(new RotatingFileHandler(
                $config['path'],
                $config['days'] ?? 7,
                $this->level($config),
                $config['bubble'] ?? true,
                $config['permission'] ?? null,
                $config['locking'] ?? false
            ), $config),
        ], $this->prepareProcess());
    }

    /**
     * Create an instance of the single file log driver.
     * @see self::resolve
     */
    private function createSingleDriver(array $config): LoggerInterface
    {
        return new Monolog($this->parseChannel($config), [
            $this->prepareHandler(
                new StreamHandler(
                    $config['path'],
                    $this->level($config),
                    $config['bubble'] ?? true,
                    $config['permission'] ?? null,
                    $config['locking'] ?? false
                ),
                $config
            ),
        ], $this->prepareProcess());
    }

    /**
     * Create an instance of the telega file log driver.
     */
    private function createTelegramDriver(array $config): LoggerInterface
    {
        $formatter = tap(new TelegramFormatter(), function (TelegramFormatter $formatter) {
            $formatter->setJsonPrettyPrint(true);
        });

        $handler = new TelegramHandler(
            $config['api_key'],
            $config['chat_id'],
            $this->level($config),
            true,
            'HTML'
        );
        $handler->setFormatter($formatter);

        return new Monolog($this->parseChannel($config), [
            $handler,
        ], $this->prepareProcess());
    }

    private function prepareProcess(): array
    {
        return [
            new IntrospectionProcessor(Logger::DEBUG, [
                'App\\Logger\\',
                'App\\Exceptions\\Handler\\Handler',
                'Bootstrap\\HandleExceptions',
            ]),
            new WebProcessor(),
            new MemoryPeakUsageProcessor(),
            new SessionProcessor(),
            new BodyProcessor(),
        ];
    }
}
