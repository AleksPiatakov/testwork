<?php

use App\Classes\Bitbucket\BitbucketWebhook;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/bootstrap.php';

$body = json_decode(file_get_contents('php://input'));

if (!$body) {
    http_response_code(404);
    die('missing payload');
}

$manager = new BitbucketWebhook($_SERVER, $body);
try {
    $manager->execute();
} catch (Throwable $throwable) {
    http_response_code(404);
    echo $throwable->getMessage();
}

print_r($manager->getEvent());
print_r($manager->getServer());
