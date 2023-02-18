<?php

/**
 * Class paypal
 */
class paypal
{
    /**
     * Pending status
     */
    const TRANSACTION_STATUS_PENDING = 'Pending';

    /**
     * Completed status
     */
    const TRANSACTION_STATUS_COMPLETED = 'Completed';

    /**
     *  Expected verification response
     */
    const VALID_VERIFICATION_RESPONSE = 'VERIFIED';

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var bool
     */
    public $enabled;

    /**
     * @var string
     */
    public $icon;

    /**
     * @var string
     */
    public $public_title;

    /**
     * @var int
     */
    public $sort_order;

    /**
     * @var string
     */
    public $form_action_url;

    /**
     * @var string
     */
    public $ipn_verification_url;

    /**
     * @var array
     */
    private $available_statuses;

    /**
     * paypal constructor.
     */
    public function __construct()
    {
        global $order;

        $this->code         = 'paypal';
        $this->title        = MODULE_PAYMENT_PAYPAL_TEXT_TITLE;
        $this->public_title = MODULE_PAYMENT_PAYPAL_TEXT_PUBLIC_TITLE . (!isMobile() ? MODULE_PAYMENT_PAYPAL_IMAGES : '');
        $this->description  = MODULE_PAYMENT_PAYPAL_TEXT_ADMIN_DESCRIPTION;
        $this->icon         = DIR_WS_ICONS . 'paypal.png';
        $this->sort_order   = MODULE_PAYMENT_PAYPAL_SORT_ORDER;
        $this->enabled      = ((MODULE_PAYMENT_PAYPAL_STATUS == 'True') ? true : false);

        $this->form_action_url      = 'https://www.paypal.com/cgi-bin/webscr';
        $this->ipn_verification_url = 'https://ipnpb.paypal.com/cgi-bin/webscr';
        if (MODULE_PAYMENT_PAYPAL_SANDBOX_STATUS === 'true') {
            $this->form_action_url      = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
            $this->ipn_verification_url = 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr';
        }

        $this->available_statuses = [
            static::TRANSACTION_STATUS_PENDING   => MODULE_PAYMENT_PAYPAL_ORDER_PENDING_STATUS_ID,
            static::TRANSACTION_STATUS_COMPLETED => MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID,
        ];

        if (is_object($order)) {
            $this->update_status();
        }
    }

    /**
     *
     */
    public function update_status()
    {
        global $order;

        if (
            $this->enabled == true &&
            (int)getConstantValue('MODULE_PAYMENT_PAYPAL_ZONE', 0) > 0 &&
            getConstantValue('ACCOUNT_COUNTRY') == 'true' && getConstantValue('ACCOUNT_STATE') == 'true'
        ) {
            $check_flag = false;
            $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int)MODULE_PAYMENT_PAYPAL_ZONE . "' and (zone_country_id = '" . (int)$order->billing['country']['id'] . "' or zone_country_id=0) order by zone_id");
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

    /**
     * @return array
     */
    public function selection()
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

        return [
            'id'     => $this->code,
            'icon'   => $icon,
            'sort'   => $this->sort_order,
            'module' => $this->public_title,
        ];
    }

    /**
     *
     */
    public function pre_confirmation_check()
    {
        global $cartID, $cart;

        if (empty($cart->cartID)) {
            $cartID = $cart->cartID = $cart->generate_cart_id();
        }
        if (!tep_session_is_registered('cartID')) {
            tep_session_register('cartID');
        }
    }

    /**
     * @return array
     */
    public function confirmation()
    {
        global $insert_id, $cartID, $cart_payment_id, $customer_id, $languages_id, $order, $order_total_modules, $onePageCheckout, $order_totals;

        if (tep_session_is_registered('cartID')) {
            $insert_order = false;

            if (tep_session_is_registered('cart_payment_id')) {
                $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);

                $curr_check = tep_db_query("select currency from " . TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
                $curr       = tep_db_fetch_array($curr_check);

                if (
                    ($curr['currency'] != $order->info['currency']) || ($cartID != substr(
                        $cart_payment_id,
                        0,
                        strlen($cartID)
                    ))
                ) {
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
                $insert_id = $onePageCheckout->createOrder(MODULE_PAYMENT_PAYPAL_DEFAULT_ORDER_STATUS_ID);
            }
        }

        return ['title' => MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION];
    }

    /**
     * @return string
     */
    public function process_button()
    {
        global $cart_payment_id, $lng, $insert_id, $currencies, $currency,$orders_total;

        $order = new order();
        // if(CARDS_ENABLED == 'true') {
        if (!empty($cart_payment_id)) {
            $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);
        } elseif (!empty($_SESSION['cart_payment_id'])) {
            $order_id = substr($_SESSION['cart_payment_id'], strpos($_SESSION['cart_payment_id'], '-') + 1);
        } else {
            $order_id = $insert_id;
        }

        // for UAH PayPal is not working, convert to USD:
        if ($order->info['currency'] == 'UAH') {
            $order->info['currency'] = 'USD';
            if ($currencies->currencies['UAH']['value'] == 1) {
                $order->info['total'] = $order->info['total'] * $currencies->currencies['USD']['value'];
            } else {
                $order->info['total'] = $order->info['total'] / $currencies->currencies['UAH']['value'];
            }
        }

        //   $order->info['total'] = $order->info['total']*$currencies->currencies[$order->info['currency']]['value'];

        $_SESSION['complete_status'] = [
            MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID,
            MODULE_PAYMENT_PAYPAL_ORDER_PENDING_STATUS_ID,
        ];
        $products_info               = '';
        $i                           = 1;
        $final_price = 0;
        foreach ($order->products as $product) {
            $products_info .= '<input type="hidden" name="amount_' . $i . '" value="' . $product['final_price'] . '">' . PHP_EOL;
            $products_info .= '<input type="hidden" name="item_name_' . $i . '" value="' . $product['name'] . '">' . PHP_EOL;
            $products_info .= '<input type="hidden" name="item_number_' . $i . '" value="' . $product['model'] . '">' . PHP_EOL;
            $products_info .= '<input type="hidden" name="quantity_' . $i . '" value="' . $product['qty'] . '">' . PHP_EOL;
            $i++;
            $final_price += $product['final_price'];
        }
        if ($order->info['shipping_cost']) {
            $products_info .= '<input type="hidden" name="amount_' . $i . '" value="' . $order->info['shipping_cost'] . '">' . PHP_EOL;
            $products_info .= '<input type="hidden" name="item_name_' . $i . '" value="Delivery">' . PHP_EOL;
            $products_info .= '<input type="hidden" name="quantity_' . $i . '" value="1">' . PHP_EOL;
            $i++;
            $final_price += $order->info['shipping_cost'];
        }
        if ($order->info['total'] != $final_price) {
            $products_info .= '<input type="hidden" name="discount_amount_cart" value="' . -($order->info['total'] - $final_price) . '">' . PHP_EOL;
        }
        // tep_mail('Admin', SEND_EXTRA_ORDER_EMAILS_TO, 'Customer is trying to pay order #' . $order_id . ' - ' . strftime(DATE_FORMAT_LONG), 'Customer is trying to pay order #' . $order_id . '', STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, '');

        return '<input type="hidden" name="cmd" value="_cart">
                  <input type="hidden" name="upload" value="1">
                  <input type="hidden" name="business" value="' . MODULE_PAYMENT_PAYPAL_ID . '">
                  <input type="hidden" name="tax" value="0">
                  <input type="hidden" name="quantity" value="1">
                  <input type="hidden" name="currency_code" value="' . $order->info['currency'] . '">
                  <input type="hidden" name="invoice" value="' . $order_id . '">
                  <input type="hidden" name="amount" value="213">
                  <input type="hidden" name="notify_url" value="' . addHostnameToLink(tep_href_link(
                      'includes/callbacks/paypal_callback.php',
                      '',
                      'SSL'
                  )) . '">
                  <input type="hidden" name="return" value="' . addHostnameToLink(tep_href_link(
                      FILENAME_CHECKOUT,
                      '',
                      'SSL'
                  )) . '">
                  <input type="hidden" name="email" value="' . $order->customer['email_address'] . '">
                  <input type="hidden" name="first_name" value="' . $order->delivery['firstname'] . '">
                  <input type="hidden" name="last_name" value="' . $order->delivery['lastname'] . '">
                  <input type="hidden" name="country" value="' . $order->delivery['country']['iso_code_2'] . '">
                  <input type="hidden" name="city" value="' . $order->delivery['city'] . '">
                  <input type="hidden" name="zip" value="' . $order->delivery['postcode'] . '">
                  <input type="hidden" name="state" value="' . $order->delivery['state'] . '">
                 <input type="hidden" name="address1" value="' . $order->delivery['street_address'] . '">
                 ' . $products_info;
        // }
    }

    /**
     *
     */
    public function before_process()
    {

        global $customer_id, $order, $order_totals, $sendto, $billto, $languages_id, $payment, $currencies, $cart, $paymentMethod, $wishList, $cart_payment_id, $$payment, $payment_modules, $onePageCheckout, $order_total_modules, $products_ordered, $guest_account;

        if (!empty($cart_payment_id)) {
            $order_id = substr($cart_payment_id, strpos($cart_payment_id, '-') + 1);
        } else {
            $order_id = $insert_id;
        }

        // отправка емейлов:
        //if(!isset($order_totals)) $order_totals = $order_total_modules->process();
        //$onePageCheckout->createEmails($order_id);
    }

    /**
     * @return false
     */
    public function after_process()
    {
        return false;
    }

    /**
     * @return false
     */
    public function output_error()
    {
        return false;
    }

    /**
     * @return int
     */
    public function check()
    {
        if (!isset($this->_check)) {
            $check_query  = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYPAL_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    /**
     *
     */
    public function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode(
            "', '",
            static::keys()
        ) . "')");
    }

    /**
     * @return string[]
     */
    public static function keys()
    {
        return [
            'MODULE_PAYMENT_PAYPAL_STATUS',
            'MODULE_PAYMENT_PAYPAL_ID',
            'MODULE_PAYMENT_PAYPAL_SORT_ORDER',
            'MODULE_PAYMENT_PAYPAL_ZONE',
            'MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID',
            'MODULE_PAYMENT_PAYPAL_ORDER_PENDING_STATUS_ID',
            'MODULE_PAYMENT_PAYPAL_DEFAULT_ORDER_STATUS_ID',
            'MODULE_PAYMENT_PAYPAL_SANDBOX_STATUS',
        ];
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function verifyIPN()
    {
        $post                        = $this->prepareRawPost();
        $verificationRequest         = $this->prepareVerificationRequest($post);
        $verificationServiceResponse = $this->makerVerificationRequest($verificationRequest);
        $isVerificationSuccess       = ($verificationServiceResponse === static::VALID_VERIFICATION_RESPONSE);

        if (!$isVerificationSuccess) {
            throw new \Exception("Fail verification");
        }

        return true;
    }

    /**
     * @return array
     */
    public function prepareRawPost()
    {
        $raw_post_data  = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $post           = [];
        foreach ($raw_post_array as $keyval) {
            $keyval = explode('=', $keyval);
            if (count($keyval) == 2) {
                // Since we do not want the plus in the datetime string to be encoded to a space, we manually encode it.
                if ($keyval[0] === 'payment_date') {
                    if (substr_count($keyval[1], '+') === 1) {
                        $keyval[1] = str_replace('+', '%2B', $keyval[1]);
                    }
                }
                $post[$keyval[0]] = urldecode($keyval[1]);
            }
        }
        return $post;
    }

    /**
     * @param array $post
     * @return string
     */
    public function prepareVerificationRequest($post)
    {
        $req = 'cmd=_notify-validate';
        foreach ($post as $key => $value) {
            $value = urlencode($value);
            $req   .= "&$key=$value";
        }
        return $req;
    }

    /**
     * @param string $request
     * @return bool|string
     * @throws Exception
     */
    public function makerVerificationRequest($request)
    {
        // Post the data back to PayPal, using curl. Throw exceptions if errors occur.
        $ch = curl_init($this->ipn_verification_url);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'User-Agent: PHP-IPN-Verification-Script',
            'Connection: Close',
        ]);
        $res = curl_exec($ch);
        if (!($res)) {
            $errno  = curl_errno($ch);
            $errstr = curl_error($ch);
            curl_close($ch);
            throw new \Exception("cURL error: [$errno] $errstr");
        }

        $info      = curl_getinfo($ch);
        $http_code = $info['http_code'];
        if ($http_code != 200) {
            throw new \Exception("PayPal responded with http code $http_code");
        }

        curl_close($ch);

        return $res;
    }

    /**
     * @param string $ipnStatus
     * @return int|bool
     */
    public function recognizeStatus($ipnStatus)
    {
        if (isset($this->available_statuses[$ipnStatus])) {
            return $this->available_statuses[$ipnStatus];
        }
        return false;
    }

    /**
     * @return array
     */
    public function getAvailableStatuses()
    {
        return $this->available_statuses;
    }

    /**
     *
     */
    public static function install()
    {

        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Allow Paypal module', 'MODULE_PAYMENT_PAYPAL_STATUS', 'True', 'Allow PayPal module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Owner email', 'MODULE_PAYMENT_PAYPAL_ID', '', 'Owner email', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order', 'MODULE_PAYMENT_PAYPAL_SORT_ORDER', '0', 'Sort order', '6', '3', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zone', 'MODULE_PAYMENT_PAYPAL_ZONE', '0', 'Zone', '6', '4', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Success status', 'MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID', '0', 'Success status', '6', '6', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Pending status', 'MODULE_PAYMENT_PAYPAL_ORDER_PENDING_STATUS_ID', '0', 'Pending status', '6', '6', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Default status', 'MODULE_PAYMENT_PAYPAL_DEFAULT_ORDER_STATUS_ID', '0', 'Default status', '6', '6', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('PayPal sandbox status', 'MODULE_PAYMENT_PAYPAL_SANDBOX_STATUS', 'true', 'PayPal sandbox status', '6', '6', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
    }
}
