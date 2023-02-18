<?php if ($cart->count_contents() > 0) { ?>
    <?php echo tep_draw_form(
        'cart_quantity',
        'popup_cart.php?action=update_product',
        'post',
        'id="popup_cart_form"'
    ); ?>
    <!-- MAIN TABLE -->
    <div id="cartContent-page" class="container">
        <?php //TODO add check $html ?>
        <?php foreach ($html as $key => $value) : ?>
            <div class="row cartContent_body">
                <div class="product_image">
                    <?php echo '<a href="' . tep_href_link(
                        FILENAME_PRODUCT_INFO,
                        'products_id=' . $value['id']
                    ) . '"><img src="getimage/80x80/products/' . $value['image'] . '" class="img-responsive"></a>'; ?>
                </div>
                <div class="main_block_cart">
                    <div class="product_name">
                        <?php echo $value['name'] ?>
                    </div>
                    <div class="product_qty">
                        <?php echo '<input class="inputnumber" type="text" name="cart_quantity[]" value="' . $value['qty'] . '" onkeyup="this.value = this.value.replace (/\D/, \'\')" min="1" max="100000" />'
                            . tep_draw_hidden_field('products_id[]', $value['id']);
                        echo '<span class="once_price">x&nbsp;' . $value['price'] . '&nbsp;=&nbsp;</span><span class="sum_input">' . $value['price_full'] . '</span>';
                        ?>
                    </div>
                </div>
                <div class="product_delete">
                    <?php echo '<span style="visibility: hidden;">
                                    <input style="display:none;" type="checkbox" name="cart_delete[]" value="' . $value['id'] . '">
                                 </span>
                                 <button class="delete" value="' . urlencode(
                                        $value['id']
                                    ) . '" data-clearpid="' . current(
                                        explode(
                                            '{',
                                            $value['id']
                                        )
                                    ) . '" title="' . TABLE_HEADING_REMOVE . ' ' . TABLE_HEADING_REMOVE_FROM . '" name="press1" type="button">
                                 </button>';
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="row cartContent_footer">
            <?php echo $stock_text; ?>
            <div class="col-6 pr-0">
                <div id="cart_order_total">
                    <?php echo TOTAL_CART . ': <b>' . $currencies->format($cart->show_total()) . '</b>'; ?>
                </div>
            </div>
            <div class="col-6 pl-0">
                <div class="action_btn">
                    <a class="btn btn_main" href="<?php echo tep_href_link(FILENAME_CHECKOUT, '', 'SSL'); ?>"
                       id="checkoutButton" <?= $disabled ?>>
                        <?php echo HEADER_TITLE_CHECKOUT; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    </form>
    <?php
} else {
    // Empty shopping cart
    echo '<p class="empty_basket">' . DEMO2_TEXT_CART_EMPTY . '</p>';
}
?>
