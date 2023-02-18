<?php

$best_sellers_str = implode(',', array_keys($activeProducts));
if ($best_sellers_str) {
    $best_sellers_sql = "SELECT p.products_id
                    FROM " . TABLE_PRODUCTS . " p 
                   WHERE p.products_id in(" . $best_sellers_str . ")
                     AND p.products_ordered > 0
                     AND p.products_quantity > 0
                   ORDER BY p.products_ordered DESC
                   " . ($tpl_settings['limit'] ? 'LIMIT ' . (int)$tpl_settings['limit'] : '');

    $listing_sql = tep_get_query_products_info($best_sellers_sql); // split query to 2 small queries: 1) find all products ids, 2) get info for each product
    $best_sellers = tep_db_query($listing_sql);
    $salemakers_array = get_salemakers($best_sellers);
    mysqli_data_seek($best_sellers, 0);

    if ($best_sellers->num_rows and $tpl_settings['disable_listing'] != true) {
        $tpl_settings['request'] = $best_sellers;
        if (!checkProductAttributesCache($languages_id, $attrs_array, $r_pid_attr_array, $pid_attr_array, $show_in_product_listing, $attr_names_array,$attr_vals_names_array, $attr_vals_array)) {
            getArrayWithAllAttributes();
        }
        include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL);
    }
}
