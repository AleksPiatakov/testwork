<?php
$currenModuleSettings = [
    'id' => 'drugie',
    'classes' => ['product_slider'],
    'cols' => '2;3;3;4;6;'
];
if (in_array('product_slider', $currenModuleSettings['classes'])) {
    $assets->jsProductInline[] = generateOwlCarousel($currenModuleSettings);
}
$listing_sql = "SELECT p.products_id
                     FROM " . TABLE_PRODUCTS . " p
                LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id
                    WHERE p.products_status = '1'
                      AND p.products_id != " . (int)$_GET['products_id'] . "
                      AND p2c.categories_id = '" . (int)$current_category_id . "'
                 ORDER BY  " . ($tpl_settings['orderby'] ?: 'p.products_quantity > 0 desc, p.products_sort_order') . "
                           " . 'LIMIT ' . ($tpl_settings['limit'] ? (int)$tpl_settings['limit'] : 10);

$drugie_query = tep_get_query_products_info($listing_sql); // split query to 2 small queries: 1) find all products ids, 2) get info for each product

$drugie = tep_db_query($drugie_query);
if (!empty($drugie)) {
    $salemakers_array = get_salemakers($drugie);
    mysqli_data_seek($drugie, 0);
    
    if ($drugie->num_rows) {
        $tpl_settings = $currenModuleSettings;
        $tpl_settings['request'] = $drugie;
        $tpl_settings['title'] = PROD_DRUGIE;
        
        include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL);
    }
}
