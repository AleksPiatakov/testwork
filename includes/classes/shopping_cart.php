<?php

/*
  $Id: shopping_cart.php,v 1.1.1.1 2003/09/18 19:05:12 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

class shoppingCart
{
    var $contents, $total, $weight, $cartID;

    function __construct()
    {
        $this->reset();
    }

    function restore_contents()
    {
//ICW replace line
        global $customer_id, $gv_id, $REMOTE_ADDR;
//      global $customer_id;

        if (!tep_session_is_registered('customer_id')) {
            return false;
        }

// insert current cart contents in database
        if (is_array($this->contents)) {
            reset($this->contents);
            foreach ($this->contents as $products_id => $val) {
                $qty = $this->contents[$products_id]['qty'];
                $product_query = tep_db_query("select products_id from " . TABLE_CUSTOMERS_BASKET . " where customers_id = " . (int)$customer_id . " and products_id = '" . tep_db_prepare_input($products_id) . "'");
                if (!tep_db_num_rows($product_query)) {
                    tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values (" . (int)$customer_id . ", '" . tep_db_prepare_input($products_id) . "', " . (int)$qty . ", '" . date('Ymd') . "')");
                    if (isset($this->contents[$products_id]['attributes'])) {
                        reset($this->contents[$products_id]['attributes']);
                        foreach ($this->contents[$products_id]['attributes'] as $option => $value) {
                            // otf 1.71 Update query to include attribute value. This is needed for text attributes.
                            $attr_value = $this->contents[$products_id]['attributes_values'][$option];
                            tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id, products_options_value_text) values (" . (int)$customer_id . ", '" . tep_db_prepare_input($products_id) . "', " . (int)$option . ", " . (int)$value . ", '" . tep_db_prepare_input($attr_value) . "')");
                        }
                    }
                } else {
                    tep_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = " . (int)$qty . " where customers_id = " . (int)$customer_id . " and products_id = '" . tep_db_prepare_input($products_id) . "'");
                }
            }
//ICW ADDDED FOR CREDIT CLASS GV - START
            if (tep_session_is_registered('gv_id')) {
                $gv_query = tep_db_query("insert into  " . TABLE_COUPON_REDEEM_TRACK . " (coupon_id, customer_id, redeem_date, redeem_ip) values (" . (int)$gv_id . ", " . (int)$customer_id . ", now(),'" . $REMOTE_ADDR . "')");
                $gv_update = tep_db_query("update " . TABLE_COUPONS . " set coupon_active = 'N' where coupon_id = '" . $gv_id . "'");
                tep_gv_account_update($customer_id, $gv_id);
                tep_session_unregister('gv_id');
            }
//ICW ADDDED FOR CREDIT CLASS GV - END
        }

// reset per-session cart contents, but not the database contents
        $this->reset(false);

        $products_query = tep_db_query("select products_id, customers_basket_quantity from " . TABLE_CUSTOMERS_BASKET . " where customers_id = " . (int)$customer_id);
        while ($products = tep_db_fetch_array($products_query)) {
            $this->contents[$products['products_id']] = array('qty' => $products['customers_basket_quantity']);
// attributes
// otf 1.71Update query to pull attribute value_text. This is needed for text attributes.
            $attributes_query = tep_db_query("select products_options_id, products_options_value_id, products_options_value_text from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = " . (int)$customer_id . " and products_id = '" . tep_db_prepare_input($products['products_id']) . "'");
            while ($attributes = tep_db_fetch_array($attributes_query)) {
                $this->contents[$products['products_id']]['attributes'][$attributes['products_options_id']] = $attributes['products_options_value_id'];
                // If text attribute, then set additional information
                if ($attributes['products_options_value_id'] == PRODUCTS_OPTIONS_VALUE_TEXT_ID) {
                    $this->contents[$products['products_id']]['attributes_values'][$attributes['products_options_id']] = $attributes['products_options_value_text'];
                }
            }
        }

        $this->cleanup();
        $this->cartID = $this->generate_cart_id();
    }

    function reset($reset_database = false)
    {
        global $customer_id;

        $this->contents = array();
        $this->total = 0;
        $this->weight = 0;

        if (tep_session_is_registered('customer_id') && ($reset_database == true)) {
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "'");
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "'");
        }

        unset($this->cartID);
        if (tep_session_is_registered('cartID')) {
            tep_session_unregister('cartID');
        }
    }

    function add_cart($products_id, $qty = '1', $attributes = '', $notify = true)
    {
        global $new_products_id_in_cart, $customer_id;

        $products_id = tep_get_uprid($products_id, $attributes);
        if ($notify == true) {
            $new_products_id_in_cart = $products_id;
            tep_session_register('new_products_id_in_cart');
        }

        if ($this->in_cart($products_id)) {
            $this->update_quantity($products_id, $qty, $attributes);
        } else {
            $this->contents[] = array($products_id);
            $this->contents[$products_id] = array('qty' => $qty);
// insert into database
            if (tep_session_is_registered('customer_id')) {
                tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values (" . (int)$customer_id . ", '" . tep_db_prepare_input($products_id) . "', " . (int)$qty . ", '" . date('Ymd') . "')");
            }

            if (is_array($attributes)) {
                reset($attributes);
                foreach ($attributes as $option => $value) {
                    if (!is_numeric($option) || !is_numeric($value)) {
                        continue;
                    }
// otf 1.71 Check if input was from text box.  If so, store additional attribute information
                    // Check if text input is blank, if so do not add to attribute lists
                    // Add htmlspecialchars processing.  This handles quotes and other special chars in the user input.
                    $attr_value = null;
                    $blank_value = false;
                    if (strstr($option, TEXT_PREFIX)) {
                        if (trim($value) == null) {
                            $blank_value = true;
                        } else {
                            $option = substr($option, strlen(TEXT_PREFIX));
                            $attr_value = htmlspecialchars(stripslashes($value), ENT_QUOTES);
                            $value = PRODUCTS_OPTIONS_VALUE_TEXT_ID;
                            $this->contents[$products_id]['attributes_values'][$option] = $attr_value;
                        }
                    }
                    if (!$blank_value) {
                        $this->contents[$products_id]['attributes'][$option] = $value;
// insert into database
// otf 1.71 Update db insert to include attribute value_text. This is needed for text attributes.
                        // Add tep_db_input() processing
                        if (tep_session_is_registered('customer_id')) {
                            tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id, products_options_value_text) values (" . (int)$customer_id . ", '" . tep_db_prepare_input($products_id) . "', " . (int)$option . ", " . (int)$value . ", '" . tep_db_prepare_input($attr_value) . "')");
                        }
                    }
                }
            }
        }
        $this->cleanup();
// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
        $this->cartID = $this->generate_cart_id();
    }

    function update_quantity($products_id, $quantity = '', $attributes = '')
    {
        global $customer_id;

        if (empty($quantity)) {
            return true; // nothing needs to be updated if theres no quantity, so we return true..
        }

        $this->contents[$products_id] = array('qty' => $quantity);
// update database
        if (tep_session_is_registered('customer_id')) {
            tep_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = " . (int)$quantity . " where customers_id = " . (int)$customer_id . " and products_id = '" . tep_db_prepare_input($products_id) . "'");
        }

        if (is_array($attributes)) {
            reset($attributes);
            foreach ($attributes as $option => $value) {
                if (!is_numeric($option) || !is_numeric($value)) {
                    continue;
                }
// otf 1.71 Check if input was from text box.  If so, store additional attribute information
                // Check if text input is blank, if so do not update attribute lists
                // Add htmlspecialchars processing.  This handles quotes and other special chars in the user input.
                $attr_value = null;
                $blank_value = false;
                if (strstr($option, TEXT_PREFIX)) {
                    if (trim($value) == null) {
                        $blank_value = true;
                    } else {
                        $option = substr($option, strlen(TEXT_PREFIX));
                        $attr_value = htmlspecialchars(stripslashes($value), ENT_QUOTES);
                        $value = PRODUCTS_OPTIONS_VALUE_TEXT_ID;
                        $this->contents[$products_id]['attributes_values'][$option] = $attr_value;
                    }
                }

                if (!$blank_value) {
                    $this->contents[$products_id]['attributes'][$option] = $value;
// update database
                    // Update db insert to include attribute value_text. This is needed for text attributes.
                    // Add tep_db_input() processing
                    if (tep_session_is_registered('customer_id')) {
                        tep_db_query("update " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " set products_options_value_id = " . (int)$value . ", products_options_value_text = '" . tep_db_prepare_input($attr_value) . "' where customers_id = " . (int)$customer_id . " and products_id = '" . tep_db_prepare_input($products_id) . "' and products_options_id = " . (int)$option);
                    }
                }
            }
        }
    }

    function cleanup()
    {
        global $customer_id;

        reset($this->contents);
        foreach ($this->contents as $key => $value) {
            if ($this->contents[$key]['qty'] < 1) {
                unset($this->contents[$key]);
// remove from database
                if (tep_session_is_registered('customer_id')) {
                    tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = " . (int)$customer_id . " and products_id = '" . tep_db_prepare_input($key) . "'");
                    tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = " . (int)$customer_id . " and products_id = '" . tep_db_prepare_input($key) . "'");
                }
            }
        }
    }


    function getFinalPrice($products_id, $basePrice)
    {
        $attr = [];
        foreach ($this->contents[$products_id]['attributes'] as $oId => $ovId) {
            $attr[] = "(options_id = '" . (int)$oId . "' and options_values_id = '" . (int)$ovId . "')";
        }

        //attribute combination price
        $finalPrice = $this->get_qty_pro_price($products_id);

        if (empty($finalPrice) || $finalPrice <= 0) {
            $pId = (int)$products_id;
            $attr_list = implode(' or ', $attr);
            $sql = "SELECT price_prefix, max(options_values_price) as price FROM products_attributes WHERE products_id = " . (int)$pId . " and (" . $attr_list . ") group by price_prefix";
            $query = tep_db_query($sql);
            $attribs = [];
            while ($row = tep_db_fetch_array($query)) {
                $attribs[$row['price_prefix']] = $row['price'];
            }
            $finalPrice = isset($attribs['=']) ? $attribs['='] : $basePrice + $this->attributes_price($products_id);
        }

        return $finalPrice;
    }

    function count_contents()
    {
  // get total number of items in cart
        $total_items = 0;
        if (is_array($this->contents)) {
            reset($this->contents);

            foreach ($this->contents as $products_id => $value) {
                $total_items += $this->get_quantity($products_id);
            }
        }

        return $total_items;
    }

    function get_quantity($products_id)
    {
        if (isset($this->contents[$products_id])) {
            return $this->contents[$products_id]['qty'];
        } else {
            return 0;
        }
    }

    function in_cart($products_id)
    {
        if (!empty($this->contents)) {
            if (@isset($this->contents[$products_id])) {
                return true;
            }
            return false;
        }
        return false;
    }

    function remove($products_id)
    {
        global $customer_id;

// otf 1.71 Add call tep_get_uprid to correctly format product ids containing quotes
        $products_id = tep_get_uprid($products_id, $attributes);

        unset($this->contents[$products_id]);
// remove from database
        if (tep_session_is_registered('customer_id')) {
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = " . (int)$customer_id . " and products_id = '" . tep_db_prepare_input($products_id) . "'");
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = " . (int)$customer_id . " and products_id = '" . tep_db_prepare_input($products_id) . "'");
        }

// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
        $this->cartID = $this->generate_cart_id();
    }

    function remove_all()
    {
        $this->reset();
    }

    function get_product_id_list()
    {
        $product_id_list = '';
        if (is_array($this->contents)) {
            reset($this->contents);
            foreach ($this->contents as $products_id => $value) {
                $product_id_list .= ', ' . $products_id;
            }
        }

        return substr($product_id_list, 2);
    }

    function calculate()
    {
        global $customer_price, $currency, $currencies;
        $this->total = 0;
        $this->pruduct_total = 0;
        $this->weight = 0;
        if (!is_array($this->contents)) {
            return 0;
        }

        reset($this->contents);

        foreach ($this->contents as $products_id => $v) {
            $qty = $v['qty'];
            // products price
            $product_query = tep_db_query(
                "select products_id, CASE WHEN " . $customer_price . " IS NULL THEN products_price ELSE " . $customer_price . " END as products_price, products_tax_class_id, products_weight from " .
                TABLE_PRODUCTS . " where products_id = " . (int)$products_id
            );
            if ($product = tep_db_fetch_array($product_query)) {
                $prid = $product['products_id'];
                $products_tax = tep_get_tax_rate($product['products_tax_class_id']);
                // $products_price = tep_xppp_getproductprice($product['products_id']);
                $products_price = $product['products_price'];
                if ($special_price = tep_get_products_special_price($prid)) {
                    $products_price = $special_price;
                }
                $products_weight = $product['products_weight'];

               /* global $customer_id;
                $customer_discount = $this->r_get_customer_discount($customer_id,$prid);

                if ($customer_discount >= 0) {
                    $products_price = $products_price + $products_price * abs($customer_discount) / 100;
                } else {
                    $products_price = $products_price - $products_price * abs($customer_discount) / 100;
                }*/
//                $products_price = tep_round($products_price, $currencies->currencies[$currency]['decimal_places']);
                $this->pruduct_total = tep_add_tax($products_price, $products_tax) * $qty;
                $this->weight += ($qty * $products_weight);
            }

            // attributes price
            if (isset($v['attributes'])) {
                reset($v['attributes']);

                //attribute combination price
                $finalPrice = $this->get_qty_pro_price($products_id);
                if ($finalPrice > 0) {
                    $this->pruduct_total = $qty * $finalPrice;
                }

                if (empty($finalPrice) || $finalPrice <= 0) {
                    foreach ($v['attributes'] as $option => $value) {
                        $attribute_price_query = tep_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = " . (int)$prid . " and options_id = " . (int)$option . " and options_values_id = " . (int)$value);
                        $attribute_price = tep_db_fetch_array($attribute_price_query);
                        if ($customer_discount >= 0) {
                            $attribute_price['options_values_price'] = $attribute_price['options_values_price'] + $attribute_price['options_values_price'] * abs($customer_discount) / 100;
                        } else {
                            $attribute_price['options_values_price'] = $attribute_price['options_values_price'] - $attribute_price['options_values_price'] * abs($customer_discount) / 100;
                        }

                        $attrPrice = tep_round(
                            $attribute_price['options_values_price'],
                            $currencies->currencies[$currency]['decimal_places']
                        );
                        $attrPrice = tep_add_tax($attrPrice, $products_tax) * $qty;
                        if ($attribute_price['price_prefix'] == '+') {
                            $this->pruduct_total += $attrPrice;
                        } elseif ($attribute_price['price_prefix'] == '-') {
                            $this->pruduct_total -= $attrPrice;
                        } elseif ($attribute_price['price_prefix'] == '=' and $attribute_price['options_values_price'] != 0) {
                            $this->pruduct_total = $attrPrice;
                        }
                    }
                }
            }
            $this->total += $this->pruduct_total;
        }
    }

    function get_qty_pro_price($products_id)
    {
        $attributes_price = 0;
        if (getConstantValue('QTY_PRO_ENABLED') == 'true') {
            $attributesParts = [];
            foreach ($this->contents[$products_id]['attributes'] as $oId => $ovId) {
                if ($ovId != 0) {
                    $attributesParts[] = $oId . "-" . $ovId;
                }
            }
            $products_stock_query = tep_db_query("SELECT ps.products_combination_price, ps.products_stock_attributes, s.specials_new_products_price as special_price
                       FROM " . TABLE_PRODUCTS_STOCK . " ps
                        LEFT JOIN " . TABLE_SPECIALS . " s on (s.attribute_combination = ps.products_stock_attributes or s.attribute_combination ='all') and status = '1'
                            and (start_date <= CURDATE() or start_date = '0000-00-00 00:00:00' or start_date is NULL)
                            and (expires_date >= CURDATE() or expires_date = '0000-00-00 00:00:00' or expires_date is NULL)
                       WHERE ps.products_id = " . (int)$products_id . " ORDER BY s.attribute_combination desc");
                if (tep_db_num_rows($products_stock_query) > 0) {
                    while ($products_stock = tep_db_fetch_array($products_stock_query)) {
                        $count = 0;
                        foreach ($attributesParts as $attributeCombinationPart) {
                            if (in_array($attributeCombinationPart,
                                explode(',', $products_stock['products_stock_attributes']))) {
                                $count += 1;
                            }
                        }

                        if ($count == count($attributesParts)) {
                            $attributes_price = (getConstantValue('SPECIALS_MODULE_ENABLED') == 'true' && $products_stock['special_price'])?$products_stock['special_price']:$products_stock['products_combination_price'];
                        }
                    }
                }
            }
            return $attributes_price;
        }

    function attributes_price($products_id)
    {
        $attributes_price = 0;
        if (isset($this->contents[$products_id]['attributes'])) {
            reset($this->contents[$products_id]['attributes']);

            //attribute combination price
            $attributes_price = $this->get_qty_pro_price($products_id);

            if (empty($attributes_price) || $attributes_price <= 0) {
                foreach ($this->contents[$products_id]['attributes'] as $option => $value) {
                    $attribute_price_query = tep_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = " . (int)$products_id . " and options_id = " . (int)$option . " and options_values_id = " . (int)$value);
                    $attribute_price = tep_db_fetch_array($attribute_price_query);
                    $prid = $products_id;
                    global $customer_id;
                    $customer_discount = $this->r_get_customer_discount($customer_id, $prid);
                    if ($customer_discount >= 0) {
                        $attribute_price['options_values_price'] = $attribute_price['options_values_price'] + $attribute_price['options_values_price'] * abs($customer_discount) / 100;
                    } else {
                        $attribute_price['options_values_price'] = $attribute_price['options_values_price'] - $attribute_price['options_values_price'] * abs($customer_discount) / 100;
                    }

                    if ($attribute_price['price_prefix'] == '+') {
                        $attributes_price += $attribute_price['options_values_price'];
                    } elseif ($attribute_price['price_prefix'] == '-') {
                        $attributes_price -= $attribute_price['options_values_price'];
                    } elseif ($attribute_price['price_prefix'] == '=' and $attribute_price['options_values_price'] != 0) {
                        $attributes_price = $attribute_price['options_values_price'];
                    }

                    if ($attribute_price['price_prefix'] == '=') {
                        $this->contents[$products_id]['attributes_prefix'] = $attribute_price['price_prefix'];
                    }
                }
            }
        }

        return $attributes_price;
    }


    function get_products()
    {
        global $languages_id, $customer_price, $currencies, $currency;

        if (!is_array($this->contents)) {
            return false;
        }

        $products_array = array();
        reset($this->contents);
        foreach ($this->contents as $products_id => $value) {
            $products_query = tep_db_query("select p.products_id, p.products_free_ship, pd.products_name, p.products_model, p.manufacturers_id, p.products_image, CASE WHEN p." . $customer_price . " IS NULL THEN p.products_price ELSE p." . $customer_price . " END as products_price, p.products_weight, p.products_tax_class_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = " . (int)$products_id . " and pd.products_id = p.products_id and pd.language_id = " . (int)$languages_id);
            if ($products = tep_db_fetch_array($products_query)) {
                $prid = $products['products_id'];

                //  $products_price = tep_xppp_getproductprice($products['products_id']);
                $products_price = $products['products_price'];

                /*  global $customer_id;
                $customer_discount = $this->r_get_customer_discount($customer_id,$prid);


                    if ($customer_discount >= 0) {
                      $products_price = $products_price + $products_price * abs($customer_discount) / 100;
                  } else {
                      $products_price = $products_price - $products_price * abs($customer_discount) / 100;
                  }        */

                if ($special_price = tep_get_products_special_price($prid)) {
                    $products_price = $special_price;
                }

//                $products_price = tep_round($products_price, $currencies->currencies[$currency]['decimal_places']);
                $products_array[] = [
                    'id' => $products_id,
                    'string_id' => $products['products_id'],
                    'name' => $products['products_name'],
                    'manufacturers_id' => $products['manufacturers_id'],
                    'model' => $products['products_model'],
                    'image' => $products['products_image'],
                    'free_ship' => $products['products_free_ship'],
                    'price' => $products_price,
                    'quantity' => $this->contents[$products_id]['qty'],
                    'weight' => $products['products_weight'],
                    'final_price' => empty($this->contents[$products_id]['attributes']) ? $products_price : $this->getFinalPrice($products_id, $products_price),
                    'tax_class_id' => $products['products_tax_class_id'],
                    'attributes' => (isset($this->contents[$products_id]['attributes']) ? $this->contents[$products_id]['attributes'] : ''),
                    'attributes_values' => (isset($this->contents[$products_id]['attributes_values']) ? $this->contents[$products_id]['attributes_values'] : '')
                ];
            }
        }


        return $products_array;
    }

    function r_get_customer_discount($customer_id, $prid)
    {
        $query_price_to_guest_result = ALLOW_GUEST_TO_SEE_PRICES;
        if (($query_price_to_guest_result == 'true') && !(tep_session_is_registered('customer_id'))) {
            $customer_discount = GUEST_DISCOUNT;
        } elseif (tep_session_is_registered('customer_id')) {
            $query_A = tep_db_query("select m.manudiscount_discount from " . TABLE_MANUDISCOUNT .  " m, " . TABLE_PRODUCTS . " p where m.manudiscount_groups_id = 0 and m.manudiscount_customers_id = " . (int)$customer_id . " and p.products_id = " . (int)$prid . " and p.manufacturers_id = m.manudiscount_manufacturers_id");
            $query_B = tep_db_query("select m.manudiscount_discount from " . TABLE_CUSTOMERS  . " c, " . TABLE_MANUDISCOUNT .  " m, " . TABLE_PRODUCTS . " p where m.manudiscount_groups_id = c.customers_groups_id  and m.manudiscount_customers_id = 0 and c.customers_id = " . (int)$customer_id . " and p.products_id = " . (int)$prid . " and p.manufacturers_id = m.manudiscount_manufacturers_id");
            $query_C = tep_db_query("select m.manudiscount_discount from " . TABLE_MANUDISCOUNT .  " m, " . TABLE_PRODUCTS . " p where m.manudiscount_groups_id = 0 and m.manudiscount_customers_id = 0 and p.products_id = " . (int)$prid . " and p.manufacturers_id = m.manudiscount_manufacturers_id");

            if ($query_result = tep_db_fetch_array($query_A)) {
                $customer_discount = $query_result['manudiscount_discount'];
            } else if ($query_result = tep_db_fetch_array($query_B)) {
                $customer_discount = $query_result['manudiscount_discount'];
            } else if ($query_result = tep_db_fetch_array($query_C)) {
                $customer_discount = $query_result['manudiscount_discount'];
            } else {
                // customer discount:
                $query = tep_db_query("select customers_discount from " . TABLE_CUSTOMERS . " where customers_id =  " . (int)$customer_id);
                $query_result = tep_db_fetch_array($query);
                $customer_discount = $query_result['customers_discount'];

                // group discount:
                $customers_groups_discount = 0;
                if (is_file(DIR_WS_EXT . 'customers_groups/customers_groups.php')) {
                    $query_group = tep_db_query("select g.customers_groups_discount from " . TABLE_CUSTOMERS_GROUPS . " g inner join  " . TABLE_CUSTOMERS . " c on g.customers_groups_id = c.customers_groups_id and c.customers_id = " . (int)$customer_id);
                    $query_group_result = tep_db_fetch_array($query_group);
                    $customers_groups_discount = $query_group_result['customers_groups_discount'];
                }
                $customer_discount = $customer_discount + $customers_groups_discount;
            }
        }
        return $customer_discount;
    }

    function attr_prefix($products_id)
    {
        return $this->contents[$products_id]['attributes_prefix'];
    }

    function show_total()
    {
        $this->calculate();
        return $this->total;
    }

    function show_weight()
    {
        $this->calculate();

        return $this->weight;
    }

    function generate_cart_id($length = 5)
    {
        return tep_create_random_value($length, 'digits');
    }

    function get_content_type()
    {
        $this->content_type = false;

        if ((DOWNLOAD_ENABLED == 'true') && ($this->count_contents() > 0)) {
            reset($this->contents);
            foreach ($this->contents as $products_id => $value) {
                if (isset($this->contents[$products_id]['attributes'])) {
                    reset($this->contents[$products_id]['attributes']);
                    foreach ($this->contents[$products_id]['attributes'] as $products_id => $value) {
                        $virtual_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad where pa.products_id = " . (int)$products_id . " and pa.options_values_id = " . (int)$value . " and pa.products_attributes_id = pad.products_attributes_id");
                        $virtual_check = tep_db_fetch_array($virtual_check_query);

                        if ($virtual_check['total'] > 0) {
                            switch ($this->content_type) {
                                case 'physical':
                                    $this->content_type = 'mixed';

                                    return $this->content_type;
                                    break;
                                default:
                                    $this->content_type = 'virtual';
                                    break;
                            }
                        } else {
                            switch ($this->content_type) {
                                case 'virtual':
                                    $this->content_type = 'mixed';

                                    return $this->content_type;
                                    break;
                                default:
                                    $this->content_type = 'physical';
                                    break;
                            }
                        }
                    }
// ICW ADDED CREDIT CLASS - Begin
                } elseif ($this->show_weight() == 0) {
                    reset($this->contents);
                    foreach ($this->contents as $products_id => $value) {
                        $virtual_check_query = tep_db_query("select products_weight from " . TABLE_PRODUCTS . " where products_id = " . (int)$products_id);
                        $virtual_check = tep_db_fetch_array($virtual_check_query);
                        if ($virtual_check['products_weight'] == 0) {
                            switch ($this->content_type) {
                                case 'physical':
                                    $this->content_type = 'mixed';

                                    return $this->content_type;
                                    break;
                                default:
                                    $this->content_type = 'virtual_weight';
                                    break;
                            }
                        } else {
                            switch ($this->content_type) {
                                case 'virtual':
                                    $this->content_type = 'mixed';

                                    return $this->content_type;
                                    break;
                                default:
                                    $this->content_type = 'physical';
                                    break;
                            }
                        }
                    }
// ICW ADDED CREDIT CLASS - End
                } else {
                    switch ($this->content_type) {
                        case 'virtual':
                            $this->content_type = 'mixed';

                            return $this->content_type;
                            break;
                        default:
                            $this->content_type = 'physical';
                            break;
                    }
                }
            }
        } else {
            $this->content_type = 'physical';
        }

        return $this->content_type;
    }

    function unserialize($broken)
    {
        for (reset($broken); $kv = each($broken);) {
            $key = $kv['key'];
            if (gettype($this->$key) != "user function") {
                $this->$key = $kv['value'];
            }
        }
    }
}
