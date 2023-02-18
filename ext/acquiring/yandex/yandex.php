<?php

class yandex
{
    var $code, $title, $description, $enabled;

    function __construct()
    {
        global $order;
        $this->code = 'yandex';
        $this->title = MODULE_PAYMENT_YANDEX_TEXT_TITLE;
        $this->success_url = HTTP_SERVER . '/' . FILENAME_CHECKOUT_SUCCESS;
        $this->failure_url = HTTP_SERVER . '/' . FILENAME_CHECKOUT;
        $this->public_title = MODULE_PAYMENT_YANDEX_TEXT_PUBLIC_TITLE . (!isMobile() ? MODULE_PAYMENT_YANDEX_IMAGES : '');
        $this->description = MODULE_PAYMENT_YANDEX_TEXT_ADMIN_DESCRIPTION;
        $this->icon = DIR_WS_ICONS . 'paypal.png';
        $this->sort_order = MODULE_PAYMENT_YANDEX_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_YANDEX_STATUS == 'True') ? true : false);
        $this->form_action_url = 'https://money.yandex.ru/quickpay/confirm.xml';
//        $this->form_action_url = 'https://demomoney.yandex.ru/quickpay/confirm.xml'; // demo payment api
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

        if (tep_not_null($this->icon)) {
            $icon = tep_image($this->icon, $this->title);
        }

        return array('id' => $this->code,
                         'icon' => $icon,
                         'sort' => $this->sort_order,
                   'module' => $this->public_title);
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

            $onePageCheckout->loadSessionVars(); // перестраховка

            if (!isset($order_totals)) {
                $order_totals = $order_total_modules->process();
            }
            if ($insert_order == true) {
                $insert_id = $onePageCheckout->createOrder(8);
            }
        }

        return array('title' => MODULE_PAYMENT_YANDEX_TEXT_DESCRIPTION);
    }

    function process_button()
    {
        global $cart_payment_id, $order, $lng, $insert_id, $currencies,$language;

        if (!empty($cart_payment_id)) {
            $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);
        } elseif (!empty($_SESSION['cart_payment_id'])) {
            $order_id = substr($_SESSION['cart_payment_id'], strpos($_SESSION['cart_payment_id'], '-') + 1);
        } else {
            $order_id = $insert_id;
        }

          $_SESSION['complete_status'] = [MODULE_PAYMENT_YANDEX_ORDER_STATUS_ID];

          return '<input type="hidden" name="receiver" value="' . MODULE_PAYMENT_YANDEX_ID . '">
                  <input type="hidden" name="formcomment" value="Транзакция ' . $order_id . '">
                  <input type="hidden" name="label" value="' . $order_id . '">
                  <input type="hidden" name="quickpay-form" value="shop">
                  <input type="hidden" name="targets" value="Транзакция ' . $order_id . '">
                  <input type="hidden" name="sum" value="' . round($order->info['total'], 2) . '" data-type="number">
                  <input name="successURL" value="' . $this->success_url . '" type="hidden">
                  <input type="hidden" name="comment" value="Транзакция ' . $order_id . '">
                  <input type="hidden" name="paymentType" value="PC">';

          return  '<input name="payee_id" value="' . MODULE_PAYMENT_YANDEX_ID . '" type="hidden">
                   <input name="shop_order_number" value="' . $order_id . '" type="hidden">
                   <input name="bill_amount" value="' . $order->info['total'] . '" type="hidden">
                   <input name="description" value="Описание заказа" type="hidden">
                   <input name="successURL" value="' . $this->success_url . '" type="hidden">
                   <input name="failure_url" value="' . $this->failure_url . '" type="hidden">
                   <input name="lang" value="' . $lng->language['code'] . 'type="hidden">';
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
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_YANDEX_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    static function install()
    {
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `set_function`, `date_added`) VALUES ('Allow yandex module', 'MODULE_PAYMENT_YANDEX_STATUS', 'True', '', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('yandex wallet number', 'MODULE_PAYMENT_YANDEX_ID', '', '', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('yandex secret word', 'MODULE_PAYMENT_YANDEX_SECRET_WORD', '', '', '6', '2', now())");
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `date_added`) VALUES ('Sort order', 'MODULE_PAYMENT_YANDEX_SORT_ORDER', '0', '', '6', '3', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Success status', 'MODULE_PAYMENT_YANDEX_ORDER_STATUS_ID', '0', '', '6', '6', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }

    static function keys()
    {
        return array(
          'MODULE_PAYMENT_YANDEX_STATUS',
          'MODULE_PAYMENT_YANDEX_ID',
          'MODULE_PAYMENT_YANDEX_SECRET_WORD',
          'MODULE_PAYMENT_YANDEX_ORDER_STATUS_ID',
          'MODULE_PAYMENT_YANDEX_SORT_ORDER'
        );
    }
}
