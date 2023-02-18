<?php

function validateCallback($obj)
{
    //merchantAccount, orderReference, amount, currency, authCode, cardPan, transactionStatus, reasonCode
    $toImplode = [
        $obj['merchantAccount'],
        $obj['orderReference'],
        $obj['amount'],
        $obj['currency'],
        $obj['authCode'],
        $obj['cardPan'],
        $obj['transactionStatus'],
        $obj['reasonCode'],
    ];

    $string = implode(";", $toImplode);
    $hash = hash_hmac("md5", $string, MODULE_PAYMENT_WAYFORPAY_PASSWORD);

    return $obj['merchantSignature'] == $hash;
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
if (!class_exists("order")) {
    require($rootPath . '/includes/classes/order.php');
}

$json = file_get_contents('php://input');
$obj = json_decode($json, true);

file_put_contents("__wayforpay.log", date("c") . PHP_EOL . var_export($obj, true) . PHP_EOL . PHP_EOL, FILE_APPEND);

if (!empty($obj) && validateCallback($obj)) {
    $order_id = $obj['orderReference'];

    $order = new order($order_id);
    $datePurchased = strtotime($order->info['date_purchased']);

    require($rootPath . '/includes/modules/payment/wayforpay.php');
    $signature = wayforpay::signature();


    $order_status_query = tep_db_query("SELECT orders_status 
                                        FROM " . TABLE_ORDERS . "
                                        WHERE orders_id = '" . (int) $order_id . "'");
    $order_status    = tep_db_fetch_array($order_status_query);
    $order_status_id = $order_status['orders_status'];
    
    $order_status_query = tep_db_query("SELECT orders_status_id
                                        FROM " . TABLE_ORDERS_STATUS_HISTORY . "
                                        WHERE orders_id = " . (int) $order_id . " AND orders_status_id = ".MODULE_PAYMENT_WAYFORPAY_ORDER_STATUS_ID);
    if($order_status_query->num_rows){ //если уже было оплачено way for pay для этого заказа - то выход
        echo 'OK';
        die;
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

    if ($obj['transactionStatus'] == 'Approved') {
        // if success - change order status to success:
        tep_db_perform('orders', ['orders_status' => MODULE_PAYMENT_WAYFORPAY_ORDER_STATUS_ID], 'update', "orders_id='" . $order_id . "'");

        tep_db_perform('orders_status_history', [
            'orders_id'         => $order_id,
            'orders_status_id'  => MODULE_PAYMENT_WAYFORPAY_ORDER_STATUS_ID,
            'date_added'        => 'now()',
            'customer_notified' => '1',
            'comments'          => 'WayForPay - success!'
        ]);

        // send email to customer:
        $payment_method = 'Fondy';
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
    }

    $now = time();
    header('Content-Type: application/json');
    echo json_encode([
        'orderReference' => $obj['orderReference'],
        'status'         => 'accept',
        'time'           => $now,
        'signature' => hash_hmac('md5', $obj['orderReference'] . ';accept;' . $now, MODULE_PAYMENT_WAYFORPAY_PASSWORD)
    ]);
    die;

//    $_SESSION['callback'] = true;
//    tep_redirect(HTTP_SERVER . '/' . FILENAME_CHECKOUT_SUCCESS);
}
