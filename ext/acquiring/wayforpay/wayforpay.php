<?php

class wayforpay
{
    var $code, $title, $description, $enabled;

// class constructor
    function __construct()
    {
        global $order;

        $this->code            = 'wayforpay';
        $this->title           = MODULE_PAYMENT_WAYFORPAY_TEXT_TITLE;
        $this->success_url     = HTTP_SERVER . '/' . FILENAME_CHECKOUT_SUCCESS;
        $this->failure_url     = HTTP_SERVER . '/' . FILENAME_CHECKOUT;
        $this->public_title    = MODULE_PAYMENT_WAYFORPAY_TEXT_PUBLIC_TITLE . (!isMobile() ? MODULE_PAYMENT_WAYFORPAY_IMAGES : '');
        $this->description     = MODULE_PAYMENT_WAYFORPAY_TEXT_ADMIN_DESCRIPTION;
        $this->icon            = DIR_WS_ICONS . 'wayforpay.png';
        $this->sort_order      = MODULE_PAYMENT_WAYFORPAY_SORT_ORDER;
        $this->enabled         = ((MODULE_PAYMENT_WAYFORPAY_STATUS == 'True') ? true : false);
        $this->form_action_url = 'https://secure.wayforpay.com/pay';
    }

    function selection()
    {

        global $cart_payment_id;

        if (!payment::isModuleAvailable()) {
            return false;
        }

        if (tep_session_is_registered('cart_payment_id')) {
            $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);

            $check_query = tep_db_query('select orders_id from ' . TABLE_ORDERS_STATUS_HISTORY . ' where orders_id = "' . (int)$order_id . '" limit 1');

            if (tep_db_num_rows($check_query) < 1) {
                tep_db_query('delete from ' . TABLE_ORDERS . ' where orders_id = "' . (int)$order_id . '"');
                tep_db_query('delete from ' . TABLE_ORDERS_TOTAL . ' where orders_id = "' . (int)$order_id . '"');
                tep_db_query('delete from ' . TABLE_ORDERS_STATUS_HISTORY . ' where orders_id = "' . (int)$order_id . '"');
                tep_db_query('delete from ' . TABLE_ORDERS_PRODUCTS . ' where orders_id = "' . (int)$order_id . '"');
                tep_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . ' where orders_id = "' . (int)$order_id . '"');
                tep_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_DOWNLOAD . ' where orders_id = "' . (int)$order_id . '"');

                tep_session_unregister('cart_payment_id');
            }
        }

        return [
            'id'     => $this->code,
            'sort'   => $this->sort_order,
            'module' => $this->public_title
        ];
    }

    function pre_confirmation_check()
    {
        global $cartID, $cart;

        if (empty($cart->cartID)) {
            $cartID = $cart->cartID = $cart->generate_cart_id();
        }
        if (!tep_session_is_registered('cartID')) {
            tep_session_register('cartID');
        }
    }

    function confirmation()
    {
        global $insert_id, $cartID, $cart_payment_id, $customer_id, $languages_id, $order, $order_total_modules, $onePageCheckout, $order_totals;

        if (tep_session_is_registered('cartID')) {
            $insert_order = false;

            if (tep_session_is_registered('cart_payment_id')) {
                $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);

                $curr_check = tep_db_query("select currency from " . TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
                $curr       = tep_db_fetch_array($curr_check);

                if (($curr['currency'] != $order->info['currency']) || ($cartID != substr($cart_payment_id, 0, strlen($cartID)))) {
                    $check_query = tep_db_query('select orders_id from ' . TABLE_ORDERS_STATUS_HISTORY . ' where orders_id = "' . (int)$order_id . '" limit 1');

                    if (tep_db_num_rows($check_query) < 1) {
                        tep_db_query('delete from ' . TABLE_ORDERS . ' where orders_id = "' . (int)$order_id . '"');
                        tep_db_query('delete from ' . TABLE_ORDERS_TOTAL . ' where orders_id = "' . (int)$order_id . '"');
                        tep_db_query('delete from ' . TABLE_ORDERS_STATUS_HISTORY . ' where orders_id = "' . (int)$order_id . '"');
                        tep_db_query('delete from ' . TABLE_ORDERS_PRODUCTS . ' where orders_id = "' . (int)$order_id . '"');
                        tep_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . ' where orders_id = "' . (int)$order_id . '"');
                        tep_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_DOWNLOAD . ' where orders_id = "' . (int)$order_id . '"');
                    }

                    $insert_order = true;
                }
            } else {
                $insert_order = true;
            }

            $onePageCheckout->loadSessionVars(); // ?????????????

            if (!isset($order_totals)) {
                $order_totals = $order_total_modules->process();
            }
            if ($insert_order == true) {
                $insert_id = $onePageCheckout->createOrder(MODULE_PAYMENT_WAYFORPAY_DEFAULT_ORDER_STATUS_ID);
            }
        }

        return array('title' => MODULE_PAYMENT_WAYFORPAY_TEXT_DESCRIPTION);
    }

    function process_button()
    {
        global $cart_payment_id, $order, $lng, $insert_id, $currencies, $language, $datePurchased;

        if (!empty($cart_payment_id)) {
            $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);
        } elseif (!empty($_SESSION['cart_payment_id'])) {
            $order_id = substr($_SESSION['cart_payment_id'], strpos($_SESSION['cart_payment_id'], '-') + 1);
        } else {
            $order_id = $insert_id;
        }

        $orderInfoQuery = tep_db_query("SELECT date_purchased FROM " . TABLE_ORDERS . " WHERE orders_id = '{$order_id}'");
        $orderRow       = tep_db_fetch_array($orderInfoQuery);
        $datePurchased  = strtotime($orderRow['date_purchased']);

        $_SESSION['complete_status'] = [MODULE_PAYMENT_WAYFORPAY_ORDER_STATUS_ID];

        $request = [
            "merchantAccount"      => MODULE_PAYMENT_WAYFORPAY_MERCHANT_ACCOUNT,
            "merchantAuthType"     => "SimpleSignature",
            "merchantDomainName"   => HTTP_SERVER,
            "merchantSignature"    => self::signature(),
            "orderReference"       => $order_id,
            "orderDate"            => $datePurchased,
            "serviceUrl"           => HTTP_SERVER . '/includes/callbacks/wayforpay_callback.php',
            "returnUrl"            => $this->success_url,
            "amount"               => (float)$order->info['total'],
            "currency"             => $order->info['currency'],
            "orderTimeout"         => "49000",
            "clientFirstName"      => $order->customer['firstname'],
            "clientLastName"       => $order->customer['lastname'],
            "clientAddress"        => $order->customer['address'],
            "clientCity"           => $order->customer['city'],
            "clientEmail"          => $order->customer['email_address'],
            "defaultPaymentSystem" => "card",
        ];


        $form = "";
        foreach ($request as $requestKey => $requestValue) {
            $form .= tep_draw_hidden_field($requestKey, $requestValue);
        }

        $fields = ['name' => 'productName', 'final_price' => 'productPrice', 'qty' => 'productCount'];
        foreach ($fields as $field => $inputName) {
            foreach ($order->products as $product) {
                $form .= '<input type="hidden" name="' . $inputName . '[]" value="' . $product[$field] . '">';
            }
        }

        return $form;
    }

    function before_process()
    {

        global $customer_id, $order, $order_totals, $sendto, $billto, $languages_id, $payment, $currencies, $cart, $paymentMethod, $wishList, $cart_payment_id, $$payment, $payment_modules, $onePageCheckout, $order_total_modules, $products_ordered, $guest_account;

        if (!empty($cart_payment_id)) {
            $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);
        } else {
            $order_id = $insert_id;
        }
    }

    function after_process()
    {
        return false;
    }

    function output_error()
    {
        return false;
    }


    function check()
    {
        if (!isset($this->_check)) {
            $check_query  = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_WAYFORPAY_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    static function install()
    {

        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Allow WayForPay module', 'MODULE_PAYMENT_WAYFORPAY_STATUS', 'True', 'Allow WayForPay module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('WayForPay Merchant Account', 'MODULE_PAYMENT_WAYFORPAY_MERCHANT_ACCOUNT', '', 'public key', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('WayForPay secret key', 'MODULE_PAYMENT_WAYFORPAY_PASSWORD', '', 'secret key', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order', 'MODULE_PAYMENT_WAYFORPAY_SORT_ORDER', '0', 'Sort order', '6', '3', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Success status', 'MODULE_PAYMENT_WAYFORPAY_ORDER_STATUS_ID', '0', 'Success status', '6', '6', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Default status', 'MODULE_PAYMENT_WAYFORPAY_DEFAULT_ORDER_STATUS_ID', '0', 'Default status', '6', '6', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }

    // merchantAccount, merchantDomainName, orderReference, orderDate, amount, currency, productName[0], productName[1]..., productName[n], productCount[0], productCount[1],..., productCount[n], productPrice[0], productPrice[1],..., productPrice[n]  ??????????? ?;? (????? ? ???????) ? ????????? UTF-8
    static function signature()
    {
        global $cart_payment_id, $order, $lng, $insert_id, $currencies, $language, $datePurchased;

        if (!empty($cart_payment_id)) {
            $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);
        } elseif (!empty($_SESSION['cart_payment_id'])) {
            $order_id = substr($_SESSION['cart_payment_id'], strpos($_SESSION['cart_payment_id'], '-') + 1);
        } else {
            $order_id = $insert_id;
        }

        $toImplode = [
            MODULE_PAYMENT_WAYFORPAY_MERCHANT_ACCOUNT,
            HTTP_SERVER,
            $order_id,
            $datePurchased,
            (float)$order->info['total'],
            $order->info['currency']
        ];

        $fields = ['name', 'qty', 'final_price'];
        foreach ($fields as $field) {
            foreach ($order->products as $product) {
                $toImplode[] = $product[$field];
            }
        }

        $string = implode(";", $toImplode);

        return hash_hmac("md5", $string, MODULE_PAYMENT_WAYFORPAY_PASSWORD);
    }

    static function keys()
    {
        return [
            'MODULE_PAYMENT_WAYFORPAY_STATUS',
            'MODULE_PAYMENT_WAYFORPAY_MERCHANT_ACCOUNT',
            'MODULE_PAYMENT_WAYFORPAY_PASSWORD',
            'MODULE_PAYMENT_WAYFORPAY_SORT_ORDER',
            'MODULE_PAYMENT_WAYFORPAY_ORDER_STATUS_ID',
            'MODULE_PAYMENT_WAYFORPAY_DEFAULT_ORDER_STATUS_ID'
        ];
    }
}
