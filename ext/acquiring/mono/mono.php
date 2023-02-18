<?php

class mono
{
    public $description;
    public $enabled;
    public $title;
    public $code;
    public const CURRENCY_CODE = 'UAH';

// class constructor
    public function __construct()
    {
        global $order;

        $this->code = 'mono';
        $this->title = MODULE_PAYMENT_MONO_TEXT_TITLE . (!isMobile() ? MODULE_PAYMENT_MONO_IMAGES : '');
        $this->public_title = MODULE_PAYMENT_MONO_TEXT_PUBLIC_TITLE . (!isMobile() ? MODULE_PAYMENT_MONO_IMAGES : '');
        $this->description = MODULE_PAYMENT_MONO_TEXT_ADMIN_DESCRIPTION;
        $this->icon = DIR_WS_ICONS . 'mono.png';
        $this->sort_order = MODULE_PAYMENT_MONO_SORT_ORDER;
        $this->enabled = ((MODULE_PAYMENT_MONO_STATUS == 'True') ? true : false);
        $this->form_action_url = '';

        if (is_object($order)) {
            $this->update_status();
        }
    }

// class methods
    public function update_status(): void
    {
        global $order;

        if (
            $this->enabled == true &&
            (int)getConstantValue('MODULE_PAYMENT_MONO_ZONE', 0) > 0 &&
            getConstantValue('ACCOUNT_COUNTRY') == 'true' && getConstantValue('ACCOUNT_STATE') == 'true'
        ) {
            $check_flag = false;
            $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_MONO_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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

    public function selection(): array
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

    public function pre_confirmation_check(): void
    {
        global $cartID, $cart;

        if (empty($cart->cartID)) {
            $cartID = $cart->cartID = $cart->generate_cart_id();
        }
        if (!tep_session_is_registered('cartID')) {
            tep_session_register('cartID');
        }
    }

    public function confirmation(): array
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

        return array('title' => MODULE_PAYMENT_MONO_TEXT_DESCRIPTION);
    }

    public function process_button()
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

            try {
                if ($order->info['currency'] !== self::CURRENCY_CODE) {
                    require_once(DIR_WS_CLASSES . 'currencies.php');
                    $currencies = new currencies();
                    if ($currencies->currencies['UAH']['value'] == 1) {
                        $order->info['total'] = $order->info['total'] / $currencies->currencies[$order->info['currency']]['value'];
                    } else {
                        $order->info['total'] = $order->info['total'] * $currencies->currencies['UAH']['value'];
                    }
                }
                $randKey = $this->generateRandomString();
                $data_array = array(
                    'merchant_id' => MODULE_PAYMENT_MONO_ID,
                    'amount' => (int)($order->info['total'] * 100),
                    'currency' => $order->info['currency'],
                    'description' => 'Order #' . $order_id,
                    'order_id' => $order_id,
                    'lang' => $lng->language['code'],
                    'response_url' => addHostnameToLink(tep_href_link(FILENAME_CHECKOUT_SUCCESS, 'order_id=' . $order_id, 'SSL')),
                    'server_callback_url' => addHostnameToLink(tep_href_link('includes/callbacks/mono_callback.php', 'key=' . $randKey, 'SSL')),
                    'randKey' => $randKey,
                    'InvoiceId' => '',
                );

                $data_array['forward_url'] = $this->getCheckoutUrl($data_array);
                $data_array['InvoiceId'] = $this->getInvoiceId($order_id);

                $_SESSION['complete_status'] = [MODULE_PAYMENT_MONO_ORDER_STATUS_ID];

            } catch (\Exception $exception) {
                \App\Logger\Log::error('Error MonoBank ' . $exception->getMessage());
            }
            return $data_array;
        }
    }

    public function before_process(): void
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

    public function after_process(): bool
    {
        return false;
    }

    public function output_error(): bool
    {
        return false;
    }

    public function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_MONO_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }
        return $this->_check;
    }

    public static function install(): void
    {

        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Allow Mono', 'MODULE_PAYMENT_MONO_STATUS', 'True', 'Allow Mono?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant ID', 'MODULE_PAYMENT_MONO_ID', '', 'Merchant ID.', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order', 'MODULE_PAYMENT_MONO_SORT_ORDER', '0', 'Sort order.', '6', '3', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zone', 'MODULE_PAYMENT_MONO_ZONE', '0', 'Zone.', '6', '4', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Paid order status', 'MODULE_PAYMENT_MONO_ORDER_STATUS_ID', '7', 'Paid order status', '6', '6', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Default order status', 'MODULE_PAYMENT_MONO_DEFAULT_ORDER_STATUS_ID', '0', 'Default order status', '6', '6', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
        tep_db_query("CREATE TABLE IF NOT EXISTS `mono_orders` (`Id` int NOT NULL AUTO_INCREMENT,`InvoiceId` varchar(50) DEFAULT NULL,`OrderId` int(10) DEFAULT NULL,`SecretKey` varchar(51) DEFAULT NULL,PRIMARY KEY (Id)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");
    }

    public function remove(): void
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
        tep_db_query("DROP TABLE IF EXISTS `mono_orders`;");
    }

    public static function keys(): array
    {
        return array(
            'MODULE_PAYMENT_MONO_STATUS',
            'MODULE_PAYMENT_MONO_ID',
            'MODULE_PAYMENT_MONO_SORT_ORDER',
            'MODULE_PAYMENT_MONO_ZONE',
            'MODULE_PAYMENT_MONO_ORDER_STATUS_ID',
            'MODULE_PAYMENT_MONO_DEFAULT_ORDER_STATUS_ID'
        );
    }

    public function generateRandomString($length = 50): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function getStatus($InvoiceId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.monobank.ua/api/merchant/invoice/status?invoiceId=' . $InvoiceId . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'X-Token: ' . MODULE_PAYMENT_MONO_ID . ''
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response)->status;
    }

    public function addOrder($args): void
    {
        $query = tep_db_query("SELECT * FROM `mono_orders` WHERE OrderId = '" . (int)$args['order_id'] . "'");

        if ($query->num_rows) {
            tep_db_query("UPDATE `mono_orders` SET SecretKey = '" . $args['randKey'] . "', InvoiceId = '" . $args['InvoiceId'] . "' WHERE OrderId = '" . (int)$args['order_id'] . "'");
        } else {
            tep_db_query("INSERT INTO `mono_orders` (InvoiceId, OrderId, SecretKey) VALUES('" . $args['InvoiceId'] . "'," . $args['order_id'] . ",'" . $args['randKey'] . "')");
        }
    }

    public function getInvoiceId($OrderId)
    {
        $InvoiceId_query = tep_db_query("SELECT * FROM `mono_orders` WHERE OrderId = '" . (int)$OrderId . "'");
        return tep_db_fetch_array($InvoiceId_query);
    }

    public function getCheckoutUrl($requestData)
    {
        $request = $this->sendToAPI($requestData);
        return $request['pageUrl'];
    }

    public function getImageUrl($product_id)
    {
        $query = tep_db_query("SELECT * FROM `products` WHERE products_id = " . (int)$product_id . "");
        $product = tep_db_fetch_array($query);

        return $product['products_image'];
    }

    public function getEncodedProducts($order_id): array
    {
        $orderProducts_query = tep_db_query("SELECT op.products_id,op.final_price,op.products_name,op.products_quantity,o.currency
            FROM orders_products op
            LEFT JOIN orders o on o.orders_id = op.orders_id
            WHERE op.orders_id = '" . (int)$order_id . "'");

        while ($orderProducts = tep_db_fetch_array($orderProducts_query)) {
            $orderProductsArray[] = $orderProducts;
        }

        foreach ($orderProductsArray as $orderProduct) {
            $image_link = explode(';', $this->getImageUrl($orderProduct['products_id']));
            $image_link = array_map(function ($img) {
                return HTTP_SERVER . "/getimage/products/" . $img;
            }, $image_link);
            $image = array_shift($image_link);

            require_once(DIR_WS_CLASSES . 'currencies.php');
            $currencies = new currencies();

            if ($currencies->currencies['UAH']['value'] != 1) {
                $orderProduct['final_price'] = $orderProduct['final_price'] * $currencies->currencies['UAH']['value'];
            }


            $products[] = [
                'name' => $orderProduct['products_name'],
                'sum' => (int)($orderProduct['final_price'] * 100),
                'qty' => (int)$orderProduct['products_quantity'],
                'icon' => $image
            ];
        }

        return $products;
    }

    public function sendToAPI($requestData)
    {
        $basketOrder = $this->getEncodedProducts($requestData['order_id']);

        $data = [
            'amount' => $requestData['amount'],
            'ccy' => 980,
            'merchantPaymInfo' => [
                'reference' => (string)$requestData['order_id'],
                'destination' => '#' . $requestData['order_id'],
                'basketOrder' => $basketOrder,
            ],
            'redirectUrl' => $requestData['response_url'],
            'webHookUrl' => str_replace('&amp;', '&', $requestData['server_callback_url']),
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.monobank.ua/api/merchant/invoice/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'X-Token: ' . $requestData['merchant_id'] . ''
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        if (!$response) {
            throw new \Exception('No response');
        }

        $response = json_decode($response, true);

        if (empty($response['invoiceId'])) {
            \App\Logger\Log::error('Error MonoBank ', [
                'errCode' => $response['errCode'],
                'errText' => $response['errText'],
                'X-Token' => $requestData['merchant_id'],
                'redirectUrl' => $requestData['response_url'],
                'webHookUrl' => str_replace('&amp;', '&', $requestData['server_callback_url']),
                'amount' => $requestData['amount'],
                'order_id' => $requestData['order_id']
            ]);
        }

        $requestData['InvoiceId'] = $response['invoiceId'];

        $this->addOrder($requestData);
        return $response;
    }
}

if (!function_exists('addHostnameToLink')) {
    function addHostnameToLink($link)
    {
        return strstr($link, HTTP_SERVER) ? $link : HTTP_SERVER . (substr($link, 0, 1) === '/' ? $link : '/' . $link);
    }
}


