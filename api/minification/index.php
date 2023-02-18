<?php

$rootPath = __DIR__ . '/../../';
chdir($rootPath);

require_once 'includes/application_top.php';
require_once DIR_WS_FUNCTIONS . 'minification.php';

define('MINIFICATION_SECRET', '9955615397');

$response = [];

try {
    if (!isset($_GET['secret']) || $_GET['secret'] !== MINIFICATION_SECRET) {
        throw new Exception('Invalid secret key');
    }

    checkAndGenerateCriticalCss();

    // temporary disable notification
//    tep_mail(
//        '',
//        STORE_OWNER_EMAIL_ADDRESS,
//        'Minification api success',
//        'Minification api success',
//        'Bot',
//        STORE_OWNER_EMAIL_ADDRESS
//    );

    /*tep_mail(
        '',
        's.fedorenko.pd@gmail.com',
        'Minification api success - ' . HTTP_SERVER,
        'Minification api success - ' . HTTP_SERVER,
        'Bot',
        STORE_OWNER_EMAIL_ADDRESS
    );*/


    $response = [
        'status'  => true,
        'message' => 'Minification success',
    ];
} catch (Exception $exception) {
    $response = [
        'status'  => false,
        'message' => $exception->getMessage(),
    ];
}

header('Content-Type: application/json');

echo json_encode($response);
