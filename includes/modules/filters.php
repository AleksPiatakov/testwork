<?php

$attr_vals_array = $attributesValuesArray;
$uniqueOptionsArray = implode(',', array_unique($show_options_arr ?: []));

if (!function_exists('getOptionValueData')) {
    function getOptionValueData($at_id, $at_val_id, $at_val_name)
    {
        global $redirectOptionsIdsArrayForCheck,$counts_array_true,$current_category_id,$tempSeoFilterInfo, $attr_hide;
        $attr_hide = $attr_hide ?: [];
        $checked_attr = '';
        $currentOptionVals = $redirectOptionsIdsArrayForCheck;
        $splitAttr = explode('-', $_GET[$at_id]);
        foreach ($splitAttr as $val) {
            if ($at_val_id == $val) {
                // if active products contains current attribute value if (array_uintersect($all_pids, $counts_array[$at_id][$at_val_id],'strcasecmp')) {
                $checked_attr = 'checked';
            }
        }
        if (isset($currentOptionVals[$at_id])) {
            if (($keyToRemove = array_search($at_val_id, $splitAttr)) !== false) {
                unset($splitAttr[$keyToRemove]);
            } else {
                $splitAttr[] = $at_val_id;
            }
            if ($splitAttr) {
                $currentOptionVals[$at_id] = implode('-', $splitAttr);
            } else {
                unset($currentOptionVals[$at_id]);
            }
        } else {
            $currentOptionVals[$at_id] = $at_val_id;
        }
        $currentAttributesList = [];
        foreach ($currentOptionVals as $val) {
            $currentAttributesList = array_merge($currentAttributesList, explode('-', $val));
        }
        // output values of current attribute (option)
        $counts_number = $counts_array_true[$at_id][$at_val_id] ? ' <span class="qty">' . $counts_array_true[$at_id][$at_val_id] . '</span>' : '';
        $counts_number = (!in_array($at_val_id, $attr_hide)) ? $counts_number : '';
        // if attribute selected but don't have products
        if (!$counts_number && $checked_attr) {
            $counts_number = ' <span class="qty">0</span>';
        }
        sort($currentAttributesList);

        if (isCustomSeoUrlExist($current_category_id, $_GET['filter_id'], $currentAttributesList)) {
            unset($tempSeoFilterInfo);
            $filterText = '<a href="' . getFilterUrl($_GET['cPath'], $_GET['filter_id'], $currentOptionVals) . '">' . $at_val_name . $counts_number . '</a>';
        } else {
            $filterText = $at_val_name . $counts_number;
        }
        return [
            'count' => $counts_number,
            'checked' => $checked_attr,
            'text' => $filterText,
        ];
    }
}

$uniqueOptionsString = '';
if (!empty($uniqueOptionsArray)) {
    $uniqueOptionsString = "and pa.options_id in({$uniqueOptionsArray})";
}

$r_content = '';

// show max price (for Price Range Filter):     //  " .$ifs. " deleted from query
if (!empty($pids_price_filter_excluded)) {
    $all_pids_price_excluded = implode(', ', $pids_price_filter_excluded);
    $all_pids_price_excluded = " p.products_id in ($all_pids_price_excluded) ";
}
if (!empty($all_pids_price_excluded)) {
    $filter_join = " left join " . TABLE_SPECIALS . " s 
                              ON p.products_id = s.products_id and s.status = '1' 
                              and (s.start_date <= CURDATE() or s.start_date = '0000-00-00 00:00:00' or s.start_date is NULL)                                
                              and (s.expires_date >= CURDATE() or s.expires_date = '0000-00-00 00:00:00' or s.expires_date is NULL) ";
    $customers_groups_id = tep_get_customers_groups_id();
    // If there is a group look for discounts also for the group
    if (!empty($customers_groups_id)) {
        $filter_join .= " and ( (s.customers_id = '" . $customer_id . "' or s.customers_groups_id = '" . $customers_groups_id . "')
                                 or (s.customers_id = '0' and s.customers_groups_id = '0') )";
    } else {
        if (!empty($customer_id)) {
            $filter_join .= " and ( (s.customers_id = '" . $customer_id . "') 
                                or (s.customers_id = '0' and s.customers_groups_id = '0') )";
        }
        $filter_join .= " and s.customers_id = '0' and s.customers_groups_id = '0'";
    }

    $filter_finish_price =
        "CASE 
         WHEN s.specials_new_products_price is NULL 
             THEN p.$customer_price
         ELSE s.specials_new_products_price
         END";

    if (DISPLAY_PRICE_WITH_TAX == 'true') {
        $listing_sql_max_query = tep_db_query("
            select MAX(($filter_finish_price) * ((100 + if(`p`.`products_tax_class_id` != 0,`tr`.`tax_rate`,0)) / 100)) AS `max_price`, MIN(($filter_finish_price) * ((100 + if(`p`.`products_tax_class_id` != 0,`tr`.`tax_rate`,0)) / 100)) AS `min_price` 
            from " . TABLE_PRODUCTS . " p 
            $filter_join
            LEFT JOIN " . TABLE_TAX_RATES . " tr on p.products_tax_class_id = tr.tax_class_id 
            where " . $all_pids_price_excluded . " ");
    } else {
        $listing_sql_max_query = tep_db_query("select MAX($filter_finish_price) as max_price, MIN($filter_finish_price) as min_price from " . TABLE_PRODUCTS . " p $filter_join where " . $all_pids_price_excluded . " ");
    }

    $listing_sql_max = tep_db_fetch_array($listing_sql_max_query);
    $listing_sql_max['max_price'] = ceil($ccr * $listing_sql_max['max_price']);  // with current_currency_rate
    $listing_sql_max['min_price'] = floor($ccr * $listing_sql_max['min_price']);  // with current_currency_rate
}
$rmin = (!empty($_GET['rmin']) ? $_GET['rmin'] : $listing_sql_max['min_price'] + 0);
$rmax = (!empty($_GET['rmax']) ? $_GET['rmax'] : $listing_sql_max['max_price'] + 0);
$price_fltr = ($currencies->currencies[$currency]['symbol_left'] ? $currencies->currencies[$currency]['symbol_left'] : $currencies->currencies[$currency]['symbol_right']);

$filterManufacturers = [];
$filterManCount = [];
$productsToCurrentCatAsKey = array_flip($productsToCurrentCat ?: []);
foreach ($manufacturersToProductsId as $id => $arr) {
    $second = array_flip($arr ?: []);
    $x = array_intersect_key($productsToCurrentCatAsKey, $second);
    $filterManCount[$id] = count($x ?: []);
}
$manufacturersCount = [];
$canCountProducts = [];
$manActiveProducts = [];
// for template cellphones, all_pids incorrect
$manufacturersAllPids = $manufacturersAllPids ?: $all_pids;
$counts_may_be = $counts_may_be ?: [];
foreach ($counts_may_be as $canCount) {
    foreach ($canCount as $productId) {
        $canCountProducts[] = $productId;
    }
}
$pids_filter_excluded = $pids_filter_excluded ?: [0];
foreach ($allProductsInActiveCategories as $manufacturerProductId) {
    if (isset($manufacturers_array[$productsIdToManufacturers[$manufacturerProductId]]) && in_array($manufacturerProductId, $pids_filter_excluded)) {
        $manufacturers_values['manufacturers_id'] = $productsIdToManufacturers[$manufacturerProductId];
        $manufacturers_values['products_id'] = $manufacturerProductId;
        $manufacturers_values['manufacturers_name'] = $manufacturers_array[$manufacturers_values['manufacturers_id']]['name'];
        if (in_array($manufacturerProductId, $pids_price_filter_excluded)) {
            $manufacturersCount[$manufacturers_values['manufacturers_id']][$manufacturerProductId] = $manufacturerProductId;
        }
        $manufacturers_values['check'] = '';
        if (!empty($_GET['filter_id'])) {
            $selectedBrands = explode('-', $_GET['filter_id']);
            if (in_array($manufacturers_values['manufacturers_id'], $selectedBrands) && isset($manufacturersCount[$manufacturers_values['manufacturers_id']])) {
                $manufacturers_values['check'] = 'checked';
            }
        }
        if ($manufacturers_values['check']) {
            $manActiveProducts = array_merge($manActiveProducts, $manufacturersCount[$manufacturers_values['manufacturers_id']]);
        }
        $manufacturers_values['href'] = getFilterUrl($_GET['cPath'], $manufacturers_values['manufacturers_id'], []);
        $manCount = $filterManCount[$manufacturers_values['manufacturers_id']];
        $manCount = $manCount ? " <span class='qty'>" . $manCount . "</span>" : '';
        if ($manCount) {
            $manufacturers_values['count'] = $manCount;
            $filterManufacturers[$manufacturers_values['manufacturers_id']] = $manufacturers_values;
        }
        unset($manufacturers_values);
    }
}
$filterManufacturersCheck = $filterManufacturers;
usort($filterManufacturers, function($a,$b){
    return strcmp ($a['manufacturers_name'], $b['manufacturers_name']);
});

$manActiveProducts = array_unique($manActiveProducts);

if ($canCountProducts) {
    $manActiveProducts = array_filter($manActiveProducts, function ($var) {
        global $canCountProducts;
        return in_array($var, $canCountProducts);
    });
}

foreach ($manufacturersCount as $manfId => $manfVal) {
    if ($canCountProducts) {
        $manufacturersCount[$manfId] = array_filter($manfVal, function ($var) {
            global $canCountProducts;
            return in_array($var, $canCountProducts);
        });
    }
    if ($filterManufacturersCheck[$manfId]['check']) {
        $manufacturersCount[$manfId] = count($manActiveProducts);
    } else {
        $manufacturersCount[$manfId] = array_diff($manufacturersCount[$manfId], $manActiveProducts);
        if (!empty($_GET['filter_id'])) {
            $manufacturersCount[$manfId] = '+ ' . count($manufacturersCount[$manfId]);
        } else {
            $manufacturersCount[$manfId] = count($manufacturersCount[$manfId]);
        }
    }
}

//отсеиваем фильтры с одним значением
if (is_array($attr_vals_array)) {
    $attr_vals_array_r = array_filter($attr_vals_array, function ($attributeValues) {
        return is_array($attributeValues);
    });
}
