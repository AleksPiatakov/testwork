<?php

use App\Logger\Log;

$sitename = env('APP_NAME');
$domen = 'https://solomono.net';
$secret = 89635123215497;
$url = $domen . '/api/domen_name_change.php?secret=' . $secret;
$data = array('site_name' => $sitename, 'domen_name' => DOMEN_NAME);

$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);

$context = stream_context_create($options);
$results = file_get_contents($url, false, $context);

if ($results === false) {
    Log::error('Ошибка запроса к api при попытке смены домена. Сайт: ' . $sitename . ', домен: ' . DOMEN_NAME);
    die();
}

require_once(DIR_WS_LANGUAGES . $_SESSION['language'] . '.php');

if (strpos($results, 'SUCCESS') === false) {
    echo '<span id="domen_errors">' . constant($results) . '<br /></span>';
} else {
    $url = str_replace('status=SUCCESS_DOMAIN_CHANGE&value=', '', $results);
    echo SUCCESS_DOMAIN_CHANGE . '<br />';
}