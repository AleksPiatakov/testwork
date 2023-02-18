<?php

require('includes/application_top.php');
require('includes/classes/http_client.php');

$required_value_sql = "SELECT `configuration_key`,`configuration_required_value` FROM `" . TABLE_CONFIGURATION . "` WHERE `configuration_group_id` = 5";
$required_value_query = tep_db_query($required_value_sql);
$result_required = [];

while ($required_value = tep_db_fetch_array($required_value_query)) {
    $result_required[$required_value['configuration_key']] = $required_value['configuration_required_value'];
}

if (ONEPAGE_LOGIN_REQUIRED == 'true') {
    if (!tep_session_is_registered('customer_id')) {
        tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
}
if (isset($_GET['rType'])) {
    header('content-type: text/html; charset=utf-8');
}

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT);

if (isset($_REQUEST['coupon']) && tep_not_null($_REQUEST['coupon']) && $_REQUEST['coupon'] == 'redeem code') {
    $_REQUEST['coupon'] = '';
    $_POST['coupon'] = '';
}

require('includes/classes/onepage_checkout.php');
$onePageCheckout = new osC_onePageCheckout();

if (!isset($_GET['rType']) && !isset($_GET['action']) && !isset($_POST['action']) && !isset($_GET['error_message']) && !isset($_GET['payment_error'])) {
    $onePageCheckout->init();
}

require_once(DIR_WS_CLASSES . 'order.php');
$order = new order();

$onePageCheckout->loadSessionVars();

//  print_r($order);
// register a random ID in the session to check throughout the checkout procedure
// against alterations in the shopping cart contents
if (!tep_session_is_registered('cartID')) {
    tep_session_register('cartID');
}
$cartID = $cart->cartID;

// if the order contains only virtual products, forward the customer to the billing page as
// a shipping address is not needed

if (!isset($_GET['action']) && !isset($_POST['action'])) {
    // Start - CREDIT CLASS Gift Voucher Contribution
    //  if ($order->content_type == 'virtual') {
    if ($order->content_type == 'virtual' || $order->content_type == 'virtual_weight') {
        // End - CREDIT CLASS Gift Voucher Contribution
        $shipping = false;
        $sendto = false;
    }
} else {
    // if there is nothing in the customers cart, redirect them to the shopping cart page
    if ($cart->count_contents() < 1 && !isAjax()) {
        tep_redirect(tep_href_link(FILENAME_DEFAULT));
    }
}

$total_weight = $cart->show_weight();
$total_count = $cart->count_contents();
if (method_exists($cart, 'count_contents_virtual')) {
    // Start - CREDIT CLASS Gift Voucher Contribution
    $total_count = $cart->count_contents_virtual();
    // End - CREDIT CLASS Gift Voucher Contribution
}

// load all enabled shipping modules
require(DIR_WS_CLASSES . 'shipping.php');
$shipping_modules = new shipping();

// load all enabled payment modules
require(DIR_WS_CLASSES . 'payment.php');
$payment_modules = new payment();

require_once(DIR_WS_CLASSES . 'order_total.php');
$order_total_modules = new order_total();

$openTab = (isset($_POST['open_tab']) ? $_POST['open_tab'] : '');
$action = (isset($_POST['action']) ? $_POST['action'] : '');
if (isset($_POST['updateQuantities_x'])) {
    $action = 'updateQuantities';
}
if (isset($_GET['action']) && $_GET['action'] == 'process_confirm') {
    $action = 'process_confirm';
}

if (tep_not_null($action)) {
    ob_start();
    if (isset($_POST) && is_array($_POST)) {
        $onePageCheckout->decodePostVars();
    }
    switch ($action) {
        case 'process_confirm':
            //      echo $onePageCheckout->confirmCheckout();
            break;
        case 'process':
            if (!\Solomono\CSRF::isValid()) {
                tep_redirect(addHostnameToLink(tep_href_link(
                    FILENAME_CHECKOUT
                )));
            }

            echo $onePageCheckout->processCheckout();
            break;
        case 'countrySelect':
            //  echo $onePageCheckout->getAjaxStateField();
            break;
        case 'processLogin':
//            echo $onePageCheckout->processAjaxLogin($_POST['email'], $_POST['pass']);
            break;
        case 'removeProduct':
//            echo $onePageCheckout->removeProductFromCart($_POST['pID']);
            break;
        case 'updateQuantities':
            //        echo $onePageCheckout->updateCartProducts($_POST['qty'], $_POST['id']);
            break;
        case 'setPaymentMethod':
            echo $onePageCheckout->setPaymentMethod($_POST['method']);
            break;
        case 'setGV':
//            echo $onePageCheckout->setGiftVoucher($_POST['method']);
            break;
        case 'redeemPoints':
//            echo $onePageCheckout->redeemPoints($_POST['points']);
            break;
        case 'clearPoints':
//            echo $onePageCheckout->clearPoints();
            break;
        case 'setShippingMethod':
            echo $onePageCheckout->setShippingMethod($_POST['method']);
            break;
        case 'setSendTo':
        case 'setBillTo':
        case 'setBillTo':
            if ($order->info["shipping_method_code"]) {
                $shippingModuleName = $order->info["shipping_method_code"];
                $shippingModule = $$shippingModuleName;
                if (!$shippingModule->enabled) {
                    exit();
                }
            }
            echo $onePageCheckout->setCheckoutAddress($action);
            break;
        case 'setCheckoutAddressField':
            echo $onePageCheckout->setCheckoutAddressField();
            break;
        case 'checkEmailAddress':
            echo $onePageCheckout->checkEmailAddress($_POST['emailAddress']);
            break;
        case 'saveAddress':
        case 'addNewAddress':
            echo $onePageCheckout->saveAddress($action);
            break;
        case 'selectAddress':
            echo $onePageCheckout->setAddress($_POST['address_type'], $_POST['address']);
            break;
        case 'redeemVoucher':
            //        echo $onePageCheckout->redeemCoupon($_POST['code']);
            break;
        case 'setMembershipPlan':
            //    echo $onePageCheckout->setMembershipPlan($_POST['planID']);
            break;
        case 'updateCartView':
            //    if ($cart->count_contents() == 0){
            //        echo 'none';
            //    }else{
            //        include(DIR_WS_INCLUDES . 'checkout/cart.php');
            //    }
            break;
        case 'updatePoints':
        case 'updateShippingMethods':
            include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/shipping_method.php');
            break;
        case 'updatePaymentMethods':
            include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/payment_method.php');
            break;
        case 'getOrderTotalsData':
            echo json_encode([
                'currency' => $order->info['currency'],
                'amount' => (float)number_format(
                    $order->info['total'] * $order->info['currency_value'],
                    2,
                    '.',
                    ''
                )
                    * 100
            ]);
            break;
        case 'getOrderTotals':
            if (MODULE_ORDER_TOTAL_INSTALLED) {
                echo '<table cellpadding="2" cellspacing="0" border="0" width="100%">';

                $order_total_modules->process();

                echo $order_total_modules->output();
                echo '</table>';
            }
            break;
        case 'updateRadiosforTotal':
            $order_total_modules->output();
            echo $order->info['total'];
            break;
        case 'getProductsFinal':
            include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/products_final.php');
            break;
        case 'getNewAddressForm':
        case 'getAddressBook':
            $addresses_count = tep_count_customer_address_book_entries();
            if ($action == 'getAddressBook') {
                $addressType = $_POST['addressType'];
                include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/address_book.php');
            } else {
                include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/new_address.php');
            }
            break;
        case 'getEditAddressForm':
            $aID = tep_db_prepare_input($_POST['addressID']);
            $Qaddress = tep_db_query('select * from ' . TABLE_ADDRESS_BOOK . ' where customers_id = "' . $customer_id . '" and address_book_id = "' . $aID . '"');
            $address = tep_db_fetch_array($Qaddress);
            include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/edit_address.php');
            break;
        case 'getBillingAddress':
            include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/billing_address.php');
            break;
        case 'getShippingAddress':
            include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/shipping_address.php');
            break;
        case 'updateCheckoutCart':
            include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/checkout_cart.php');
        case 'setNpFields':
            $_SESSION["onepage"]["shipping"][$_POST["field"]] = $_POST["value"];
            break;
        case 'setCheckboxStatus':
            if (isset($_POST['checkboxName']) && isset($_POST['checkboxStatus'])) {
                $_SESSION['checkoutCheckboxState'][$_POST['checkboxName']] = $_POST['checkboxStatus'];
            }
            break;
        case 'setCardNumber':
            if (isset($_POST['cc_number'])) {
                $_SESSION['cc_number'] = $_POST['cc_number'];
            }
            break;
    }

    $content = ob_get_contents();
    ob_end_clean();
    if ($action == 'process') {
        echo $content;
    } else {
        echo $content;
    }
    tep_session_close();
    tep_exit();
}

function fixSeoLink($url)
{
    return str_replace('&amp;', '&', $url);
}

//collect minLengthArray of shipping fields
$minLengthArray = [];
$query = tep_db_query("SELECT id, shipping_code, min_length FROM " . TABLE_SHIP2FIELDS);
while ($row = tep_db_fetch_array($query)) {
    $minLengthArray[$row['shipping_code']][$row['id']] = $row['min_length'];
}

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CHECKOUT_ONEPAGE));

$content = CONTENT_CHECKOUT_ONEPAGE;
$javascript = 'onepagecheckout.js.php';

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
