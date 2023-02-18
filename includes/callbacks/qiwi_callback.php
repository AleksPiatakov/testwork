<?php

// hash_hmac()

define('QIWI_CALLBACK_PAID', 'PAID');


$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
chdir('../../');
$skipLanguageRedirect = true;
require($rootPath . '/includes/application_top.php');

$json = file_get_contents('php://input');

$headers = getallheaders();
$callback = json_decode($json);

file_put_contents("qiwi_callback.log", var_export($headers, true) . PHP_EOL . var_export($callback, true) . PHP_EOL . PHP_EOL, FILE_APPEND);

/**
 * Function validate callbacks
 *
 * @param stdClass $callback
 * @param array $headers
 *
 * @return bool
 */
function isCallbackValid($callback, $headers)
{

    $bill = $callback->bill;
    $paymentParameters = $bill->amount->currency . "|" .
        $bill->amount->value . "|" .
        $bill->billId . "|" . $bill->siteId . "|" .
        $bill->status->value;

    $hash = hash_hmac('sha256', $paymentParameters, MODULE_PAYMENT_QIWI_SECRET_KEY);

    return $headers['X-Api-Signature-SHA256'] === $hash;
}


$isValid = isCallbackValid($callback, $headers);
$paymentStatus = $callback->bill->status->value;

file_put_contents("QIWI_HASHES.log", var_export($isValid, true) . PHP_EOL .
    var_export($paymentStatus, true) . PHP_EOL . QIWI_CALLBACK_PAID . PHP_EOL . PHP_EOL, FILE_APPEND);


if (
    isCallbackValid($callback, $headers) &&
    $callback->bill->status->value === QIWI_CALLBACK_PAID
) {
    $order_id = $callback->bill->billId;
    includeLanguages(DIR_WS_LANGUAGES . $language . '/checkout_process.php');
    includeLanguages(DIR_WS_LANGUAGES . $language . '/checkout.php');
    if (!class_exists('osC_onePageCheckout')) {
        require('includes/classes/onepage_checkout.php');
    }
    $onePageCheckout = new osC_onePageCheckout();
    // generate user data from database (table "orders"):
    $onePageCheckout->generateEmailByOrderId($order_id);

    // send message only once. if we send email, change customer_notified to 1.
    $check_status_query = tep_db_query('SELECT `orders_id` FROM ' . TABLE_ORDERS_STATUS_HISTORY . ' WHERE `customer_notified` = 1 AND `orders_id` = "' . $order_id . '"');
    if (tep_db_num_rows($check_status_query) == 0) {
        // for create emails:
        $onePageCheckout->createEmails($order_id);

        tep_db_perform('orders_status_history', [
            'orders_id'         => $order_id,
            'orders_status_id'  => $order_status,
            'date_added'        => 'now()',
            'customer_notified' => '1'
        ]);
    }

    // if success - change order status to success:

    tep_db_perform('orders', ['orders_status' => MODULE_PAYMENT_QIWI_ORDER_STATUS_ID], 'update', "orders_id='" . $order_id . "'");
    tep_db_perform('orders_status_history', [
        'orders_id'         => $order_id,
        'orders_status_id'  => MODULE_PAYMENT_QIWI_ORDER_STATUS_ID,
        'date_added'        => 'now()',
        'customer_notified' => '0',
        'comments'          => 'QIWI - success!'
    ]);

    // send email to customer:
    $payment_method = 'QIWI';
    includeLanguages(DIR_WS_LANGUAGES . $language . '/checkout_success.json');
    $subject = HEADING_TITLE . " #" . $this->order_id . " - " . STORE_NAME;
    $email_text = TEXT_THANKS_FOR_SHOPPING;

    if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
        require_once(DIR_FS_EXT . 'email_content/functions.php');
        $data = [
            'customers_name' => $customer_name,
            'order_id' => $order_id,
            'payment_method' => $payment_method,
        ];
        $content_email_array = getSuccessPaymentText($languages_id, $data);
        $email_text = $content_email_array['content_html'] ? : $email_text;
        $subject = $content_email_array['subject'] ? : $subject;
        $subject = sprintf($subject, $order_id, strftime(DATE_FORMAT_LONG));
    }

    tep_mail(
        $customer_name,
        $order->customer['email_address'],
        $subject,
        $email_text,
        STORE_OWNER,
        STORE_OWNER_EMAIL_ADDRESS
    );


    $_SESSION['callback'] = true;
    tep_redirect(HTTP_SERVER . '/' . FILENAME_CHECKOUT_SUCCESS);
}
