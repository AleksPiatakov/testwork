<?php

/*
  $Id: order.php,v 1.1.1.1 2003/09/18 19:05:14 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

class order
{
    var $info, $totals, $products, $customer, $delivery;

    function __construct($order_id = '')
    {
        $this->info = array();
        $this->totals = array();
        $this->products = array();
        $this->customer = array();
        $this->delivery = array();

        if (tep_not_null($order_id)) {
            $this->query($order_id);
        } else {
            $this->cart();
        }
    }

    function query($order_id)
    {
        global $languages_id;

        $order_id = tep_db_prepare_input($order_id);

        $order_query = tep_db_query("select * from " . TABLE_ORDERS . " where orders_id = " . (int)$order_id);
        $order = tep_db_fetch_array($order_query);

        $totals_query = tep_db_query("select title, text from " . TABLE_ORDERS_TOTAL . " where orders_id = " . (int)$order_id . " order by sort_order");
        while ($totals = tep_db_fetch_array($totals_query)) {
            $this->totals[] = array('title' => $totals['title'],
                                'text' => $totals['text']);
        }

        $order_total_query = tep_db_query("select text from " . TABLE_ORDERS_TOTAL . " where orders_id = " . (int)$order_id . " and class = 'ot_total'");
        $order_total = tep_db_fetch_array($order_total_query);

        $shipping_method_query = tep_db_query("select title from " . TABLE_ORDERS_TOTAL . " where orders_id = " . (int)$order_id . " and class = 'ot_shipping'");
        $shipping_method = tep_db_fetch_array($shipping_method_query);

        $order_status_query = tep_db_query("select orders_status_name, downloads_flag from " . TABLE_ORDERS_STATUS . " where orders_status_id = " . (int)$order['orders_status'] . " and language_id = " . (int)$languages_id);
        $order_status = tep_db_fetch_array($order_status_query);

        $this->info = array('currency' => $order['currency'],
                          'currency_value' => $order['currency_value'],
                          'payment_method' => $order['payment_method'],
                          'cc_type' => $order['cc_type'],
                          'cc_owner' => $order['cc_owner'],
                          'cc_number' => $order['cc_number'],
                          'cc_expires' => $order['cc_expires'],
                          'date_purchased' => $order['date_purchased'],
                          'orders_status' => $order_status['orders_status_name'],
                          'downloads_flag' => $order_status['downloads_flag'],
                          'last_modified' => $order['last_modified'],
                          'total' => strip_tags($order_total['text']),
                          'shipping_method' => ((substr($shipping_method['title'], -1) == ':') ? substr(strip_tags($shipping_method['title']), 0, -1) : strip_tags($shipping_method['title'])));

        $this->customer = array('id' => $order['customers_id'],
//KIKOLEPPARD add for color groups start
                                  'group_id' => $order['customers_groups_id'],
//KIKOLEPPARD add for color groups end
                              'name' => $order['customers_name'],
                              'company' => $order['customers_company'],
                              'street_address' => $order['customers_street_address'],
                              'suburb' => $order['customers_suburb'],
                              'city' => $order['customers_city'],
                              'postcode' => $order['customers_postcode'],
                              'state' => $order['customers_state'],
                              'country' => $order['customers_country'],
                              'format_id' => $order['customers_address_format_id'],
                              'telephone' => $order['customers_telephone'],
                              'fax' => $order['customers_fax'],
                              'email_address' => $order['customers_email_address']);

        $this->delivery = array('name' => $order['delivery_name'],
                              'company' => $order['delivery_company'],
                              'street_address' => $order['delivery_street_address'],
                              'suburb' => $order['delivery_suburb'],
                              'city' => $order['delivery_city'],
                              'postcode' => $order['delivery_postcode'],
                              'state' => $order['delivery_state'],
                              'country' => $order['delivery_country'],
                              'format_id' => $order['delivery_address_format_id'],
                              'shipping_method_code' => $order['shipping_method_code'],
                              'nwposhta_address' => $order['nwposhta_address']);

        if (empty($this->delivery['name']) && empty($this->delivery['street_address'])) {
            $this->delivery = false;
        }

        $this->billing = array('name' => $order['billing_name'],
                             'company' => $order['billing_company'],
                             'street_address' => $order['billing_street_address'],
                             'suburb' => $order['billing_suburb'],
                             'city' => $order['billing_city'],
                             'postcode' => $order['billing_postcode'],
                             'state' => $order['billing_state'],
                             'country' => $order['billing_country'],
                             'format_id' => $order['billing_address_format_id']);

        $index = 0;
        $orders_products_query = tep_db_query("select orders_products_id, products_id, products_name, products_model, products_price, products_tax, products_quantity, final_price from " . TABLE_ORDERS_PRODUCTS . " where orders_id = " . (int)$order_id);
        while ($orders_products = tep_db_fetch_array($orders_products_query)) {
            $this->products[$index] = array('qty' => $orders_products['products_quantity'],
                                          'id' => $orders_products['products_id'],
                                        'name' => $orders_products['products_name'],
                                        'model' => $orders_products['products_model'],
                                        'tax' => $orders_products['products_tax'],
                                        'price' => $orders_products['products_price'],
                                        'final_price' => $orders_products['final_price']);

            $subindex = 0;
            $attributes_query = tep_db_query("select products_options, products_options_values, options_values_price, price_prefix from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = " . (int)$order_id . " and orders_products_id = " . (int)$orders_products['orders_products_id']);
            if (tep_db_num_rows($attributes_query)) {
                while ($attributes = tep_db_fetch_array($attributes_query)) {
                    $this->products[$index]['attributes'][$subindex] = array('option' => $attributes['products_options'],
                                                                     'value' => $attributes['products_options_values'],
                                                                     'prefix' => $attributes['price_prefix'],
                                                                     'price' => $attributes['options_values_price']);

                    $subindex++;
                }
            }

            $this->info['tax_groups']["{$this->products[$index]['tax']}"] = '1';

            $index++;
        }
    }

    function cart()
    {
        global $customer_id, $sendto, $billto, $cart, $languages_id, $currency, $currencies, $shipping, $payment;


        $customer_address_query = tep_db_query("select c.customers_firstname, c.customers_lastname, c.customers_groups_id, c.customers_telephone, c.customers_fax, c.customers_email_address, ab.entry_company, ab.entry_street_address, ab.entry_suburb, ab.entry_postcode, ab.entry_city, ab.entry_zone_id, z.zone_name, co.countries_id, co.countries_name, co.countries_iso_code_2, co.countries_iso_code_3, co.address_format_id, ab.entry_state from " . TABLE_CUSTOMERS . " c, " . TABLE_ADDRESS_BOOK . " ab left join " . TABLE_ZONES . " z on (ab.entry_zone_id = z.zone_id) left join " . TABLE_COUNTRIES . " co on (ab.entry_country_id = co.countries_id) where c.customers_id = " . (int)$customer_id . " and ab.customers_id = " . (int)$customer_id . " and c.customers_default_address_id = ab.address_book_id");
        $customer_address = tep_db_fetch_array($customer_address_query);

        $shipping_address_query = tep_db_query("select ab.entry_firstname, ab.entry_lastname, ab.entry_company, ab.entry_street_address, ab.entry_suburb, ab.entry_postcode, ab.entry_city, ab.entry_zone_id, z.zone_name, ab.entry_country_id, c.countries_id, c.countries_name, c.countries_iso_code_2, c.countries_iso_code_3, c.address_format_id, ab.entry_state from " . TABLE_ADDRESS_BOOK . " ab left join " . TABLE_ZONES . " z on (ab.entry_zone_id = z.zone_id) left join " . TABLE_COUNTRIES . " c on (ab.entry_country_id = c.countries_id) where ab.customers_id = " . (int)$customer_id . " and ab.address_book_id = " . (int)$sendto);
        $shipping_address = tep_db_fetch_array($shipping_address_query);

        $billing_address_query = tep_db_query("select ab.entry_firstname, ab.entry_lastname, ab.entry_company, ab.entry_street_address, ab.entry_suburb, ab.entry_postcode, ab.entry_city, ab.entry_zone_id, z.zone_name, ab.entry_country_id, c.countries_id, c.countries_name, c.countries_iso_code_2, c.countries_iso_code_3, c.address_format_id, ab.entry_state from " . TABLE_ADDRESS_BOOK . " ab left join " . TABLE_ZONES . " z on (ab.entry_zone_id = z.zone_id) left join " . TABLE_COUNTRIES . " c on (ab.entry_country_id = c.countries_id) where ab.customers_id = " . (int)$customer_id . " and ab.address_book_id = " . (int)$billto);
        $billing_address = tep_db_fetch_array($billing_address_query);

        $tax_address_query = tep_db_query("select ab.entry_country_id, ab.entry_zone_id from " . TABLE_ADDRESS_BOOK . " ab left join " . TABLE_ZONES . " z on (ab.entry_zone_id = z.zone_id) where ab.customers_id = " . (int)$customer_id . " and ab.address_book_id = " . (int)$sendto);
        $tax_address = tep_db_fetch_array($tax_address_query);

      // add tax depend on selected country and state:
        if (!$tax_address['entry_country_id']) {
            $tax_address['entry_country_id'] = (int)$_SESSION['onepage']['delivery']['country_id'] ?: STORE_COUNTRY;
        }
        if (!$tax_address['entry_zone_id']) {
            $tax_address['entry_zone_id'] = (int)$_SESSION['onepage']['delivery']['zone_id'] ?: STORE_ZONE;
        }

        //get shipping modules`s code (filename)
        if (strpos($shipping['id'], '_') >= 0) {
            $shipping_method_code = explode('_', $shipping['id'])[0];
        } else {
            $shipping_method_code = $shipping['id'];
        }

        $this->info = [
            'order_status' => DEFAULT_ORDERS_STATUS_ID,
            'currency' => $currency,
            'currency_value' => $currencies->currencies[$currency]['value'],
            'payment_method' => $payment,
            'cc_type' => (isset($GLOBALS['cc_type']) ? $GLOBALS['cc_type'] : ''),
            'cc_owner' => (isset($GLOBALS['cc_owner']) ? $GLOBALS['cc_owner'] : ''),
            'cc_number' => (isset($GLOBALS['cc_number']) ? $GLOBALS['cc_number'] : ''),
            'cc_expires' => (isset($GLOBALS['cc_expires']) ? $GLOBALS['cc_expires'] : ''),
            'shipping_method' => $shipping['title'],
            'shipping_method_code' => $shipping_method_code,
            'shipping_cost' => $shipping['cost'],
            /* One Page Checkout - BEGIN */
            // tax total fix start
            'shipping_tax' => $shipping['shipping_tax_total'],
            // tax total fix end
            /* One Page Checkout - END */

            'subtotal' => 0,
            'tax' => 0,
            'tax_groups' => [],
            'comments' => (isset($GLOBALS['comments']) ? $GLOBALS['comments'] : ''),
        ];

        if (isset($GLOBALS[$payment]) && is_object($GLOBALS[$payment])) {
            $this->info['payment_method'] = $GLOBALS[$payment]->title;

            if (isset($GLOBALS[$payment]->order_status) && is_numeric($GLOBALS[$payment]->order_status) && ($GLOBALS[$payment]->order_status > 0)) {
                $this->info['order_status'] = $GLOBALS[$payment]->order_status;
            }
        }

        $this->customer = array('firstname' => $customer_address['customers_firstname'],
                              'lastname' => $customer_address['customers_lastname'],
//KIKOLEPPARD add for color groups start
                                     'group_id' => $customer_address['customers_groups_id'],
//KIKOLEPPARD add for color groups end
                              'company' => $customer_address['entry_company'],
                              'street_address' => $customer_address['entry_street_address'],
                              'suburb' => $customer_address['entry_suburb'],
                              'city' => $customer_address['entry_city'],
                              'postcode' => $customer_address['entry_postcode'],
                              'state' => ((tep_not_null($customer_address['entry_state'])) ? $customer_address['entry_state'] : $customer_address['zone_name']),
                              'zone_id' => $customer_address['entry_zone_id'],
                              'country' => array('id' => $customer_address['countries_id'], 'title' => $customer_address['countries_name'], 'iso_code_2' => $customer_address['countries_iso_code_2'], 'iso_code_3' => $customer_address['countries_iso_code_3']),
                              'format_id' => $customer_address['address_format_id'],
                              'telephone' => $customer_address['customers_telephone'],
                              'fax' => $customer_address['customers_fax'],
                              'email_address' => $customer_address['customers_email_address']);

        $this->delivery = array('firstname' => $shipping_address['entry_firstname'],
                              'lastname' => $shipping_address['entry_lastname'],
                              'company' => $shipping_address['entry_company'],
                              'street_address' => $shipping_address['entry_street_address'],
                              'suburb' => $shipping_address['entry_suburb'],
                              'city' => $shipping_address['entry_city'],
                              'postcode' => $shipping_address['entry_postcode'],
                              'state' => ((tep_not_null($shipping_address['entry_state'])) ? $shipping_address['entry_state'] : $shipping_address['zone_name']),
                              'zone_id' => $shipping_address['entry_zone_id'],
                              'country' => array('id' => $shipping_address['countries_id'], 'title' => $shipping_address['countries_name'], 'iso_code_2' => $shipping_address['countries_iso_code_2'], 'iso_code_3' => $shipping_address['countries_iso_code_3']),
                              'country_id' => $shipping_address['entry_country_id'],
                              'format_id' => $shipping_address['address_format_id']);

        $this->billing = array('firstname' => $billing_address['entry_firstname'],
                             'lastname' => $billing_address['entry_lastname'],
                             'company' => $billing_address['entry_company'],
                             'street_address' => $billing_address['entry_street_address'],
                             'suburb' => $billing_address['entry_suburb'],
                             'city' => $billing_address['entry_city'],
                             'postcode' => $billing_address['entry_postcode'],
                             'state' => ((tep_not_null($billing_address['entry_state'])) ? $billing_address['entry_state'] : $billing_address['zone_name']),
                             'zone_id' => $billing_address['entry_zone_id'],
                             'country' => array('id' => $billing_address['countries_id'], 'title' => $billing_address['countries_name'], 'iso_code_2' => $billing_address['countries_iso_code_2'], 'iso_code_3' => $billing_address['countries_iso_code_3']),
                             'country_id' => $billing_address['entry_country_id'],
                             'format_id' => $billing_address['address_format_id']);

        $index = 0;
        $products = $cart->get_products();
        $this->info['free_ship'] = 1;
        for ($i = 0, $n = sizeof($products); $i < $n; $i++) {
            $final_price = 0;
            if (getConstantValue('QTY_PRO_ENABLED') == 'true') { // get product price from qty_pro combinations
                $final_price = $cart->attributes_price($products[$i]['id']);
            }
            if ($final_price === 0) { // get product price from product field when qty_pro is disabled or combination not exist
                $final_price = ($cart->attr_prefix($products[$i]['id']) == '=') ? $cart->attributes_price($products[$i]['id']) : ($products[$i]['price'] + $cart->attributes_price($products[$i]['id']));
            }
            $this->products[$index] = [
              'qty'             => $products[$i]['quantity'],
              'name'            => $products[$i]['name'],
              'model'           => $products[$i]['model'],
              'free_ship'       => $products[$i]['free_ship'],
              'tax_class_id'    => $products[$i]['tax_class_id'],
              'tax'             => tep_get_tax_rate($products[$i]['tax_class_id'], $tax_address['entry_country_id'], $tax_address['entry_zone_id']),
              'tax_description' => tep_get_tax_description($products[$i]['tax_class_id'], $tax_address['entry_country_id'], $tax_address['entry_zone_id']),
              'price'           => $products[$i]['price'],
              'final_price'     => $final_price,
              'weight'          => $products[$i]['weight'],
              'image'           => explode(';', $products[$i]['image'])[0],
              'id'              => $products[$i]['id'],
            ];
            $this->info['free_ship'] = $this->info['free_ship'] ? $products[$i]['free_ship'] : $this->info['free_ship'];
            if ($products[$i]['attributes']) {
                $subindex = 0;
                reset($products[$i]['attributes']);
                foreach ($products[$i]['attributes'] as $option => $value) {
                    $attributes_query = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = " . (int)$products[$i]['id'] . " and pa.options_id = " . (int)$option . " and pa.options_id = popt.products_options_id and pa.options_values_id = " . (int)$value . " and pa.options_values_id = poval.products_options_values_id and popt.language_id = " . (int)$languages_id . " and poval.language_id = " . (int)$languages_id);
                    $attributes = tep_db_fetch_array($attributes_query);
        // otf 1.71 Determine if attribute is a text attribute and change products array if it is.
                    if ($value == PRODUCTS_OPTIONS_VALUE_TEXT_ID) {
                        $attr_value = $products[$i]['attributes_values'][$option];
                    } else {
                        $attr_value = $attributes['products_options_values_name'];
                    }
                    $this->products[$index]['attributes'][$subindex] = array('option' => $attributes['products_options_name'],
                                                                     'value' => $attr_value,
                                                                     'option_id' => $option,
                                                                     'value_id' => $value,
                                                                     'prefix' => $attributes['price_prefix'],
                                                                     'price' => $attributes['options_values_price']);

                    $subindex++;
                }
            }

      //    $shown_price = tep_add_tax($this->products[$index]['final_price'], $this->products[$index]['tax']) * $this->products[$index]['qty'];
            $shown_price = $currencies->display_price($this->products[$index]['final_price'], $this->products[$index]['tax'], $this->products[$index]['qty'], false);

            if (ALLOW_GUEST_TO_SEE_PRICES == 'false' && !(tep_session_is_registered('customer_id'))) {
                $shown_price = 0;
            }

            $this->info['subtotal'] += $shown_price;

            $products_tax = $this->products[$index]['tax'];
            $products_tax_description = $this->products[$index]['tax_description'];

            if (!empty($products_tax) && empty($products_tax_description)) {
                $products_tax_description = 'Tax';
            }

            if (!empty($products_tax_description)) {
                if (DISPLAY_PRICE_WITH_TAX == 'true') {
                    $this->info['tax'] += $shown_price - ($shown_price / (($products_tax < 10) ? "1.0" . str_replace('.', '', $products_tax) : "1." . str_replace('.', '', $products_tax)));
                    if (isset($this->info['tax_groups']["$products_tax_description"])) {
                        $this->info['tax_groups']["$products_tax_description"] += $shown_price - ($shown_price / (($products_tax < 10) ? "1.0" . str_replace('.', '', $products_tax) : "1." . str_replace('.', '', $products_tax)));
                    } else {
                        $this->info['tax_groups']["$products_tax_description"] = $shown_price - ($shown_price / (($products_tax < 10) ? "1.0" . str_replace('.', '', $products_tax) : "1." . str_replace('.', '', $products_tax)));
                    }
                } else {
                    $this->info['tax'] += ($products_tax / 100) * $shown_price;
                    if (isset($this->info['tax_groups']["$products_tax_description"])) {
                        $this->info['tax_groups']["$products_tax_description"] += ($products_tax / 100) * $shown_price;
                    } else {
                        $this->info['tax_groups']["$products_tax_description"] = ($products_tax / 100) * $shown_price + $this->info['shipping_tax'];
                    }
                }
            }

            $index++;
        }
        if (defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER') && $this->info['subtotal'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) {
            $this->info['free_ship'] = 1;
        }
        $this->info['shipping_cost'] = !$this->info['free_ship'] ? $this->info['shipping_cost'] : 0;
        if (DISPLAY_PRICE_WITH_TAX == 'true') {
            $this->info['total'] = (float)$this->info['subtotal'] + (float)$this->info['shipping_cost'];
        } else {
            $this->info['total'] = (float)$this->info['subtotal'] + (float)$this->info['tax'] + (float)($this->info['shipping_cost'] !== null ? (float)$this->info['shipping_cost'] : 0);
        }
    }
}
