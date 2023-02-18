<?php

// last viewed
if (is_array($_SESSION['visited_products2'])) {
    $visitedProducts = array_filter($_SESSION['visited_products2'], function ($value) {
        return $value != $_GET['products_id'];
    });
    $visitedProducts = array_diff($visitedProducts, array(''));
    $productsList = implode(',', array_reverse($visitedProducts));
    if (is_array($visitedProducts) and !empty($visitedProducts) and !empty($productsList) and !empty($productsList)) {
        $listing_sql = "SELECT DISTINCT p.products_id
                     FROM " . TABLE_PRODUCTS . " p
                LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id
                          " . ($new_products_from ? : '') . "
                    WHERE p2c.categories_id in(" . $all_active_cats . ")
                      AND p.products_id in(" . $productsList . ")
                      AND p.products_status = '1'
                 ORDER BY  " . ($tpl_settings['orderby'] ? : "FIND_IN_SET(p.products_id,'" . $productsList . "')") . "
                           " . ($tpl_settings['limit'] ? 'LIMIT ' . (int)$tpl_settings['limit'] : '');

        $last_viewed_query = tep_get_query_products_info($listing_sql); // split query to 2 small queries: 1) find all products ids, 2) get info for each product

        $last_viewed = tep_db_query($last_viewed_query);
        $salemakers_array = get_salemakers($last_viewed);
        mysqli_data_seek($last_viewed, 0);

        if ($last_viewed->num_rows) {
            $tpl_settings['request'] = $last_viewed;
            if (!checkProductAttributesCache($languages_id, $attrs_array, $r_pid_attr_array, $pid_attr_array, $show_in_product_listing, $attr_names_array,$attr_vals_names_array, $attr_vals_array)) {
                getArrayWithAllAttributes();
            }
            include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL);
        }
    }
}
