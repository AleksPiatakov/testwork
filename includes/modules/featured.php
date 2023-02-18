<?php

$featuredStr = implode(',', array_keys($activeProducts));
if ($featuredStr) {
    $listing_sql = "SELECT p.products_id
                    FROM " . TABLE_PRODUCTS . " p      
                    left join " . TABLE_FEATURED . " f on p.products_id = f.products_id                                   
                          " . ($new_products_from ?: '') . "
                    WHERE p.products_id in(" . $featuredStr . ")
                        AND p.products_quantity > 0
                        AND p.products_status = '1' 
                        AND f.status = '1' 
                    ORDER BY  " . ($tpl_settings['orderby'] ?: 'p.products_quantity > 0 desc, rand()') . " 
                              " . ($tpl_settings['limit'] ? 'LIMIT ' . (int)$tpl_settings['limit'] : '');

    $featured_products_query = tep_get_query_products_info($listing_sql); // split query to 2 small queries: 1) find all products ids, 2) get info for each product

    $featured = tep_db_query($featured_products_query);
    $salemakers_array = get_salemakers($featured);
    mysqli_data_seek($featured, 0);

    if ($featured->num_rows and $tpl_settings['disable_listing'] != true) {
        $tpl_settings['request'] = $featured;
        if (!checkProductAttributesCache($languages_id, $attrs_array, $r_pid_attr_array, $pid_attr_array, $show_in_product_listing, $attr_names_array,$attr_vals_names_array, $attr_vals_array)) {
            getArrayWithAllAttributes();
        }
        include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL);
    }
}
