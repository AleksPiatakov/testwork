<?php

include(DIR_WS_MODULES . 'filters.php');
global $all_pids_string;
if (!isset($config)) {
    $config = $template->checkConfig('LEFT', 'L_FILTER');
}
if ((!empty($_GET['cPath']) or isset($_GET['manufacturers_id']) or isset($_GET['keywords'])) and ATTRIBUTES_PRODUCTS_MODULE_ENABLED == 'true' && is_array($config) && in_array(1, array_column($config, 'val')) && $all_pids_string) { ?>
    <div id="filters_box" class="box filter_box">
        <div class="filter_box_in">
            <?php
            //if checkbox "all" is checked
            if (empty($_GET['filter_id'])) {
                $allchecked = 'checked';
            } else {
                $allchecked = '';
            }

            //price range filter
            global $rmin, $rmax, $price_fltr, $listing_sql_max;
            $priceRangeFilterHtml = '';
            if ($config['price_range']['val'] == 1 && $rmin != $rmax) {
                $priceRangeFilterHtml .= '<div class="dipcen">
                         <div><span class="filter_heading">' . COMP_PROD_PRICE . '</span></div>
                         <div id="slider-range"></div>
                         <span class="left slider-from">
                           <input type="number" min="0" class="input-type-number-custom" name="rmin" id="range1" value="' . $rmin . '"  />
                         </span>
                         <span class="left slider-to">                                                                                                             
                           <input type="number" min="0" class="input-type-number-custom" name="rmax" id="range2" value="' . $rmax . '" />
                         </span>
                         &nbsp;&nbsp;<span class="price_fltr">' . $price_fltr . '</span>
                       </div>';

                // show max price value for js:
                $slider_max = isset($_GET['rmax_current']) ? (int)$_GET['rmax_current'] : (int)$listing_sql_max['max_price'];
                $slider_min = isset($_GET['rmin_current']) ? (int)$_GET['rmin_current'] : (int)$listing_sql_max['min_price'];
                $priceRangeFilterHtml .= '<input type="hidden" name="slider_max" value="' . $slider_max . '" />';
                $priceRangeFilterHtml .= '<input type="hidden" name="slider_min" value="' . $slider_min . '" />';
                $priceRangeFilterHtml .= '<div class="clear"></div>';
            }

            //manufacturers
            global $manuf_sql, $filterManufacturers, $manufacturersCount;
            $manufacturersFilterHtml = '';
            if ($config['manufacturers']['val'] == 1 && !empty($filterManufacturers) && empty($_GET['manufacturers_id'])) {
                unset($tempSeoFilterInfo);

                $allFilterLink = '<span>' . FILTER_ALL . '</span>';
                $manufacturersFilterHtml .= '<div class="attrib_divs ajax">
                          <div id="ajax_search_brands" class="block">
                            <div class="filter_heading">' . FILTER_BRAND . '</div>
                              <div class="inner-scroll">
                                <div class="item">
                                  <input class="filter_all" type="checkbox" id="brand_all" ' . $allchecked . ' name="filter_id[]" value="not" />
                                  <label for="brand_all">' . $allFilterLink . '</label>
                                </div>';


                foreach ($filterManufacturers as $manufacturers_values) {
                    if ((!empty($_GET['filter_id']) && $_GET['filter_id'] == $manufacturers_values['manufacturers_id']) || empty($manufacturers_values['href']) || !empty($_GET['keywords'])) {
                        $manufacturerLink =
                            '<span>' . $manufacturers_values['manufacturers_name'] .
                            '<span class="qty">' .
                            $manufacturersCount[$manufacturers_values['manufacturers_id']] .
                            '</span>' .
                            '</span>';
                    } else {
                        $manufacturerLink = $manufacturers_values['manufacturers_name'];
                        if ($manufacturersCount[$manufacturers_values["manufacturers_id"]] !== 0 && $manufacturersCount[$manufacturers_values["manufacturers_id"]] !== '+ 0') {
                            $manufacturerLink .= '<span class="qty">' .
                                $manufacturersCount[$manufacturers_values["manufacturers_id"]] .
                                '</span>';
                        }
                    }
                    $manufacturerExistClass = (isset($manufacturersCount[$manufacturers_values["manufacturers_id"]]) && $manufacturersCount[$manufacturers_values["manufacturers_id"]] !== 0 && $manufacturersCount[$manufacturers_values["manufacturers_id"]] !== '+ 0')
                        ? '' : ' pointer_events_none';
                    $manufacturersFilterHtml .= '<div class="item' . $manufacturerExistClass . '">';
                    $manufacturersFilterHtml .= '<input type="checkbox" id="brand_' .
                        $manufacturers_values['manufacturers_id'] . '" name="filter_id[]" ' .
                        $manufacturers_values['check'] .
                        ' value="' . $manufacturers_values['manufacturers_id'] . '"/>
                               <label for="brand_' . $manufacturers_values['manufacturers_id'] . '">' . $manufacturerLink . '</label>';
                    $manufacturersFilterHtml .= '</div>';
                }

                $manufacturersFilterHtml .= '</div></div></div>';
            }

            //attributes filter
            global $attrs_array, $attr_vals_array, $attr_vals_names_array, $attr_names_array, $redirectOptionsIdsArrayForCheck;
            $attributesFilterHtml = '';
            if ($config['attributes']['val'] == 1) {

                if (is_array($attrs_array)) {
                    foreach ($attrs_array as $at_id) {
                        if (is_array($show_in_filter) and in_array($at_id, $show_in_filter)) {
                            $attributesFilterHtml .= '<span class="filter_heading">' . $attr_names_array[$at_id] . '</span>';
                            $attributesFilterHtml .= '<div class="attrib_divs">';

                            // if checkbox "all" is checked
                            if (empty($_GET[$at_id])) {
                                $allchecked = 'checked';
                            } else {
                                $allchecked = '';
                            }

                            $allOptionsVal = $redirectOptionsIdsArrayForCheck;
                            if (isset($allOptionsVal[$at_id])) {
                                unset($allOptionsVal[$at_id]);
                            }
                            $filterText = FILTER_ALL;
                            // output checkbox "all"
                            $attributesFilterHtml .= '<div class="item"><input class="filter_all" id="filter_all_' . $at_id . '" type="checkbox" ' . $allchecked . ' name="' . $at_id . '" value="not" />
                            <label for="filter_all_' . $at_id . '">
                                    ' . $filterText . '
                            </label></div>';
                            // get all values for current option (attribute)
                            if (is_array($attr_vals_array[$at_id])) {
                                foreach ($attr_vals_array[$at_id] as $at_val_id => $at_val_name) {
                                    // check if current attribute value is checked
                                    $optionValueData = getOptionValueData($at_id, $at_val_id, $at_val_name);
                                    $attributesFilterHtml .= '<div class="item' . ($optionValueData['count'] || $optionValueData['checked'] ? '' : ' pointer_events_none') . '">
                                     <input id="' . $at_val_id . '2" type="checkbox" name="' . $at_id . '" ' . $optionValueData['checked'] . ' value="' . $at_val_id . '" />
                                     <label for="' . $at_val_id . '2">' . $optionValueData['text'] . '</label>                                    
                                   </div>';
                                }
                            }

                            $attributesFilterHtml .= '</div>';
                        }
                    }
                }
            }

            // nofollow link
            $specificUrls = [
                '/new.html',
                '/specials.html',
                '/featured.html'
            ];
            $specificUrlTrue = false;
            foreach ($specificUrls as $specificUrl) {
                if (strpos($_SERVER["REQUEST_URI"], $specificUrl) !== false) {
                    $specificUrlTrue = true;
                    break;
                }
            }
            if ($specificUrlTrue) {
                $nofollowLink .= '<a rel="nofollow" class="filter_heading" href="' . $_SERVER["REQUEST_URI"] . '">' . RESET_OPTIONS . '</a>';
            } else {
                $href = $_GET['manufacturers_id'] ?
                    tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $_GET['manufacturers_id'], 'NONSSL') :
                    getFilterUrl($_GET['cPath'] ?: 0);
                $nofollowLink .= '<a rel="nofollow" class="filter_heading" href="' . $href . '">' . RESET_OPTIONS . '</a>';
            }

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
    <?php
}
?>
