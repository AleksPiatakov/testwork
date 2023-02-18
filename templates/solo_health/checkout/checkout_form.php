<div class="checkout_form container">
    <?php require $template->requireBox('H_LOGO'); ?>
    <div class="header_block">
        <button class="btn_back" onclick="window.history.back()"><?= DEMO2_BTN_COME_BACK; ?></button>
        <div class="h1"><?= HEADING_TITLE; ?></div>
        <div class="left_actions">
            <?php require $template->requireBox('H_LANGUAGES'); ?>
            <?php require $template->requireBox('H_CURRENCIES'); ?>
        </div>
    </div>

    <?php echo tep_draw_form(
        'checkout',
        tep_href_link(FILENAME_CHECKOUT, '', $request_type),
        'post',
        'id=onePageCheckoutForm'
    ) . tep_draw_hidden_field('action', 'process'); ?>
    <div id="pageContentContainer">

        <?php if (!empty($_GET['payment_error'])) { ?>
            <div class="row">
                <div class="col-xs-12 checkout_error">
                    <?php echo urldecode($_GET['error']); ?>
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-lg-7  col-xs-12">

                <div class="collapse_wrapper open">
                    <div class="h3">
                        <span class="num">1</span>
                        <?= TABLE_HEADING_USER; ?>
                        <span class="edit_block collapsed" data-toggle="collapse" data-target="#checkout_user"
                              aria-expanded="true" aria-controls="checkout_user">
                            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M441.9 167.3l-19.8-19.8c-4.7-4.7-12.3-4.7-17 0L224 328.2 42.9 147.5c-4.7-4.7-12.3-4.7-17 0L6.1 167.3c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0l209.4-209.4c4.7-4.7 4.7-12.3 0-17z"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="collapse_wrapper_info short_info" style="display: none" data-parent="#checkout_user">
                        <span data-selector="input[name='shipping_firstname']"></span>
                        <?php if (ACCOUNT_LAST_NAME === 'true') { ?>
                            <span data-selector="input[name='shipping_lastname']"></span>
                        <?php }
                        if (ACCOUNT_TELE === 'true') { ?>
                            (<span data-selector="input[name='billing_telephone']"></span>)
                        <?php } ?>
                        <span data-selector="input[name='billing_email_address']"></span><br>
                        <?php if (ACCOUNT_STREET_ADDRESS === 'true') { ?>
                            <span data-selector="input[name='shipping_street_address']"></span>,
                        <?php }
                        if (ACCOUNT_CITY === 'true') { ?>
                            <span data-selector="input[name='shipping_city']"></span>,
                        <?php }
                        if (ACCOUNT_COUNTRY === 'true') { ?>
                            <span data-selector="select[name='shipping_country']"></span>
                        <?php } ?>
                    </div>
                    <div class="collapse_wrapper_billing_info short_info" style="display: none"
                         data-parent="#checkout_user">
                        <span data-selector="input[name='billing_firstname']"></span>
                        <?php if (ACCOUNT_LAST_NAME === 'true') { ?>
                            <span data-selector="input[name='billing_lastname']"></span>
                        <?php }
                        if (ACCOUNT_STREET_ADDRESS === 'true') { ?>
                            <span data-selector="input[name='billing_street_address']"></span>,<br>
                        <?php }
                        if (ACCOUNT_CITY === 'true') { ?>
                            <span data-selector="input[name='billing_city']"></span>,
                        <?php }
                        if (ACCOUNT_COUNTRY === 'true') { ?>
                            <span data-selector="select[name='billing_country']"></span>
                        <?php } ?>
                    </div>

                    <div id="checkout_user" class="user_block collapse in">
                        <?php if ($customer_id == 0) : ?>
                            <div class="user_header">
                                <div class="checkout_login_block">
                                    <a class="checkout_authorization" href="#">
                                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path>
                                        </svg>
                                        <?php echo NEW_CHECKOUT_LOGIN; ?>
                                    </a>
                                    <?php if (AUTH_MODULE_ENABLED == 'true') : ?>
                                        <?php if (is_file(DIR_WS_EXT . "auth/ajax_loginfb.php") && $template->show('H_LOGIN_FB') and FACEBOOK_AUTH_STATUS == "true"): ?>
                                            <a rel="nofollow"
                                               href="javascript:showLoginvk('<?php echo 'https://www.facebook.com/dialog/oauth/?client_id=' . $fb_app_id . '&amp;display=popup&amp;redirect_uri=' . HTTP_SERVER . '/ext/auth/ajax_loginfb.php&amp;state=' . $fb_state . '&amp;scope=email,public_profile'; ?>');"
                                               class="social_header_facebook">
                                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                    <path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z"></path>
                                                </svg>
                                                <?php echo NEW_CHECKOUT_LOGIN_FB; ?>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (is_file(DIR_WS_EXT . "auth/ajax_login_google.php") && GOOGLE_OAUTH_STATUS == 'true') { ?>
                                            <a rel="nofollow" href="javascript:void(0);"
                                               class="social_header_google googleSigninButton">
                                                <svg id="Capa_1" enable-background="new 0 0 512 512" height="512"
                                                     viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                                    <g>
                                                        <path d="m120 256c0-25.367 6.989-49.13 19.131-69.477v-86.308h-86.308c-34.255 44.488-52.823 98.707-52.823 155.785s18.568 111.297 52.823 155.785h86.308v-86.308c-12.142-20.347-19.131-44.11-19.131-69.477z"
                                                              fill="#fbbd00"/>
                                                        <path d="m256 392-60 60 60 60c57.079 0 111.297-18.568 155.785-52.823v-86.216h-86.216c-20.525 12.186-44.388 19.039-69.569 19.039z"
                                                              fill="#0f9d58"/>
                                                        <path d="m139.131 325.477-86.308 86.308c6.782 8.808 14.167 17.243 22.158 25.235 48.352 48.351 112.639 74.98 181.019 74.98v-120c-49.624 0-93.117-26.72-116.869-66.523z"
                                                              fill="#31aa52"/>
                                                        <path d="m512 256c0-15.575-1.41-31.179-4.192-46.377l-2.251-12.299h-249.557v120h121.452c-11.794 23.461-29.928 42.602-51.884 55.638l86.216 86.216c8.808-6.782 17.243-14.167 25.235-22.158 48.352-48.353 74.981-112.64 74.981-181.02z"
                                                              fill="#3c79e6"/>
                                                        <path d="m352.167 159.833 10.606 10.606 84.853-84.852-10.606-10.606c-48.352-48.352-112.639-74.981-181.02-74.981l-60 60 60 60c36.326 0 70.479 14.146 96.167 39.833z"
                                                              fill="#cf2d48"/>
                                                        <path d="m256 120v-120c-68.38 0-132.667 26.629-181.02 74.98-7.991 7.991-15.376 16.426-22.158 25.235l86.308 86.308c23.753-39.803 67.246-66.523 116.87-66.523z"
                                                              fill="#eb4132"/>
                                                    </g>
                                                </svg>
                                                <?php echo NEW_CHECKOUT_LOGIN_GOOGLE; ?>
                                            </a>
                                        <?php } ?>
                                    <?php endif; ?>
                                </div>
                                <?php $checkboxState = '';
                                if (isset($_SESSION['checkoutCheckboxState']["registration-off"])) {
                                    $checkboxState = ($_SESSION['checkoutCheckboxState']["registration-off"] === 'true') ? 'checked' : '';
                                } ?>
                                <input type="checkbox" name="registration-off"
                                       id="registration-off" <?= $checkboxState; ?>>
                                <label for="registration-off"><?php echo TEXT_REGISTRATION_OFF; ?></label>
                            </div>
                        <?php endif; ?>
                        <div class="checkout_bottom">
                            <?php
                            // shipping address
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

                            ?>
                            <?php $checkboxState = '';
                            if (isset($_SESSION['checkoutCheckboxState']["diffShipping"])) {
                                $checkboxState = ($_SESSION['checkoutCheckboxState']["diffShipping"] === 'true') ? 'checked' : '';
                            } ?>
                            <input type="checkbox" name="diffShipping" id="diffShipping" <?= $checkboxState; ?>>
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

                            <span class="proceed_btn collapsed" data-toggle="collapse" data-target="#checkout_user"
                                  aria-expanded="false"
                                  aria-controls="checkout_user"><?= NEW_CHECKOUT_PROCEED_BTN; ?></span>
                        </div>
                    </div>
                </div>
                <div class="shippingMethods collapse_wrapper">
                    <?php if ($onepage['shippingEnabled'] === true) { //  and tep_count_shipping_modules() > 0
                        echo '<h3>
                                <span class="num">2</span>
                                ' . TABLE_HEADING_SHIPPING_METHOD . '
                                <span class="edit_block" data-toggle="collapse" data-target="#checkout_shipping" aria-expanded="true" aria-controls="checkout_shipping">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M441.9 167.3l-19.8-19.8c-4.7-4.7-12.3-4.7-17 0L224 328.2 42.9 147.5c-4.7-4.7-12.3-4.7-17 0L6.1 167.3c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0l209.4-209.4c4.7-4.7 4.7-12.3 0-17z"></path>
                                    </svg>
                                </span>
                            </h3>';
                        ?>
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

                    <?php } ?>
                </div>

                <div class="paymentMethods collapse_wrapper">
                    <h3>
                        <span class="num">3</span>
                        <?= TABLE_HEADING_PAYMENT_METHOD; ?>
                        <span class="edit_block" data-toggle="collapse" data-target="#checkout_payment"
                              aria-expanded="true" aria-controls="checkout_payment">
                            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M441.9 167.3l-19.8-19.8c-4.7-4.7-12.3-4.7-17 0L224 328.2 42.9 147.5c-4.7-4.7-12.3-4.7-17 0L6.1 167.3c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0l209.4-209.4c4.7-4.7 4.7-12.3 0-17z"></path>
                            </svg>
                        </span>
                    </h3>
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
            </div>
            <div class="col-lg-5 col-xs-12">
                <div id="checkout_cart">
                    <?php include(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/checkout_cart.php'); ?>
                </div>
                <div class="orderTotals"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
                <div class="text-center checkout_btn_block" id="checkoutYesScript" style="display:none;">
                    <?php if (ONEPAGE_CHECKOUT_LOADER_POPUP == 'False') { ?>
                        <div id="ajaxLoadingSpinner" style="display:none;"></div>
                        <div id="ajaxMessages" style="display:none;"></div>
                    <?php } ?>
                    <?php
                    $processButtonAvailable = true;
                    if (file_exists(__DIR__ . '/../../ext/min_order/min_order.php')) {
                        require_once __DIR__ . '/../../ext/min_order/min_order.php';
                        $processButtonAvailable = checkMinimumOrderValue($cart->show_total());
                    }

                    if ($processButtonAvailable) { ?>
                        <div id="checkoutButtonContainer">
                                <span class="btn" id="checkoutButton"
                                      formUrl="<?php tep_href_link(FILENAME_CHECKOUT_PROCESS, '', $request_type); ?>"
                                      style="cursor: pointer">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M435.848 83.466L172.804 346.51l-96.652-96.652c-4.686-4.686-12.284-4.686-16.971 0l-28.284 28.284c-4.686 4.686-4.686 12.284 0 16.971l133.421 133.421c4.686 4.686 12.284 4.686 16.971 0l299.813-299.813c4.686-4.686 4.686-12.284 0-16.971l-28.284-28.284c-4.686-4.686-12.284-4.686-16.97 0z"></path>
                                    </svg>
                                    <?php echo IMAGE_BUTTON_CHECKOUT; ?>
                                </span>
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

                    <?php
                    $termsLink = getArticleUrlByCode('terms_of_use');
                    echo '<span class="terms_of_use">' . TEXT_TERMS_OF_USE_1 . '<span class="ajax_modal_article" data-id="terms_of_use">' . TEXT_TERMS_OF_USE_2 . '</span></span>'; ?>
                </div>
                <?php if (isMobile()) : ?>
                    <div class="mob_short_cart">
                        <span class="scroll_total"></span> <span
                                class="checkout_scroll"><?= IMAGE_BUTTON_CHECKOUT; ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    </form>
</div><!-- /checkout_form -->
