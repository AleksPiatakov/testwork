<?php

if (!empty($activeProductsXsellProductsBuynow)) {
    $currenModuleSettings = [
        'id' => 'xsell',
        'classes' => ['product_slider'],
        'cols' => '1;2;4;4',
    ];
    if (in_array('product_slider', $currenModuleSettings['classes'])) {
        $assets -> jsProductInline[] = generateOwlCarousel($currenModuleSettings);
    }
    if ($_GET['products_id']) {
        
        $activeProductsStr = implode(',', array_keys($activeProductsXsellProductsBuynow));
        if (is_array($all_active_cats = $cat_list[0])) {
            $all_active_cats = implode(',', $all_active_cats);
            if (empty($all_active_cats)) {
                $all_active_cats = 0;
            }
        }else {
            $all_active_cats = 0;
        }
        
        $xsell_query = "select distinct xp.discount, p.products_id
                    from " . TABLE_PRODUCTS_XSELL . " xp," . TABLE_PRODUCTS . " p
                    WHERE p.products_id in(" . $activeProductsStr . ")
                      AND xp.products_id = " . (int)$_GET['products_id'] . "
                      AND p.products_status = '1'
                      and xp.xsell_id = p.products_id
                 ORDER BY  " . ($tpl_settings['orderby'] ?: 'p.products_quantity > 0 desc, xp.sort_order asc') . "
                    limit " . (defined('MAX_DISPLAY_ALSO_PURCHASED') ? MAX_DISPLAY_ALSO_PURCHASED : 10);
        $module_products_query = tep_get_query_products_info($xsell_query);
        $module_products = tep_db_query($module_products_query);
        $salemakers_array = get_salemakers($module_products);
        mysqli_data_seek($module_products, 0);
        
        if ($module_products -> num_rows and $tpl_settings['disable_listing'] != true) {
            $tpl_settings = $currenModuleSettings;
            $tpl_settings['request'] = $module_products;
            $tpl_settings['title'] = PROD_XSELL_TITLE;
            
            include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL);
        }
    }
}
