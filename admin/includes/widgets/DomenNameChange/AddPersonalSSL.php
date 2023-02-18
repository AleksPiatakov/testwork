<?php

use App\Logger\Log;

if(empty($_POST['sitename'])){
    die();
}
$sitename = $_POST['sitename'];

$domen = 'https://solomono.net';
$secret = 89635123215497;

if(empty($_POST['part'])) {
    $url = $domen . '/api/add_personal_ssl.php?secret=' . $secret;
} else {
    $url = $domen . '/api/add_personal_ssl.php?secret=' . $secret . '&part=part_two';
}
$data = array('site_name' => $sitename);

$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);

$context = stream_context_create($options);
$results = file_get_contents($url, false, $context);

if ($results === FALSE) {
    Log::error('Ошибка запроса к api при попытке выпустить персональный сертификат. Сайт: ' . $sitename);
}

echo $results;
