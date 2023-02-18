<?php

if (is_array($all_active_cats = $cat_list[0])) {
    $all_active_cats = implode(',', $all_active_cats);
} else {
    $all_active_cats = 0;
}

   $also_purchased_first_query = "select p.products_id
                                   from " . TABLE_ORDERS_PRODUCTS . " opa, 
                                        " . TABLE_ORDERS_PRODUCTS . " opb, 
                                        " . TABLE_ORDERS . " o, 
                                        " . TABLE_PRODUCTS . " p 
                              left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id  
                              left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id and s.status = '1' 
                                and (start_date <= CURDATE() or start_date = '0000-00-00 00:00:00' or start_date is NULL)
                                and (expires_date >= CURDATE() or expires_date = '0000-00-00 00:00:00' or expires_date is NULL)";
$customers_groups_id = tep_get_customers_groups_id();
   // If there is a group look for discounts also for the group
if (!empty($customers_groups_id)) {
    $also_purchased_first_query .= " and ( (customers_id = '" . $customer_id . "' or customers_groups_id = '" . $customers_groups_id . "')
    or (customers_id = '0' and customers_groups_id = '0') )";
} else {
    if (!empty($customer_id)) {
        $also_purchased_first_query .= " and ( (customers_id = '" . $customer_id . "')
    or (customers_id = '0' and customers_groups_id = '0') )";
    }
    $also_purchased_first_query .= " and customers_id = '0' and customers_groups_id = '0'";
}
$also_purchased_first_query .= " left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id  
                                  where opa.products_id = '" . (int)$_GET['products_id'] . "' 
                                    and opa.orders_id = opb.orders_id 
                                    and opb.products_id != '" . (int)$_GET['products_id'] . "' 
                                    and opb.products_id = p.products_id  
                                    and opb.orders_id = o.orders_id 
                                    and pd.language_id = '" . (int)$languages_id . "' 
                                    and p2c.categories_id in(" . $all_active_cats . ")     
                                    and p.products_status = '1' 
                               group by p.products_id 
                               order by p.products_quantity > 0 desc, o.date_purchased desc 
                                  limit " . MAX_DISPLAY_ALSO_PURCHASED;

  $module_products_first = tep_db_query($also_purchased_first_query);
  $products_id_array = [];
while ($raw_listing = tep_db_fetch_array($module_products_first)) {
    $products_id_array[] = $raw_listing['products_id'];
}

  $module_products_query = tep_get_query_products_info($products_id_array);
  $module_products = tep_db_query($module_products_query);
  $salemakers_array = get_salemakers($module_products);
  mysqli_data_seek($module_products, 0);

if ($module_products->num_rows and $tpl_settings['disable_listing'] != true) {
    $tpl_settings = array(
    'request' => $module_products,
    'id' => 'also_purchased',
    'classes' => array('product_slider'),
    'cols' => '2;3;3;4;',
    'title' => PROD_ALSO,
    );
    include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL);
}
