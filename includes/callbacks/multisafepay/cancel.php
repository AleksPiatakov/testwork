<?php

/**
 * DISCLAIMER
 * Do not edit or add to this file if you wish to upgrade the MultiSafepay plugin
 * to newer versions in the future. If you wish to customize the plugin for your
 * needs please document your changes and make backups before you update.
 * @category    MultiSafepay
 * @package     Connect
 * @author      TechSupport <techsupport@multisafepay.com>
 * @copyright   Copyright (c) 2017 MultiSafepay, Inc. (http://www.multisafepay.com)
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
 * PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
 * ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

if (isset($_GET['transactionid'])) {
    chdir(__DIR__ . "/../../../");
    $skipLanguageRedirect = true;
    require("includes/application_top.php");

    require(DIR_WS_CLASSES . "payment.php");
    $payment_modules = new payment("multisafepay");
    $payment_module = $GLOBALS[$payment_modules->selected_module];

    $orderTransactionId = (int)$_GET['transactionid'];

    require(DIR_WS_CLASSES . "order.php");
    $order = new order($orderTransactionId);

    \App\Logger\Log::channel('payment')->info("Cancel transaction {$orderTransactionId}. Back to checkout page");

    $order_status_query = tep_db_query("SELECT orders_status_id FROM " . TABLE_ORDERS_STATUS . " WHERE orders_status_name = '" .
        $order->info['orders_status'] . "' AND language_id = '" . $languages_id . "'");
    $order_status = tep_db_fetch_array($order_status_query);
    $order->info['order_status'] = $order_status['orders_status_id'];

    require(DIR_WS_CLASSES . "order_total.php");
    $order_total_modules = new order_total();

    $customer_id = $order->customer['id'];
    $order_totals = $order->totals;

    $payment_module->order_id = $orderTransactionId;
    $transdata = $payment_module->checkout_notify();

    tep_redirect($payment_module->_href_link(FILENAME_CHECKOUT, '', 'SSL', false, false));
}
