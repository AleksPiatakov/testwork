<?php

$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
chdir('../../');
$skipLanguageRedirect = true;
require $rootPath . '/includes/application_top.php';
includeLanguages($rootPath . "/" . DIR_WS_LANGUAGES . $language . '/checkout_process.php');
includeLanguages($rootPath . "/" . DIR_WS_LANGUAGES . $language . '/checkout.php');
includeLanguages($rootPath . "/" . DIR_WS_LANGUAGES . $language . "/modules/payment/sage_pay_form.php");
require $rootPath . "/includes/modules/payment/sage_pay_form.php";
$_paymentMethod = new sage_pay_form();

$callback = true;
$_paymentMethod->before_process();
$insert_id = $_paymentMethod->after_process(true);

if (mb_strtolower($sage_pay_response['Status']) === 'ok' && $insert_id) {
    if (empty($onePageCheckout) || !class_exists('osC_onePageCheckout')) {
        require('includes/classes/onepage_checkout.php');
        $onePageCheckout = new osC_onePageCheckout();
    }
    if (empty($order)) {
        $onePageCheckout->generateEmailByOrderId($insert_id);
    }
    $onePageCheckout->createEmails($insert_id);
}

clear_order_sessions($insert_id);
