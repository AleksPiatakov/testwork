<?php

echo '<div id="checkout_shipping" class="shipping_payment_block collapse ' . ($openTab == 'true' ? 'in' : '') . '">';

$quotes = $shipping_modules->quote();
$productsFreeShip = $order->info['free_ship'] == '1' ? true : false;
if (!tep_session_is_registered('shipping') || (tep_session_is_registered(
            'shipping') && ($shipping == false) && (tep_count_shipping_modules() > 1))) {
    if (tep_session_is_registered('shipping')) {
        tep_session_unregister('shipping');
    }
    tep_session_register('shipping');
    $shipping = $shipping_modules->cheapest();
}
?>
<?php
if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
    ?>
    <div class="row">
        <div class="col-sm-12"><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></div>
    </div>
    <?php
} elseif ($free_shipping == false) {
    ?>
    <div class="row">
        <div class="col-sm-12"><?php //echo TEXT_ENTER_SHIPPING_INFORMATION; ?></div>
    </div>
<?php } ?>

<?php if ($free_shipping == true) {
    ?>
    <div class="row">
        <div class="col-sm-8"><?php echo FREE_SHIPPING_TITLE; ?></div>
        <div class="col-sm-4"><?php echo $quotes[$i]['icon']; ?></div>
    </div>
    <div class="row">
        <div class="col-sm-12"><?php echo sprintf(
                    FREE_SHIPPING_DESCRIPTION,
                    $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . tep_draw_hidden_field(
                    'shipping',
                    'free_free'); ?></div>
    </div>

<?php } else { ?>
    <?php
    $checked_arr = array_filter($quotes, function ($arr) use ($order) {
        return $order->info['shipping_method'] == $arr['module'] && !isset($arr['error']);
    });
    if ($checked_arr) {
        $checked_arr = array_keys($checked_arr);
        $checked_key = reset($checked_arr);
    } else {
        $onePageCheckout->setShippingMethod($quotes[0]["id"] . '_' . $quotes[0]["id"]);
        $order = new order;
        $quotes = $shipping_modules->quote();
    }
    ?>
    <?php
    for ($i = 0, $n = sizeof($quotes); $i < $n; $i++) {
//            if(isset($quotes[$i]['methods']) && count($quotes[$i]['methods'])>1) echo '<div class="row shippingModuleHeadingRow"><div class="col-sm-12"><b class="checkout_ship_header">'.$quotes[$i]['module'].':</b></div>';
        if (isset($quotes[$i]['methods']) && count($quotes[$i]['methods']) > 1) {
            echo '<div class="' . $quotes[$i]['module'] . '">';
        }
        if (isset($quotes[$i]['error'])) {
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <span class="checkout_error"><span></span><?php echo sprintf(
                            TEXT_ERROR_SHIPPING_METHOD,
                            $quotes[$i]['module']);//$quotes[$i]['error'];
                        ?></span> <span class="hidden"><?php echo $quotes[$i]['error'] ?></span>
                </div>
            </div>
            <?php
        } else {
            for ($j = 0, $n2 = sizeof($quotes[$i]['methods']); $j < $n2; $j++) {
                //                if($i==0) $checked = true;
                //                else $checked = false;
                if ($checked_arr) {
                    $checked = $i == $checked_key ? true : false;
                } else {
                    $checked = $i == 0 ? true : false;
                }

                $radio_val = $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'];
                ?>
                <div class="row moduleRow shippingRow<?php echo($checked ? ' moduleRowSelected' : ''); ?>" data-module="<?= $quotes[$i]['id']; ?>">
                    <div class="col-xs-9">
                        <div class="form-group">
                            <?php echo tep_draw_radio_field(
                                'shipping',
                                $radio_val,
                                $checked,
                                'id="radio_' . $radio_val . '"'); ?>
                            <label for="radio_<?php echo $radio_val; ?>"><?php echo $quotes[$i]['methods'][$j]['title'] ?: $quotes[$i]['module']; ?></label>
                            <?php if (isset($quotes[$i]['icon']) && tep_not_null($quotes[$i]['icon'])) {
                                echo $quotes[$i]['icon'];
                            } ?>
                        </div>
                    </div>

                    <div class="col-xs-3 text-right">
                        <div class="form-group radio_<?= $radio_val; ?>">
                            <?php
                            $show_shipping_cost_status = getConstantValue('MODULE_SHIPPING_NWPOSHTANEW_SHOW_SHIPPING_COST_STATUS');
                            if (($n > 1) || ($n2 > 1)) {
                                if ($productsFreeShip) {
                                    echo TEXT_PRODUCT_INFO_FREE_SHIPPING;
                                } elseif ($radio_val === 'nwposhtanew_nwposhtanew' && $show_shipping_cost_status === 'false') {
                                    //empty cost
                                } elseif (!empty($quotes[$i]['methods'][$j]['cost_text'])) {
                                    echo $quotes[$i]['methods'][$j]['cost_text'];
                                } else {
                                    echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0)));
                                }
                            } else {
                                if ($checked) {
                                    $shipping_actual_tax = $quotes[$i]['tax'] / 100;
                                    $shipping_tax = $shipping_actual_tax * $quotes[$i]['methods'][$j]['cost'];

                                    $shipping['cost'] = $quotes[$i]['methods'][$j]['cost'];
                                    $shipping['shipping_tax_total'] = $shipping_tax;
                                    if (isset($onepage['info']['shipping_method']['cost'])) {
                                        $onepage['info']['shipping_method']['cost'] =
                                            $quotes[$i]['methods'][$j]['cost'];
                                        $onepage['info']['shipping_method']['shipping_tax_total'] =
                                            $shipping_tax;
                                    }
                                }

                                if ($productsFreeShip) {
                                    echo TEXT_PRODUCT_INFO_FREE_SHIPPING;
                                } elseif ($radio_val == 'nwposhtanew_nwposhtanew' && $show_shipping_cost_status == 'false') {
                                    //empty cost
                                } elseif (!empty($quotes[$i]['methods'][$j]['cost_text'])) {
                                    echo $quotes[$i]['methods'][$j]['cost_text'];
                                } else {
                                    echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) .
                                        tep_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']);
                                }
                            } ?>
                        </div>
                    </div>
                    <div class="col-xs-12 shipping_methods_block">
                        <?php if (isset($quotes[$i]['methods'][$j]['html'])) {
                            echo $quotes[$i]['methods'][$j]['html'];
                        }

                        //display shipToFields
                        if ($checked) {
                            $html = '';
                            $shippingCode = strtoupper($quotes[$i]['id']);
                            //collect fields in DB
                            $fieldsInDB = [];
                            $query = tep_db_query("SELECT s2f.id, s2f.field_allowed, s2f.field_required, s2f.min_length, s2fd.field_title
                                    FROM " . TABLE_SHIP2FIELDS . " s2f 
                                    LEFT JOIN " . TABLE_SHIP2FIELDS_DESCRIPTION . " s2fd ON s2fd.id = s2f.id
                                    WHERE s2f.shipping_code = '" . $shippingCode . "' and s2fd.language_id=" . $languages_id);
                            while ($row = tep_db_fetch_array($query)) {
                                $fieldsInDB[$row['id']] = $row;
                            }
                            if (!empty($fieldsInDB)) {
                                foreach ($fieldsInDB as $fieldData) {
                                    if ($fieldData['field_allowed']) {
                                        $placeholder = $fieldData['field_title'];

                                        $required = $fieldData['field_required'] ? ' required' : '';

                                        $html .= '<div class="selectize-control single' . $required . '">' .
                                            tep_draw_input_field('shipping_fields[' . $fieldData['id'] . ']', '',
                                                'class="checkout_inputs form-control' . $required . '" 
                                                data-shipment="' . strtolower($shippingCode) . '" placeholder="' . $placeholder . '" 
                                                style="border: 1px solid rgb(239, 239, 239); background: rgb(255, 255, 255); height: auto;"') .
                                            '</div>';
                                    }
                                }
                            }
                            echo $html;
                        } ?>
                    </div>
                </div>

                <?php
            }
            if (count($quotes[$i]['methods']) > 1) {
                echo '</div>';
            }
        }
    }
}
?>
<span class="proceed_btn collapsed" data-toggle="collapse" data-target="#checkout_shipping" aria-expanded="false"
      aria-controls="checkout_shipping"><?= NEW_CHECKOUT_PROCEED_BTN; ?></span>
</div>
<div class="collapse_wrapper_info short_info" style="display: none" data-parent="#checkout_shipping">
    <span data-selector="input[name='shipping']:checked"></span>
</div>
