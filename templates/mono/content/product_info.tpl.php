<?php
// main form:
echo tep_draw_form(
    'cart_quantity',
    tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action', 'language')) . 'action=add_product'),
    'post',
    'data-cart-key="' . $cart_key . '"'
);
?>

<h1 class="category_heading"><?php echo $products_name; ?></h1>

<div class="row">
    <div class="col-sm-12 col-md-9">
        <div class="row prod_main_info">
            <div class="col-sm-6 col-xs-12">
                <!-- PRODUCT INFO SLIDER -->
                <div class="slider_product_card">
                    <div class="additional_images2">
                        <?php include(DIR_WS_MODULES . 'additional_images2.php'); ?>
                    </div>
                    <?php if (PRODUCT_LABELS_MODULE_ENABLED == 'true') { ?>
                        <div class="product_labels item-list ">
                            <?php echo $product_info['p_label']; ?>
                        </div>
                    <?php } ?>
                </div>
                <!-- END PRODUCT INFO SLIDER -->
            </div>

            <!-- PRODUCT INFO DESCRIPTION -->
            <div class="col-sm-6 col-xs-12">

                <div class="description_card_product row">


                    <div class="col-sm-4 first_row">
                        <!--              --><?php //debug($template->settings); ?>
                        <?php if ($template->show('P_MODEL')) {
                            echo '<span class="art_card_product">' . $product_info['products_model'] . '</span>';
                        } ?>
                    </div>
                    <div class="col-sm-8 description_card_small_btn first_row">
                        <?php if ($template->show('P_PRESENCE')) {
                            $stock_text = $template->show('P_SHOW_PROD_QTY_ON_PAGE') ? $stock_text . ' ' . $product_info['products_quantity'] : $stock_text;
                            echo '<span class="label label-stock ' . ($product_info['products_quantity'] > 0 ? 'label-success' : 'label-danger') . '">' . $stock_text . '</span>';
                        } ?>
                        <?php if (SOCIAL_WIDGETS_ENABLED == 'true' and $template->show('P_SOCIAL_LIKE')) {
                            echo '<div class="col-sm-12">';
                            include('ext/widgets/widgets_template.php');
                            echo '</div>';
                        } ?>
                    </div>

                    <?php if ($product_info['products_free_ship']) {
                        echo '<div class="col-sm-12">
                    <span class="label label-success">' . TEXT_PRODUCT_INFO_FREE_SHIPPING . '</span>
                  </div>';
                    } ?>

                    <?php if ($template->show('P_ATTRIBUTES')) : ?>
                        <div class="prod_attributes col-sm-12">
                            <div class="prod_attributes_div">
                                <?php echo $attr_string_select;
                                if (getConstantValue('QTY_PRO_ENABLED') == 'true' && is_file(DIR_WS_EXT . 'qty_pro/prod_attributes_combination.php')) {
                                    require_once DIR_WS_EXT . 'qty_pro/prod_attributes_combination.php';
                                } ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="prod_price col-sm-4 col-xs-5">
                        <span id="summ_price"><?php echo $products_price ?></span>
                    </div>
                    <div class="prod_buy_btns col-sm-8 col-xs-7">
                        <?php if ($template->show("P_SHOW_QUANTITY_INPUT") and $product_info['products_quantity'] > 0) : ?>
                            <div class="product-quantity-selector">
                <span class="quantity-selector-mask">
                    <input type="number" id="" class="input-text qty text" step="1" min="1" max="999"
                           name="cart_quantity" value="1" size="4" pattern="[0-9]*" inputmode="numeric"
                           aria-labelledby="">
                </span>
                            </div>
                        <?php endif; ?>

                        <?php echo $add_to_cart; ?>
                        <?php if ($template->show("P_SHOW_QUANTITY_INPUT") == 0) {
                            echo tep_draw_hidden_field('cart_quantity', tep_get_products_quantity_order_min($id));
                        } ?>
                        <?php
                        if (is_file(DIR_WS_EXT . 'quick_order/quick_order.php')) {
                            require_once DIR_WS_EXT . 'quick_order/quick_order.php';
                        }
                        ?>
                    </div>
                    <?php if ($template->show('P_ATTRIBUTES')) : ?>
                        <div class="col-sm-12 col-xs-12">
                            <div class="prod_attributes p_attr_text">
                                <div class="prod_attributes_div">
                                    <?php echo $attr_string; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- END PRODUCT INFO DESCRIPTION -->

                <!--P_SHARE-->
                <div class="container_sheare_compare">
                    <?php if (SOCIAL_WIDGETS_ENABLED == 'true' and $template->show('P_SHARE')) : ?>
                        <!-- SHARE -->
                        <div class="share_with_friends">
                            <p><?php echo TEXT_SHARE; ?></p>
                            <div class="social_group_footer">
                                <a rel="nofollow"
                                   href="https://vk.com/share.php?url=<?php echo HTTP_SERVER . $_SERVER['REQUEST_URI']; ?>"
                                   class="social_header_vk">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path d="M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z"></path>
                                    </svg>
                                </a>
                                <a rel="nofollow"
                                   href="https://www.facebook.com/sharer/sharer.php?u=<?php echo HTTP_SERVER . $_SERVER['REQUEST_URI']; ?>"
                                   class="social_header_facebook">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- END SHARE -->
                    <?php endif; ?>

                    <?php if (
                    (defined('COMPARE_MODULE_ENABLED') && COMPARE_MODULE_ENABLED == 'true') ||
                        (defined('WISHLIST_MODULE_ENABLED') && WISHLIST_MODULE_ENABLED == 'true')
) : ?>
                        <div id="compare_wishlist" class="compare compare_wishlist">
                            <?php
                            //P_COMPARE
                            if (($template->show('P_COMPARE')) && (defined('COMPARE_MODULE_ENABLED') && COMPARE_MODULE_ENABLED == 'true')) {
                                echo sprintf(
                                    RTPL_PRODUCTS_COMPARE,
                                    (int)$id,
                                    (int)$id,
                                    (int)$id,
                                    $compare_checked,
                                    '',
                                    (int)$id,
                                    $compare_text,
                                    ''
                                );
                            }
                            //P_WISHLIST
                            if (($template->show('P_WISHLIST')) && (defined('WISHLIST_MODULE_ENABLED') && WISHLIST_MODULE_ENABLED == 'true')) {
                                echo sprintf(RTPL_PRODUCTS_WISHLIST, $id, $id, $id, $wish_checked, $id, $wish_text);
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- P_RATING  -->
                <?php if ($template->show('P_RATING')) : ?>
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
                <?php endif; ?>

                <!-- P_SHORT_DESCRIPTION  -->
                <?php if (!empty($product_info['products_info']) and $template->show('P_SHORT_DESCRIPTION')) : ?>
                    <div class="short-description">
                        <div class="h3"><?php echo SHORT_DESCRIPTION; ?></div>
                        <p><?php echo $product_info['products_info']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <!-- RIGHT SIDE -->

    <!-- P_RIGHT_SIDE   -->
    <?php if ($template->show('P_RIGHT_SIDE')) : ?>
        <div class="col-md-3 col-sm-12 product_right_content">
            <aside>
                <nav>
                    <?php echo renderArticle('shipping_product_info'); ?>
                </nav>
            </aside>
        </div>
    <?php endif; ?>
    <!-- END RIGHT SIDE -->
</div>
</form>

<!-- TABS -->
<?php $activeTab = ' active'; ?>
<ul class="nav nav-tabs content-tabs">
    <!-- P_TAB_DESCRIPTION   -->
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

    <!-- P_TAB_COMMENTS   -->
    <?php if (COMMENTS_MODULE_ENABLED == 'true' and $template->show('P_TAB_COMMENTS')) : ?>
        <li class="tab-item<?= $activeTab; ?>">
            <button id="tab-comments-anchor" class="tablinks" onclick="openTab(this, '#tab-comments')">
                <?php echo TEXT_REVIEWSES2; ?>
                <span class="nobold" id="comment-tab-count">(<?php echo $rating['count']; ?>)</span>
            </button>
        </li>
        <?php $activeTab = ''; ?>
    <?php endif ?>
    <!--P_TAB_PAYMENT_SHIPPING  -->
    <?php if ($template->show('P_TAB_PAYMENT_SHIPPING')) : ?>
        <li class="tab-item<?= $activeTab; ?>">
            <button class="tablinks"
                    onclick="openTab(this, '#tab-payment-shipping')"><?php echo TEXT_PAYM_SHIP; ?></button>
        </li>
        <?php $activeTab = ''; ?>
    <?php endif ?>
</ul>
<?php $activeTab = ' active'; ?>
<div class="tab-content">
    <!-- P_TAB_DESCRIPTION -->
    <?php if ($template->show('P_TAB_DESCRIPTION')) : ?>
        <div id="tab-description" class="tab-pane tab-content-item<?= $activeTab; ?>">
            <?php echo $product_info['products_description']; ?>
        </div>
        <?php $activeTab = ''; ?>
    <?php endif ?>
    <!-- P_TAB_CHARACTERISTICS   -->
    <?php if ($template->show('P_TAB_CHARACTERISTICS')) : ?>
        <div id="tab-characteristics" class="tab-pane tab-content-item<?= $activeTab; ?>">
            <?php include(DIR_WS_MODULES . 'product_characteristics.php'); ?>
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

    <!-- P_TAB_COMMENTS   -->
    <?php if (COMMENTS_MODULE_ENABLED == 'true' and $template->show('P_TAB_COMMENTS')) : ?>
        <div id="tab-comments" class="tab-pane tab-content-item<?= $activeTab; ?>">
            <div id="comments" class="clearfix">
                <div class="add_comment__title">
                    <div class="h3"><?php echo TEXT_REVIEWSES2; ?><?php echo $products_name; ?></div>
                </div>
                <?php require_once(DIR_WS_EXT . 'reviews/init.php'); ?>
            </div>
        </div>
        <?php $activeTab = ''; ?>
    <?php endif ?>
    <!--P_TAB_PAYMENT_SHIPPING  -->
    <?php if ($template->show('P_TAB_PAYMENT_SHIPPING')) : ?>
        <div id="tab-payment-shipping" class="tab-pane tab-content-item<?= $activeTab; ?>">
            <?php echo renderArticle('shipping_product_info_tab'); ?>
        </div>
        <?php $activeTab = ''; ?>
    <?php endif ?>
</div>

<!-- END TABS -->

<?php
$tpl_settings = array(
    'id' => 'last_viewed',
    'classes' => array('product_slider'),
    'cols' => $config['cols']['val'] ?: '2;4;6;6;6',
    'limit' => (int)($config['limit']['val'] > 0 ? $config['limit']['val'] : 10),
    'wishlist' => true,
    'title' => BOX_HEADING_LASTVIEWED,
);

if (is_file(DIR_WS_EXT . "last_viewed_products/last_viewed_products.php")) {
    if (in_array('product_slider', $tpl_settings['classes'])) {
        $assets->jsProductInline[] = generateOwlCarousel($tpl_settings);
    }
    require_once DIR_WS_EXT . "last_viewed_products/last_viewed_products.php";
}
?>
<!--P_DRUGIE-->
<?php if ($template->show('P_DRUGIE')) :
    include(DIR_WS_MODULES . 'drugie.php');
endif ?>
<!--P_XSELL-->
<?php
if ($template->show('P_XSELL')) {
    if (is_file(DIR_WS_EXT . 'xsell_products_buynow/' . FILENAME_XSELL_PRODUCTS)) {
        require_once DIR_WS_EXT . 'xsell_products_buynow/' . FILENAME_XSELL_PRODUCTS;
    }
}
?>
<!--P_BETTER_TOGETHER-->
<?php if ($template->show('P_BETTER_TOGETHER')) :
    include(DIR_WS_MODULES . 'better_together.php');
endif ?>

<?php //include(DIR_WS_MODULES . 'also_purchased_products.php'); ?>    
