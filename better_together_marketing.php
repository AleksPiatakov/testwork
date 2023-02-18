<?php

$value = "ot_better_together.php";
includeLanguages(DIR_WS_LANGUAGES . $language .  '/modules/order_total/' . $value);
require_once(DIR_WS_MODULES . "order_total/" . $value);

$discount = new ot_better_together();
$bt_strings = [];

//  check all products, set for this product as discounts
$xsell_query = '
    select x.xsell_id, x.discount 
    from ' . TABLE_PRODUCTS . ' p, 
         ' . TABLE_PRODUCTS_XSELL . ' x 
    where p.products_status = "1" and x.products_id = p.products_id and 
          x.discount!="" and x.products_id = "' . tep_db_input($_GET['products_id']) . '"';
$xsell_query = tep_db_query($xsell_query);

$all_prods_query = tep_db_query("select products_id from " . TABLE_PRODUCTS . " where products_status = 1");
while ($product_from_all = tep_db_fetch_array($all_prods_query)) {
    $all_products[$product_from_all['products_id']] = $product_from_all;
}
while ($xsell = tep_db_fetch_array($xsell_query)) {
    if (isset($all_products[$xsell['xsell_id']])) {
        $xsell_array[$xsell['xsell_id']] = $xsell;
    }
}

if (isset($xsell_array)) {
    foreach ($xsell_array as $xsell) {
        if (preg_match('/%/', $xsell['discount'])) {
            $procent = '%';
            $xsell['discount'] = preg_replace('/%/', '', $xsell['discount']);
        } else {
            $procent = '$';
        }

        $discount->add_prod_to_prod($_GET['products_id'], $xsell['xsell_id'], $procent, $xsell['discount']);
    }

    if ($discount->check() > 0) {
        $resp = $discount->get_discount_info($_GET['products_id']);
        $resp = array_unique($resp);

        if (count($resp) > 0) {
            foreach ($resp as $item) {
                 $bt_strings[] = $item;
            }
        }
    }
}
