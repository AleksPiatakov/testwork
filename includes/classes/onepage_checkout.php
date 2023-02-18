<?php

class osC_onePageCheckout
{

    public function __construct()
    {
        $this->buildSession();
    }

    public function reset()
    {
        $this->buildSession(true);
    //  $this->buildSession();
    }

    public function buildSession($forceReset = false)
    {
        global $onepage, $payment, $shipping, $customer_id, $sendto, $billto;
        if (!tep_session_is_registered('onepage') || $forceReset === true) {
            if (tep_session_is_registered('onepage')) {
                tep_session_unregister('onepage');
            }
            if (tep_session_is_registered('payment')) {
                tep_session_unregister('payment');
            }
            if (tep_session_is_registered('shipping')) {
                tep_session_unregister('shipping');
            }
            if (tep_session_is_registered('billto')) {
                tep_session_unregister('billto');
            }
            if (tep_session_is_registered('sendto')) {
                tep_session_unregister('sendto');
            }
            if (tep_session_is_registered('customer_shopping_points_spending')) {
                tep_session_unregister('customer_shopping_points_spending');
            }

            $onepage = array(
            'info'           => array(
            'payment_method' => '', 'shipping_method' => '', 'comments' => '', 'coupon' => ''
            ),
            'customer'       => array(
            'firstname' => '',  'lastname' => '', 'company' => '',  'street_address' => '',
            'suburb' => '',     'city' => '',     'postcode' => '', 'state' => '',
            'zone_id' => '',    'country' => array('id' => '', 'title' => '', 'iso_code_2' => '', 'iso_code_3' => ''),
            'format_id' => '',  'telephone' => '', 'email_address' => '', 'password' => '', 'newsletter' => ''
            ),
            'delivery'       => array(
            'firstname' => '',  'lastname' => '', 'company' => '',  'street_address' => '',
            'suburb' => '',     'city' => '',     'postcode' => '', 'state' => '',
            'zone_id' => '',    'country' => array('id' => '', 'title' => '', 'iso_code_2' => '', 'iso_code_3' => ''),
            'country_id' => '', 'format_id' => ''
            ),
            'billing'        => array(
            'firstname' => '',  'lastname' => '', 'company' => '',  'street_address' => '',
            'suburb' => '',     'city' => '',     'postcode' => '', 'state' => '',
            'zone_id' => '',    'country' => array('id' => '', 'title' => '', 'iso_code_2' => '', 'iso_code_3' => ''),
            'country_id' => '', 'format_id' => ''
            ),
            'create_account'  => false,
            'shippingEnabled' => true
            );
            $payment = false;
            $shipping = false;
            $sendto = 0;
            $billto = 0;
            tep_session_register('onepage');
            tep_session_register('payment');
            tep_session_register('shipping');
            tep_session_register('billto');
            tep_session_register('sendto');
        }


        if (empty($onepage['customer']['postcode'])) {
            $onepage['customer']['postcode'] = ONEPAGE_AUTO_SHOW_DEFAULT_ZIP;
        }
        if (empty($onepage['billing']['postcode'])) {
            $onepage['billing']['postcode'] = ONEPAGE_AUTO_SHOW_DEFAULT_ZIP;
        }
        if (empty($onepage['delivery']['postcode'])) {
            $onepage['delivery']['postcode'] = ONEPAGE_AUTO_SHOW_DEFAULT_ZIP;
        }


        if (empty($onepage['billing']['country']['iso_code_2']) and empty($onepage['delivery']['country']['iso_code_2'])) {
            $countries = tep_db_query("select countries_name, countries_iso_code_2, countries_iso_code_3 from " . TABLE_COUNTRIES . " where countries_id = " . (int)STORE_COUNTRY);
            $cntr = tep_db_fetch_array($countries);
            $country_array = array('id' => STORE_COUNTRY, 'title' => $cntr['countries_name'], 'iso_code_2' => $cntr['countries_iso_code_2'], 'iso_code_3' => $cntr['countries_iso_code_3']);
            $onepage['billing']['country'] = $onepage['delivery']['country'] = $onepage['customer']['country'] = $country_array;
        }

        if (tep_session_is_registered('customer_id') && is_numeric($customer_id)) {
            $onepage['create_account'] = false;

            $QcustomerEmail = tep_db_query('select customers_firstname, customers_lastname, customers_email_address, customers_telephone from ' . TABLE_CUSTOMERS . ' where customers_id = ' . (int)$customer_id);
            $customerEmail = tep_db_fetch_array($QcustomerEmail);
            $onepage['customer']['email_address'] = $onepage['customer']['email_address'] ?: $customerEmail['customers_email_address'];
            $onepage['customer']['telephone'] = $onepage['customer']['telephone'] ?: $customerEmail['customers_telephone'];
            //for customer name in orders in admin
            $onepage['customer']['firstname'] = $onepage['customer']['firstname'] ?: $customerEmail['customers_firstname'];
            $onepage['customer']['lastname'] = $onepage['customer']['lastname'] ?: $customerEmail['customers_lastname'];
        }
    }

    public function fixZoneName($zone_id, $country, &$state)
    {
        if ($zone_id > 0 && $country > 0) {
            $zone_query = tep_db_query("select distinct zone_name from " . TABLE_ZONES . " where zone_country_id = " . (int)$country . " and zone_id = " . (int)$zone_id);
            if (tep_db_num_rows($zone_query) == 1) {
                $zone = tep_db_fetch_array($zone_query);
                $state = $zone['zone_name'];
            }
        }
    }

    public function loadSessionVars($type = 'checkout')
    {
        global $order, $onepage, $payment, $shipping, $comments, $coupon, $addressTypeIdentificators;
        if (tep_not_null($onepage['info']['payment_method'])) {
            $payment = $onepage['info']['payment_method'];

            if (isset($GLOBALS[$payment])) {
                $pModule = $GLOBALS[$payment];
                if (isset($pModule->public_title)) {
                    $order->info['payment_method'] = $pModule->public_title;
                } else {
                    $order->info['payment_method'] = $pModule->title;
                }


                if (isset($pModule->order_status) && is_numeric($pModule->order_status) && ($pModule->order_status > 0)) {
                    $order->info['order_status'] = $pModule->order_status;
                }
            }
        }
        if (tep_not_null($onepage['info']['shipping_method'])) {
            $shipping = $onepage['info']['shipping_method'];
            $order->info['shipping_method'] = $shipping['title'];
            $order->info['shipping_cost'] = $shipping['cost'] = $order->info['free_ship'] == '1' ? 0 : $shipping['cost'];
        }
        if (tep_not_null($onepage['info']['comments'])) {
            $comments = $onepage['info']['comments'];
            if (!tep_session_is_registered('comments')) {
                tep_session_register('comments');
            }
        }

    //  if ($onepage['customer']['firstname'] == ''){
            $onepage['customer'] = array_merge($onepage['customer'], $onepage[$addressTypeIdentificators['first']['orderPrefix']]);
//      }

        if ($onepage[$addressTypeIdentificators['second']['orderPrefix']]['firstname'] == '') {
            $onepage[$addressTypeIdentificators['second']['orderPrefix']] = array_merge($onepage[$addressTypeIdentificators['second']['orderPrefix']], $onepage[$addressTypeIdentificators['first']['orderPrefix']]);
        }

        if (ACCOUNT_STATE == 'true') {
            $this->fixZoneName($onepage['customer']['zone_id'], $onepage['customer']['country']['id'], $onepage['customer']['state']);
            $this->fixZoneName($onepage['billing']['zone_id'], $onepage['billing']['country']['id'], $onepage['billing']['state']);
            $this->fixZoneName($onepage['delivery']['zone_id'], $onepage['delivery']['country']['id'], $onepage['delivery']['state']);
        }

        $order->customer = $onepage['customer'];
        $order->billing = $onepage['billing'];
        $order->delivery = $onepage['delivery'];
    }

    public function init()
    {
        $this->verifyContents();
//      if (!isset($_GET['payment_error'])){
//          $this->reset();
//      }

//      if (STOCK_CHECK == 'true' && STOCK_ALLOW_CHECKOUT != 'true') {
//          $this->checkStock();
//      }

        $this->setDefaultSendTo();
        $this->setDefaultBillTo();

        $this->removeCCGV();
    }

    public function checkEmailAddress($emailAddress, $ajax = true)
    {
        $success = 'true';
        $errMsg = '';

        $Qcheck = tep_db_query('select customers_id from ' . TABLE_CUSTOMERS . ' where customers_email_address = "' . tep_db_prepare_input($emailAddress) . '"');
        if (tep_db_num_rows($Qcheck)) {
            $success = 'false';
            $errMsg = TEXT_EMAIL_EXISTS . ' <a href=' . tep_href_link('login.php?from=/checkout.php') . '>' . TEXT_EMAIL_EXISTS2 . '</a> ' . TEXT_EMAIL_EXISTS3;
        } else {
            require_once('includes/functions/validations.php');
            if (tep_validate_email($emailAddress) === false) {
                $success = 'false';
                $errMsg = TEXT_EMAIL_WRONG;
            }
        }
        if ($ajax == true) {
            return '{
        "success": "' . $success . '",
        "errMsg": "' . $errMsg . '"
      }';
        } else {
            return $success;
        }
    }

    public function getAjaxStateFieldAddress($manualCid = false, $zone_id = 0, $state = '')
    {
        global $onepage;
        $country = $manualCid;
        $name = 'state';
        $key = '';
        $html = '';
        $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = " . (int)$country);
        $check = tep_db_fetch_array($check_query);
        if ($check['total'] > 0) {
            $zones_array = array(
            array('id' => '', 'text' => TEXT_PLEASE_SELECT)
            );
            $zones_query = tep_db_query("select zone_id, zone_code, zone_name from " . TABLE_ZONES . " where zone_country_id = " . (int)$country . " order by zone_name");
            $selected = '';
            while ($zones_values = tep_db_fetch_array($zones_query)) {
                if ($zone_id > 0 || !empty($state)) {
                    if ($zone_id == $zones_values['zone_id']) {
                        $selected = $zones_values['zone_name'];
                    } elseif (!empty($state) && $state == $zones_values['zone_name']) {
                        $selected = $zones_values['zone_name'];
                    } elseif (isset($_POST['curValue']) && $_POST['curValue'] == $zones_values['zone_name']) {
                        $selected = $zones_values['zone_name'];
                    }
                }
                $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
            }
            $html .= tep_draw_pull_down_menu($name, $zones_array, $selected, 'class="required" style="width:70%;float:left;"');
        } else {
            $html .= tep_draw_input_field($name, (!empty($state) ? $state : ''), 'class="required" style="width:70%;float:left;"');
        }
        return $html;
    }

    public function setPaymentMethod($method)
    {
        global $payment_modules, $language, $order, $cart, $payment, $onepage, $customer_shopping_points_spending;
        /* Comment IF statement below for oscommerce versions before MS2.2 RC2a */
//      if (tep_session_is_registered('payment') && tep_not_null($payment) && $payment != $method){
//          $GLOBALS[$payment]->selection();
//      }

        $payment = $method;
        if (!tep_session_is_registered('payment')) {
            tep_session_register('payment');
        }
        $onepage['info']['payment_method'] = $method;

        $order->info['payment_method'] = $GLOBALS[$payment]->title;

            /* Comment line below for oscommerce versions before MS2.2 RC2a */
    //      $confirmation = $GLOBALS[$payment]->confirmation();

            /* Uncomment line below for oscommerce versions before MS2.2 RC2a */
            $confirmation = $GLOBALS[$payment]->selection();

        $inputFields = '';
        if ($confirmation !== false && is_array($confirmation['fields'])) {
            for ($i = 0, $n = sizeof($confirmation['fields']); $i < $n; $i++) {
                $inputFields .= '
			        <div class="row item">
                      <div class="">' . $confirmation['fields'][$i]['title'] . '</div>
                      <div class="col-xs-12">' . $confirmation['fields'][$i]['field'] . '</div>
                    </div>
			    ';
            }

            if ($confirmation['id'] == 'cc') {
                $inputFields = '<div class="credit_card_info">' . $inputFields . '</div>';
            }
            $inputFields = '<div class="paymentFields">' . $inputFields . '</div>';
        }

    // raid ------ minimum order!!!---------------- //
     //         if(MIN_ORDER>$cart->show_total()) $r_minsum = '<input type="hidden" id="minsum" value="'.MIN_ORDER.'" />';
     //         else $r_minsum = '';
     //        $inputFields .= $r_minsum;
    // raid ------ minimum order!!!---------------- //

        $_SESSION['payment'] = $payment;
        $_SESSION['onepage'] = $onepage;

        $input_fields = array($inputFields);
        return '{
      "success": "true",
      "inputFields": ' . json_encode($input_fields) . '
    }';
    }

    public function setShippingMethod($method = '')
    {
        global $shipping_modules, $language, $order, $cart, $shipping, $onepage;

        if (defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') {
            $pass = false;

            switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
                case 'national':
                    if ($order->delivery['country_id'] == STORE_COUNTRY) {
                        $pass = true;
                    }
                    break;
                case 'international':
                    if ($order->delivery['country_id'] != STORE_COUNTRY) {
                        $pass = true;
                    }
                    break;
                case 'both':
                    $pass = true;
                    break;
            }

            // disable free shipping for Alaska and Hawaii
            $zone_code = tep_get_zone_code($order->delivery['country']['id'], $order->delivery['zone_id'], '');
            if (in_array($zone_code, array('AK', 'HI'))) {
                $pass = false;
            }

            $free_shipping = false;
            if ($pass == true && $order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) {
                $free_shipping = true;
                $order->info['free_ship'] = '1';
                includeLanguages(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');
            }
        } else {
            $free_shipping = false;
        }

        if (!tep_session_is_registered('shipping')) {
            tep_session_register('shipping');
        }
//      $shipping = false;
//      $onepage['info']['shipping_method'] = false;

        if (tep_count_shipping_modules() > 0 || $free_shipping == true) {
            if (strpos($method, '_')) {
                $shipping_name = $method;

                list($module, $method) = explode('_', $shipping_name);
                global $$module;
                if (is_object($$module) || $shipping_name == 'free_free') {
                    $quote = $shipping_modules->quote($method, $module);

                    if (isset($quote['error'])) {
                        unset($shipping);
                    } else {
                        if (isset($quote[0]['methods'][0]['title']) && isset($quote[0]['methods'][0]['cost']) || $shipping == 'free_free') {
                            $shipping = array(
                            'id' => $shipping_name,
                //          'title' => (($shipping == 'free_free') ?  FREE_SHIPPING_TITLE : $quote[0]['module'] . ' (' . $quote[0]['methods'][0]['title'] . ')'),
                            'title' => (($shipping == 'free_free') ?  FREE_SHIPPING_TITLE : $quote[0]['module'] . ''),
                            'cost' => (($shipping == 'free_free') ? '0' : $quote[0]['methods'][0]['cost'])
                            );
                            $onepage['info']['shipping_method'] = $shipping;
                        }
                    }
                } else {
                    unset($shipping);
                }
            }
        }
        $_SESSION['shipping'] = $shipping;
        $_SESSION['onepage'] = $onepage;
        return '{
        "success": "true"
      }';
    }

    public function setCheckoutAddress($action)
    {
        global $order, $onepage,$customer_id, $addressTypeIdentificators;
        if ($action == 'setSendTo' && !tep_not_null($_POST[$addressTypeIdentificators['second']['fullPrefix'] . '_country'])) {
            $prefix = $addressTypeIdentificators['first']['fullPrefix'] . '_';
        } else {
            $prefix = ($action == 'setSendTo' ? 'shipping_' : 'billing_');
        }


        if (ACCOUNT_COMPANY == 'true') {
            $company = tep_db_prepare_input($_POST[$prefix . 'company']);
        }
        if (ACCOUNT_SUBURB == 'true') {
            $suburb = tep_db_prepare_input($_POST[$prefix . 'suburb']);
        }

        if (!isset($_POST[$prefix . 'zipcode'])) {
            if (ONEPAGE_AUTO_SHOW_BILLING_SHIPPING == 'True') {
                $zip_code = tep_db_prepare_input(ONEPAGE_AUTO_SHOW_DEFAULT_ZIP);
            }
        } else {
            $zip_code = tep_db_prepare_input($_POST[$prefix . 'zipcode']);
        }
        if (!isset($_POST[$prefix . 'country'])) {
            if (ONEPAGE_AUTO_SHOW_BILLING_SHIPPING == 'True') {
                $country = (int)STORE_COUNTRY;
            }
        } else {
            $country = (int)$_POST[$prefix . 'country'];
        }
        if (ACCOUNT_STATE == 'true') {
            if (isset($_POST[$prefix . 'zone_id'])) {
                $zone_id = (int)$_POST[$prefix . 'zone_id'];
            } else {
                if (!isset($_POST[$prefix . 'zone_id'])) {
                    if (ONEPAGE_AUTO_SHOW_BILLING_SHIPPING == 'True') {
                        if ($country == STORE_COUNTRY) {
                            $zone_id = tep_db_prepare_input(STORE_ZONE);
                        }
                    }
                } else {
                    $zone_id = false;
                }
            }
            if ($prefix == 'shipping_') {
                $state = tep_db_prepare_input($_POST['delivery_state']);
            } else {
                $state = tep_db_prepare_input($_POST[$prefix . 'state']);
            }
            $zone_name = '';
            //$zone_id = 0;
            $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = " . (int)$country);
            $check = tep_db_fetch_array($check_query);
            $entry_state_has_zones = ($check['total'] > 0);
            if ($entry_state_has_zones == true) {
                $zone_query = tep_db_query("select distinct zone_id, zone_name from " . TABLE_ZONES . " where zone_country_id = " . (int)$country . " and (zone_name = '" . tep_db_prepare_input($state) . "' or zone_id = " . (int)$zone_id . ")");
                if (tep_db_num_rows($zone_query) == 1) {
                    $zone = tep_db_fetch_array($zone_query);
                    $zone_id = $zone['zone_id'];
                    $zone_name = $zone['zone_name'];
                }
            }
        }

        $QcInfo = tep_db_query('select * from ' . TABLE_COUNTRIES . ' where countries_id = ' . (int)$country);
        $cInfo = tep_db_fetch_array($QcInfo);
        if ($action == 'setBillTo') {
            $varName = 'billing';
    //      if (ACCOUNT_DOB == 'true' && tep_not_null($_POST[$prefix . 'dob'])) $dob = $_POST[$prefix . 'dob'];
        } else {
            $varName = 'delivery';
        }
        if ($action == $addressTypeIdentificators['first']['action']) {
        /*  if (ACCOUNT_DOB == 'true'){
                $dob = tep_db_prepare_input($_POST[$prefix . 'dob']);
                $order->customer['dob'] = $dob;
                $onepage['customer']['dob'] = $dob;
            }     */
            if (tep_not_null($_POST['billing_email_address'])) {
                $order->customer['email_address'] = tep_db_prepare_input($_POST['billing_email_address']);
                $onepage['customer']['email_address'] = $order->customer['email_address'];
            }

            if (tep_not_null($_POST['billing_telephone'])) {
                $order->customer['telephone'] = tep_db_prepare_input($_POST['billing_telephone']);
                $onepage['customer']['telephone'] = $order->customer['telephone'];
            }

            if (tep_not_null($_POST['password'])) {
                $onepage['customer']['password'] = tep_encrypt_password(tep_db_prepare_input($_POST['password']));
            }
        }

        //shipping fields
        if (!empty($_POST['shipping_fields']) && is_array($_POST['shipping_fields'])) {
            foreach ($_POST['shipping_fields'] as $key => $shippingField) {
                $order->{$varName}['shipping_fields'][$key] = $shippingField;
            }
        }

        $order->{$varName}['firstname'] = tep_db_prepare_input($_POST[$prefix . 'firstname']);
//      $onepage['customer']['firstname'] = $order->customer['firstname'];
//      $order->{$varName}['firstname'] = $_POST['r_firstname'];
        $order->{$varName}['lastname'] = tep_db_prepare_input($_POST[$prefix . 'lastname']);
        $order->{$varName}['company'] = tep_db_prepare_input($_POST[$prefix . 'company']);
        $order->{$varName}['street_address'] = tep_db_prepare_input($_POST[$prefix . 'street_address']);
        $order->{$varName}['suburb'] = $suburb;
        $order->{$varName}['city'] = tep_db_prepare_input($_POST[$prefix . 'city']);
        $order->{$varName}['postcode'] = $zip_code;
        $order->{$varName}['state'] = ((isset($zone_name) && tep_not_null($zone_name)) ? $zone_name : $state);
        $order->{$varName}['zone_id'] = $zone_id;
        $order->{$varName}['country'] = array(
            'id' => $cInfo['countries_id'],
            'title' => $cInfo['countries_name'],
            'iso_code_2' => $cInfo['countries_iso_code_2'],
            'iso_code_3' => $cInfo['countries_iso_code_3']
        );
        $order->{$varName}['country_id'] = $cInfo['countries_id'];
        $order->{$varName}['format_id'] = $cInfo['address_format_id'];
        if ($action == 'setSendTo' && !tep_not_null($_POST['shipping_firstname'])) {
            $vName = $addressTypeIdentificators['first']['orderPrefix'];
            $onepage['customer'] = array_merge($onepage['customer'], $order->{$vName});
        }
        $onepage['customer'] = array_merge($onepage['customer'], array('customer_id' => $customer_id));  // raid

        $onepage[$varName] = array_merge($onepage[$varName], $order->{$varName});

        $_SESSION['onepage'] = $onepage;

        return '{
        "success": "true"
      }';
    }

    public function setCheckoutAddressField()
    {
        global $onepage;
        $addressType = tep_db_input($_POST['addresstype']);
        $field = tep_db_input($_POST['field']);
        $value = tep_db_input($_POST['value']);

        $onepage[$addressType][$field] = $value;

        if ($field == 'country_id') {
            $countries = tep_db_query("select countries_name, countries_iso_code_2, countries_iso_code_3 from " . TABLE_COUNTRIES . " where countries_id = " . (int)$value);
            $cntr = tep_db_fetch_array($countries);
            $country_array = array('id' => $value, 'title' => $cntr['countries_name'], 'iso_code_2' => $cntr['countries_iso_code_2'], 'iso_code_3' => $cntr['countries_iso_code_3']);
            $onepage['billing']['country'] = $onepage['delivery']['country'] = $onepage['customer']['country'] = $country_array;
            $onepage['billing']['country_id'] = $onepage['delivery']['country_id'] = $onepage['customer']['country_id'] = $value;
            $_SESSION['customer_country_id'] = $value;
        } elseif ($field == 'zone_id') {
            $onepage['billing']['zone_id'] = $onepage['delivery']['zone_id'] = $onepage['customer']['zone_id'] = $value;
        } elseif ($field == 'zipcode') {
            $onepage['billing']['postcode'] = $onepage['delivery']['postcode'] = $onepage['customer']['postcode'] = $value;
        }

        $_SESSION['onepage'] = $onepage;

        return '{"success": "true"}';
    }

    public function setAddress($addressType, $addressID)
    {
        global $billto, $sendto, $customer_id, $onepage;
        switch ($addressType) {
            case 'billing':
                $billto = $addressID;
                if (!tep_session_is_registered('billto')) {
                    tep_session_register('billto');
                }
                $sessVar = 'billing';
                break;
            case 'shipping':
                $sendto = $addressID;
                if (!tep_session_is_registered('sendto')) {
                    tep_session_register('sendto');
                }
                $sessVar = 'delivery';
                break;
        }

        if (!empty($customer_id)) {
            $Qaddress = tep_db_query('select ab.entry_firstname, ab.entry_lastname, ab.entry_company, ab.entry_street_address, ab.entry_suburb, ab.entry_postcode, ab.entry_city, ab.entry_zone_id, z.zone_name, ab.entry_country_id, c.countries_id, c.countries_name, c.countries_iso_code_2, c.countries_iso_code_3, c.address_format_id, ab.entry_state from ' . TABLE_ADDRESS_BOOK . ' ab left join ' . TABLE_ZONES . ' z on (ab.entry_zone_id = z.zone_id) left join ' . TABLE_COUNTRIES . ' c on (ab.entry_country_id = c.countries_id) where ab.customers_id = ' . (int)$customer_id . ' and ab.address_book_id = ' . (int)$addressID);
            $address = tep_db_fetch_array($Qaddress);

            $onepage[$sessVar] = array_merge($onepage[$sessVar], array(
            'firstname' => $address['entry_firstname'], 'lastname'       => $address['entry_lastname'],
            'company'   => $address['entry_company'],   'street_address' => $address['entry_street_address'],
            'suburb'    => $address['entry_suburb'],    'city'           => $address['entry_city'],
            'postcode'  => $address['entry_postcode'],  'state'          => $address['entry_state'],
            'zone_id'   => $address['entry_zone_id'],   'country' => array(
            'id'         => $address['countries_id'],         'title'      => $address['countries_name'],
            'iso_code_2' => $address['countries_iso_code_2'], 'iso_code_3' => $address['countries_iso_code_3']
            ),
            'country_id' => $address['entry_country_id'], 'format_id' => $address['address_format_id']
            ));

            $_SESSION['customer_country_id'] = $address['entry_country_id'];
            $_SESSION['customer_zone_id'] = $address['entry_zone_id'];
        }

        if (ACCOUNT_STATE == 'true') {
            $this->fixZoneName($onepage[$sessVar]['zone_id'], $onepage[$sessVar]['country']['id'], $onepage[$sessVar]['state']);
        }

        return '{
      "success": "true"
    }';
    }

    public function saveAddress($action)
    {
 /*
        global $customer_id;
        if (ACCOUNT_COMPANY == 'true') $company = tep_db_prepare_input($_POST['company']);
        $firstname = tep_db_prepare_input($_POST['firstname']);
        $lastname = tep_db_prepare_input($_POST['lastname']);
        $street_address = tep_db_prepare_input($_POST['street_address']);
        if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($_POST['suburb']);
        $postcode = tep_db_prepare_input($_POST['postcode']);
        $city = tep_db_prepare_input($_POST['city']);
        $country = tep_db_prepare_input($_POST['country']);
        if (ACCOUNT_STATE == 'true') {
            if (isset($_POST['zone_id'])) {
                $zone_id = tep_db_prepare_input($_POST['zone_id']);
            } else {
                $zone_id = false;
            }
            $state = tep_db_prepare_input($_POST['state']);

            $zone_id = 0;
            $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
            $check = tep_db_fetch_array($check_query);
            $entry_state_has_zones = ($check['total'] > 0);
            if ($entry_state_has_zones == true) {
                $zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name = '" . tep_db_input($state) . "' or zone_code = '" . tep_db_input($state) . "')");
                if (tep_db_num_rows($zone_query) == 1) {
                    $zone = tep_db_fetch_array($zone_query);
                    $zone_id = $zone['zone_id'];
                }
            }
        }

        $sql_data_array = array(
        'customers_id'         => $customer_id,
        'entry_firstname'      => $firstname,
        'entry_lastname'       => $lastname,
        'entry_street_address' => $street_address,
        'entry_postcode'       => $postcode,
        'entry_city'           => $city,
        'entry_country_id'     => $country
        );

        if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
        if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
        if (ACCOUNT_STATE == 'true') {
            if ($zone_id > 0) {
                $sql_data_array['entry_zone_id'] = $zone_id;
                $sql_data_array['entry_state'] = '';
            } else {
                $sql_data_array['entry_zone_id'] = '0';
                $sql_data_array['entry_state'] = $state;
            }
        }

        if ($action == 'saveAddress'){
            $Qcheck = tep_db_query('select address_book_id from ' . TABLE_ADDRESS_BOOK . ' where address_book_id = "' . $_POST['address_id'] . '" and customers_id = "' . $customer_id . '"');
            if (tep_db_num_rows($Qcheck)){
                tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', 'address_book_id = "' . $_POST['address_id'] . '"');
            }
        }else{
            tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
        }

        return '{
      "success": "true"

    }';   */
    }

    public function saveAddress2()
    {
        global $customer_id, $order;

        $sql_data_array = array('customers_id'         => (int)($customer_id != 0) ? $customer_id : $order->customer['customer_id'],
                                'entry_firstname'      => tep_db_prepare_input($order->customer['firstname']),
                                'entry_lastname'       => tep_db_prepare_input($order->customer['lastname']),
                                'entry_street_address' => tep_db_prepare_input($order->customer['street_address']),
                                'entry_postcode'       => tep_db_prepare_input($order->customer['postcode']),
                                'entry_city'           => tep_db_prepare_input($order->customer['city']),
                                'entry_country_id'     => tep_db_prepare_input($order->customer['country']['id']));

        if (ACCOUNT_COMPANY == 'true') {
            $sql_data_array['entry_company'] = tep_db_prepare_input($order->customer['company']);
        }
        if (ACCOUNT_SUBURB == 'true') {
            $sql_data_array['entry_suburb'] = tep_db_prepare_input($order->customer['suburb']);
        }
        if (ACCOUNT_STATE == 'true') {
                $sql_data_array['entry_zone_id'] = (int)($order->delivery['zone_id'] ?: $order->billing['zone_id']);
                $sql_data_array['entry_state'] = $order->customer['state'];
        }

        $Qcheck_query = tep_db_query('select customers_default_address_id from ' . TABLE_CUSTOMERS . ' where customers_id = ' . (int)$customer_id);
        $Qcheck = tep_db_fetch_array($Qcheck_query);
        tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', 'address_book_id = ' . (int)$Qcheck['customers_default_address_id']);
    }

    public function processCheckout()
    {
        global $customer_id, $comments, $coupon, $order, $currencies, $request_type, $languages_id, $currency,
        $customer_shopping_points_spending, $customer_referral, $cart_PayPal_Standard_ID, $cart_PayPal_IPN_ID,
        $cart_Worldpay_Junior_ID, $shipping, $cartID, $order_total_modules, $onepage, $credit_covers, $payment,
        $payment_modules,$cart,$wishList, $lng, $paymentMethod, $order_totals, $products_ordered, $guest_account;

        $comments = tep_db_prepare_input($_POST['comments']);
        if (!tep_session_is_registered('comments')) {
            tep_session_register('comments');
        }
        $onepage['info']['comments'] = $order->info['comments'] = tep_db_prepare_input($_POST['comments']);

        if ($_POST['diffShipping']) {
            $onepage['info']['diffShipping'] = true;
            $order->info['diffShipping'] = true;
        }

        $onepage['customer']['newsletter'] = (isset($_POST['billing_newsletter']) ? tep_db_prepare_input($_POST['billing_newsletter']) : '0');

        $this->setCheckoutAddress('setSendTo');
        $this->setCheckoutAddress('setBillTo');

        $order->customer = array_merge($order->customer, $onepage['customer']);
        $order->delivery = array_merge($order->delivery, $onepage['delivery']);
        $order->billing = array_merge($order->billing, $onepage['billing']);


        if (tep_session_is_registered('customer_id') || $_POST['registration-off']) {
            $onepage['createAccount'] = false;
        } else {
            if (tep_not_null($_POST['password'])) {
                $onepage['createAccount'] = true;
                $onepage['customer']['password'] = tep_db_prepare_input($_POST['password']);
                $this->createCustomerAccount();
            } elseif (ONEPAGE_ACCOUNT_CREATE == 'create') {
                $onepage['createAccount'] = true;
                $onepage['customer']['password'] = tep_create_random_value(ENTRY_PASSWORD_MIN_LENGTH);
                $this->createCustomerAccount();
            }
        }



        $payment_modules->update_status();
        $paymentMethod = $onepage['info']['payment_method'];

        if (!isset($order_totals)) {
            $order_totals = $order_total_modules->process();
        }
 /*
        if(($order->info['total']) <=0) {//if(($order->info['total'] - $order->info['tax'] - $order->info['shipping_cost']) <=0)
            $payment = '';
            $paymentMethod = '';
            $onepage['info']['payment_method'] = '';
            //$onepage['info']['order_id'] = '';
        }  */

        if (!empty($paymentMethod)) {
            $GLOBALS[$paymentMethod]->before_process();
            $GLOBALS[$paymentMethod]->pre_confirmation_check();
            $GLOBALS[$paymentMethod]->confirmation();
              $hiddenFields = $GLOBALS[$paymentMethod]->process_button();
              $formUrl = $GLOBALS[$paymentMethod]->form_action_url;
        }

        if (isset($hiddenFields) && is_array($hiddenFields) && isset($hiddenFields['forward_url'])) {
            tep_redirect($hiddenFields['forward_url']);
        } else if (tep_not_null($GLOBALS[$paymentMethod]->form_action_url)) {
            return '<html dir="ltr" lang="ru">
                  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>Checkout</title></head>
                  <body>
                    <form id="redirectForm" action="' . $formUrl . '" method="POST">' . $hiddenFields . '</form>
                    <script>document.getElementById("redirectForm").submit();</script>
                    <div style="padding:100px;text-align:center;"><img src="' . DIR_WS_HTTP_CATALOG . DIR_WS_IMAGES . 'ajax-loader.gif"><br /><br /><br />' . TEXT_ORDER_PROCESSING . '</div>
                  </body>
              </html>';
        } else {
            include('checkout_process.php');
        }
    }

    public function createCustomerAccount()
    {
        global $currencies, $customer_id, $addressTypeIdentificators, $onepage, $customer_default_address_id, $customer_first_name, $customer_country_id, $customer_zone_id, $languages_id, $sendto, $billto, $cat_tree, $cat_names;
        //$this->checkCartValidity();
        if ($onepage['createAccount'] === true && $this->checkEmailAddress($onepage['customer']['email_address'])) {
            $vName = $addressTypeIdentificators['first']['orderPrefix'];
            $sql_data_array = array(
            'customers_firstname'     => $onepage[$vName]['firstname'],
            'customers_lastname'      => $onepage[$vName]['lastname'],
            'customers_email_address' => $onepage['customer']['email_address'],
            'customers_telephone'     => $onepage['customer']['telephone'],
            'customers_fax'           => $onepage['customer']['fax'],
            'customers_newsletter'    => $onepage['customer']['newsletter'],
            'customers_password'      => tep_encrypt_password($onepage['customer']['password'])
            );



            if (ACCOUNT_DOB == 'true') {
                $sql_data_array['customers_dob'] = tep_date_raw($onepage['customer']['dob']);
            }


            tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);
            $customer_id = tep_db_insert_id();


            $sql_data_array = array(
            'customers_id'         => (int)$customer_id,
            'entry_firstname'      => $onepage[$vName]['firstname'],
            'entry_lastname'       => $onepage[$vName]['lastname'],
            'entry_street_address' => $onepage[$vName]['street_address'],
            'entry_postcode'       => $onepage[$vName]['postcode'],
            'entry_city'           => $onepage[$vName]['city'],
            'entry_country_id'     => (int)$onepage[$vName]['country_id'],
            );



            if (ACCOUNT_COMPANY == 'true') {
                $sql_data_array['entry_company'] = $onepage[$vName]['company'];
            }
            if (ACCOUNT_SUBURB == 'true') {
                $sql_data_array['entry_suburb'] = $onepage[$vName]['suburb'];
            }
            if (ACCOUNT_STATE == 'true') {
                $sql_data_array['entry_zone_id'] = (int)$onepage[$vName]['zone_id'];
            }

            tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

            $address_id = tep_db_insert_id();
            $billto = $address_id;
            $sendto = $address_id;


            $customer_default_address_id = $address_id;
            $customer_first_name = $onepage[$vName]['firstname'];
            $customer_last_name = $onepage[$vName]['lastname'];
            $customer_country_id = $onepage[$vName]['country_id'];
            $customer_zone_id = $onepage[$vName]['zone_id'];



            tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");
            tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values (" . (int)$customer_id . ", '0', now())");

            $Qcustomer = tep_db_query('select customers_firstname, customers_lastname, customers_email_address from ' . TABLE_CUSTOMERS . ' where customers_id = ' . (int)$customer_id);
            $customer = tep_db_fetch_array($Qcustomer);

            // build the message content
            $name = $customer['customers_firstname'] . ' ' . $customer['customers_lastname'];

            $email_text = sprintf(EMAIL_GREET_NONE, $customer['customers_firstname']);


            $email_text .= sprintf(EMAIL_WELCOME, STORE_NAME);

            $email_text .= ' <br>' .
            TEXT_EMAIL_LOGIN . ': ' . $onepage['customer']['email_address'] . ':<br>' .
            TEXT_EMAIL_PASS . ': ' . $onepage['customer']['password'] . '<br><br>';

            $email_text .= EMAIL_TEXT . sprintf(EMAIL_CONTACT, STORE_OWNER_EMAIL_ADDRESS) . sprintf(EMAIL_WARNING, STORE_OWNER_EMAIL_ADDRESS);
            $subject = sprintf(EMAIL_SUBJECT, STORE_NAME);

            $onepage['createAccount'] = false;

            if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                require_once(DIR_FS_EXT . 'email_content/functions.php');
                $data = [
                    'customers_name' => $customer['customers_firstname'],
                    'email_address' => $onepage['customer']['email_address'],
                    'password' => $onepage['customer']['password'],
                ];
                $content_email_array = getCreateAccountText($languages_id, $data);
                $email_text = $content_email_array['content_html'] ? : $email_text;
                $subject = $content_email_array['subject'] ? : $subject;
            }

            tep_mail($name, $customer['customers_email_address'], $subject, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

    //      if (isset($onepage['info']['order_id'])){
    //          tep_db_query('update ' . TABLE_ORDERS . ' set customers_id = "' . $customer_id . '" where orders_id = "' . $onepage['info']['order_id'] . '"');
    //          unset($onepage['info']['order_id']);
    //      }
            if (!tep_session_is_registered('customer_id')) {
                tep_session_register('customer_id');
            }
            if (!tep_session_is_registered('customer_default_address_id')) {
                tep_session_register('customer_default_address_id');
            }
            if (!tep_session_is_registered('customer_first_name')) {
                tep_session_register('customer_first_name');
            }
            if (!tep_session_is_registered('customer_last_name')) {
                tep_session_register('customer_last_name');
            }
            if (!tep_session_is_registered('customer_country_id')) {
                tep_session_register('customer_country_id');
            }
            if (!tep_session_is_registered('customer_zone_id')) {
                tep_session_register('customer_zone_id');
            }
            if (!tep_session_is_registered('sendto')) {
                tep_session_register('sendto');
            }
            if (!tep_session_is_registered('billto')) {
                tep_session_register('billto');
            }

            if (!tep_session_is_registered('customer_default_address_id')) {
                tep_session_register('customer_default_address_id');
            }
            if (!tep_session_is_registered('customer_first_name')) {
                tep_session_register('customer_first_name');
            }
            if (!tep_session_is_registered('customer_last_name')) {
                tep_session_register('customer_last_name');
            }
            if (!tep_session_is_registered('customer_country_id')) {
                tep_session_register('customer_country_id');
            }
            if (!tep_session_is_registered('customer_zone_id')) {
                tep_session_register('customer_zone_id');
            }
            if (!tep_session_is_registered('sendto')) {
                tep_session_register('sendto');
            }
            if (!tep_session_is_registered('billto')) {
                tep_session_register('billto');
            }
        } else {
            $onepage['createAccount'] = false;
            //tep_redirect(tep_href_link(FILENAME_CHECKOUT,'error='.url_encode('Your email address already exists in our records')));
        }
    }

    public function getAddressFormatted($type)
    {
        global $order;
        switch ($type) {
            case 'sendto':
                $address = $order->delivery;
                break;
            case 'billto':
                $address = $order->billing;
                break;
        }
        if ($address['format_id'] == '') {
            $address['format_id'] = 1;
        }
        return tep_address_format($address['format_id'], $address, true, '', "\n");
    }

    public function verifyContents()
    {
        global $cart;
        // if there is nothing in the customers cart, redirect them to the shopping cart page
        if ($cart->count_contents() < 1) {
            tep_redirect(tep_href_link(FILENAME_DEFAULT));
        }
    }

    public function checkStock()
    {
        global $cart;
        $products = $cart->get_products();
        for ($i = 0, $n = sizeof($products); $i < $n; $i++) {
            if (tep_check_stock($products[$i]['id'], $products[$i]['quantity'])) {
                tep_redirect(tep_href_link(FILENAME_DEFAULT));
                break;
            }
        }
    }

    public function setDefaultSendTo()
    {
        global $sendto, $customer_id, $customer_default_address_id, $shipping;
        // if no shipping destination address was selected, use the customers own address as default
        if (!tep_session_is_registered('sendto')) {
            $sendto = $customer_default_address_id;
            tep_session_register('sendto');
        } else {
            // verify the selected shipping address
            if ((is_array($sendto) && !tep_not_null($sendto)) || is_numeric($sendto)) {
                $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = " . (int)$customer_id . " and address_book_id = " . (int)$sendto);
                $check_address = tep_db_fetch_array($check_address_query);

                if ($check_address['total'] != '1') {
                    $sendto = $customer_default_address_id;
                    if (tep_session_is_registered('shipping')) {
                        tep_session_unregister('shipping');
                    }
                }
            }
        }
        $this->setAddress('shipping', $sendto);
    }

    public function setDefaultBillTo()
    {
        global $billto, $customer_id, $customer_default_address_id, $shipping;
        // if no billing destination address was selected, use the customers own address as default
        if (!tep_session_is_registered('billto')) {
            $billto = $customer_default_address_id;
            tep_session_register('billto');
        } else {
            // verify the selected billing address
            if ((is_array($billto) && !tep_not_null($billto)) || is_numeric($billto)) {
                $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = " . (int)$customer_id . " and address_book_id = " . (int)$billto);
                $check_address = tep_db_fetch_array($check_address_query);

                if ($check_address['total'] != '1') {
                    $billto = $customer_default_address_id;
            //      if (tep_session_is_registered('payment')) tep_session_unregister($payment);
                    if (tep_session_is_registered('billing')) {
                        tep_session_unregister('billing');
                    }
                }
            }
        }
        $this->setAddress('billing', $billto);
    }

    public function removeCCGV()
    {
        global $credit_covers, $cot_gv;
        // Start - CREDIT CLASS Gift Voucher Contribution
        if (tep_session_is_registered('credit_covers')) {
            tep_session_unregister('credit_covers');
        }
        if (tep_session_is_registered('cot_gv')) {
            tep_session_unregister('cot_gv');
        }
        // End - CREDIT CLASS Gift Voucher Contribution
    }

    public function decodePostVars()
    {
        global $_POST;
        $_POST = $this->decodeInputs($_POST);
    }

    public function decodeInputs($inputs)
    {
        if (!is_array($inputs) && !is_object($inputs)) {
            if (function_exists('mb_check_encoding') && mb_check_encoding($inputs, 'windows-1251')) {
                //return utf8_decode($inputs);
                return $inputs;
            } else {
                //return mb_check_encoding($inputs,'windows-1251');
                return $inputs;
            }
        } elseif (is_array($inputs)) {
            reset($inputs);
            foreach ($inputs as $key => $value) {
                $inputs[$key] = $this->decodeInputs($value);
            }
            return $inputs;
        } else {
            return $inputs;
        }
    }

    public function createOrder($order_staus)
    {
          global $order, $order_totals, $customer_id, $cartID, $order_total_modules, $currencies, $languages_id, $language_short_link, $paymentMethod, $insert_id, $onepage;

          $order->info['order_status'] = $order_staus; // status of not paid order
          $this->saveAddress2();

          $sql_data_array = array('customers_id' =>                 (int) (($customer_id != 0) ? $customer_id : $order->customer['customer_id']),
                                  'customers_name' =>               $order->customer['firstname'] . ' ' . $order->customer['lastname'],
                                  'customers_company' =>            $order->customer['company'],
                                  'customers_street_address' =>     $order->customer['street_address'],
                                  'customers_suburb' =>             $order->customer['suburb'],
                                  'customers_city' =>               $order->customer['city'],
                                  'customers_postcode' =>           $order->customer['postcode'],
                                  'customers_state' =>              $order->customer['state'],
                                  'customers_country' =>            $order->customer['country']['title'],
                                  'customers_telephone' =>          $order->customer['telephone'],
                                  'customers_fax' =>                $order->customer['fax'],
                                  'customers_email_address' =>      $order->customer['email_address'],
                                  'customers_address_format_id' =>  (int)$order->customer['format_id'],
                                  'customers_shipping_fields' =>    json_encode($order->billing['shipping_fields']),
                                  'delivery_name' =>                $order->delivery['firstname'] . ' ' . $order->delivery['lastname'],
                                  'delivery_company' =>             $order->delivery['company'],
                                  'delivery_street_address' =>      $order->delivery['street_address'],
                                  'delivery_suburb' =>              $order->delivery['suburb'],
                                  'delivery_city' =>                $order->delivery['city'],
                                  'delivery_postcode' =>            $order->delivery['postcode'],
                                  'delivery_state' =>               $order->delivery['state'],
                                  'delivery_country' =>             $order->delivery['country']['title'],
                                  'delivery_address_format_id' =>   (int)$order->delivery['format_id'],
                                  'billing_name' =>                 $order->billing['firstname'] . ' ' . $order->billing['lastname'],
                                  'billing_company' =>              $order->billing['company'],
                                  'billing_street_address' =>       $order->billing['street_address'],
                                  'billing_suburb' =>               $order->billing['suburb'],
                                  'billing_city' =>                 $order->billing['city'],
                                  'billing_postcode' =>             $order->billing['postcode'],
                                  'billing_state' =>                $order->billing['state'] ?: $order->delivery['state'],
                                  'billing_country' =>              $order->billing['country']['title'],
                                  'billing_address_format_id' =>    (int)$order->billing['format_id'],
                                  'payment_method' =>               trim(strip_tags($order->info['payment_method'])),
                                  'shipping_method_code' =>         $order->info['shipping_method_code'],
                                  'payment_method_code' =>          $paymentMethod,
                                  'cc_type' =>                      $order->info['cc_type'],
                                  'cc_owner' =>                     $order->info['cc_owner'],
                                  'cc_number' =>                    $order->info['cc_number'],
                                  'cc_expires' =>                   $order->info['cc_expires'],
                                  'cvvnumber' =>                    (int)(trim($order->info['cvvnumber'])),
                                  'date_purchased' =>               'now()',
                                  'last_modified' =>                'now()',
                                  'orders_status' =>                $order->info['order_status'], // not paid
                                  'currency' =>                     $order->info['currency'],
                                  'currency_value' =>               $order->info['currency_value'],
                                  'customers_referer_url' =>        tep_db_prepare_input($_SESSION['referer_url']),
                                  'remote_addr' => $_SERVER['REMOTE_ADDR'],
                                   'server' => json_encode($_SERVER));
          if ($order->info['shipping_method_code'] === 'nwposhtanew') {
              if (!empty($onepage["shipping"]["np_cities"]) && !empty($onepage["shipping"]["np_warehouses"])) {
                  $sql_data_array['nwposhta_address'] = ENTRY_CITY . " " . $onepage["shipping"]["np_cities"] . " " . $onepage["shipping"]["np_warehouses"];
              } else {
                  $sql_data_array['nwposhta_address'] = getConstantValue('NWPOSHTA_FIELDS_ERROR_MSG', "Произошла ошибка");
              }
          }
          tep_db_perform(TABLE_ORDERS, $sql_data_array);
          $insert_id = tep_db_insert_id();

          $cart_payment_id = $cartID . '-' . $insert_id;
          tep_session_register('cart_payment_id');
          $_SESSION['cart_payment_id'] = $cart_payment_id;

        if (getConstantValue('MODULE_ORDER_TOTAL_COUPON_STATUS', 'false') === 'true') {
        //      $order_total_modules->collect_posts();
        //      $order_total_modules->pre_confirmation_check();
        //    $order_total_modules->process();
              $order_total_modules->apply_credit(); // apply credit: insert into " . TABLE_COUPON_REDEEM_TRACK . " ...
          }

          for ($i = 0, $n = sizeof($order_totals); $i < $n; $i++) {
              $sql_data_array = array('orders_id' =>  $insert_id,
                                    'title' =>      $order_totals[$i]['title'],
                                    'text' =>       $order_totals[$i]['text'],
                                    'value' =>      $order_totals[$i]['value'],
                                    'class' =>      $order_totals[$i]['code'],
                                    'sort_order' => $order_totals[$i]['sort_order']);
              tep_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);
          }

                $sql_data_array = array('orders_id' => $insert_id,
                                  'orders_status_id' => $order->info['order_status'],
                                  'date_added' => 'now()',
                                  'customer_notified' => '0',
                                  'comments' => $order->info['comments']);
                tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

                $products_ordered = '';

                for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
                    // Stock Update - Joao Correia
                    if (STOCK_LIMITED == 'true') {
                        if (DOWNLOAD_ENABLED == 'true') {
                            $stock_query_raw = "SELECT products_quantity, pad.products_attributes_filename
                                    FROM " . TABLE_PRODUCTS . " p
                                    LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES . " pa ON p.products_id=pa.products_id
                                    LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad ON pa.products_attributes_id=pad.products_attributes_id
                                    WHERE p.products_id = " . (int)tep_get_prid($order->products[$i]['id']);
                          // Will work with only one option for downloadable products
                          // otherwise, we have to build the query dynamically with a loop
                            $products_attributes = $order->products[$i]['attributes'];
                            if (is_array($products_attributes)) {
                                $stock_query_raw .= " AND pa.options_id = '" . $products_attributes[0]['option_id'] . "' AND pa.options_values_id = '" . $products_attributes[0]['value_id'] . "'";
                            }
                            $stock_query = tep_db_query($stock_query_raw);
                        } else {
                            $stock_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = " . (int)tep_get_prid($order->products[$i]['id']));
                        }

                        if (tep_db_num_rows($stock_query) > 0) {
                            $stock_values = tep_db_fetch_array($stock_query);
                        // do not decrement quantities if products_attributes_filename exists
                            if ((DOWNLOAD_ENABLED != 'true') || (!$stock_values['products_attributes_filename'])) {
                                $stock_left = $stock_values['products_quantity'] - $order->products[$i]['qty'];

                              // Low Stock Level Email

                                $warning_stock = STOCK_REORDER_LEVEL;
                                $current_stock = $stock_left;

                                $low_stock_email = LOW_STOCK_TEXT1 . $order->products[$i]['name'] . "\n" . LOW_STOCK_TEXT2 . $order->products[$i]['model'] . "\n" . LOW_STOCK_TEXT3 . $stock_left  . "\n" . LOW_STOCK_TEXT4 . HTTP_SERVER . DIR_WS_CATALOG . 'product_info.php?products_id=' . $order->products[$i]['id'] . "\n\n" . LOW_STOCK_TEXT5 . $warning_stock;
                                $low_stock_subject = LOW_STOCK_TEXT1 .  $order->products[$i]['name'];

                                if ($current_stock <= $warning_stock) {
                                    tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, $low_stock_subject, $low_stock_email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
                                }

                                // Low Stock Level Email
                            } else {
                                $stock_left = $stock_values['products_quantity'];
                            }
                            tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = " . (int)$stock_left . " where products_id = " . (int)tep_get_prid($order->products[$i]['id']));
                            if (
                                ($stock_left < 1) &&
                                getConstantValue('STOCK_DISABLE_NON_EXISTENT_PRODUCT_ON_CHECKOUT', false) === true
                                /*(STOCK_ALLOW_CHECKOUT == 'false')*/
                            ) {
                                tep_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = " . (int)tep_get_prid($order->products[$i]['id']));
                            }
                        }
                    }

                    // Update products_ordered (for bestsellers list)
                    tep_db_query("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . sprintf('%d', $order->products[$i]['qty']) . " where products_id = " . (int)tep_get_prid($order->products[$i]['id']));

                    //model
                    //default product article
                    $model = $order->products[$i]['model'];

                    //attribute article
                    if (is_array($order->products[$i]['attributes'])) {
                        foreach ($order->products[$i]['attributes'] as $attribute) {
                            if (!empty((int)$order->products[$i]['id']) && !empty($attribute['option_id']) && !empty($attribute['value_id'])) {
                                $attributeString = " WHERE products_id = '" . (int)$order->products[$i]['id'] . "' and options_id = '" . $attribute['option_id'] . "' and options_values_id = '" . $attribute['value_id'] . "'";
                                $query = tep_db_query("SELECT pa_article FROM products_attributes " . $attributeString);
                                $article = tep_db_fetch_array($query)['pa_article'];
                                $model = !empty($article) ? $article : $model;
                            }
                        }
                    }

                    //attribute combination article
                    if (getConstantValue('QTY_PRO_ENABLED') == 'true' && is_file(DIR_WS_EXT . 'qty_pro/prod_attributes_combination.php')) {
                        $attributeString = '';
                        if (is_array($order->products[$i]['attributes'])) {
                            foreach ($order->products[$i]['attributes'] as $option) {
                                $attributeString .= empty($attributeString) ? ' where ' : ' and ';
                                $attributeString .= 'products_stock_attributes like "%' . $option['option_id'] . '-' . $option['value_id'] . '%"';
                            }
                        }
                        if (!empty($attributeString)) {
                            $query = tep_db_query("SELECT products_vendor_code FROM products_stock " . $attributeString);
                            $model = tep_db_fetch_array($query)['products_vendor_code'] ?: $model;
                        }
                    }

                    $sql_data_array = array('orders_id' => (int)$insert_id,
                                    'products_id' => (int)tep_get_prid($order->products[$i]['id']),
                                    'products_model' => $model,
                                    'products_name' => $order->products[$i]['name'],
                                    'products_price' => $order->products[$i]['price'],
                                    'final_price' => $order->products[$i]['final_price'],
                                    'products_tax' => $order->products[$i]['tax'],
                                    'products_quantity' => (int)$order->products[$i]['qty']);
                    tep_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array);

                    $order_products_id = tep_db_insert_id();

                    $order_total_modules->update_credit_account($i); //ICW ADDED FOR CREDIT CLASS SYSTEM

                    $products_ordered_attributes = '';
                    $products_ordered_attributes_array = array();

                    if (isset($order->products[$i]['attributes'])) {
                        for ($j = 0, $n2 = sizeof($order->products[$i]['attributes']); $j < $n2; $j++) {
                            if (STOCK_LIMITED == 'true' and isset($order->products[$i]['qty']) and !empty($order->products[$i]['qty'])) {
                                tep_db_query('UPDATE products_attributes SET pa_qty = IF(pa_qty > 0, pa_qty - ' . (int)$order->products[$i]['qty'] . ', 0) WHERE products_id = ' . (int)tep_get_prid($order->products[$i]['id']) . ' and options_id = ' . (int)$order->products[$i]['attributes'][$j]['option_id'] . ' and options_values_id = ' . (int)$order->products[$i]['attributes'][$j]['value_id']);
                            }

                            if (DOWNLOAD_ENABLED == 'true') {
                                $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_id, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount , pad.products_attributes_filename from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad on pa.products_attributes_id=pad.products_attributes_id where pa.products_id = " . (int)tep_get_prid($order->products[$i]['id']) . " and pa.options_id = " . (int)$order->products[$i]['attributes'][$j]['option_id'] . " and pa.options_id = popt.products_options_id and pa.options_values_id = " . (int)$order->products[$i]['attributes'][$j]['value_id'] . " and pa.options_values_id = poval.products_options_values_id and popt.language_id = " . (int)$languages_id . " and poval.language_id = " . (int)$languages_id);
                            } else {
                                  $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.pa_qty, poval.products_options_values_id, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = " . (int)tep_get_prid($order->products[$i]['id']) . " and pa.options_id = " . (int)$order->products[$i]['attributes'][$j]['option_id'] . " and pa.options_id = popt.products_options_id and pa.options_values_id = " . (int)$order->products[$i]['attributes'][$j]['value_id'] . " and pa.options_values_id = poval.products_options_values_id and popt.language_id = " . (int)$languages_id . " and poval.language_id = " . (int)$languages_id);
                            }

                            $attributes_values = tep_db_fetch_array($attributes);

                            $sql_data_array = array('orders_id' => (int)$insert_id,
                                        'orders_products_id' => (int)$order_products_id,
                                        'products_options_id' => $order->products[$i]['attributes'][$j]['option_id'],
                                        'products_options' => $attributes_values['products_options_name'],
                                        'products_options_values_id' => $order->products[$i]['attributes'][$j]['value_id'],
                                        'products_options_values' => $order->products[$i]['attributes'][$j]['value'],
                                        'options_values_price' => $attributes_values['options_values_price'],
                                        'price_prefix' => $attributes_values['price_prefix']);
                            tep_db_perform(TABLE_ORDERS_PRODUCTS_ATTRIBUTES, $sql_data_array);

                            if ((DOWNLOAD_ENABLED == 'true') && isset($attributes_values['products_attributes_filename']) && tep_not_null($attributes_values['products_attributes_filename'])) {
                                $sql_data_array = array('orders_id' => (int)$insert_id,
                                          'orders_products_id' => (int)$order_products_id,
                                          'orders_products_filename' => $attributes_values['products_attributes_filename'],
                                          'download_maxdays' => (int)$attributes_values['products_attributes_maxdays'],
                                          'download_count' => (int)$attributes_values['products_attributes_maxcount']);
                                tep_db_perform(TABLE_ORDERS_PRODUCTS_DOWNLOAD, $sql_data_array);
                            }

                      //$products_ordered_attributes .= "<br /><small>" . $attributes_values['products_options_name'] . ': ' . tep_decode_specialchars($order->products[$i]['attributes'][$j]['value']).'</small>';
                            $products_ordered_attributes_array[]  = $attributes_values['products_options_name'] . ': ' . tep_decode_specialchars($order->products[$i]['attributes'][$j]['value']);
                        }
                    }

                    if (!empty($products_ordered_attributes_array)) {
                        $products_ordered_attributes = '<small>' . implode(', ', $products_ordered_attributes_array) . '</small>';
                    }

                    $productModel = $order->products[$i]['model'] ? '(' . $order->products[$i]['model'] . ')' : '';
                    $productOrderedAttributes = $products_ordered_attributes ? '(' . $products_ordered_attributes . ')' : '';
                    $products_ordered .= $order->products[$i]['qty'] . ' x ' . $order->products[$i]['name'] . ' ' . $productModel . ' = ' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . ' ' . $productOrderedAttributes . "<br>";

        //            $products_ordered .= '<a href="' . HTTP_SERVER . '/' . $language_short_link . '/' . 'product_info.php?products_id=' . $order->products[$i]['id'] . '" style="display:inline-block;font-size: 13px;text-align:left;width:50%;min-width:120px;max-width:100%;width:-webkit-calc(230400px - 48000%);min-width: -webkit-calc(50%);width:calc(230400px - 48000%);min-width: calc(50%);margin-bottom:5px;">
        //                                          <div style="display: inline-block;box-shadow: 0 2px 4px rgba(3,27,78,.06);padding: 10px;border: 1px solid #e5e8ed;border-radius: 0;width: calc(100% - 21px);margin: 0 0 -1px;">';
        //
        //                  if($order->products[$i]['image']!='') {
        //                      $products_ordered .= '<span style="height:48px;width:48px;margin-right: 10px;float:left;text-align:center;line-height:48px;">
        //                                              <img src="'.HTTP_SERVER.'/getimage/48x48/products/'. $order->products[$i]['image'].'" style="max-height:48px;max-width:48px;vertical-align: middle;">
        //                                            </span>';
        //                  }

        //                      $products_ordered .= '<div style="display:block;margin-left:58px;">
        //                                              <span style="display:block;text-overflow: ellipsis; overflow: hidden;height: 60px;">'.($order->products[$i]['qty']>1?('(<b>'.$order->products[$i]['qty'].'</b>)'):'').' <b>#'.$order->products[$i]['model'].'</b> '.$order->products[$i]['name'].'</span>
        //                                              <div style="text-overflow: ellipsis; overflow: hidden;  white-space: nowrap;min-height: 20px;">'.$products_ordered_attributes.'</div>
        //                                              <span style="display:inline-block;font-weight:600;">'.$currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']).'</span>
        //                                            </div>
        //                                          </div>
        //                                        </a>';
                }

  //          $products_ordered = '<div style="font-size:0;margin-top: 10px;">'.$products_ordered.'</div>';

                $_SESSION['$products_ordered'] = $products_ordered; // send to session because we will need it when we will come back from payment service page

                return $insert_id;
    }

    public function createEmails($insert_id)
    {
        global $order, $order_totals, $customer_name, $products_ordered, $guest_account, $customer_id, $paymentMethod, $wishList, $cart, $payment_modules, $cat_tree, $cat_names;
        if (!isset($products_ordered)) {
            $products_ordered = tep_db_input($_SESSION['$products_ordered']);
        }
        if (!isset($customer_name)) {
            $customer_name = $order->customer['firstname'] . ' ' . $order->customer['lastname'];
        }

        // lets start with the email confirmation
        $email_order = "<b>" . STORE_NAME . "</b><br />" .
                         EMAIL_SEPARATOR . "<br />" .
                         EMAIL_TEXT_ORDER_NUMBER . '' . $insert_id . "<br />" .
                         EMAIL_TEXT_INVOICE_URL . ' ' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false) . "<br />" .
                         EMAIL_TEXT_DATE_ORDERED . ' ' . strftime(DATE_FORMAT_LONG) . "<br />" .
                         EMAIL_TEXT_CUSTOMER_NAME . ' ' . $customer_name  . "<br />" .
                         EMAIL_TEXT_CUSTOMER_EMAIL_ADDRESS . ' ' . $order->customer['email_address']  . "<br />" .
                         EMAIL_TEXT_CUSTOMER_TELEPHONE . ' ' . $order->customer['telephone'] . "<br /><br />" ;

        if ($order->info['comments']) {
            $email_order .= $order->info['comments'] . "<br><br>";
        }

        $email_order .= '<br /><b>' . EMAIL_TEXT_PRODUCTS . '</b><br /><br />' . $products_ordered . '<br /><br />';

          $order_total = '';
        for ($i = 0, $n = sizeof($order_totals); $i < $n; $i++) {
            $email_order .= strip_tags($order_totals[$i]['title']) . ' ' . strip_tags($order_totals[$i]['text']) . "<br />";

            if ($order_totals[$i]['code'] == 'ot_total') {
                $order_totals[$i]['text'] = '<span style="font-size:20px;font-weight:bold;">' . strip_tags($order_totals[$i]['text']) . '</span>';
            } else {
                $order_totals[$i]['text'] = strip_tags($order_totals[$i]['text']);
            }

            $order_total .= '<b>' . strip_tags($order_totals[$i]['title']) . '</b> ' . $order_totals[$i]['text'] . "<br />";
        }


        $email_order .= "<br /><b>" . EMAIL_TEXT_DELIVERY_ADDRESS . "</b><br />" .
                        EMAIL_SEPARATOR . "<br />" .
                        $this->getAddressFormatted('sendto') . "<br /><br>";

        if ($order->info['diffShipping']) {
            $email_order .= "<br /><b>" . EMAIL_TEXT_BILLING_ADDRESS . "</b><br />" .
                          EMAIL_SEPARATOR . "<br />" .
                          $this->getAddressFormatted('billto') . "<br /><br>";
        }
        $email_order .= "<b>" . EMAIL_TEXT_PAYMENT_METHOD . "</b><br />" .
                        EMAIL_SEPARATOR . "<br>";
        // if (is_object($$payment)) {
        $payment_method = '';
        if (is_object($GLOBALS[$paymentMethod])) {
            $payment_class = $GLOBALS[$paymentMethod];
            $email_order .= strip_tags($payment_class->title) . "<br /><br />";
            $payment_method .= strip_tags($payment_class->title);
            if ($payment_class->email_footer) {
                $email_order .= '<br /><small>' . $payment_class->email_footer . "</small><br /><br />";
                $payment_method .= '<br /><small>' . $payment_class->email_footer . "</small><br /><br />";
            }
        } else if ($order->info['payment_method']) {
            $email_order .= strip_tags($order->info['payment_method']) . "<br /><br />";
            $payment_method .= strip_tags($order->info['payment_method']);
        }

        $subject = EMAIL_TEXT_SUBJECT . ' #' . $insert_id . ' - ' . strftime(DATE_FORMAT_LONG);
        if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
            require_once(DIR_FS_EXT . 'email_content/functions.php');
            $data = [
              'order_number' => $insert_id,
              'detail_i' => tep_href_link(HTTP_SERVER . '/' . FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false),
              'date_order' => date(DATE_FORMAT_LONG, time()),
              'customers_name' => $customer_name,
              'customers_email' => $order->customer['email_address'],
              'customers_phone' => $order->customer['telephone'],
              'order_comments' => $order->info['comments'],
              'products' => $products_ordered,
              'order_totals' => $order_total,
              'billing_address' => $order->info['diffShipping'] ? $this->getAddressFormatted('billto') : BILLING_ADDRESS_THE_SAME,
              'shipping_address' => $this->getAddressFormatted('sendto'),
              'payment_method' => $payment_method,
            ];
            $content_email_array = getCreateOrderText((int)$_SESSION['languages_id'], $data);
            $email_order = $content_email_array['content_html'] ? : $email_order;
            $subject = $content_email_array['subject'] ? : $subject;
        }
      // send email to customer:
        tep_mail($customer_name, $order->customer['email_address'], $subject, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, '');

      // send emails to other people
        if (!empty(STORE_OWNER_EMAIL_ADDRESS)) {
            tep_mail('', STORE_OWNER_EMAIL_ADDRESS, $subject, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, '');
        }
    }

    public function generateEmailByOrderId($order_id)
    {
        global $order, $customer_name, $order_totals, $currencies, $products_ordered;

        $check_query = tep_db_query('select * from ' . TABLE_ORDERS . ' where orders_id = ' . (int)$order_id);
        $check = tep_db_fetch_array($check_query);

        // order products:
        $products_ordered = '';
        $order_products_query = tep_db_query("select op.products_id,  p.products_image, op.products_model as model, op.products_name as name, op.products_quantity as qty, op.final_price as final_price, op.products_tax as tax 
                                            FROM " . TABLE_ORDERS_PRODUCTS . " op 
                                            LEFT JOIN " . TABLE_PRODUCTS . " p ON p.products_id = op.products_id
                                            where op.orders_id = " . (int)$order_id);
        while ($order_products = tep_db_fetch_array($order_products_query)) {
            $order_products['image'] = explode(';', $order_products['image'])[0];

            // attributes:
            $products_ordered_attributes = '';
            $products_ordered_attributes_array = [];
            if (isset($order_products['orders_products_attributes_id'])) {
                $order_products_attr_query = tep_db_query("select opa.products_options as at_name, opa.products_options_values as at_value from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " opa where op.orders_id = " . (int)$order_id . " and opa.orders_products_id = " . (int)$order_products['products_id']);
                while ($order_products_attr = tep_db_fetch_array($order_products_attr_query)) {
                    $products_ordered_attributes_array[] = $order_products_attr['at_name'] . ': ' . tep_decode_specialchars($order_products_attr['at_value']);
                }
            }

            if (!empty($products_ordered_attributes_array)) {
                $products_ordered_attributes = '<small>' . implode(', ', $products_ordered_attributes_array) . '</small>';
            }
            $products_ordered .= '<div style="display:inline-block;font-size: 13px;text-align:left;width:50%;min-width:120px;max-width:100%;width:-webkit-calc(230400px - 48000%);min-width: -webkit-calc(50%);width:calc(230400px - 48000%);min-width: calc(50%);margin-bottom:5px;">
                                          <div style="display: inline-block;box-shadow: 0 2px 4px rgba(3,27,78,.06);padding: 10px;border: 1px solid #e5e8ed;border-radius: 0;width: calc(100% - 21px);margin: 0 0 -1px;">';

            if (!empty($order_products['image'])) {
                $products_ordered .= '<span style="height:48px;width:48px;margin-right: 10px;float:left;text-align:center;line-height:48px;">
                                              <img src="' . HTTP_SERVER . '/getimage/48x48/products/' . $order_products['image'] . '" style="max-height:48px;max-width:48px;vertical-align: middle;">
                                            </span>';
            }

            $products_ordered .= '<div style="display:block;margin-left:58px;">
                                              <span style="display:block;text-overflow: ellipsis; overflow: hidden;height: 60px;">' . ($order_products['qty'] > 1 ? ('(<b>' . $order_products['qty'] . '</b>)') : '') . ' <b>#' . $order_products['model'] . '</b> ' . $order_products['name'] . '</span>
                                              <div style="text-overflow: ellipsis; overflow: hidden;  white-space: nowrap;min-height: 20px;">' . $products_ordered_attributes . '</div>
                                              <span style="display:inline-block;font-weight:600;">' . $currencies->display_price($order_products['final_price'], $order_products['tax'], $order_products['qty']) . '</span>
                                            </div>
                                          </div>
                                        </div>';
        }

        if (!class_exists('order')) {
            require(DIR_WS_CLASSES . 'order.php');
        }
        $order = new order();

        $order->delivery = array('firstname' => $check['delivery_name'],  'lastname' => '', 'company' => $check['delivery_company'],  'street_address' => $check['delivery_street_address'],
                                 'suburb' => $check['delivery_suburb'],     'city' => $check['delivery_city'],     'postcode' => $check['delivery_postcode'], 'state' => $check['delivery_state'],
                                 'zone_id' => '',    'country' => $check['delivery_country'],'country_id' => '', 'format_id' => $check['delivery_address_format_id']);

        $order->billing = array('firstname' => $check['billing_name'],  'lastname' => '', 'company' => $check['billing_company'],  'street_address' => $check['billing_street_address'],
                                    'suburb' => $check['billing_suburb'],     'city' => $check['billing_city'],     'postcode' => $check['billing_postcode'], 'state' => $check['billing_state'],
                                    'zone_id' => '',    'country' => $check['billing_country'], 'country_id' => '', 'format_id' => $check['billing_address_format_id']);

        $order->customer = array('email_address' => $check['customers_email_address'],  'telephone' => $check['customers_telephone']);

        $order->info = array('comments' => '',  'payment_method' => $check['payment_method']);

        $customer_name = $check['customers_name'];

        // get $order_totals:
        $totals_query = tep_db_query("
        select `title`
             , `text`
             , `class`
             , `value`
             , `orders_total_id`
        from " . TABLE_ORDERS_TOTAL . " 
        where orders_id = " . (int)$order_id . " 
        order by sort_order
      ");
        $order_totals = [];
        while ($totals = tep_db_fetch_array($totals_query)) {
            $order_totals[] = [
              'title'           => $totals['title'],
              'text'            => $totals['text'],
              'class'           => $totals['class'],
              'value'           => $totals['value'],
              'orders_total_id' => $totals['orders_total_id'],
            ];
        }
    }
}
