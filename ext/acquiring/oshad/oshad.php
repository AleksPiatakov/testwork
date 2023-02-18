<?php

class oshad
{
    var $code, $title, $description, $enabled;

    // class constructor
    function __construct()
    {
        global $order;

        $this->code = 'oshad';
        $this->title = MODULE_PAYMENT_OSHAD_TEXT_TITLE;
        $this->public_title = MODULE_PAYMENT_OSHAD_TEXT_PUBLIC_TITLE . (!isMobile() ? MODULE_PAYMENT_OSHAD_IMAGES : '');
        $this->description = MODULE_PAYMENT_OSHAD_TEXT_ADMIN_DESCRIPTION;
        $this->icon = DIR_WS_ICONS . 'oshad.png';
        $this->sort_order = MODULE_PAYMENT_OSHAD_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_OSHAD_STATUS == 'True') ? true : false);
        $this->merchant_id = (int)MODULE_PAYMENT_OSHAD_MID;//30000073;
        $this->terminal_id = (int)MODULE_PAYMENT_OSHAD_TID;//30000073;
        $this->merchant_name = trim(MODULE_PAYMENT_OSHAD_MERCHANT_NAME);//'PHILIPSTEST';
        if (is_object($order)) {
            $this->mac_key = $this->xorMacKeys();
        }
        if (MODULE_PAYMENT_OSHAD_TEST_MODE_STATUS == 'True') {
            $this->form_action_url = 'https://3ds-test.oschadbank.ua/cgi-bin/cgi_link';
        } else {
            $this->form_action_url = 'https://3ds.oschadbank.ua/cgi-bin/cgi_link'; //prod
        }
        if (is_object($order)) {
            $this->update_status();
        }
    }

    // class methods

    private function xorMacKeys()
    {
        return bin2hex(
            pack('H*', MODULE_PAYMENT_OSHAD_FIRST_SECRET_KEY) ^ pack('H*', MODULE_PAYMENT_OSHAD_SECOND_SECRET_KEY)
        );
    }

    function update_status()
    {
        global $order;

        if (
            $this->enabled == true &&
            (int)getConstantValue('MODULE_PAYMENT_OSHAD_ZONE', 0) > 0 &&
            getConstantValue('ACCOUNT_COUNTRY') == 'true' && getConstantValue('ACCOUNT_STATE') == 'true'
        ) {
            $check_flag = false;
            $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int)MODULE_PAYMENT_OSHAD_ZONE . "' and zone_country_id = '" . (int)$order->billing['country']['id'] . "' order by zone_id");
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
        global $insert_id, $cartID, $cart_payment_id, $customer_id, $languages_id, $order, $order_total_modules, $onePageCheckout, $order_totals;

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

            $onePageCheckout->loadSessionVars(); // reinsurance

            if (!isset($order_totals)) {
                $order_totals = $order_total_modules->process();
            }
            if ($insert_order == true) {
                $insert_id = $onePageCheckout->createOrder(8);
            }
        }

        return array('title' => MODULE_PAYMENT_OSHAD_TEXT_DESCRIPTION);
    }

    function process_button()
    {
        global $cart_payment_id, $order, $lng, $insert_id;
        if (CARDS_ENABLED == 'true') {
            if (!empty($cart_payment_id)) {
                $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);
            } elseif (!empty($_SESSION['cart_payment_id'])) {
                $order_id = substr($_SESSION['cart_payment_id'], strpos($_SESSION['cart_payment_id'], '-') + 1);
            } else {
                $order_id = $insert_id;
            }
            $data_array = [
                'AMOUNT' => number_format($order->info['total'], 2, '.', ''),
                'CURRENCY' => $order->info['currency'],
                'ORDER' => (int)$order_id,
                'DESC' => (int)$order_id,
                'MERCH_NAME' => $this->merchant_name,
                'MERCH_URL' => HTTP_SERVER . '/',
                'MERCHANT' => $this->merchant_id,
                'TERMINAL' => $this->terminal_id,
                'EMAIL' => STORE_OWNER_EMAIL_ADDRESS,
                'TRTYPE' => 0,
                'COUNTRY' => 'UA',
                'MERCH_GMT' => date('I') ? '+2' : '+3',
                'TIMESTAMP' => gmdate('YmdHis', time()),
                'NONCE' => $this->nonce(16),
                'BACKREF' => tep_href_link('includes/callbacks/oshad_callback.php', '', 'SSL')
            ];
            $data_array['P_SIGN'] = $this->makePSign($data_array);
            //echo "<pre>";
            //var_dump($data_array);die;

            $_SESSION['complete_status'] = [MODULE_PAYMENT_OSHAD_ORDER_STATUS_ID];
            $return = [];
            foreach ($data_array as $key => $item) {
                $return[] = '<input type="hidden" name="' . $key . '" value="' . $item . '">';
            }
            return implode($return);
        }
    }

    private function nonce($num_bytes)
    {

        return bin2hex(openssl_random_pseudo_bytes($num_bytes));
    }

    private function makePSign($data)
    {
        $mac_string = '';
        foreach ($data as $datum) {
            if (empty($datum) && $datum !== 0) {
                $mac_string .= '-';
            } else {
                $mac_string .= mb_strlen($datum) . $datum;
            }
        }
        $key = pack("H*", $this->mac_key);
        return hash_hmac('sha1', $mac_string, $key);
    }

    function before_process()
    {

        global $customer_id, $order, $order_totals, $sendto, $billto, $languages_id, $payment, $currencies, $cart, $paymentMethod, $wishList, $cart_payment_id, $$payment, $payment_modules, $onePageCheckout, $order_total_modules, $products_ordered, $guest_account;

        if (!empty($cart_payment_id)) {
            $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);
        } else {
            $order_id = $insert_id;
        }

        // sending emails:
        //if(!isset($order_totals)) $order_totals = $order_total_modules->process();
        //$onePageCheckout->createEmails($order_id);
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
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_OSHAD_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    static function install()
    {

        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Включить модуль?', 'MODULE_PAYMENT_OSHAD_STATUS', 'True', '', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Тестовый режим', 'MODULE_PAYMENT_OSHAD_TEST_MODE_STATUS', 'True', 'Тестовый режим?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant ID', 'MODULE_PAYMENT_OSHAD_MID', '', 'Merchant ID.', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Terminal ID', 'MODULE_PAYMENT_OSHAD_TID', '', 'Terminal ID.', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant name', 'MODULE_PAYMENT_OSHAD_MERCHANT_NAME', '', 'Merchant name.', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('MAC key первая часть', 'MODULE_PAYMENT_OSHAD_FIRST_SECRET_KEY', '0', 'MAC key первая часть', '6', '5', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('MAC key вторая часть', 'MODULE_PAYMENT_OSHAD_SECOND_SECRET_KEY', '0', 'MAC key вторая часть', '6', '5', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order', 'MODULE_PAYMENT_OSHAD_SORT_ORDER', '0', 'Sort order.', '6', '3', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zone', 'MODULE_PAYMENT_OSHAD_ZONE', '0', 'Zone.', '6', '4', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Paid order status', 'MODULE_PAYMENT_OSHAD_ORDER_STATUS_ID', '0', 'Paid order status', '6', '6', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    static function keys()
    {
        return array(
            'MODULE_PAYMENT_OSHAD_STATUS',
            'MODULE_PAYMENT_OSHAD_TEST_MODE_STATUS',
            'MODULE_PAYMENT_OSHAD_MID',
            'MODULE_PAYMENT_OSHAD_TID',
            'MODULE_PAYMENT_OSHAD_MERCHANT_NAME',
            'MODULE_PAYMENT_OSHAD_SORT_ORDER',
            'MODULE_PAYMENT_OSHAD_ZONE',
            'MODULE_PAYMENT_OSHAD_FIRST_SECRET_KEY',
            'MODULE_PAYMENT_OSHAD_SECOND_SECRET_KEY',
            'MODULE_PAYMENT_OSHAD_ORDER_STATUS_ID'
        );
    }
}
