<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'functions.php';
define('QUEUE_TIMEOUT', 60); // 1 minute
define('SLEEP_TIME', 3); // 3 second
$currentlyUploaded = (int)$_GET['current'];
$startTime         = microtime(true);

while (true) {
    $images = getArrayFromJsonFile(PRODUCTS_IMAGES_JSON_PATH);
    if ($images) {
        $isDownloadCompleted = $images['exist'] == $images['total'];
        if ($isDownloadCompleted) {
            unlink(PRODUCTS_IMAGES_JSON_PATH);
            $json = json_encode([
              'msg'     => 'Products image download completed',
              'ratio'   => $images['exist'] / $images['total'] * 100,
              'current' => $images['exist'],
              'text'    => "{$images['exist']} / {$images['total']}",
              'done'    => $isDownloadCompleted,
            ]);
            echo $json;
            die;
        }
        if ($images['exist'] !== $currentlyUploaded) {
            $json = json_encode([
              'error'   => false,
              'ratio'   => $images['exist'] / $images['total'] * 100,
              'current' => $images['exist'],
              'text'    => "{$images['exist']} / {$images['total']}",
              'done'    => $isDownloadCompleted,
            ]);
            echo $json;
            die;
        } else {
            if (microtime(true) - $startTime > QUEUE_TIMEOUT) {
                $json = json_encode([
                  'error' => true,
                  'msg'   => 'Timeout',
                ]);
                echo $json;
                die;
            }
            sleep(SLEEP_TIME);
            continue;
        }
    } else {
        die(json_encode([
          'error' => true,
          'msg'   => 'Images missing',
        ]));
    }
}
