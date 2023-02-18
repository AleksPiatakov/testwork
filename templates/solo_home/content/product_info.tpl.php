<?php

if (tep_not_null($product_info['manufacturers_id'])) {
    $manufacturers_info = get_manufacturer_info($product_info['manufacturers_id']);
    if (!empty($manufacturers_info)) {
        $product_manufacturer_image = 'getimage/80x80/' . ($manufacturers_info['image'] ?: 'default.png');
        $product_manufacturer_name = strtolower($manufacturers_info['name']);
        $product_manufacturer_href = tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $manufacturers_info['mid']);
    }
}
echo tep_draw_form(
    'cart_quantity',
    tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action', 'language')) . 'action=add_product'),
    'post',
    'data-cart-key="' . $cart_key . '"'
);

?>

<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-lg-6 col-md-7 col-sm-7 col-xs-12">
                <!-- PRODUCT INFO SLIDER -->
                <div class="slider_product_card">
                    <div class="additional_images2">
                        <?php include(DIR_WS_MODULES . 'additional_images2.php'); ?>
                    </div>
                </div>
                <!-- END PRODUCT INFO SLIDER -->
            </div>

            <!-- PRODUCT INFO DESCRIPTION -->
            <div class="col-lg-5 col-lg-offset-1 col-md-5 col-sm-5 col-xs-12">
                <div class="row description_card_product">
                    <div class="col-xs-6 logo_manufacturers">
                        <?php if (($product_info['manufacturers_id']) != 0 && !empty($manufacturers_info)) { ?>
                            <a href="<?= $product_manufacturer_href ?>">
                                <img src="<?= $product_manufacturer_image ?>" alt="<?= $product_manufacturer_name ?>">
                            </a>
                        <?php } else { ?>
                            <div></div>
                        <?php } ?>
                    </div>
                    <div class="col-xs-6 block_social_sheare_compare">
                        <?php if (SOCIAL_WIDGETS_ENABLED == 'true' and $template->show('P_SHARE')) : ?>
                            <?php $config = $template->checkConfig('PRODUCT_INFO', 'P_SHARE'); ?>
                            <div class="social_group_product">
                                <?php if ($config['facebook']['val']) { ?>
                                <a rel="nofollow"
                                   href="<?php echo $config['facebook']['val'] . HTTP_SERVER . $_SERVER['REQUEST_URI']; ?>"
                                   class="social_facebook">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                                    </svg>
                                </a>
                                <?php } ?>
                                <?php if ($config['telegram']['val']) { ?>
                                    <a rel="nofollow" href="<?php echo $config['telegram']['val'] . HTTP_SERVER . $_SERVER['REQUEST_URI']; ?>"
                                       class="social_telegram">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="52 0 460 560" class="svg-inline--fa fa-paper-plane fa-fw fa-xl" style="">
                                            <path d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z" class=""></path>
                                        </svg>
                                    </a>
                                <?php } ?>
                                <?php if ($config['viber']['val']) { ?>
                                    <a rel="nofollow"
                                       href="<?php echo $config['viber']['val'] . HTTP_SERVER . $_SERVER['REQUEST_URI']; ?>"
                                       class="social_viber">
                                        <svg enable-background="new 0 0 128 128" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="_x34__stroke">
                                                <g id="Viber_1_">
                                                    <rect clip-rule="evenodd" fill="none" fill-rule="evenodd" height="128" width="128"/>
                                                    <path clip-rule="evenodd" d="M71.4,44.764c2.492,0.531,4.402,1.478,6.034,3.006    c2.1,1.983,3.251,4.383,3.757,7.831c0.342,2.248,0.202,3.132-0.595,3.865c-0.746,0.682-2.125,0.707-2.96,0.063    c-0.607-0.455-0.797-0.935-0.936-2.236c-0.164-1.731-0.468-2.943-0.987-4.067c-1.113-2.387-3.074-3.625-6.388-4.029    c-1.556-0.19-2.024-0.366-2.53-0.96c-0.924-1.099-0.569-2.88,0.708-3.537c0.481-0.24,0.683-0.265,1.746-0.202    C69.908,44.536,70.882,44.65,71.4,44.764z M68.706,35.227c7.679,1.124,13.624,4.686,17.521,10.471    c2.189,3.259,3.555,7.086,4.023,11.191c0.164,1.503,0.164,4.244-0.013,4.699c-0.165,0.429-0.696,1.01-1.151,1.25    c-0.493,0.253-1.543,0.227-2.125-0.076c-0.974-0.493-1.265-1.276-1.265-3.398c0-3.271-0.848-6.72-2.315-9.398    c-1.67-3.057-4.099-5.583-7.059-7.339c-2.543-1.516-6.3-2.64-9.728-2.918c-1.24-0.101-1.923-0.354-2.391-0.897    c-0.721-0.821-0.797-1.933-0.19-2.855C64.67,34.937,65.682,34.772,68.706,35.227z M38.914,27.434    c0.443,0.152,1.126,0.505,1.518,0.758c2.403,1.592,9.095,10.143,11.284,14.412c1.252,2.438,1.67,4.244,1.278,5.583    c-0.405,1.44-1.075,2.198-4.074,4.61c-1.202,0.972-2.328,1.97-2.505,2.236c-0.455,0.657-0.822,1.945-0.822,2.855    c0.013,2.109,1.379,5.937,3.175,8.88c1.391,2.286,3.883,5.216,6.35,7.465c2.897,2.653,5.452,4.459,8.337,5.886    c3.707,1.844,5.971,2.311,7.628,1.541c0.417-0.19,0.86-0.442,0.999-0.556c0.126-0.114,1.101-1.301,2.163-2.615    c2.049-2.577,2.517-2.994,3.922-3.474c1.784-0.606,3.605-0.442,5.44,0.493c1.392,0.72,4.428,2.602,6.388,3.966    c2.581,1.806,8.096,6.303,8.843,7.2c1.315,1.617,1.543,3.688,0.658,5.975c-0.936,2.412-4.579,6.934-7.122,8.867    c-2.302,1.743-3.934,2.412-6.085,2.513c-1.771,0.088-2.505-0.063-4.769-0.998C63.76,95.718,49.579,84.805,38.32,69.811    c-5.882-7.831-10.361-15.953-13.422-24.378c-1.784-4.913-1.872-7.048-0.405-9.562c0.633-1.061,3.327-3.688,5.288-5.153    c3.264-2.425,4.769-3.322,5.971-3.575C36.574,26.966,38.004,27.105,38.914,27.434z M67.833,26.07    c4.352,0.543,7.868,1.591,11.727,3.474c3.795,1.857,6.224,3.613,9.437,6.808c3.011,3.019,4.681,5.305,6.452,8.854    c2.467,4.951,3.871,10.838,4.111,17.317c0.089,2.21,0.025,2.703-0.481,3.335c-0.961,1.225-3.074,1.023-3.795-0.354    c-0.228-0.455-0.291-0.846-0.367-2.615c-0.127-2.716-0.316-4.471-0.696-6.568c-1.493-8.223-5.44-14.791-11.74-19.503    c-5.25-3.941-10.677-5.861-17.786-6.278c-2.404-0.139-2.821-0.227-3.365-0.644c-1.012-0.796-1.063-2.665-0.089-3.537    c0.595-0.543,1.012-0.619,3.074-0.556C65.392,25.842,66.973,25.969,67.833,26.07z M64,0c35.346,0,64,28.654,64,64    s-28.654,64-64,64S0,99.346,0,64S28.654,0,64,0z" fill="#f0f0f0" fill-rule="evenodd" id="Viber"/>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                <?php } ?>
                                <?php if ($config['twitter']['val']) { ?>
                                    <a rel="nofollow"
                                       href="<?php echo $config['twitter']['val'] . HTTP_SERVER . $_SERVER['REQUEST_URI']; ?>"
                                       class="social_twitter">
                                        <svg viewBox="328 355 335 276" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M 630, 425 A 195, 195 0 0 1 331, 600 A 142, 142 0 0 0 428, 570 A  70,  70 0 0 1 370, 523
                                                    A  70,  70 0 0 0 401, 521 A  70,  70 0 0 1 344, 455 A  70,  70 0 0 0 372, 460 A  70,  70 0 0 1 354, 370 A 195, 195 0 0 0 495, 442
                                                    A  67,  67 0 0 1 611, 380 A 117, 117 0 0 0 654, 363 A  65,  65 0 0 1 623, 401 A 117, 117 0 0 0 662, 390
                                                    A  65,  65 0 0 1 630, 425 Z"
                                                  style="fill:#f0f0f0;"/>
                                        </svg>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php endif; ?>
                        <?php if (
                        (defined(
                            'WISHLIST_MODULE_ENABLED'
                        ) && WISHLIST_MODULE_ENABLED == 'true') && $template->show(
                            'P_WISHLIST'
                        )
) : ?>
                            <div class="container_sheare_compare">
                                <div id="compare_wishlist" class="compare compare_wishlist">
                                    <?php
                                    echo sprintf(RTPL_PRODUCTS_WISHLIST, $id, $id, $id, $wish_checked, $id, $wish_text);
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-xs-12">
                        <h1 class="category_heading"><?php echo $products_name; ?></h1>
                        <?php if ($template->show('P_PRESENCE')) : ?>
                            <?php $stock_text = $template->show('P_SHOW_PROD_QTY_ON_PAGE') ? $stock_text . ' ' . $product_info['products_quantity'] : $stock_text;?>
                            <span class="label <?php echo($product_info['products_quantity'] > 0 ? 'label-success' : 'label-danger') ?>"><?php echo $stock_text; ?></span>
                        <?php endif; ?>
                        <?php if ($template->show('P_SHORT_DESCRIPTION')) : ?>
                            <p class="short_description"><?php echo $product_info['products_info']; ?></p>
                        <?php endif; ?>
                        <?php if ($template->show('P_MODEL') and !empty($product_info['products_model'])) : ?>
                            <span class="art_card_product">
                            <?= HOME_PROD_VENDOR_CODE . $product_info['products_model']; ?>
              </span>
                        <?php endif; ?>
                        <div class="prod_price">
                            <span id="summ_price"><?php echo $products_price ?></span>
                        </div>
                    </div>
                    <?php if ($template->show('P_ATTRIBUTES')) : ?>
                        <div class="col-xs-12">
                            <div class="prod_attributes">
                                <div class="prod_attributes_div">
                                    <?php echo $attr_string_select;
                                    if (
                                        getConstantValue('QTY_PRO_ENABLED') == 'true' && is_file(
                                            DIR_WS_EXT . 'qty_pro/prod_attributes_combination.php'
                                        )
                                    ) {
                                        require_once DIR_WS_EXT . 'qty_pro/prod_attributes_combination.php';
                                    } ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-xs-12 buy_cont">
                        <?php if ($template->show("P_SHOW_QUANTITY_INPUT") != 0) : ?>
                            <div class="input-group">
                                <span class="minus">-</span>
                                <input class="count" name="cart_quantity" type="text" value="1" size="5" min="1"
                                       max="100000"/>
                                <span class="plus">+</span>
                            </div>
                        <?php endif; ?>
                        <?php echo $add_to_cart; ?>
                        <?php if ($template->show("P_SHOW_QUANTITY_INPUT") == 0) {
                            echo tep_draw_hidden_field('cart_quantity', tep_get_products_quantity_order_min($id));
                        } ?>
                    </div>
                    <?php if ($template->show('P_RATING')) : ?>
                        <div class="col-xs-12">
                            <div class="container_rating_likes">
                                <!-- RATING -->
                                <div class="rating_product">
                                    <div>
                                        <?php if (COMMENTS_MODULE_ENABLED == 'true') : ?>
                                            <?= Reviews::drawRatingBlock($rating['average']) ?>
                                            <?= Reviews::drawQuantityBlock($rating['count'], TEXT_REVIEWSES) ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- END RATING -->
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<!-- TABS -->
<?php $activeTab = ' active'; ?>
<div class="row">
    <div class="col-lg-6 col-md-7 col-xs-12 product_tabs">
        <ul class="nav nav-tabs content-tabs">
            <?php if ($template->show('P_TAB_DESCRIPTION')) : ?>
                <li class="tab-item<?= $activeTab; ?>">
                    <button class="tablinks"
                            onclick="openTab(this, '#tab-description')"><?php echo TEXT_DESCRIPTION; ?></button>
                </li>
                <?php $activeTab = ''; ?>
            <?php endif ?>
            <?php if ($template->show('P_TAB_CHARACTERISTICS')) : ?>
                <li class="tab-item<?= $activeTab; ?>">
                    <button class="tablinks"
                            onclick="openTab(this, '#tab-characteristics')"><?php echo TEXT_ATTRIBS; ?></button>
                </li>
                <?php $activeTab = ''; ?>
            <?php endif ?>
            <!--P_TAB_DOWNLOAD -->
            <?php if (!empty($product_downloads)) : ?>
                <li class="tab-item<?= $activeTab; ?>">
                    <button class="tablinks"
                            onclick="openTab(this, '#tab-downloads')"><?php echo TEXT_DOWNLOADS; ?></button>
                </li>
                <?php $activeTab = ''; ?>
            <?php endif ?>

            <?php if (COMMENTS_MODULE_ENABLED == 'true' and $template->show('P_TAB_COMMENTS')) : ?>
                <li class="tab-item<?= $activeTab; ?>">
                    <button id="tab-comments-anchor" class="tablinks" onclick="openTab(this, '#tab-comments')">
                        <?php echo TEXT_REVIEWSES2; ?>
                        <span class="nobold" id="comment-tab-count">(<?php echo $rating['count']; ?>)</span>
                    </button>
                </li>
                <?php $activeTab = ''; ?>
            <?php endif ?>
        </ul>
        <?php $activeTab = ' active'; ?>
        <div class="tab-content product-tabs-content">
            <?php if ($template->show('P_TAB_DESCRIPTION')) : ?>
                <div id="tab-description" class="tab-pane tab-content-item<?= $activeTab; ?>">
                    <?php echo $product_info['products_description']; ?>
                </div>
                <?php $activeTab = ''; ?>
            <?php endif ?>
            <?php if ($template->show('P_TAB_CHARACTERISTICS')) : ?>
                <div id="tab-characteristics" class="tab-pane tab-content-item<?= $activeTab; ?>">
                    <div class="resize_block">
                        <?php include(DIR_WS_MODULES . 'product_characteristics.php'); ?>
                    </div>
                    <span class="more_info"><?php echo HOME_LOAD_MORE_INFO; ?></span>
                </div>
                <?php $activeTab = ''; ?>
            <?php endif ?>
            <!-- P_TAB_DOWNLOADS   -->
            <?php if (!empty($product_downloads)) : ?>
                <div id="tab-downloads" class="tab-pane tab-content-item<?= $activeTab; ?>">
                    <?php include(DIR_WS_MODULES . 'product_downloads.php'); ?>
                </div>
                <?php $activeTab = ''; ?>
            <?php endif ?>

            <?php if (COMMENTS_MODULE_ENABLED == 'true' and $template->show('P_TAB_COMMENTS')) : ?>
                <div id="tab-comments" class="tab-pane tab-content-item<?= $activeTab; ?>">
                    <div id="comments" class="clearfix resize_block">
                        <?php require_once($rootPath . '/ext/reviews/init.php'); ?>
                    </div>
                    <span class="more_info"><?php echo HOME_LOAD_MORE_INFO; ?></span>
                    <div class="col-md-8 col-md-offset-2 col-xs-12 block_comments">
                        <?php
                        echo "<div class='add_comment_box' id='reply_to_comment'>";
                        echo "<p>" . HOME_ADD_COMMENT_HEAD_TITLE . "</p>";
                        echo "<div id='addfomz'>" . $reviews->makeAnswerBlock() . "</div>";
                        echo "</div>";
                        ?>
                        <hr>
                    </div>
                </div>
                <?php $activeTab = ''; ?>
            <?php endif ?>
        </div>
    </div>
    <?php $activeTab = ' active'; ?>
    <div class="col-lg-5 col-lg-offset-1 col-md-5 col-xs-12 product_tabs">
        <ul class="nav nav-tabs content-tabs">
            <?php if ($template->show('P_TAB_PAYMENT_SHIPPING')) : ?>
                <li class="tab-item<?= $activeTab; ?>">
                    <button class="tablinks"
                            onclick="openTab(this, '#tab-payment-shipping')"><?php echo TEXT_PAYM_SHIP; ?></button>
                </li>
                <?php $activeTab = ''; ?>
            <?php endif ?>
            <?php if ($template->show('P_WARRANTY')) : ?>
                <li class="tab-item<?= $activeTab; ?>">
                    <button class="tablinks"
                            onclick="openTab(this, '#tab-warranty')"><?php echo HOME_TEXT_PAYM_SHIP; ?></button>
                </li>
                <?php $activeTab = ''; ?>
            <?php endif ?>
        </ul>
        <?php $activeTab = ' active'; ?>
        <div class="tab-content product-tabs-content">
            <?php if ($template->show('P_TAB_PAYMENT_SHIPPING')) : ?>
                <div id="tab-payment-shipping" class="tab-pane tab-content-item<?= $activeTab; ?>">
                    <div class="resize_block">
                        <?php echo renderArticle('shipping_product_info_tab'); ?>
                    </div>
                    <span class="more_info"><?php echo HOME_LOAD_MORE_INFO; ?></span>
                </div>
                <?php $activeTab = ''; ?>
            <?php endif ?>
            <?php if ($template->show('P_WARRANTY')) : ?>
                <div id="tab-warranty" class="tab-pane tab-content-item<?= $activeTab; ?>">
                    <div class="resize_block">
                        <?php echo renderArticle(122); ?>
                    </div>
                    <span class="more_info"><?php echo HOME_LOAD_MORE_INFO; ?></span>
                </div>
                <?php $activeTab = ''; ?>
            <?php endif ?>
        </div>
    </div>
    <!--END TABS -->
    <?php if (COMMENTS_MODULE_ENABLED == 'true' and $template->show('P_TAB_COMMENTS')) : ?>
    <?php endif; ?>
    <div class="col-xs-12 viewed_slider">
        <?php
        $tpl_settings = array(
            'id' => 'featured',
            'classes' => array('product_slider'),
            'cols' => $config['cols']['val'] ?: '2;4;6;6',
            'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 10),
            'title' => BOX_HEADING_FEATURED,
        );
        include(DIR_WS_MODULES . 'featured.php');
        ?>
    </div>
    <div class="col-xs-12 product_info_slider">
        <?php if ($template->show('P_DRUGIE')) :
            include(DIR_WS_MODULES . 'drugie.php');
        endif ?>
    </div>
    <!--P_XSELL-->
    <?php
    if ($template->show('P_XSELL')) {
        if (is_file(DIR_WS_EXT . 'xsell_products_buynow/' . FILENAME_XSELL_PRODUCTS)) {
            echo '<div class="col-xs-12 product_info_slider">';
            require_once DIR_WS_EXT . 'xsell_products_buynow/' . FILENAME_XSELL_PRODUCTS;
            echo '</div>';
        }
    }

    //<!-- NEWS SUBMIT BUTTON -->
        if (is_file(DIR_WS_EXT . 'subscribe/subscribe.php')) {
            require_once DIR_WS_EXT . 'subscribe/subscribe.php';
        }
        ?>
    <!-- END NEWS SUBMIT FORM -->
</div>
