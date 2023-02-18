<?php

use Mpdf\Mpdf;

require('includes/application_top.php');

if (!function_exists('CheckAuthentication')) {
    function CheckAuthentication()
    {
        // если мы в админке Оска тогда продолжаем

        $sessions = explode(';', $_SERVER['HTTP_COOKIE']);
        $adminCookie = array_filter($sessions, function ($cookie) {
            $cookie = explode('=', $cookie);
            return trim($cookie[0]) == 'osCAdminID';
        });

        if ($adminCookie) {
            $adminCookie = reset($adminCookie);
            $sId = explode('=', $adminCookie)[1];
            $query_add = "SELECT value FROM `sessions` WHERE `sesskey` = '" . trim($sId) . "'";
            $result_add = tep_db_query($query_add);

            $result = tep_db_fetch_array($result_add);

            if ($result && strstr($result['value'], 'login_first_name')) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

$adminSession = CheckAuthentication();

$mpdf = new Mpdf([
    'margin_left' => 15,
    'margin_right' => 15,
    'margin_bottom' => 55,
    'margin_footer' => 10,
    'default_font' => 'droidsansfallback'
]);

// For support chinese
$mpdf->useAdobeCJK = true;
$mpdf->autoLangToFont = true;
$mpdf->autoScriptToLang = true;

if (!isset($_GET['order_id']) || (isset($_GET['order_id']) && !is_numeric($_GET['order_id']))) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
}

$order_info_query = tep_db_query("select customers_id, is_quotation from " . TABLE_ORDERS . " where orders_id = '" . (int)$_GET['order_id'] . "'");
$order_info = tep_db_fetch_array($order_info_query);
if ($order_info['customers_id'] != $customer_id && !$adminSession) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
}

if (!$adminSession && $order_info['is_quotation'] == 1) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
}

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRINT_MY_INVOICE);

$pdfTitle = PDF_TITLE_TEXT;
if ($order_info['is_quotation'] == 1) {
    $pdfTitle = PDF_TITLE_QUOTATION_TEXT;
}

require(DIR_WS_CLASSES . 'order.php');
$order = new order($_GET['order_id']);
$date = date('M d, Y');

$storeTelephoneNumber = trim(strip_tags(renderArticle('phones')));

ob_start();
require "templates/default/content/print_my_invoice.tpl.php";
$output = ob_get_contents();
ob_end_clean();

$mpdf->WriteHTML($output);
$mpdf->Output();
require(DIR_WS_INCLUDES . 'application_bottom.php');
