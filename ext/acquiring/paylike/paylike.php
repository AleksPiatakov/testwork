<?php

class paylike
{
    var $code, $enabled, $app, $response, $key, $appKey, $sort_order, $redirect_url, $success_url, $title, $formTitle, $paymentType;


    // class constructor
    function __construct()
    {
        global $order;

        $this->code = 'paylike';
        $this->redirect_url = HTTP_SERVER . '/includes/callbacks/paylike_callback.php';
        $this->sort_order = MODULE_PAYMENT_PAYLIKE_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_PAYLIKE_STATUS == 'True') ? true : false);
        $this->key = MODULE_PAYMENT_PAYLIKE_TRANSACTION_MODE == 'Test' ? MODULE_PAYMENT_PAYLIKE_TEST_KEY : MODULE_PAYMENT_PAYLIKE_KEY;
        $this->appKey = MODULE_PAYMENT_PAYLIKE_TRANSACTION_MODE == 'Test' ? MODULE_PAYMENT_PAYLIKE_TEST_APP_KEY : MODULE_PAYMENT_PAYLIKE_APP_KEY;
        $this->title = MODULE_PAYMENT_PAYLIKE_TEXT_TITLE;
        $this->formTitle = $_SESSION['PAYLIKE_TITLE'] = defined('MODULE_PAYMENT_PAYLIKE_TITLE') ? MODULE_PAYMENT_PAYLIKE_TITLE : 'MODULE_PAYMENT_PAYLIKE_TITLE';
        $this->paymentType = defined('MODULE_PAYMENT_PAYLIKE_PAYMENT_TYPE') ? MODULE_PAYMENT_PAYLIKE_PAYMENT_TYPE : 'MODULE_PAYMENT_PAYLIKE_PAYMENT_TYPE';
    }

    function selection()
    {
        global $cart_payment_id, $order;

        if (!payment::isModuleAvailable()) {
            return false;
        }

        if (tep_session_is_registered('cart_payment_id')) {
            $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);

            $check_query = tep_db_query('SELECT `orders_id` FROM ' . TABLE_ORDERS_STATUS_HISTORY . ' WHERE `orders_id` = "' . (int)$order_id . '" LIMIT 1');

            if (tep_db_num_rows($check_query) < 1) {
                tep_db_query('DELETE FROM ' . TABLE_ORDERS . ' WHERE `orders_id` = "' . (int)$order_id . '"');
                tep_db_query('delete from ' . TABLE_ORDERS_TOTAL . ' where orders_id = "' . (int)$order_id . '"');
                tep_db_query('delete from ' . TABLE_ORDERS_STATUS_HISTORY . ' where orders_id = "' . (int)$order_id . '"');
                tep_db_query('DELETE FROM ' . TABLE_ORDERS_PRODUCTS . ' WHERE `orders_id` = "' . (int)$order_id . '"');
                tep_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . ' where orders_id = "' . (int)$order_id . '"');
                tep_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_DOWNLOAD . ' where orders_id = "' . (int)$order_id . '"');

                tep_session_unregister('cart_payment_id');
            }
        }

        if (tep_not_null($this->icon)) {
            $icon = tep_image($this->icon, $this->title);
        }
        ob_start();
        require_once(DIR_WS_MODULES . 'paylike.php');
        $scripts = ob_get_clean();
        if ($order->info["payment_method"] === 'paylike') {
            $scripts = '<script src="https://sdk.paylike.io/3.js"></script>
                        <script src="' .  DIR_WS_JAVASCRIPT . 'paylike.js' . '"></script>' . $scripts;
        }
        $title = $this->title;
        $title .= (!isMobile() ? MODULE_PAYMENT_PAYLIKE_IMAGES : '');
        return [
            'id' => $this->code,
            'icon' => $icon,
            'fields' => [
                [
                    'title' => '',
                    'field' => $scripts,
                ]
            ],
            'sort' => $this->sort_order,
            'module' => $title
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
                        tep_db_query('DELETE FROM ' . TABLE_ORDERS_PRODUCTS . ' WHERE `orders_id` = "' . (int)$order_id . '"');
                        tep_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . ' where orders_id = "' . (int)$order_id . '"');
                        tep_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_DOWNLOAD . ' where orders_id = "' . (int)$order_id . '"');
                    }

                    $insert_order = true;
                }
            } else {
                $insert_order = true;
            }
            if (class_exists('osC_onePageCheckout')) {
                $onePageCheckout->loadSessionVars(); // ??????????????????????????
            }
            if (!isset($order_totals)) {
                $order_totals = $order_total_modules->process();
            }
            if ($insert_order) {
                if (class_exists('osC_onePageCheckout')) {
//                    $insert_id = $onePageCheckout->createOrder(MODULE_PAYMENT_PAYLIKE_ORDER_STATUS_ID);
                } else {
                    $this->createOrder();
                }
            }
        }
        ob_start();
        require_once(DIR_WS_MODULES . 'paylike.php');
        $scripts = ob_get_clean();
        return ['title' => MODULE_PAYMENT_PAYLIKE_TEXT_DESCRIPTION,'fields' => [
            [
                'title' => '',
                'field' => $scripts,
            ]
        ],];
    }

    function createOrder()
    {
        global $insert_id, $cartID, $cart_payment_id, $order, $customer_id, $order_total_modules, $onePageCheckout, $order_totals;
        $order_totals = [];
        if (is_array($order_total_modules->modules)) {
            reset($order_total_modules->modules);
            foreach ($order_total_modules->modules as $key => $value) {
            // while (list (, $value) = each($order_total_modules->modules)) {
                $class = substr($value, 0, strrpos($value, '.'));
                if ($GLOBALS[$class]->enabled) {
                    for ($i = 0, $n = sizeof($GLOBALS[$class]->output); $i < $n; $i++) {
                        if (tep_not_null($GLOBALS[$class]->output[$i]['title']) && tep_not_null($GLOBALS[$class]->output[$i]['text'])) {
                            $order_totals[] = [
                                'code' => $GLOBALS[$class]->code,
                                'title' => $GLOBALS[$class]->output[$i]['title'],
                                'text' => $GLOBALS[$class]->output[$i]['text'],
                                'value' => $GLOBALS[$class]->output[$i]['value'],
                                'sort_order' => $GLOBALS[$class]->sort_order
                            ];
                        }
                    }
                }
            }
        }

        $sql_data_array = [
            'customers_id' => $customer_id,
            'customers_name' => $order->customer['firstname'] . ' ' . $order->customer['lastname'],
            'customers_company' => $order->customer['company'],
            'customers_street_address' => $order->customer['street_address'],
            'customers_suburb' => $order->customer['suburb'],
            'customers_city' => $order->customer['city'],
            'customers_postcode' => $order->customer['postcode'],
            'customers_state' => $order->customer['state'],
            'customers_country' => $order->customer['country']['title'],
            'customers_telephone' => $order->customer['telephone'],
            'customers_email_address' => $order->customer['email_address'],
            'customers_address_format_id' => $order->customer['format_id'],
            'delivery_name' => $order->delivery['firstname'] . ' ' . $order->delivery['lastname'],
            'delivery_company' => $order->delivery['company'],
            'delivery_street_address' => $order->delivery['street_address'],
            'delivery_suburb' => $order->delivery['suburb'],
            'delivery_city' => $order->delivery['city'],
            'delivery_postcode' => $order->delivery['postcode'],
            'delivery_state' => $order->delivery['state'],
            'delivery_country' => $order->delivery['country']['title'],
            'delivery_address_format_id' => $order->delivery['format_id'],
            'billing_name' => $order->billing['firstname'] . ' ' . $order->billing['lastname'],
            'billing_company' => $order->billing['company'],
            'billing_street_address' => $order->billing['street_address'],
            'billing_suburb' => $order->billing['suburb'],
            'billing_city' => $order->billing['city'],
            'billing_postcode' => $order->billing['postcode'],
            'billing_state' => $order->billing['state'],
            'billing_country' => $order->billing['country']['title'],
            'billing_address_format_id' => $order->billing['format_id'],
            'payment_method' => $order->info['payment_method'],
            'cc_type' => $order->info['cc_type'],
            'cc_owner' => $order->info['cc_owner'],
            'cc_number' => $order->info['cc_number'],
            'cc_expires' => $order->info['cc_expires'],
            'date_purchased' => 'now()',
            'orders_status' => $order->info['order_status'],
            'currency' => $order->info['currency'],
            'currency_value' => $order->info['currency_value']
        ];

        tep_db_perform(TABLE_ORDERS, $sql_data_array);

        $insert_id = tep_db_insert_id();

        for ($i = 0, $n = sizeof($order_totals); $i < $n; $i++) {
            $sql_data_array = [
                'orders_id' => $insert_id,
                'title' => $order_totals[$i]['title'],
                'text' => $order_totals[$i]['text'],
                'value' => $order_totals[$i]['value'],
                'class' => $order_totals[$i]['code'],
                'sort_order' => $order_totals[$i]['sort_order']
            ];

            tep_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);
        }

        for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
            $sql_data_array = [
                'orders_id' => $insert_id,
                'products_id' => tep_get_prid($order->products[$i]['id']),
                'products_model' => $order->products[$i]['model'],
                'products_name' => $order->products[$i]['name'],
                'products_price' => $order->products[$i]['price'],
                'final_price' => $order->products[$i]['final_price'],
                'products_tax' => $order->products[$i]['tax'],
                'products_quantity' => $order->products[$i]['qty']
            ];

            tep_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array);

            $order_products_id = tep_db_insert_id();

            $attributes_exist = '0';
            if (isset($order->products[$i]['attributes'])) {
                $attributes_exist = '1';
                for ($j = 0, $n2 = sizeof($order->products[$i]['attributes']); $j < $n2; $j++) {
                    if (DOWNLOAD_ENABLED == 'true') {
                        $attributes_query = "select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount , pad.products_attributes_filename
                                       from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                                       left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                                       on pa.products_attributes_id=pad.products_attributes_id
                                       where pa.products_id = '" . $order->products[$i]['id'] . "'
                                       and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "'
                                       and pa.options_id = popt.products_options_id
                                       and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "'
                                       and pa.options_values_id = poval.products_options_values_id
                                       and popt.language_id = '" . $languages_id . "'
                                       and poval.language_id = '" . $languages_id . "'";
                        $attributes = tep_db_query($attributes_query);
                    } else {
                        $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $order->products[$i]['id'] . "' and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . $languages_id . "' and poval.language_id = '" . $languages_id . "'");
                    }
                    $attributes_values = tep_db_fetch_array($attributes);

                    $sql_data_array = [
                        'orders_id' => $insert_id,
                        'orders_products_id' => $order_products_id,
                        'products_options' => $attributes_values['products_options_name'],
                        'products_options_values' => $attributes_values['products_options_values_name'],
                        'options_values_price' => $attributes_values['options_values_price'],
                        'price_prefix' => $attributes_values['price_prefix']
                    ];

                    tep_db_perform(TABLE_ORDERS_PRODUCTS_ATTRIBUTES, $sql_data_array);

                    if ((DOWNLOAD_ENABLED == 'true') && isset($attributes_values['products_attributes_filename']) && tep_not_null($attributes_values['products_attributes_filename'])) {
                        $sql_data_array = [
                            'orders_id' => $insert_id,
                            'orders_products_id' => $order_products_id,
                            'orders_products_filename' => $attributes_values['products_attributes_filename'],
                            'download_maxdays' => $attributes_values['products_attributes_maxdays'],
                            'download_count' => $attributes_values['products_attributes_maxcount']
                        ];

                        tep_db_perform(TABLE_ORDERS_PRODUCTS_DOWNLOAD, $sql_data_array);
                    }
                }
            }
        }

        $cart_inpay_Standard_ID = $cartID . '-' . $insert_id;
        tep_session_register('cart_inpay_Standard_ID');
    }

    function process_button()
    {
        global $order;
//        $order->info['order_status'] = MODULE_PAYMENT_PAYLIKE_ORDER_STATUS_ID;
        return '<span id="payLikeCheckout" type="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-primary" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-check"></span><span class="ui-button-text">' . IMAGE_BUTTON_CONFIRM_ORDER . '</span></span>' . '<style>form[name=checkout_confirmation] [id*=tdb]{display: none;}</style>';
    }

    function javascript_validation()
    {
        return false;
    }

    function before_process()
    {

        global $order_id, $insert_id, $cart_payment_id;

        if (!empty($cart_payment_id)) {
            $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);
        } else {
            $order_id = $insert_id;
        }
    }

    function after_process()
    {
        global $insert_id, $order, $order_totals;
        if ($this->paymentType === 'Instant') {
            if (isset($_SESSION['paylikeId'])) {
                $transactionId = $_SESSION['paylikeId'];
                $descriptor = "Order #$insert_id capture";

                $paylike = new \Paylike\Paylike($this->appKey);
                $amount = end($order_totals);
                $apps = $paylike->transactions();
                $apps->capture($transactionId, [
                    'amount' => (float)number_format($amount['value'] * $order->info['currency_value'], 2, '.', '') * 100,
                    'currency' => $order->info['currency'],
                    'descriptor' => $descriptor
                ]);
                tep_db_query("INSERT INTO `orders_status_history` SET `comments`='PAYLIKE CAPTURE',`date_added`=now(), `orders_status_id`='7',`orders_id`='{$insert_id}'");
                tep_db_query("UPDATE `orders` SET  `orders_status`=" . MODULE_PAYMENT_PAYLIKE_ORDER_STATUS_ID . " WHERE `orders_id`='{$insert_id}'");
            }
        } else {
            $check_query = tep_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYLIKE_ORDER_TO_TRANSACTION'");
            $value = tep_db_fetch_array($check_query)['configuration_value'];
            $o2t = (array)json_decode($value);
            $o2t[$insert_id] = $_SESSION['paylikeId'];
            tep_db_query("UPDATE " . TABLE_CONFIGURATION . "  SET configuration_value = '" . json_encode($o2t) . "'WHERE configuration_key = 'MODULE_PAYLIKE_ORDER_TO_TRANSACTION'");
        }
        return false;
    }

    function output_error()
    {
        return false;
    }

    function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYLIKE_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    function get_order_total($order_id)
    {
        $sql = "SELECT value FROM " . TABLE_ORDERS_TOTAL . " WHERE class = 'ot_total' and orders_id = '{$order_id}'";
        $query = tep_db_query($sql);
        $value = tep_db_fetch_array($query)['value'];
        return $value;
    }

    function get_currency_info($order_id)
    {
        $sql = "SELECT currency,currency_value FROM " . TABLE_ORDERS . " WHERE orders_id = '{$order_id}'";
        $query = tep_db_query($sql);
        $currency = tep_db_fetch_array($query);
        return $currency;
    }

    function manual_status_update($status_id, $order_id)
    {

        if ($status_id == MODULE_PAYMENT_PAYLIKE_ORDER_STATUS_ID) {
            $o2t = json_decode(MODULE_PAYLIKE_ORDER_TO_TRANSACTION, true);
            if (!empty($o2t[$order_id])) {
                $transactionId = $o2t[$order_id];
                $descriptor = "Order #$order_id capture";

                $paylike = new \Paylike\Paylike($this->appKey);

                $amount = $this->get_order_total($order_id);
                $currency = $this->get_currency_info($order_id);
                $apps = $paylike->transactions();
                try {
                    $apps->capture($transactionId, [
                        'amount' => (float)number_format($amount * $currency['currency_value'], 2, '.', '') * 100,
                        'currency' => $currency['currency'],
                        'descriptor' => $descriptor
                    ]);
                } catch (Exception $e) {
                    // catch error and write to db
                    $error = 'Capture error: ' . $e->getMessage();
                    tep_db_query("INSERT INTO " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, comments) VALUES ($order_id,1,NOW(),'$error')");
                    return false;
                }
                //if capture without errors, we remove transaction id from db
                unset($o2t[$order_id]);
                tep_db_query("UPDATE " . TABLE_CONFIGURATION . "  SET configuration_value = '" . json_encode($o2t) . "'WHERE configuration_key = 'MODULE_PAYLIKE_ORDER_TO_TRANSACTION'");
                return true;
            }
        }
    }

    static function install()
    {
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `set_function`, `date_added`) VALUES ('Allow Paylike module', 'MODULE_PAYMENT_PAYLIKE_STATUS', 'True', '', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `set_function`, `date_added`) VALUES ('Paylike payment type', 'MODULE_PAYMENT_PAYLIKE_PAYMENT_TYPE', 'Delayed', '', '6', '1', 'tep_cfg_select_option(array(\'Instant\', \'Delayed\'), ', now())");
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `set_function`, `date_added`) VALUES ('Paylike transaction mode', 'MODULE_PAYMENT_PAYLIKE_TRANSACTION_MODE', 'Test', '', '6', '1', 'tep_cfg_select_option(array(\'Live\', \'Test\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Live mode key', 'MODULE_PAYMENT_PAYLIKE_KEY', '', '', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Live mode app key', 'MODULE_PAYMENT_PAYLIKE_APP_KEY', '', '', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Test mode key', 'MODULE_PAYMENT_PAYLIKE_TEST_KEY', '', '', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Test mode app key', 'MODULE_PAYMENT_PAYLIKE_TEST_APP_KEY', '', '', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Form name', 'MODULE_PAYMENT_PAYLIKE_TITLE', '', '', '6', '2', now())");
        tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (`configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `date_added`) VALUES ('Sort order', 'MODULE_PAYMENT_PAYLIKE_SORT_ORDER', '0', '', '6', '3', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Success status', 'MODULE_PAYMENT_PAYLIKE_ORDER_STATUS_ID', '0', '', '6', '6', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
        // we dont wanna lost keys after module re install, so we need insert this only once
        $check_query = tep_db_query("SELECT configuration_key FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYLIKE_ORDER_TO_TRANSACTION'");
        if (!$check_query->num_rows) {
            tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order,  date_added) values ('Paylike order to transaction array', 'MODULE_PAYLIKE_ORDER_TO_TRANSACTION', '', '', '6', '6', now())");
        }
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }

    static function keys()
    {
        return [
            'MODULE_PAYMENT_PAYLIKE_STATUS',
            'MODULE_PAYMENT_PAYLIKE_TITLE',
            'MODULE_PAYMENT_PAYLIKE_KEY',
            'MODULE_PAYMENT_PAYLIKE_APP_KEY',
            'MODULE_PAYMENT_PAYLIKE_TEST_KEY',
            'MODULE_PAYMENT_PAYLIKE_TEST_APP_KEY',
            'MODULE_PAYMENT_PAYLIKE_TRANSACTION_MODE',
            'MODULE_PAYMENT_PAYLIKE_PAYMENT_TYPE',
            'MODULE_PAYMENT_PAYLIKE_ORDER_STATUS_ID',
            'MODULE_PAYMENT_PAYLIKE_SORT_ORDER'
        ];
    }
}
