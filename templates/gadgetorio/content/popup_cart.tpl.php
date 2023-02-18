<?php if ($cart->count_contents() > 0) { ?>
    <?php echo tep_draw_form(
        'cart_quantity',
        'popup_cart.php?action=update_product',
        'post',
        'id="popup_cart_form"'
    ); ?>
    <h1><?php echo HEADING_TITLE; ?></h1>

    <div class="products-list row" id="cartContent-page">
        <div class="col-md-12 products-list-body">
            <?php foreach ($html as $key => $value) : ?>
                <div class="col-md-6">
                    <div class="item">
                        <div class="content">
                            <div class="product_image"><?php echo '<a href="' . tep_href_link(
                                        FILENAME_PRODUCT_INFO,
                                        'products_id=' . $value['id']
                                    ) . '"><img src="getimage/160x160/products/' . $value['image'] . '" ></a>'; ?></div>
                            <div class="body">
                                <div class="product_name"><?php echo $value['name'] ?></div>
                                <div class="product_price"><?php echo $value['price'] ?></div>
                                <div class="product_qty"><?php echo '<input type="number" value="' . $value['qty'] . '" class="form-control inputnumber" autocomplete="off" step="1" min="1" max="100000" name="cart_quantity[]" size="4" pattern="[0-9]*" inputmode="numeric">' .
                                        tep_draw_hidden_field('products_id[]', $value['id']); ?><span
                                            class="sign">x</span>
                                </div>
                                <div class="product_total">
                                      <span class="refresh_total">
                                          <svg class="fa-spin" role="img" xmlns="http://www.w3.org/2000/svg"
                                               viewBox="0 0 512 512">
                                              <path d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z"></path>
                                          </svg>
                                      </span>
                                    <?php echo $value['price_full'] ?>
                                </div>
                                <div class="product_delete">
                                    <?php echo '<span style="visibility: hidden;"><input style="display:none;" type="checkbox" name="cart_delete[]" value="' . $value['id'] . '"></span>
                                                  <button class="delete btn btn-sm btn-danger" value="' . urlencode(
                                            $value['id']
                                        ) . '" data-clearpid="' . current(
                                            explode(
                                                '{',
                                                $value['id']
                                            )
                                        ) . '" title="' . TABLE_HEADING_REMOVE . ' ' . TABLE_HEADING_REMOVE_FROM . '" name="press1" type="button">
                                                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                                                    </svg>
                                                  </button>' ?></div>
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
                    <button class="btn continue-btn" data-dismiss="modal"
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
