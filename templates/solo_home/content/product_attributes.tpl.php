<?php

$product_attributes = array();
$pa_id2names = array();
$products_options_array = array();

// get all attributes and values for current product:
$products_options_name_query = tep_db_query(
    "select popt.products_options_id, popt.products_options_name, popt.products_options_type, popt.pag, pov.products_options_values_id, pov.products_options_values_name, pov.products_options_values_image, pa.price_prefix, pa.options_values_price, pa.pa_qty from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id=" . (int)$_GET['products_id'] . " and pa.options_id = popt.products_options_id and pa.options_values_id = pov.products_options_values_id and popt.language_id = " . (int)$languages_id . " and pov.language_id = " . (int)$languages_id . " order by popt.pag, popt.products_options_sort_order, pov.products_options_values_sort_order"
); // order by pa.products_options_sort_order
while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
    $product_attributes[$products_options_name['products_options_id']][] = $products_options_name['products_options_values_id'];

    if (MULTICOLOR_ENABLED != 'true' and $products_options_name['products_options_type'] == 4) {
        $products_options_type = 1;
    } else {
        $products_options_type = $products_options_name['products_options_type'];
    }

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
            'qty' => $products_options_name['pa_qty']
        );
}

if (!empty($product_attributes)) {
    $attr_string = '';
    $attr_string_select = '';

    $i = 0;
    foreach ($product_attributes as $at_id => $at_vals) {
        if ($i <= 5) {
            $i++;

            //for price in javascript:
            $hidden_string = '<input class="option_name" type="hidden" name="option_name" value="' . $at_id . '" id="' . $at_id . '">';

            if (isset($cart->contents[$_GET['products_id']]['attributes'][$at_id])) {
                $selected_attribute = $cart->contents[$_GET['products_id']]['attributes'][$at_id];
            } else {
                $selected_attribute = false;
            }

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

            foreach ($at_vals as $at_val_id) {
                // show attribute value price:
                // if ($products_options_array[$at_id][$at_val_id]['price'] != '0') {
                //     $products_options_array[$at_id][$at_val_id]['text'] .= ' (' . ($products_options_array[$at_id][$at_val_id]['prefix']!='='?$products_options_array[$at_id][$at_val_id]['prefix']:'') . strip_tags($currencies->display_price($products_options_array[$at_id][$at_val_id]['price'], tep_get_tax_rate($product_info['products_tax_class_id']))) .') ';
                // }
                // for price in javascript:
                $hidden_string .= '<input id="id_option_other' . $at_val_id . '" type="hidden" name="id_option_other" value="' . $products_options_array[$at_id][$at_val_id]['prefix'] . $currencies->display_price(
                    $products_options_array[$at_id][$at_val_id]['price'] * $currencies->currencies[$currency]['value'],
                    tep_get_tax_rate($product_info['products_tax_class_id']),
                    1,
                    false
                ) . '">';
            }

            if (count($at_vals) > 1) { // if there is more than 1 value
                if ($pa_id2names[$at_id]['type'] == '0') { // Text
                    // replace values IDs to NAMES
                    foreach ($at_vals as $k => $at_val_id) {
                        $at_vals[$k] = $products_options_array[$at_id][$at_val_id]['text'];
                    }

                    $attr_string .= '<div class="simple_attribute">
                                         ' . $attr_string_begin . '
                                           <td style="text-align:left;">' . implode(', ', $at_vals) . '</td>
                                         ' . $attr_string_end . '
                                       </div>';
                } elseif ($pa_id2names[$at_id]['type'] == '1') {  // Select
                    $attr_string_select .= '<div class="attr_select">
                                           ' . $attr_string_begin . $hidden_string . '                                         
                                             <td style="text-align:left;">
                                               ' . tep_draw_pull_down_menu(
                                               'id[' . $at_id . ']',
                                               $products_options_array[$at_id],
                                               $selected_attribute,
                                               'class="select_id_option" id="select_id_' . $at_id . '"',
                                               false,
                                               true
                                           ) . '
                                             </td>
                                           ' . $attr_string_end . '
                                          </div>';
                } elseif ($pa_id2names[$at_id]['type'] == '2') {  // Radio
                    $attr_string_select .= '<div class="attr_select">  
                                           ' . $attr_string_begin . $hidden_string . '
                                             <td class="prod_options_radio" style="text-align:left;">
                                                  <div style="display:none;">' . tep_draw_pull_down_menu(
                                               'id[' . $at_id . ']',
                                               $products_options_array[$at_id],
                                               $selected_attribute,
                                               'class="select_id_option" id="select_id_' . $at_id . '"',
                                               false,
                                               true
                                           ) . '</div>
                                                  ' . tep_draw_radio_select($at_id, $products_options_array[$at_id]) . '
                                             </td>
                                           ' . $attr_string_end . '
                                          </div>';
                } elseif ($pa_id2names[$at_id]['type'] == '4') {  // Image
                    $attr_string_select .= '<div class="attr_select">
                                         ' . $attr_string_begin . $hidden_string . '
                                           <td style="text-align:left;">   
                                            <div id="info" class="color_attributes">
                                              <div style="display:none;">' . tep_draw_pull_down_menu(
                                             'id[' . $at_id . ']',
                                             $products_options_array[$at_id],
                                             $selected_attribute,
                                             'class="select_id_option" id="select_id_' . $at_id . '"',
                                             false,
                                             true
                                         ) . '</div>
                                              <input type="hidden" name="id_color" value="' . $at_id . '">';

                    foreach ($at_vals as $at_val_id) {
                        $attr_string_select .= '<label class="color_attributes-item">
                                                <input type="radio" name="' . $at_id . '" value="' . $products_options_array[$at_id][$at_val_id]['id'] . '" ' . $color_checked . '>
                                                <img width="70" height="90" class="img-circle" src="images/100x100/' . $products_options_array[$at_id][$at_val_id]['image'] . '" alt="">
                                              </label>';
                    }

                    $attr_string_select .= '</div>
                                          </td>
                                         ' . $attr_string_end . '
                                       </div>';
                }
            } else { // if we have only one value but it has some price
                if ($pa_id2names[$at_id]['type'] == '1') {  // Select
                    $attr_string .= '<div style="display:none;">' . $hidden_string . tep_draw_pull_down_menu(
                        'id[' . $at_id . ']',
                        $products_options_array[$at_id],
                        $selected_attribute,
                        'class="select_id_option" id="select_id_' . $at_id . '"',
                        false,
                        true
                    ) . '</div>';
                }

                $attr_string .= '<div class="simple_attribute">
                               ' . $attr_string_begin . '
                               <td style="text-align:left;">' . $products_options_array[$at_id][$at_vals[0]]['text'] . '</td>
                               ' . $attr_string_end . '
                             </div>';
            }
        }
    }
}
