<?php

ob_start();

echo "Script was ran" . PHP_EOL . PHP_EOL;

define('ONE_HOUR', 3600);
define('ONE_DAY', 86400);
define('FIVE_DAYS', 432000);


$customer_price = 'products_price';
define('TABLE_SCART', 'scart');
//https://shashinki.com/shop/cron_recover_cart_sales.php
$languages_id = 1;
$_SESSION['languages_id'] = $languages_id;

//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

define('DIR_WS_INCLUDES', 'includes/');
define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');

if (empty(ini_get('date.timezone'))) {
    date_default_timezone_set('Europe/Kiev');
}

if ($rootPath == '' || !tep_not_null($rootPath)) {
    $rootPath = dirname($_SERVER['SCRIPT_FILENAME']);
}
require_once($rootPath . '/includes/bootstrap.php');

// Start the clock for the page parse time log
define('PAGE_PARSE_START_TIME', microtime());

// Check if register_globals is enabled.
// Since this is a temporary measure this message is hardcoded. The requirement will be removed before 2.2 is finalized.
if (function_exists('ini_get')) {
//    ini_get('register_globals') or exit('FATAL ERROR: register_globals is disabled in php.ini, please enable it!');
}

// Set the local configuration parameters - mainly for developers
if (file_exists(DIR_WS_INCLUDES . 'includes/local/configure.php')) {
    include(DIR_WS_INCLUDES . 'local/configure.php');
}

// set php_self in the local scope
$PHP_SELF = (isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME']);

// include the list of project filenames
require(DIR_WS_INCLUDES . 'filenames.php');
//require_once(DIR_WS_INCLUDES . "solomono/app/core/Config.php");

// include the list of project database tables
require(DIR_WS_INCLUDES . 'database_tables.php');

//     define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)
define('MENU_DHTML', true);

// Include application configuration parameters
require(DIR_WS_INCLUDES . 'configure.php');

// include the database functions
require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
tep_db_connect() or die('Unable to connect to database server!');

// set application wide parameters
$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
while ($configuration = tep_db_fetch_array($configuration_query)) {
    // check modules folders:
    $check_modules_folders = explode(':', $configuration['cfgValue']);
    if ($check_modules_folders[1] == 'true' or $check_modules_folders[1] == 'false') {
        if (is_dir(DIR_FS_CATALOG . 'ext/' . $check_modules_folders[0])) { // if module is On and it`s folder exists
            define($configuration['cfgKey'], $check_modules_folders[1]);
        } else { // if module is On BUT folder does not exists, then FALSE
            define($configuration['cfgKey'], 'false');
        }
    } elseif ($configuration['cfgKey'] == 'MAX_DISPLAY_SEARCH_RESULTS') {
        define($configuration['cfgKey'], explode(';', $configuration['cfgValue'])[0]);
    } else {
        define($configuration['cfgKey'], $configuration['cfgValue']);
    }
}

if (MENU_DHTML == 'true') {
    define('BOX_WIDTH', 0);
} else {
    define('BOX_WIDTH', 125);
}

// define our general functions used application-wide
require(DIR_WS_FUNCTIONS . 'extra_product_price.php');
require(DIR_WS_FUNCTIONS . 'general.php');
require(DIR_WS_FUNCTIONS . 'html_output.php');

////////////////////////////////
/// ///////////////////////////////
/// //////////////////////////////

function get_date_time($date_time)
{
    $year = substr($date_time, 0, 4);
    $month = substr($date_time, 4, 2);
    $day = substr($date_time, 6, 2);

    $hour = substr($date_time, 8, 2);
    if (!$hour) {
        $hour = '00';
    }
    $minute = substr($date_time, 10, 2);
    if (!$minute) {
        $minute = '00';
    }
    $second = substr($date_time, 12, 2);
    if (!$second) {
        $second = '00';
    }

    return $year . '-' . $month . '-' . $day . ' ' . $hour . ':' . $minute . ':' . $second;
}


function get_products_information($products_ids, $quantity)
{
    global $currencies;

    $pattern = "/([0-9]+)\{([0-9]+)\}([0-9]+)|([0-9]+)/";
    $matches = [];
    preg_match($pattern, $products_ids, $matches);


    if ($matches[2] == "" && $matches[3] == "") {
        $products_id = $matches[4];
        $products_query = tep_db_query("SELECT p.products_price, p.products_image, p.products_tax_class_id, p.products_model, pd.products_name
                                        FROM products p LEFT JOIN products_description pd ON p.products_id = pd.products_id
                                        WHERE p.products_id = '" . (int)$products_id . "'");

        $products_info = tep_db_fetch_array($products_query);

        $special_price = tep_get_products_special_price($products_id);
        if ($special_price < 1) {
            $special_price = $products_info['products_price'];
        }
        // Some users may want to include taxes in the pricing, allow that. NOTE HOWEVER that we don't have a good way to get individual tax rates based on customer location yet!
        if (RCS_INCLUDE_TAX_IN_PRICES == 'true') {
            $special_price += ($special_price * tep_get_tax_rate($products_info['products_tax_class_id']) / 100);
        } else {
            if (RCS_USE_FIXED_TAX_IN_PRICES == 'true' && RCS_FIXED_TAX_RATE > 0) {
                $special_price += ($special_price * RCS_FIXED_TAX_RATE / 100);
            }
        }

        $tprice = ($quantity * $special_price);
        $pprice_formated = $currencies->format($special_price);
        $tpprice_formated = $currencies->format($quantity * $special_price);

        $products_image_array = explode(';', $products_info['products_image']);

        return [
            'products_model' => $products_info['products_model'],
            'products_quantity' => $quantity,
            'products_name' => $products_info['products_name'],
            'products_image' => array_shift($products_image_array),
            'products_price' => $tpprice_formated
        ];
    } else {
        $products_id = $matches[1];
        $products_query = tep_db_query("SELECT p.products_price, p.products_image, p.products_tax_class_id, p.products_model, pd.products_name
                                        FROM products p LEFT JOIN products_description pd ON p.products_id = pd.products_id
                                        WHERE p.products_id = '" . (int)$products_id . "'");

        $products_info = tep_db_fetch_array($products_query);

        $special_price = tep_get_products_special_price($products_id);
        if ($special_price < 1) {
            $special_price = $products_info['products_price'];
        }
        // Some users may want to include taxes in the pricing, allow that. NOTE HOWEVER that we don't have a good way to get individual tax rates based on customer location yet!
        if (RCS_INCLUDE_TAX_IN_PRICES == 'true') {
            $special_price += ($special_price * tep_get_tax_rate($products_info['products_tax_class_id']) / 100);
        } else {
            if (RCS_USE_FIXED_TAX_IN_PRICES == 'true' && RCS_FIXED_TAX_RATE > 0) {
                $special_price += ($special_price * RCS_FIXED_TAX_RATE / 100);
            }
        }

        $tprice = ($quantity * $special_price);
        $pprice_formated = $currencies->format($special_price);
        $tpprice_formated = $currencies->format(($quantity * $special_price));

        $products_image_array = explode(';', $products_info['products_image']);

        return [
            'products_model' => $products_info['products_model'],
            'products_quantity' => $quantity,
            'products_name' => $products_info['products_name'],
            'products_image' => array_shift($products_image_array),
            'products_price' => $tpprice_formated
        ];
    }
}

function send_customer_mail($customer_products_array, $customer_info, $template_id)
{
    switch ($template_id) {
        case 1:
            $email_template = 'rcs_email';
            break;
        case 2:
            $email_template = 'rcs_email_2';
            break;
        case 3:
            $email_template = 'rcs_email_3';
            break;
        default:
            $email_template = 'rcs_email';
            break;
    }

    $products_block = "";
    foreach ($customer_products_array as $products) {
        $products_block .= '<div style="display:inline-block;font-size: 13px;text-align:left;width:50%;min-width:120px;max-width:100%;width:-webkit-calc(230400px - 48000%);min-width: -webkit-calc(50%);width:calc(230400px - 48000%);min-width: calc(50%);margin-bottom:5px;">
                                          <div style="display: inline-block;box-shadow: 0 2px 4px rgba(3,27,78,.06);padding: 10px;border: 1px solid #e5e8ed;border-radius: 0;width: calc(100% - 21px);margin: 0 0 -1px;">';

        if (!empty($products['products_image'])) {
            $products_block .= '<span style="height:48px;width:48px;margin-right: 10px;float:left;text-align:center;line-height:48px;">
                                              <img src="' . 'https://shashinki.com/shop' . '/getimage/48x48/products/' . $products['products_image'] . '" style="max-height:48px;max-width:48px;vertical-align: middle;">
                                            </span>';
        }
        // $tprice + ($inrec['qty'] * $sprice);
        //                                              <div style="text-overflow: ellipsis; overflow: hidden;  white-space: nowrap;min-height: 20px;">'.$products_ordered_attributes.'</div>

        $products_block .= '<div style="display:block;margin-left:58px;">
                                              <span style="display:block;text-overflow: ellipsis; overflow: hidden;height: 60px;">' . ($products['products_quantity'] > 1 ? ('(<b>' . $products['products_quantity'] . '</b>)') : '') . ' <b>#' . $products['products_model'] . '</b> ' . $products['products_name'] . '</span>
                                              <span style="display:inline-block;font-weight:600;">' . $products['products_price'] . '</span>
                                            </div>
                                          </div>
                                        </div>';
    }

    if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
        require_once(DIR_FS_EXT . 'email_content/functions.php');
        $data = [
            'customers_name' => $customer_info['name'] . ' ' . $customer_info['lastname'],
            'customers_email' => $customer_info['email'],
            'customers_phone' => '',
            'date_purchased' => '',
            'days' => '',
            'products_block' => $products_block,
            'comments' => '',
        ];
        $content_email_array = getRecoverCartSales($languages_id, $data, $email_template);
        $email_text = $content_email_array['content_html'];
        $subject = $content_email_array['subject'];
        if (
            tep_mail(
                $customer_info['name'] . ' ' . $customer_info['lastname'],
                $customer_info['email'],
                $subject,
                $email_text,
                STORE_OWNER,
                STORE_OWNER_EMAIL_ADDRESS
            )
        ) {
            echo 'Send email to ' . $customer_info['email'] . '<br>';
        }
    }
}

////////////////////////////////////////////////

require(DIR_WS_CLASSES . 'rcs_currencies.php');
$currencies = new rcs_currencies();

//debug(date('YmdHis', strtotime('-10 days')));

$customer_basket_query = tep_db_query("SELECT cb.customers_id, cb.products_id, cb.customers_basket_quantity, cb.customers_basket_date_added, c.customers_firstname, c.customers_lastname, c.customers_email_address 
                                       FROM customers_basket cb
                                       LEFT JOIN scart s ON s.customers_id = cb.customers_id
                                       LEFT JOIN customers c ON c.customers_id = cb.customers_id
                                       WHERE cb.customers_basket_date_added >= '" . date(
    'YmdHis',
    strtotime('-10 days')
) . "' ORDER BY cb.customers_basket_id");

$customers_baskets_array = [];
while ($row = tep_db_fetch_array($customer_basket_query)) {
    // in seconds
    $customers_baskets_array[$row['customers_id']]['time_passed'] = strtotime(gmdate('Y-m-d H:i:s')) - strtotime(get_date_time($row['customers_basket_date_added']));
    $customers_baskets_array[$row['customers_id']]['customers_info'] = [
        'name' => $row['customers_firstname'],
        'lastname' => $row['customers_lastname'],
        'email' => $row['customers_email_address']
    ];
    $customers_baskets_array[$row['customers_id']]['products'][] = get_products_information(
        $row['products_id'],
        $row['customers_basket_quantity']
    );
}
//debug($customers_baskets_array);

foreach ($customers_baskets_array as $customers_id => $customer_basket) {
//    debug( $customer_basket['customers_info']['name']);
    if ($customer_basket['time_passed'] >= ONE_HOUR) {
        $scart_query = tep_db_query("SELECT count_of_mailed FROM scart WHERE customers_id = '" . (int)$customers_id . "'");

        if (tep_db_num_rows($scart_query) == 0) {
            tep_db_query("INSERT INTO scart (customers_id, dateadded, datemodified, count_of_mailed)
                         VALUES ('" . $customers_id . "', '" . date('Ymd') . "', '" . date('Ymd') . "', '1')");

            send_customer_mail($customer_basket['products'], $customer_basket['customers_info'], 1);
        } else {
            $scart_row = tep_db_fetch_array($scart_query);
            $count_of_mailed = (int)$scart_row['count_of_mailed'];

            if ($count_of_mailed <= 2) {
                if ($customer_basket['time_passed'] >= ONE_HOUR && $customer_basket['time_passed'] < ONE_DAY && $count_of_mailed == 0) {
                    // do 1h+
                    $email_template_id = 1;
                } else {
                    if ($customer_basket['time_passed'] >= ONE_DAY && $customer_basket['time_passed'] < FIVE_DAYS && $count_of_mailed == 1) {
                        // do 1d+
                        $email_template_id = 2;
                    } else {
                        if ($customer_basket['time_passed'] >= FIVE_DAYS && $count_of_mailed == 2) {
                            $email_template_id = 3;
                        } else {
                            $email_template_id = -1;
                        }
                    }
                }

                if ($email_template_id > 0) {
                    send_customer_mail($customer_basket['products'], $customer_basket['customers_info'], $email_template_id);
                    $count_of_mailed++;
                    tep_db_query("UPDATE scart SET datemodified = '" . date('Ymd') . "', count_of_mailed = '" . $count_of_mailed . "' WHERE customers_id = '" . (int)$customers_id . "'");
                }
            }
        }
    }
}

$cont = ob_get_contents();
ob_end_clean();

echo nl2br($cont);

mail("s.fedorenko.pd@gmail.com", "Recover cart cron job", $cont);
