<?php

/*
  $Id: ot_coupon.php,v 1.4 2004/03/09 17:56:06 ccwjr Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

class ot_coupon
{
    var $title, $output;

    function __construct()
    {

        $this->code = 'ot_coupon';
        $this->header = MODULE_ORDER_TOTAL_COUPON_HEADER;
        $this->title = MODULE_ORDER_TOTAL_COUPON_TITLE;
        $this->description = MODULE_ORDER_TOTAL_COUPON_DESCRIPTION;
        $this->user_prompt = '';
        $this->enabled = MODULE_ORDER_TOTAL_COUPON_STATUS;
        $this->sort_order = MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER;
        $this->include_shipping = MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING;
        $this->include_tax = MODULE_ORDER_TOTAL_COUPON_INC_TAX;
        $this->calculate_tax = MODULE_ORDER_TOTAL_COUPON_CALC_TAX;
        $this->tax_class = MODULE_ORDER_TOTAL_COUPON_TAX_CLASS;
        $this->credit_class = true;
        $this->output = [];
    }

    function process()
    {
        global $order, $currencies;
        $order_total = $order->info['total'];
        $discount = $this->calculate_credit($order_total);

        $this->deduction = $discount;
        if ($this->calculate_tax != "false") {
            $this->calculate_tax_deduction($order_total, $this->deduction);
        }

        if ($discount > 0) {
            $order->info['total'] = $order->info['total'] - $discount;
            $this->output[] = ['title' => $this->title . ' ' . $this->getCouponDiscount($this->coupon_code) . '', 'text' => '<b>-' . $currencies->format($discount) . '</b>', 'value' => $discount]; //Fred added hyphen
        }
    }

    //end change 510b
    function selection_test()
    {
        return false;
    }

    function pre_confirmation_check($order_total)
    {
        return $this->calculate_credit($order_total);
    }

    function use_credit_amount()
    {
        return $output_string;
    }

    function credit_selection()
    {
        global $customer_id, $currencies, $language;
        $selection_string = '';
        $selection_string .= '<tr>' . "\n";
        $selection_string .= ' <td width="10"></td>';
        $selection_string .= ' <td class="main">' . "\n";
        $image_submit = '<input type="image" name="submit_redeem" onClick="submitFunction()" src="' . DIR_WS_TEMPLATES . TEMPLATE_NAME . '/images/buttons/' . $language . '/button_redeem.gif" border="0" alt="' . IMAGE_REDEEM_VOUCHER . '" title = "' . IMAGE_REDEEM_VOUCHER . '">';
        $selection_string .= TEXT_ENTER_COUPON_CODE . tep_draw_input_field('gv_redeem_code') . '</td>';
        $selection_string .= ' <td align="right">' . $image_submit . '</td>';
        $selection_string .= ' <td width="10"></td>';
        $selection_string .= '</tr>' . "\n";

        return $selection_string;
    }

    function collect_posts()
    {
    }

    function calculate_credit($orderTotal)
    {
        global $order, $cc_ids;
        $finalDiscount = 0;
        if (isset($cc_ids)) {
            $calculatedProducts = [];
            $couponCheckQuery = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_id in (" . implode(',', $cc_ids) . ") limit 1");

            if (tep_db_num_rows($couponCheckQuery) != 0) {
                $couponCheckResult = tep_db_fetch_array($couponCheckQuery);
                $this->coupon_code = $couponCheckResult['coupon_code'];
                $couponQuery = tep_db_query("select coupon_amount, coupon_minimum_order, restrict_to_products, restrict_to_categories, coupon_type from " . TABLE_COUPONS . " where coupon_id in (" . implode(
                    ',',
                    $cc_ids
                ) . ") and coupon_code = '" . $couponCheckResult['coupon_code'] . "' and LOWER(coupon_active) = 'y' order by restrict_to_products desc, restrict_to_categories desc");
                $shippingDiscount = 0;

                //for each suitable coupon
                while ($couponParams = tep_db_fetch_array($couponQuery)) {
                    $useForEachProduct = false;
                    if (($couponParams['restrict_to_products'] || $couponParams['restrict_to_categories'] !== '') && strpos($couponParams['coupon_type'], 'E') !== false) {
                        $useForEachProduct = true;
                    }

                    //if order price bigger then stated in coupon settings
                    if ($couponParams['coupon_minimum_order'] <= $orderTotal) {
                        $validProducts = [];

                        //get free shipping param
                        if (strpos($couponParams['coupon_type'], 'S') !== false) {
                            $shippingDiscount = $order->info['shipping_cost'];
                        }

                        //if coupon has a restrictions
                        if (!empty($couponParams['restrict_to_products']) || $couponParams['restrict_to_categories'] !== '') {
                            //collect valid products array
                            foreach ($order->products as $product) {
                                $isValidProduct = false;
                                $productId = tep_get_prid($product['id']);

                                //if coupon action is restricted by product`s id(s)
                                if (!empty($couponParams['restrict_to_products'])) {
                                    $isValidProduct = false;
                                    $productsIds = array_unique(preg_split('[,]', preg_replace('/\s+/', '', $couponParams['restrict_to_products'])));
                                    if (in_array($productId, $productsIds)) {
                                        $isValidProduct = true;
                                    }
                                }

                                //if coupon action is restricted by category(ies)
                                if ($couponParams['restrict_to_categories'] !== '' && !in_array('', explode(',', $couponParams['restrict_to_categories']))) {
                                    $isValidProduct = false;
                                    //check if product is valid
                                        $categoryQuery = tep_db_query("select products_id from products_to_categories where products_id = '" . $productId . "' and categories_id in(" . $couponParams['restrict_to_categories'] . ")");
                                    if (tep_db_num_rows($categoryQuery) != 0) {
                                        $isValidProduct = true;
                                    }
                                }

                                //if product is valid
                                if ($isValidProduct) {
                                    $validProducts[] = [
                                        'id' => $productId,
                                        'qty' => $product['qty'],
                                    ];
                                }
                            }
                        } else {
                                //get all order`s products
                                $validProducts = $order->products;
                        }

                        //if is any restriction and enabled option "Use for each eligible product" or uses percent then calculate discount for each product else get discount one time
                        if (!$useForEachProduct && strpos($couponParams['coupon_type'], 'P') === false) {
                            $validProducts = [];
                            //get discount one time
                            $finalDiscount += $couponParams['coupon_amount'];
                        }

                        //if exist products which are fit discount restrictions
                        if (sizeof($validProducts) > 0) {
                            foreach ($validProducts as $product) {
                                //if a discount has not been applied to this product earlier
                                if (!in_array($product['id'], $calculatedProducts)) {
                                    $calculatedProducts[] = $product['id'];

                                    //calculate final discount
                                    //if the discount is applied as a percentage
                                    if (strpos($couponParams['coupon_type'], 'P') !== false) {
                                        $productPrice = $this->product_price($product['id'], (!$couponParams['restrict_to_products'] && $couponParams['restrict_to_categories'] === '') || $useForEachProduct);
                                        $productPrice = round($productPrice * 100) / 100;
                                        $productDiscount = $productPrice * $couponParams['coupon_amount'] / 100;
                                        $finalDiscount += $productDiscount;
                                    } else {
                                        //if the discount is applied in currency
                                        $finalDiscount += $couponParams['coupon_amount'] * $product['qty'];
                                    }
                                }
                            }
                        }
                    }
                }

                //add discount for shipping one time (if isset free shipping)
                $finalDiscount += $shippingDiscount;
            }

            //check that final discount is not bigger than order total
            if ($finalDiscount > $orderTotal) {
                $finalDiscount = $orderTotal;
            }
        }

        return $finalDiscount;
    }

    function getCouponDiscount($couponCode)
    {
        global $cc_ids, $currencies;
        $couponQuery = "
            select coupon_amount, coupon_type 
            from " . TABLE_COUPONS . " 
            where coupon_id in (" . implode(',', $cc_ids) . ") and 
                  coupon_code = '" . $couponCode . "' and 
                  LOWER(coupon_active) = 'y' 
            order by restrict_to_products desc, restrict_to_categories desc";
        $couponQuery = tep_db_query($couponQuery);
        $couponParams = tep_db_fetch_array($couponQuery);

        $couponParams["coupon_amount"] = cutToFirstSignificantDigit($couponParams["coupon_amount"]);

        if (strpos($couponParams['coupon_type'], 'P') !== false) {
            $couponDiscount = $couponParams["coupon_amount"] . '%';
        } else {
            $couponDiscount = $currencies->format($couponParams["coupon_amount"]);
        }

        if (strpos($couponParams['coupon_type'], 'S') !== false) {
            $format = !empty($couponDiscount) ? ( ' (%s)') : '%s';
            $couponDiscount .= sprintf($format, getConstantValue('NEW_CHECKOUT_COUPON_TEXT_FREE_SHIPPING'));
        }

        return $couponDiscount;
    }

    function calculate_tax_deduction($orderTotal, $discount)
    {
        global $order, $cc_ids;

        $taxFinalDiscount = 0;
        if (isset($cc_ids)) {
            $couponCheckQuery = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_id in (" . implode(',', $cc_ids) . ") limit 1");

            //coupon is existing
            if (tep_db_num_rows($couponCheckQuery) != 0) {
                $couponCheckResult = tep_db_fetch_array($couponCheckQuery);

                //get coupon`s params
                $couponQuery = tep_db_query("select coupon_amount, coupon_minimum_order, restrict_to_products, restrict_to_categories, coupon_type from " . TABLE_COUPONS . " where coupon_id in (" . implode(
                    ',',
                    $cc_ids
                ) . ") and coupon_code = '" . $couponCheckResult['coupon_code'] . "' and LOWER(coupon_active) = 'y' order by restrict_to_products desc, restrict_to_categories desc");

                //for each suitable coupon
                while ($couponParams = tep_db_fetch_array($couponQuery)) {
                    $totalPrice = 0;
                    $validProducts = [];

                    //if coupon has a restrictions
                    if ($couponParams['restrict_to_products'] || $couponParams['restrict_to_categories'] !== '') {
                        foreach ($order->products as $product) {
                            $validProduct = false;
                            $productId = tep_get_prid($product['id']);

                            //if coupon action is restricted by product`s id(s)
                            if ($couponParams['restrict_to_products']) {
                                $validProduct = false;
                                //check if product is valid
                                $pr_ids = preg_split('[,]', $couponParams['restrict_to_products']);
                                if (in_array($productId, $pr_ids)) {
                                    $validProduct = true;
                                }
                            }

                            //if coupon action is restricted by category(ies)
                            if ($couponParams['restrict_to_categories'] !== '') {
                                $validProduct = false;
                                //check if product is valid
                                if (!$validProduct) {
                                    $categoryQuery = tep_db_query("select products_id from products_to_categories where products_id = '" . $productId . "' and categories_id in(" . $couponParams['restrict_to_categories'] . ")");
                                    if (tep_db_num_rows($categoryQuery) != 0) {
                                        $validProduct = true;
                                    }
                                }
                            }
                            //if product is valid
                            if ($validProduct) {
                                //get tax params
                                $taxQuery = tep_db_query("select products_tax_class_id as tax_class_id from " . TABLE_PRODUCTS . " where products_id = '" . $productId . "'");
                                $taxParams = tep_db_fetch_array($taxQuery);

                                //get all order`s products and use sum of all valid products as total price of products with discounts
                                $validProducts[] = [
                                    'id' => $productId,
                                    'final_price' => $product['final_price'],
                                    'tax_class_id' => $taxParams['tax_class_id'],
                                    'qty' => $product['qty'],
                                ];
                                $totalPrice += $product['final_price'] * $product['qty'];
                            }
                        }
                    } else {
                        //get all order`s products and use order total as total price of products with discounts
                        $validProducts = $order->products;
                        $totalPrice = $orderTotal;
                    }

                    //get ratio from coupon data or by calculating discount to order total without shipping cost
                    //tax do not demands from shipping cost
                    if (strpos($couponParams['coupon_type'], 'P') !== false) {
                        $ratio = $couponParams['coupon_amount'] / 100;
                    } elseif ($totalPrice - $order->info['shipping_cost'] != 0) {
                        $ratio = $discount / ($totalPrice - $order->info['shipping_cost']);
                    } else {
                        $ratio = 1;
                    }

                    //if exist products with discount
                    if (sizeof($validProducts) > 0) {
                        $taxFinalDiscount = [];
                        foreach ($validProducts as $product) {
                            //get tax params
                            $tax_rate = tep_get_tax_rate($product['tax_class_id'], $order->delivery['country']['id'], $order->delivery['zone_id'], true);
                            $tax_desc = tep_get_tax_description($product['tax_class_id'], $order->delivery['country']['id'], $order->delivery['zone_id'], true);

                            if ($tax_rate > 0) {
                                //calculate price of one order item
                                $orderItemPrice = $product['final_price'] * $product['qty'];
                                //calculate discount to tax
                                $taxDeduction = $orderItemPrice * $ratio * $tax_rate / 100;
                                //save discount(s) for tax
                                $taxFinalDiscount[$tax_desc] += $taxDeduction;
                                $order->info['tax_groups'][$tax_desc] -= $taxDeduction;
                                if (DISPLAY_PRICE_WITH_TAX === "false" && DISPLAY_PRICE_WITH_TAX_CHECKOUT === "true") {
                                    $order->info['total'] -= $taxDeduction;
                                }
                            }
                        }
                    }
                }
            }
        }

        return $taxFinalDiscount;
    }

    function update_credit_account($i)
    {
        return false;
    }

    function apply_credit()
    {
        global $insert_id, $customer_id, $REMOTE_ADDR, $cc_ids, $od_amount;
        //$cc_id = $_SESSION['cc_id']; //Fred commented out, do not use $_SESSION[] due to backward comp. Reference the global var instead.
        $couponId = 0;
        if (isset($cc_ids)) {
            $couponId = implode(',', $cc_ids);
        } elseif (isset($_SESSION['cc_ids'])) {
            $couponId = implode(',', $_SESSION['cc_ids']);
        }
        if ($this->deduction != 0) {
            tep_db_query("insert into " . TABLE_COUPON_REDEEM_TRACK . " (coupon_id, redeem_date, redeem_ip, customer_id, order_id) values ('" . $couponId . "', now(), '" . $REMOTE_ADDR . "', '" . $customer_id . "', '" . $insert_id . "')");
        }
        tep_session_unregister('cc_ids');
    }

    function get_order_total()
    {
        global $order, $cart, $customer_id, $cc_id;
        $total_price = 0;
        //$cc_id = $_SESSION['cc_id']; //Fred commented out, do not use $_SESSION[] due to backward comp. Reference the global var instead.
        $order_total = $order->info['total'];
        // Check if gift voucher is in cart and adjust total
        $products = $cart->get_products();
        for ($i = 0; $i < sizeof($products); $i++) {
            $t_prid = tep_get_prid($products[$i]['id']);
            $gv_query = tep_db_query("select products_price, products_tax_class_id, products_model from " . TABLE_PRODUCTS . " where products_id = '" . $t_prid . "'");
            $gv_result = tep_db_fetch_array($gv_query);
            if (preg_match('/^GIFT/', addslashes($gv_result['products_model']))) {
                $qty = $cart->get_quantity($t_prid);
                $products_tax = tep_get_tax_rate($gv_result['products_tax_class_id']);
                if ($this->include_tax == 'false') {
                    $gv_amount = $gv_result['products_price'] * $qty;
                } else {
                    $gv_amount = ($gv_result['products_price'] + tep_calculate_tax($gv_result['products_price'], $products_tax)) * $qty;
                }
                $order_total = $order_total - $gv_amount;
            }
        }
        if ($this->include_tax == 'false') {
            $order_total = $order_total - $order->info['tax'];
        }
        if ($this->include_shipping == 'false') {
            $order_total = $order_total - $order->info['shipping_cost'];
        }
        // OK thats fine for global coupons but what about restricted coupons
        // where you can only redeem against certain products/categories.
        // and I though this was going to be easy !!!
        $coupon_query = tep_db_query("select coupon_code  from " . TABLE_COUPONS . " where coupon_id='" . $cc_id . "'");
        if (tep_db_num_rows($coupon_query) != 0) {
            $coupon_result = tep_db_fetch_array($coupon_query);
            $coupon_get = tep_db_query("select coupon_amount, coupon_minimum_order,restrict_to_products,restrict_to_categories, coupon_type from " . TABLE_COUPONS . " where coupon_code='" . $coupon_result['coupon_code'] . "'");
            $get_result = tep_db_fetch_array($coupon_get);
            $in_cat = true;
            if ($get_result['restrict_to_categories']) {
                $cat_ids = preg_split('[,]', $get_result['restrict_to_categories']);
                $in_cat = false;
                for ($i = 0; $i < count($cat_ids); $i++) {
                    if (is_array($this->contents)) {
                        reset($this->contents);
                        foreach ($this->contents as $products_id => $val) {
                            // while (list($products_id, ) = each($this->contents)) {
                            $cat_query = tep_db_query("select products_id from products_to_categories where products_id = '" . $products_id . "' and categories_id = '" . $cat_ids[$i] . "'");
                            if (tep_db_num_rows($cat_query) != 0) {
                                $in_cat = true;
                                $total_price += $this->get_product_price($products_id);
                            }
                        }
                    }
                }
            }
            $in_cart = true;
            if ($get_result['restrict_to_products']) {
                $pr_ids = preg_split('[,]', $get_result['restrict_to_products']);

                $in_cart = false;
                $products_array = $cart->get_products();

                for ($i = 0; $i < sizeof($pr_ids); $i++) {
                    for ($ii = 1; $ii <= sizeof($products_array); $ii++) {
                        if (tep_get_prid($products_array[$ii - 1]['id']) == $pr_ids[$i]) {
                            $in_cart = true;
                            $total_price += $this->get_product_price($products_array[$ii - 1]['id']);
                        }
                    }
                }
                $order_total = $total_price;
            }
        }

        return $order_total;
    }

    function get_product_price($product_id, $produce_quantity = true)
    {
        global $cart, $order;
        $total_price = 0;
//        $products_id = tep_get_prid($product_id);
        $cartProduct = $cart->contents[$product_id];
        // products price
        $qty = 1;
        if ($produce_quantity) {
            $qty = $cartProduct['qty'];
        }
        $product_query = tep_db_query("select products_id, products_price, products_tax_class_id, products_weight from " . TABLE_PRODUCTS . " where products_id='" . $product_id . "'");
        if ($product = tep_db_fetch_array($product_query)) {
            $prid = $product['products_id'];
            $products_tax = tep_get_tax_rate($product['products_tax_class_id']);
            $products_price = $product['products_price'];
            if ($new_price = tep_get_products_special_price($prid)) {
                $products_price = $new_price;
            }
            if ($this->include_tax == 'true') {
                $total_price += ($products_price + tep_calculate_tax($products_price, $products_tax)) * $qty;
            } else {
                $total_price += $products_price * $qty;
            }

            // attributes price
            if (isset($cartProduct['attributes'])) {
                  reset($cartProduct['attributes']);

                $combinationPrice = false;
                if (getConstantValue('QTY_PRO_ENABLED') == 'true') {
                    $product_info_query = tep_db_query($sql = "select ps.products_stock_quantity, ps.products_stock_attributes, ps.products_combination_price from " . TABLE_PRODUCTS_STOCK . " ps " .
                        "where ps.products_id = " . (int)$product['id']);
                    if ($product_info_query->num_rows > 0) {
                        if (is_array($cartProduct['attributes'])) {
                            $attributesList = [];
                            foreach ($cartProduct['attributes'] as $attributeKey => $attributeValue) {
                                $attributesList[$attributeKey] = $attributeKey . '-' . $attributeValue;
                            }

                            ksort($attributesList);
                            $attributesList = implode(',', $attributesList);

                            while ($product_info = tep_db_fetch_array($product_info_query)) {
                                $count = 0;
                                $attributesArray = explode(',', $attributesList);
                                foreach ($attributesArray as $attributeCombinationPart) {
                                    if (
                                        in_array(
                                            $attributeCombinationPart,
                                            explode(',', $product_info['products_stock_attributes'])
                                        )
                                    ) {
                                        $count += 1;
                                    }
                                }

                                if ($count == count($attributesArray)) {
                                    $combinationPrice = $product_info['products_combination_price'];
                                    $total_price = $qty * $combinationPrice;
                                }
                            }
                        }
                    }
                }

                if ($combinationPrice === false) {
                    foreach ($cartProduct['attributes'] as $option => $value) {
                        // while (list($option, $value) = each($cartProduct['attributes'])) {
                        $attribute_price_query = tep_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . $prid . "' and options_id = '" . $option . "' and options_values_id = '" . $value . "' order by price_prefix desc");
                        $attribute_price = tep_db_fetch_array($attribute_price_query);
                        switch ($attribute_price['price_prefix']) {
                            case '':
                                break;
                            case '+':
                                if ($this->include_tax == 'true') {
                                    $total_price += $qty * ($attribute_price['options_values_price'] + tep_calculate_tax($attribute_price['options_values_price'], $products_tax));
                                } else {
                                    $total_price += $qty * ($attribute_price['options_values_price']);
                                }
                                break;
                            case '=':
                                if ($this->include_tax == 'true') {
                                    $total_price = $qty * ($attribute_price['options_values_price'] + tep_calculate_tax($attribute_price['options_values_price'], $products_tax));
                                } else {
                                    $total_price = $qty * ($attribute_price['options_values_price']);
                                }
                                break;
                            default:  // '-'
                                if ($this->include_tax == 'true') {
                                    $total_price -= $qty * ($attribute_price['options_values_price'] + tep_calculate_tax($attribute_price['options_values_price'], $products_tax));
                                } else {
                                    $total_price -= $qty * ($attribute_price['options_values_price']);
                                }
                        }
                        /*if ($attribute_price['price_prefix'] == '+') {
                        if ($this->include_tax == 'true') {
                        $total_price += $qty * ($attribute_price['options_values_price'] + tep_calculate_tax($attribute_price['options_values_price'], $products_tax));
                        } else {
                        $total_price += $qty * ($attribute_price['options_values_price']);
                        }
                        } else {
                        if ($this->include_tax == 'true') {
                        $total_price -= $qty * ($attribute_price['options_values_price'] + tep_calculate_tax($attribute_price['options_values_price'], $products_tax));
                        } else {
                        $total_price -= $qty * ($attribute_price['options_values_price']);
                        }
                        }*/
                    }
                }
            }
        }

        if ($this->include_shipping == 'true') {
            $total_price += (float) $order->info['shipping_cost'];
        }

        return $total_price;
    }

    //Added by Fred -- BOF -----------------------------------------------------
    //JUST RETURN THE PRODUCT PRICE (INCL ATTRIBUTE PRICES) WITH OR WITHOUT TAX
    function product_price($product_id, $produce_quantity = true)
    {
        global $order;
        $total_price = $this->get_product_price($product_id, $produce_quantity);
        if ($this->include_shipping == 'true') {
            $total_price -= (float) $order->info['shipping_cost'];
        }

        return $total_price;
    }

    //Added by Fred -- EOF -----------------------------------------------------

    function check()
    {
        if (!isset($this->check)) {
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_COUPON_STATUS'");
            $this->check = tep_db_num_rows($check_query);
        }

        return $this->check;
    }

    static function keys()
    {
        return ['MODULE_ORDER_TOTAL_COUPON_STATUS', 'MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS'];
    }

    static function install()
    {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Показывать всего', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 'true', 'Вы хотите показывать номинал купона?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Порядок сортировки', 'MODULE_ORDER_TOTAL_OT_COUPON_SORT_ORDER', '9', 'Порядок сортировки модуля.', '6', '2', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Учитывать доставку', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 'true', 'Включать в расчёт доставку.', '6', '5', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Учитывать налог', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 'true', 'Включать в расчёт налог.', '6', '6','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Пересчитывать налог', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 'true', 'Пересчитывать налог.', '6', '7','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Налог', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', '0', 'Использовать налог для купонов.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
    }

    function remove()
    {
        $keys = '';
        $keys_array = static::keys();
        for ($i = 0; $i < sizeof($keys_array); $i++) {
            $keys .= "'" . $keys_array[$i] . "',";
        }
        $keys = substr($keys, 0, -1);

        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in (" . $keys . ")");
    }
}
