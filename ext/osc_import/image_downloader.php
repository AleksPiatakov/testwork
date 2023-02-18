<?php

ini_set('max_execution_time', 0);
require_once __DIR__ . DIRECTORY_SEPARATOR . 'functions.php';
$imageFolder = __DIR__ . '/../../images/';
$images      = getArrayFromJsonFile(PRODUCTS_IMAGES_JSON_PATH);


$images['inProgress'] = true;
file_put_contents(PRODUCTS_IMAGES_JSON_PATH, json_encode($images));

$url = $_POST['oldhostname'];
//https://demo.solomono.net/images/products/

if (!file_exists($imageFolder . 'products/')) {
    mkdir($imageFolder . 'products/');
}
foreach ($images['images'] as &$image) {
    foreach ($image as &$i) {
        if ($i['exist'] == false) {
            saveImg($url . $i['file'], $i['file']);
            $i['exist']      = true;
            $images['exist'] = (int)$images['exist'] + 1;
        }
        $images['processed']++;
        $i['status'] = true;
        file_put_contents(PRODUCTS_IMAGES_JSON_PATH, json_encode($images));
    }
}
die;
