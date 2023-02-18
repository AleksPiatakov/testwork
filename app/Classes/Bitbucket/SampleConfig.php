<?php

use App\Classes\Bitbucket\Strategy\MergeStrategy;
use App\Classes\Bitbucket\Strategy\PushStrategy;

/**
 * see bibucket webhook
 */

return [
    'main_config' => [
        'git_repo_folder' => '/var/www/repositories',
        'new_db_name' => 'test_%s',
        'path_to_db_name' => '/var/www/html/sites/local_demo.sql',
        'env_app_name' => 'autoDeploy',
        'env_telegram_api_key' => 'env_telegram_api_key',
        'env_telegram_chat_id' => '-env_telegram_chat_id',
    ],
    'repo_name' => [
        'pullrequest:fulfilled' => [
            'strategy' => MergeStrategy::class,
            'dev' => [
                'deployPath' => [
                    'path/to/destination',
                    'path/to/destination2',
                    'path/to/destination',
                ],
            ],
        ],
        'repo:push' => [
            'strategy' => PushStrategy::class,
            'testdeploy' => [
                'deployPath' => [
                    'path/to/destination',
                ],
                'afterProcess' => function (PushStrategy $strategy) {
                    //something to do;
                }
            ],
        ],
    ],
    /*
      * Other event
      */
    'repo:fork',
    'repo:commit_comment_created',
    'repo:commit_status_created',
    'repo:commit_status_updated',
    'issue:created',
    'issue:updated',
    'issue:comment_created',
    'pullrequest:created',
    'pullrequest:updated',
    'pullrequest:approved',
    'pullrequest:unapproved',
    'pullrequest:rejected',
    'pullrequest:comment_created',
    'pullrequest:comment_updated',
    'pullrequest:comment_deleted'
];
