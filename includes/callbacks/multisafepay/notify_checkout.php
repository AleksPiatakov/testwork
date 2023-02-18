<?php

/**
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the MultiSafepay plugin
 * to newer versions in the future. If you wish to customize the plugin for your
 * needs please document your changes and make backups before you update.
 *
 * @category    MultiSafepay
 * @package     Connect
 * @author      TechSupport <techsupport@multisafepay.com>
 * @copyright   Copyright (c) 2017 MultiSafepay, Inc. (http://www.multisafepay.com)
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
 * PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
 * ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

chdir(__DIR__ . "/../../../");
$skipLanguageRedirect = true;
require("includes/application_top.php");

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PROCESS);

\App\Logger\Log::channel('all')->info("Receive {$_GET['type']} request for order {$_GET['transactionid']}");

if (isset($_GET['type']) && $_GET['type'] == 'initial') {
    $initial_request = true;
} else {
    $initial_request = false;
}

if (empty($_GET['transactionid'])) {
    $message = "No transaction ID supplied";
    \App\Logger\Log::error($message);
    $url = tep_href_link(FILENAME_CHECKOUT, 'payment_error=' . $payment_module->code . '&error=' . urlencode($message), 'NONSSL', true, false);
} else {
    require(DIR_WS_CLASSES . "payment.php");
    $payment_modules = new payment("multisafepay");
    $payment_module = $GLOBALS[$payment_modules->selected_module];

    require(DIR_WS_CLASSES . "order.php");
    $order = new order($_GET['transactionid']);
    $order_id = (int) $_GET['transactionid'];

    $order_status_query = tep_db_query("SELECT orders_status_id FROM " . TABLE_ORDERS_STATUS . " WHERE orders_status_name = '" . $order->info['orders_status'] . "' AND language_id = '" . $languages_id . "'");
    $order_status = tep_db_fetch_array($order_status_query);
    $order->info['order_status'] = $order_status['orders_status_id'];

    require(DIR_WS_CLASSES . "order_total.php");
    $order_total_modules = new order_total();

    $customer_id = $order->customer['id'];
    $order_totals = $order->totals;

    $payment_module->order_id = $_GET['transactionid'];

    if (method_exists($payment_module, "check_transaction")) {
        $transdata = $payment_module->check_transaction();

        if ($transdata->fastcheckout == 'NO') {
            $status = $payment_module->checkout_notify();
        } else {
            $payment_modules = new payment("multisafepay_fastcheckout");
            $payment_module = $GLOBALS[$payment_modules->selected_module];
            $status = $payment_module->checkout_notify();
        }
    }

    if ($payment_module->_customer_id) {
        $hash = $payment_module->get_hash($payment_module->order_id, $payment_module->_customer_id);
        $parameters = 'customer_id=' . $payment_module->_customer_id . '&hash=' . $hash;
    }

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

    $checkStatus = tep_db_fetch_array($check_status_query);
    $order_status_id = $order->info['order_status'];

    \App\Logger\Log::channel('all')->info("Customer is notified {times} for order {$order_id}", [
        'times' => tep_db_num_rows($check_status_query)
    ]);

    if ($checkStatus) {
        \App\Logger\Log::channel('all')->info("Send email confirmation for order {$order_id}", [
            'times' => tep_db_num_rows($check_status_query)
        ]);

        // for create emails:
        $onePageCheckout->createEmails($order_id);

        tep_db_perform('orders_status_history', [
            'orders_id'         => $order_id,
            'orders_status_id'  => $order_status_id,
            'date_added'        => 'now()',
            'customer_notified' => '1'
        ]);
    }

    switch ($status) {
        case "initialized":
        case "completed":
            $message = "OK";
            $url = addHostnameToLink(tep_href_link("ext/modules/payment/multisafepay/success.php", $parameters, 'NONSSL'));
            break;
        default:
            $message = "OK";
            $url = addHostnameToLink(tep_href_link(FILENAME_CHECKOUT, 'payment_error=' . $payment_module->code . '&error=' . urlencode($status), 'NONSSL', true, false));
    }
}

if ($initial_request) {
    echo "<p><a href=\"" . $url . "\">" . sprintf(MODULE_PAYMENT_MULTISAFEPAY_TEXT_RETURN_TO_SHOP, htmlspecialchars(STORE_NAME)) . "</a></p>";
} else {
    header("Content-type: text/plain");
    echo $message;
}
