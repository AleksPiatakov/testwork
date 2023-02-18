<?php

//$time_start = microtime(true);

global $cat_names, $listing_query, $attrs_array, $current_category_id, $seo_urls, $cart, $spec_array, $r_pid_attr_array;

if (!is_array($tpl_settings)) {
    $tpl_settings = array(
        'request' => $listing_query,
        'id' => 'r_spisok',
        //'classes' => array(),
        //'title' => '',
        //'cols' => array('xs'=>$cols[0],'sm'=>$cols[1],'md'=>$cols[2],'lg'=>$cols[0]),//'cols' => array('xs'=>'2','sm'=>'2','md'=>'3','lg'=>'4'),
        'wishlist' => true,
        'compare' => true
    );
}

//columns data
if (!function_exists('collectCols')) {
    function collectCols($tpl_settings)
    {
        global $template;
        $default_cols = explode(';', $template->getMainconf('MC_PRODUCT_QNT_IN_ROW')); // XS, SM, MD, LG
        $default_cols[4] = is_null($default_cols[4]) ? 6 : $default_cols[4];
        if (!empty($tpl_settings['cols'])) {
            $tpl_cols = explode(';', $tpl_settings['cols']); // XS, SM, MD, LG
            if (count($tpl_cols) > 1) {
                $blocks_num_xs = 12 / ($tpl_cols[0] ?: 12);
                $blocks_num_sm = 12 / ($tpl_cols[1] ?: 12);
                $blocks_num_md = 12 / ($tpl_cols[2] ?: 12);
                $blocks_num_lg = 12 / ($tpl_cols[3] ?: 12);
                $blocks_num_xl = 12 / ($tpl_cols[4] ?: 6);
            } else {
                $blocks_num_xs = $blocks_num_sm = $blocks_num_md = $blocks_num_lg = $blocks_num_xl = $default_cols[2] = 12 / $tpl_settings['cols'];
            }
        } else {
            $blocks_num_xs = 12 / ($default_cols[0] ?: 2);//default value if empty
            $blocks_num_sm = 12 / ($default_cols[1] ?: 3);//default value if empty
            $blocks_num_md = 12 / ($default_cols[2] ?: 4);//default value if empty
            $blocks_num_lg = 12 / ($default_cols[3] ?: 4);//default value if empty
            $blocks_num_xl = 12 / ($default_cols[4] ?: 6);//default value if empty
        }
        $blocks_num_xs = is_float($blocks_num_xs) ? str_replace('.', '-', $blocks_num_xs) : $blocks_num_xs;
        $blocks_num_sm = is_float($blocks_num_sm) ? str_replace('.', '-', $blocks_num_sm) : $blocks_num_sm;
        $blocks_num_md = is_float($blocks_num_md) ? str_replace('.', '-', $blocks_num_md) : $blocks_num_md;
        $blocks_num_lg = is_float($blocks_num_lg) ? str_replace('.', '-', $blocks_num_lg) : $blocks_num_lg;
        $blocks_num_xl = is_float($blocks_num_xl) ? str_replace('.', '-', $blocks_num_xl) : $blocks_num_xl;
        return array('xs' => $blocks_num_xs, 'sm' => $blocks_num_sm, 'md' => $blocks_num_md, 'lg' => $blocks_num_lg, 'xl' => $blocks_num_xl);
    }
}

$cols = collectCols($tpl_settings);

//check exceptions
if ($listing_split->number_of_rows <= 0 && $tpl_settings['id'] == 'r_spisok' && empty($_GET['keywords'])) {
    if (isAjax()) {
        echo json_encode(array());
        die;
    } else {
        echo '';
        return;
    }
}

$vue_array = array();
$categories_id = $current_category_id;
$catalog_path = tep_href_link(FILENAME_DEFAULT);
$block_is_slider = is_array($tpl_settings['classes']) and in_array('product_slider', $tpl_settings['classes']);

//display_style
// $display = PRODUCT_LISTING_DISPLAY_STYLE;
if ($tpl_settings['id'] != 'r_spisok') {
    $display = 'block';
}

if ($display == 'list') {
    // display LIST ------------------------------------------------------
    $pmodel_class = 'l_list';
    $stock_pull = 'pull-left';
//        $compare_class = 'compare_list';
    $listing_layout = file_get_contents(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/listing_list.html');
    $attr_listing = getConstantValue('RTPL_PRODUCTS_ATTR_LISTING_LIST');
    if (is_array($attrs_array) and !isMobile()) {
        $attr_body = getConstantValue('RTPL_PRODUCTS_ATTR_BODY_LIST');
    }
} else {
    // display COLUMNS ------------------------------------------------------
    $pmodel_class = 'p_list_model';
    $stock_pull = 'pull-right';
//        $compare_class = 'compare';
    $listing_layout = file_get_contents(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/listing_columns.html');
    $attr_listing = getConstantValue('RTPL_PRODUCTS_ATTR_LISTING_COL');
    if (is_array($attrs_array) and !isMobile()) {
        $attr_body = getConstantValue('RTPL_PRODUCTS_ATTR_BODY_COL');
    }
}

//listing_header
if (!function_exists('getListingHeader')) {
    function getListingHeader($tpl_settings)
    {
        $listing_header = '';

        if (is_array($tpl_settings['classes'])) {
            $render_class = implode(' ', $tpl_settings['classes']);
        } else {
            $render_class = '';
        }

        if (!empty($tpl_settings['title'])) {
            $listing_header .= '<div class="like_h2">' . $tpl_settings['title'];
            if (!empty($tpl_settings['title_link'])) {
                $listing_header .= '<span class="title-link">' . $tpl_settings['title_link'] . '</span>';
            }
            if (!empty($tpl_settings['description'])) {
                $listing_header .= '<p class="like_p">' . $tpl_settings['description'] . '</p>';
            }
            if (!empty($tpl_settings['additional_title_block'])) {
                $listing_header .= $tpl_settings['additional_title_block'];
            }
            $listing_header .= '</div>';
        }

        // if its slider:
        if (is_array($tpl_settings['classes']) and in_array('product_slider', $tpl_settings['classes'])) {
            $listing_header .= sprintf(getConstantValue('RTPL_LISTING_HEADER_SLIDER', '%s'), $tpl_settings['id'], $render_class);
        } else {
            $listing_header .= sprintf(getConstantValue('RTPL_LISTING_HEADER_NORMAL', '%s'), $render_class, $tpl_settings['id']);
        }
        return $listing_header;
    }
}
$listing_header = getListingHeader($tpl_settings);

//listing_footer
if (!function_exists('getListingFooter')) {
    function getListingFooter($tpl_settings, $listing_split)
    {
        global $row_by_page, $template;
        $listing_footer = '</div>';
        if (is_array($tpl_settings['classes']) and in_array('product_slider', $tpl_settings['classes'])) {
            $listing_footer .= '</div>';
        }

        if ($tpl_settings['id'] == 'r_spisok') {
            if ($listing_split->number_of_rows > $row_by_page) {
                $listing_footer .= sprintf(getConstantValue('RTPL_NUMBER_OF_ROWS', '%s'), $listing_split->number_of_rows);
                if ($template->show('LIST_LOAD_MORE')) {
                    if (
                        file_exists("ext/show_more/init.php") &&
                        $listing_split->current_page_number < $listing_split->number_of_pages
                    ) {
                        $listing_footer .= require_once "ext/show_more/init.php";
                    }
                }
                if ($template->show('LIST_NUMBER_OF_ROWS')) {
                    $listing_footer .= sprintf(
                        getConstantValue('RTPL_PAGES_HTML', '%s'),
                        $listing_split->display_links(10, tep_get_all_get_params(array('page', 'info', 'x', 'y', 'ajaxloading', 'language')))
                    );
                }
            }
        }
        return $listing_footer;
    }
}
$listing_footer = getListingFooter($tpl_settings, $listing_split);

//$redirectOptionsIdsArrayForCheck
if ($tpl_settings['id'] == 'r_spisok') {
    if (defined('SEO_FILTER') && constant('SEO_FILTER') == 'true' && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && empty($_GET['manufacturers_id'])) {
        $isFilter = true;
        if (!isset($redirectOptionsIdsArrayForCheck)) {
            $redirectOptionsIdsArrayForCheck = array_filter(array_keys($_GET), 'is_numeric');
            $redirectOptionsIdsArrayForCheck = array_intersect_key($_GET, array_flip($redirectOptionsIdsArrayForCheck));
        }
    }
}

//wishlist
$wish_enabled = getConstantValue('WISHLIST_MODULE_ENABLED') == 'true';
if (isset($tpl_settings['wishlist']) && $wish_enabled) {
    $wish_enabled = $tpl_settings['wishlist'];
}

//compare
$compare_enabled = getConstantValue('COMPARE_MODULE_ENABLED') == 'true';
if ($compare_enabled) {
    if (isset($tpl_settings['compare'])) {
        $compare_enabled = $tpl_settings['compare'];
    }
    $compare_page_link = tep_href_link('compare.php');
}

// one global array:
$vue_array['globals'] = array(
    'categories_id' => $categories_id,
    'cart_incart_text' => getConstantValue('IMAGE_BUTTON_IN_CART', ''),
    'cart_addto_cart' => getConstantValue('IMAGE_BUTTON_ADDTO_CART', ''),
    'compare_enabled' => $compare_enabled,
    'promUrls' => $promUrls,
    'compare_text_in' => getConstantValue('GO_COMPARE', ''),
    'compare_text' => getConstantValue('COMPARE', ''),
    'wish_enabled' => $wish_enabled,
    'wish_text_in' => getConstantValue('IN_WHISHLIST', ''),
    'wish_text' => getConstantValue('WHISH', ''),
    'product_stock_text_in' => getConstantValue('LIST_TEMP_INSTOCK', ''),
    'product_stock_text' => getConstantValue('LIST_TEMP_OUTSTOCK', ''),
    'display' => $display,
    'pdf_link' => !(isset($content) && $content === '404') ? tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('language')) . 'pdf=true') : '',
    'pmodel_class' => isset($pmodel_class) ? $pmodel_class : '',
    'compare_class' => isset($compare_class) ? $compare_class : '',
    'attr_listing' => $attr_listing,
    'attr_listing_values' => getConstantValue('RTPL_PRODUCTS_ATTR_LISTING_DEFAULT_VALUES'),
    'attr_body' => $attr_body,
    'stock_pull' => isset($stock_pull) ? $stock_pull : '',
    'catalog_path' => $catalog_path,
    'blocks_num' => isset($cols) ? $cols : array(),
    'listing_header' => $listing_header,
    'listing_footer' => $listing_footer,
    'listing_layout' => $listing_layout,
    'img_end' => SMALL_IMAGE_WIDTH . 'x' . SMALL_IMAGE_HEIGHT,
    'img_default' => 'default.png',
    'all_attribs' => $attr_names_array
);

//add_classes
if ($template->getMainconf('MC_THUMB_FIT') != 0) {
    $vue_array['globals']['add_classes'] .= ' object_fit';
}

//modal_button
$vue_array['globals']['modal_button'] = ($template->show("LIST_MODAL_ON") == 'true') ?
    '<svg class="product-modal-button" xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 0 227.406 227.406" width="28px"><path d="M217.576,214.708l-65.188-67.794c16.139-15.55,26.209-37.355,26.209-61.484 c0-47.106-38.323-85.43-85.43-85.43C46.06,0,7.737,38.323,7.737,85.43c0,47.106,38.323,85.43,85.43,85.43 c17.574,0,33.924-5.339,47.52-14.474l66.077,68.719c1.473,1.531,3.439,2.302,5.407,2.302c1.87,0,3.743-0.695,5.197-2.094 C220.354,222.441,220.447,217.693,217.576,214.708z M22.737,85.43c0-38.835,31.595-70.43,70.43-70.43 c38.835,0,70.43,31.595,70.43,70.43s-31.595,70.43-70.43,70.43C54.332,155.859,22.737,124.265,22.737,85.43z"/>
	                 <path d="M131.415,77.93h-30.748V47.182c0-4.143-3.357-7.5-7.5-7.5c-4.143,0-7.5,3.357-7.5,7.5V77.93H54.918 c-4.143,0-7.5,3.357-7.5,7.5s3.357,7.5,7.5,7.5h30.748v30.749c0,4.143,3.357,7.5,7.5,7.5c4.143,0,7.5-3.357,7.5-7.5V92.93h30.748 c4.143,0,7.5-3.357,7.5-7.5S135.557,77.93,131.415,77.93z"/></svg>' : '';


$i = 1;
$productsIds = $productsPrices = [];
while ($listing = tep_db_fetch_array($tpl_settings['request'])) {
    // PRODUCT
    $id = $listing['products_id'];
    $product_name = strip_tags($listing['products_name']);

    if (!empty($listing['products_url'])) {
        $product_href = $listing['products_url']; // if "products_url" is set, show link without DB query to get names
    } else {
        $products_url = $seo_urls->strip($product_name);
        tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_url = '" . $products_url . "' where language_id = '" . $languages_id . "' and products_id = '" . tep_db_input($id) . "'");
        $product_href = $products_url ?: '-'; // if "products_url" empty, then get name from DB
    }
    $product_href = getCPathUrlPart($id) . preg_replace('|' . $catalog_path . '|i', '', $product_href);

    if (!empty($listing['products_image'])) {
        $productsImages = explode(';', $listing['products_image']);
        $product_image = isset($productsImages[0]) ? $productsImages[0] : '';
    } else {
        $product_image = '';
    }

    $product_model = $listing['products_model'];
    $product_stock = $listing['products_quantity'];
    $cart_incart = false;
    foreach (array_keys($cart->contents) as $cart_key) {
        if (strpos($cart_key, $id) === 0) {  // product_id on first position in string cart_key
            $cart_incart = true;
            break;
        }
    }
    // END -- PRODUCT

    // PRICES
    $currencies->taxWrapper = 'span';
    $currencies->enableCurrencies = true;

    $old_price = $currencies->display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id']));
    // PRICES with discounts
    if ($listing['specials_new_products_price']) {
        $spec_price = $listing['specials_new_products_price'];
    } elseif ($salemakers_array[$id]) {
        $spec_price = $salemakers_array[$id];
    } elseif ($spec_array[$id]) {
        $spec_price = $spec_array[$id];
    } else {
        $spec_price = '';
    }

    if ($spec_price) {
        $new_price = $currencies->display_price($spec_price, tep_get_tax_rate($listing['products_tax_class_id']));
    } else {
        $new_price = '';
    }
    // END -- PRICES

    // LABELS
    $labels = [];
    if (getConstantValue('PRODUCT_LABELS_MODULE_ENABLED') == 'true' && $template->show('LIST_LABELS')) {
        $listing['products_special_price'] = $spec_price;
        $labels = getLabels($listing);
    }
    // END -- LABELS

    //compare
    if ($vue_array['globals']['compare_enabled']) {
        $compare_arr = getCompare($id);
        $compare_checked = $compare_arr['checked'];
        $compare_text = $compare_arr['text'];
    }

    //wishlist
    if ($vue_array['globals']['wish_enabled']) {
        $wish_arr = getWishList($id);
        $wish_checked = $wish_arr['checked'];
        $wish_text = $wish_arr['text'];
    }

    // ATTRIBUTES
    $listing_product_attributes = $product_attributes_number = array();
    $attr_limit = 4; // attributes in product hover
    if (is_array($r_pid_attr_array[$id])) {
        foreach ($attrs_array as $at_id) {
            if (!empty($r_pid_attr_array[$id][$at_id]) and $attr_limit != 0 and is_array($show_in_product_listing) and in_array($at_id, $show_in_product_listing)) {
                ksort($r_pid_attr_array[$id][$at_id]);
                $listing_product_attributes[$at_id] = implode(', ', $r_pid_attr_array[$id][$at_id]);
                if (!empty($pid_attr_array[$id][$at_id]) && count($pid_attr_array[$id][$at_id]) > 1) {
                    ksort($pid_attr_array[$id][$at_id]);
                    $product_attributes_number[$at_id] = $pid_attr_array[$id][$at_id];
                }
                $attr_limit--;
            }
        }
    }
    // END -- ATTRIBUTES

    // array for every product:
    $vue_array[$i] = array(
        'p_id' => $id,
        'p_name' => stripslashes(htmlspecialchars($product_name)),
        'p_href' => $product_href,
        'p_img' => $product_image,
        'p_qty' => $product_stock,
        'show_button' => getConstantValue('STOCK_SHOW_BUY_BUTTON'),
        'cat_name' => isset($cat_names[$prodToCat[$id]]) ? stripslashes($cat_names[$prodToCat[$id]]) : '',
        'p_price' => $old_price
    );

    if ($cart_incart) {
        $vue_array[$i]['cart_incart'] = $cart_incart;
    }
    $vue_array[$i]['labels'] = $labels;
    if (!empty($compare_checked)) {
        $vue_array[$i]['compare'] = $compare_checked;
        $vue_array[$i]['compare_link_before'] = '<a href="' . $compare_page_link . '">';
        $vue_array[$i]['compare_link_after'] = '</a>';
    } else {
        $vue_array[$i]['compare_link_before'] = '';
        $vue_array[$i]['compare_link_after'] = '';
    }
    if ($template->getMainconf('MC_SHOW_THUMB2') == 1 && isset($productsImages[1])) {
        $vue_array[$i]['p_img2'] = $productsImages[1];
    }
    if (!empty($wish_checked)) {
        $vue_array[$i]['wish'] = $wish_checked;
    }
    if (!empty($new_price)) {
        $vue_array[$i]['p_specprice'] = $new_price;
    }
    if (!empty($listing['products_info'])) {
        $vue_array[$i]['p_info'] = $listing['products_info'];
    }
    if (isset($listing_product_attributes) && is_array($listing_product_attributes)) {
        $vue_array[$i]['p_attr'] = $listing_product_attributes;
    }
    $vue_array[$i]['has_attributes'] = (
        is_array($r_pid_attr_array[$id]) &&
        count($r_pid_attr_array[$id]) > 0 &&
        count(array_filter($r_pid_attr_array[$id], function ($attrs) {
            return count($attrs) > 1;
        })) > 0
    ) ? 'has_attributes' : '';
    if (is_array($product_attributes_number) and isset($product_attributes_number)) {
        $vue_array[$i]['attr'] = $product_attributes_number;
    }
    $vue_array[$i]['p_model'] = $template->show('LIST_MODEL') ? $product_model : '';
    $productsIds[] = $id;
    $productsPrices[] = $new_price ? (float)preg_replace('/[^0-9,.]/i', '', $new_price) : (float)preg_replace('/[^0-9,.]/i', '', $old_price);
    $i++;
}

// if its ajax-request
if (isAjax() && !isset($_GET['get-module'])) {
    if (getConstantValue('SEO_FILTER') == 'true') {
        ob_start();

        $filesToRequire = [
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/boxes/left/filter_seo.php',
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/boxes/left/filter.php',
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/boxes/listing/filter_seo.php',
            DIR_WS_TEMPLATES . TEMPLATE_NAME . '/boxes/listing/filter.php',
            DIR_WS_TEMPLATES . 'default/boxes/left/filter_seo.php',
        ];

        foreach ($filesToRequire as $fileToRequire) {
            if (file_exists($fileToRequire)) {
                require $fileToRequire;
                break;
            }
        }

        $vue_array['globals']['filtersBlock'] = ob_get_contents();
        $addPage = true;
        unset($tempSeoFilterInfo);
        if ($isFilter && empty($_GET['manufacturers_id']) && empty($_GET['keywords'])) {
            if (empty($_GET['filter_id']) && empty($redirectOptionsIdsArrayForCheck)) {
                $sortParameters = tep_get_all_get_params([
                    'language',
                    'currency',
                    'cPath'
                ]);
                $sortParameters = $sortParameters ? "&" . $sortParameters : "";
                $vue_array['globals']['currentHref'] = HTTP_SERVER .
                    str_replace('//', '/', ('/' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . ($_GET['cPath'] ?: 0) . $sortParameters)));
            } else {
                $vue_array['globals']['currentHref'] = HTTP_SERVER .
                    getFilterUrl(
                        $_GET['cPath'] ?: 0,
                        (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''),
                        $redirectOptionsIdsArrayForCheck
                    );
            }
        } elseif (isset($_GET['cPath'])) {
            $vue_array['globals']['currentHref'] = $isFilter ?: tep_href_link(FILENAME_DEFAULT, 'cPath=' . $_GET['cPath']);
        }
        $addPage = false;

        ob_end_clean();
    }
    echo json_encode($vue_array);
    die;
} else {
    // if it`s usual request
    $output = $vue_array['globals']['listing_header'];

    $productIdPrefix = getConstantValue('SEO_ADD_SLASH_BEFORE_PRODUCT_ID', 'true') == 'true' ? '/p-' : '-p-';
    // show each product
    foreach ($vue_array as $key => $listing) {
        if ($key != 'globals') {
            $id = $listing['p_id'];
            $product_name = $listing['p_name'];
            if ($promUrls) {
                $product_href = $vue_array['globals']['catalog_path'] . 'p' . $id . '-' . $listing['p_href'] . '.html';
            } else {
                $product_href = $vue_array['globals']['catalog_path'] . $listing['p_href'] . $productIdPrefix . $id . '.html';
            }
            $product_image = sprintf(
                getConstantValue('RTPL_PRODUCTS_IMAGE', '%s'),
                $vue_array['globals']['img_end'],
                isset($listing['p_img']) ? $listing['p_img'] : $vue_array['globals']['img_default'],
                $product_name,
                $product_name,
                isset($listing['p_img2']) ? 'data-hover="getimage/' . $vue_array['globals']['img_end'] . '/products/' . $listing['p_img2'] . '"' : ''
            );
            $pmodel = (!empty($listing['p_model']) ? sprintf(getConstantValue('RTPL_PRODUCTS_MODEL', '%s'), $vue_array['globals']['pmodel_class'], $listing['p_model']) : '');
            if ($template->show('LIST_PRESENCE')) {
                $stock = (
                $listing['p_qty'] > 0 ?
                    sprintf(getConstantValue('RTPL_PRODUCTS_STOCK', '%s'), $vue_array['globals']['stock_pull']) :
                    sprintf(getConstantValue('RTPL_PRODUCTS_OUTSTOCK', '%s'), $vue_array['globals']['stock_pull'])
                );
            }
            $label = '';
            if (is_array($listing['labels'])) {
                foreach ($listing['labels'] as $labelData) {
                    $label .= !empty($labelData['name']) ? sprintf(RTPL_LABEL, $labelData['class'], $labelData['name']) : '';
                }
            }
            $add_classes = isset($vue_array['globals']['add_classes']) ? $vue_array['globals']['add_classes'] : '';
            $add_classes = !$block_is_slider ? $add_classes . ' not-slider' : $add_classes;
            if ($listing['p_qty'] <= 0) {
                $add_classes .= ' nostock';
            }

            $spec_price = $listing['p_specprice'];
            $old_price = $listing['p_price'];
            $final_price = !empty($spec_price) ?
                sprintf(getConstantValue('RTPL_PRODUCTS_SPEC_PRICE', '%s'), $spec_price, $old_price) :
                sprintf(getConstantValue('RTPL_PRODUCTS_PRICE', '%s'), $old_price);

            $new_price = sprintf(getConstantValue('RTPL_PRODUCTS_PRICE', '%s'), ($spec_price ?: $old_price)); // separated new price
            $old_price = $spec_price ? sprintf(getConstantValue('RTPL_PRODUCTS_OLD_PRICE', '%s'), $old_price) : ''; // separated old price

            //  $cart_button = tep_draw_hidden_field('cart_quantity', 1) . tep_draw_hidden_field('products_id', $id);

            $has_attributes = $listing['has_attributes'];

            if ($listing['p_qty'] <= 0) {
                if (getConstantValue('STOCK_SHOW_BUY_BUTTON', 'false') == "false") {
                    $cart_button = "";
                } else {
                    $cart_button = $listing['cart_incart'] ? sprintf(getConstantValue('RTPL_CART_BUTTON', '%s'), $id) : sprintf(getConstantValue('RTPL_ADD_TO_CART_BUTTON', '%s'), $id, 1);
                }
            } else {
                $cart_button = $listing['cart_incart'] ? sprintf(getConstantValue('RTPL_CART_BUTTON', '%s'), $id) : sprintf(getConstantValue('RTPL_ADD_TO_CART_BUTTON', '%s'), $id, 1);
            }


            // Compare & Wishlist
            if ($vue_array['globals']['compare_enabled'] == 'true' or $vue_array['globals']['wish_enabled'] == 'true') {
                if ($vue_array['globals']['compare_enabled'] == 'true' and !isMobile()) {
                    $compare_output = sprintf(
                        getConstantValue('RTPL_PRODUCTS_COMPARE', '%s'),
                        $id,
                        $id,
                        $id,
                        $listing['compare'],
                        $listing['compare_link_before'],
                        $id,
                        ($listing['compare'] ? $vue_array['globals']['compare_text_in'] : $vue_array['globals']['compare_text']),
                        $listing['compare_link_after']
                    );
                }
                if ($vue_array['globals']['wish_enabled'] == 'true' and !isMobile()) {
                    $wishlist_output = sprintf(
                        getConstantValue('RTPL_PRODUCTS_WISHLIST', '%s'),
                        $id,
                        $id,
                        $id,
                        $listing['wish'],
                        $id,
                        ($listing['wish'] ?
                            $vue_array['globals']['wish_text_in'] :
                            $vue_array['globals']['wish_text'])
                    );
                }
            }

            $listing_product_attributes = $product_attributes_number = '';
            if (is_array($listing['p_attr']) && !empty($listing['p_attr'])) {
                foreach ($listing['p_attr'] as $ana_name => $ana_vals) {
                    $listing_product_attributes .= sprintf($vue_array['globals']['attr_listing'], $vue_array['globals']['all_attribs'][$ana_name], $ana_vals);
                }
                if (is_array($listing['attr']) && !empty($listing['attr'])) {
                    foreach ($listing['attr'] as $attr_key => $attr_vals) {
                        $product_attributes_number .= sprintf($vue_array['globals']['attr_listing_values'], $attr_key, array_shift($attr_vals));
                    }
                }
                $cart_button .= $product_attributes_number;
                $listing_product_attributes = sprintf($vue_array['globals']['attr_body'], $listing_product_attributes);
            }
            // array to replace variables from html template:
            $array_from_to = array(
                '{{has_attributes}}' => $has_attributes,
                '{{blocks_num_xl}}' => $vue_array['globals']['blocks_num']['xl'],
                '{{blocks_num_lg}}' => $vue_array['globals']['blocks_num']['lg'],
                '{{blocks_num_md}}' => $vue_array['globals']['blocks_num']['md'],
                '{{blocks_num_sm}}' => $vue_array['globals']['blocks_num']['sm'],
                '{{blocks_num_xs}}' => $vue_array['globals']['blocks_num']['xs'],
                '{{product_href}}' => $product_href,
                '{{label}}' => $label,
                '{{product_image}}' => $product_image,
                '{{products_model}}' => $pmodel,
                '{{stock}}' => isset($stock) ? $stock : '',
                '{{final_price}}' => $final_price,
                '{{new_price}}' => $new_price,
                '{{old_price}}' => $old_price,
                '{{category_name}}' => isset($listing['cat_name']) ? $listing['cat_name'] : '',
                '{{product_modal_button}}' => isset($vue_array['globals']['modal_button']) ? $vue_array['globals']['modal_button'] : '',
                '{{id}}' => $id,
                '{{product_name}}' => $product_name,
                '{{product_info}}' => isset($listing['p_info']) ? $listing['p_info'] : '',
                '{{product_attributes}}' => $listing_product_attributes,
                '{{compare_output}}' => isset($compare_output) ? $compare_output : '',
                '{{wishlist_output}}' => isset($wishlist_output) ? $wishlist_output : '',
                '{{cart_button}}' => $cart_button,
                '{{not_available}}' => ($listing['p_qty'] == 0 ? ' not_available' : ''),
                '{{add_classes}}' => $add_classes
            );

            $output .= strtr($vue_array['globals']['listing_layout'], $array_from_to);
            //  $output .= strtr(constant($vue_array['globals']['listing_layout']), $array_from_to);
        }
    }

    $output .= $vue_array['globals']['listing_footer'];
    $output .= '<input type="hidden" class="productsPricesForAnalytics" value="[\'' . implode('\',\'', $productsPrices) . '\']">';
    $output .= '<input type="hidden" class="productsIdsForAnalytics" value="[\'' . implode('\',\'', $productsIds) . '\']">';
    echo $output;
}

