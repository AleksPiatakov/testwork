<?php

/* by solomono raid 2017 */

    $rootPath = dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))));
    chdir('../../../');

    require($rootPath . '/includes/application_top.php');

if (!empty($_POST['data'])) {
    $signature = base64_encode(sha1(MODULE_PAYMENT_LIQPAY_SECRET_KEY . $_POST['data'] . MODULE_PAYMENT_LIQPAY_SECRET_KEY, 1));
    $data_decoded = json_decode(base64_decode($_POST['data']));

    $check_id_query = tep_db_query('select orders_status from ' . TABLE_ORDERS . ' where orders_id = "' . $data_decoded->order_id . '"');
    $check_id = tep_db_fetch_array($check_id_query);
    $order_id = $data_decoded->order_id;
    $order_status = $check_id['orders_status'];

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

        tep_db_perform('orders_status_history', array('orders_id' => $order_id,
                                                    'orders_status_id' => $order_status,
                                                    'date_added' => 'now()',
                                                    'customer_notified' => '1'));
    }

    // if success - change order status to success:
    if ($_POST['signature'] == $signature and ($data_decoded->status == 'success' or $data_decoded->status == 'sandbox')) {
        $query = tep_db_query('SELECT orders_status_id FROM orders_status_history WHERE orders_status_id = "'.MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID.'" and orders_id = ' . (int)$order_id);
        if($query->num_rows == 0) { // якщо в історії нема статуса оплачено лікпей
            tep_db_perform('orders', ['orders_status' => MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID], 'update', "orders_id='" . $data_decoded -> order_id . "'");
            tep_db_perform('orders_status_history', [
                'orders_id' => $data_decoded -> order_id,
                'orders_status_id' => MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID,
                'date_added' => 'now()',
                'customer_notified' => '0',
                'comments' => 'LiqPAY - success!'
            ]);
            $email_order = 'Hello, ' . $customer_name . '.<br />Your order was successfully paid through Liqpay.';
            // to admin
            tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, 'Status for order #' . $order_id . ' - ' . strftime(DATE_FORMAT_LONG), nl2br($email_order), STORE_OWNER, $botname, '');
            // to customer
            tep_mail($customer_name, $order -> customer['email_address'], 'Status for order #' . $order_id . ' - ' . strftime(DATE_FORMAT_LONG), nl2br($email_order), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, '');
        }
        echo 'ok';
        die;
    }
}
