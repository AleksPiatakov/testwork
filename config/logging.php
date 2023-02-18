<?php

use App\Classes\Bitbucket\BitbucketWebhook;
use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

define('LOG_PATH',__DIR__.'/../');
return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'daily'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the log channel that should be used to log warnings
    | regarding deprecated PHP and library features. This allows you to get
    | your application ready for upcoming major versions of dependencies.
    |
    */

    'deprecations' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily', 'telegram']
        ],

        'single' => [
            'driver' => 'single',
            'path' => LOG_PATH . 'storage/logs/single.log',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        BitbucketWebhook::LOG_CHANNEL => [
            'name' => 'autoDeploy',
            'driver' => 'telegram',
            'api_key' => env('TELEGRAM_API_KEY', ''),
            'chat_id' => env('TELEGRAM_CHAT_ID', ''),
            'level' => 'info',
        ],

        'telegram' => [
            'driver' => 'telegram',
            'api_key' => env('TELEGRAM_API_KEY', ''),
            'chat_id' => env('TELEGRAM_CHAT_ID', ''),
            'level' => env('LOG_LEVEL_TELEGRAM', 'warning'),
        ],

        'all' => [
            'driver' => 'daily',
            'path' => LOG_PATH . 'storage/logs/all.log',
            'level' => 'debug',
            'days' => 7,
        ],

        'payment' => [
            'driver' => 'daily',
            'path' => LOG_PATH . 'storage/logs/payments.log',
            'level' => 'debug',
            'days' => 14,
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => LOG_PATH . 'storage/logs/daily.log',
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 7,
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'emergency' => [
            'path' => LOG_PATH . 'storage/logs/emergency.log',
        ],
    ],

];
