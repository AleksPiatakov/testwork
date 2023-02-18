<?php

if (!empty($activeProducts)) {
    $activeProductsStr = implode(',', array_keys($activeProducts));
    $listing_sql = "SELECT p.products_id
                FROM " . TABLE_PRODUCTS . " p      
                LEFT JOIN " . TABLE_SPECIALS . " s 
                ON p.products_id = s.products_id 
                AND s.status = '1' 
                and (s.start_date <= CURDATE() or s.start_date = '0000-00-00 00:00:00' or s.start_date is NULL)                                
                and (s.expires_date >= CURDATE() or s.expires_date = '0000-00-00 00:00:00' or s.expires_date is NULL)";
// If there is a group look for discounts also for the group
    if (!empty($customers_groups_id)) {
        $listing_sql .= " and ( (s.customers_id = '" . $customer_id . "' or s.customers_groups_id = '" . $customers_groups_id . "')
                      or (s.customers_id = '0' and s.customers_groups_id = '0') )";
    } else {
        if (!empty($customer_id)) {
            $listing_sql .= " and ( (s.customers_id = '" . $customer_id . "') 
                          or (s.customers_id = '0' and s.customers_groups_id = '0') )";
        }
        $listing_sql .= " and s.customers_id = '0' and s.customers_groups_id = '0'";
    }
    $listing_sql .= " WHERE p.products_id in(" . $activeProductsStr . ")
                 AND s.status = '1' AND p.products_status = '1' 
                 ORDER BY  " . ($tpl_settings['orderby'] ?: 'p.products_date_added DESC') . " 
                           " . ($tpl_settings['limit'] ? 'LIMIT ' . (int)$tpl_settings['limit'] : '');

    $listing_sql = tep_get_query_products_info($listing_sql); // split query to 2 small queries: 1) find all products ids, 2) get info for each product

    $specials = tep_db_query($listing_sql);
    $salemakers_array = get_salemakers($specials);
    mysqli_data_seek($specials, 0);

    if ($specials->num_rows and $tpl_settings['disable_listing'] != true) {
        $tpl_settings['request'] = $specials;
        if (!checkProductAttributesCache($languages_id, $attrs_array, $r_pid_attr_array, $pid_attr_array, $show_in_product_listing, $attr_names_array,$attr_vals_names_array, $attr_vals_array)) {
            getArrayWithAllAttributes();
        }
        include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL);
    }
}
