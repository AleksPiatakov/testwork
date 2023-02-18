<?php

require('includes/application_top.php');

if (!tep_session_is_registered('customer_id')) {
    // $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}

if (!isset($_GET['order_id']) || (isset($_GET['order_id']) && !is_numeric($_GET['order_id']))) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
}

$customer_info_query = tep_db_query("select customers_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$_GET['order_id'] . "'");
$customer_info = tep_db_fetch_array($customer_info_query);
if ($customer_info['customers_id'] != $customer_id) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
}

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_HISTORY_INFO);
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT);

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
$breadcrumb->add(
    sprintf(NAVBAR_TITLE_3, $_GET['order_id']),
    tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $_GET['order_id'], 'SSL')
);

require(DIR_WS_CLASSES . 'order.php');
$order = new order($_GET['order_id']);

$content = CONTENT_ACCOUNT_HISTORY_INFO;
$javascript = 'popup_window.js';
require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
