<?php

$product_attributes = array();
$pa_id2names = array();
$products_options_array = array();
$selected_attributes = '';
// get all attributes and values for current product:
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
        pa.pa_qty,
        pa.pa_article,
        pa.pa_imgs
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
        pov.products_options_values_sort_order,
        LENGTH(REPLACE(pov.products_options_values_name, ' ', '')), REPLACE(pov.products_options_values_name, ' ', '')"); // order by pa.products_options_sort_order

while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
    if (!empty($products_options_name['products_options_values_name']) && !empty($products_options_name['products_options_name'])) {
        $product_attributes[$products_options_name['products_options_id']][] = $products_options_name['products_options_values_id'];

        $products_options_type = $products_options_name['products_options_type'];

        $pa_id2names[$products_options_name['products_options_id']] = array(
            'type' => $products_options_type,
            'name' => $products_options_name['products_options_name'],
            'pag' => $products_options_name['pag']
        );

        $products_options_array[$products_options_name['products_options_id']][$products_options_name['products_options_values_id']] =
            array(
                'id' => $products_options_name['products_options_values_id'],
                'text' => $products_options_name['products_options_values_name'],
                'image' => $products_options_name['products_options_values_image'],
                'prefix' => $products_options_name['price_prefix'],
                'price' => $products_options_name['options_values_price'],
                'article' => $products_options_name['pa_article'],
                'qty' => (getConstantValue('QTY_PRO_ENABLED') == 'true' && !empty($products_stocks_array)) ? 1 : $products_options_name['pa_qty'],
                'img' => $products_options_name['pa_imgs']
            );
    }
}


if (getConstantValue('QTY_PRO_ENABLED') == 'true' && is_array($products_stocks_array)) {
    foreach ($products_stocks_array as $attributeCombination) {
        foreach (explode(',', $attributeCombination) as $attributeCombinationPart) {
            $attributeCombinationParts = explode('-', $attributeCombinationPart);
            $optionId = $attributeCombinationParts[0];
            $optionValueId = $attributeCombinationParts[1];
            $newAttributeCombinationPart[$optionId][$optionValueId] = $optionValueId;
        }
    }
}

if (!empty($product_attributes)) {
    $attr_string = '';
    $attr_string_select = '';

    $i = 0;
    $attributes = $last_attr = $selected_attributes = [];
    foreach ($product_attributes as $at_id => $at_vals) {
        $first_attr_value = array_slice($products_options_array[$at_id], 0, 1)[0]['id'];
        //for price in javascript:
        $hidden_string = '<input class="option_name" type="hidden" name="option_name" value="' . $at_id . '" id="' . $at_id . '">';


        $attr_string_begin = '
            <table class="prod_options" style="width: 100%;border-spacing:0;padding:0;">
	            <colgroup>
	              <col class="col_1">
	              <col class="col_2"> 
	            </colgroup>
	            <tr>
	              <td style="text-align:left;" class="left_td">' . $pa_id2names[$at_id]['name'] . ':</td>';

        $attr_string_end = '
	            </tr>
            </table>';
        $cart_attributes = [];
        foreach (array_keys((array)$cart->contents) as $cart_product) {
            //product in cart and product have attributes
            if (is_int(strpos($cart_product, (string)$_GET['products_id'])) and strpos($cart_product, '{')) {
                $cart_attributes_string = explode(
                    '{',
                    $cart_product
                );    // get key}value from product_id{key}value{key}value
                $cart_attributes = [];
                foreach ($cart_attributes_string as $i => $cart_attribute) {
                    if ($i == 0) {
                        continue;
                    }     // remove product_id from str with attributes
                    $this_attribute = explode('}', $cart_attribute);  // get key and value from key}value
                    // $this_attribute[0];  - attribute key
                    // $this_attribute[1];  - attribute value
                    $cart_attributes[$_GET['products_id']][$this_attribute[0]] = $this_attribute[1];
                }
            }
        }

        if (isset($cart_attributes[$_GET['products_id']][$at_id])) {
            $selected_attribute = $cart_attributes[$_GET['products_id']][$at_id];
            if (count($at_vals) > 1) {
                $selected_attributes [] = '{' . $at_id . '}' . $selected_attribute;
            }
        } else {
            $selected_attribute = false;
        }

        foreach ($at_vals as $at_val_id) {
            // show attribute value price:
            // if ($products_options_array[$at_id][$at_val_id]['price'] != '0') {
            //     $products_options_array[$at_id][$at_val_id]['text'] .= ' (' . ($products_options_array[$at_id][$at_val_id]['prefix']!='='?$products_options_array[$at_id][$at_val_id]['prefix']:'') . strip_tags($currencies->display_price($products_options_array[$at_id][$at_val_id]['price'], tep_get_tax_rate($product_info['products_tax_class_id']))) .') ';
            // }
            // for price in javascript:
            $hidden_string .= '<input id="id_option_other' . $at_val_id . '" type="hidden" name="id_option_other" data-article="' . $products_options_array[$at_id][$at_val_id]['article'] . '" value="' . $products_options_array[$at_id][$at_val_id]['prefix'] . $currencies->display_price(
                $products_options_array[$at_id][$at_val_id]['price'] * $currencies->currencies[$currency]['value'],
                tep_get_tax_rate($product_info['products_tax_class_id']),
                1,
                false
            ) . '">';
        }

        if (count($at_vals) > 1) { // if there is more than 1 value
            if ($pa_id2names[$at_id]['type'] != '0') {
                $optionsArray[] = $at_id;
            }

            if ($pa_id2names[$at_id]['type'] == '0') { // Text
                if ($i < 5) {
                    $i++;
                    // replace values IDs to NAMES
                    foreach ($at_vals as $k => $at_val_id) {
                        $at_vals[$k] = $products_options_array[$at_id][$at_val_id]['text'];
                    }

                    $attr_string .= '<div class="simple_attribute">
                                           ' . $attr_string_begin . '
                                             <td style="text-align:left;">' . implode(', ', $at_vals) . '</td>
                                           ' . $attr_string_end . '
                                         </div>';
                }
            } elseif ($pa_id2names[$at_id]['type'] == '1') {  // Select
                foreach ($at_vals as $key => $at_val_id) {
                    if (
                        getConstantValue('QTY_PRO_ENABLED') == 'true' &&
                        !empty($newAttributeCombinationPart) &&
                        !isset($newAttributeCombinationPart[$at_id][$at_val_id])
                    ) {
                        unset($products_options_array[$at_id][$at_val_id]);
                    }
                }

                $attr_string_select .= '<div class="attr_select">
                                           ' . $attr_string_begin . $hidden_string . '                                         
                                             <td style="text-align:left;">
                                               ' . tep_draw_pull_down_menu(
                                               'id[' . $at_id . ']',
                                               $products_options_array[$at_id],
                                               $selected_attribute,
                                               'class="select_id_option select_attr_select" id="select_id_' . $at_id . '"',
                                               false,
                                               true,
                                               true,
                                               true
                                           ) . '
                                             </td>
                                           ' . $attr_string_end . '
                                          </div>';

                $attributes [] = '{' . $at_id . '}' . $first_attr_value;
            } elseif ($pa_id2names[$at_id]['type'] == '2') {  // Radio
                foreach ($at_vals as $key => $at_val_id) {
                    if (
                        getConstantValue('QTY_PRO_ENABLED') == 'true' &&
                                (
                                    !empty($newAttributeCombinationPart) &&
                                    !isset($newAttributeCombinationPart[$at_id][$at_val_id])
                                )
                    ) {
                        $products_options_array[$at_id][$at_val_id]['class'] = 'attribute-hidden';
//                        unset($products_options_array[$at_id][$at_val_id]);
                    }
                }

                $attr_string_select .= '<div class="attr_select">
                                           ' . $attr_string_begin . $hidden_string . '
                                             <td class="prod_options_radio" style="text-align:left;">
                                                  <div style="display:none;">' . tep_draw_pull_down_menu(
                                               'id[' . $at_id . ']',
                                               $products_options_array[$at_id],
                                               $selected_attribute,
                                               'class="select_id_option" id="select_id_' . $at_id . '"',
                                               false,
                                               true,
                                               true
                                           ) . '</div>
                        ' . tep_draw_radio_select($at_id, $products_options_array[$at_id], $selected_attribute) . '
                                             </td>
                                           ' . $attr_string_end . '
                                          </div>';
                $attributes [] = '{' . $at_id . '}' . $first_attr_value;
            } elseif ($pa_id2names[$at_id]['type'] == '3') {  // Image
                $attr_string_select .= '<div class="attr_select">
                                         ' . $attr_string_begin . $hidden_string . '
                                           <td style="text-align:left;">   
                                            <div id="info" class="color_attributes ' . (MULTICOLOR_ENABLED == 'true' ? 'attributes_type_color' : '') . '">
                                              <div style="display:none;">' . tep_draw_pull_down_menu(
                                                'id[' . $at_id . ']',
                                                $products_options_array[$at_id],
                                                $selected_attribute,
                                                'class="select_id_option select_attr_img" id="select_id_' . $at_id . '"',
                                                false,
                                                true
                                            ) . '</div>
                                              <input type="hidden" name="id_color" value="' . $at_id . '">';
                $attributes [] = '{' . $at_id . '}' . $first_attr_value;

                if (getConstantValue('QTY_PRO_ENABLED') == 'true' && !empty($products_stocks_array)) {
                    if (!empty($at_vals)) {
                        $at_vals = array_flip($at_vals);
                        foreach ($at_vals as $key => $val) {
                            $at_vals[$key] = $val + 1;
                        }
                        $at_vals = array_flip($at_vals);
                        $at_vals[0] = 0;
                        ksort($at_vals);
                    }
                }

                foreach ($at_vals as $key => $at_val_id) {
//                          $paImage = "";
//                          if ($products_options_array[$at_id][$at_val_id]['img']) {
//                              $paImage = $products_options_array[$at_id][$at_val_id]['img'];
//                              if (strpos($products_options_array[$at_id][$at_val_id]['img'], '|')) {
//                                  $paImage = explode('|', $products_options_array[$at_id][$at_val_id]['img'])[0];
//                              }
//                              $paImage = "getimage/151x151/products/" . $paImage;
//                          } elseif ($products_options_array[$at_id][$at_val_id]['image']) {
//                                  $paImage = 'images/50x50/' . $products_options_array[$at_id][$at_val_id]['image'];
//                          }

                    $color_checked = false;
                    $disableClass = '';
                    if (getConstantValue('QTY_PRO_ENABLED') == 'true' && !empty($newAttributeCombinationPart) && !isset($newAttributeCombinationPart[$at_id][$at_val_id])) {
                        $disableClass = 'attribute-hidden ';
                    } elseif ($products_options_array[$at_id][$at_val_id]['qty'] <= 0 && getConstantValue('STOCK_ALLOW_CHECKOUT_WITH_ATTR_COUNT_0', 'true') === 'false') {
                        $disableClass = 'attribute_unselectable ';
                    } else {
                        if ($selected_attribute != false) {
                            $color_checked = ($at_val_id == $selected_attribute) ? true : false;
                        } else {
                            $color_checked = ($key == 0) ? true : false;
                        }
                    }

                    if ($paImage) {
                        $attr_string_select .= '<label class="color_attributes-item ' . $disableClass . ($color_checked ? 'active' : '') .  '">
                                                <input type="radio" name="' . $at_id . '" value="' . $products_options_array[$at_id][$at_val_id]['id'] . '" ' . ($color_checked ? 'checked' : '') . '>' .
                            ($at_val_id == 0 ? '<div class="attribute-text">Все</div>' : '<img width="72" height="72" class="lazyload anim filter-product-image" src="images/pixel_trans.png" data-src="' . $paImage . '" title="' . $products_options_array[$at_id][$at_val_id]['text'] . '" alt="' . $products_options_array[$at_id][$at_val_id]['text'] . '"> 
                            <div class="attribute-text">' . $products_options_array[$at_id][$at_val_id]['text'] . '</div>') .
                            '</label>';
                    } else {
                        $attr_string_select .= '<label class="color_attributes-item ' . $disableClass . ($color_checked ? 'active' : '') . '">
                                                        <input type="radio" name="' . $at_id . '" value="' . $products_options_array[$at_id][$at_val_id]['id'] . '" ' . ($color_checked ? 'checked' : '') . '>' .
                            ($at_val_id == 0 ? 'Все' : '<img width="26" height="26" class="lazyload anim img-circle" src="images/pixel_trans.png" data-src="images/50x50/' . $products_options_array[$at_id][$at_val_id]['image'] . '" title="' . $products_options_array[$at_id][$at_val_id]['text'] . '" alt="' . $products_options_array[$at_id][$at_val_id]['text'] . '">') .
                            '</label>';
                    }

//                          $attr_string_select .= '<label class="color_attributes-item ' . ($color_checked ? 'active' : '') . '">
//                                                    <input type="radio" name="' . $at_id . '" value="' . $products_options_array[$at_id][$at_val_id]['id'] . '" '.($color_checked?'checked':'').'>'.
//                                                    ($at_val_id==0?'Все':'<img width="26" height="26" class="img-circle" src="images/50x50/' . $products_options_array[$at_id][$at_val_id]['image'] . '" title="' . $products_options_array[$at_id][$at_val_id]['text'] . '" alt="' . $products_options_array[$at_id][$at_val_id]['text'] . '">').
//                                                '</label>';
                }

                $attr_string_select .= '</div>
                                          </td>
                                         ' . $attr_string_end . '
                                       </div>';
            }
        } else { // if we have only one value but it has some price
            $attributeOneVal[] = '{' . $at_id . '}' . $at_val_id;

            $attr_string .= '<div style="display:none;">' . $hidden_string . tep_draw_pull_down_menu(
                'id[' . $at_id . ']',
                $products_options_array[$at_id],
                $selected_attribute,
                'class="select_id_option" id="select_id_' . $at_id . '"',
                false,
                true,
                true
            ) . '</div>';

            if ($i < 5) {
                $i++;
                $attr_string .= '<div class="simple_attribute">
                                 ' . $attr_string_begin . '
                                 <td style="text-align:left;">' . $products_options_array[$at_id][$at_vals[0]]['text'] . '</td>
                                 ' . $attr_string_end . '
                               </div>';
            }
        }
    }
    if (!empty($selected_attributes)) {
        $attributes = (array)$selected_attributes;
    }
    if (!empty($attributeOneVal)) {
        $attributes = array_merge($attributes, $attributeOneVal);
    }
    $attributes = implode('', $attributes);
}
