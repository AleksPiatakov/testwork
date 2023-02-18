<?php

// define some constants here
// todo: it should be placed in database_tables file, but not in core database_tables
define('TABLE_API_KEYS', 'api_keys');

// hack to make right paths in application_top
$rootPath = __DIR__ . '/../../../';
chdir($rootPath);

require_once $rootPath . 'includes/application_top.php';

// funcs
function json(array $response, $code = null)
{
    header('Content-Type: application/json');
    if ($code) {
        http_response_code($code);
    }
    die(json_encode($response));
}

function getOrderByDate()
{
    $from = (int)$_GET['from'];
    $to   = isset($_GET['to']) ? (int)$_GET['from'] : null;

    $from = date('Y-m-d H:i:s', $from);

    $sql = "
        SELECT o.orders_id
             , o.customers_name
             , o.date_purchased
             , o.currency
             , o.payment_method
             , o.customers_company
             , o.customers_email_address
             , o.customers_country
             , o.customers_postcode
             , o.customers_city
             , o.customers_street_address
             , o.customers_telephone
            FROM orders o
        WHERE o.date_purchased >= '$from'
    ";

    if ($to !== null) {
        $to  = date('Y-m-d H:i:s', $to);
        $sql .= "AND o.date_purchased  <= '$to'";
    }

    $query = tep_db_query($sql);

    $result = [];
    while ($row = tep_db_fetch_array($query)) {
        $result[] = $row;
    }

    json($result);
}

function getOrders()
{
    $sql = "
        SELECT o.orders_id
             , o.customers_name
             , o.date_purchased
             , o.currency
             , o.payment_method
             , o.customers_company
             , o.customers_email_address
             , o.customers_country
             , o.customers_postcode
             , o.customers_city
             , o.customers_street_address
             , o.customers_telephone
            FROM orders o
    ";

    $query = tep_db_query($sql);

    $result = [];
    while ($row = tep_db_fetch_array($query)) {
        $result[] = $row;
    }

    json($result);
}

function getLanguages()
{
    $query = tep_db_query("
        SELECT languages_id
             , name
             , code
             , directory
        FROM " . TABLE_LANGUAGES . "
        WHERE lang_status = '1'
    ");

    $result = [];
    while ($row = tep_db_fetch_array($query)) {
        $result[] = $row;
    }

    json($result);
}


/**
 * Api Key validation middleware
 */
$headers = [];
foreach ($_SERVER as $name => $value) {
    if (substr($name, 0, 5) == 'HTTP_') {
        $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
    }
}

try {
    if (getConstantValue('API_ENABLED') !== 'true') {
        throw new Exception('Api module is disabled');
    } else {
        if (empty($headers['Solomono-Api-Key'])) {
            throw new Exception("Empty Api Key");
        } else {
            if (preg_match('|[^a-zA-Z0-9\-]|', $headers['Solomono-Api-Key'], $matches)) {
                throw new Exception("Invalid Api Key chars");
            }
        }
    }

    $apiKey = tep_db_prepare_input($headers['Solomono-Api-Key']);
    $query  = tep_db_query("SELECT * FROM " . TABLE_API_KEYS . " WHERE api_key = '$apiKey' AND api_key_status = '1'");

    if (tep_db_num_rows($query) == 0) {
        throw new Exception("Invalid Api Key");
    }
} catch (Exception $e) {
    json([
        'error_code'    => $e->getCode(),
        'error_message' => $e->getMessage(),
    ], 500);
}

$action = isset($_GET['action']) ? $_GET['action'] : '';


switch ($action) {
    case 'get_languages':
        getLanguages();
        break;
    case 'get_orders':
        getOrders();
        break;
    case 'get_orders_by_date':
        getOrderByDate();
        break;
    default:
        json([
            'error_code'    => 0,
            'error_message' => 'Invalid action',
        ], 500);
}
