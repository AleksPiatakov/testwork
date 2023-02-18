<?php

$most_viewed_str = implode(',', array_keys($activeProducts));

if ($most_viewed_str) {
    $most_viewed_sql = "SELECT p.products_id
                        FROM " . TABLE_PRODUCTS . " p,
                             " . TABLE_PRODUCTS_DESCRIPTION . " pd 
                       WHERE pd.products_id in(" . $most_viewed_str . ")
                         AND pd.products_viewed > 0
                         AND p.products_id = pd.products_id
                         AND p.products_quantity > 0
                         AND pd.language_id = '" . (int)$languages_id . "'
                    ORDER BY pd.products_viewed DESC
                       " . ($tpl_settings['limit'] ? 'LIMIT ' . (int)$tpl_settings['limit'] : '');

    $most_viewed_query = tep_get_query_products_info($most_viewed_sql); // split query to 2 small queries: 1) find all products ids, 2) get info for each product

    $most_viewed = tep_db_query($most_viewed_query);
    $salemakers_array = get_salemakers($most_viewed);
    mysqli_data_seek($most_viewed, 0);

    if ($most_viewed->num_rows) {
        $tpl_settings['request'] = $most_viewed;
        if (!checkProductAttributesCache($languages_id, $attrs_array, $r_pid_attr_array, $pid_attr_array, $show_in_product_listing, $attr_names_array,$attr_vals_names_array, $attr_vals_array)) {
            getArrayWithAllAttributes();
        }
        include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL);
    }
}
