<?php
/*
$Id: edit_orders.php, v2.1 2006/03/21 10:42:44 ams Exp $
osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com
Copyright (c) 2006 osCommerce
Released under the GNU General Public License
Original file written by Jonathan Hilgeman of SiteCreative.com
*/

// First things first: get the required includes, classes, etc.
require('includes/application_top.php');

//b2b
global $customer_id;
$customer_id = intval($_GET['customer_id']);
if (!$customer_id) {
    $customer_id = intval($_POST['customer_id']);
}
//b2b

require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();

include(DIR_WS_CLASSES . 'order.php');

// Next up: define the functions unique to this file
// Function    : tep_get_country_id
// Arguments   : country_name country name string
// Return      : country_id
// Description : Function to retrieve the country_id based on the country's name
function tep_get_country_id($country_name)
{
    $country_id_query = tep_db_query("select * from " . TABLE_COUNTRIES . " where countries_name = '" . $country_name . "'");
    if (!tep_db_num_rows($country_id_query)) {
        return 0;
    } else {
        $country_id_row = tep_db_fetch_array($country_id_query);
        return $country_id_row['countries_id'];
    }
}

// Function    : tep_get_zone_id
// Arguments   : country_id country id string    zone_name state/province name
// Return      : zone_id
// Description : Function to retrieve the zone_id based on the zone's name
function tep_get_zone_id($country_id, $zone_name)
{
    $zone_id_query = tep_db_query("select * from " . TABLE_ZONES . " where zone_country_id = '" . $country_id . "' and zone_name = '" . $zone_name . "'");
    if (!tep_db_num_rows($zone_id_query)) {
        return 0;
    } else {
        $zone_id_row = tep_db_fetch_array($zone_id_query);
        return $zone_id_row['zone_id'];
    }
}

function totals_trim($totals_title)
{
    $pattern = " \t\n\r\0\x0B:";
    return trim($totals_title, $pattern);
}

// Function    : tep_html_quotes
// Arguments   : string any string
// Return      : string with single quotes converted to html equivalent
// Description : Function to change quotes to HTML equivalents for form inputs.
function tep_html_quotes($string)
{
    return str_replace("'", "&#39;", $string);
}

// Function instead for mysql_result. It return data of field in query
function tep_db_result_by_fieldname($db_query, $row_number = 0, $field_name = 0)
{
    tep_db_data_seek($db_query, $row_number);
    $data = tep_db_fetch_array($db_query);
    return $data[$field_name];
}

//format edit order numbers
function numberFormatEditOrderPrice($value)
{
    global $currencies, $order;
    $percent = '';
    if (strpos($value, '%') !== false) {
        $value = str_replace('%', '', $value);
        $percent = '%';
    }
    $value = number_format(
        $value * $currencies->currencies[$order->info['currency']]['value'],
        !empty($currencies->currencies[$order->info['currency']]['decimal_places']) ? $currencies->currencies[$order->info['currency']]['decimal_places'] : 0,
        $currencies->currencies[$order->info['currency']]['decimal_point'],
        $currencies->currencies[$order->info['currency']]['thousands_point']
    );
    return $value . $percent;
}

//file functions:
//on update_order:

function updateOrderInfo($oID)
{
    global $ordersShippingMethods;

    $UpdateOrders = "UPDATE " . TABLE_ORDERS . " set 
                                customers_name = '" . tep_db_input(stripslashes($_POST['update_customer_name'])) . "',
                                customers_company = '" . tep_db_input(stripslashes($_POST['update_customer_company'])) . "',
                                customers_street_address = '" . tep_db_input(stripslashes($_POST['update_customer_street_address'])) . "',
                                customers_suburb = '" . tep_db_input(stripslashes($_POST['update_customer_suburb'])) . "',
                                customers_city = '" . tep_db_input(stripslashes($_POST['update_customer_city'])) . "',
                                customers_state = '" . tep_db_input(stripslashes($_POST['update_customer_state'])) . "',
                                customers_postcode = '" . tep_db_input($_POST['update_customer_postcode']) . "',
                                customers_country = '" . tep_db_input(stripslashes($_POST['update_customer_country'])) . "',
                                customers_telephone = '" . tep_db_input($_POST['update_customer_telephone']) . "',
                                customers_fax = '" . tep_db_input($_POST['update_customer_fax']) . "',
                                customers_email_address = '" . tep_db_input($_POST['update_customer_email_address']) . "',";

    if (in_array($_POST['add_totals']['new_total_shipping']['title'], array_column($ordersShippingMethods, 'id')) !== false) {
        $UpdateOrders .= "shipping_method_code = '" . tep_db_input($_POST['add_totals']['new_total_shipping']['title']) . "',";
    }

    if ($_POST["add_totals"]["new_total_shipping"]["title"] === 'nwposhtanew' && !empty($_POST['update_nwposhta_address'])) {
        $UpdateOrders .= "nwposhta_address = '" . tep_db_input($_POST['update_nwposhta_address']) . "',";
    }

    $UpdateOrders .= "billing_name = '" . tep_db_input(stripslashes($_POST['update_billing_name'])) . "',
                                    billing_company = '" . tep_db_input(stripslashes($_POST['update_billing_company'])) . "',
                                    billing_street_address = '" . tep_db_input(stripslashes($_POST['update_billing_street_address'])) . "',
                                    billing_suburb = '" . tep_db_input(stripslashes($_POST['update_billing_suburb'])) . "',
                                    billing_city = '" . tep_db_input(stripslashes($_POST['update_billing_city'])) . "',
                                    billing_state = '" . tep_db_input(stripslashes($_POST['update_billing_state'])) . "',
                                    billing_postcode = '" . tep_db_input($_POST['update_billing_postcode']) . "',
                                    billing_country = '" . tep_db_input(stripslashes($_POST['update_billing_country'])) . "',
                                    delivery_name = '" . tep_db_input(stripslashes($_POST['update_delivery_name'])) . "',
                                    delivery_company = '" . tep_db_input(stripslashes($_POST['update_delivery_company'])) . "',
                                    delivery_street_address = '" . tep_db_input(stripslashes($_POST['update_delivery_street_address'])) . "',
                                    delivery_suburb = '" . tep_db_input(stripslashes($_POST['update_delivery_suburb'])) . "',
                                    delivery_city = '" . tep_db_input(stripslashes($_POST['update_delivery_city'])) . "',
                                    delivery_state = '" . tep_db_input(stripslashes($_POST['update_delivery_state'])) . "',
                                    delivery_postcode = '" . tep_db_input($_POST['update_delivery_postcode']) . "',
                                    delivery_country = '" . tep_db_input(stripslashes($_POST['update_delivery_country'])) . "',
                                    payment_method = '" . tep_db_input($_POST['update_info_payment_method']) . "',
                                    cc_type = '" . tep_db_input($_POST['update_info_cc_type']) . "',
                                    cc_owner = '" . tep_db_input($_POST['update_info_cc_owner']) . "',
                                    cc_number = '" . tep_db_input($_POST['update_info_cc_number']) . "',
                                    cc_expires = '" . tep_db_input($_POST['update_info_cc_expires']) . "',
                                    orders_status = '" . tep_db_input($_POST['status']) . "'
                                 where orders_id = '" . tep_db_input($oID) . "';";

    return tep_db_query($UpdateOrders) ? true : false;
}

function checkAndSendEmailToCustomer($oID, $status)
{
    global $languages_id, $orders_status_array;

    $check_status = tep_db_fetch_array(tep_db_query("select customers_name, customers_email_address, orders_status, date_purchased from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'"));
    if (($check_status['orders_status'] != $status) || tep_not_null($_POST['comments'])) {
        // Notify Customer
        $customer_notified = '0';
        if (isset($_POST['notify']) && $_POST['notify'] == 'on') {
            $notify_comments = '';
            if (isset($_POST['notify_comments']) && ($_POST['notify_comments'] == 'on')) {
                $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, $_POST['comments']) . "\n\n";
            }
            $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID . "\n" . EMAIL_TEXT_INVOICE_URL . ' ' . tep_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO,
                    'order_id=' . $oID,
                    'SSL') . "\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . tep_date_long_translate(tep_date_long($check_status['date_purchased'])) . "\n\n" . sprintf(EMAIL_TEXT_STATUS_UPDATE,
                    $orders_status_array[$status]) . $notify_comments . sprintf(EMAIL_TEXT_STATUS_UPDATE2);
            $subject = EMAIL_TEXT_SUBJECT;
            if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                require_once(DIR_FS_EXT . 'email_content/functions.php');
                $orderInfo = [
                    'orders_id' => $oID,
                    'customers_name' => $check_status['customers_name'],
                    'date_purchased' => $check_status['date_purchased'],
                    'comments' => $_POST['comments'],
                ];
                $content_email_array = getChangeOrderStatusText($languages_id, $orderInfo, $orders_status_array[$status]);
                $email = $content_email_array['content_html'] ?: $email;
                $subject = $content_email_array['subject'] ?: $subject;
            }

            tep_mail($check_status['customers_name'], $check_status['customers_email_address'], $subject . ' #' . $oID, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            $customer_notified = '1';
        }

        tep_db_query("insert into " . TABLE_ORDERS_STATUS_HISTORY . " 
				(orders_id, orders_status_id, date_added, customer_notified, comments) 
				values ('" . tep_db_input($_GET['oID']) . "', '" . tep_db_input($_POST['status']) . "', now(), " . tep_db_input($customer_notified) . ", '" . tep_db_input($_POST['comments']) . "')");
    }
}

function updateProductsQuantities($productId, $quantityDifference)
{
    if (STOCK_CHECK == 'true') {
        tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET 
                                        products_quantity = products_quantity + " . $quantityDifference . ",
                                        products_ordered = products_ordered - " . $quantityDifference . " 
                                        WHERE products_id = '" . $productId . "'");
    } else {
        tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET
                                        products_ordered = products_ordered - " . $quantityDifference . "
                                        WHERE products_id = '" . $productId . "'");
    }
}

function deleteOrderProductsInfo($oID, $ordersProductsId, $productsDetails)
{
    //get product`s info
    $orderInfo = tep_db_fetch_array(tep_db_query("SELECT products_id, products_quantity 
                                              FROM " . TABLE_ORDERS_PRODUCTS . " 
                                              WHERE orders_id = '" . (int)$oID . "' AND orders_products_id = '" . $ordersProductsId . "'"));

    //recalculate quantity_difference
    $quantityDifference = $productsDetails['qty'];

    //update products_quantity and products_ordered
    updateProductsQuantities((int)$orderInfo['products_id'], $quantityDifference);

    //delete product from order
    tep_db_query("DELETE FROM " . TABLE_ORDERS_PRODUCTS . " 
                                WHERE orders_id = '" . (int)$oID . "' 
                                AND orders_products_id = '" . $ordersProductsId . "'");

    //delete product attributes from order
    if (isset($productsDetails['attributes'])) {
        tep_db_query("DELETE from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " 
                                    WHERE orders_id = '" . (int)$oID . "' 
                                    AND orders_products_id = '" . $ordersProductsId . "'");
    }
}

function updateOrderProductsInfo($oID, $ordersProductsId, $productsDetails, $orderModulesDetails)
{
    global $order, $currencies;

    //get product`s info
    $orderInfo = tep_db_fetch_array(tep_db_query("SELECT products_id, products_quantity 
                                              FROM " . TABLE_ORDERS_PRODUCTS . " 
                                              WHERE orders_id = '" . (int)$oID . "' AND orders_products_id = '" . $ordersProductsId . "'"));

    //if product`s quantity should be changed
    if ($productsDetails['qty'] != $orderInfo['products_quantity']) {
        //recalculate quantity_difference
        $quantityDifference = $orderInfo['products_quantity'] - $productsDetails['qty'];

        //update products_quantity and products_ordered
        updateProductsQuantities((int)$orderInfo['products_id'], $quantityDifference);
    }

    //calculate product price and final product price
    $productsDetails['products_price'] = $currencies->parse($productsDetails['products_price'], $order->info['currency']);

    //calculate $productsPrice and $finalPrice
    $finalPrice = $productsPrice = $productsDetails['products_price'] / $currencies->currencies[$order->info['currency']]['value'];

    //update order`s product info
    tep_db_query("UPDATE " . TABLE_ORDERS_PRODUCTS . " set
					            products_model = '" . $productsDetails['model'] . "',
					            products_name = '" . tep_html_quotes($productsDetails['name']) . "',
					            products_price = '" . $productsPrice . "',
                                final_price = '" . $finalPrice . "',
					            products_tax = '" . $productsDetails['tax'] . "',
					            products_quantity = '" . $productsDetails['qty'] . "'
					            where orders_products_id = '" . $ordersProductsId . "'");

    //calculate subtotal and tax during update function
    $orderModulesDetails['subtotal'] += $productsDetails['qty'] * $finalPrice;
    $orderModulesDetails['tax'] += (($productsDetails['tax'] / 100) * ($productsDetails['qty'] * $finalPrice));

    //update all product attributes
    if (isset($productsDetails['attributes'])) {
        foreach ($productsDetails['attributes'] as $ordersProductsAttributesId => $attributesDetails) {
            tep_db_query("UPDATE " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " set
                                        products_options = '" . $attributesDetails['option'] . "',
                                        products_options_values = '" . $attributesDetails['value'] . "',
                                        options_values_price ='" . $attributesDetails['price'] . "',
                                        price_prefix ='" . $attributesDetails['prefix'] . "'
                                        where orders_products_attributes_id = '" . $ordersProductsAttributesId . "'");
        }
    }

    return $orderModulesDetails;
}

function checkAndInsertNewOrderModulesInfo($oID, $orderModulesDetails)
{
    global $currencies, $order, $allOrderModulesInfo;

    $updateOrderModuleClasses = (is_array($_POST['update_totals'])) ? array_column($_POST['update_totals'], 'class') : [];
    $isTaxModuleExist = in_array('ot_tax', $updateOrderModuleClasses);

    //get order_total module class (like ot_tax)
    $class = $_POST['add_totals']['new_total']['title'];

    $isNewOrderModule = tep_not_null($_POST['add_totals']['new_total']['value']);
    if ($isNewOrderModule) {
        $isNeedInsert = true;
        //get order_total module info
        $orderModuleClasses = array_column($allOrderModulesInfo, 'id');
        $orderModuleInfo = $allOrderModulesInfo[array_search($class, $orderModuleClasses)];

        //recalculate value for ot_lev_discount
        if ($class == 'ot_lev_discount') {
            $_POST['add_totals']['new_total']['value'] = $_POST['add_totals']['new_total']['value'] / $order->info['currency_value'];
        }

        if ($class == 'ot_tax') {
            $orderModuleInfo['text'] = ENTRY_TAX;
            $orderModuleInfo['order'] = -999;
            //do not insert if tax already exist
            $isNeedInsert = !$isTaxModuleExist;
        }

        //insert order_total modules
        if ($isNeedInsert) {
            tep_db_query("INSERT INTO " . TABLE_ORDERS_TOTAL . " set
							orders_id = '" . $oID . "',
							title ='" . addslashes($orderModuleInfo['text']) . "',
							text = '" . $currencies->format($_POST['add_totals']['new_total']['value'], true, $order->info['currency'], $order->info['currency_value']) . "',
				            value = '" . $_POST['add_totals']['new_total']['value'] . "',
							class = '" . $class . "',
							sort_order = '" . $orderModuleInfo['order'] . "'");
        }
    }

    //if not exist tax and (not insert new tax or not insert at all) and not empty calculated tax from products
    if (!$isTaxModuleExist && ($class != 'ot_tax' || !$isNewOrderModule) && !empty($orderModulesDetails['tax'])) {
        //insert tax in $_POST['update_totals']
        $newTaxInfo = [
            'title' => ENTRY_TAX,
            'value' => 0,
            'class' => 'ot_tax',
            'total_id' => ''
        ];
        //get ot_total key to insert ot_tax before it (that is need to update tax)
        $key = array_search('ot_total', $updateOrderModuleClasses);
        //if ot_total exist in $_POST['update_totals']
        if (!empty($key)) {
            //set ot_total as last
            $_POST['update_totals'][] = $_POST['update_totals'][$key];
            //set ot_tax instead ot_total by key
            $_POST['update_totals'][$key] = $newTaxInfo;
        } else {
            //set ot_tax as last
            $_POST['update_totals'][] = $newTaxInfo;
        }
    }
}

function updateOrderShipping($oID)
{
    global $order, $currencies, $ordersShippingMethods;

    if (tep_not_null($_POST['add_totals']['new_total_shipping']['title'])) {
        //collect order shipping module info
        $class = $_POST['add_totals']['new_total_shipping']['title'];
        $shippingMethodKey = array_search($class, array_column($ordersShippingMethods, 'id'));
        if ($shippingMethodKey !== false) {
            $orderShippingModuleInfo = $ordersShippingMethods[$shippingMethodKey];
        } else {
            $orderShippingModuleInfo = [
                'text' => $_POST['_shipping_name'],
                'order' => 999
            ];
        }

        //delete old shipping info
        tep_db_query("DELETE FROM " . TABLE_ORDERS_TOTAL . " WHERE orders_id = " . (int)$oID . " AND class = 'ot_shipping'");

        //calculate new shipping price (is this necessary?)
        $_shippingPrice = $currencies->parse($_POST['add_totals']['new_total_shipping']['value'], $order->info['currency']);
        $_shippingPrice = round($_shippingPrice / $order->info['currency_value'], 4);

        //insert new shipping info
        tep_db_query("INSERT INTO " . TABLE_ORDERS_TOTAL . " set
							  orders_id = '" . $oID . "',
							  title ='" . addDoubleDot(addslashes($orderShippingModuleInfo['text'])) . " " . "',
				              text = '" . $currencies->format($_shippingPrice, false, $order->info['currency'], $order->info['currency_value']) . "',
							  value = '" . $_shippingPrice . "',
							  class = 'ot_shipping',
							  sort_order = '" . $orderShippingModuleInfo['order'] . "'");
    }
}

function calculateNewTaxValue($orderModulesDetails)
{
    $ot_tax = 0;

    //get classes of order modules in update array
    $updateOrderModuleClasses = (is_array($_POST['update_totals'])) ? array_column($_POST['update_totals'], 'class') : [];

    //get exist tax value
    $isTaxModuleExist = in_array('ot_tax', $updateOrderModuleClasses);
    if ($isTaxModuleExist) {
        $ot_tax = $_POST['update_totals'][array_search('ot_tax', $updateOrderModuleClasses)]['value'] ?: $ot_tax;
    }
    //use new tax value to update field
    if (tep_not_null($_POST['add_totals']['new_total']['value']) && $_POST['add_totals']['new_total']['title'] == 'ot_tax') {
        $ot_tax = $_POST['add_totals']['new_total']['value'];
        if (strpos($ot_tax, '%') !== false) {
            $taxPercent = str_replace('%', '', $ot_tax);
            $ot_tax = $orderModulesDetails['subtotal'] * $taxPercent / 100;
        }
    }

    //check that tax value is bigger than sum of taxes from each product in order
    $ot_tax = $ot_tax > $orderModulesDetails['tax'] ? $ot_tax : $orderModulesDetails['tax'];
    //check that tax bigger than 0
    $ot_tax = $ot_tax > 0 ? $ot_tax : 0;

    return $ot_tax;
}

function finalOperationsWithOrderModules($oID, $orderModulesDetails)
{
    global $order, $currencies, $allOrderModulesInfo;

    if (is_array($_POST['update_totals'])) {
        //check that subtotal exist
        if (!in_array('ot_subtotal', array_column($_POST['update_totals'], 'class'))) {
            $_POST['update_totals'] = array_reverse($_POST['update_totals']);
            $_POST['update_totals'][] = [
                'title' => getConstantValue('ENTRY_SUB_TOTAL'),
                'value' => 0,
                'class' => 'ot_subtotal',
                'total_id' => 0,
            ];
            $_POST['update_totals'] = array_reverse($_POST['update_totals']);
        }
        //check that total exist
        if (!in_array('ot_total', array_column($_POST['update_totals'], 'class'))) {
            $_POST['update_totals'][] = [
                    'title' => getConstantValue('TABLE_HEADING_ORDER_TOTAL'),
                    'value' => 0,
                    'class' => 'ot_total',
                    'total_id' => 0,
            ];
        }

        $orderModulesDetails['total'] = 0;
        $allOrderModulesClasses = array_column($allOrderModulesInfo, 'id');
        foreach ($_POST['update_totals'] as $orderModuleGroupCode => $newOrderModuleInfo) {
            //collect variables
            $ot_title = trim($newOrderModuleInfo['title']);
            $ot_value = trim($newOrderModuleInfo['value']);
            $ot_class = $newOrderModuleInfo['class'];
            $ot_total_id = $newOrderModuleInfo['total_id'];

            //final calculate and update of order modules
            //ot_tax can have empty value but it will be recalculate
            if ((!empty($ot_title) && !empty($ot_value)) || in_array($ot_class, ['ot_tax', 'ot_subtotal', 'ot_total'])) {
                //get sort order
                $sort_order = (int)$allOrderModulesInfo[array_search($ot_class, $allOrderModulesClasses)]['order'] ?: 0;

                switch ($ot_class) {
                    case 'ot_subtotal':
                        //always first
                        $sort_order = -1000;
                        //order subtotal module price must be recalculated every time
                        $valueToUpdateText = $valueToUpdate = $ot_value = $orderModulesDetails['subtotal'];
                        break;
                    case 'ot_tax':
                        //always second
                        $sort_order = -999;
                        //order tax module price was recalculated
                        $valueToUpdateText = $valueToUpdate = $ot_value = calculateNewTaxValue($orderModulesDetails);
                        break;
                    case 'ot_total':
                        //always last
                        $sort_order = 1000;
                        //new order module value
                        $newOrderModule = $_POST['add_totals']['new_total'];
                        $newOrderModulePrice = (isset($newOrderModule['value']) && $newOrderModule['title'] != 'ot_tax') ? $newOrderModule['value'] : 0;
                        //new order shipping module value
                        $newOrderShippingModule = $_POST['add_totals']['new_total_shipping'];
                        $newOrderShippingModulePrice = (isset($newOrderShippingModule['value'])) ? $currencies->parse($newOrderShippingModule['value'], $order->info['currency']) : 0;

                        $valueToUpdate = $ot_value = (float)$orderModulesDetails['total'] + (float)$newOrderModulePrice + (float)$newOrderShippingModulePrice;
                        $valueToUpdateText = $valueToUpdate = max($valueToUpdate, 0);
                        break;
                    default:
                        $valueToUpdateText = $valueToUpdate = $ot_value;
                        //order_total module price must be recalculated every time
                        if (strpos($ot_value, '%') !== false) {
                            $valueToUpdate = $ot_value;
                            $percent = str_replace('%', '', $ot_value);
                            $ot_value = $orderModulesDetails['subtotal'] * $percent / 100;
                            $valueToUpdateText = $ot_value;
                        }
                }

                //calculate price by currency value
                if ($ot_class != "ot_total") {
                    $ot_value = $ot_value / $order->info['currency_value'];
                    //calculate order total
                    $orderModulesDetails['total'] += $ot_value;
                }

                //add result to DB
                if (!empty($ot_total_id)) {
                    tep_db_query("UPDATE " . TABLE_ORDERS_TOTAL . " set
                                                title = '" . addslashes($ot_title) . "',
                                                text = '" . $currencies->format($valueToUpdateText, true, $order->info['currency'], $order->info['currency_value']) . "',
                                                value = '" . $valueToUpdate . "',
                                                sort_order = '" . $sort_order . "'
                                                WHERE orders_total_id = '" . $ot_total_id . "'");
                } else {
                    tep_db_query("INSERT INTO " . TABLE_ORDERS_TOTAL . " SET
                                                orders_id = '" . $oID . "',
                                                title = '" . addslashes($ot_title) . "',
                                                text = '" . $currencies->format($valueToUpdateText, true, $order->info['currency'], $order->info['currency_value']) . "',
                                                value = '" . $valueToUpdate . "',
                                                class = '" . $ot_class . "',
                                                sort_order = '" . $sort_order . "'");
                }
            }

            //delete order module if empty (value or title) and not empty id
            //except ot_total, ot_subtotal and ot_shipping (these modules count always = 1, can`t be inserted or deleted)
            //except new order module`s fields (modules in groups new_total or new_total_shipping)
            if (
                (empty($ot_title) || empty($ot_value)) && !empty($ot_total_id) &&
                !in_array($ot_class, ['ot_shipping', 'ot_subtotal', 'ot_total']) &&
                $orderModuleGroupCode != "new_total" && $orderModuleGroupCode != "new_total_shipping"
            ) {
                tep_db_query("DELETE from " . TABLE_ORDERS_TOTAL . " 
                                    WHERE orders_id = '" . (int)$oID . "' 
                                    AND orders_total_id = '" . $ot_total_id . "'");
            }
        }
    }
}

function recalculateCustomerSumOfAllPurchases($oID, $status)
{
    global $currencies, $languages_id;
    $check_group_query = tep_db_query("select customers_groups_id from customers_groups_orders_status where orders_status_id = " . $status);
    $customer_query = tep_db_query("select c.* from customers as c, orders as o where o.customers_id = c.customers_id and o.orders_id = " . (int)$oID);
    $customer = tep_db_fetch_array($customer_query);
    if (tep_db_num_rows($check_group_query) && !empty($customer)) {
        $changed = false;
        $customer_id = $customer['customers_id'];
        while ($groups = tep_db_fetch_array($check_group_query)) {
            // calculating total customers purchase
            // building query
            $statuses_groups_query = tep_db_query("select orders_status_id from customers_groups_orders_status where customers_groups_id = " . $groups['customers_groups_id']);
            $purchase_query = "select sum(ot.value) as total from orders_total as ot, orders as o where ot.orders_id = o.orders_id and o.customers_id = " . $customer_id . " and ot.class = 'ot_total' and (";
            $statuses = tep_db_fetch_array($statuses_groups_query);
            $purchase_query .= " o.orders_status = " . $statuses['orders_status_id'];
            while ($statuses = tep_db_fetch_array($statuses_groups_query)) {
                $purchase_query .= " or o.orders_status = " . $statuses['orders_status_id'];
            }

            $purchase_query .= ");";

            $total_purchase_query = tep_db_query($purchase_query);
            $total_purchase = tep_db_fetch_array($total_purchase_query);
            $customers_total = $total_purchase['total'];

            // looking for current accumulated limit & discount
            $acc_query = tep_db_query("select c.customers_firstname, cg.customers_groups_accumulated_limit, cg.customers_groups_name, cg.customers_groups_discount from customers_groups as cg, customers as c where cg.customers_groups_id = c.customers_groups_id and c.customers_id = " . $customer_id);

            $current_limit = tep_db_result_by_fieldname($acc_query, 0, "customers_groups_accumulated_limit");
            $current_discount = tep_db_result_by_fieldname($acc_query, 0, "customers_groups_discount");
            $current_group = tep_db_result_by_fieldname($acc_query, 0, "customers_groups_name");


            // ok, looking for available group
            $groups_query = tep_db_query("select customers_groups_discount, customers_groups_id, customers_groups_name, customers_groups_accumulated_limit from customers_groups 
                                                    where customers_groups_accumulated_limit < '" . ($customers_total ?: 0) . "' 
                                                    and customers_groups_discount < '" . ($current_discount ?: 0) . "' 
                                                    and customers_groups_accumulated_limit > '" . ($current_limit ?: 0) . "' 
                                                    and customers_groups_id = '" . ($groups['customers_groups_id'] ?: 0) . "'
                                                    order by customers_groups_accumulated_limit DESC");

            if (tep_db_num_rows($groups_query)) {
                // new group found
                $customers_groups_id = @tep_db_result_by_fieldname($groups_query, 0, "customers_groups_id");
                $customers_groups_name = @tep_db_result_by_fieldname($groups_query, 0, "customers_groups_name");
                $limit = @tep_db_result_by_fieldname($groups_query, 0, "customers_groups_accumulated_limit");
                $current_discount = @tep_db_result_by_fieldname($groups_query, 0, "customers_groups_discount");

                // updating customers group
                tep_db_query("update customers set customers_groups_id = " . $customers_groups_id . " where customers_id = " . $customer_id);
                $changed = true;
            }
        }
        $groups_query = tep_db_query("select cg.* from customers_groups as cg, customers as c where c.customers_groups_id = cg.customers_groups_id and c.customers_id = " . $customer_id);
        $customers_groups_id = @tep_db_result_by_fieldname($groups_query, 0, "customers_groups_id");
        $customers_groups_name = @tep_db_result_by_fieldname($groups_query, 0, "customers_groups_name");
        $limit = @tep_db_result_by_fieldname($groups_query, 0, "customers_groups_accumulated_limit");
        $current_discount = @tep_db_result_by_fieldname($groups_query, 0, "customers_groups_discount");
        if ($changed) {
            // send emails
            $text = EMAIL_TEXT_LIMIT . $currencies->display_price($limit) . "\n" . EMAIL_TEXT_CURRENT_GROUP . $customers_groups_name . "\n" . EMAIL_TEXT_DISCOUNT . $current_discount . "%";

            // to store owner
            $email_text = EMAIL_ACC_DISCOUNT_INTRO_OWNER . "<br/>" . EMAIL_TEXT_CUSTOMER_NAME . ' ' . $customer['customers_firstname'] . ' ' . $customer['customers_lastname'] . "<br/>" . EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS . ' ' . $customer['customers_email_address'] . "<br/>" . EMAIL_TEXT_CUSTOMER_TELEPHONE . ' ' . $customer['customers_telephone'] . "<br/><br/>" . $text;
            tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_ACC_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

            // to customer
            $email_text = EMAIL_ACC_INTRO_CUSTOMER . "\n\n" . $text . "\n\n" . EMAIL_ACC_FOOTER;
            $subject = EMAIL_ACC_SUBJECT;
            if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                require_once(DIR_FS_EXT . 'email_content/functions.php');
                $data = [
                    'orders_id' => $oID,
                    'customers_name' => $customer['customers_firstname'],
                    'limit' => $currencies->display_price($limit),
                    'customers_groups_name' => $customers_groups_name,
                    'current_discount' => $current_discount,
                ];
                $content_email_array = getChangeGroupText($languages_id, $data);
                $email_text = $content_email_array['content_html'] ?: $email_text;
                $subject = $content_email_array['subject'] ?: $subject;
            }

            tep_mail($customer['customers_firstname'] . ' ' . $customer['customers_lastname'], $customer['customers_email_address'], $subject, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        }
    }
}

//get order statuses data
$orders_statuses = array();
$orders_status_array = array();
$orders_status_query = tep_db_query("select orders_status_id, orders_status_name, orders_status_text from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "'");
while ($orders_status = tep_db_fetch_array($orders_status_query)) {
    $orders_statuses[$orders_status['orders_status_id']] = array(
        'id' => $orders_status['orders_status_id'],
        'orders_status_text' => $orders_status['orders_status_text'],
        'text' => $orders_status['orders_status_name']
    );
    $orders_status_array[$orders_status['orders_status_id']] = $orders_status['orders_status_name'];
}

//get payment modules data
$orders_payment_methods = array();
$orders_payment_methods_query = tep_db_query("select distinct payment_method from " . TABLE_ORDERS);
while ($orders_payment_method = tep_db_fetch_array($orders_payment_methods_query)) {
    $orders_payment_methods[] = array(
        'id' => $orders_payment_method['payment_method'],
        'text' => strip_tags($orders_payment_method['payment_method'])
    );
}

//create the shopping cart & fix the cart if necessary
if (tep_not_null($cart)) {
    fixObject($cart);
}
if (!tep_session_is_registered('cart') || !is_object($cart)) {
    tep_session_register('cart');
    $cart = new shoppingCart;
}

//looking for modules in root
chdir('../');
//load all enabled shipping modules
require(DIR_WS_CLASSES . 'shipping.php');
$shipping_modules = new shipping;

//get active shipping modules data
$moduleDirectory = DIR_FS_CATALOG_MODULES_SHIPPING;
$ordersShippingMethods = [];
foreach (getActiveShippingModules() as $activeShippingModule) {
    //init shipping module
    if (is_file($moduleDirectory . $activeShippingModule)) {
        $file = $moduleDirectory . $activeShippingModule;
        include_once($file);
        includeLanguages(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/shipping/' . $activeShippingModule);
    } else {
        $moduleExtDirectory = DIR_FS_EXT . 'shipping/';
        $activeShippingModuleArray = explode('.', $activeShippingModule);
        if (is_array($activeShippingModuleArray)) {
            $moduleExtDirectory = $moduleExtDirectory . array_shift($activeShippingModuleArray) . '/';
            if (is_file($moduleExtDirectory . $activeShippingModule)) {
                $file = $moduleExtDirectory . $activeShippingModule;
                include_once($file);
                includeLanguages($moduleExtDirectory . 'languages/' . $language . '/' . $activeShippingModule);
            }
        }
    }
    if (!isset($file)) {
        continue;
    }

    $class = substr($activeShippingModule, 0, strrpos($activeShippingModule, '.'));
    $module = new $class;

    //get shipping module data
    $ordersShippingMethods[] = [
        'id' => $class,
        'text' => $module->title,
        'order' => 999,
        'full_text' => '',
    ];
}

//get order modules data
require(DIR_WS_CLASSES . 'order_total.php');
$orderModules = new order_total;
$allOrderModulesInfo = array();
foreach ($orderModules->modules as $value) {
    $class = substr($value, 0, strrpos($value, '.'));
    if ($GLOBALS[$class]->enabled && $class != 'ot_total' && $class != 'ot_subtotal') {
        $allOrderModulesInfo[] = array(
            'id' => $class,
            'text' => $GLOBALS[$class]->title,
            'order' => $GLOBALS[$class]->sort_order,
            'full_text' => $GLOBALS[$class]->output['title']
        );
    }
}

//end looking for modules in root
chdir('admin/');

$action = (isset($_GET['action']) ? $_GET['action'] : 'edit');

// Update Inventory Quantity
if (tep_not_null($action)) {
    switch ($action) {
        // 1. update order
        case 'update_order':
            //use outer variables: $allOrderModulesInfo, $ordersShippingMethods

            //collect variables
            $oID = tep_db_prepare_input($_GET['oID']);
            $order = new order($oID);
            $status = tep_db_prepare_input($_POST['status']);

            $orderModulesDetails = [
                'subtotal' => 0,
                'tax' => 0
            ];

            //1.1 update orders table
            $isOrderUpdated = updateOrderInfo($oID);

            //1.2 if necessary send email to customer
            //and insert to status history table
            checkAndSendEmailToCustomer($oID, $status);

            //1.3 update products, orders_products and orders_products_attributes tables
            //and calculate $orderModulesDetails (tax and subtotal)
            if (is_array($_POST['update_products'])) {
                foreach ($_POST['update_products'] as $ordersProductsId => $productsDetails) {
                    if (isset($productsDetails['delete'])) {
                        deleteOrderProductsInfo($oID, $ordersProductsId, $productsDetails);
                    } else {
                        $orderModulesDetails = updateOrderProductsInfo($oID, $ordersProductsId, $productsDetails, $orderModulesDetails);
                    }
                }
            }

            //1.4 Update order modules
            //1.4.1 insert new order total modules info
            checkAndInsertNewOrderModulesInfo($oID, $orderModulesDetails);
            //1.4.2 update order shipping module info
            updateOrderShipping($oID);
            // 1.4.3 final calculate, update and delete of order modules
            finalOperationsWithOrderModules($oID, $orderModulesDetails);

            //1.5.recalculate customer`s sum of all purchases
            recalculateCustomerSumOfAllPurchases($oID, $status);

            //1.6 set success message
            if ($isOrderUpdated) {
                $messageStack->add_session(SUCCESS_ORDER_UPDATED, 'success');
            }

            //reload page without action
            tep_redirect(tep_href_link(FILENAME_ORDERS_EDIT, tep_get_all_get_params(array('action')) . 'action=edit'));
            break;

        // 2. add a product
        case 'add_product':
            if ($_POST['step'] == 5) {
                // 2.1 get order info

                $oID = tep_db_prepare_input($_GET['oID']);
                $order = new order($oID);

                $AddedOptionsPrice = 0;

                // 2.1.1 Get Product Attribute Info
                if (is_array($_POST['add_product_options'])) {
                    foreach ($_POST['add_product_options'] as $option_id => $option_value_id) {
                        $result = tep_db_query("SELECT * FROM " . TABLE_PRODUCTS_ATTRIBUTES . " 
					pa LEFT JOIN " . TABLE_PRODUCTS_OPTIONS . " po 
					ON po.products_options_id=pa.options_id 
					LEFT JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov 
					ON pov.products_options_values_id=pa.options_values_id 
					WHERE products_id=" . $_POST['add_product_products_id'] . " 
					and options_id=" . $option_id . " 
					and options_values_id=" . $option_value_id . " 
					and po.language_id = '" . (int)$languages_id . "' 
					and pov.language_id = '" . (int)$languages_id . "'");

                        $row = tep_db_fetch_array($result);
                        extract($row, EXTR_PREFIX_ALL, "opt");
                        $AddedOptionsPrice += $opt_options_values_price;
                        $option_value_details[$option_id][$option_value_id] = array("options_values_price" => $opt_options_values_price);
                        $option_names[$option_id] = $opt_products_options_name;
                        $option_values_names[$option_value_id] = $opt_products_options_values_name;
                    }
                }

                // 2.1.2 Get Product Info
                $InfoQuery = "select
			              p.products_model,
						  p.products_price,
						  pd.products_name,
						  p.products_tax_class_id 
						  from " . TABLE_PRODUCTS . " 
						  p left 
						  join " . TABLE_PRODUCTS_DESCRIPTION . " 
						  pd on pd.products_id=p.products_id 
						  where p.products_id=" . $_POST['add_product_products_id'] . " 
						  and pd.language_id = '" . (int)$languages_id . "'";
                $result = tep_db_query($InfoQuery);

                $row = tep_db_fetch_array($result);
                extract($row, EXTR_PREFIX_ALL, "p");

                // 2.1.3  Pull specials price from db if there is an active offer
                $special_price = tep_db_query("select specials_new_products_price 
			from " . TABLE_SPECIALS . " 
			where products_id =" . $_POST['add_product_products_id'] . " 
			and status");
                $new_price = tep_db_fetch_array($special_price);

                if ($new_price) {
                    $p_products_price = $new_price['specials_new_products_price'];
                }

                // Following two functions are defined at the top of this file
                $CountryID = tep_get_country_id($order->delivery["country"]);
                $ZoneID = tep_get_zone_id($CountryID, $order->delivery["state"]);
                $ProductsTax = tep_get_tax_rate($p_products_tax_class_id, $CountryID, $ZoneID);

                // Спец. цена
                if ($new_price = tep_get_products_special_price($add_product_products_id)) {
                    $p_products_price = $new_price;
                } else {
                    $p_products_price = b2b_display_price($add_product_products_id, $p_products_price);
                }

                /**
                 * GET SALE MAKERS PRICE FOR PRODUCT
                 * IF IT EXISTS
                 */
                $saleMakersProducts = getSaleMakersProductsSelected();
                if (isset($saleMakersProducts[$_POST['add_product_products_id']])) {
                    $p_products_price = $saleMakersProducts[$_POST['add_product_products_id']];
                }

                // Спец. цена - скидка
                //            if ($new_price =
                //tep_get_products_special_price($add_product_products_id))
                //{$p_products_price = $new_price;}
                //
                //$p_products_price=b2b_display_price($add_product_products_id,$p_products_price);


                // 2.2 UPDATE ORDER ####
                $Query = "INSERT INTO " . TABLE_ORDERS_PRODUCTS . " set
                  orders_id = '" . $oID . "',
                  products_id = '" . $_POST['add_product_products_id'] . "',
                  products_model = '" . $p_products_model . "',
                  products_name = '" . tep_html_quotes($p_products_name) . "',
                  products_price = '" . $p_products_price . "',
                  final_price = '" . ($p_products_price + $AddedOptionsPrice) . "',
                  products_tax = '" . $ProductsTax . "',
                  products_quantity = '" . $_POST['add_product_quantity'] . "'";
                tep_db_query($Query);
                $new_product_id = tep_db_insert_id();

                // 2.2.1 Update inventory Quantity
                //This is only done if store is set up to use stock
                if (STOCK_CHECK == 'true') {
                    tep_db_query("UPDATE " . TABLE_PRODUCTS . " set
                    products_quantity = products_quantity - " . $_POST['add_product_quantity'] . "
                    where products_id = '" . $_POST['add_product_products_id'] . "'");
                }

                //2.2.1.1 Update products_ordered info
                tep_db_query("UPDATE " . TABLE_PRODUCTS . " set
                products_ordered = products_ordered + " . $_POST['add_product_quantity'] . "
                where products_id = '" . $_POST['add_product_products_id'] . "'");

                //2.2.1.2 keep a record of the products attributes
                if (is_array($_POST['add_product_options'])) {
                    foreach ($_POST['add_product_options'] as $option_id => $option_value_id) {
                        $Query = "INSERT INTO " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " set
						orders_id = '" . $oID . "',
						orders_products_id = '" . $new_product_id . "',
						products_options = '" . $option_names[$option_id] . "',
						products_options_values = '" . tep_db_input($option_values_names[$option_value_id]) . "',
						options_values_price = '" . $option_value_details[$option_id][$option_value_id]['options_values_price'] . "',
						price_prefix = '+'";
                        tep_db_query($Query);
                    }
                }

                // 2.2.2 Calculate Tax and Sub-Totals
                $order = new order($oID);
                $RunningSubTotal = 0;
                $RunningTax = 0;

                for ($i = 0; $i < sizeof($order->products); $i++) {
                    // This calculatiion of Subtotal and Tax is part of the 'add a product' process
                    $RunningSubTotal += ($order->products[$i]['qty'] * $order->products[$i]['final_price']);
                    $RunningTax += (($order->products[$i]['tax'] / 100) * ($order->products[$i]['qty'] * $order->products[$i]['final_price']));
                }

                // 2.2.2.1 Tax
                $Query = 'UPDATE ' . TABLE_ORDERS_TOTAL . ' set
				text = "' . $currencies->format($RunningTax, true, $order->info['currency'], $order->info['currency_value']) . '",
				value = "' . $RunningTax . '"
				WHERE class= "ot_tax" AND orders_id= "' . $oID . '"';
                tep_db_query($Query);

                // 2.2.2.2 Sub-Total
                $Query = 'UPDATE ' . TABLE_ORDERS_TOTAL . ' set
				text = "' . $currencies->format($RunningSubTotal, true, $order->info['currency'], $order->info['currency_value']) . '",
				value = "' . $RunningSubTotal . '"
				WHERE class="ot_subtotal" AND orders_id= "' . $oID . '"';
                tep_db_query($Query);

                // 2.2.2.3 Total
                $Query = 'SELECT sum(value)-(SELECT value FROM ' . TABLE_ORDERS_TOTAL . ' WHERE class = "ot_lev_discount" AND orders_id= "' . $oID . '" LIMIT 1 ) AS total_value from ' . TABLE_ORDERS_TOTAL . '
			WHERE class != "ot_total" AND orders_id= "' . $oID . '"';
                $result = tep_db_query($Query);
                $row = tep_db_fetch_array($result);
                $Total = $row['total_value'];

                $Query = 'UPDATE ' . TABLE_ORDERS_TOTAL . ' set
				text = "' . $currencies->format($Total, true, $order->info['currency'], $order->info['currency_value']) . '",
				value = "' . $Total . '"
				WHERE class="ot_total" and orders_id= "' . $oID . '"';
                tep_db_query($Query);

                // 2.3 REDIRECTION #####
                tep_redirect(tep_href_link(FILENAME_ORDERS_EDIT, tep_get_all_get_params(array('action')) . 'action=edit&customer_id=' . $customer_id));
            }

            break;

        //3. delete total
        case 'delete_totals':
            if (isset($_GET['delete']) && $_GET['delete']) {
                $Query="DELETE from " . TABLE_ORDERS_TOTAL . " 
					WHERE orders_id = '" . (int)$_GET['oID'] . "' 
					AND orders_total_id = " . $_GET['id_total'];
                tep_db_query($Query);

                $query = tep_db_query("SELECT SUM(value) as total FROM orders_total WHERE orders_id='" . (int)$_GET['oID'] . "' and class!='ot_total'");
                $total = tep_db_fetch_array($query)['total'];

                $order=new order((int)$_GET['oID']);

                $Query="UPDATE " . TABLE_ORDERS_TOTAL . " SET
				text = '<b>". $currencies->format($total, true, $order->info['currency'], $order->info['currency_value']) . "</b>',
				value = '" . $total . "'
				WHERE class='ot_total' and orders_id= '" . (int)$_GET['oID'] . "'";
                tep_db_query($Query);

                tep_redirect(tep_href_link(FILENAME_ORDERS_EDIT, tep_get_all_get_params(array(
                        'action',
                        'delete',
                        'id_total'
                    )) . 'action=edit'));
            }
            break;
    }
}

if (($action == 'edit') && isset($_GET['oID'])) {
    $oID = tep_db_prepare_input($_GET['oID']);

    $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
    $order_exists = true;
    if (!tep_db_num_rows($orders_query)) {
        $order_exists = false;
        $messageStack->add(sprintf(ERROR_ORDER_DOES_NOT_EXIST, $oID), 'error');
    }
}

$cancelLinkParam = $_GET['from'] == 'modal' ? '&id=' . $oID : '';
?>

<?php

/**
 * header
 */

include_once('html-open.php');
include_once('header.php');

?>

    <script language="javascript" src="includes/general.js?t=<?= filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES . 'general.js') ?>"></script>

    <div class="container edit_orders">
        <div class="edit_orders_block">
            <?php
            if (($action == 'edit') && ($order_exists == true)) {
                $order = new order($oID);
                updateOrderViewsCount($oID)
                ?>
                <?php echo tep_draw_form('edit_order', FILENAME_ORDERS_EDIT, tep_get_all_get_params(array('action')) . 'action=update_order'); ?>
                <div class="edit_orders_header">
                    <?php echo HEADING_TITLE . '&nbsp;(' . HEADING_TITLE_NUMBER . '&nbsp;' . $oID . '&nbsp;' . HEADING_TITLE_DATE . '&nbsp;' . tep_datetime_short($order->info['date_purchased']) . ')'; ?>

                    <div class="actions_btn">
                        <a href="<?= tep_href_link(FILENAME_ORDERS, 'action=edit_orders' . $cancelLinkParam)?>" class="btn btn-sm btn-info"><?php echo IMAGE_BACK; ?></a>
                        <button type="submit" class="btn btn-sm btn-success edit_orders-btn_update"><?php echo IMAGE_UPDATE; ?></button>
                    </div>
                </div>
                <?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?>

                <div class="SubTitle"><?php echo MENUE_TITLE_CUSTOMER; ?></div>
                <div class="top-inputbox">
                    <input type="text" value="" name="search" class="form-control  ui-autocomplete-input" id="searchClient" autofocus="" placeholder="<?php echo ENTRY_SEARCH_CLIENT; ?>"
                           autocomplete="off">
                    <select name="address_book" id="address_book" class="form-control">
                        <option value="" disabled selected><?php echo ENTRY_CUSTOMER_ADDRESS; ?></option>
                    </select>
                </div>
                <?php echo tep_draw_separator('pixel_trans.png', '1', '1'); ?>

                <div class="table-responsive">
                    <table border="0" class="dataTableRow customer_shipping_address" cellpadding="2" cellspacing="0">
                        <tr class="dataTableHeadingRow buyer_data">
                            <td class="dataTableHeadingContent" width="150"></td>
                            <td class="dataTableHeadingContent" data-table="<?php echo ENTRY_CUSTOMER_ADDRESS; ?>" width="150"><?php echo ENTRY_CUSTOMER_ADDRESS; ?></td>
                            <td class="dataTableHeadingContent" data-table="<?php echo ENTRY_SHIPPING_ADDRESS; ?>" width="150"><?php echo ENTRY_SHIPPING_ADDRESS; ?></td>
                            <td class="dataTableHeadingContent" data-table="<?php echo ENTRY_BILLING_ADDRESS; ?>" width="150"><?php echo ENTRY_BILLING_ADDRESS; ?></td>
                        </tr>
                        <?php
                        if (ACCOUNT_COMPANY == 'true') {
                            ?>
                            <tr>
                                <td class="main"><b><?php echo addDoubleDot(ENTRY_CUSTOMER_COMPANY); ?> </b></td>
                                <td data-label="<?php echo ENTRY_BILLING_ADDRESS; ?>">
                                    <input id="customers_firm" name="update_customer_company" class="form-control input-sm" value="<?php echo tep_html_quotes($order->customer['company']); ?>"/>
                                </td>
                                <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                    <input name="update_delivery_company" class="form-control input-sm" value="<?php echo tep_html_quotes($order->delivery['company']); ?>"/>
                                </td>
                                <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                    <input name="update_billing_company" class="form-control input-sm" value="<?php echo tep_html_quotes($order->billing['company']); ?>"/>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td class="main"><b><?php echo addDoubleDot(ENTRY_CUSTOMER_NAME); ?> </b></td>
                            <td data-label="<?php echo ENTRY_BILLING_ADDRESS; ?>">
                                <input id="customers_name" name="update_customer_name" class="form-control input-sm" value="<?php echo tep_html_quotes($order->customer['name']); ?>"/>
                            </td>
                            <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                <input name="update_delivery_name" class="form-control input-sm" value="<?php echo tep_html_quotes($order->delivery['name']); ?>"/>
                            </td>
                            <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                <input name="update_billing_name" class="form-control input-sm" value="<?php echo tep_html_quotes($order->billing['name']); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="main"><b><?php echo addDoubleDot(ENTRY_ADDRESS); ?> </b></td>
                            <td data-label="<?php echo ENTRY_BILLING_ADDRESS; ?>">
                                <input id="entry_street_address" name="update_customer_street_address" class="form-control input-sm"
                                       value="<?php echo tep_html_quotes($order->customer['street_address']); ?>"/>
                            </td>
                            <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                <input name="update_delivery_street_address" class="form-control input-sm" value="<?php echo tep_html_quotes($order->delivery['street_address']); ?>"/>
                            </td>
                            <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                <input name="update_billing_street_address" class="form-control input-sm" value="<?php echo tep_html_quotes($order->billing['street_address']); ?>"/>
                            </td>
                        </tr>
                        <?php
                        if (ACCOUNT_SUBURB == 'true') {
                            ?>
                            <tr>
                                <td class="main"><b><?php echo addDoubleDot(ENTRY_CUSTOMER_SUBURB); ?> </b></td>
                                <td data-label="<?php echo ENTRY_BILLING_ADDRESS; ?>">
                                    <input id="entry_suburb" name="update_customer_suburb" class="form-control input-sm" value="<?php echo tep_html_quotes($order->customer['suburb']); ?>"/>
                                </td>
                                <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                    <input name="update_delivery_suburb" class="form-control input-sm" value="<?php echo tep_html_quotes($order->delivery['suburb']); ?>"/>
                                </td>
                                <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                    <input name="update_billing_suburb" class="form-control input-sm" value="<?php echo tep_html_quotes($order->billing['suburb']); ?>"/>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td class="main"><b><?php echo addDoubleDot(ENTRY_CUSTOMER_CITY); ?> </b></td>
                            <td data-label="<?php echo ENTRY_BILLING_ADDRESS; ?>">
                                <input id="entry_city" name="update_customer_city" class="form-control input-sm" value="<?php echo tep_html_quotes($order->customer['city']); ?>"/>
                            </td>
                            <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                <input name="update_delivery_city" class="form-control input-sm" value="<?php echo tep_html_quotes($order->delivery['city']); ?>"/>
                            </td>
                            <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                <input name="update_billing_city" class="form-control input-sm" value="<?php echo tep_html_quotes($order->billing['city']); ?>"/>
                            </td>
                        </tr>
                        <?php
                        if (ACCOUNT_STATE == 'true') {
                            ?>
                            <tr>
                                <td class="main"><b><?php echo addDoubleDot(ENTRY_CUSTOMER_STATE); ?> </b></td>
                                <td data-label="<?php echo ENTRY_BILLING_ADDRESS; ?>">
                                    <input id="zone_name" name="update_customer_state" class="form-control input-sm" value="<?php echo tep_html_quotes($order->customer['state']); ?>"/>
                                </td>
                                <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                    <input name="update_delivery_state" class="form-control input-sm" value="<?php echo tep_html_quotes($order->delivery['state']); ?>"/>
                                </td>
                                <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                    <input name="update_billing_state" class="form-control input-sm" value="<?php echo tep_html_quotes($order->billing['state']); ?>"/>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td class="main"><b><?php echo addDoubleDot(ENTRY_CUSTOMER_POSTCODE); ?> </b></td>
                            <td data-label="<?php echo ENTRY_BILLING_ADDRESS; ?>">
                                <input id="entry_postcode" name="update_customer_postcode" class="form-control input-sm" value="<?php echo $order->customer['postcode']; ?>"/>
                            </td>
                            <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                <input name="update_delivery_postcode" class="form-control input-sm" value="<?php echo $order->delivery['postcode']; ?>"/>
                            </td>
                            <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                <input name="update_billing_postcode" class="form-control input-sm" value="<?php echo $order->billing['postcode']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="main"><b><?php echo addDoubleDot(ENTRY_CUSTOMER_COUNTRY); ?> </b></td>
                            <td data-label="<?php echo ENTRY_BILLING_ADDRESS; ?>">
                                <input id="countries_name" name="update_customer_country" class="form-control input-sm" value="<?php echo tep_html_quotes($order->customer['country']); ?>"/>
                            </td>
                            <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                <input name="update_delivery_country" class="form-control input-sm" value="<?php echo tep_html_quotes($order->delivery['country']); ?>"/>
                            </td>
                            <td data-label="<?php echo ENTRY_SHIPPING_ADDRESS; ?>">
                                <input name="update_billing_country" class="form-control input-sm" value="<?php echo tep_html_quotes($order->billing['country']); ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="main"><b><?php echo addDoubleDot(ENTRY_CUSTOMER_PHONE); ?> </b></td>
                            <td data-label="<?php echo ENTRY_BILLING_ADDRESS; ?>">
                                <input id="customers_telephone" name="update_customer_telephone" class="form-control input-sm" value="<?php echo $order->customer['telephone']; ?>"/>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="main"><b><?php echo addDoubleDot(ENTRY_CUSTOMER_FAX); ?> </b></td>
                            <td data-label="<?php echo ENTRY_BILLING_ADDRESS; ?>">
                                <input id="customers_fax" name="update_customer_fax" class="form-control input-sm" value="<?php echo $order->customer['fax']; ?>"/>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="main"><b><?php echo addDoubleDot(ENTRY_CUSTOMER_EMAIL); ?> </b></td>
                            <td data-label="<?php echo ENTRY_BILLING_ADDRESS; ?>">
                                <input id="customers_email_address" name="update_customer_email_address" class="form-control input-sm" value="<?php echo $order->customer['email_address']; ?>"/>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="main"><b><?php echo ENTRY_CREDIT_CARD_CC_TYPE; ?>: </b></td>
                            <td><input name="update_info_cc_type" class="form-control input-sm" value="<?php echo $order->info['cc_type']; ?>"/></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="main"><b><?php echo ENTRY_CREDIT_CARD_CC_OWNER; ?>: </b></td>
                            <td><input name="update_info_cc_owner" class="form-control input-sm" value="<?php echo $order->info['cc_owner']; ?>"/></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="main"><b><?php echo ENTRY_CREDIT_CARD_CC_NUMBER; ?>: </b></td>
                            <td><input name="update_info_cc_number" class="form-control input-sm" value="<?php echo $order->info['cc_number']; ?>"/></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="main"><b><?php echo ENTRY_CREDIT_CARD_CC_EXPIRES; ?>: </b></td>
                            <td><input name="update_info_cc_expires" class="form-control input-sm" value="<?php echo $order->info['cc_expires']; ?>"/></td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </div>
                <?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?>

                <div class="SubTitle"><?php echo MENUE_TITLE_PAYMENT; ?></div>

                <?php echo tep_draw_separator('pixel_trans.png', '1', '1'); ?>

                <div class="table-responsive">
                    <table border="0" cellspacing="0" cellpadding="2" class="dataTableRow">
                        <tr>
                            <td colspan="2" class="main"><?php echo tep_draw_pull_down_menu('update_info_payment_method', $orders_payment_methods, $order->info['payment_method']); ?></td>
                        </tr>
                    </table>
                </div>

                <?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?>

                <div class="SubTitle"><?php echo MENUE_TITLE_ORDER; ?></div>

                <?php echo tep_draw_separator('pixel_trans.png', '1', '1'); ?>

                <?php
                // Override order.php Class's Field Limitations
                $index = 0;
                $order->products = array();
                $orders_products_query = tep_db_query("select * from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$oID . "'");
                while ($orders_products = tep_db_fetch_array($orders_products_query)) {
                    $order->products[$index] = array(
                        'qty' => $orders_products['products_quantity'],
                        'name' => tep_html_quotes($orders_products['products_name']),
                        'model' => $orders_products['products_model'],
                        'tax' => $orders_products['products_tax'],
                        'price' => $orders_products['products_price'],
                        'final_price' => $orders_products['final_price'],
                        'orders_products_id' => $orders_products['orders_products_id']
                    );

                    $subindex = 0;
                    $attributes_query_string = "select * from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . (int)$oID . "' and orders_products_id = '" . (int)$orders_products['orders_products_id'] . "'";
                    $attributes_query = tep_db_query($attributes_query_string);

                    if (tep_db_num_rows($attributes_query)) {
                        while ($attributes = tep_db_fetch_array($attributes_query)) {
                            $order->products[$index]['attributes'][$subindex] = array(
                                'option' => $attributes['products_options'],
                                'value' => $attributes['products_options_values'],
                                'prefix' => $attributes['price_prefix'],
                                'price' => $attributes['options_values_price'],
                                'orders_products_attributes_id' => $attributes['orders_products_attributes_id']
                            );
                            $subindex++;
                        }
                    }
                    $index++;
                }
                $hide_columns_with_tax = DISPLAY_PRICE_WITH_TAX == 'false' ? ' hidden' : '';
                ?>
                <div class="table-responsive">
                    <table border="0" width="100%" cellspacing="0" cellpadding="2" class="edit_orders_products_table">
                        <tr class="dataTableHeadingRow">
                            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DELETE; ?></td>
                            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_QUANTITY; ?></td>
                            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
                            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
                            <td class="dataTableHeadingContent<?= $hide_columns_with_tax ?>"><?php echo TABLE_HEADING_TAX; ?></td>
                            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_UNIT_PRICE; ?></td>
                            <td class="dataTableHeadingContent<?= $hide_columns_with_tax ?>" align="right"><?php echo TABLE_HEADING_UNIT_PRICE_TAXED; ?></td>
                            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_PRICE; ?></td>
                            <td class="dataTableHeadingContent<?= $hide_columns_with_tax ?>" align="right"><?php echo TABLE_HEADING_TOTAL_PRICE_TAXED; ?></td>
                        </tr>
                        <?php

                        for ($i = 0; $i < sizeof($order->products); $i++) {
                            $orders_products_id = $order->products[$i]['orders_products_id'];
                            $delete_products = $order->products[$i]['orders_products_id'];
                            $RowStyle = "dataTableContent";
                            echo '	  <tr class="dataTableRow text-center">
                                <td class="' . $RowStyle . '" valign="top"><input name="update_products[' . $orders_products_id . '][delete]" type="checkbox" /></td>
                                <td class="' . $RowStyle . '" valign="top" align="right" style="width: 40px;"><input name="update_products[' . $orders_products_id . '][qty]" class="form-control input-sm" value="' . $order->products[$i]['qty'] . '"></td>
                                <td class="' . $RowStyle . '" valign="middle" align="left" style="width: 600px;"><input name="update_products[' . $orders_products_id . '][name]" class="form-control input-sm" value=\'' . $order->products[$i]['name'] . '\'>';

                            // Has Attributes?
                            if (is_array($order->products[$i]['attributes']) && sizeof($order->products[$i]['attributes']) > 0) {
                                for ($j = 0; $j < sizeof($order->products[$i]['attributes']); $j++) {
                                    $orders_products_attributes_id = $order->products[$i]['attributes'][$j]['orders_products_attributes_id'];
                                    echo "<input style='width: 81px;display: inline-block;' name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][option]' class=\"edit_orders_products-input_option\" value='" . $order->products[$i]['attributes'][$j]['option'] . "'>" . ': ' .
                                        "<input name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][value]' size='10' value='" . $order->products[$i]['attributes'][$j]['value'] . "'>" . ': ' .
                                        "<input name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][prefix]' size='1' value='" . $order->products[$i]['attributes'][$j]['prefix'] . "'>" . ': ' .
                                        "<input name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][price]' size='6' value='" . numberFormatEditOrderPrice($order->products[$i]['attributes'][$j]['price']) . "'>";
                                }
                            }

                            echo '</td>';
                            $priceWithTax = tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']);
                            $currencies->format($priceWithTax, true, $order->info['currency'], $order->info['currency_value']);
                            echo '<!--product model -->',
                                '<td class="' . $RowStyle . '" valign="top"><input style="width: 80px;" name="update_products[' . $orders_products_id . '][model]" class="form-control input-sm" value="' . $order->products[$i]['model'] . '"></td>',
                            '<!--product tax -->',
                                '<td class="' . $RowStyle . $hide_columns_with_tax . '" valign="top"><input style="width: 57px;" name="update_products[' . $orders_products_id . '][tax]" class="form-control input-sm" value="' . tep_display_tax_value($order->products[$i]['tax']) . '"></td>',
                            '<!--product price without tax -->',
                                '<td class="' . $RowStyle . '" align="right" valign="top">',
                                '<input style="width: 147px;" name="update_products[' . $orders_products_id . '][products_price]" class="form-control input-sm" value="' . numberFormatEditOrderPrice($order->products[$i]['final_price']) . '">',
                            '</td>',
                            '<!--product price with tax -->',
                                '<td class="' . $RowStyle . $hide_columns_with_tax . '" align="right" valign="top">' . $currencies->format($priceWithTax, true, $order->info['currency'],
                                    $order->info['currency_value']) . '</td>',
                            '<!--product price of all amount without tax -->',
                                '<td class="' . $RowStyle . '" align="right" valign="top">' . $currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true,
                                    $order->info['currency'], $order->info['currency_value']) . '</td>',
                            '<!--product price of all amount with tax -->',
                                '<td class="' . $RowStyle . $hide_columns_with_tax . '" align="right" valign="top"><b>' . $currencies->format($priceWithTax * $order->products[$i]['qty'], true,
                                    $order->info['currency'], $order->info['currency_value']) . '</b></td>',
                            '</tr>';
                        }
                        ?>
                    </table>
                </div>
                <div class="table-responsive">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td valign="top">&nbsp;</td>
                            <td align="right">
                                <?php echo '<a class="btn btn-sm btn-primary add_products_to_order" href="' . tep_href_link(FILENAME_ORDERS_EDIT,
                                        tep_get_all_get_params(array('action')) . 'action=add_product&oID=' . $oID . '&customer_id=' . $customer_id . '&step=1') . '">' . ADDING_TITLE . '</a>'; ?>
                                <div><?php echo tep_draw_separator('pixel_trans.png', '1', '1'); ?></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive">
                    <table border="0" cellspacing="10" cellpadding="10" width="100%" class="edit_orders_status_orders">
                        <tr>
                            <td class="shipping_amount" valign="top">
                                <div class="SubTitle"><?php echo MENUE_TITLE_TOTAL; ?></div>
                                <div><?php echo tep_draw_separator('pixel_trans.png', '1', '1'); ?></div>
                                <div>
                                    <table border="0" cellspacing="0" cellpadding="2" class="dataTableRow" width="100%">
                                        <?php

                                        // shipping
                                        $shippingTitle = "";
                                        $shippingPrice = "";
                                        $totals_query = tep_db_query("select *, value from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$oID . "' order by sort_order");
                                        $order->totals = array();
                                        while ($totals = tep_db_fetch_array($totals_query)) {
                                            if ($totals['class'] === "ot_shipping") {
                                                $shippingTitle = totals_trim($totals['title']);
                                                $shippingPrice = numberFormatEditOrderPrice($totals['value']);
                                            }

                                            $order->totals[] = array(
                                                'title' => $totals['title'],
                                                'text' => $totals['text'],
                                                'class' => $totals['class'],
                                                'value' => $totals['value'],
                                                'orders_total_id' => $totals['orders_total_id']
                                            );
                                        }

                                        //define selected shipping module
                                        $selectedId = "";
                                        $shippingMethodFound = false;
                                        if (!empty($order->delivery['shipping_method_code'])) {
                                            $selectedId = $order->delivery['shipping_method_code'];
                                            $shippingMethodFound = true;
                                        }

                                        if (!$shippingMethodFound) {
                                            foreach ($ordersShippingMethods as $opm) {
                                                if (mb_strtoupper(totals_trim($opm['text'])) === mb_strtoupper(totals_trim($shippingTitle))) {
                                                    $selectedId = $opm['id'];
                                                    $shippingMethodFound = true;
                                                    break;
                                                }
                                            }
                                        }

                                        if (!$shippingMethodFound) {
                                            $selectedId = time();
                                            $ordersShippingMethods[] = [
                                                "id" => $selectedId,
                                                "text" => totals_trim($shippingTitle)
                                            ];
                                        }
                                        echo '<tr class="dataTableHeadingRow">' . "\n" . '<td colspan="3" class="dataTableHeadingContent">' . ENTRY_SHIPPING . '</td>' . "\n" . '</tr>' . "\n";
                                        echo '	<tr>' . "\n" . '		<td align="right" class="' . $TotalStyle . '"><input type="hidden" name="_shipping_name" value="' . $shippingTitle . '">' . tep_draw_pull_down_menu('add_totals[new_total_shipping][title]',
                                                $ordersShippingMethods,
                                                $selectedId) . '</td>' . "\n" . '		<td align="right" class="' . $TotalStyle . '">' . "<input name='add_totals[new_total_shipping][value]' value='" . $shippingPrice . "' size='6' value='' class='form-control input-sm'>" . '		<td align="right" class="' . $TotalStyle . '"><b>' . tep_draw_separator('pixel_trans.png',
                                                '1', '17') . '</b>' . '       </td>' . "\n" . '	 </tr>' . "\n";
                                        if ($order->delivery["shipping_method_code"] === 'nwposhtanew') {
                                            echo '<tr><td><textarea name="update_nwposhta_address" class="form-control input-sm" rows="4">' . $order->delivery["nwposhta_address"] . '</textarea></td></tr>';
                                        }
                                        ?>
                                        <tr class="dataTableHeadingRow">
                                            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TOTAL_MODULE; ?></td>
                                            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TOTAL_AMOUNT; ?></td>
                                            <td class="dataTableHeadingContent"></td>
                                        </tr>
                                        <?php
                                        // Override order.php Class's Field Limitations


                                        // START OF MAKING ALL INPUT FIELDS THE SAME LENGTH
                                        $max_length = 0;
                                        $TotalsLengthArray = array();
                                        for ($i = 0; $i < sizeof($order->totals); $i++) {
                                            $TotalsLengthArray[] = array("Name" => $order->totals[$i]['title']);
                                        }
                                        reset($TotalsLengthArray);
                                        foreach ($TotalsLengthArray as $TotalIndex => $TotalDetails) {
                                            if (strlen($TotalDetails["Name"]) > $max_length) {
                                                $max_length = strlen($TotalDetails["Name"]);
                                            }
                                        }
                                        // END OF MAKING ALL INPUT FIELDS THE SAME LENGTH

                                        $TotalsArray = array();
                                        for ($i = 0; $i < sizeof($order->totals); $i++) {
                                            if ($order->totals[$i]['class'] !== "ot_shipping") {
                                                $TotalsArray[] = array(
                                                    "Name" => $order->totals[$i]['title'],
                                                    "text" => $order->totals[$i]['text'],
                                                    "Price" => numberFormatEditOrderPrice($order->totals[$i]['value']),
                                                    "Class" => $order->totals[$i]['class'],
                                                    "TotalID" => $order->totals[$i]['orders_total_id']
                                                );
                                            }
                                        }

                                        //array_pop($TotalsArray);
                                        foreach ($TotalsArray as $TotalIndex => $TotalDetails) {
                                            $TotalStyle = "smallText";
                                            switch ($TotalDetails["Class"]) {
                                                case 'ot_total':
                                                    echo '<tr>
                                                    <td align="right" class="' . $TotalStyle . '">
                                                        <b>' . $TotalDetails["Name"] . '</b>
                                                    </td>
                                                    <td align="right" class="' . $TotalStyle . '">
                                                        <b>' . $currencies->format($TotalDetails["Price"], true, $order->info['currency'], $order->info['currency_value']) . '</b>
                                                        <input name="update_totals[' . $TotalIndex . '][title]" type="hidden" value="' . trim($TotalDetails["Name"]) . '">
                                                        <input name="update_totals[' . $TotalIndex . '][value]" type="hidden" value="' . $TotalDetails["Price"] . '">
                                                        <input name="update_totals[' . $TotalIndex . '][class]" type="hidden" value="' . $TotalDetails["Class"] . '">
                                                        <input type="hidden" name="update_totals[' . $TotalIndex . '][total_id]" value="' . $TotalDetails["TotalID"] . '">
                                                    </td>
                                                </tr>';
                                                    break;
                                                case 'ot_subtotal':
                                                    echo '<tr>
                                                    <td align="right" class="' . $TotalStyle . '">
                                                        <b>' . $TotalDetails["Name"] . '</b>
                                                    </td>
                                                    <td align="right" class="' . $TotalStyle . '">
                                                        <b>' . $currencies->format($TotalDetails["Price"], true, $order->info['currency'], $order->info['currency_value']) . '</b>
                                                        <input name="update_totals[' . $TotalIndex . '][title]" type="hidden" value="' . trim($TotalDetails["Name"]) . '">
                                                        <input name="update_totals[' . $TotalIndex . '][value]" type="hidden" value="' . $TotalDetails["Price"] . '">
                                                        <input name="update_totals[' . $TotalIndex . '][class]" type="hidden" value="' . $TotalDetails["Class"] . '">
                                                        <input type="hidden" name="update_totals[' . $TotalIndex . '][total_id]" value="' . $TotalDetails["TotalID"] . '">
                                                    </td>
                                                </tr>';
                                                    break;
                                                case 'ot_country_discount':
                                                    $minus = (strpos($TotalDetails["text"], '-') !== false && strpos($TotalDetails["Price"], '-') === false) ? '-' : '';
                                                    $TotalDetails["Price"] = $minus . $TotalDetails["Price"];
                                                    echo '<tr>
                                                    <td align="right" class="' . $TotalStyle . '">' . '
                                                        <input type="text" name="update_totals[' . $TotalIndex . '][title]" class="form-control input-sm" value="' . tep_html_quotes($TotalDetails["Name"]) . '">
                                                    </td>
                                                    <td align="right" class="' . $TotalStyle . '">
                                                        <input type="text" name="update_totals[' . $TotalIndex . '][value]" class="form-control input-sm" value="' . $TotalDetails["Price"] . '">
                                                        <input type="hidden" name="update_totals[' . $TotalIndex . '][class]" value="' . $TotalDetails["Class"] . '">
                                                        <input type="hidden" name="update_totals[' . $TotalIndex . '][total_id]" value="' . $TotalDetails["TotalID"] . '">
                                                    </td>
                                                    <td>
                                                        <a href = "' . tep_href_link(FILENAME_ORDERS_EDIT, tep_get_all_get_params(array('action')) . '&action=delete_totals&delete=1&id_total=' . $TotalDetails["TotalID"]) . '"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>';
                                                    break;
                                                case 'ot_tax':
                                                    $TotalDetailsHtml = '<input name="update_totals[' . $TotalIndex . '][title]" type="hidden" value="' . trim($TotalDetails["Name"]) . '">
                                                        <input name="update_totals[' . $TotalIndex . '][value]" type="hidden" value="' . $TotalDetails["Price"] . '">
                                                        <input name="update_totals[' . $TotalIndex . '][class]" type="hidden" value="' . $TotalDetails["Class"] . '">
                                                        <input type="hidden" name="update_totals[' . $TotalIndex . '][total_id]" value="' . $TotalDetails["TotalID"] . '">';

                                                    if (!empty((float)$TotalDetails["Price"])) {
                                                        $TotalDetailsHtml = '<tr>
                                                        <td align="right" class="' . $TotalStyle . '">
                                                            <b>' . addDoubleDot($TotalDetails["Name"]) . '</b>
                                                        </td>
                                                        <td align="right" class="' . $TotalStyle . '">
                                                            <b>' . $currencies->format($TotalDetails["Price"], true, $order->info['currency'], $order->info['currency_value']) . '</b>' .
                                                            $TotalDetailsHtml . '
                                                        </td>
                                                    </tr>';
                                                    }
                                                    echo $TotalDetailsHtml;
                                                    break;
                                                default:
                                                    $minus = (strpos($TotalDetails["text"], '-') !== false && strpos($TotalDetails["Price"], '-') === false) ? '-' : '';
                                                    $TotalDetails["Price"] = $minus . numberFormatEditOrderPrice($TotalDetails["Price"]);
                                                    echo '<tr>
                                                    <td align="right" class="' . $TotalStyle . '">' . '
                                                        <input type="text" name="update_totals[' . $TotalIndex . '][title]" class="form-control input-sm" value="' . tep_html_quotes($TotalDetails["Name"]) . '">
                                                    </td>
                                                    <td align="right" class="' . $TotalStyle . '">
                                                        <input type="text" name="update_totals[' . $TotalIndex . '][value]" class="form-control input-sm" value="' . $TotalDetails["Price"] . '">
                                                        <input type="hidden" name="update_totals[' . $TotalIndex . '][class]" value="' . $TotalDetails["Class"] . '">
                                                        <input type="hidden" name="update_totals[' . $TotalIndex . '][total_id]" value="' . $TotalDetails["TotalID"] . '">
                                                    </td>
                                                    <td>
                                                        <a href = "' . tep_href_link(FILENAME_ORDERS_EDIT, tep_get_all_get_params(array('action')) . '&action=delete_totals&delete=1&id_total=' . $TotalDetails["TotalID"]) . '"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>';
                                            }
                                        }
                                        echo '<tr class="dataTableHeadingRow">
                                        <td colspan="3" class="dataTableHeadingContent">' . ENTRY_NEW_TOTAL . '</td>
                                        </tr>';

                                        //collect disallowed order modules
                                        $disallowedOrderModules = array_column($order->totals, 'class');
                                        $disallowedOrderModules = array_combine($disallowedOrderModules, $disallowedOrderModules);

                                        //collect allowed order modules
                                        $allowedOrderModules = [];
                                        foreach ($allOrderModulesInfo as $key => $orderModuleInfo) {
                                            //don`t show in select order modules that already exist in order and always show tax order module
                                            if (!in_array($orderModuleInfo['id'], $disallowedOrderModules) || $orderModuleInfo['id'] == 'ot_tax') {
                                                $allowedOrderModules[$key] = $orderModuleInfo;
                                            }
                                        }
                                        echo '<tr>
                                            <td align="right" class="' . $TotalStyle . '">
                                                ' . tep_draw_pull_down_menu('add_totals[new_total][title]', $allowedOrderModules) . '
                                            </td>
                                            <td align="right" class="' . $TotalStyle . '">' . '
                                                <input name="add_totals[new_total][value]" size="6" value="" class="form-control input-sm">' . '
                                            <td align="right" class="' . $TotalStyle . '">
                                                <b>' . tep_draw_separator('pixel_trans.png', '1', '17') . '</b>
                                            </td>
                                        </tr>';
                                        ?>
                                    </table>
                                </div>
                                <div><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></div>
                            </td>
                            <td class="status_notifications" valign="top">
                                <!-- Begin Status Block -->
                                <div class="SubTitle"><?php echo MENUE_TITLE_STATUS; ?></div>
                                <div><?php echo tep_draw_separator('pixel_trans.png', '1', '1'); ?></div>
                                <div class="main">

                                    <table border="0" cellspacing="0" cellpadding="2" class="dataTableRow" width="100%">
                                        <tr class="dataTableHeadingRow">
                                            <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_DATE_ADDED; ?></td>
                                            <td class="dataTableHeadingContent" align="left" width="10">
                                                &nbsp;
                                            </td>
                                            <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_CUSTOMER_NOTIFIED; ?></td>
                                            <td class="dataTableHeadingContent" align="left" width="10">
                                                &nbsp;
                                            </td>
                                            <td class="dataTableHeadingContent" align="left"><?php echo HEADING_TITLE_STATUS; ?></td>
                                            <td class="dataTableHeadingContent" align="left" width="10">
                                                &nbsp;
                                            </td>
                                            <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_COMMENTS; ?></td>
                                        </tr>
                                        <?php
                                        $orders_history_query = tep_db_query("select * from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . tep_db_input($oID) . "' order by date_added");
                                        if (tep_db_num_rows($orders_history_query)) {
                                            while ($orders_history = tep_db_fetch_array($orders_history_query)) {
                                                echo '  <tr>' . "\n" . '    <td class="smallText" align="center">' . tep_datetime_short($orders_history['date_added']) . '</td>' . "\n" . '    <td class="dataTableHeadingContent" align="left" width="10">&nbsp;</td>' . "\n" . '    <td class="smallText" align="center">';
                                                if ($orders_history['customer_notified'] == '1') {
                                                    echo tep_image(DIR_WS_ICONS . 'tick.gif', ICON_TICK) . "</td>\n";
                                                } else {
                                                    echo tep_image(DIR_WS_ICONS . 'cross.gif', ICON_CROSS) . "</td>\n";
                                                }
                                                echo '    <td class="dataTableHeadingContent" align="left" width="10">&nbsp;</td>' . "\n" . '    <td class="smallText" align="left">' . $orders_status_array[$orders_history['orders_status_id']] . '</td>' . "\n";
                                                echo '    <td class="dataTableHeadingContent" align="left" width="10">&nbsp;</td>' . "\n" . '    <td class="smallText" align="left">' . $orders_history['comments'] . '&nbsp;</td>' . "\n";
                                                echo '  </tr>' . "\n";
                                            }
                                        } else {
                                            echo '  <tr>' . "\n" . '    <td class="smallText" colspan="5">' . TEXT_NO_ORDER_HISTORY . '</td>' . "\n" . '  </tr>' . "\n";
                                        }
                                        ?>
                                    </table>

                                </div>
                                <div><?php echo tep_draw_separator('pixel_trans.png', '1', '1'); ?></div>
                                <div>

                                    <table border="0" cellspacing="0" cellpadding="2" class="dataTableRow" width="100%">
                                        <tr class="dataTableHeadingRow">
                                            <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_STATUS; ?></td>
                                            <td class="main" width="10">&nbsp;</td>
                                            <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_COMMENTS; ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table border="0" cellspacing="0" cellpadding="2" width="100%">
                                                    <tr>
                                                        <td colspan="2" align="right"><?php echo tep_draw_pull_down_menu('status', $orders_statuses, $order->info['orders_status']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="main"><?php echo ENTRY_NOTIFY_CUSTOMER; ?></td>
                                                        <td class="main" align="right"><?php echo tep_draw_checkbox_field('notify', '', false); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="main"><?php echo ENTRY_NOTIFY_COMMENTS; ?></td>
                                                        <td class="main" align="right"><?php echo tep_draw_checkbox_field('notify_comments', '', false); ?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td class="main" width="10">&nbsp;</td>
                                            <td class="main">
                                                <?php
                                                echo tep_draw_textarea_field('comments', 'soft', '30', '5', $orders_statuses[$order->info['orders_status']]['orders_status_text'],
                                                    'class="form-control input-sm"');
                                                ?>
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="actions_btn">
                    <a href="<?= tep_href_link(FILENAME_ORDERS, 'action=edit_orders' . $cancelLinkParam)?>" class="btn btn-sm btn-info"><?php echo IMAGE_BACK; ?></a>
                    <button type="submit" class="btn btn-sm btn-success edit_orders-btn_update"><?php echo IMAGE_UPDATE; ?></button>
                </div>

                <!-- End of Update Block -->

                </form>

                <?php
            }
            if ($action == "add_product") {
                ?>
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="pageHeading"><?php echo ADDING_TITLE; ?>
                            (<?php echo HEADING_TITLE_NUMBER; ?> <?php echo $oID; ?>)
                        </td>
                        <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', 1, HEADING_IMAGE_HEIGHT); ?></td>
                        <td class="pageHeading" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ORDERS_EDIT,
                                    tep_get_all_get_params(array('action'))) . '">' . tep_text_button(BUTTON_BACK_NEW) . '</a>'; ?></td>
                    </tr>
                </table>
            <?php
            // ############################################################################
            //   Get List of All Products
            // ############################################################################

            $result = tep_db_query("SELECT products_name, p.products_id, categories_name, ptc.categories_id FROM " . TABLE_PRODUCTS . " p LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON pd.products_id=p.products_id LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc ON ptc.products_id=p.products_id LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON cd.categories_id=ptc.categories_id where pd.language_id = '" . (int)$languages_id . "' ORDER BY categories_name");
            while ($row = tep_db_fetch_array($result)) {
                extract($row, EXTR_PREFIX_ALL, "db");
                $ProductList[$db_categories_id][$db_products_id] = $db_products_name;
                $CategoryList[$db_categories_id] = $db_categories_name;
                $LastCategory = $db_categories_name;
            }

            // ############################################################################
            //   Add Products Steps
            // ############################################################################
            echo '<tr><td><table border="0">' . "\n";

            // Set Defaults
            if (!isset($_POST['add_product_categories_id'])) {
                $add_product_categories_id = 0;
            }

            if (!isset($_POST['add_product_products_id'])) {
                $add_product_products_id = 0;
            }

            // Step 1: Choose Category
            echo '<tr class="dataTableRow steps"><form action=' . tep_href_link(FILENAME_ORDERS_EDIT,
                    tep_get_all_get_params(array('action')) . 'action=' . $_GET['action'] . '&oID=' . $_GET['oID']) . ' method="POST">' . "\n";

            //b2b
            print tep_draw_hidden_field('customer_id', $customer_id);

            ?>
            <?php
            //b2b
            echo '<td class="dataTableContent" align="right"><b>' . ADDPRODUCT_TEXT_STEP . ' 1:</b></td>' . "\n";
            echo '<td class="dataTableContent" valign="top">';
            if (isset($_POST['add_product_categories_id'])) {
                $current_category_id = $_POST['add_product_categories_id'];
            }
            echo ' ' . tep_draw_pull_down_menu('add_product_categories_id', $tep_get_category_tree, $current_category_id, 'id="order_new_product_category"  onChange="this.form.submit();"');
            echo '<input type="hidden" name="step" value="2">' . "\n";
            echo '</td>' . "\n";
            echo '<td class="dataTableContent add_product_text">' . ADDPRODUCT_TEXT_STEP1 . '</td>' . "\n";
            echo '</form></tr>' . "\n";
            echo '<tr><td colspan="3">&nbsp;</td></tr>' . "\n";
            ?>
                <input type="text" value="" name="search_product_for_order" placeholder="<?php echo TEXT_PRODUCT_NAME_PLACEHOLDER; ?>" class="form-control" id="search" autocomplete="off">

                <script>
                    $(document).ready(function () {

                        var id_product_order = 0;

                        $('input[name=search_product_for_order]').autocomplete({
                            source: function (request, response) {
                                $.ajax({
                                    url: "ajax_add_prod_orders.php?action=show",
                                    dataType: 'json',
                                    data: {
                                        ord_prod: request.term
                                    },
                                    success: function (data) {
                                        response(data);
                                    }
                                });
                            },
                            delay: 50,
                            minLength: 2,
                            select: function (event, ui) {
                                var selected = ui.item.label;
                                var id = ui.item.id;
                                var model = ui.item.model;
                                var category_id = ui.item.category_id;
                                $('#order_new_product_category option[value="' + category_id + '"]').prop('selected', true).change();
                                localStorage.setItem('id_product_order', id);
                                return false;
                            }
                        }).autocomplete("instance")._renderItem = function (ul, item) {
                            ul.css({'z-index': 9991, 'width': '300'});
                            return $("<li>")
                                .append("<div>(" + item.model + ")" + item.label + "</div>")
                                .appendTo(ul);
                        };

                        if (localStorage.getItem('id_product_order')) {
                            console.log(localStorage.getItem('id_product_order'));
                            $('#add_product_products_id option[value="' + localStorage.getItem('id_product_order') + '"]').prop('selected', true).change();
                            localStorage.removeItem('id_product_order');
                        }
                    });
                </script>
                <?php


                // Step 2: Choose Product
                if (($_POST['step'] > 1) && ($_POST['add_product_categories_id'] > 0)) {
                    echo '<tr class="dataTableRow steps"><form action=' . tep_href_link(FILENAME_ORDERS_EDIT,
                            tep_get_all_get_params(array('action')) . 'action=' . $_GET['action'] . '&oID=' . $_GET['oID']) . ' method="POST">' . "\n";

                    //b2b
                    print tep_draw_hidden_field('customer_id', $customer_id);

                    //b2b
                    echo '<td class="dataTableContent" align="right"><b>' . ADDPRODUCT_TEXT_STEP . ' 2: </b></td>' . "\n";
                    echo '<td class="dataTableContent" valign="top"><select class="form-control" name="add_product_products_id" onChange="this.form.submit();" id="add_product_products_id">';
                    $ProductOptions = "<option value='0'>" . ADDPRODUCT_TEXT_SELECT_PRODUCT . "\n";
                    //  $subcategories=tep_make_cat_list($current_category_id);
                    $subcategories = $cat_list[$current_category_id];

                    $subcategories[] = $current_category_id;
                    if (!empty($subcategories)) {
                        foreach ($subcategories as $subcategory) {
                            if ($ProductList[$subcategory]) {
                                asort($ProductList[$subcategory]);
                                foreach ($ProductList[$subcategory] as $ProductID => $ProductName) {
                                    $ProductOptions .= "<option value='$ProductID'> $ProductName\n";
                                }
                            }
                        }
                    } else {
                        if ($ProductList[$current_category_id]) {
                            asort($ProductList[$current_category_id]);
                            foreach ($ProductList[$current_category_id] as $ProductID => $ProductName) {
                                $ProductOptions .= "<option value='$ProductID'> $ProductName\n";
                            }
                        }
                    }

                    if (isset($_POST['add_product_products_id'])) {
                        $ProductOptions = str_replace("value='" . $_POST['add_product_products_id'] . "'", "value='" . $_POST['add_product_products_id'] . "' selected=\"selected\"", $ProductOptions);
                    }
                    echo ' ' . $ProductOptions . ' ';
                    echo '</select></td>' . "\n";
                    echo '<input type="hidden" name="add_product_categories_id" value=' . $_POST['add_product_categories_id'] . '>';
                    echo '<input type="hidden" name="step" value="3">' . "\n";
                    echo '<td class="dataTableContent add_product_text">' . ADDPRODUCT_TEXT_STEP2 . '</td>' . "\n";
                    echo '</form></tr>' . "\n";
                    echo '<tr><td colspan="3">&nbsp;</td></tr>' . "\n";
                }

                // Step 3: Choose Options
                if (($_POST['step'] > 2) && ($_POST['add_product_products_id'] > 0)) {
                    // Get Options for Products
                    $result = tep_db_query("SELECT * FROM " . TABLE_PRODUCTS_ATTRIBUTES . " pa LEFT JOIN " . TABLE_PRODUCTS_OPTIONS . " po ON po.products_options_id=pa.options_id LEFT JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov ON pov.products_options_values_id=pa.options_values_id WHERE products_id=" . $_POST['add_product_products_id'] . " and po.language_id = '" . (int)$languages_id . "'  and po.products_options_type not in (0)");


                    // Skip to Step 4 if no Options
                    if (tep_db_num_rows($result) == 0) {
                        echo '<tr class="dataTableRow steps">' . "\n";
                        echo '<td class="dataTableContent" align="right"><b>' . ADDPRODUCT_TEXT_STEP . ' 3: </b></td>' . "\n";
                        echo '<td class="dataTableContent" valign="top" colspan="2"><i>' . ADDPRODUCT_TEXT_OPTIONS_NOTEXIST . '</i></td>' . "\n";
                        echo '</tr>' . "\n";
                        $_POST['step'] = 4;
                    } else {
                        while ($row = tep_db_fetch_array($result)) {
                            extract($row, EXTR_PREFIX_ALL, "db");
                            $Options[$db_products_options_id] = $db_products_options_name;
                            $ProductOptionValues[$db_products_options_id][$db_products_options_values_id] = $db_products_options_values_name;
                        }

                        echo '<tr class="dataTableRow steps"><form action=' . tep_href_link(FILENAME_ORDERS_EDIT,
                                tep_get_all_get_params(array('action')) . 'action=' . $_GET['action'] . '&oID=' . $_GET['oID']) . ' method="POST">' . "\n";

                        //b2b
                        print tep_draw_hidden_field('customer_id', $customer_id);

                        //b2b
                        echo '<td class="dataTableContent" align="right"><b>' . ADDPRODUCT_TEXT_STEP . ' 3: </b></td><td class="dataTableContent" valign="top">';

                        //                        debug($ProductOptionValues); die;

                        foreach ($ProductOptionValues as $OptionID => $OptionValues) {
                            $OptionOption = "<b>" . $Options[$OptionID] . "</b> - <select name='add_product_options[$OptionID]'>";
                            foreach ($OptionValues as $OptionValueID => $OptionValueName) {
                                $OptionOption .= "<option value='$OptionValueID'> $OptionValueName\n";
                            }
                            $OptionOption .= "</select><br />\n";

                            if (isset($_POST['add_product_options'])) {
                                $OptionOption = str_replace("value='" . $_POST['add_product_options'][$OptionID] . "'",
                                    "value='" . $_POST['add_product_options'][$OptionID] . "' selected=\"selected\"", $OptionOption);
                            }
                            echo '' . $OptionOption . '';
                        }
                        echo '</td>';
                        echo '<td class="dataTableContent" align="center"><input class="add_prpoduct_btn" type="submit" value="' . ADDPRODUCT_TEXT_OPTIONS_CONFIRM . '">';
                        echo '<input type="hidden" name="add_product_categories_id" value=' . $_POST['add_product_categories_id'] . '>';
                        echo '<input type="hidden" name="add_product_products_id" value=' . $_POST['add_product_products_id'] . '>';
                        echo '<input type="hidden" name="step" value="4">';
                        echo '</td>' . "\n";
                        echo '</form></tr>' . "\n";
                    }

                    echo '<tr><td colspan="3">&nbsp;</td></tr>' . "\n";
                }

                // Step 4: Confirm
                if ($_POST['step'] > 3) {
                    echo '<tr class="dataTableRow steps"><form action=' . tep_href_link(FILENAME_ORDERS_EDIT,
                            tep_get_all_get_params(array('action')) . 'action=' . $_GET['action'] . '&oID=' . $_GET['oID']) . ' method="POST">' . "\n";

                    //b2b
                    print tep_draw_hidden_field('customer_id', $customer_id);

                    //b2b
                    echo '<td class="dataTableContent" align="right"><b>' . ADDPRODUCT_TEXT_STEP . ' 4: </b></td>';
                    echo '<td class="dataTableContent" valign="top"><input name="add_product_quantity" size="2" value="1"> ' . ADDPRODUCT_TEXT_CONFIRM_QUANTITY . '</td>';
                    echo '<td class="dataTableContent" align="center"><input class="add_prpoduct_btn" type="submit" value="' . ADDPRODUCT_TEXT_CONFIRM_ADDNOW . '">';

                    if (is_array($_POST['add_product_options'])) {
                        foreach ($_POST['add_product_options'] as $option_id => $option_value_id) {
                            echo '<input type="hidden" name="add_product_options[' . $option_id . ']" value="' . $option_value_id . '">';
                        }
                    }
                    echo '<input type="hidden" name="add_product_categories_id" value=' . $_POST['add_product_categories_id'] . '>';
                    echo '<input type="hidden" name="add_product_products_id" value=' . $_POST['add_product_products_id'] . '>';
                    echo '<input type="hidden" name="step" value="5">';
                    echo '</td>' . "\n";
                    echo '</form></tr>' . "\n";
                }

                echo '</table></td></tr>' . "\n";
            }
            ?>
        </div>
    </div>
    <!-- body_smend //-->

    <script>
        var orderStatusText =<?php echo json_encode($orders_statuses);?>;
        $(document).ready(function () {
            var textareaComments = $('.status_notifications [name="comments"]');
            var editor = CKEDITOR.replace(textareaComments.attr('name'), {
                extraPlugins: 'colorbutton,font,showblocks,justify,codemirror,btgrid',
                startupFocus: true,
                removePlugins: 'sourcearea',
                on: {
                    instanceReady: function() {
                        this.dataProcessor.htmlFilter.addRules( {
                            elements: {
                                img: function( el ) {
                                    // Add an attribute.
                                    if ( !el.attributes.alt )
                                        el.attributes.alt = '';

                                    // Add some class.
                                    if (typeof el.attributes.class === 'undefined' || el.attributes.class.indexOf('img-responsive') == -1){
                                        el.addClass( ' img-responsive' );
                                    }
                                    if (typeof el.attributes.class === 'undefined' || el.attributes.class.indexOf('lazyload') == -1){
                                        el.addClass( ' lazyload' );
                                    }
                                    el.attributes.style = '' ;
                                }
                            }
                        });
                    }
                }
            });
            editor.on('change', function (evt) {
                textareaComments.text(evt.editor.getData());
            });
            CKFinder.setupCKEditor(editor, 'includes/ckfinder/');
            $(document).on('change','.status_notifications [name="status"]',function(){
                var textarea = $('.status_notifications [name="comments"]');
                var statusText = orderStatusText[$(this).val()].orders_status_text;
                textarea.text(statusText);
                CKEDITOR.instances["comments"].setData(statusText);
            });

            // update on return from "add product"
            <?php $parts = parse_url($_SERVER['HTTP_REFERER']);
            parse_str($parts['query'], $query);
            if ($query['action'] == 'add_product') { ?>
                $('.edit_orders-btn_update').trigger('click');
            <?php } ?>
        })
    </script>


    <script>
        /**
         * Submit form before add products to order
         * to save information about customer
         *
         * @var string href
         * Link on add products page
         * @var jQuery Object form
         * @var string action
         * Action of the form
         * @var string data
         * Serialized form
         *
         * @author Sergey Fedorenko
         */
        $('.add_products_to_order').on('click', function (e) {
            e.preventDefault();
            var href   = $(this).attr('href');
            var form   = $('form[name="edit_order"]');
            var action = form.attr('action');
            var data   = form.serialize();
            $.post(action, data, function () {
                window.location.href = href;
            });
        });

        var addresses = [];
        $('body').on('focus', '#searchClient', function () {
            var stringParams = new URLSearchParams(window.location.search);
            if (stringParams.get('cid') !== null){
                $.post('orders.php', {action: "getCustomer", id: stringParams.get('cid')}, function (response) {
                    console.log(response);
                    for (var field in response) {
                        $('#' + field).val(response[field]);
                    }
                }, "json").done(function () {
                    $('.tooltip_own').remove();
                    stringParams.delete('cid');
                    window.history.replaceState('', '',window.location.origin + 'orders.php' + '?' + stringParams.toString())
                });
            }

            $("#searchClient").autocomplete({
                source: 'orders.php',
                delay: 50,
                minLength: 2,
                select: function (event, ui) {
                    $("#searchClient").closest('form')[0].reset();
                    show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 55555, $("#searchClient").closest('form'));
                    $.post('orders.php', {action: "getCustomer", id: ui.item.id}, function (response) {
                        var element;
                        element = $('#customers_name');
                        if(element)element.val(response['customers_firstname']+' '+response['customers_lastname']);
                        for (var field in response) {
                            switch(field) {
                                case 'addresses':
                                    $('#address_book').html('');
                                    for(var address in response[field]) {
                                        addresses[response[field][address]['address_book_id']] = response[field][address];
                                        var select;
                                        if(response[field][address]['address_book_id'] == response[field][0]['address_book_id']) {
                                            select = ' selected';
                                        }else {
                                            select = '';
                                        }
                                        var addressValue = response[field][address]['address_book_id'];
                                        var addressName = /*(response[field][address]['type_address_name'] ? response[field][address]['type_address_name'] + '  ': '') +*/
                                            (response[field][address]['customers_firm'] ? response[field][address]['customers_firm'] + '  ': '') +
                                            (response[field][address]['entry_street_address'] ? response[field][address]['entry_street_address'] + '  ': '') +
                                            (response[field][address]['entry_city'] ? response[field][address]['entry_city']: '');
                                        if(addressName.length<=0) addressName='-';
                                        $('#address_book').append('<option value="'+addressValue+'"'+select+'>'+addressName+'</option>');
                                    }
                                    break;
                                default:
                                    element = $('#' + field);
                                    if(element)element.val(response[field]);
                            }

                        }
                    }, "json").done(function () {
                        $('.tooltip_own').remove();
                    });
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item) {
                ul.css('z-index', 9999);
                return $("<li>")
                    .append("<div>(" + item.id + ") " + item.first_name + " " + item.last_name + "</div>")
                    .appendTo(ul);
            };
        });

        $(document).on('change', '#address_book', function () {
            setAddress($(this).val());
        });

        function setAddress (address_id){
            var element;
            if(addresses && addresses[address_id]){
                element = $('#customers_name');
                if(element)element.val(addresses[address_id]['customers_firstname']+' '+addresses[address_id]['customers_lastname']);
                for(var field in addresses[address_id]) {
                    element = $('#' + field);
                    if(element)element.val(addresses[address_id][field]);
                }
            }
        }

    </script>

<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>

<?php

/**
 * footer
 */

include_once('footer.php');
include_once('html-close.php');

?>
<?php
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>