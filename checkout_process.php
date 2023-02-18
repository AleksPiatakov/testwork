<?php

if (!is_object($lng)) {
    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language();
}

if (isset($_GET['language']) && tep_not_null($_GET['language'])) {
    $lng->set_language($_GET['language']);
} else {
    $lng->get_browser_language();
}

$language = $lng->language['directory'];

includeLanguages(DIR_WS_LANGUAGES . $language . '/checkout_process.php');

$onePageCheckout = new osC_onePageCheckout();
$onePageCheckout->loadSessionVars();

//  $payment_modules->before_process();

// Order creating in DB:
//if(!isset($order_totals)) $order_totals = $order_total_modules->process();
$insert_id = $onePageCheckout->createOrder($order->info['order_status']);
if (isset($cart)) {
    $cart->reset();
}
// sending emails, session deleting, redirect to checkout success:
$onePageCheckout->createEmails($insert_id);
$_SESSION['allowCheckoutSuccessPageId'] = $insert_id;
// clear sessions:
clear_order_sessions($insert_id);
tep_redirect(FILENAME_CHECKOUT_SUCCESS . '?order_id=' . $insert_id);

require(DIR_WS_INCLUDES . 'application_bottom.php');
