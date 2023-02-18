<?php

//require_once ('languages/' . $language . '/auto_translate.php');
ini_set('max_execution_time', -1);
require_once('multi_translate.php');

define('QUEUE_TIMEOUT', 60); // 1 minute
define('SLEEP_TIME', 2); // 2 second

$startTime = microtime(true);

function getArrayFromJsonFile($filePath)
{
    if (file_exists($filePath)) {
        return json_decode(file_get_contents($filePath), true);
    }
    return [];
}

sleep(SLEEP_TIME);

while (true) {
    $progress = getArrayFromJsonFile(PROCESS_JSON_PATH);
    if (isset($progress['translate_progress'])) {
        if ($progress['translate_progress'] == 100 || (isset($progress['done']) && $progress['done'])) {
            $json = json_encode([
                'msg'     => isset($progress['msg']) ? $progress['msg'] : 'Translate Completed',
                'ratio'   => $progress['translate_progress'],
                'done'    => true,
            ]);
            echo $json;
            unlink(PROCESS_JSON_PATH);
            die;
        } else {
            $json = json_encode([
                'error'   => false,
                'ratio'   => $progress['translate_progress'],
                'done'    => false,
            ]);
            echo $json;
            die;
        }
    } else {
        die(json_encode([
            'error' => true,
            'msg'   => 'Images missing',
        ]));
    }
}
