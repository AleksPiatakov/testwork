<?php
if (!$_GET['product_id'] || !$_GET['filename']) {
    die('Error: parameters are missing');
}
require_once('includes/application_top.php');

$product_id = $_GET['product_id'];
$filename = $_GET['filename'];
$customer_id = $_SESSION['customer_id'];
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : false;

$file = 'images/downloads/' . $product_id . '/' . $filename;

if (!is_file($file)) {
    die('Error: requested  file is missing');
}

$is_download_product = tep_is_download_product($product_id);

if ($is_download_product) { //файл продается, нужно проверить, покупали ли его
    if ($order_id) { //если передался номер заказа (ссылка из истории заказов)
        //должны совпадать условия:
        //пользователь $customer_id создал заказ $order_id
        // и заказ имеет статус, который разрешает загрузку товаров
        $order_data = tep_get_product_to_order($product_id, $order_id, $customer_id);

        if ($order_data->num_rows > 0) { // все условия совпали
            getFile($file);
        } else {
            die('Error: something went wrong');
        }
    } else {
        die('Error: order_id is missing');
    }
} else {
    getFile($file);
}

function getFile($file)
{
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));

    readfile($file);

    echo $file;

}