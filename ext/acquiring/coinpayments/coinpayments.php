<?php

class coinpayments
{
    var $code, $title, $description, $enabled;

// class constructor
    function __construct()
    {
        global $order;

        $this->signature = 'coinpayments|coinpayments|1.0|2.2';

        $this->code = 'coinpayments';
        $this->title = MODULE_PAYMENT_COINPAYMENTS_TEXT_TITLE;
        $this->public_title = MODULE_PAYMENT_COINPAYMENTS_TEXT_PUBLIC_TITLE;
        $this->description = MODULE_PAYMENT_COINPAYMENTS_TEXT_DESCRIPTION;
        $this->icon = DIR_WS_ICONS . 'coinpayments.png';
        $this->sort_order = MODULE_PAYMENT_COINPAYMENTS_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_COINPAYMENTS_STATUS == 'True') ? true : false);

        if ((int)MODULE_PAYMENT_COINPAYMENTS_PREPARE_ORDER_STATUS_ID > 0) {
            $this->order_status = MODULE_PAYMENT_COINPAYMENTS_PREPARE_ORDER_STATUS_ID;
        }

        $this->form_action_url = 'https://www.coinpayments.net/index.php';

        if (is_object($order)) {
            $this->update_status();
        }
    }

// class methods
    function update_status()
    {
        global $order;

        if (($this->enabled == true) && ((int)MODULE_PAYMENT_COINPAYMENTS_ZONE > 0)) {
            $check_flag = false;
            $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int)MODULE_PAYMENT_COINPAYMENTS_ZONE . "' and zone_country_id = '" . (int)$order->billing['country']['id'] . "' order by zone_id");
            while ($check = tep_db_fetch_array($check_query)) {
                if ($check['zone_id'] < 1) {
                    $check_flag = true;
                    break;
                } elseif ($check['zone_id'] == $order->billing['zone_id']) {
                    $check_flag = true;
                    break;
                }
            }

            if ($check_flag == false) {
                $this->enabled = false;
            }
        }
    }

    function javascript_validation()
    {
        return false;
    }

    function selection()
    {
        global $cart_payment_id;

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

        if (tep_not_null($this->icon)) {
            $icon = tep_image($this->icon, $this->title);
        }

        return array(
            'id' => $this->code,
            'icon' => $icon,
            'sort' => $this->sort_order,
            'module' => $this->public_title
        );
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
        global $insert_id, $cartID, $cart_payment_id, $order, $order_total_modules, $onePageCheckout, $order_totals;


        if (tep_session_is_registered('cartID')) {
            $insert_order = false;

            if (tep_session_is_registered('cart_payment_id')) {
                $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);

                $curr_check = tep_db_query("select currency from " . TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
                $curr = tep_db_fetch_array($curr_check);

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

            $onePageCheckout->loadSessionVars(); // перестраховка

            if (!isset($order_totals)) {
                $order_totals = $order_total_modules->process();
            }
            if ($insert_order == true) {
                $insert_id = $onePageCheckout->createOrder(MODULE_PAYMENT_COINPAYMENTS_PREPARE_ORDER_STATUS_ID);
            }
        }

        return array('title' => MODULE_PAYMENT_COINPAYMENTS_TEXT_DESCRIPTION);
    }

    function process_button()
    {
        global $cart_payment_id, $customer_id, $order, $sendto, $currency;


        $process_button_string = '';
        $parameters = array(
            'cmd' => '_pay',
            'reset' => '1',
            'item_name' => STORE_NAME,
            'shippingf' => $this->format_raw($order->info['shipping_cost']),
            'taxf' => $this->format_raw($order->info['tax']),
            'merchant' => MODULE_PAYMENT_COINPAYMENTS_MERCHANT,
            'amountf' => $this->format_raw($order->info['total'] - $order->info['shipping_cost'] - $order->info['tax']),
            'currency' => $currency,
            'invoice' => substr($cart_payment_id, strpos($cart_payment_id, '-') + 1),
            'custom' => $customer_id,
            'allow_extra' => '0',
            'email' => $order->customer['email_address'],
            'ipn_url' => addHostnameToLink(tep_href_link('ext/acquiring/coinpayments/coinpayments_callback.php', '', 'SSL', false, false)),
            'success_url' => addHostnameToLink(tep_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL')),
            'cancel_url' => addHostnameToLink(tep_href_link(FILENAME_CHECKOUT, '', 'SSL')),
        );

        if (is_numeric($sendto) && ($sendto > 0)) {
            $parameters['first_name'] = $order->delivery['firstname'];
            $parameters['last_name'] = $order->delivery['lastname'];
            $parameters['address1'] = $order->delivery['street_address'];
            $parameters['city'] = $order->delivery['city'];
            $parameters['state'] = tep_get_zone_code($order->delivery['country']['id'], $order->delivery['zone_id'], $order->delivery['state']);
            $parameters['zip'] = $order->delivery['postcode'];
            $parameters['country'] = $order->delivery['country']['iso_code_2'];
        } else {
            $parameters['first_name'] = $order->billing['firstname'];
            $parameters['last_name'] = $order->billing['lastname'];
            $parameters['address1'] = $order->billing['street_address'];
            $parameters['city'] = $order->billing['city'];
            $parameters['state'] = tep_get_zone_code($order->billing['country']['id'], $order->billing['zone_id'], $order->billing['state']);
            $parameters['zip'] = $order->billing['postcode'];
            $parameters['country'] = $order->billing['country']['iso_code_2'];
        }

        reset($parameters);
        while (list($key, $value) = each($parameters)) {
            $process_button_string .= tep_draw_hidden_field($key, $value);
        }

        return $process_button_string;
    }

    function before_process()
    {
        global $order, $insert_id, $payment, $cart, $cart_payment_id, $$payment;

        if (!empty($cart_payment_id)) {
            $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);
        } else {
            $order_id = $insert_id;
        }
//
//        $check_query = tep_db_query("select orders_status from " . TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
//        if (tep_db_num_rows($check_query)) {
//            $check = tep_db_fetch_array($check_query);
//
//            if ($check['orders_status'] == MODULE_PAYMENT_COINPAYMENTS_PREPARE_ORDER_STATUS_ID) {
//                $sql_data_array = array(
//                    'orders_id' => $order_id,
//                    'orders_status_id' => MODULE_PAYMENT_COINPAYMENTS_PREPARE_ORDER_STATUS_ID,
//                    'date_added' => 'now()',
//                    'customer_notified' => '0',
//                    'comments' => ''
//                );
//
//                tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
//            }
//        }
//
//        tep_db_query("update " . TABLE_ORDERS . " set orders_status = '" . (MODULE_PAYMENT_COINPAYMENTS_ORDER_STATUS_ID > 0 ? (int)MODULE_PAYMENT_COINPAYMENTS_ORDER_STATUS_ID : (int)DEFAULT_ORDERS_STATUS_ID) . "', last_modified = now() where orders_id = '" . (int)$order_id . "'");
//
//        $sql_data_array = array(
//            'orders_id' => $order_id,
//            'orders_status_id' => (MODULE_PAYMENT_COINPAYMENTS_ORDER_STATUS_ID > 0 ? (int)MODULE_PAYMENT_COINPAYMENTS_ORDER_STATUS_ID : (int)DEFAULT_ORDERS_STATUS_ID),
//            'date_added' => 'now()',
//            'customer_notified' => (SEND_EMAILS == 'true') ? '1' : '0',
//            'comments' => $order->info['comments']
//        );
//
//        tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
//
//        for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
//            // Stock Update
//            if (STOCK_LIMITED == 'true') {
//                if (DOWNLOAD_ENABLED == 'true') {
//                    $stock_query_raw = "SELECT products_quantity, pad.products_attributes_filename
//                                FROM " . TABLE_PRODUCTS . " p
//                                LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES . " pa
//                                ON p.products_id=pa.products_id
//                                LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
//                                ON pa.products_attributes_id = pad.products_attributes_id
//                                WHERE p.products_id = '" . tep_get_prid($order->products[$i]['id']) . "'";
//                    // Will work with only one option for downloadable products
//                    // otherwise, we have to build the query dynamically with a loop
//                    $products_attributes = $order->products[$i]['attributes'];
//                    if (is_array($products_attributes)) {
//                        $stock_query_raw .= " AND pa.options_id = '" . $products_attributes[0]['option_id'] . "' AND pa.options_values_id = '" . $products_attributes[0]['value_id'] . "'";
//                    }
//                    $stock_query = tep_db_query($stock_query_raw);
//                } else {
//                    $stock_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
//                }
//                if (tep_db_num_rows($stock_query) > 0) {
//                    $stock_values = tep_db_fetch_array($stock_query);
//                    // do not decrement quantities if products_attributes_filename exists
//                    if ((DOWNLOAD_ENABLED != 'true') || (!$stock_values['products_attributes_filename'])) {
//                        $stock_left = $stock_values['products_quantity'] - $order->products[$i]['qty'];
//                    } else {
//                        $stock_left = $stock_values['products_quantity'];
//                    }
//                    tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . $stock_left . "' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
//                    if (($stock_left < 1) && (STOCK_ALLOW_CHECKOUT == 'false')) {
//                        tep_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
//                    }
//                }
//            }
//
//            // Update products_ordered (for bestsellers list)
//            tep_db_query("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . sprintf('%d', $order->products[$i]['qty']) .
//                " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
//        }

        // load the after_process function from the payment modules
        $this->after_process();

        $cart->reset(true);

        // unregister session variables used during checkout
        tep_session_unregister('sendto');
        tep_session_unregister('billto');
        tep_session_unregister('shipping');
        tep_session_unregister('payment');
        tep_session_unregister('comments');

        tep_session_unregister('cart_payment_id');
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
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_COINPAYMENTS_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    static function install()
    {
        //add statuses
        $check_query = tep_db_query("select orders_status_id from " . TABLE_ORDERS_STATUS . " where orders_status_name = 'Preparing [CoinPayments.net]' limit 1");

        if (tep_db_num_rows($check_query) < 1) {
            $status_query = tep_db_query("select max(orders_status_id) as status_id from " . TABLE_ORDERS_STATUS);
            $status = tep_db_fetch_array($status_query);

            $status_id = $status['status_id'] + 1;

            $languages = tep_get_languages();

            foreach ($languages as $lang) {
                tep_db_query("insert into " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) values ('" . $status_id . "', '" . $lang['id'] . "', 'Preparing [CoinPayments.net]')");
            }

            $flags_query = tep_db_query("describe " . TABLE_ORDERS_STATUS . " public_flag");
            if (tep_db_num_rows($flags_query) == 1) {
                tep_db_query("update " . TABLE_ORDERS_STATUS . " set public_flag = 0 and downloads_flag = 0 where orders_status_id = '" . $status_id . "'");
            }
        } else {
            $check = tep_db_fetch_array($check_query);

            $status_id = $check['orders_status_id'];
        }

        $check_query = tep_db_query("select orders_status_id from " . TABLE_ORDERS_STATUS . " where orders_status_name = 'Complete [CoinPayments.net]' limit 1");

        if (tep_db_num_rows($check_query) < 1) {
            $status_query = tep_db_query("select max(orders_status_id) as status_id from " . TABLE_ORDERS_STATUS);
            $status = tep_db_fetch_array($status_query);

            $status2_id = $status['status_id'] + 1;

            $languages = tep_get_languages();

            foreach ($languages as $lang) {
                tep_db_query("insert into " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) values ('" . $status2_id . "', '" . $lang['id'] . "', 'Complete [CoinPayments.net]')");
            }

            $flags_query = tep_db_query("describe " . TABLE_ORDERS_STATUS . " public_flag");
            if (tep_db_num_rows($flags_query) == 1) {
                tep_db_query("update " . TABLE_ORDERS_STATUS . " set public_flag = 0 and downloads_flag = 0 where orders_status_id = '" . $status2_id . "'");
            }
        } else {
            $check = tep_db_fetch_array($check_query);

            $status2_id = $check['orders_status_id'];
        }

        //add params
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable CoinPayments.net Payments', 'MODULE_PAYMENT_COINPAYMENTS_STATUS', 'False', 'Do you want to accept CoinPayments.net payments?', '6', '3', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Merchant ID', 'MODULE_PAYMENT_COINPAYMENTS_MERCHANT', '', 'Your Coinpayments.net Merchant ID (You can find it on the My Account page)', '6', '4', now())");
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('IPN Secret', 'MODULE_PAYMENT_COINPAYMENTS_IPN_SECRET', '', 'Your IPN Secret (Set on the Edit Settings page on CoinPayments.net)', '6', '4', now())");
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort order of display.', 'MODULE_PAYMENT_COINPAYMENTS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Payment Zone', 'MODULE_PAYMENT_COINPAYMENTS_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Preparing Order Status', 'MODULE_PAYMENT_COINPAYMENTS_PREPARE_ORDER_STATUS_ID', '" . $status_id . "', 'Set the status of prepared orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Completed Order Status', 'MODULE_PAYMENT_COINPAYMENTS_ORDER_STATUS_ID', '" . $status2_id . "', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Debug E-Mail Address', 'MODULE_PAYMENT_COINPAYMENTS_DEBUG_EMAIL', '', 'All parameters of an Invalid IPN notification will be sent to this email address if one is entered.', '6', '4', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }

    static function keys()
    {
        return array(
            'MODULE_PAYMENT_COINPAYMENTS_STATUS',
            'MODULE_PAYMENT_COINPAYMENTS_MERCHANT',
            'MODULE_PAYMENT_COINPAYMENTS_IPN_SECRET',
            'MODULE_PAYMENT_COINPAYMENTS_ZONE',
            'MODULE_PAYMENT_COINPAYMENTS_PREPARE_ORDER_STATUS_ID',
            'MODULE_PAYMENT_COINPAYMENTS_ORDER_STATUS_ID',
            'MODULE_PAYMENT_COINPAYMENTS_DEBUG_EMAIL',
            'MODULE_PAYMENT_COINPAYMENTS_SORT_ORDER'
        );
    }

// format prices without currency formatting
    function format_raw($number, $currency_code = '', $currency_value = '')
    {
        global $currencies, $currency;

        if (empty($currency_code) || !$this->is_set($currency_code)) {
            $currency_code = $currency;
        }

        if (empty($currency_value) || !is_numeric($currency_value)) {
            $currency_value = $currencies->currencies[$currency_code]['value'];
        }

        return number_format(tep_round($number * $currency_value,
            $currencies->currencies[$currency_code]['decimal_places']),
            $currencies->currencies[$currency_code]['decimal_places'], '.', '');
    }
}