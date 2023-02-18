<?php

require('includes/application_top.php');

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_INFO);
// define current template constants:
$productAvailable = false;
$product_info_query = tep_db_query("
    select p.lable_3, p.products_free_ship, p.lable_2, p.lable_1, p.products_id, pd.products_name, pd.products_viewed, 
           pd.products_description, p.products_model, p.products_quantity, pd.products_info, p.products_image, (SELECT GROUP_CONCAT(ptc.categories_id) FROM  products_to_categories ptc WHERE ptc.products_id = " . (int)$_GET['products_id'] . ") as categories_ids,
           pd.products_url, CASE WHEN p.".$customer_price." IS NULL THEN p.products_price ELSE p.".$customer_price." END as products_price, p.products_tax_class_id, p.products_date_added,
           p.products_date_available, p.manufacturers_id, p.products_status, p.is_download_product
    from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd 
    left join " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc on ptc.products_id = " . (int)$_GET['products_id'] . "
    left join " . TABLE_CATEGORIES . " c on c.categories_id = ptc.categories_id
    where p.products_status = '1' and c.categories_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and 
          pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
if (tep_db_num_rows($product_info_query)) {
    $product_info = tep_db_fetch_array($product_info_query);
    $ress = getAllTree();
    $productCategoriesIds = explode(',', $product_info['categories_ids']);
    foreach ($productCategoriesIds as $categoryId){
        $pCategories = null;
        tep_get_parent_categories($pCategories, $categoryId, $ress);
        $productAvailable = is_null($pCategories) ? true : checkIsCategoriesActive($pCategories, $cPathTree);
        if($productAvailable){
            break;
        }
    }
}
if($productAvailable) {
    if ($product_info['products_status'] && getConstantValue('QTY_PRO_ENABLED') == 'true') {
        $products_stocks_query = tep_db_query("SELECT ps.products_stock_attributes as attr, ps.products_vendor_code, ps.products_stock_quantity, ps.products_combination_price, s.specials_new_products_price as special_price
                       FROM " . TABLE_PRODUCTS_STOCK . " ps
                       LEFT JOIN " . TABLE_SPECIALS . " s on s.products_id = ps.products_id and (s.attribute_combination = ps.products_stock_attributes or s.attribute_combination ='all') and status = '1'
                            and (start_date <= CURDATE() or start_date = '0000-00-00 00:00:00' or start_date is NULL)
                            and (expires_date >= CURDATE() or expires_date = '0000-00-00 00:00:00' or expires_date is NULL)
                       WHERE ps.products_id = " . $product_info['products_id'] ." ORDER BY s.attribute_combination desc");
        $products_stocks_array = [];
        while ($row = tep_db_fetch_array($products_stocks_query)) {
            if ($row['products_stock_quantity'] > 0) {
                $products_stocks_array[] = $row['attr'];
            }
            $products_stocks_vendor_code_array[$row['attr']] = $row['products_vendor_code'];
            $products_stocks_price_array[$row['attr']] = $row['products_combination_price']
                /*$currencies->display_price($row['products_combination_price'], tep_get_tax_rate($product_info['products_tax_class_id']), 1, false)*/;
            if (getConstantValue('SPECIALS_MODULE_ENABLED') == 'true' && !empty($row['special_price'])) {
                $products_stocks_special_price_array[$row['attr']] = $row['special_price']
                    /*$currencies->display_price($row['special_price'], tep_get_tax_rate($product_info['products_tax_class_id']), 1, false)*/;
            }
        }
    }

    tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . (int)$_GET['products_id'] . "' and language_id = '" . (int)$languages_id . "'");

    // $product_info['products_price'] = tep_xppp_getproductprice($product_info['products_id']);

    if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
        $query_special_prices_hide_result = defined('SPECIAL_PRICES_HIDE') ? SPECIAL_PRICES_HIDE : false;
        // Disable specials price if module SALES is disabled
        if ($query_special_prices_hide_result == 'true') {
            $products_price = '<div class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</div>';
        } else {
            $spec_price = $new_price;
            $products_price = '<span class="new_price_card_product">' . $currencies->display_price($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
            if ($new_price != $product_info['products_price'] || !empty($products_stocks_special_price_array)) {
                $products_price .= '<br><span class="old_price_card_product">' . $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
            }
        }
        $special_price = tep_get_products_special_price_data($product_info['products_id']);
        if ($special_price['display_countdown'] == 1) {
            $products_price .= "
            <div class='timer' id='timer' data-expired='" . $special_price['expires_date'] . "'>
                <h4 class='timer-title'>" . TEXT_TO_EXPIRES_DATE . "</h4>
                <div class='timer-container'>
                    <div class='timer-numbers'><div><span id='days'>00</span></div><div class='timer-description'>" . TEXT_DAYS . "</div></div>
                    <div class='timer-numbers'><div><span id='hours'>00</span></div><div class='timer-description'>" . TEXT_HOURS . "</div></div>
                    <div class='timer-numbers'><div><span id='minutes'>00</span></div><div class='timer-description'>" . TEXT_MINUTES . "</div></div>
                    <div class='timer-numbers'><div><span id='seconds'>00</span></div><div class='timer-description'>" . TEXT_SECONDS . "</div></div>      
                </div>
              </div>";
        }
    } else {
        $products_price =  '<span class="new_price_card_product">' . $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>' ;
    }

    $products_name = stripslashes($product_info['products_name']);
    $products_name = htmlspecialchars($products_name);

    // LABELS
    $product_info['p_label'] = '';
    if (getConstantValue('PRODUCT_LABELS_MODULE_ENABLED') == 'true' && $template->show('P_LABELS')) {
        $product_info['products_special_price'] = $spec_price;
        foreach (getLabels($product_info) as $labelData) {
            $label = $labelData['name'];
            $label_class = $labelData['class'];
            $product_info['p_label'] .= sprintf(RTPL_LABEL, $label_class, $label);
        }
    }
    // END -- LABELS

    if (tep_session_is_registered('wishlist_id')) {
        echo '<div class="messageStackSuccess">' . PRODUCT_ADDED_TO_WISHLIST . '</div>';
        tep_session_unregister('wishlist_id');
    }

    // last visited products:
    $_SESSION['visited_products2'] = isset($_SESSION['visited_products2']) ? $_SESSION['visited_products2'] : [];
    if (is_array($_SESSION['visited_products2']) && count($_SESSION['visited_products2']) < 10) {
        $_SESSION['visited_products2'][$product_info['products_id']] = $product_info['products_id'];
    }

    $content = CONTENT_PRODUCT_INFO;

    // from product_info.tpl.php:
    $id = $product_info['products_id'];
    $r_incart = $cart->get_products();
    $stock_text = $product_info['products_quantity'] > 0 ? LIST_TEMP_INSTOCK : LIST_TEMP_OUTSTOCK;

    if (COMMENTS_MODULE_ENABLED == 'true') {
        if (file_exists($rootPath . '/ext/reviews/reviews.php')) {
            require_once($rootPath . '/ext/reviews/reviews.php');
            $reviews_type = 1; // 1 = products
            $rating = Reviews::count_comments($id, $reviews_type);
        }
    }
    include(DIR_WS_MODULES . 'product_attributes.php');

    if (COMPARE_MODULE_ENABLED == 'true') {
        $compare_arr = getCompare($id);
        $compare_checked = $compare_arr['checked'];
        $compare_text = $compare_arr['text'];
    }

    if (WISHLIST_MODULE_ENABLED == 'true') {
        $wish_arr = getWishList($id);
        $wish_checked = $wish_arr['checked'];
        $wish_text = $wish_arr['text'];
    }

    if (!$new_price) {
        $new_price = $product_info['products_price'];
    }
    $hidden_price = $new_price * $currencies->currencies[$currency]['value'];

    $prod_price_orign = $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']), 1, false);
    if (is_numeric($prod_price_orign)) {
        $prod_price_orign = number_format($prod_price_orign, (defined('DEFAULT_CURRENCY') ? $currencies->currencies[DEFAULT_CURRENCY]['decimal_places'] : 2), '.', '');
    }

    $old_prod_price = $currencies->display_price($product_info['products_price'] * $currencies->currencies[$currency]['value'], tep_get_tax_rate($product_info['products_tax_class_id']), 1, false);
    if (is_numeric($old_prod_price)) {
        $old_prod_price = number_format($old_prod_price, $currencies->currencies[$currency]['decimal_places'], '.', '');
    }

    $prod_price = $currencies->display_price($hidden_price, tep_get_tax_rate($product_info['products_tax_class_id']), 1, false);
    if (is_numeric($prod_price)) {
        $prod_price = number_format($prod_price, $currencies->currencies[$currency]['decimal_places'], '.', '');
    }

    $hidden_fields .= '<input type="hidden" name="prod_price_orign" value="' . $prod_price_orign . '">';
    $hidden_fields .= '<input type="hidden" name="old_prod_price" value="' . $old_prod_price . '">';
    $hidden_fields .= '<input type="hidden" name="prod_price" value="' . $prod_price . '">';
    $hidden_fields .= '<input type="hidden" name="prod_name" value="' . $products_name . '"> ';
    $hidden_fields .= '<input type="hidden" name="prod_category_name" value="' . (isset($cat_names[$prodToCat[$id]]) ? $cat_names[$prodToCat[$id]] : '') . '"> ';
    $hidden_fields .= '<input type="hidden" name="prod_currency_left" value="' . $currencies->currencies[$currency]['symbol_left'] . '"> ';
    $hidden_fields .= '<input type="hidden" name="prod_currency_right" value="' . $currencies->currencies[$currency]['symbol_right'] . '"> ';
    $hidden_fields .= '<input type="hidden" name="prod_thousands_point" value="' . $currencies->currencies[$currency]['thousands_point'] . '"> ';
    $hidden_fields .= '<input type="hidden" name="prod_dec_point" value="' . $currencies->currencies[$currency]['decimal_point'] . '"> ';
    $hidden_fields .= '<input type="hidden" name="prod_dec_places" value="' . $currencies->currencies[$currency]['decimal_places'] . '"> ';
    $hidden_fields .= '<input type="hidden" name="color_id" value="' . $color_id . '"> ';
    $hidden_fields .= '<input type="hidden" name="color_images" value="' . $product_info['products_image'] . '" id="color_images" />';
    $hidden_fields .= tep_draw_hidden_field('products_id', $id, 'id="products_id"');

    if ($product_info['products_description']) {
        $product_info['products_description'] = stripcslashes($product_info['products_description']);
        function get_name_by_src($src)
        {
            $name = explode('/', $src);
            $name = end($name);
            $name = explode('.', $name);
            $name = array_shift($name);
            return $name;
        }

        $html = str_get_html($product_info['products_description']);
        $img_found = $html->find('img');
        foreach ($img_found as &$img) {
            if ($img->alt == "" || !$img->alt) {
                $img->alt = get_name_by_src($img->src);
            }
        }

        $data_src = "data-src";
        $iframe_found = $html->find('iframe');
        foreach ($iframe_found as &$iframe) {
            $iframe->$data_src = $iframe->src;
            $iframe->src = null;
            $iframe->class = 'youtube_iframe';
        }
        $product_info['products_description'] = (string)$html;
    }


    $add_to_cart = "";

    if (( $product_info['products_quantity'] <= 0 && STOCK_SHOW_BUY_BUTTON == "true" ) || $product_info['products_quantity'] > 0) {
        $cart_key = $id . $attributes;
        if ($cart->in_cart($cart_key)) {
            $add_to_cart = RTPL_CART_BUTTON_PRODUCT_PAGE;
        } else {
            $add_to_cart = RTPL_ADD_TO_CART_BUTTON_PRODUCT_PAGE;
        }

        $add_to_cart = '<div id="r_buy_intovar" data-id="' . $id . '">' . $add_to_cart . '</div>';
    }

    $add_to_cart .= $hidden_fields;

    $productsDescription = $product_info['products_info'] ?: strip_tags($product_info['products_description']);

    $product_downloads = tep_get_products_downloads($id);

    if (file_exists(__DIR__ . "/ext/json_ld/connector.php")) {
        include_once __DIR__ . "/ext/json_ld/connector.php";

        $product = new \JsonLd\Product();
        $currencyRate = $currencies->currencies[$currency]['value'];
        $product->setId($product_info['products_model'] ?: $product_info['products_id'])->setName(
            $products_name ?: STORE_NAME
        )->setImage(HTTP_SERVER . "/getimage/products/" . $product_info['products_image'])->setDescription(
            $productsDescription ?: STORE_NAME
        )->setSku($product_info['products_model'] ?: $product_info['products_id'])->setMpn(
            $product_info['products_model'] ?: $product_info['products_id']
        )->setIdentifier($product_info['products_model'] ?: $product_info['products_id'])->setQuantity(
            $product_info['products_quantity']
        )->setCurrency($currency)->setPrice(
            $currencies->display_price(
                ($new_price ?: $product_info['products_price']) * $currencyRate,
                tep_get_tax_rate($product_info['products_tax_class_id']),
                1,
                false
            )
        )->setBrand($manufacturers_array[$product_info['manufacturers_id']]['name']);

        \JsonLd\Container::set("product", $product);
    }
} else {
    http_response_code(404);
    $content = CONTENT_ERROR_404;
}
require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);
require(DIR_WS_INCLUDES . 'application_bottom.php');
