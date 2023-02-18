<?php

/**
 * Function validate Yandex callback
 *
 * @link https://yandex.ru/dev/money/doc/payment-buttons/reference/notifications-docpage/
 *
 * @param array $callbackData Callback details
 * @return bool
 */
function isValidPaymentCallback($callbackData)
{
    $s = "&";
    $toHash = $callbackData['notification_type'] . $s . $callbackData['operation_id'] . $s .
              $callbackData['amount'] . $s . $callbackData['currency'] . $s . $callbackData['datetime'] .
              $callbackData['sender'] . $s . $callbackData['codepro'] . $s . MODULE_PAYMENT_YANDEX_SECRET_WORD .
              $s . $callbackData['label'];

    $hash = hash("sha1", $toHash);

    return $hash === $callbackData["sha1_hash"];
}

$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
chdir('../../');
$skipLanguageRedirect = true;
require($rootPath . '/includes/application_top.php');
includeLanguages(DIR_WS_LANGUAGES . $language . '/checkout_process.php');
includeLanguages(DIR_WS_LANGUAGES . $language . '/checkout.php');
if (!class_exists('osC_onePageCheckout')) {
    require('includes/classes/onepage_checkout.php');
}

if (!empty($_POST) && isValidPaymentCallback($_POST)) {
    $order_id = $_POST['label'];

    $onePageCheckout = new osC_onePageCheckout();
    // generate user data from database (table "orders"):
    $onePageCheckout->generateEmailByOrderId($order_id);

    // send message only once. if we send email, change customer_notified to 1.
    $check_status_query = tep_db_query('SELECT `orders_id` 
                                        FROM ' . TABLE_ORDERS_STATUS_HISTORY . ' 
                                        WHERE `customer_notified` = 1 
                                          AND `orders_id` = "' . $order_id . '"');
    if (tep_db_num_rows($check_status_query) == 0) {
        // for create emails:
        $onePageCheckout->createEmails($order_id);

        tep_db_perform('orders_status_history', [
            'orders_id' => $order_id,
            'orders_status_id' => $order_status,
            'date_added' => 'now()',
            'customer_notified' => '1'
        ]);
    }

    // if success - change order status to success:

    tep_db_perform('orders', ['orders_status' => MODULE_PAYMENT_YANDEX_ORDER_STATUS_ID], 'update', "orders_id='" . $order_id . "'");
    tep_db_perform('orders_status_history', [
        'orders_id' => $order_id,
        'orders_status_id' => MODULE_PAYMENT_YANDEX_ORDER_STATUS_ID,
        'date_added' => 'now()',
        'customer_notified' => '0',
        'comments' => 'Yandex - success!'
    ]);

    // send email to customer:
    $payment_method = 'Yandex';
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

    tep_mail($customer_name, $order->customer['email_address'], $subject, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);


    $_SESSION['callback'] = true;
    tep_redirect(HTTP_SERVER . '/' . FILENAME_CHECKOUT_SUCCESS);
}
