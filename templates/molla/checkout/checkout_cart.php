<?php

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOPPING_CART);

if ($cart->count_contents() > 0) { ?>
    <h3><?php echo TABLE_HEADING_PRODUCTS; ?></h3>
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
        $products_name = '<a href="' . tep_href_link(
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
        ) . '"><img src="getimage/80x80/products/' . $products_image[0] . '"></a>';

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
        $html[$cur_row]['delete'] = '<button class="delete btn btn-sm btn-danger" data-price-orign="' . number_format(
            $products[$i]['final_price'],
            2
        ) . '" data-quantity="' . $products[$i]['quantity'] . '" data-clear-price="' . $html[$cur_row]['clear_price_full'] . '" value="' . $products[$i]['id'] . '" title="delete ' . htmlspecialchars(
            $products[$i]['name']
        ) . ' "type="button">
    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
    </svg>
    </button>';
    }

    ?>
    <!-- MAIN TABLE -->
    <div class="checkout_right_cart">
        <?php foreach ($html as $key => $value) : ?>
            <div class="checkout__cart_item row">
                <div class="checkout__item_image col-xs-4">
                    <?php echo $value['image'] ?>
                </div>
                <div class="checkout__item_name col-xs-8">
                    <?php echo $value['name'] ?>
                    <div class="checkout__purchase_price">
                        <?php if ($value['price'] != '-' && $value['price_full'] != '-') {
                            echo $value['qty'] ?>* <?php echo $value['price'] ?> =
                        <b><?php echo $value['price_full'] . "</b>";
                        } ?>
                            <br/><br/>
                            <?php echo $value['delete'] ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- END MAIN TABLE -->

    <?php
} else {
    echo 'empty';
    exit;
}
?>

<?php if (CUPONES_MODULE_ENABLED == 'true') {
    $order_totals = $order_total_modules->process();
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
    <div class="row">
        <div class="col-sm-12 text-left">
            <div class="form-group set_coupon">
                <?php echo tep_draw_input_field(
                    'gv_redeem_code',
                    $r_mycode,
                    'class="form-control coupon_input" placeholder="' . SUB_TITLE_COUPON . '"'
                ); ?>
                <a href="javascript:" class="btn btn-default btn-sm"
                   id="voucherRedeem"><?php echo SUB_TITLE_COUPON_SUBMIT; ?></a>
            </div>
            <?php echo $coupon_text; ?>
        </div>
    </div>
    <div class="text-center checkout-comments">
        <?php $checkboxState = (isset($_SESSION['checkoutCheckboxState']["showComments"]) && $_SESSION['checkoutCheckboxState']["showComments"] === 'true') ? 'checked' : ''; ?>
        <input type="checkbox" id="showComments" <?= $checkboxState; ?> />
        <label for="showComments"><?= ADD_COMMENT; ?></label>
        <?php $commentsParam = $checkboxState ? 'active' : '';?>
        <div class="comments-wrap <?= $commentsParam?>">
            <?php echo tep_draw_textarea_field('comments', '', 60, 5, '', 'placeholder="'.ENTRY_COMMENT.'"', false); ?>
        </div>
    </div>
<?php } ?>
