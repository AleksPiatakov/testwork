<?php

//--------------------------------------------------------------------------------------//
//---  Superfast Product Attribute Filter for osCommerce --- by Solomono.com.ua 2015 ---//
//--------------------------------------------------------------------------------------//

    $p_id = array(); // array with products ids
  $r_mop = 0; // flag, that shows if we have filter values on current page
  $r_filters_count = 0; // counter of filtered attributes on current page
  $count_vals_array = array();

     // create subquery for all $_GET values, if its integer, than its product attributes
foreach ($_GET as $k => $v) {
    if (is_int($k)) { //if its integer, than its product attributes
        $v = addslashes($v);
        $r_filters_count++;
        $mas = explode('-', $v); // create array with set of values for each attribute (3=17,18,19 means ROM=16Gb,32Gb,64Gb)
        //         foreach ($mas as $v1){ // add subquery for each attribute value
        $r_mop = 1; // turn on flag

        // subquery to find right products for current filter:
        $r_supzapros .= " (options_id=" . (int)$k . " and options_values_id in ('" . implode("','", $mas) . "')) or";
        //       }
    }
}

  // if we have filter values on current page
if ($r_mop == 1) {
    $r_supzapros = substr($r_supzapros, 0, -3); // cut -3 symbols in the end of string
    $where_join = '';
    if (!empty($where_subcategories)) {
        $where_join = " LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c ON p2c.products_id = pa.products_id ";
    }
    // find right products for current filter:
    $q = tep_db_query($f_q = "SELECT pa.products_id, pa.options_id, pa.options_values_id FROM products_attributes pa $where_join
    WHERE $where_subcategories (" . $r_supzapros . ")
    GROUP BY pa.products_id
    HAVING count(distinct pa.options_id) >= $r_filters_count");

    while ($res = tep_db_fetch_array($q)) {
      // create array with products_id, options_id and values for every option (every attribute)
        $p_id[$res['products_id']] .= "[" . $res['options_id'] . "," . $res['options_values_id'] . "]";
        $count_vals_array[$res['products_id']] .= $res['options_id'] . ',';
    }

    // deleting unnecessary elements
    /*  foreach($p_id as $r_id => $val) {
    $count_vals = count(array_unique(explode(',',$count_vals_array[$r_id])));
    if(($count_vals-1) != $r_filters_count) unset($p_id[$r_id]);
  }
*/
    if (!empty($p_id)) { // if we found some products for selected attributes
        $where_filters .= 'p.products_id in(' . implode(',', array_keys($p_id)) . ') and'; // preparing subquery for append into main query
    } else { // if there is no products for selected attributes
        $where_filters .= "p.products_id=0 and";
    }
}

  $ccr = $currencies->currencies[$currency]['value']; // current_currency_rate
$price_filter_statement = '';
$filter_join = '';
// $filer_finish_price need for special product price
$filter_finish_price =
    "CASE
         WHEN s.specials_new_products_price is NULL
             THEN p.$customer_price
         ELSE s.specials_new_products_price
         END";
  // subquery for filtering by price
if (!empty($_GET['rmin']) or !empty($_GET['rmax'])) {
    $_GET['rmin'] = filter_var($_GET['rmin'], FILTER_SANITIZE_NUMBER_FLOAT);
    $_GET['rmax'] = filter_var($_GET['rmax'], FILTER_SANITIZE_NUMBER_FLOAT);
    $rmin = is_numeric($_GET['rmin']) ? floor($_GET['rmin'] / $ccr) : 0;
    $rmax = is_numeric($_GET['rmax']) ? ceil($_GET['rmax'] / $ccr) : 0;

    if (DISPLAY_PRICE_WITH_TAX == 'true') {
        $where_filters .= $price_filter_statement = preparePriceFilterWhereStatement($rmin, $rmax, $filter_finish_price);
    } else {
        $where_filters .= $price_filter_statement = " (($filter_finish_price) between " . $rmin . " and " . $rmax . ") and";
    }
    if (!isset($_GET['type']) || $_GET['type'] != 'specials') {
        $filter_join .= " left join " . TABLE_SPECIALS . " s
                              ON p.products_id = s.products_id and s.status = '1'
                              and (s.start_date <= CURDATE() or s.start_date = '0000-00-00 00:00:00' or s.start_date is NULL)
                              and (s.expires_date >= CURDATE() or s.expires_date = '0000-00-00 00:00:00' or s.expires_date is NULL) ";
        $customers_groups_id = tep_get_customers_groups_id();
        // If there is a group look for discounts also for the group
        if (!empty($customers_groups_id)) {
            $filter_join .= " and ( (s.customers_id = " . (int)$customer_id . " or s.customers_groups_id = " . (int)$customers_groups_id . ")
                                 or (s.customers_id = '0' and s.customers_groups_id = '0') )";
        } else {
            if (!empty($customer_id)) {
                $filter_join .= " and ( (s.customers_id = " . (int)$customer_id . ")
                                or (s.customers_id = '0' and s.customers_groups_id = '0') )";
            }
            $filter_join .= " and s.customers_id = '0' and s.customers_groups_id = '0'";
        }
    }
}
/*
if($_GET['filter_slov']!='') {
  $_GET['filter_slov']=$_GET['filter_slov'];
  $where_filters .= " pd.products_name like '%" . $_GET['filter_slov'] . "%' and";
}   */
// if one-select filter
// if($_GET['filter_id']!='') {
//   $where_filters .= " m.manufacturers_id = '" . (int)$_GET['filter_id'] . "' and";
// }
// if many-selectable filter
$manFilter = '';
if (!empty($_GET['filter_id'])) {
    $manFilter .= "(";
       $mas = explode('-', $_GET['filter_id']);
    foreach ($mas as $v1) {
        $manFilter .= " p.manufacturers_id = " . (int)$v1 . " or";
    }
    $manFilter = substr($manFilter, 0, -2);

    $manFilter .= ") and";
    $where_filters .= $manFilter;
}
