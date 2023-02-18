<?php

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOPPING_CART);

if ($cart->count_contents() > 0) { ?>
    <h3>
        <span class="num">4</span><?php echo TABLE_HEADING_PRODUCTS . '<span class="cart_count">(' . $cart->count_contents() . ')</span>'; ?>
    </h3>
    <?php

    $info_box_contents = array();
    $any_out_of_stock = 0;
    $products = $cart->get_products();
    for ($i = 0, $n = sizeof($products); $i < $n; $i++) {
        $r_prodid[$i] = preg_replace('/{/', '_', $products[$i]['id']);
        $r_prodid[$i] = preg_replace('/}/', '_', $r_prodid[$i]);

        // Push all attributes information in an array
        if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
            foreach ($products[$i]['attributes'] as $option => $value) {
                $attributes = tep_db_query(
                    "SELECT 
                                    popt.products_options_name, 
                                    poval.products_options_values_name, 
                                    pa.options_values_price, 
                                    pa.price_prefix
                                  FROM " . TABLE_PRODUCTS_OPTIONS . " popt, " .
                    TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " .
                    TABLE_PRODUCTS_ATTRIBUTES . " pa
                                  WHERE pa.products_id = '" . $products[$i]['id'] . "'
                                    and pa.options_id = '" . $option . "'
                                    and pa.options_id = popt.products_options_id
                                    and pa.options_values_id = '" . (int)$value . "'
                                    and pa.options_values_id = poval.products_options_values_id
                                    and popt.language_id = '" . $languages_id . "'
                                    and poval.language_id = '" . $languages_id . "'"
                );

                $attributes_values = tep_db_fetch_array($attributes);
                if ($value == PRODUCTS_OPTIONS_VALUE_TEXT_ID) {
                    echo tep_draw_hidden_field(
                        'id[' . $products[$i]['id'] . '][' . TEXT_PREFIX . $option . ']',
                        $products[$i]['attributes_values'][$option]
                    );
                    $attr_value = $products[$i]['attributes_values'][$option];
                } else {
                    echo tep_draw_hidden_field('id[' . $products[$i]['id'] . '][' . $option . ']', $value);
                    $attr_value = $attributes_values['products_options_values_name'];
                }

                $products[$i][$option]['products_options_name'] = $attributes_values['products_options_name'];
                $products[$i][$option]['options_values_id'] = $value;
                $products[$i][$option]['products_options_values_name'] = $attr_value;
                $products[$i][$option]['options_values_price'] = $attributes_values['options_values_price'];
                $products[$i][$option]['price_prefix'] = $attributes_values['price_prefix'];
            }
        }
    }

    for ($i = 0, $n = sizeof($products); $i < $n; $i++) {
        if (($i / 2) == floor($i / 2)) {
            $info_box_contents[] = array('params' => '');
        } else {
            $info_box_contents[] = array('params' => '');
        }

        $cur_row = sizeof($info_box_contents) - 1;
        $products_name = '<a class="cart_prod_name product-id-' . $products[$i]['id'] . '" href="' . tep_href_link(
            FILENAME_PRODUCT_INFO,
            'products_id=' . $products[$i]['id']
        ) . '">' . $products[$i]['name'] . '</a>';

        if (STOCK_CHECK == 'true') {
            $stock_check = tep_check_stock($products[$i]['id'], $products[$i]['quantity']);
            if (tep_not_null($stock_check)) {
                $any_out_of_stock = 1;
                $products_name .= $stock_check;
            }
        }

        if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
            reset($products[$i]['attributes']);
            $products_name .= '<ul class="attributes_list">';
            foreach ($products[$i]['attributes'] as $option => $value) {
                $products_name .= '<li><span>' . $products[$i][$option]['products_options_name'] . '</span> : ' . $products[$i][$option]['products_options_values_name'] . '</li>';
            }
            $products_name .= '</ul>';
        }

        // Explode first image of product
        $products_image = explode(';', $products[$i]['image']);
        $html[$cur_row]['image'] = '<a href="' . tep_href_link(
            FILENAME_PRODUCT_INFO,
            'products_id=' . $products[$i]['id']
        ) . '"><img src="getimage/40x40/products/' . $products_image[0] . '"></a>';

        $html[$cur_row]['id'] = $products[$i]['id'];
        $html[$cur_row]['name'] = $products_name;
        $html[$cur_row]['price'] = $currencies->display_price(
            $products[$i]['final_price'],
            tep_get_tax_rate($products[$i]['tax_class_id'])
        );
        $html[$cur_row]['qty'] = $products[$i]['quantity'];
        $html[$cur_row]['price_full'] = $currencies->display_price(
            $products[$i]['final_price'],
            tep_get_tax_rate($products[$i]['tax_class_id']),
            $products[$i]['quantity']
        ) . '</b>';
        $html[$cur_row]['clear_price_full'] = $currencies->display_price(
            $products[$i]['final_price'] * $currencies->currencies[$currency]['value'],
            tep_get_tax_rate($products[$i]['tax_class_id']),
            $products[$i]['quantity'],
            false
        );
        $html[$cur_row]['delete'] = '<button class="delete" value="' . $products[$i]['id'] . '" title="delete ' . htmlspecialchars($products[$i]['name']) . ' "type="button">
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z"></path>
                                </svg>
                                </button>';
    }

    ?>
    <!-- MAIN TABLE -->
    <div class="checkout_cart_block">
        <?php foreach ($html as $key => $value) : ?>
            <div class="checkout_cart_item" data-id="<?= $value["id"] ?>">
                <?php echo $value['image'] ?>
                <div class="cart_item_info">
                    <?php echo $value['name'] ?>
                    <div class="cart_calc_cost">
                        <input type="hidden" name="products_id[]" value="<?= $value['id'] ?>">
                        <input type="number" value="<?= $value['qty'] ?>"
                               class="checkout_qty input-checkout-prod-quantity product-id-<?= $value['id'] ?>"
                               autocomplete="off" step="1" min="1" max="100000" name="cart_quantity[]" size="2"
                               pattern="[0-9]*" inputmode="numeric">
                        <!--                        --><?php //echo '<input type="number" value="'.$value['qty'].'" class="form-control inputnumber" autocomplete="off" step="1" min="1" max="100000" name="cart_quantity[]" size="4" pattern="[0-9]*" inputmode="numeric">' .
                        //                            tep_draw_hidden_field('products_id[]', $value['id']);
                        if ($value['price'] != '-' && $value['price_full'] != '-') {
                            echo ' х ' . $value['price'] ?> = <b
                                    class="price-full-<?= $value['id'] ?>"><?php echo $value['price_full'] ?></b>
                        <?php } ?>
                    </div>
                </div>
                <?php echo $value['delete'] ?>
            </div>
        <?php endforeach; ?>
        <?php if ($any_out_of_stock == 1) : ?>
            <div class="warning_mess">
                <?= sprintf(
                    OUT_OF_STOCK_CAN_CHECKOUT,
                    STOCK_MARK_PRODUCT_OUT_OF_STOCK,
                    STOCK_MARK_PRODUCT_OUT_OF_STOCK
                ); ?>
            </div>
        <?php endif; ?>
    </div>
    <!-- END MAIN TABLE -->

    <?php
} else {
    echo 'empty';
    exit;
}
?>

<div class="coupon_newsletter_block">
    <?php
    $checkboxState = true;
    if ($_SESSION['checkoutCheckboxState']['billing_newsletter']) {
        $checkboxState = ($_SESSION['checkoutCheckboxState']["billing_newsletter"] === 'true') ? true : false;
    }
    ?>
    <?php echo '<div class="newsletter">
        ' . tep_draw_checkbox_field('billing_newsletter', '1', $checkboxState, 'id="billing_newsletter"') . '
        <label for="billing_newsletter">' . ENTRY_NEWSLETTER . '</label>
    </div>';
    ?>

    <?php if (CUPONES_MODULE_ENABLED == 'true') {
        $order_totals = $order_total_modules->process();
        if (isset($ot_coupon) && $ot_coupon->coupon_code && !isset($_POST['gv_redeem_code'])) {
            $_POST['gv_redeem_code'] = $ot_coupon->coupon_code;
        }
        include_once('ext/coupons/coupon_cart.php');
        /*
           if (MODULE_ORDER_TOTAL_COUPON_STATUS == 'true'){
             // Start - CREDIT CLASS Gift Voucher Contribution
             if ($credit_covers) $paymentMethod = 'credit_covers';
             unset($_POST['gv_redeem_code']);
             $order_total_modules->collect_posts();
             $order_total_modules->pre_confirmation_check();
             // End - CREDIT CLASS Gift Voucher Contribution
           }  */
        ?>

        <!--    <span class="btn btn-default btn_coupon popup_cart"><?php // echo TEXT_HAVE_COUPON_KGT; ?></span> -->
        <?php $checkboxState = '';
        if (isset($_SESSION['checkoutCheckboxState']["show_coupon"])) {
            $checkboxState = ($_SESSION['checkoutCheckboxState']["show_coupon"] === 'true') ? 'checked' : '';
        } ?>
        <div class="coupon_block">
            <input type="checkbox" id="show_coupon" <?= $checkboxState; ?>>
            <label for="show_coupon"><?= NEW_CHECKOUT_COUPON_TEXT; ?></label>
            <div class="set_coupon <?= $checkboxState ? 'show_set_coupon' : '' ?>">
                <?php echo tep_draw_input_field(
                    'gv_redeem_code',
                    $r_mycode,
                    'class="form-control coupon_input" placeholder="' . NEW_CHECKOUT_COUPON_INPUT_TEXT . '"'
                ); ?>
                <a href="javascript:" class="apply_btn" id="voucherRedeem"><?php echo SUB_TITLE_COUPON_SUBMIT; ?></a>

                <?php echo $coupon_text; ?>
            </div>
        </div>
    <?php } ?>
    <div class="text-center checkout-comments">
        <?php $checkboxState = (isset($_SESSION['checkoutCheckboxState']["showComments"]) && $_SESSION['checkoutCheckboxState']["showComments"] === 'true') ? 'checked' : ''; ?>
        <input type="checkbox" id="showComments" <?= $checkboxState; ?> />
        <label for="showComments"><?= ADD_COMMENT; ?></label>
        <?php $commentsParam = $checkboxState ? 'active' : '';?>
        <div class="comments-wrap <?= $commentsParam?>">
            <?php echo tep_draw_textarea_field('comments', '', 60, 5, '', 'placeholder="'.ENTRY_COMMENT.'"', false); ?>
        </div>
    </div>
</div>
