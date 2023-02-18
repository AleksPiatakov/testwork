<?php

class liqpay
{
    var $code, $title, $description, $enabled;

// class constructor
    function __construct()
    {
        global $order;

        $this->code = 'liqpay';
        $this->title = MODULE_PAYMENT_LIQPAY_TEXT_TITLE;
        $this->public_title = MODULE_PAYMENT_LIQPAY_TEXT_PUBLIC_TITLE . (!isMobile() ? MODULE_PAYMENT_LIQPAY_IMAGES : '');
        $this->description = MODULE_PAYMENT_LIQPAY_TEXT_ADMIN_DESCRIPTION;
        $this->icon = DIR_WS_ICONS . 'liqpay.png';
        $this->sort_order = MODULE_PAYMENT_LIQPAY_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_LIQPAY_STATUS == 'True') ? true : false);
        $this->form_action_url = 'https://www.liqpay.ua/api/3/checkout';

        if (is_object($order)) {
            $this->update_status();
        }
    }

// class methods
    function update_status()
    {
        global $order;

        if (
            $this->enabled == true &&
            (int)getConstantValue('MODULE_PAYMENT_LIQPAY_ZONE', 0) > 0 &&
            getConstantValue('ACCOUNT_COUNTRY') == 'true' && getConstantValue('ACCOUNT_STATE') == 'true'
        ) {
            $check_flag = false;
            $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int)MODULE_PAYMENT_LIQPAY_ZONE . "' and zone_country_id = '" . (int)$order->billing['country']['id'] . "' order by zone_id");
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

        return array('title' => MODULE_PAYMENT_LIQPAY_TEXT_DESCRIPTION);
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

            $data_array = array(
                'public_key' => MODULE_PAYMENT_LIQPAY_ID,
                'version' => '3',
                'action' => 'pay',
                'amount' => $order->info['total'],
                'currency' => $order->info['currency'],
                'description' => 'Order #' . $order_id,
                'order_id' => $order_id,
                'language' => $lng->language['code'],
                //  'paytypes'=>'card',  //'paytypes'=>'card,privat24',
                'result_url' => addHostnameToLink(tep_href_link(FILENAME_CHECKOUT, '', 'SSL')),
                'server_url' => addHostnameToLink(tep_href_link('ext/acquiring/liqpay/liqpay_callback.php', '', 'SSL')),
                'sandbox' => '0'
            );


            $data = base64_encode(json_encode($data_array));
            $signature = base64_encode(sha1(MODULE_PAYMENT_LIQPAY_SECRET_KEY . $data . MODULE_PAYMENT_LIQPAY_SECRET_KEY, 1));

            $_SESSION['complete_status'] = [MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID];

            return '<input type="hidden" name="data" value="' . $data . '" />
                <input type="hidden" name="signature" value="' . $signature . '" />';
        }
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
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_LIQPAY_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    static function install()
    {

        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Allow LiqPAY', 'MODULE_PAYMENT_LIQPAY_STATUS', 'True', 'Allow LiqPAY?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant ID', 'MODULE_PAYMENT_LIQPAY_ID', '', 'Merchant ID.', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order', 'MODULE_PAYMENT_LIQPAY_SORT_ORDER', '0', 'Sort order.', '6', '3', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zone', 'MODULE_PAYMENT_LIQPAY_ZONE', '0', 'Zone.', '6', '4', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant password', 'MODULE_PAYMENT_LIQPAY_SECRET_KEY', '0', 'Merchant password', '6', '5', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Paid order status', 'MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID', '7', 'Paid order status', '6', '6', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Default order status', 'MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID', '0', 'Default order status', '6', '6', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    static function keys()
    {
        return array(
            'MODULE_PAYMENT_LIQPAY_STATUS',
            'MODULE_PAYMENT_LIQPAY_ID',
            'MODULE_PAYMENT_LIQPAY_SORT_ORDER',
            'MODULE_PAYMENT_LIQPAY_ZONE',
            'MODULE_PAYMENT_LIQPAY_SECRET_KEY',
            'MODULE_PAYMENT_LIQPAY_ORDER_STATUS_ID',
            'MODULE_PAYMENT_LIQPAY_DEFAULT_ORDER_STATUS_ID'
        );
    }
}

if (!function_exists('addHostnameToLink')) {
    function addHostnameToLink($link)
    {
        return strstr($link, HTTP_SERVER) ? $link : HTTP_SERVER . (substr($link, 0, 1) === '/' ? $link : '/' . $link);
    }
}
