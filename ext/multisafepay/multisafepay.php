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

require_once __DIR__ . "/mspcheckout/include/API/Autoloader.php";

if (!class_exists('multisafepay')) {

    class multisafepay
    {

        public $code;
        public $title;
        public $description;
        public $enabled;
        public $sort_order;
        public $plugin_name;
        public $icon = "connect.png";
        public $api_url;
        public $order_id;
        public $public_title;
        public $status;
        public $shipping_methods = [];
        public $taxes = [];
        public $_customer_id = 0;
        public $msp;
        public $pluginversion = '3.0.0';
        public $liveurl = 'https://api.multisafepay.com/v1/json/';
        public $testurl = 'https://testapi.multisafepay.com/v1/json/';
        private $allowedCurrencies = [];

        /**
         *
         * @param type $order_id
         * @global type $order
         */
        function __construct($order_id = -1)
        {
            global $order;

            $this->code = 'multisafepay';
            $this->title = $this->getTitle(MODULE_PAYMENT_MULTISAFEPAY_TEXT_TITLE);
            $this->enabled = MODULE_PAYMENT_MULTISAFEPAY_STATUS == 'True';
            $this->sort_order = MODULE_PAYMENT_MULTISAFEPAY_SORT_ORDER;
            $this->plugin_name = $this->pluginversion . '(' . getConstantValue('PROJECT_VERSION', '1') . ')';

            if (is_object($order) || is_object($GLOBALS['order'])) {
                $this->update_status();
            }

            $this->order_id = $order_id;
            $this->public_title = $this->getTitle(MODULE_PAYMENT_MULTISAFEPAY_TEXT_TITLE) . (!isMobile() ? MODULE_PAYMENT_MULTISAFEPAY_IMAGES : '');
            $this->status = null;

            $this->allowedCurrencies = [
                'EUR' => '(Euro)',
                'USD' => '(United States dollar)',
                'GBP' => '(Pound Sterling)',
                'VEF' => '(Venezuelan bolívar)',
                'AUD' => '(Australian dollar)',
                'BRL' => '(Brazilian real)',
                'CHF' => '(Swiss franc)',
                'CLP' => '(Chilean peso)',
                'COP' => '(Colombian peso)',
                'CZK' => '(Czech koruna)',
                'DKK' => '(Danish krone)',
                'INR' => '(Indian rupee)',
                'MXN' => '(Mexican peso)',
                'PEN' => '(Peruvian Sol)',
                'PLN' => '(Polish złoty)',
                'RON' => '(Romanian leu)',
                'SEK' => '(Swedish krona)',
                'NOK' => '(Norwegian krone)',
                'CAD' => '(Canadian dollar)',
                'HRK' => '(Croatian kuna)',
                'HKD' => '(Hong Kong dollar)',
                'TWD' => '(New Taiwan dollar)',
                'KRW' => '(South Korean won)',
                'HUF' => '(Hungarian forint)',
                'PHP' => '(Philippine peso)',
                'ZAR' => '(South African rand)',
                'CNY' => '(Chinese yuan)',
                'JPY' => '(Japanese yen)',
                'MYR' => '(Malaysian ringgit)',
                'AED' => '(United Arab Emirates dirham)',
                'ILS' => '(Israeli new shekel)',
                'RUB' => '(Russian ruble)',
                'SGD' => '(Singapore dollar)',
                'NZD' => '(New Zealand dollar)',
                'TRY' => '(Turkish lira)',
                'ISK' => '(Icelandic króna)',
                'THB' => '(Thai baht)',
            ];
        }

        /**
         *
         * @global type $order
         */
        function update_status()
        {
            global $order;

            if (
                $this->enabled == true &&
                (int)getConstantValue('MODULE_PAYMENT_MULTISAFEPAY_ZONE', 0) > 0 &&
                getConstantValue('ACCOUNT_COUNTRY') == 'true' && getConstantValue('ACCOUNT_STATE') == 'true'
            ) {
                $check_flag = false;
                $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . (int)MODULE_PAYMENT_MULTISAFEPAY_ZONE
                    . "' and zone_country_id = '" . (int)$order->billing['country']['id'] . "' order by zone_id");
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
         * @param $currency
         * @return bool
         */
        function isCurrencyAllowed($currency)
        {
            return isset($this->allowedCurrencies[$currency]);
        }

        /**
         *
         * @return boolean
         */
        function javascript_validation()
        {
            return false;
        }

        /**
         *
         * @return type
         * @global type $languages_id
         * @global type $order
         * @global type $order_totals
         * @global type $order_products_id
         * @global type $customer_id
         */
        function selection()
        {
            global $customer_id;
            global $languages_id;
            global $order;
            global $order_totals;
            global $order_products_id;

            $selection = [
                'id' => $this->code,
                'module' => $this->public_title,
                'fields' => [],
            ];

            return $selection;
        }

        /**
         *
         * @return boolean
         */
        function pre_confirmation_check()
        {
            $gatewaytest = $_POST['payment'];

            if (!$gatewaytest) {
                $error = 'Select a payment method.';
                $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error);

                tep_redirect(addHostnameToLink(tep_href_link(
                    FILENAME_CHECKOUT,
                    $payment_error_return,
                    'SSL',
                    true,
                    false
                )));
            }
            return false;
        }

        /**
         *
         * @return boolean
         * @global type $order
         * @global type $HTTP_POST_VARS
         */
        function confirmation()
        {
            global $HTTP_POST_VARS, $order;

            return false;
        }

        /**
         *
         * @return boolean
         */
        function process_button()
        {
            return false;
        }

        /**
         * Save the order and start the transaction
         */
        function before_process()
        {
            $this->_save_order();
            tep_redirect($this->_start_transaction());
        }

        /**
         *
         * @return boolean
         */
        function after_process()
        {
            return false;
        }

        /**
         *
         * @return boolean
         */
        function output_error()
        {
            return false;
        }

        /**
         *
         * @return type
         */
        function get_error()
        {
            $error = [
                'title' => 'Error:',
                'error' => $this->_get_error_message($_GET['error']),
            ];

            return $error;
        }

        /**
         *
         * @param type $street_address
         * @return type
         */
        public function parseAddress($street_address)
        {
            $address = $street_address;
            $apartment = "";

            $offset = strlen($street_address);

            while (($offset = $this->rstrpos($street_address, ' ', $offset)) !== false) {
                if ($offset < strlen($street_address) - 1 && is_numeric($street_address[$offset + 1])) {
                    $address = trim(substr($street_address, 0, $offset));
                    $apartment = trim(substr($street_address, $offset + 1));
                    break;
                }
            }

            if (empty($apartment) && strlen($street_address) > 0 && is_numeric($street_address[0])) {
                $pos = strpos($street_address, ' ');

                if ($pos !== false) {
                    $apartment = trim(substr($street_address, 0, $pos), ", \t\n\r\0\x0B");
                    $address = trim(substr($street_address, $pos + 1));
                }
            }

            return [$address, $apartment];
        }

        /**
         *
         * @param type $haystack
         * @param type $needle
         * @param type $offset
         * @return boolean
         */
        public function rstrpos($haystack, $needle, $offset = null)
        {
            $size = strlen($haystack);

            if (is_null($offset)) {
                $offset = $size;
            }

            $pos = strpos(strrev($haystack), strrev($needle), $size - $offset);

            if ($pos === false) {
                return false;
            }

            return $size - $pos - strlen($needle);
        }

        /**
         * Convert currency to USD
         */
        public function convertTotalToAllowedCurrency()
        {
            $currentCurrencyCode = $GLOBALS['order']->info['currency'];
            $GLOBALS['order']->info['currency'] = 'USD';
            if ($GLOBALS['currencies']->currencies[$currentCurrencyCode]['value'] == 1) {
                $GLOBALS['order']->info['total'] = $GLOBALS['order']->info['total'] * $GLOBALS['currencies']->currencies['USD']['value'];
            } else {
                $GLOBALS['order']->info['total'] = $GLOBALS['order']->info['total'] / $GLOBALS['currencies']->currencies[$currentCurrencyCode]['value'];
            }
        }

        /**
         *
         * @return type
         */
        function _start_transaction()
        {
            if (!$this->isCurrencyAllowed($GLOBALS['order']->info['currency'])) {
                $this->convertTotalToAllowedCurrency();
            }

            $amount = round($GLOBALS['order']->info['total'], 2) * 100;

            $items_list = "<ul>\n";

            foreach ($GLOBALS['order']->products as $product) {
                $items_list .= "<li>" . $product['name'] . "</li>\n";
            }

            $items_list .= "</ul>\n";

            $this->msp = new \MultiSafepayAPI\Client();

            if (MODULE_PAYMENT_MULTISAFEPAY_API_SERVER == 'Live account') {
                $this->msp->setApiUrl($this->liveurl);
            } else {
                $this->msp->setApiUrl($this->testurl);
            }

            $this->msp->setApiKey(MODULE_PAYMENT_MULTISAFEPAY_API_KEY);

            $trans_type = "redirect";

            if (isset($_POST['msp_paymentmethod'])) {
                $gateway = $_POST['msp_paymentmethod'];
            } else {
                $gateway = null;
            }

            if ($gateway == 'IDEAL' && $_POST["msp_issuer"]) {
                $issuer_id = $_POST["msp_issuer"];
                $trans_type = "direct";
            } else {
                $issuer_id = null;
                $trans_type = "redirect";
            }

            if (MODULE_PAYMENT_MULTISAFEPAY_AUTO_REDIRECT == "True") {
                $redirect_url = $this->_href_link(
                    'includes/callbacks/multisafepay/success.php',
                    '',
                    'SSL',
                    false,
                    false
                );
            } else {
                $redirect_url = null;
            }

            list($street, $housenumber) = $this->parseAddress($GLOBALS['order']->customer['street_address']);

            try {
                $order = $this->msp->orders->post([
                    "type" => $trans_type,
                    "order_id" => $this->order_id,
                    "currency" => $GLOBALS['order']->info['currency'],
                    "amount" => round($amount),
                    "description" => 'Order #' . $this->order_id . ' at ' . STORE_NAME,
                    "var1" => $GLOBALS['customer_id'],
                    "var2" => tep_session_id() . ';' . tep_session_name(),
                    "var3" => $GLOBALS['cartID'],
                    "items" => $items_list,
                    "manual" => "false",
                    "gateway" => $gateway,
                    "days_active" => MODULE_PAYMENT_MULTISAFEPAY_DAYS_ACTIVE,
                    "gateway_info" => [
                        "issuer_id" => $issuer_id,
                    ],
                    "payment_options" => [
                        "notification_url" => $this->_href_link(
                            'includes/callbacks/multisafepay/notify_checkout.php?type=initial',
                            '',
                            'SSL',
                            false,
                            false
                        ),
                        "redirect_url" => $redirect_url,
                        "cancel_url" => $this->_href_link(
                            'includes/callbacks/multisafepay/cancel.php',
                            '',
                            'SSL',
                            false,
                            false
                        ),
                        "close_window" => "true",
                    ],
                    "customer" => [
                        "locale" => $this->getLocale($GLOBALS['language']),
                        "ip_address" => $_SERVER['REMOTE_ADDR'],
                        "forwarded_ip" => $_SERVER['HTTP_FORWARDED'],
                        "first_name" => $GLOBALS['order']->customer['firstname'],
                        "last_name" => $GLOBALS['order']->customer['lastname'],
                        "address1" => $street,
                        "address2" => "",
                        "house_number" => $housenumber,
                        "zip_code" => $GLOBALS['order']->customer['postcode'],
                        "city" => $GLOBALS['order']->customer['city'],
                        "state" => "",
                        "country" => $GLOBALS['order']->customer['country']['iso_code_2'],
                        "phone" => $GLOBALS['order']->customer['telephone'],
                        "email" => $GLOBALS['order']->customer['email_address'],
                    ],
                    "google_analytics" => [
                        "account" => MODULE_PAYMENT_MULTISAFEPAY_GA,
                    ],
                    "plugin" => [
                        "shop" => "OsCommerce",
                        "shop_version" => PROJECT_VERSION,
                        "plugin_version" => $this->pluginversion,
                        "partner" => "MultiSafepay",
                    ],
                ]);

                return $this->msp->orders->getPaymentLink();
            } catch (Exception $e) {
                $this->_error_redirect($e->getMessage());
            }
        }

        /**
         *
         * @return type
         */
        function check_transaction()
        {
            try {
                $this->msp = new \MultiSafepayAPI\Client();

                if (MODULE_PAYMENT_MULTISAFEPAY_API_SERVER == 'Live account') {
                    $this->msp->setApiUrl($this->liveurl);
                } else {
                    $this->msp->setApiUrl($this->testurl);
                }

                $this->msp->setApiKey(MODULE_PAYMENT_MULTISAFEPAY_API_KEY);

                $response_obj = $this->msp->issuers->get('orders', $this->order_id);

                return $response_obj;
            } catch (Exception $e) {
                echo htmlspecialchars($e->getMessage());
            }
        }

        /**
         *
         * @param type $details
         * @return \type
         */
        function get_customer($details)
        {
            $email = $details->customer->email;

            $customer_exists = tep_db_fetch_array(tep_db_query("select customers_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . $email . "'"));

            $new_user = false;

            if (!empty($customer_exists['customers_id'])) {
                $customer_id = $customer_exists['customers_id'];
            } else {
                $sql_data_array = [
                    'customers_firstname' => tep_db_input($details->customer->first_name),
                    'customers_lastname' => tep_db_input($details->customer->last_name),
                    'customers_email_address' => $details->customer->email,
                    'customers_telephone' => $details->customer->phone1,
                    'customers_fax' => '',
                    'customers_default_address_id' => 0,
                    'customers_password' => tep_encrypt_password('test123'),
                    'customers_newsletter' => 1,
                ];

                if (ACCOUNT_DOB == 'true') {
                    $sql_data_array['customers_dob'] = 'now()';
                }

                tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

                $customer_id = tep_db_insert_id();

                tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . "(customers_info_id, customers_info_number_of_logons, 
                             customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");

                $new_user = true;
            }

            //The user exists and is logged in
            //Check database to see whether or not the address exists.

            $address_book = tep_db_query("select address_book_id, entry_country_id, entry_zone_id from " . TABLE_ADDRESS_BOOK . "
                                        where  customers_id = '" . $customer_id . "'
                                        and entry_street_address = '" . $details->customer->address1 . ' ' . $details->customer->house_number . "'
                                        and entry_suburb = '" . '' . "'
                                        and entry_postcode = '" . $details->customer->zip_code . "'
                                        and entry_city = '" . $details->customer->city . "'");

            //If not, add the address as default one

            if (@!tep_db_num_rows($address_book->lengths)) {
                $country = $this->get_country_from_code($details->customer->country);

                $sql_data_array = [
                    'customers_id' => $customer_id,
                    'entry_gender' => '',
                    'entry_company' => '',
                    'entry_firstname' => tep_db_input($details->customer->first_name),
                    'entry_lastname' => tep_db_input($details->customer->last_name),
                    'entry_street_address' => $details->customer->address1 . ' ' . $details->customer->house_number,
                    'entry_suburb' => '',
                    'entry_postcode' => $details->customer->zip_code,
                    'entry_city' => $details->customer->city,
                    'entry_state' => '',
                    'entry_country_id' => $country['countries_id'],
                    'entry_zone_id' => '',
                ];

                tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

                $address_id = tep_db_insert_id();

                tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");

                $customer_default_address_id = $address_id;
                $customer_country_id = $country['countries_id'];
            } else {
                $customer_default_address_id = $address_book['address_book_id'];
                $customer_country_id = $address_book['entry_country_id'];
            }

            return $customer_id;
        }

        /**
         *
         * @param type $code
         * @return type
         */
        function get_country_from_code($code)
        {
            $country = tep_db_fetch_array(tep_db_query("select * from " . TABLE_COUNTRIES . " where countries_iso_code_2 = '" . $code . "'"));
            return $country;
        }

        /**
         *
         * @return type
         */
        function checkout_notify()
        {
            try {
                $this->msp = new \MultiSafepayAPI\Client();

                if (MODULE_PAYMENT_MULTISAFEPAY_API_SERVER == 'Live account') {
                    $this->msp->setApiUrl($this->liveurl);
                } else {
                    $this->msp->setApiUrl($this->testurl);
                }

                $this->msp->setApiKey(MODULE_PAYMENT_MULTISAFEPAY_API_KEY);
                $response_obj = $this->msp->issuers->get('orders', $this->order_id);
            } catch (Exception $e) {
                echo htmlspecialchars($e->getMessage());
            }

            if (!$response_obj->var1) {
                $customer_id = $this->get_customer($response_obj);
            } else {
                $customer_id = $response_obj->var1;
            }

            $this->_customer_id = $customer_id;

            $reset_cart = false;
            $notify_customer = false;
            $status = $response_obj->status;

            $current_order = tep_db_query("SELECT orders_status FROM " . TABLE_ORDERS . " WHERE orders_id = " . (int)$this->order_id);
            $current_order = tep_db_fetch_array($current_order);
            $old_order_status = $current_order['orders_status'];
            $new_status = $old_order_status;

            switch ($status) {
                case "initialized":
                    $GLOBALS['order']->info['order_status'] = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_INITIALIZED;
                    $new_status = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_INITIALIZED;
                    $reset_cart = true;
                    break;
                case "completed":
                    if (
                    in_array($old_order_status, [
                        MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_INITIALIZED,
                        DEFAULT_ORDERS_STATUS_ID,
                        MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_UNCLEARED,
                    ])
                    ) {
                        $GLOBALS['order']->info['order_status'] = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_COMPLETED;
                        $reset_cart = true;
                        if ($old_order_status != $GLOBALS['order']->info['order_status']) {
                            $notify_customer = true;
                        }
                        $new_status = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_COMPLETED;
                    }
                    break;
                case "uncleared":
                    $GLOBALS['order']->info['order_status'] = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_UNCLEARED;
                    $new_status = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_UNCLEARED;
                    break;
                case "reserved":
                    $GLOBALS['order']->info['order_status'] = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_RESERVED;
                    $new_status = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_RESERVED;
                    break;
                case "void":
                    $GLOBALS['order']->info['order_status'] = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_VOID;
                    $new_status = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_VOID;
                    if ($old_order_status != MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_VOID) {
                        $order_query = tep_db_query("select products_id, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $this->order_id . "'");

                        while ($order = tep_db_fetch_array($order_query)) {
                            tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity + " . $order['products_quantity'] . ", products_ordered = products_ordered - " . $order['products_quantity'] . " where products_id = '" . (int)$order['products_id'] . "'");
                        }
                    }
                    break;
                case "cancelled":
                    $GLOBALS['order']->info['order_status'] = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_VOID;
                    $new_status = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_VOID;
                    if ($old_order_status != MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_VOID) {
                        $order_query = tep_db_query("select products_id, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $this->order_id . "'");

                        while ($order = tep_db_fetch_array($order_query)) {
                            tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity + " . $order['products_quantity'] . ", products_ordered = products_ordered - " . $order['products_quantity'] . " where products_id = '" . (int)$order['products_id'] . "'");
                        }
                    }
                    break;
                case "declined":
                    $GLOBALS['order']->info['order_status'] = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_DECLINED;
                    $new_status = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_DECLINED;
                    if ($old_order_status != MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_DECLINED) {
                        $order_query = tep_db_query("select products_id, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $this->order_id . "'");

                        while ($order = tep_db_fetch_array($order_query)) {
                            tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity + " . $order['products_quantity'] . ", products_ordered = products_ordered - " . $order['products_quantity'] . " where products_id = '" . (int)$order['products_id'] . "'");
                        }
                    }
                    break;
                case "reversed":
                    $GLOBALS['order']->info['order_status'] = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_REVERSED;
                    $new_status = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_REVERSED;
                    break;
                case "refunded":
                    $GLOBALS['order']->info['order_status'] = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_REFUNDED;
                    $new_status = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_REFUNDED;
                    break;
                case "partial_refunded":
                    $GLOBALS['order']->info['order_status'] = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_PARTIAL_REFUNDED;
                    $new_status = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_PARTIAL_REFUNDED;
                    break;
                case "expired":
                    $GLOBALS['order']->info['order_status'] = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_EXPIRED;
                    $new_status = MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_EXPIRED;
                    if ($old_order_status != MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_EXPIRED) {
                        $order_query = tep_db_query("select products_id, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $this->order_id . "'");
                        while ($order = tep_db_fetch_array($order_query)) {
                            tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity + " . $order['products_quantity'] . ", products_ordered = products_ordered - " . $order['products_quantity'] . " where products_id = '" . (int)$order['products_id'] . "'");
                        }
                    }
                    break;
                default:
                    $GLOBALS['order']->info['order_status'] = DEFAULT_ORDERS_STATUS_ID;
            }

            $order_status_query = tep_db_query("SELECT orders_status_name FROM " . TABLE_ORDERS_STATUS . " WHERE orders_status_id = '" . $GLOBALS['order']->info['order_status'] . "' AND language_id = '" . $GLOBALS['languages_id'] . "'");
            $order_status = tep_db_fetch_array($order_status_query);

            $GLOBALS['order']->info['orders_status'] = $order_status['orders_status_name'];

            if ($old_order_status != $new_status) {
                tep_db_query("UPDATE " . TABLE_ORDERS . " SET orders_status = " . $new_status . " WHERE orders_id = " . $this->order_id);
            }

            if ($notify_customer) {
                $this->_notify_customer($new_status);
            } else {
                $last_osh_status_r = tep_db_fetch_array(tep_db_query("SELECT orders_status_id FROM orders_status_history WHERE orders_id = '" . tep_db_input($this->order_id) . "' ORDER BY date_added DESC limit 1"));
                if ($last_osh_status_r['orders_status_id'] != $GLOBALS['order']->info['order_status']) {
                    $sql_data_array = [
                        'orders_id' => $this->order_id,
                        'orders_status_id' => $GLOBALS['order']->info['order_status'],
                        'date_added' => 'now()',
                        'customer_notified' => 0,
                    ];

                    tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
                }
            }

            if ($reset_cart) {
                tep_db_query("DELETE FROM " . TABLE_CUSTOMERS_BASKET . " WHERE customers_id = '" . (int)$GLOBALS['order']->customer['id'] . "'");
                tep_db_query("DELETE FROM " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " WHERE customers_id = '" . (int)$GLOBALS['order']->customer['id'] . "'");
            }

            return $status;
        }

        /**
         *
         * @param type $message
         * @return type
         */
        function _get_error_message($message)
        {
            return $message;
        }

        /**
         *
         * @param type $error
         */
        function _error_redirect($error)
        {
            tep_redirect($this->_href_link(
                FILENAME_CHECKOUT,
                'payment_error=' . $this->code . '&error=' . $error,
                'NONSSL',
                true,
                false,
                false
            ));
        }

        /**
         *
         * @return type
         * @global type $languages_id
         * @global type $order
         * @global type $shipping
         * @global type $order_totals
         * @global type $order_products_id
         * @global type $customer_id
         */
        function _save_order()
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
                    $insert_id = $onePageCheckout->createOrder(MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_UNCLEARED);
                }
            }

            $this->order_id = $insert_id;
        }

        /**
         *
         * @param type $new_order_status
         * @global type $customer_id
         * @global type $order
         * @global type $order_totals
         * @global type $order_products_id
         * @global type $total_products_price
         * @global type $products_tax
         * @global type $languages_id
         * @global type $currencies
         * @global type $payment
         */
        function _notify_customer($new_order_status = null)
        {
            global $customer_id;
            global $order;
            global $order_totals;
            global $order_products_id;
            global $total_products_price;
            global $products_tax;
            global $languages_id;
            global $language;
            global $currencies;
            global $payment;

            if (!class_exists('order')) {
                require_once DIR_WS_CLASSES . 'order.php';
            }

            if (!is_a($order, 'order')) {
                $order = new order($this->order_id);
            }
            \App\Logger\Log::debug('Order object: {order}', [
                var_export($order, true),
            ]);

            if ($new_order_status != null) {
                $order->info['order_status'] = $new_order_status;
            }

            if (SEND_EMAILS == 'true') {
                $customer_notification = '1';
            } else {
                $customer_notification = '0';
            }

            $sql_data_array = [
                'orders_id' => $this->order_id,
                'orders_status_id' => $order->info['order_status'],
                'date_added' => 'now()',
                'customer_notified' => $customer_notification,
                'comments' => $order->info['comments'],
            ];

            tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

            $orderStatus = getOrderStatusById($order->info['order_status'], $languages_id);

            $payment_method = $this->title;
            includeLanguages(DIR_WS_LANGUAGES . $language . '/checkout_success.json');
            $subject = HEADING_TITLE . " #" . $this->order_id . " - " . STORE_NAME;
            $email_text = TEXT_THANKS_FOR_SHOPPING;

            if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                require_once(DIR_FS_EXT . 'email_content/functions.php');
                $data = [
                    'customers_name' => $order->customer['name'],
                    'order_id' => $this->order_id,
                    'payment_method' => $payment_method,
                ];
                $content_email_array = getSuccessPaymentText($languages_id, $data);
                $email_text = $content_email_array['content_html'] ?: $email_text;
                $subject = $content_email_array['subject'] ?: $subject;
                $subject = sprintf($subject, $this->order_id, $orderStatus);
            }
            tep_mail($order->customer['name'], $order->customer['email_address'], $subject, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            if (!empty(STORE_OWNER_EMAIL_ADDRESS)) {
                tep_mail('', STORE_OWNER_EMAIL_ADDRESS, $subject, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            }
        }

        /**
         *
         * @param type $address_format_id
         * @param string $address
         * @param type $html
         * @param type $boln
         * @param type $eoln
         * @return string
         */
        function _address_format($address_format_id, $address, $html, $boln, $eoln)
        {
            $address_format_query = tep_db_query("SELECT address_format AS format FROM " . TABLE_ADDRESS_FORMAT . " WHERE address_format_id = '" . (int)$address_format_id . "'");
            $address_format = tep_db_fetch_array($address_format_query);

            $company = $this->_output_string_protected($address['company']);
            if (isset($address['firstname']) && tep_not_null($address['firstname'])) {
                $firstname = $this->_output_string_protected($address['firstname']);
                $lastname = $this->_output_string_protected($address['lastname']);
            } elseif (isset($address['name']) && tep_not_null($address['name'])) {
                $firstname = $this->_output_string_protected($address['name']);
                $lastname = '';
            } else {
                $firstname = '';
                $lastname = '';
            }

            $street = $this->_output_string_protected($address['street_address']);
            $suburb = $this->_output_string_protected($address['suburb']);
            $city = $this->_output_string_protected($address['city']);
            $state = $this->_output_string_protected($address['state']);

            if (isset($address['country_id']) && tep_not_null($address['country_id'])) {
                $country = tep_get_country_name($address['country_id']);
                if (isset($address['zone_id']) && tep_not_null($address['zone_id'])) {
                    $state = tep_get_zone_code($address['country_id'], $address['zone_id'], $state);
                }
            } elseif (isset($address['country']) && tep_not_null($address['country'])) {
                if (is_array($address['country'])) {
                    $country = $this->_output_string_protected($address['country']['title']);
                } else {
                    $country = $this->_output_string_protected($address['country']);
                }
            } else {
                $country = '';
            }

            $postcode = $this->_output_string_protected($address['postcode']);

            if ($html) {
                $HR = '<hr>';
                $hr = '<hr>';
                if (($boln == '') && ($eoln == "\n")) {
                    $CR = '<br>';
                    $cr = '<br>';
                    $eoln = $cr;
                } else {
                    $CR = $eoln . $boln;
                    $cr = $CR;
                }
            } else {
                $CR = $eoln;
                $cr = $CR;
                $HR = '----------------------------------------';
                $hr = '----------------------------------------';
            }

            $statecomma = '';
            $streets = $street;
            if (!empty($suburb)) {
                $streets = $street . $cr . $suburb;
            }

            if (!empty($state)) {
                $statecomma = $state . ', ';
            }

            $fmt = $address_format['format'];
            eval("\$address = \"$fmt\";");

            if ((ACCOUNT_COMPANY == 'true') && (tep_not_null($company))) {
                $address = $company . $cr . $address;
            }

            return $address;
        }

        /**
         *
         * @param type $string
         * @param type $translate
         * @param type $protected
         * @return type
         */
        function _output_string($string, $translate = false, $protected = false)
        {
            if ($protected == true) {
                return htmlspecialchars($string);
            } else {
                if ($translate == false) {
                    return $this->_parse_input_field_data($string, ['"' => '&quot;']);
                } else {
                    return $this->_parse_input_field_data($string, $translate);
                }
            }
        }

        /**
         *
         * @param type $string
         * @return type
         */
        function _output_string_protected($string)
        {
            return $this->_output_string($string, false, true);
        }

        /**
         *
         * @param type $data
         * @param type $parse
         * @return type
         */
        function _parse_input_field_data($data, $parse)
        {
            return strtr(trim($data), $parse);
        }

        /**
         *
         * @param type $page
         * @param type $parameters
         * @param type $connection
         * @param type $add_session_id
         * @param type $unused
         * @param type $escape_html
         * @return string
         * @global type $request_type
         * @global type $session_started
         * @global type $SID
         */
        function _href_link(
            $page = '',
            $parameters = '',
            $connection = 'NONSSL',
            $add_session_id = true,
            $unused = true,
            $escape_html = true
        ) {
            return addHostnameToLink(tep_href_link($page, $parameters));
        }

        /*
         * Checks whether the payment has been “installed” through the admin panel
         * @return type
         */

        function check()
        {
            if (!isset($this->_check)) {
                $check_query = tep_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYMENT_MULTISAFEPAY_STATUS'");
                $this->_check = tep_db_num_rows($check_query);
            }

            return $this->_check;
        }

        /*
         * Installs the configuration keys into the database
         */

        public static function install()
        {
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('MultiSafepay enabled', 'MODULE_PAYMENT_MULTISAFEPAY_STATUS', 'True', 'Enable MultiSafepay payments for this website', '6', '20', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Type account', 'MODULE_PAYMENT_MULTISAFEPAY_API_SERVER', 'Live account', '<a href=\'https://testmerchant.multisafepay.com/signup\' target=\'_blank\' style=\'text-decoration: underline; font-weight: bold; color:#696916; \'>Sign up for a free test account!</a>', '6', '21', 'tep_cfg_select_option(array(\'Live account\', \'Test account\'), ', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('API Key', 'MODULE_PAYMENT_MULTISAFEPAY_API_KEY', '', 'Your MultiSafepay API Key', '6', '22', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Auto Redirect', 'MODULE_PAYMENT_MULTISAFEPAY_AUTO_REDIRECT', 'True', 'Enable auto redirect after payment', '6', '20', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Payment Zone', 'MODULE_PAYMENT_MULTISAFEPAY_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '25', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort order of display.', 'MODULE_PAYMENT_MULTISAFEPAY_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Daysactive', 'MODULE_PAYMENT_MULTISAFEPAY_DAYS_ACTIVE', '', 'The number of days a paymentlink remains active.', '6', '22', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Google Analytics', 'MODULE_PAYMENT_MULTISAFEPAY_GA', '', 'Google Analytics Account ID', '6', '22', now())");

            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Initialized Order Status', 'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_INITIALIZED', 0, 'In progress', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Completed Order Status',   'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_COMPLETED',   0, 'Completed successfully', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Uncleared Order Status',   'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_UNCLEARED',   0, 'Not yet cleared', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Reserved Order Status',    'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_RESERVED',    0, 'Reserved', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Voided Order Status',      'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_VOID',        0, 'Cancelled', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Declined Order Status',    'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_DECLINED',    0, 'Declined (e.g. fraud, not enough balance)', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Reversed Order Status',    'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_REVERSED',    0, 'Undone', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Refunded Order Status',    'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_REFUNDED',    0, 'refunded', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Expired Order Status',     'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_EXPIRED',     0, 'Expired', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Partial refunded Order Status',     'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_PARTIAL_REFUNDED',     0, 'Partial Refunded', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
            tep_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable payment method icons', 'MODULE_PAYMENT_MULTISAFEPAY_TITLES_ICON_DISABLED', 'False', 'Enable payment method icons in front of the title', '6', '20', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        }

        /*
         * Removes the configuration keys from the database
         */

        function remove()
        {
            tep_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key IN ('" . implode(
                    "', '",
                    $this->keys()
                ) . "')");
        }

        /*
         * Defines an array containing the configuration key keys that are used by
         * the payment module
         *
         * @return type
         */

        public static function keys()
        {
            return [
                'MODULE_PAYMENT_MULTISAFEPAY_STATUS',
                'MODULE_PAYMENT_MULTISAFEPAY_API_SERVER',
                'MODULE_PAYMENT_MULTISAFEPAY_API_KEY',
                'MODULE_PAYMENT_MULTISAFEPAY_AUTO_REDIRECT',
                'MODULE_PAYMENT_MULTISAFEPAY_ZONE',
                'MODULE_PAYMENT_MULTISAFEPAY_SORT_ORDER',
                'MODULE_PAYMENT_MULTISAFEPAY_DAYS_ACTIVE',
                'MODULE_PAYMENT_MULTISAFEPAY_GA',
                'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_INITIALIZED',
                'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_COMPLETED',
                'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_UNCLEARED',
                'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_RESERVED',
                'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_VOID',
                'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_DECLINED',
                'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_REVERSED',
                'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_REFUNDED',
                'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_EXPIRED',
                'MODULE_PAYMENT_MULTISAFEPAY_ORDER_STATUS_ID_PARTIAL_REFUNDED',
                'MODULE_PAYMENT_MULTISAFEPAY_TITLES_ICON_DISABLED',
            ];
        }

        /**
         *
         * @return type
         * @global type $PHP_SELF
         */
        function getScriptName()
        {
            global $PHP_SELF;
            return basename($PHP_SELF);
        }

        /**
         *
         * @param type $admin
         * @return type
         */
        function getTitle($admin = 'title')
        {

            if (MODULE_PAYMENT_MULTISAFEPAY_TITLES_ICON_DISABLED != 'False') {
                $title = ($this->checkView() == "checkout") ? $this->generateIcon($this->getIcon()) . " " : "";
            } else {
                $title = "";
            }

            $title .= ($this->checkView() == "admin") ? "MultiSafepay - " : "";

            if ($admin && $this->checkView() == "admin") {
                $title .= $admin;
            } else {
                $title .= $this->getLangStr($admin);
            }

            return $title;
        }

        /**
         *
         * @param type $str
         * @return type
         */
        function getLangStr($str)
        {
            switch ($str) {
                //Payment methods
                case "title":
                    return getConstantValue("MODULE_PAYMENT_MULTISAFEPAY_TEXT_TITLE", $str);
                case "iDEAL":
                    return getConstantValue("MODULE_PAYMENT_MSP_IDEAL_TEXT_TITLE", $str);
                case "Banktransfer":
                    return getConstantValue("MODULE_PAYMENT_MSP_BANKTRANS_TEXT_TITLE", $str);
                case "Giropay":
                    return getConstantValue("MODULE_PAYMENT_MSP_GIROPAY_TEXT_TITLE", $str);
                case "VISA":
                    return getConstantValue("MODULE_PAYMENT_MSP_VISA_TEXT_TITLE", $str);
                case "American Express":
                    return getConstantValue("MODULE_PAYMENT_MSP_AMEX_TEXT_TITLE", $str);
                case "Direct Debit":
                    return getConstantValue("MODULE_PAYMENT_MSP_DIRDEB_TEXT_TITLE", $str);
                case "Bancontact":
                    return getConstantValue("MODULE_PAYMENT_MSP_BANCONTACT_TEXT_TITLE", $str);
                case "MasterCard":
                    return getConstantValue("MODULE_PAYMENT_MSP_MASTERCARD_TEXT_TITLE", $str);
                case "PayPal":
                    return getConstantValue("MODULE_PAYMENT_MSP_PAYPAL_TEXT_TITLE", $str);
                case "Maestro":
                    return getConstantValue("MODULE_PAYMENT_MSP_MAESTRO_TEXT_TITLE", $str);
                case "SOFORT Banking":
                    return getConstantValue("MODULE_PAYMENT_MSP_SOFORT_TEXT_TITLE", $str);
                case "Ferbuy":
                    return getConstantValue("MODULE_PAYMENT_MSP_FERBUY_TEXT_TITLE", $str);
                case "EPS":
                    return getConstantValue("MODULE_PAYMENT_MSP_EPS_TEXT_TITLE", $str);
                case "Dotpay":
                    return getConstantValue("MODULE_PAYMENT_MSP_DOTPAY_TEXT_TITLE", $str);
                case "Paysafecard":
                    return getConstantValue("MODULE_PAYMENT_MSP_PAYSAFECARD_TEXT_TITLE", $str);
                case "E-Invoice":
                    return getConstantValue("MODULE_PAYMENT_MSP_EINVOICE_TEXT_TITLE", $str);
                case "Klarna":
                    return getConstantValue("MODULE_PAYMENT_MSP_KLARNA_TEXT_TITLE", $str);
                //Giftcards
                case "Boekenbon":
                    return getConstantValue("MODULE_PAYMENT_MSP_BOEKENBON_TEXT_TITLE", $str);
                case "De Grote Speelgoedwinkel":
                    return getConstantValue("MODULE_PAYMENT_MSP_DEGROTESPEELGOEDWINKEL_TEXT_TITLE", $str);
                case "Erotiekbon":
                    return getConstantValue("MODULE_PAYMENT_MSP_EROTIEKBON_TEXT_TITLE", $str);
                case "Webshopgiftcard":
                    return getConstantValue("MODULE_PAYMENT_MSP_WEBSHOPGIFTCARD_TEXT_TITLE", $str);
                case "ParfumNL":
                    return getConstantValue("MODULE_PAYMENT_MSP_PARFUMNL_TEXT_TITLE", $str);
                case "Parfumcadeaukaart":
                    return getConstantValue("MODULE_PAYMENT_MSP_PARFUMCADEAUKAART_TEXT_TITLE", $str);
                case "Gezondheidsbon":
                    return getConstantValue("MODULE_PAYMENT_MSP_GEZONDHEIDSBON_TEXT_TITLE", $str);
                case "FashionCheque":
                    return getConstantValue("MODULE_PAYMENT_MSP_FASHIONCHEQUE_TEXT_TITLE", $str);
                case "Fashion Giftcard":
                    return getConstantValue("MODULE_PAYMENT_MSP_FASHIONGIFTCARD_TEXT_TITLE", $str);
                case "Lief! cadeaukaart":
                    return getConstantValue("MODULE_PAYMENT_MSP_LIEF_TEXT_TITLE", $str);
                case "Bloemencadeau":
                    return getConstantValue("MODULE_PAYMENT_MSP_BLOEMENCADEAU_TEXT_TITLE", $str);
                case "Brouwmarkt":
                    return getConstantValue("MODULE_PAYMENT_MSP_BROUWMARKT_TEXT_TITLE", $str);
                case "Fietsenbon":
                    return getConstantValue("MODULE_PAYMENT_MSP_FIETSENBON_TEXT_TITLE", $str);
                case "Givacard":
                    return getConstantValue("MODULE_PAYMENT_MSP_GIVACARD_TEXT_TITLE", $str);
                case "Goodcard":
                    return getConstantValue("MODULE_PAYMENT_MSP_GOODCARD_TEXT_TITLE", $str);
                case "Jewelstore":
                    return getConstantValue("MODULE_PAYMENT_MSP_JEWELSTORE_TEXT_TITLE", $str);
                case "Kelly Giftcard":
                    return getConstantValue("MODULE_PAYMENT_MSP_KELLYGIFTCARD_TEXT_TITLE", $str);
                case "Nationale Tuinbon":
                    return getConstantValue("MODULE_PAYMENT_MSP_NATIONALETUINBON_TEXT_TITLE", $str);
                case "Podium":
                    return getConstantValue("MODULE_PAYMENT_MSP_PODIUM_TEXT_TITLE", $str);
                case "Sport & Fit":
                    return getConstantValue("MODULE_PAYMENT_MSP_SPORTNFIT_TEXT_TITLE", $str);
                case "VVV Giftcard":
                    return getConstantValue("MODULE_PAYMENT_MSP_VVVGIFTCARD_TEXT_TITLE", $str);
                case "Wellness Giftcard":
                    return getConstantValue("MODULE_PAYMENT_MSP_WELLNESSGIFTCARD_TEXT_TITLE", $str);
                case "Wijncadeaukaart":
                    return getConstantValue("MODULE_PAYMENT_MSP_WIJNCADEAUKAART_TEXT_TITLE", $str);
                case "Winkelcheque":
                    return getConstantValue("MODULE_PAYMENT_MSP_WINKELCHEQUE_TEXT_TITLE", $str);
                case "Yourgift":
                    return getConstantValue("MODULE_PAYMENT_MSP_YOURGIFT_TEXT_TITLE", $str);
                case "Beauty and wellness":
                    return getConstantValue("MODULE_PAYMENT_MSP_BEAUTYANDWELLNESS_TEXT_TITLE", $str);
                case getConstantValue("MODULE_PAYMENT_MULTISAFEPAY_TEXT_TITLE", $str):
                    return getConstantValue("MODULE_PAYMENT_MULTISAFEPAY_TEXT_TITLE", $str);
            }
        }

        /**
         *
         * @return string
         */
        function checkView()
        {
            $view = "admin";

            if (!tep_session_is_registered('admin')) {
                if ($this->getScriptName() == 'checkout_payment.php') {
                    $view = "checkout";
                } else {
                    $view = "frontend";
                }
            }

            return $view;
        }

        /**
         *
         * @param type $icon
         * @return type
         */
        function generateIcon($icon)
        {
            return tep_image(
                $icon,
                '',
                50,
                23,
                'style="display:inline-block;vertical-align: middle;height:100%;margin-right:10px;"'
            );
        }

        /**
         *
         * @return string
         */
        function getIcon()
        {
            $icon = __DIR__ . "/images/multisafepay/en/" . $this->icon;

            if (file_exists(__DIR__ . "/images/multisafepay/" . strtolower($this->getUserLanguage("DETECT")) . "/" . $this->icon)) {
                $icon = __DIR__ . "/images/multisafepay/" . strtolower($this->getUserLanguage("DETECT")) . "/" . $this->icon;
            }

            return $icon;
        }

        /**
         *
         * @param type $savedSetting
         * @return string
         * @global type $languages_id
         */
        function getUserLanguage($savedSetting)
        {
            if ($savedSetting != "DETECT") {
                return $savedSetting;
            }

            global $languages_id;

            $query = tep_db_query("select languages_id, name, code, image, directory from " . TABLE_LANGUAGES . " where languages_id = " . (int)$languages_id . " limit 1");

            if ($languages = tep_db_fetch_array($query)) {
                return strtoupper($languages['code']);
            }

            return "EN";
        }

        /**
         *
         * @param type $lang
         * @return string
         */
        function getLocale($lang)
        {
            switch ($lang) {
                case "dutch":
                    $lang = 'nl_NL';
                    break;
                case "spanish":
                    $lang = 'es_ES';
                    break;
                case "french":
                    $lang = 'fr_FR';
                    break;
                case "german":
                    $lang = 'de_DE';
                    break;
                case "english":
                    $lang = 'en_GB';
                    break;
                case "italian":
                case "italiano":
                    $lang = 'it_IT';
                    break;
                default:
                    $lang = 'en_GB';
                    break;
            }

            return $lang;
        }

        /**
         *
         * @param type $country
         * @return type
         */
        function getcountry($country)
        {
            if (empty($country)) {
                $langcode = explode(";", $_SERVER['HTTP_ACCEPT_LANGUAGE']);
                $langcode = explode(",", $langcode['0']);
                return strtoupper($langcode['1']);
            } else {
                return strtoupper($country);
            }
        }

        /**
         *
         * @param type $order_id
         * @param type $customer_id
         * @return type
         */
        function get_hash($order_id, $customer_id)
        {
            return md5($order_id . $customer_id);
        }
    }

}
