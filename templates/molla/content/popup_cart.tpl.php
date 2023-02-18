<?php if ($cart->count_contents() > 0) { ?>
    <?php echo tep_draw_form(
        'cart_quantity',
        'popup_cart.php?action=update_product',
        'post',
        'id="popup_cart_form"'); ?>
    <?php if (getConstantValue('GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED') === 'true') {
        if (is_file(DIR_WS_EXT . 'google_analytics_and_targets/google_analytics_and_targets.php')) {
            require DIR_WS_EXT . 'google_analytics_and_targets/google_analytics_and_targets.php';
        }
    } ?>
    <script type="text/javascript" src="includes/javascript/bootstrap-number-input.js"></script>
    <script type="text/javascript" src="includes/javascript/lib/jquery.form.js"></script>
    <script>$(function () {
            $('.inputnumber').bootstrapNumber();
        });</script>
    <link rel="stylesheet" href="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/css/popup_cart.css">
    <h1><?php echo HEADING_TITLE; ?></h1>
    <!-- MAIN TABLE -->
    <div id="cartContent-page" class="container">
        <?php if (!isMobile()) { ?>
            <div class="row cartContent_title hidden-xs">
                <div class="col-sm-2">
                    <?php echo TABLE_HEADING_IMAGE; ?>
                </div>
                <div class="col-md-5 col-sm-4 name">
                    <?php echo TABLE_HEADING_NAME; ?>
                </div>
                <div class="col-md-1 col-sm-2 numeric numeric_price">
                    <?php echo TABLE_HEADING_TOTAL; ?>
                </div>

                <div class="col-md-2 col-sm-1 numeric numeric_qua">
                    <?php echo TABLE_HEADING_QUANTITY; ?>
                </div>
                <div class="col-md-2 col-sm-3 numeric numeric_total">
                    <?php echo TABLE_HEADING_TOTAL; ?>
                </div>
            </div>
        <?php } ?>
        <?php //TODO add check $html ?>
        <?php foreach ($html as $key => $value): ?>
            <div class="row cartContent_body">
                <div class="col-sm-2 col-xs-12 product_image"><?php echo '<a href="' . tep_href_link(
                            FILENAME_PRODUCT_INFO,
                            'products_id=' . $value['id']) . '"><img src="getimage/80x80/products/' . $value['image'] . '" class="img-responsive"></a>'; ?></div>
                <div class="col-md-5 col-sm-4 col-xs-12 product_name"><?php echo $value['name'] ?></div>
                <div class="col-md-5 col-sm-6 col-xs-12 cartContent_body-numeric">
                    <div class="row">
                        <div class="col-xs-3 product_price"><?php echo $value['price'] ?></div>
                        <div class="col-xs-4 product_qty">
                            <?php echo '<input type="number" name="cart_quantity[]" value="' . $value['qty'] . '" class="form-control inputnumber" min="1" max="100000" />
                                   <span class="ok btn btn-xs">
                                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg>
                                   </span>
                                   <div style="clear:both"></div>
                                  ' . tep_draw_hidden_field('products_id[]', $value['id']);
                            ?>
                        </div>
                        <div class="col-xs-3 product_total"><?php echo $value['price_full'] ?></div>
                        <div class="col-xs-2 product_delete"><?php echo '<span style="visibility: hidden;">
                                <input style="display:none;" type="checkbox" name="cart_delete[]" value="' . $value['id'] . '">
                             </span>
                             <button class="delete btn btn-sm btn-danger" value="' . urlencode(
                                    $value['id']) . '" data-clearpid="' . current(
                                    explode(
                                        '{',
                                        $value['id'])) . '" title="' . TABLE_HEADING_REMOVE . ' ' . TABLE_HEADING_REMOVE_FROM . '" name="press1" type="button">
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
                                </svg>
                             </button>'; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <!-- END MAIN TABLE -->
        <div class="col-md-6 col-sm-6 col-xs-12 form-inline pull-right text-right total-block">
            <div id="cart_order_total" class="right">
                <?php echo TOTAL_CART . ': <b>' . $currencies->display_price($cart->show_total(), 0) . '</b>'; ?>
            </div>
            <?php echo $stock_text; ?>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="right" class="main">
                        <div class="action_btn">
                            <button class="btn" data-dismiss="modal"
                                    aria-hidden="true"><?php echo BUTTON_CANCEL; ?></button>
                            <a href="<?php echo tep_href_link(FILENAME_CHECKOUT, '', 'SSL'); ?>" id="checkoutButton"
                               class="btn btn-primary"<?= $disabled ?>>
                                <?php echo HEADER_TITLE_CHECKOUT; ?>
                            </a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    </form>
    <?php
} else {
    // Empty shopping cart
    echo '<h2>' . TEXT_CART_EMPTY . '</h2>';
}
?>
