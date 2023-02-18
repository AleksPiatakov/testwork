<?php

$baseDirectory = basename(__DIR__) . '/';
chdir('../');
$env = parse_ini_file('.env');
$rootPath = getcwd();
require('includes/bootstrap.php');
define('DB_SERVER', $env['DB_HOST']); // eg, localhost - should not be empty for productive servers
define('DB_SERVER_USERNAME', $env['DB_USERNAME']);
define('DB_SERVER_PASSWORD', $env['DB_PASSWORD']);
define('DB_DATABASE', $env['DB_DATABASE']);
//require('includes/configure.php');
require('includes/functions/database.php');
require('includes/functions/general.php');
require('includes/configure.php');
require('includes/database_tables.php');
tep_db_connect() or die('Unable to connect to database server!'); // make a connection to the database... now

//$method = $_SERVER['REQUEST_METHOD'];
$method = $_REQUEST['action'];

switch ($method) {
    case 'setStatus':
        $orderId = (int)$_REQUEST['order_id'];
        $statusId = (int)$_REQUEST['status_id'];
        $parcelId = isset($_REQUEST['parcel_id']) ? $_REQUEST['parcel_id'] : '';
        if ($orderId === 0 || !is_numeric($orderId)) {
            echo json_encode(['error' => 'wrong order id']);
        }
        if ($statusId === 0 || !is_numeric($statusId)) {
            echo json_encode(['error' => 'wrong status id']);
        }
        if (setStatus($orderId, $statusId, $parcelId)) {
            echo json_encode(['status' => 'success']);
        }
        break;
    case 'getOrders':
        $timestamp = (int)$_REQUEST['date'];
        if ($timestamp === 0 || !is_numeric($timestamp)) {
            echo json_encode(['error' => 'wrong timestamp']);
        }
        $datetime = date('Y-m-d H:i:s', $timestamp); //YYYY-MM-DD HH:MM:SS
        echo json_encode(getOrders($datetime));
        die;
        break;
    default:
        die('wrong method');
}


function getOrders($datetime)
{
    $orders = $orders_id_list = [];
    $orders_query = tep_db_query("SELECT o.orders_id as number
                 , o.customers_name as name
                 , o.date_purchased as date
                 , o.currency
                 , o.payment_method as paymentKind
                 , o.customers_company as companyName
                 , o.customers_email_address as email
                 , o.customers_country as country
                 , o.customers_postcode as zipCode
                 , o.customers_city as city
                 , o.customers_street_address as street
                 , o.customers_telephone as phone
            FROM orders o
            WHERE o.date_purchased > '$datetime'");
    while ($row = tep_db_fetch_array($orders_query)) {
        $orders[$row['number']]['OrderData'] = [
            'id' => '',
            'number' => $row['number'],
            'date' => $row['date'],
            'deliveryKind' => '',
            'paymentKind' => $row['paymentKind'],
            'deliveryKind' => '',
            'currency' => $row['currency'],
            'total' => '',
        ];
        list($firstName, $lastName) = explode(' ', $row['name']);
        $orders[$row['number']]['ReceiverData'] = [
            'legalStatus' => '',
            'firstName' => $firstName,
            'lastName' => $lastName,
            'companyName' => $row['companyName'],
            'email' => $row['email'],
            'country' => $row['country'],
            'zipCode' => $row['zipCode'],
            'city' => $row['city'],
            'street' => $row['street'],
            'houseNo' => '',
            'localNo' => '',
            'phone' => $row['phone'],
            'phoneMobile' => '',
            'postMachine' => ''
        ];
        $orders_id_list[] = $row['number'];
    }
    if (!empty($orders_id_list)) {
        $orders_id_list = implode(',', $orders_id_list);
        $products_query = tep_db_query("
      SELECT 
      orders_id
      ,products_id as id
      ,products_model as sku
      ,products_name as name
      ,products_price as price
      ,products_quantity as quantity
      FROM orders_products
      WHERE orders_id in ($orders_id_list)
      ");
        while ($row = tep_db_fetch_array($products_query)) {
            $orders[$row['orders_id']]['OrderItems'][] = [
                'id' => $row['id'],
                'sku' => $row['sku'],
                'name' => $row['name'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
                'barcode' => '',
            ];
        }
        $totals_query = tep_db_query("
        SELECT orders_id
               ,class
               ,value
               ,text
        FROM orders_total
        WHERE orders_id in ($orders_id_list) and class in ('ot_shipping','ot_total')
      ");
        while ($row = tep_db_fetch_array($totals_query)) {
            if ($row['class'] == 'ot_shipping') {
                $orders[$row['orders_id']]['OrderData']['deliveryCost'] = $row['value'];
                $orders[$row['orders_id']]['OrderData']['deliveryKind'] = $row['text'];
            } elseif ($row['class'] == 'ot_total') {
                $orders[$row['orders_id']]['OrderData']['total'] = $row['value'];
            }
        }
    }
    return $orders;
}

function setStatus($orderId, $statusId, $parcelId = '')
{
    if (!tep_db_query("UPDATE orders SET orders_status = $statusId WHERE orders_id = $orderId")) {
        return false;
    }
    $comment = $parcelId ? "Parcel ID: $parcelId" : "";
    if (!tep_db_query("INSERT INTO orders_status_history (orders_status_id,comments,orders_id) VALUES ($statusId,'$comment',$orderId)")) {
        return false;
    }
    return true;
}
