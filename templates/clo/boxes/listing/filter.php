<?php

include(DIR_WS_MODULES . 'filters.php');
if ((!empty($_GET['cPath']) or isset($_GET['manufacturers_id']) or isset($_GET['keywords'])) and ATTRIBUTES_PRODUCTS_MODULE_ENABLED == 'true') {
    if (defined('SEO_FILTER') && constant('SEO_FILTER') == 'true') {
        require(DIR_WS_TEMPLATES . 'clo/boxes/listing/filter_seo.php');
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

                //attributes filter
                global $attrs_array, $attr_vals_names_array, $counts_number;
                $attributesFilterHtml = '';
                if ($config['attributes']['val'] == 1) {

                    if (is_array($attrs_array)) {
                        foreach ($attrs_array as $at_id) {
                            if (is_array($show_in_filter) and in_array($at_id, $show_in_filter)) {
                                //   if(!empty($counts_array_true[$at_id])) {
                                $attributesFilterHtml .= '<li class="dropdown"><a href="#" class="dropdown-toggle dropdownTitle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $attr_names_array[$at_id] . '<span class="caret"></span></a>';
                                $attributesFilterHtml .= '<ul class="dropdown-menu"><div class="attrib_divs">';

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
                                        //}
                                    }
                                }

                                $attributesFilterHtml .= '</div></ul></li>';
                            }
                        }
                    }
                }

                //sort listing
                global $r_sort_array;
                $listSortingHtml = '';
                if ($template->show('LIST_SORTING')) {
                    $sortListingHtml .= '
                            <ul class="navbar-right">
                                <li class="dropdown">
                                    <b>' . addDoubleDot(SORT_BY) . '</b>' .
                                    tep_draw_pull_down_menu('sort', $r_sort_array, $_GET['sort'], 'id="pl_sort"') .
                                '</li>
                            </ul>';
                }

                //collect html
                $filterContentHtml = '<div class="filter_cont" id="attribs" ><noindex><div class="filtersMenu">
                    <b class="filterTitle">' . PROD_FILTERS . ':</b>
                    <ul class="filterRight">' .
                    $attributesFilterHtml .
                    '<svg class="fa-spin margin-bottom" style="display: none;" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z"></path></svg>
 					</ul>' . $sortListingHtml .
                    '</div></noindex></div>';
                $sortListingHtml .
                '</noindex></div>';

                echo $filterContentHtml;
                ?>
            </div>
        </div>
    <?php }
}
?>
