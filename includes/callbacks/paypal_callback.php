<?php
/* by solomono raid 2017 */

$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
chdir('../../');
$skipLanguageRedirect = true;
require($rootPath . '/includes/application_top.php');
includeLanguages(DIR_WS_LANGUAGES . $language . '/modules/payment/paypal.json');

\App\Logger\Log::channel('payment')->info('payment/callback/paypal', [
    "payload" => var_export($_POST, true),
    "sandbox" => MODULE_PAYMENT_PAYPAL_SANDBOX_STATUS,
]);


if (!class_exists('paypal')) {
    require_once DIR_WS_MODULES . 'payment/paypal.php';
}

$paypal = new paypal();

$isRequestVerified = false;
try {
    \App\Logger\Log::channel('payment')->info("Try to verify IPN for order {$_POST['invoice']}");
    $isRequestVerified = $paypal->verifyIPN();
} catch (Exception $e) {
    \App\Logger\Log::error("Verification for order {$_POST['invoice']} is failed.", [
        "error" => $e->getMessage()
    ]);
}

$order_id = $_POST['invoice'];

if (!empty($_POST['payment_status']) && $isRequestVerified) {
    $check_id_query = tep_db_query('select orders_id, orders_status from ' . TABLE_ORDERS . ' where orders_id = "' . $order_id . '"');
    $check_id       = tep_db_fetch_array($check_id_query);
    $order_status   = $check_id['orders_status'];

    includeLanguages(DIR_WS_LANGUAGES . $language . '/checkout_process.php');
    includeLanguages(DIR_WS_LANGUAGES . $language . '/checkout.php');
    require('includes/classes/onepage_checkout.php');
    $onePageCheckout = new osC_onePageCheckout();
    // generate user data from database (table "orders"):
    $onePageCheckout->generateEmailByOrderId($order_id);

    // send message only once. if we send email, change customer_notified to 1.
    $check_status_query = tep_db_query('select orders_id from ' . TABLE_ORDERS_STATUS_HISTORY . ' where customer_notified = 1 and orders_id = "' . $order_id . '"');
    if (tep_db_num_rows($check_status_query) == 0) {
        // for create emails:
        $onePageCheckout->createEmails($order_id);

        tep_db_perform('orders_status_history', [
            'orders_id'         => $order_id,
            'orders_status_id'  => $order_status,
            'date_added'        => 'now()',
            'customer_notified' => '1',
        ]);
    }

    if ($newStatus = $paypal->recognizeStatus($_POST['payment_status'])) {
        tep_db_perform(
            'orders',
            ['orders_status' => $newStatus],
            'update',
            "orders_id='" . $order_id . "'"
        );
        tep_db_perform('orders_status_history', [
            'orders_id'         => $order_id,
            'orders_status_id'  => $newStatus,
            'date_added'        => 'now()',
            'customer_notified' => '0',
            'comments'          => 'PayPal - ' . $_POST['payment_status'] . '!',
        ]);

        // send email to customer:
        $email_order = 'Hello, ' . $customer_name . '.<br />Your order was successfully paid through PayPal.';
        $cart->reset();
        tep_mail(
            $customer_name,
            $order->customer['email_address'],
            'Status for order #' . $order_id . ' - ' . strftime(DATE_FORMAT_LONG),
            nl2br($email_order),
            STORE_OWNER,
            STORE_OWNER_EMAIL_ADDRESS,
            ''
        );
    }
}
