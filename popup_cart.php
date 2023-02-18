<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    require('includes/application_top.php');
}
if (!function_exists('includeLanguages')) {
    header("HTTP/1.0 301 Moved Permanently");
    header("Location: 404.php");
    die;
}
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOPPING_CART);

$any_out_of_stock = 0;
$disabled = '';
$stock_text = '';
$html = [];
$skipTemplates = [
    'gadgetorio',
    'solo_cellphones',
    'solo_health',
];

$products = $cart->get_products();
foreach ($products as $product) {
    // Push all attributes information in an array
    if (isset($product['attributes']) && is_array($product['attributes'])) {
        $sql = "SELECT popt.products_options_name, 
                        pa.options_id,
                        pa.options_values_id,
                        poval.products_options_values_name,
                        pa.options_values_price,
                        pa.price_prefix
                    FROM " . TABLE_PRODUCTS_OPTIONS . " popt, " .
            TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " .
            TABLE_PRODUCTS_ATTRIBUTES . " pa
                    WHERE pa.products_id = '" .(int) $product['id'] . "'
                    and pa.options_id = popt.products_options_id
                    and pa.options_values_id = poval.products_options_values_id
                    and popt.language_id = '" . $languages_id . "'
                    and poval.language_id = '" . $languages_id . "'";
        $attributes = tep_db_query($sql);
        $attributesValues = [];
        while ($row = tep_db_fetch_array($attributes)) {
            $attributesValues[] = $row;
        }
        foreach ($product['attributes'] as $option => $value) {
            $countOfAttributes = 0;
            $attributes_values = [];
            foreach ($attributesValues as $row) {
                if ($row['options_id'] == $option) {
                    $countOfAttributes++;
                    if ($row['options_values_id'] == (int)$value) {
                        $attributes_values = $row;
                    }
                }
            }

            if ($value == PRODUCTS_OPTIONS_VALUE_TEXT_ID) {
                $attr_value = $product['attributes_values'][$option]
                    . tep_draw_hidden_field(
                        'id[' . $product['id'] . '][' . TEXT_PREFIX . $option . ']',
                        $product['attributes_values'][$option]
                    );
            } else {
                $attr_value = $attributes_values['products_options_values_name']
                    . tep_draw_hidden_field('id[' . $product['id'] . '][' . $option . ']', $value);
            }

            $product[$option]['products_options_name'] = $attributes_values['products_options_name'];
            $product[$option]['options_values_id'] = $value;
            $product[$option]['products_options_values_name'] = $attr_value;
            $product[$option]['option_variants'] = $countOfAttributes;
            $product[$option]['options_values_price'] = $attributes_values['options_values_price'];
            $product[$option]['price_prefix'] = $attributes_values['price_prefix'];
        }
    }

    $products_name = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product['id']) . '">' .
        $product['name'] .
        '</a>';
    $checkout_products_name = '<a class="cart_prod_name product-id-' . $product['id'] . '" 
    href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product['id']) . '">' . $product['name'] . '</a>';

    if (STOCK_CHECK == 'true') {
        $outOfStockAttributeQuantity = false;
        if (getConstantValue('QTY_PRO_ENABLED') == 'true') {
            $sql = "select ps.products_stock_quantity, ps.products_stock_attributes, ps.products_combination_price, s.specials_new_products_price as special_price"
                . " from " . TABLE_PRODUCTS_STOCK . " ps
                        LEFT JOIN " . TABLE_SPECIALS . " s on (s.attribute_combination = ps.products_stock_attributes or s.attribute_combination ='all') and status = '1'
                            and (start_date <= CURDATE() or start_date = '0000-00-00 00:00:00' or start_date is NULL)
                            and (expires_date >= CURDATE() or expires_date = '0000-00-00 00:00:00' or expires_date is NULL)
                        where ps.products_id = " . (int)$product['id'] . " ORDER BY s.attribute_combination desc";
            $product_info_query = tep_db_query($sql);
            if ($product_info_query->num_rows > 0) {
                if (is_array($product['attributes'])) {
                    $outOfStockAttributeQuantity = true;
                    $attributesArray = [];
                    $products_stock_quantity = 0;
                    foreach ($product['attributes'] as $attributeKey => $attributeValue) {
                        if ((int)$attributeValue != 0) {
                            $attributesArray[$attributeKey] = $attributeKey . '-' . (int)$attributeValue;
                        }
                    }

                    ksort($attributesArray);


                    while ($product_info = tep_db_fetch_array($product_info_query)) {
                        $count = 0;
                        if (!empty($product_info['products_stock_attributes'])) {
                            foreach ($attributesArray as $attributeCombinationPart) {
                                if (
                                in_array(
                                    $attributeCombinationPart,
                                    explode(',', $product_info['products_stock_attributes'])
                                )
                                ) {
                                    $count++;
                                }
                            }
                        }

                        if ($count === count($attributesArray)) {
                            $products_stock_quantity = $product_info['products_stock_quantity'];
                            $product['final_price'] = (getConstantValue('SPECIALS_MODULE_ENABLED') == 'true' && $product_info['special_price']) ? $product_info['special_price'] : $product_info['products_combination_price'];
                        }
                    }

                    if ((!empty($products_stock_quantity) && $products_stock_quantity >= $product['quantity']) || !tep_db_num_rows($product_info_query)) {
                        $outOfStockAttributeQuantity = false;
                    }
                } else {
                    $outOfStockAttributeQuantity = true;
                }
            }
        }


        if (!$outOfStockAttributeQuantity) {
            $stock_check = tep_check_stock($product['id'], $product['quantity']);
        }
        if (tep_not_null($stock_check) || $outOfStockAttributeQuantity) {
            $stock_check = $stock_check ?: '<span class="markProductOutOfStock">' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '</span>';
            $any_out_of_stock = 1;
            $products_name .= $stock_check;
            $checkout_products_name .= $stock_check;
            $checkout_products_name = '<a class="cart_prod_name product-id-' . $product['id'] . '" href="' . tep_href_link(
                    FILENAME_PRODUCT_INFO,
                    'products_id=' . $product['id']
                ) . '">' . $product['name'] . $stock_check . '</a>';
        }
    }

    $products_image = explode(';', $product['image']);

    $attrChain = '';
    if (isset($product['attributes']) && is_array($product['attributes'])) {
        reset($product['attributes']);
        $product['attributes'] = array_filter($product['attributes'], function ($k) { return is_numeric($k); });
        if (!empty($product['attributes'])) {
            $optionTypesQuery = tep_db_query("select distinct pa.options_id, pa.options_values_id, pa.pa_imgs
                from " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                join " . TABLE_PRODUCTS_OPTIONS . " po on po.products_options_id = pa.options_id and po.products_options_type = 3 and po.language_id=" . $languages_id . "
                where pa.products_id = " . (int)$product['id'] . " and pa.options_values_id in (" . implode(
                    ',',
                    $product['attributes']
                ) . ")");
            $attributeImages = $products_attribute_image = '';
            $attributeImages = tep_db_fetch_array($optionTypesQuery)['pa_imgs'];
            if (!empty($attributeImages)) {
                $products_image = explode('|', $attributeImages);
            }

            $products_name .= '<ul class="attributes_list">';
            foreach ($product['attributes'] as $option => $value) {
                if ($value != 0) {
                    $attrChain .= '__' . $option . '_' . $value;
                    if ($product[$option]['option_variants'] > 1) {
                        $products_name .= '<li><span>' . $product[$option]['products_options_name'] . '</span> : ' . $product[$option]['products_options_values_name'] . '</li>';
                    }
                }
            }
            $products_name .= '</ul>';
        }
    }
    if (returnJson($html)) {
        $html[] = [
            'id' => $product['id'],
            'name' => $products_name,
            'checkout_name' => $checkout_products_name,
            'qty' => $product['quantity'],
            'string_id' => $product['string_id'],
            'attr_chain' => $attrChain,
            'price_full' => $currencies->display_price(
                $product['final_price'],
                tep_get_tax_rate($product['tax_class_id']),
                $product['quantity']
            )
        ];
    } else {
        $html[] = [
            'id' => $product['id'],
            'image' => $products_image[0],
            'string_id' => $product['string_id'],
            'attr_chain' => $attrChain,
            'name' => $products_name,
            'price' => $currencies->display_price($product['final_price'], tep_get_tax_rate($product['tax_class_id'])),
            'qty' => $product['quantity'],
            'price_full' => $currencies->display_price(
                $product['final_price'],
                tep_get_tax_rate($product['tax_class_id']),
                $product['quantity']
            )
        ];
    }
}

// Products, signed as *** are not enought...
if ($any_out_of_stock == 1) {
    if (STOCK_ALLOW_CHECKOUT == 'true') {
        $stock_text = '<div class="warning_mess">' . sprintf(
                OUT_OF_STOCK_CAN_CHECKOUT,
                STOCK_MARK_PRODUCT_OUT_OF_STOCK,
                STOCK_MARK_PRODUCT_OUT_OF_STOCK
            ) . '</div>';
    } else {
        $stock_text = '<div class="warning_mess">' . sprintf(
                OUT_OF_STOCK_CANT_CHECKOUT,
                STOCK_MARK_PRODUCT_OUT_OF_STOCK,
                STOCK_MARK_PRODUCT_OUT_OF_STOCK
            ) . '</div>';
        $disabled = ' style="pointer-events: none; opacity: 0.5;"';
    }
}

if (returnJson($html) && count($html) > 0) {
    $rez['prod'] = $html;
    $rez['total'] = TOTAL_CART . ': <b>' . $currencies->display_price($cart->show_total(), 0) . '</b>';
    $rez['stock_text'] = $stock_text;
    $rez['count'] = $cart->count_contents();
    echo json_encode($rez);
    exit();
}
$content = CONTENT_POPUP_CART;
if (file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/' . $content . '.tpl.php')) {
    require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/' . $content . '.tpl.php');
} else {
    require(DIR_WS_CONTENT . $content . '.tpl.php');
}

function returnJson($html)
{
    global $skipTemplates;

    return isset($_GET['action']) && $_GET['action'] == 'update_product' &&
        (!in_array(TEMPLATE_NAME, $skipTemplates) || strpos($_SERVER["HTTP_REFERER"], 'checkout.php') !== false);
}
