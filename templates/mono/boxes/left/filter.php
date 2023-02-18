<?php

if ((!empty($_GET['cPath']) or isset($_GET['manufacturers_id']) or isset($_GET['keywords'])) and ATTRIBUTES_PRODUCTS_MODULE_ENABLED == 'true') {
    if (defined('SEO_FILTER') && constant('SEO_FILTER') == 'true') {
        require(DIR_WS_TEMPLATES . 'mono/boxes/left/filter_seo.php');
    } else {
        global $currency;
        if (!isset($config)) {
            $config = $template->checkConfig('LEFT', 'L_FILTER');
        } ?>
        <div id="filters_box" class="box filter_box">
            <div class="filter_box_in">
                <?php
                // if checkbox "all" is checked
                if ($_GET['filter_id'] == '') {
                    $allchecked = 'checked';
                } else {
                    $allchecked = '';
                }

                //price range filter
                global $all_pids_string;
                $priceRangeFilterHtml = '';
                if ($config['price_range']['val'] == 1) {
                    // show max price (for Price Range Filter):     //  " .$ifs. " deleted from query
                    if (!empty($all_pids_string)) {
                        if (DISPLAY_PRICE_WITH_TAX == 'true') {
                            $listing_sql_max_query = tep_db_query(
                                "select MAX(`p`.`products_price` * ((100 + if(`p`.`products_tax_class_id` != 0,`tr`.`tax_rate`,0)) / 100)) AS `max_price`, MIN(`p`.`products_price` * ((100 + if(`p`.`products_tax_class_id` != 0,`tr`.`tax_rate`,0)) / 100)) AS `min_price` from " . TABLE_PRODUCTS . " p LEFT JOIN " . TABLE_TAX_RATES . " tr on p.products_tax_class_id = tr.tax_class_id where " . $all_pids_string . " "
                            );
                        } else {
                            $listing_sql_max_query = tep_db_query(
                                "select MAX(p.products_price) as max_price, MIN(p.products_price) as min_price from " . TABLE_PRODUCTS . " p where " . $all_pids_string . " "
                            );
                        }

                        $listing_sql_max = tep_db_fetch_array($listing_sql_max_query);
                        $listing_sql_max['max_price'] = ceil(
                            $ccr * $listing_sql_max['max_price']
                        );  // with current_currency_rate
                        $listing_sql_max['min_price'] = floor(
                            $ccr * $listing_sql_max['min_price']
                        );  // with current_currency_rate
                    }

                    // Price Range Filter:
                    $priceRangeFilterHtml .= '<div class="dipcen">
                         <div><span class="filter_heading">' . COMP_PROD_PRICE . '</span></div>
                         <div id="slider-range"></div>
                         <span class="left slider-from">
                           <input type="number" min="0" class="input-type-number-custom" name="rmin" id="range1" value="' . (!empty($_GET['rmin']) ? $_GET['rmin'] : $listing_sql_max['min_price'] + 0) . '"  />
                         </span>
                         <span class="left slider-to">                                                                                                             
                           <input type="number" min="0" class="input-type-number-custom" name="rmax" id="range2" value="' . (!empty($_GET['rmax']) ? $_GET['rmax'] : $listing_sql_max['max_price'] + 0) . '" />
                         </span>
                         &nbsp;&nbsp;<span class="price_fltr">' . ($currencies->currencies[$currency]['symbol_left'] ? $currencies->currencies[$currency]['symbol_left'] : $currencies->currencies[$currency]['symbol_right']) . '</span>
                       </div>';

                    // show max price value for js:
                    $priceRangeFilterHtml .= '<input type="hidden" name="slider_max" value="' . ($listing_sql_max['max_price'] + 0) . '" />';
                    $priceRangeFilterHtml .= '<input type="hidden" name="slider_min" value="' . ($listing_sql_max['min_price'] + 0) . '" />';
                    $priceRangeFilterHtml .= '<div class="clear"></div>';
                }

                //manufacturers
                global $all_pids;
                $manufacturersFilterHtml = '';
                // Show manufacturers of current category
                $all_pids_string = '';
                if (is_array($all_pids)) {
                    if (is_string($all_pids_string) && !empty(trim($all_pids_string))) {
                        $all_pids_string = " and " . $all_pids_string;
                    }
                }

                $manuf_sql = tep_db_query(
                    "select distinct mi.manufacturers_id, mi.manufacturers_name 
                     from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS_INFO . " mi on p.manufacturers_id = mi.manufacturers_id 
                where mi.manufacturers_name !='' " . $all_pids_string . " and mi.languages_id = $languages_id order by mi.manufacturers_name"
                );

                if ($config['manufacturers']['val'] == 1 && tep_db_num_rows($manuf_sql)) {
                    $manufacturersFilterHtml .= '<div class="attrib_divs ajax">
                          <div id="ajax_search_brands" class="block">
                            <div class="filter_heading">' . FILTER_BRAND . '</div>
                              <div class="inner-scroll">
                                <div class="item">
                                  <input class="filter_all" type="checkbox" id="brand_all" ' . $allchecked . ' name="filter_id[]" value="not" />
                                  <label for="brand_all">' . FILTER_ALL . '</label>
                                </div>';

                    while ($manufacturers_values = tep_db_fetch_array($manuf_sql)) {
                        // check if current manufacturer value is checked
                        $checked_manuf = '';
                        foreach (explode('-', $_GET['filter_id']) as $val) {
                            if ($manufacturers_values['manufacturers_id'] == $val) {
                                $checked_manuf = 'checked';
                            }
                        }


                        $manufacturersFilterHtml .= '<div class="item">';
                        $manufacturersFilterHtml .= '<input type="checkbox" id="brand_' . $manufacturers_values['manufacturers_id'] . '" name="filter_id[]" ' . $checked_manuf . ' value="' . $manufacturers_values['manufacturers_id'] . '" />
                                   <label for="brand_' . $manufacturers_values['manufacturers_id'] . '">' . $manufacturers_values['manufacturers_name'] . '</label>';
                        $manufacturersFilterHtml .= '</div>';
                    }

                    $manufacturersFilterHtml .= '</div></div></div>';
                }

                //attributes filter
                global $attrs_array, $attr_vals_names_array, $counts_number;
                $attributesFilterHtml = '';
                if ($config['attributes']['val'] == 1) {

                    if (is_array($attrs_array)) {
                        foreach ($attrs_array as $at_id) {
                            if (is_array($show_in_filter) and in_array($at_id, $show_in_filter)) {
                                //   if(!empty($counts_array_true[$at_id])) {
                                $attributesFilterHtml .= '<span class="filter_heading">' . $attr_names_array[$at_id] . '</span>';
                                $attributesFilterHtml .= '<div class="attrib_divs">';

                                // if checkbox "all" is checked
                                if ($_GET[$at_id] == '') {
                                    $allchecked = 'checked';
                                } else {
                                    $allchecked = '';
                                }

                                // output checkbox "all"
                                $attributesFilterHtml .= '<div class="item"><input class="filter_all" id="filter_all_' . $at_id . '" type="checkbox" ' . $allchecked . ' name="' . $at_id . '" value="not" /><label for="filter_all_' . $at_id . '">' . FILTER_ALL . '</label></div>';

                                // get all values for current option (attribute)
                                if (is_array($attr_vals_array[$at_id])) {
                                    foreach ($attr_vals_array[$at_id] as $at_val_id => $at_val_name) {
                                        // check if current attribute value is checked
                                        $checked_attr = '';
                                        foreach (explode('-', $_GET[$at_id]) as $val) {
                                            if ($at_val_id == $val) {
                                                $checked_attr = 'checked';
                                            }
                                        }

                                        // output values of current attribute (option)
                                        //$counts_number = ' ('.$counts_array_true[$at_id][$at_val_id].')';
                                        //if($counts_array_true[$at_id][$at_val_id]!=0) {
                                        $attributesFilterHtml .= '<div class="item">
                                     <input id="' . $at_val_id . '2" type="checkbox" name="' . $at_id . '" ' . $checked_attr . ' value="' . $at_val_id . '" />
                                     <label for="' . $at_val_id . '2">' . $at_val_name . $counts_number . '</label>
                                   </div>';
                                    }
                                }

                                $attributesFilterHtml .= '</div>';
                            }
                        }
                    }
                }

                // nofollow link
                $nofollowLink = '<a rel="nofollow" class="filter_heading" href="' . getFilterUrl($_GET['cPath']) . '">' . RESET_OPTIONS . '</a>';

                //collect html
                $filterContentHtml = $priceRangeFilterHtml .
                    $manufacturersFilterHtml .
                    '<div class="filter_cont" id="attribs" ><noindex>' .
                    $attributesFilterHtml .
                    $nofollowLink .
                    '</noindex></div>';

                echo $filterContentHtml;
                ?>
            </div>
        </div>
    <?php }
}
?>
