<?php
$skipLanguageRedirect = true;
$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
chdir('../../');
require($rootPath . '/includes/application_top.php');
require($rootPath . '/includes/classes/Fondy/Signature.php');

Signature::merchant(MODULE_PAYMENT_FONDY_ID);
Signature::password(MODULE_PAYMENT_FONDY_PASSWORD);

if (!empty($_POST) && Signature::check($_POST)) {
    $order_id = $_POST['order_id'];

    $order_status_query = tep_db_query("SELECT orders_status 
                                        FROM " . TABLE_ORDERS . "
                                        WHERE orders_id = '" . (int) $order_id . "'");
    $order_status    = tep_db_fetch_array($order_status_query);
    $order_status_id = $order_status['orders_status'];

    includeLanguages(DIR_WS_LANGUAGES . $language . '/checkout_process.php');
    includeLanguages(DIR_WS_LANGUAGES . $language . '/checkout.php');
    if (!class_exists('osC_onePageCheckout')) {
        require('includes/classes/onepage_checkout.php');
    }

    $onePageCheckout = new osC_onePageCheckout();
    // generate user data from database (table "orders"):
    $onePageCheckout->generateEmailByOrderId($order_id);

    // send message only once. if we send email, change customer_notified to 1.
    $check_status_query = tep_db_query('SELECT `orders_id` 
                                        FROM ' . TABLE_ORDERS_STATUS_HISTORY . ' 
                                        WHERE `customer_notified` = 1 
                                          AND `orders_id` = "' . $order_id . '"');

    if (!tep_db_num_rows($check_status_query)) {
        // for create emails:
        $onePageCheckout->createEmails($order_id);

        tep_db_perform('orders_status_history', [
            'orders_id'         => $order_id,
            'orders_status_id'  => $order_status_id,
            'date_added'        => 'now()',
            'customer_notified' => '1'
        ]);
    }

    if ($_POST['order_status'] == 'approved') {
        // if success - change order status to success:
        tep_db_perform('orders', ['orders_status' => MODULE_PAYMENT_FONDY_ORDER_STATUS_ID], 'update', "orders_id='" . $order_id . "'");

        tep_db_perform('orders_status_history', [
            'orders_id'         => $order_id,
            'orders_status_id'  => MODULE_PAYMENT_FONDY_ORDER_STATUS_ID,
            'date_added'        => 'now()',
            'customer_notified' => '1',
            'comments'          => 'Fondy - success!'
        ]);

        // send email to customer:
        $payment_method = 'Fondy';
        includeLanguages(DIR_WS_LANGUAGES . $language . '/checkout_success.json');
        $subject = HEADING_TITLE . " #" . $order_id . " - " . STORE_NAME;
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
    }

    $_SESSION['callback'] = true;
    exit('ok');
}
