<?php if ($cart->count_contents() > 0) { ?>

    <?php echo tep_draw_form(
        'cart_quantity',
        'popup_cart.php?action=update_product',
        'post',
        'id="popup_cart_form"'); ?>
    <h1><?php echo HEADING_TITLE; ?></h1>

    <div class="products-list row" id="cartContent-page">
        <div class="col-md-12 products-list-body">
            <?php foreach ($html as $key => $value): ?>
                <div class="col-md-6">
                    <div class="item">
                        <div class="content">
                            <div class="product_image"><?php echo '<a href="' . tep_href_link(
                                        FILENAME_PRODUCT_INFO,
                                        'products_id=' . $value['id']) . '"><img src="getimage/160x160/products/' . $value['image'] . '" ></a>'; ?></div>
                            <div class="body">
                                <div class="product_name"><?php echo $value['name'] ?></div>
                                <div class="product_price"><?php echo $value['price'] ?></div>
                                <div class="product_qty"><?php echo '<input type="number" value="' . $value['qty'] . '" class="form-control inputnumber" autocomplete="off" step="1" min="1" max="100000" name="cart_quantity[]" size="4" pattern="[0-9]*" inputmode="numeric">' .
                                        tep_draw_hidden_field('products_id[]', $value['id']); ?><span
                                            class="sign">x</span>
                                </div>
                                <div class="product_total">
                                    <span class="refresh_total"><i class="fa fa-refresh fa-spin"></i></span>
                                    <?php echo $value['price_full'] ?>
                                </div>
                                <div class="product_delete"><?php echo '<span style="visibility: hidden;"><input style="display:none;" type="checkbox" name="cart_delete[]" value="' . $value['id'] . '"></span>
                                                                          <button class="delete btn btn-sm btn-danger" value="' . urlencode(
                                            $value['id']) . '" data-clearpid="' . current(
                                            explode(
                                                '{',
                                                $value['id'])) . '" title="' . TABLE_HEADING_REMOVE . ' ' . TABLE_HEADING_REMOVE_FROM . '" name="press1" type="button">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                                <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                                                                            </svg>
                                                                          </button>'; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="checkout-actions row">
        <div class="col-md-12">
            <div class="col-md-6 pull-right">
                <div class="actions-buttons">
                    <button class="btn" data-dismiss="modal"
                            aria-hidden="true"><?php echo IMAGE_BUTTON_CONTINUE; ?></button>
                    <a href="<?php echo tep_href_link(FILENAME_CHECKOUT, '', 'SSL'); ?>" id="checkoutButton"
                       class="btn btn-primary<?= $disabled ?>"><?php echo HEADER_TITLE_CHECKOUT; ?></a>
                </div>
            </div>
            <div class="col-md-6 pull-left">
                <div id="cart_order_total" class="cart_order_total">
                    <?php echo TOTAL_CART . ': <b>' . $currencies->format($cart->show_total()) . '</b>'; ?>

                    <?php echo $stock_text; ?>
                </div>
            </div>
        </div>
    </div>

    </form>
    <?php
} else {
    // Empty shopping cart
    echo '<h2>' . TEXT_CART_EMPTY . '</h2>';
    echo '<div class="text-center"><button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">' . IMAGE_BUTTON_CONTINUE . '</button></div>';
}
?>
