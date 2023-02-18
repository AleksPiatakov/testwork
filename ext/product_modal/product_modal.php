<?php

chdir('../../../');
$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
chdir($rootPath);
require($rootPath . '/includes/application_top.php');
chdir(__DIR__);
//BOF Languages
$paths = [DIR_WS_LANGUAGES . $language . '/product_info.json', DIR_WS_LANGUAGES . $language . '/reviews.json'];
foreach ($paths as $path) {
    if (file_exists($rootPath . $path)) {
        $json = file_get_contents($rootPath . $path);
        $content = json_decode($json, 1);
        foreach ($content as $k => $v) {
            if (!defined($k)) {
                define($k, $v);
            }
        }
    }
}
//EOF Languages
if ($template->show("LIST_MODAL_ON") == true && $_GET['product_href'] || $_SERVER["HTTP_X_REQUESTED_WITH"] == "XMLHttpRequest") {
    $url = array_reverse(explode("/", $_GET['product_href']))[0];
    $id = [];
    preg_match('!\d+!', $url, $id);
    $id = $id[0];
    $_GET['products_id'] = $id;
    $response = [];

    $query = tep_db_query("select p.lable_3, p.products_free_ship, p.lable_2, p.lable_1,
     p.products_id, pd.products_name, pd.products_viewed, pd.products_description,
      p.products_model, p.products_quantity, pd.products_info, p.products_image,
       pd.products_url, ROUND(CASE WHEN " . $customer_price . " IS NULL THEN products_price ELSE " . $customer_price . " END * " . $currencies->currencies[$currency]['value'] . ",2) as products_old_price,
        ROUND(p.products_price  * " . $currencies->currencies[$currency]['value'] . ",2) as products_new_price,
        p.products_tax_class_id, p.products_date_added, p.products_date_available, 
        p.manufacturers_id from " . TABLE_PRODUCTS . " p,
         " . TABLE_PRODUCTS_DESCRIPTION . " pd where
          p.products_status = '1' and p.products_id = '" . (int)$id . "'
           and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");


    if (tep_db_num_rows($query)) {
        $product = tep_db_fetch_array($query);
        $product['products_free_ship'] = $product['products_free_ship'] ? 1 : (checkConst('MODULE_SHIPPING_FREESHIPPER_STATUS')  == "true");
        $product_characteristics = tep_db_query("select pag_id, pag_name from products_attributes_groups where language_id = '" . (int)$languages_id . "'");
        $new_price = round((double)(tep_get_products_special_price((int)$id) * $currencies->currencies[$currency]['value']), 2);
        if ($new_price) {
            $product['products_new_price'] = $new_price;
        }

        $zap_query = tep_db_query("SELECT pa_imgs FROM products_attributes WHERE products_id=" . (int) $id . " order by products_options_sort_order");
        $row = tep_db_fetch_array($zap_query);
        if (tep_db_num_rows($zap_query) > 0 and !empty($row['pa_imgs']) and MULTICOLOR_ENABLED == 'true') {
            $imgs = explode('|', $row['pa_imgs']);
            $attr_images = true;
        } else {
            $imgs = explode(";", $product['products_image']);
            $product['products_image'] = $imgs;
        }

        $options = [];
        while ($res = tep_db_fetch_array($product_characteristics)) {
            $options[] = $res;
        }


        $products_options_name_query = tep_db_query("
        select 
        popt.products_options_id, 
        (CASE WHEN popt.products_options_name != '' 
              THEN popt.products_options_name
              ELSE (select po.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " po where popt.products_options_id = po.products_options_id AND po.language_id = " . (int)$lng->defaultLanguage['id'] . ") 
              END) as products_options_name, 
        popt.products_options_type, 
        popt.pag, 
        pov.products_options_values_id, 
        (CASE WHEN pov.products_options_values_name != ''
              THEN pov.products_options_values_name
              ELSE (select povv.products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " povv where pov.products_options_values_id = povv.products_options_values_id AND povv.language_id = " . (int)$lng->defaultLanguage['id'] . ") 
              END) as products_options_values_name, 
        pov.products_options_values_image, 
        pa.price_prefix, 
        pa.options_values_price, 
        pa.pa_qty 
        from 
        " . TABLE_PRODUCTS_OPTIONS . " popt, 
        " . TABLE_PRODUCTS_ATTRIBUTES . " pa, 
        " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov 
        where 
        pa.products_id=" . (int)$_GET['products_id'] . " and 
        pa.options_id = popt.products_options_id and 
        pa.options_values_id = pov.products_options_values_id and 
        popt.language_id = " . (int)$languages_id . " and 
        pov.language_id = " . (int)$languages_id . " 
        order by 
        popt.pag, 
        popt.products_options_sort_order, 
        pov.products_options_values_sort_order");

        //select product attributes
        $product_options = [];
        while ($res = tep_db_fetch_array($products_options_name_query)) {
            $product_options[] = $res;
        }
        $options_container = [];
        foreach ($options as $option) {
            $options_container[$option['pag_id']] = array_search($option, $options);
        }
        foreach ($product_options as $product_option) {
            if (($index = array_search($product_option['pag'], ($options_container))) === false) {
                $options[$options_container[$product_option['pag']]]['values'][] = $product_option;
            } else {
                $options['empty']['values'][] = $product_option;
            }
        }
        if (COMMENTS_MODULE_ENABLED == 'true') {
            if (file_exists($rootPath . '/ext/reviews/reviews.php')) {
                require_once($rootPath . '/ext/reviews/reviews.php');
                require_once($rootPath . '/ext/reviews/languages/' . $language . '/reviews.php');
                $reviews_type = 1; // 1 = products
                $rating = Reviews::count_comments($id, $reviews_type);
                $reviews = new reviews();
                $reviews->setAjaxPath('/ext/reviews/ajaxReviews.php');
                ob_start();
                $reviews->renderScriptsModal();
                $script = ob_get_clean();
                $reviews->setReviewsType(1);
                $reviews->setProductId($id);
                $reviews->getReviewContainer();
                $reviews->drawReviews();
                $comments = $reviews->reviewsHtml;
                $product['comments']['script'] = $script;
                $product['comments']['count'] = $rating;
                $product['comments']['content'] = $comments;
            }
        } else {
            $product['comments']['script'] = '';
            $product['comments']['count'] = ['count' => 0,'average' => 0];
            $product['comments']['content'] = '';
        }

        $product['options'] = $options;

        if (file_exists(DIR_WS_MODULES . 'product_attributes.php')) {
            require_once DIR_WS_MODULES . 'product_attributes.php';
        }

        $imgs1_string = '';
        $imgs2_string = '';
        foreach ($imgs as $img) {
            $imgs1_string .= '<div class="sync1-item">
                    <img class="lazyload" src="images/pixel_trans.png"  data-src="getimage/400x400/products/' . $img . '">
            </div>';
            $imgs2_string .= '<div class="sync2-item">
                    <img class="lazyload" src="images/pixel_trans.png"  data-src="getimage/400x400/products/' . $img . '">
            </div>';
        }

        $options_string = '';
        foreach ($options as &$option) {
            if (!($option['values'])) {
                continue;
            }
            $options_string .= "<div class='pag'>
                    <div class='pag_header'>" . $option['pag_name'] . "</div>
                    <div class='char' style='font-size: .7em'>";
            $options_ids = [];
            foreach ($option['values'] as &$value1) {
                $options_ids[] = $value1['products_options_id'];
            }
            $count = array_count_values($options_ids);
            $array_non_unique = [];
            foreach ($count as $c => $v) {
                if ($v > 1) {
                    $array_non_unique[] = $c;
                }
            }
            $array_non_unique = array_unique($array_non_unique);
            foreach ($option['values'] as $value) {
                if (in_array($value['products_options_id'], $array_non_unique)) {
                    continue;
                }
                $options_string .= "<div class = 'char-left'>" . $value['products_options_name'] . "</div>
                <div class='char-right'>" . $value['products_options_values_name'] . "</div>
                <div class='clearfix'></div>";
            }
            $options_string .= "</div></div>";
        }
        $is_new_price = (($new_price != $product['products_old_price']) && ($new_price != false));
        $quick_order = '';
        if (file_exists("ext/quick_order/quick_order.php")) {
            ob_start();
            require_once "ext/quick_order/quick_order.php";
            $quick_order = ob_get_clean();
        }

        //labels
        $labels_str = '';
        if (getConstantValue('PRODUCT_LABELS_MODULE_ENABLED') == 'true' && $template->show('P_LABELS')) {
            $product['products_special_price'] = $is_new_price ? $new_price : false;
            $product['products_price'] = $product['products_old_price'];
            $labels = getLabels($product);
            $labels_classes = [
                '1' => 'top', '2' => 'new', '3' => 'discount'
            ];
            foreach ($labels as $label) {
                $labels_str .= '<div class="label' . $label['class'] . ' label-' . $labels_classes[$label['class']] . ' productModal-label">' . $label['name'] . '</div>';
            }
        }
        //END labels

        $cart_key = $id . $attributes;

        if (DISPLAY_PRICE_WITH_TAX == 'true') {
            $product['products_old_price'] = $currencies->display_price($product['products_old_price'], tep_get_tax_rate($product['products_tax_class_id']), 1, false);
            $product['products_new_price'] = $currencies->display_price($product['products_new_price'], tep_get_tax_rate($product['products_tax_class_id']), 1, false);
        } else {
            $product['products_old_price'] = $currencies->display_price($product['products_old_price'], 0, 1, false);
            $product['products_new_price'] = $currencies->display_price($product['products_new_price'], 0, 1, false);
        }
        if ($product['products_new_price'] > $product['products_old_price']) {
            $tempPrice = $product['products_new_price'];
            $product['products_new_price'] = $product['products_old_price'];
            $product['products_old_price'] = $tempPrice;
            $is_new_price = true;
        }

        $hidden_fields .= '<input type="hidden" name="prod_currency_left" value="' . $currencies->currencies[$currency]['symbol_left'] . '"> ';
        $hidden_fields .= '<input type="hidden" name="prod_currency_right" value="' . $currencies->currencies[$currency]['symbol_right'] . '"> ';
        $hidden_fields .= '<input type="hidden" name="prod_thousands_point" value="' . $currencies->currencies[$currency]['thousands_point'] . '"> ';
        $hidden_fields .= '<input type="hidden" name="prod_dec_point" value="' . $currencies->currencies[$currency]['decimal_point'] . '"> ';
        $hidden_fields .= '<input type="hidden" name="prod_dec_places" value="' . $currencies->currencies[$currency]['decimal_places'] . '"> ';
        $hidden_fields .= '<input type="hidden" name="color_id" value="' . $color_id . '"> ';
        $hidden_fields .= '<input type="hidden" name="color_images" value="' . $product['products_image'] . '" id="color_images" />';
        $hidden_fields .= '<input type="hidden" name="prod_price" value="' . $product['products_new_price'] . '">';
        $hidden_fields .= tep_draw_hidden_field('products_id', $id, 'id="products_id"');
        $tcart = $_SESSION['cart'] ? $_SESSION['cart'] : null;
        $tcart_product_count = null;
        if ($tcart) {
            $tcart_product_count = $tcart->contents[$product['products_id']]['qty'] ? $tcart->contents[$product['products_id']]['qty'] : null;
        }
        $prod_count = $tcart_product_count ? $tcart_product_count : 1;
        $cart_key = $id . $attributes;
        if ($cart->in_cart($cart_key)) {
            $prod_btn_name = RTPL_CART_BUTTON_PRODUCT_PAGE;
        } else {
            $prod_btn_name = RTPL_ADD_TO_CART_BUTTON_MODAL;
        }
        $prod_btn_name = '<div id="r_buy_intovar" data-id="' . $id . '">' . $prod_btn_name . '</div>';
        $markup =
            '

<div class="productModalWrapper">
    <div class="label-wrapper">
            ' . $labels_str . '
    </div>
    <div class="productModal-slider additional_images2">
        <div id="sync3" class="oneItemSlider modalSlider owl-carousel owl-theme">
            ' . $imgs1_string . '
        </div>
        
        <div id="sync4" class="synchronizedSlider modalSlider owl-carousel">
            ' . $imgs2_string . '
        </div>
    </div>

    <div class="productModal-middleBlock">
                ' . tep_draw_form('modal_cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action', 'language')) . 'action=add_product'), 'post', 'data-cart-key="' . $cart_key . '"') . '

        <div class="productModal-middleBlock-price">
            <div class="actualPrice" data-oldPice="' . ($is_new_price ? $currencies->format($product['products_old_price']) : '') . '">' . (in_array($product['products_new_price'], ['-','']) ? '' : $currencies->format($product['products_new_price'])) . '</div>
            
            <div class="add2cart-wrapper">
                <input type="number" id="modal_qty_input" min = "1" name = "cart_quantity" value="' . $prod_count . '">
                ' . sprintf($prod_btn_name, $id, 1) . '
                <input type="hidden" name = "products_id" value = "' . $id . '">
                ' . $quick_order . '
            </div>
        </div>
        <div class="productModal-middleBlock-characteristics">
            ' .
            (@$attr_string_select
                ? '<div class="productModal-middleBlock-color">' . @$attr_string_select . '</div>'
                : "")
            . '
            <div class="productModal-middleBlock-last">
                ' . @$attr_string . '
                ' . $product['products_description'] . '
            </div>
        </div>
        </form>
    </div>
    
    <div class="productModal-desc">
        <div class="tabs">';
//        $template->show('P_TAB_DESCRIPTION') ? $markup .='<a href="#tab-1" class="productModal-tabItem">' . TEXT_DESCRIPTION . '</a>' : '';
        if(!empty($options_string)) {
            $template->show('P_TAB_CHARACTERISTICS') ? $markup .= '<a href="#tab-2" class="productModal-tabItem">' . TEXT_ATTRIBS . '</a>' : '';
        }
        COMMENTS_MODULE_ENABLED == 'true' and $template->show('P_TAB_COMMENTS') ? $markup .= '<a href="#tab-3" class="productModal-tabItem">' . MAIN_REVIEWS_ALL . '</a>' : '';
        $template->show('P_TAB_PAYMENT_SHIPPING') ? $markup .= '<a href="#tab-4" class="productModal-tabItem">' . TEXT_PAYM_SHIP . '</a>' : '';
        $markup .= '</div>
        ' . $hidden_fields . $hidden_string . '
        <input type="hidden" id="modal" value="1">
        <div class="tabs-content">';
            if(!empty($options_string)) {
                $markup .= '<div id="tab-2" class="productModal-tabContent-Item">' . $options_string . '</div>';
            }
            $markup .= '<div id="tab-3" class="productModal-tabContent-Item">' . $product['comments']['content'] . '</div>
            <div id="tab-4" class="productModal-tabContent-Item">' . renderArticle('shipping_product_info_tab') . '</div>
        </div>
    </div>
</div>
';
        $product['markup'] = $markup;
        $response = ["success" => "true", "status" => "200", "product" => $product];
    } else {
        $response = ["success" => "false", "status" => "404"];
    }
    die(json_encode($response));
}
