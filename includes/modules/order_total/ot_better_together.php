<?php

/**
 * Better Together Discounts in the order_total module
 * By Scott Wilson (swguy)
 * http://www.thatsoftwareguy.com
 * Version 1.0.2 for osCommerce
 * @copyright Copyright 2006, That Software Guy
 * @copyright Portions Copyright 2004-2006 Zen Cart Team
 * @copyright Portions Copyright 2003 osCommerce
 */

function bt_cmp($a, $b)
{
    if ($a['final_price'] == $b['final_price']) {
        return 0;
    }
    if ($a['final_price'] < $b['final_price']) {
        return 1;
    }
     return -1;
}

  // Make it pretty obvious that there's a problem
function bailout($str)
{
    trigger_error($str);
    die($str);
}

  define('PROD_TO_PROD', '1');
  define('PROD_TO_CAT', '2');
  define('CAT_TO_CAT', '3');
  define('CAT_TO_PROD', '4');

  define('TWOFER_PROD', '11');
  define('TWOFER_CAT', '12');

class bt_discount
{
    function init($ident1, $ident2, $type, $amt, $flavor)
    {
          $this->isvalid = 0;
        if ($type != "$" && $type != "%") {
            bailout("Bad type " . $type);
        }
        if (
            $flavor != PROD_TO_PROD &&
              $flavor != PROD_TO_CAT &&
              $flavor != CAT_TO_PROD &&
              $flavor != CAT_TO_CAT
        ) {
            bailout("Bad flavor " . $flavor);
        }
          $this->ident1 = $ident1; // Product id or category
          $this->ident2 = $ident2; // Product id or category
          $this->type = $type; // % or $
          $this->amt = $amt;   // numerical amount
          $this->flavor = $flavor; // PROD_TO_PROD, PROD_TO_CAT, CAT_TO_CAT, CAT_TO_PROD
          $this->isvalid = 1;
    }
    function getid()
    {
        return $this->ident1;
    }
}

class bt_twofer
{
    function init($ident1, $flavor)
    {
          $this->isvalid = 0;
        if (
            $flavor != TWOFER_PROD &&
              $flavor != TWOFER_CAT
        ) {
            bailout("Bad flavor " . $flavor);
        }
          $this->ident1 = $ident1; // Product id or category
          $this->flavor = $flavor; // PROD, CAT
          $this->isvalid = 1;
    }
    function getid()
    {
        return $this->ident1;
    }
}

class ot_better_together
{
    var $title, $output;

    function __construct()
    {
        $this->code = 'ot_better_together';
        $this->title = MODULE_ORDER_TOTAL_BETTER_TOGETHER_TITLE;
        $this->description = MODULE_ORDER_TOTAL_BETTER_TOGETHER_DESCRIPTION;
        $this->sort_order = MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER;
        $this->include_tax = MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX;
        $this->calculate_tax = MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX;
        $this->credit_class = true;
        $this->output = array();
        $this->discountlist = array();
        $this->twoferlist = array();
        $this->nocontext = 0;

        $this->enabled = ((MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS == 'true') ? true : false);
        if ($this->enabled) {
            $this->setup();
        }
    }

    function setnocontext()
    {
        $this->nocontext = 1;
    }

    function add_twoforone_prod($ident1)
    {
         $d = new bt_twofer();
         $d->init($ident1, TWOFER_PROD);
        if ($d->isvalid == 1) {
            $this->twoferlist[] = & $d;
        }
    }

    function add_twoforone_cat($ident1)
    {
         $d = new bt_twofer();
         $d->init($ident1, TWOFER_CAT);
        if ($d->isvalid == 1) {
            $this->twoferlist[] = & $d;
        }
    }

    function add_prod_to_prod($ident1, $ident2, $type, $amt)
    {
         $d = new bt_discount();
         $d->init($ident1, $ident2, $type, $amt, PROD_TO_PROD);
        if ($d->isvalid == 1) {
            $this->discountlist[] = & $d;
        }
    }

    function add_prod_to_cat($ident1, $ident2, $type, $amt)
    {
         $d = new bt_discount();
         $d->init($ident1, $ident2, $type, $amt, PROD_TO_CAT);
        if ($d->isvalid == 1) {
            $this->discountlist[] = & $d;
        }
    }

    function add_cat_to_cat($ident1, $ident2, $type, $amt)
    {
         $d = new bt_discount();
         $d->init($ident1, $ident2, $type, $amt, CAT_TO_CAT);
        if ($d->isvalid == 1) {
            $this->discountlist[] = & $d;
        }
    }

    function add_cat_to_prod($ident1, $ident2, $type, $amt)
    {
         $d = new bt_discount();
         $d->init($ident1, $ident2, $type, $amt, CAT_TO_PROD);
        if ($d->isvalid == 1) {
            $this->discountlist[] = & $d;
        }
    }

    function cat_compatible($products_id, $id2)
    {
        $category_query = tep_db_query("select p2c.categories_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = '" . (int)$products_id . "' and p.products_status = '1' and p.products_id = p2c.products_id");
        if (tep_db_num_rows($category_query)) {
            while ($category = tep_db_fetch_array($category_query)) {
                if ($category['categories_id'] == $id2) {
                    return true;
                }
            }
        }

        return false;
    }

    function get_category_name($cat_id, $language = '')
    {
        global $languages_id;

        if (empty($language)) {
            $language = $languages_id;
        }

        $category_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$cat_id . "' and language_id = '" . (int)$language . "'");
        $category = tep_db_fetch_array($category_query);

        return $category['categories_name'];
    }

    function get_tax_rate_from_desc($tax_desc)
    {
        $tax_rate = 0.00;

        $tax_descriptions = explode(' + ', $tax_desc);
        foreach ($tax_descriptions as $tax_description) {
            $tax_query_str = "SELECT tax_rate
                      FROM " . TABLE_TAX_RATES . "
                      WHERE tax_description = '" . addslashes($tax_desc) . "'";

            $tax_query = tep_db_query($tax_query_str);
            if (tep_db_num_rows($tax_query)) {
                while ($tax = tep_db_fetch_array($tax_query)) {
                    $tax_rate += $tax['tax_rate'];
                }
            }
        }
        return $tax_rate;
    }

    function print_amount($amount)
    {
        global $order, $currencies;
        return  $currencies->format($amount, true, $order->info['currency'], $order->info['currency_value']);
    }

    function get_discount($discount_item, &$all_items)
    {
        $discount = 0;
        for ($dis = 0, $n = count($this->discountlist); $dis < $n; $dis++) {
            $li = $this->discountlist[$dis];

            // Based on type, check ident1
            if (
                ($li->flavor == PROD_TO_PROD) ||
                ($li->flavor == PROD_TO_CAT)
            ) {
                if ($li->ident1 != $discount_item['id']) {
                    continue;
                }
            } else { // CAT_TO_CAT, CAT_TO_PROD
                if (!$this->cat_compatible($discount_item['id'], $li->ident1)) {
                    continue;
                }
            }

            for ($i = sizeof($all_items) - 1; $i >= 0; $i--) {
                if ($all_items[$i]['quantity'] == 0) {
                    continue;
                }
                $match = 0;
                if (
                    ($li->flavor == PROD_TO_PROD) ||
                    ($li->flavor == CAT_TO_PROD)
                ) {
                    if ($all_items[$i]['id'] == $li->ident2) {
                        $match = 1;
                    }
                } else { // CAT_TO_CAT, PROD_TO_CAT
                    if ($this->cat_compatible($all_items[$i]['id'], $li->ident2)) {
                        $match = 1;
                    }
                }

                if ($match == 1 && !$discount_item["received_discount"] && !$all_items[$i]['received_discount']) {
                    $all_items[$i]['quantity'] -= 1;
                    if ($li->type == "$") {
                        $discount = $li->amt;
                    } else {
                        $discount = ($all_items[$i]['final_price'] + $discount_item["price"]) *
                            $li->amt / 100;
                    }
                    $discount_item["received_discount"] = $all_items[$i]['received_discount'] = true;
                    return $discount;
                }
            }
        }

        return 0;
    }

    function is_twofer($discount_item)
    {
        $discount = 0;
        foreach ($this->twoferlist as $item) {
            $li = $item;

            // Based on type, check ident1
            if (
                ($li->flavor == TWOFER_PROD) &&
                ($li->ident1 == $discount_item['id'])
            ) {
                return true;
            } else if (
                ($li->flavor == TWOFER_CAT) &&
                $this->cat_compatible($discount_item['id'], $li->ident1)
            ) {
                return true;
            }
        }
        return false;
    }

    function process()
    {
        global $order, $currencies;

        $od_amount = $this->calculate_deductions();
        if ($od_amount['total'] > 0) {
            reset($order->info['tax_groups']);
            foreach ($order->info['tax_groups'] as $key => $value) {
                $tax_rate = $this->get_tax_rate_from_desc($key);
                if ($od_amount[$key]) {
                    $order->info['tax_groups'][$key] -= $od_amount[$key];
                    if ($this->calculate_tax != 'VAT') {
                        $order->info['total'] -=  $od_amount[$key];
                    }
                }
            }
            $order->info['total'] = $order->info['total'] - $od_amount['total'];
            $this->output[] = array('title' => $this->title . ':',
                                 'text' => '-' . $currencies->format($od_amount['total'], true, $order->info['currency'], $order->info['currency_value']),
                                 'value' => $od_amount['total']);
        }
    }

    function calculate_deductions()
    {
        global $order, $currencies;
        global $cart;

        $od_amount = array();
        $od_amount['tax'] = 0;

        $products = $cart->get_products();
        reset($products);
        $rc = usort($products, "bt_cmp");
        $discountable_products = array();
       // Build discount list
        foreach ($products as $product) {
            $product['received_discount'] = false;
            $discountable_products[] = $product;
        }

       // Now compute discounts
        $discount = 0;
        foreach ($discountable_products as $key => $discountable_product) {
            $discountable_product['received_discount'] = $discountable_products[$key]['received_discount'];
            if ($this->is_twofer($discountable_product)) {
                $npairs = (int)($discountable_product['quantity'] / 2);
                $discountable_product['quantity'] -= ($npairs * 2);
                $item_discountable = $npairs * $discountable_product['final_price'];
                if ($this->include_tax == 'true') {
                    $discount += $this->gross_up($item_discountable);
                } else {
                    $discount += $item_discountable;
                }
            }

            // Otherwise, do regular bt processing
            while ($discountable_product['quantity'] > 0) {
                $discountable_product['quantity'] -= 1;
                $item_discountable = $this->get_discount(
                    $discountable_product,
                    $discountable_products
                );
                $discountable_products[$key]['received_discount'] = true;
                if ($item_discountable == 0) {
                    $discountable_product['quantity'] += 1;
                    break;
                } else {
                    if ($this->include_tax == 'true') {
                        $discount += $this->gross_up($item_discountable);
                    } else {
                        $discount += $item_discountable;
                    }
                }
            }
        }

        $od_amount['total'] = round($discount, 2);
        switch ($this->calculate_tax) {
            case 'Standard':
                if (is_array($order->info['tax_groups'])) {
                    reset($order->info['tax_groups']);
                    foreach ($order->info['tax_groups'] as $key => $value) {
                           $tax_rate = $this->get_tax_rate_from_desc($key);
                        if ($tax_rate > 0) {
                            $od_amount[$key] = $tod_amount = round((($od_amount['total'] * $tax_rate)) / 100, 2) ;
                            $od_amount['tax'] += $tod_amount;
                        }
                    }
                }
                break;

            case 'VAT':
                 reset($order->info['tax_groups']);
                foreach ($order->info['tax_groups'] as $key => $value) {
                    $tax_rate = $this->get_tax_rate_from_desc($key);
                    if ($tax_rate > 0) {
                         $od_amount[$key] = $tod_amount = $this->gross_down($od_amount['total']);
                         $od_amount['tax'] += $tod_amount;
                    }
                }
                break;
        }
        return $od_amount;
    }

   // Required for 'VAT'
    function gross_down($figure)
    {
        global $order;
        $gross_up_amt = 0;
        reset($order->info['tax_groups']);
        foreach ($order->info['tax_groups'] as $key => $value) {
            $tax_rate = $this->get_tax_rate_from_desc($key);
            if ($tax_rate > 0) {
                $amt += $figure / (1 + ($tax_rate / 100));
                $gross_up_amt += round($amt, 2);
            }
        }
        return $figure - $gross_up_amt;
    }

    function gross_up($net)
    {
        global $order;
        $gross_up_amt = 0;
        reset($order->info['tax_groups']);
        foreach ($order->info['tax_groups'] as $key => $value) {
            $tax_rate = $this->get_tax_rate_from_desc($key);
            if ($tax_rate > 0) {
                $gross_up_amt += round((($net * $tax_rate)) / 100, 2) ;
            }
        }
        return $gross_up_amt + $net;
    }

    function pre_confirmation_check($order_total)
    {
        $od_amount = $this->calculate_deductions();
        return $od_amount['total'] + $od_amount['tax'];
    }

    function credit_selection()
    {
        return $selection;
    }

    function collect_posts()
    {
    }

    function update_credit_account($i)
    {
    }

    function apply_credit()
    {
    }

    function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }

        return $this->_check;
    }

    static function keys()
    {
        return array('MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS', 'MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER', 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX', 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX');
    }

    static function install()
    {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('&copy; That Software Guy<br />This module is installed', 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_STATUS', 'true', '', '6', '1','tep_cfg_select_option(array(\'true\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_OT_BETTER_TOGETHER_SORT_ORDER', '2', 'Sort order of display.', '6', '12', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Include Tax', 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_INC_TAX', 'false', 'Include Tax in calculation.', '6', '13','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Re-calculate Tax', 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_CALC_TAX', 'Standard', 'Re-Calculate Tax', '6', '14','tep_cfg_select_option(array(\'None\', \'Standard\', \'VAT\'), ', now())");
    }

    function remove()
    {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", static::keys()) . "')");
    }

    // call this in product info page
    function get_discount_info($id)
    {
        global $order, $currencies;
        global $languages_id;
        $response_arr = array();

        foreach ($this->twoferlist as $item) {
            $li = $item;
            $match = 0;
            if (
                ($li->flavor == TWOFER_PROD) &&
                ($li->ident1 == $id)
            ) {
                $match = 1;
                if ($this->nocontext == 0) {
                    $disc_string = TWOFER_PROMO_STRING;
                } else {
                    $disc_link = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $li->ident1) . '">' . tep_get_products_name($li->ident1, $languages_id) . '</a>';
                    $disc_string = sprintf(TWOFER_QUALIFY_STRING, $disc_link);
                }
            } else if (
                ($li->flavor == TWOFER_CAT) &&
                       $this->cat_compatible($id, $li->ident1)
            ) {
                $match = 1;
                if ($this->nocontext == 0) {
                    $disc_string = TWOFER_PROMO_STRING;
                } else {
                    $disc_link = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $id) . '">' . tep_get_products_name($id, $languages_id) . '</a>';
                    $disc_string = sprintf(TWOFER_QUALIFY_STRING, $disc_link);
                }
            }
            if ($match == 1) {
                $response_arr[] = $disc_string;
                continue;
            }
        }
              $product_info_query = tep_db_query("select pd.products_name, p.products_image, p.products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$id . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
              $product_info = tep_db_fetch_array($product_info_query);

//       for ($dis=0, $n=count($this->discountlist); $dis<$n; $dis++) {
        foreach ($this->discountlist as $item1) {
            $li = $item1;

            $match = 0;
            if (
                ($li->flavor == PROD_TO_PROD) &&
                ($li->ident1 == $id)
            ) {
                $match = 1;

                $product_better_query = tep_db_query("select pd.products_name, p.products_image, p.products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$li->ident2 . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
                $product_better = tep_db_fetch_array($product_better_query);

               // $disc_link = '<a href="'.tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $li->ident2).'">
               //                 <div class="nazva"><div>'. $product_better['products_name'].'</div></div>
               //                 <div class="left"><img height="40" src="/images/'. $product_info['products_image'].'" /></div>
               //                 <div class="left"><img height="80" src="/images/'. $product_better['products_image'].'" /></div>
               //                 <div class="clear"></div>
               //               </a>';

                if ($li->type == "%") {
                    $btDiscount = ($product_info['products_price'] + $product_better['products_price']) * ($li->amt / 100);
                    $discountString = $li->amt . '%';
                } else {
                    $btDiscount = $li->amt;
                    $discountString = $currencies->format($li->amt, true, $order->info['currency'], $order->info['currency_value']);
                }
                $btPrice = $product_info['products_price'] + $product_better['products_price'] - $btDiscount;
                if ($btPrice > 0 && $btDiscount > 0) {
                    $disc_link = '<div class="better_together_box">
                            <div class="bt_product col-xl-2 col-lg-3 col-md-3 col-sm-4 col-xs-4">
                            
                                <a class="p_img_href" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $li->ident1) . '">
                                <img width="150" height="150" src="getimage/150x150/products/' . explode(';', $product_info['products_image'])[0] . '" 
                                data-src="getimage/150x150/products/' . explode(';', $product_info['products_image'])[0] . '"
                                data-hover="getimage/150x150/products/' . explode(';', $product_info['products_image'])[1] . '"/>
                                </a>
                              
                              <div class="new_price">
                              ' . $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '
                              </div>
                              <div class="name">
                                <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $li->ident1) . '" class="model_product">' . $product_info['products_name'] . '</a>
                              </div>
                            </div>
                            <div class="bt_middle_section">
                                <div class="item">
                                   <p class="discount">' . sprintf(BETTER_TOGETHER_DISCOUNT, $discountString) . '</p> 
                                   <p class="saving">' . BETTER_TOGETHER_SAVING . $currencies->display_price($btDiscount, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</p>
                                </div>
                              <div class="btogether-plus">+</div>
                              <div class="item">
                               <p class="old_price">' . $currencies->display_price($product_info['products_price'] + $product_better['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</p>
                                <p class="new_price">' . $currencies->display_price($product_info['products_price'] + $product_better['products_price'] - $btDiscount, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</p>

                                <input type="hidden" name="bt_products_id" value="' . $li->ident2 . '">
                                <input type="hidden" name="products_id" value="' . $li->ident1 . '">
                                <button type="submit" class="btn btn-primary add2cart">' . BETTER_TOGETHER_SUBMIT . '</button>
                            </div>
                            </div>
                            <div class="bt_product col-xl-2 col-lg-3 col-md-3 col-sm-4 col-xs-4">
                              
                                <a class="p_img_href" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $li->ident2) . '">
                                <img width="150" height="150" src="getimage/150x150/products/' . explode(';', $product_better['products_image'])[0] . '" 
                                data-src="getimage/150x150/products/' . explode(';', $product_better['products_image'])[0] . '"
                                data-hover="getimage/150x150/products/' . explode(';', $product_better['products_image'])[1] . '"/>
                                </a>
                              
                              <p class="new_price">' . $currencies->display_price($product_better['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</p>
                            <div class="name">
                                <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $li->ident2) . '" class="model_product">' . $product_better['products_name'] . '</a>
                              </div>
                            </div>
                            </div>';
                }
            } else if (
                ($li->flavor == PROD_TO_CAT) &&
                ($li->ident1 == $id)
            ) {
                $match = 1;
                $disc_link = '<a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $li->ident2) . '">' . $this->get_category_name($li->ident2, $languages_id) . '</a>';
            } else if (
                ($li->flavor == CAT_TO_CAT) &&
                $this->cat_compatible($id, $li->ident1)
            ) {
                $match = 1;
                $disc_link = '<a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $li->ident2) . '">' . $this->get_category_name($li->ident2, $languages_id) . '</a>';
            } else if (
                ($li->flavor == CAT_TO_PROD) &&
                $this->cat_compatible($id, $li->ident1)
            ) {
                $match = 1;
                $disc_link = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $li->ident2) . '">' . tep_get_products_name($li->ident2, $languages_id) . '</a>';
            }

            if ($match == 1) {
                $disc_string = $disc_link;
                $disc_string .= " ";
                if ($li->type == "%") {
                    if ($li->amt != 100) {
                        $str_amt = $li->amt . "%";
                        $off_string = sprintf(OFF_STRING_PCT, $str_amt);
                    } else {
                        $off_string = FREE_STRING;
                    }
                 //  $disc_string .= $off_string;
                } else {
                    $curr_string = $currencies->format($li->amt, true, $order->info['currency'], $order->info['currency_value']);
                    $off_string = sprintf(OFF_STRING_CURR, $curr_string);
                 //  $disc_string .= $off_string;
                }

 //              $disc_string .= '<div class="left discount label2">'.$off_string.'</div>';
               //$disc_string .= '<div class="add_together_plus">+</div>';
                $response_arr[] = $disc_string;
            }
        }
        return $response_arr;
    }

    // call this in product info page to show what to do to get a
    // discount (the opposite way.)
    function get_reverse_discount_info($id)
    {
        global $order, $currencies;
        global $languages_id;
        $response_arr = array();

//       for ($dis=0, $n=count($this->discountlist); $dis<$n; $dis++) {
        foreach ($this->discountlist as $item) {
            $li = $item;
            $match = 0;
            if ($li->ident2 == $li->ident1) {
                continue;
            }
            $this_string = REV_GET_DISC;
            if (
                ($li->flavor == PROD_TO_PROD) &&
                ($li->ident2 == $id)
            ) {
                $match = 1;
                $disc_link = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $li->ident1) . '">' . tep_get_products_name($li->ident1, $languages_id) . '</a>';
                if ($this->nocontext == 1) {
                    $this_string = GET_YOUR_PROD . tep_get_products_name($li->ident2, $languages_id);
                }
            } else if (
                ($li->flavor == PROD_TO_CAT) &&
                $this->cat_compatible($id, $li->ident2)
            ) {
                $match = 1;
                $disc_link = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $li->ident1) . '">' . tep_get_products_name($li->ident1, $languages_id) . '</a>';
                if ($this->nocontext == 1) {
                    $this_string = GET_YOUR_CAT . $this->get_category_name($li->ident2, $languages_id);
                }
            } else if (
                ($li->flavor == CAT_TO_CAT) &&
                $this->cat_compatible($id, $li->ident2)
            ) {
                $match = 1;
                $disc_link = '<a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $li->ident1) . '">' . $this->get_category_name($li->ident1, $languages_id) . '</a>';
                if ($this->nocontext == 1) {
                    $this_string = GET_YOUR_CAT . $this->get_category_name($li->ident2, $languages_id);
                }
            } else if (
                ($li->flavor == CAT_TO_PROD) &&
                ($li->ident2 == $id)
            ) {
                $match = 1;
                $disc_link = '<a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $li->ident1) . '">' . $this->get_category_name($li->ident1, $languages_id) . '</a>';
                if ($this->nocontext == 1) {
                    $this_string = GET_YOUR_PROD . tep_get_products_name($li->ident2, $languages_id);
                }
            }
            if ($match == 1) {
                if (
                    ($li->flavor == PROD_TO_PROD) ||
                    ($li->flavor == PROD_TO_CAT)
                ) {
                    $disc_string = REV_GET_THIS;
                } else { // CAT_TO_CAT, CAT_TO_PROD
                    $disc_string = REV_GET_ANY;
                }
                $disc_string .= $disc_link;
                $disc_string .= $this_string;
                if ($li->type == "%") {
                    if ($li->amt != 100) {
                        $str_amt = $li->amt . "%";
                        $off_string = sprintf(OFF_STRING_PCT, $str_amt);
                    } else {
                        $off_string = FREE_STRING;
                    }
                    $disc_string .= $off_string;
                } else {
                    $curr_string = $currencies->format($li->amt, true, $order->info['currency'], $order->info['currency_value']);
                    $off_string = sprintf(OFF_STRING_CURR, $curr_string);
                    $disc_string .= $off_string;
                }
                $response_arr[] = $disc_string;
            }
        }
        return $response_arr;
    }

    function setup()
    {
        // Add all linkages here
        // Some examples are provided:

        //$this->add_prod_to_prod(29, 13, "%", 80);
        if ($_POST['products_id'] == '') {
            $xsell_query = tep_db_query('
              select x.products_id, x.xsell_id, x.discount 
              from ' . TABLE_PRODUCTS . ' p, 
              ' . TABLE_PRODUCTS_XSELL . ' x 
              where p.products_status = "1" and x.products_id = p.products_id and
               x.discount!=""');
            $all_prods_query = tep_db_query('select products_id from ' . TABLE_PRODUCTS . " where products_status = 1");
            while ($product_from_all = tep_db_fetch_array($all_prods_query)) {
                $all_products[$product_from_all['products_id']] = $product_from_all;
            }
            while ($xsell = tep_db_fetch_array($xsell_query)) {
                if (!empty($all_products) && !isset($all_products[$xsell['xsell_id']])) {
                    continue;
                }
                if (preg_match('/%/', $xsell['discount'])) {
                    $procent = '%';
                    $xsell['discount'] = preg_replace('/%/', '', $xsell['discount']);
                } else {
                    $procent = '$';
                }

                $this->add_prod_to_prod((int)$xsell['products_id'], (int)$xsell['xsell_id'], $procent, $xsell['discount']);
            }
        }
    }
}
