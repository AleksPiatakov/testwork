<div class="checkout_form">
    <?php echo tep_draw_form(
        'checkout',
        tep_href_link(FILENAME_CHECKOUT, '', $request_type),
        'post',
        'id=onePageCheckoutForm'
    ) . tep_draw_hidden_field('action', 'process'); ?>
    <div id="pageContentContainer">

        <?php if (!empty($_GET['payment_error'])) { ?>
            <div class="row">
                <div class="col-sm-12 checkout_error">
                    <?php echo urldecode($_GET['error']); ?>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-sm-4">
                <div id="checkout_cart">
                    <?php include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/checkout_cart.php'); ?>
                </div>
                <div class="orderTotals"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
            </div>
            <div class="col-sm-4">
                <?php

                if (ONEPAGE_ADDRESS_TYPE_POSITION == 'billing_shipping') {
                    ob_start();
                    include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/billing_address.php');
                    $billingAddress_string = ob_get_contents();
                    ob_end_clean();

                    echo $billingAddress_string;
                } else {
                    ob_start();
                    include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/shipping_address.php');
                    $shippingAddress = ob_get_contents();
                    ob_end_clean();

                    echo $shippingAddress;
                }


                // shipping address

                echo '<div class="newsletter">
                ' . tep_draw_checkbox_field(
                    'billing_newsletter',
                    '1',
                    (isset($customerAddress) && $customerAddress['newsletter'] == '1' ? true : true),
                    'id="billing_newsletter"'
                ) . '
                <label for="billing_newsletter">' . ENTRY_NEWSLETTER . '</label>
              </div>';
                ?>
                <input type="checkbox" name="registration-off" id="registration-off">
                <label for="registration-off"><?php echo TEXT_REGISTRATION_OFF; ?></label>

                <input type="checkbox" name="diffShipping" id="diffShipping">
                <label for="diffShipping"><?php echo ONEPAGE_ADDRESS_TYPE_POSITION == 'billing_shipping' ? TEXT_DIFFERENT_BILLING : TEXT_DIFFERENT_SHIPPING; ?></label>
                <?php
                // billing address


                if (ONEPAGE_ADDRESS_TYPE_POSITION == 'billing_shipping') {
                    ob_start();
                    include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/shipping_address.php');
                    $shippingAddress = ob_get_contents();
                    ob_end_clean();

                    echo $shippingAddress;
                } else {
                    ob_start();
                    include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/billing_address.php');
                    $billingAddress_string = ob_get_contents();
                    ob_end_clean();

                    echo $billingAddress_string;
                }

                ?>
            </div>
            <div class="col-sm-4 shippingMethods">
                <?php
                if ($onepage['shippingEnabled'] === true) { //  and tep_count_shipping_modules() > 0
                    ?>
                    <div class="form-group">
                        <!-- SHIPPING METHOD -->
                        <?php
                        if (isset($_SESSION['customer_id'])) {
                            ob_start();
                            include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/shipping_method.php');
                            $shippingMethod = ob_get_contents();
                            ob_end_clean();
                        }
                        $shippingMethod = '<div id="noShippingAddress" class="main noAddress" style="font-size:12px;' . (isset($_SESSION['customer_id']) ? 'display:none;' : '') . '"></div><div id="shippingMethods"' . (!isset($_SESSION['customer_id']) ? ' style="display:none;"' : '') . '>' . $shippingMethod . '</div>';
                        echo $shippingMethod;
                        ?>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <!-- PAYMENT METHOD -->
                    <?php
                    if (isset($_SESSION['customer_id'])) {
                        ob_start();
                        include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/payment_method.php');
                        $paymentMethod = ob_get_contents();
                        ob_end_clean();
                    }
                    $paymentMethod = '<div id="noPaymentAddress" class="main noAddress" style="font-size:12px;' . (isset($_SESSION['customer_id']) ? 'display:none;' : '') . '"></div><div id="paymentMethods"' . (!isset($_SESSION['customer_id']) ? ' style="display:none;"' : '') . '>' . $paymentMethod . '</div>';
                    echo $paymentMethod;
                    ?>
                </div>

                <div class="form-group">
                    <?php echo tep_draw_textarea_field(
                        'comments',
                        'soft',
                        '40',
                        '3',
                        $comments,
                        'class="checkout_inputs form-control" placeholder="' . ENTRY_COMMENT . '"'
                    ); ?>
                </div>
            </div>
        </div>

        <table border="0" width="100%" cellspacing="1" cellpadding="2">
            <tr id="checkoutYesScript" style="display:none;">
                <td align="center">
                    <?php if (ONEPAGE_CHECKOUT_LOADER_POPUP == 'False') { ?>
                        <div id="ajaxLoadingSpinner" style="display:none;"></div>
                        <div id="ajaxMessages" style="display:none;"></div>
                    <?php } ?>
                    <?php
                    $processButtonAvailable = true;
                    if (file_exists(DIR_WS_EXT . 'min_order/min_order.php')) {
                        require_once DIR_WS_EXT . 'min_order/min_order.php';
                        $processButtonAvailable = checkMinimumOrderValue($cart->show_total());
                    }

                    if ($processButtonAvailable) { ?>
                        <div id="checkoutButtonContainer">
                            <span class="btn btn-default" id="checkoutButton"
                                  formUrl="<?php tep_href_link(FILENAME_CHECKOUT_PROCESS, '', $request_type); ?>"
                                  style="cursor: pointer"><?php echo IMAGE_BUTTON_CHECKOUT; ?></span>
                            <input type="hidden" name="formUrl" id="formUrl" value="">
                        </div>
                        <?php
                    } else { // raid ------ minimum order!!!---------------- //
                        echo '<input type="hidden" id="minsum" value="' . MIN_ORDER * $currencies->currencies[$currency]['value'] . '" />';
                        ?>
                        <div id="checkoutButtonContainer_minimal" style="display:none;color:#D40000;">
                            <div class="right" style="opacity:0.3;"></div>
                            <div class="right" style="padding:12px 20px 0 0;"><?php echo TEXT_MIN_SUM; ?>: <b> <span
                                            id="minimal_sum"></span></b> <?php echo($currencies->currencies[$currency]['symbol_left'] ? $currencies->currencies[$currency]['symbol_left'] : $currencies->currencies[$currency]['symbol_right']); ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>

                    <div id="paymentHiddenFields" style="display:none;"></div>
                </td>
            </tr>
        </table>
    </div>

    </form>
</div><!-- /checkout_form -->
