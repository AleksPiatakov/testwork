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
            // if checkbox "all" is checked
            if ($_GET['filter_id'] == '') {
                $allchecked = 'checked';
            } else {
                $allchecked = '';
            }

            //manufacturers
            global $manuf_sql, $filterManufacturers, $manufacturersCount;
            $manufacturersFilterHtml = '';
            if ($config['manufacturers']['val'] == 1 && tep_db_num_rows($manuf_sql) && empty($_GET['manufacturers_id'])) {
                unset($tempSeoFilterInfo);

                $allFilterLink = '<span>' . FILTER_ALL . '</span>';

                $manufacturersFilterHtml .= '<li class="dropdown"><a href="#" class="dropdown-toggle dropdownTitle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . FILTER_BRAND . '<span class="caret"></span></a>';
                $manufacturersFilterHtml .= '<ul class="dropdown-menu"><div class="attrib_divs"><div id="ajax_search_brands">';

                $manufacturersFilterHtml .= '<div class="item"><input class="filter_all except_brands" id="brand_all" type="checkbox" ' . $allchecked . ' name="filter_id[]" value="not" /><label for="brand_all">' . $allFilterLink . '</label></div>';

                foreach ($filterManufacturers as $manufacturers_values) {
                    if ((!empty($_GET['filter_id']) && $_GET['filter_id'] == $manufacturers_values['manufacturers_id']) || empty($manufacturers_values['href']) || !empty($_GET['keywords'])) {
                        $manufacturerLink =
                            '<span>' . $manufacturers_values['manufacturers_name'] .
                            ' <span class="qty">' .
                            $manufacturersCount[$manufacturers_values['manufacturers_id']] .
                            '</span>' .
                            '</span>';
                        $disabledInput = empty($manufacturers_values['href']) || !empty($_GET['keywords']) ? '' : ' disabled';
                    } else {
                        $disabledInput = '';
                        $manufacturerLink = $manufacturers_values['manufacturers_name'];
                        if ($manufacturersCount[$manufacturers_values["manufacturers_id"]] !== 0 && $manufacturersCount[$manufacturers_values["manufacturers_id"]] !== '+ 0') {
                            $manufacturerLink .= '<span class="qty">' .
                                $manufacturersCount[$manufacturers_values["manufacturers_id"]] .
                                '</span>';
                        }
                    }
                    $manufacturerExistClass = ($manufacturersCount[$manufacturers_values["manufacturers_id"]] !== 0 && $manufacturersCount[$manufacturers_values["manufacturers_id"]] !== '+ 0')
                        ? '' : ' pointer_events_none';
                    $manufacturersFilterHtml .= '<div class="item' . $manufacturerExistClass . '">';
                    $manufacturersFilterHtml .= '<input class="except_brands" type="checkbox" id="brand_' .
                        $manufacturers_values['manufacturers_id'] . '" name="filter_id[]" ' .
                        $manufacturers_values['check'] .
                        ' value="' . $manufacturers_values['manufacturers_id'] . '" />
                               <label for="brand_' . $manufacturers_values['manufacturers_id'] . '">' . $manufacturerLink . '</label>';
                    $manufacturersFilterHtml .= '</div>';
                }

                $manufacturersFilterHtml .= '</div></ul></li>';
            }

            //attributes filter
            global $attrs_array, $attr_vals_array, $attr_vals_names_array, $attr_names_array, $redirectOptionsIdsArrayForCheck;
            $attributesFilterHtml = '';
            if ($config['attributes']['val'] == 1) {

                if (is_array($attrs_array)) {
                    foreach ($attrs_array as $at_id) {
                        if (is_array($show_in_filter) and in_array($at_id, $show_in_filter)) {
                            $attributesFilterHtml .= '<li class="dropdown"><a href="#" class="dropdown-toggle dropdownTitle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $attr_names_array[$at_id] . '<span class="caret"></span></a>';
                            $attributesFilterHtml .= '<ul class="dropdown-menu"><div class="attrib_divs">';

                            // if checkbox "all" is checked
                            if ($_GET[$at_id] == '') {
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
                                        <label for="filter_all_' . $at_id . '">' . $filterText . '</label>
                                     </div>';

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

                            $attributesFilterHtml .= '</div></ul></li>';
                        }
                    }
                }
            }

            //list sorting
            global $r_sort_array;
            $listSortingHtml = '';
            if ($template->show('LIST_SORTING')) {
                $listSortingHtml .= '
                        <ul class="navbar-right">
                            <li class="dropdown">
                                <b>' . addDoubleDot(SORT_BY) . '</b>' .
                                tep_draw_pull_down_menu('sort', $r_sort_array, $_GET['sort'], 'id="pl_sort"') .
                            '</li>
                        </ul>';
            }

            //collect html
            $filterContentHtml = '<div class="filter_cont" id="attribs"><noindex><div class="filtersMenu">
                <b class="filterTitle">' . PROD_FILTERS . ':</b>
                <ul class="filterRight">' .
                $manufacturersFilterHtml .
                '<div class="filter_cont" id="attribs" ><noindex>' .
                $attributesFilterHtml .
                '<svg class="fa-spin margin-bottom" style="display: none;" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z"></path></svg>
                </ul>' .
                $listSortingHtml .
                '</div></noindex></div>';

            echo $filterContentHtml;
            ?>
        </div>
    </div>
<?php }
?>
