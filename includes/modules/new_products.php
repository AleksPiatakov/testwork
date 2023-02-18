<?php

if (!empty($activeProducts)) {
    arsort($activeProducts); // sort by date instead of "order by"
    $new_products_array = array_slice($activeProducts, 0, (int)$tpl_settings['limit'] ?: 10, true);
    $new_products_ids_str = implode(',', array_keys($new_products_array));

    $listing_sql = "SELECT p.products_id
                    FROM " . TABLE_PRODUCTS . " p 
                   WHERE p.products_id in(" . $new_products_ids_str . ")
                         AND p.products_quantity > 0
                   ORDER BY FIELD(p.products_id," . $new_products_ids_str . ")";

    $listing_sql = tep_get_query_products_info($listing_sql); // split query to 2 small queries: 1) find all products ids, 2) get info for each product

    $module_products = tep_db_query($listing_sql);
    $salemakers_array = get_salemakers($module_products);
    mysqli_data_seek($module_products, 0);

    if ($module_products->num_rows and $tpl_settings['disable_listing'] != true) {
        $tpl_settings['request'] = $module_products;
        if (!checkProductAttributesCache($languages_id, $attrs_array, $r_pid_attr_array, $pid_attr_array, $show_in_product_listing, $attr_names_array,$attr_vals_names_array, $attr_vals_array)) {
            getArrayWithAllAttributes();
        }
        include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL);
    }
}
