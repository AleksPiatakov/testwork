<?php

require('includes/application_top.php');

// for WayForPay module
if (!empty($_REQUEST['transactionStatus'])) {
    if ($_REQUEST['transactionStatus'] !== "Approved") {
        tep_redirect(tep_href_link(FILENAME_CHECKOUT));
    }
}
$_GET['order_id'] = !empty($_POST['order_id']) ? (int)$_POST['order_id'] : $_GET['order_id'];
if (isset($_SESSION['allowCheckoutSuccessPageId']) && $_SESSION['allowCheckoutSuccessPageId'] == $_GET['order_id']) {
    unset($_SESSION['allowCheckoutSuccessPageId']);
} else {
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
}

/* One Page Checkout - END */
if ($_SESSION['callback']) {
    clear_order_sessions($order_id);
}

if ((isset($_GET['action']) && ($_GET['action'] == 'update'))) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
}

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SUCCESS);

$breadcrumb->add(NAVBAR_TITLE_1);

$global_query = tep_db_query("select global_product_notifications from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "'");
$global = tep_db_fetch_array($global_query);

/* One Page Checkout - BEGIN */
if (tep_session_is_registered('customer_id')) {
//  echo 'yes!!!!!!!!!!!!!!!!';
}
$products_array = $productsIdsForAnalyticsArray = $productsPriceForAnalyticsArray = [];
if (tep_session_is_registered('customer_id')) {
    if ($global['global_product_notifications'] != '1') {
        $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where customers_id = '" . (int)$customer_id . "' order by date_purchased desc limit 1");
        $orders = tep_db_fetch_array($orders_query);

        $products_query = tep_db_query("select products_id, products_name, products_price, products_tax, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$orders['orders_id'] . "' order by products_name");
        while ($products = tep_db_fetch_array($products_query)) {
            $products_array[] = [
                'id' => $products['products_id'],
                'text' => $products['products_name'],
            ];
            $productsIdsForAnalyticsArray[] = $products['products_id'];
            $productsPriceForAnalyticsArray[] = number_format(
                ($products['products_price'] * $products['products_quantity']) + $products['products_tax'],
                2
            );
        }
    }
    /* One Page Checkout - BEGIN */
}
/* One Page Checkout - END */

$content = CONTENT_CHECKOUT_SUCCESS;
$javascript = 'popup_window_print.js';
require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');

if (SMSINFORM_MODULE_ENABLED == 'true') {
    include('ext/sms/sms_success.php');
}
