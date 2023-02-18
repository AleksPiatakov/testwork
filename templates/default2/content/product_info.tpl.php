<div class="product_card_block">
    <?php
    // main form:
    echo tep_draw_form(
        'cart_quantity',
        tep_href_link(
            FILENAME_PRODUCT_INFO,
            tep_get_all_get_params(array('action', 'language')) . 'action=add_product'),
        'post',
        'data-cart-key="' . $cart_key . '"');
    ?>
    <div class="product_actions_block d-flex align-items-center">
        <div class="col-md-6">
            <?php
            if ($template->show('P_MODEL')) {
                echo '<span class="product_card_art">' . LOW_STOCK_TEXT2 . '<span>' . $product_info['products_model'] . '</span></span>';
            } ?>
            <?php if ($template->show('P_PRESENCE')) {
                $stock_text = $template->show('P_SHOW_PROD_QTY_ON_PAGE') ? $stock_text . ' ' . $product_info['products_quantity'] : $stock_text;
                echo '<span class="product_card_label ' . ($product_info['products_quantity'] > 0 ? 'label-success' : 'label-danger') . '">' . $stock_text . '</span>';
            } ?>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            <?php if ((defined('COMPARE_MODULE_ENABLED') && COMPARE_MODULE_ENABLED == 'true') || (defined(
                        'WISHLIST_MODULE_ENABLED') && WISHLIST_MODULE_ENABLED == 'true')): ?>

                <?php
                //P_COMPARE
                if (($template->show('P_COMPARE')) && (defined(
                            'COMPARE_MODULE_ENABLED') && COMPARE_MODULE_ENABLED == 'true')) {
                    echo sprintf(
                        RTPL_PRODUCTS_COMPARE,
                        (int)$id,
                        (int)$id,
                        (int)$id,
                        $compare_checked,
                        (int)$id,
                        $compare_text);
                }
                //P_WISHLIST
                if (($template->show('P_WISHLIST')) && (defined(
                            'WISHLIST_MODULE_ENABLED') && WISHLIST_MODULE_ENABLED == 'true')) {
                    echo sprintf(RTPL_PRODUCTS_WISHLIST, $id, $id, $id, $wish_checked, $id, $wish_text);
                }
                ?>
            <?php endif; ?>

            <?php if (SOCIAL_WIDGETS_ENABLED == 'true' and $template->show('P_SHARE')): ?>
                <!-- SHARE -->
                <div class="product_card_share">
                    <div class="dropdown-toggle" id="product_card_share-link" data-toggle="dropdown"
                         aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px"
                             height="13px" viewBox="0 0 16 13" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1170.000000, -558.000000)" fill="#979797" fill-rule="nonzero">
                                    <g transform="translate(460.000000, 500.000000)">
                                        <g transform="translate(1.000000, 46.000000)">
                                            <g transform="translate(0.000000, 10.000000)">
                                                <g transform="translate(499.000000, 0.000000)">
                                                    <g transform="translate(210.000000, 1.000000)">
                                                        <g transform="translate(0.000000, 1.000000)">
                                                            <path d="M15.858361,5.4605836 L9.98034309,0.0978111966 C9.9095236,0.0328078948 9.84286996,-0.00375646247 9.74705535,0.000306243893 C9.56375784,0.00843165662 9.33047009,0.134375554 9.33047009,0.325322753 L9.33047009,3.01483437 C9.33047009,3.09608849 9.26381645,3.16921721 9.1804994,3.18140533 C3.3358083,4.0548872 0.873789453,8.32072888 0.00312627315,12.7490788 C-0.0302005471,12.9237752 0.2114189,13.0862834 0.323896918,12.9481514 C2.45681342,10.3277058 5.05213954,8.61730644 9.15550429,8.58480479 C9.24715304,8.58480479 9.33047009,8.69043516 9.33047009,8.7798147 L9.33047009,11.4205738 C9.33047009,11.7049633 9.71789438,11.8309072 9.93451871,11.6358973 L15.8541952,6.17968262 C15.9625073,6.08217767 15.9958341,5.96842189 16,5.83841529 C15.9958341,5.70840869 15.9625073,5.55808855 15.858361,5.4605836 Z"
                                                                  id="share-svg"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <?php echo DEMO2_SHARE_TEXT; ?>
                    </div>
                    <div class="dropdown-menu" aria-labelledby="product_card_share-link">
                        <a rel="nofollow"
                           href="https://vk.com/share.php?url=<?php echo HTTP_SERVER . $_SERVER['REQUEST_URI']; ?>"
                           class="social_header_vk"><i class="fa fa-vk"></i></a>
                        <a rel="nofollow"
                           href="https://www.facebook.com/sharer/sharer.php?u=<?php echo HTTP_SERVER . $_SERVER['REQUEST_URI']; ?>"
                           class="social_header_facebook"><i class="fa fa-facebook"></i></a>
                        <a rel="nofollow"
                           href="https://twitter.com/intent/tweet?url=<?php echo HTTP_SERVER . $_SERVER['REQUEST_URI']; ?>"
                           class="social_header_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </div>
                </div>
                <!-- END SHARE -->
            <?php endif; ?>
        </div>
    </div>
    <div class="product_main_block d-flex">
        <div class="col-md-7 additional_images2">
            <?php include(DIR_WS_MODULES . 'additional_images2.php'); ?>
        </div>
        <div class="col-md-5 p-0">
            <div class="prod_card_header">
                <h1 class="category_heading"><?php echo $products_name; ?></h1>
                <?php if (($product_info['products_free_ship']) or (SOCIAL_WIDGETS_ENABLED == 'true' and $template->show(
                            'P_SOCIAL_LIKE'))) {
                    echo '<div class="prod_card-like_ship">';
                    if ($product_info['products_free_ship']) {
                        echo '<span class="free_ship_block">' . TEXT_PRODUCT_INFO_FREE_SHIPPING . '</span>';
                    }
                    if (SOCIAL_WIDGETS_ENABLED == 'true' and $template->show('P_SOCIAL_LIKE')) {
                        echo '<span class="fb_likes_block">';
                        include('ext/widgets/widgets_template.php');
                        echo '</span>';
                    }
                    echo '</div>';
                } ?>

            </div>
            <div class="prod_card_calculation">
                <div class="prod_price">
                    <span id="sum_price"><?php echo $products_price ?></span>
                </div>
                <div class="prod_card_buy d-flex">


                    <!--          P_SHOW_QUANTITY_INPUT НАХОДИТСЯ В RENDER_TEMPLATE -->


                    <!--            --><?php //if($template->show("P_SHOW_QUANTITY_INPUT") != 0): ?>
                    <!--              <input class="count" name="cart_quantity" type="text" value="1" size="5" min="1" max="100000"/>-->
                    <!--            --><?php //endif; ?>
                    <?php echo $add_to_cart; ?>

                    <?php if ($template->show("P_SHOW_QUANTITY_INPUT") == 0) {
                        echo tep_draw_hidden_field('cart_quantity', tep_get_products_quantity_order_min($id));
                    } ?>
                    <?php
                    if (is_file(DIR_WS_EXT . 'quick_order/quick_order.php')) {
                        require_onceDIR_WS_EXT . 'quick_order/quick_order.php';
                    }
                    ?>
                </div>
            </div>

            <?php if ($template->show('P_ATTRIBUTES') and !empty($attr_string_select)): ?>
                <div class="prod_card_select_attr">
                    <?php echo $attr_string_select; ?>
                </div>
            <?php endif; ?>
            <?php if ($template->show('P_ATTRIBUTES') and !empty($attr_string)): ?>
                <div class="prod_card_text_attr">
                    <?php echo $attr_string; ?>
                </div>
            <?php endif; ?>

            <?php if ($template->show('P_RATING')): ?>
                <div class="container_rating_likes">
                    <!-- RATING -->
                    <div class="rating_product">
                        <div>
                            <?php if (COMMENTS_MODULE_ENABLED == 'true'): ?>
                                <?= Reviews::drawRatingBlock($rating['average']) ?>
                                <?= Reviews::drawQuantityBlock($rating['count'], TEXT_REVIEWSES) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- END RATING -->
                </div>
            <?php endif; ?>
        </div>
    </div>

    </form>

    <!-- TABS -->

    <ul class="nav nav-tabs content-tabs">
        <!-- P_TAB_DESCRIPTION   -->
        <?php if ($template->show('P_TAB_DESCRIPTION')): ?>
            <li>
            <a class="active" data-toggle="tab" href="#tab-description"><?php echo TEXT_DESCRIPTION; ?></a>
            </li><?php endif ?>
        <?php if ($template->show('P_TAB_CHARACTERISTICS')): ?>
            <li>
            <a data-toggle="tab" href="#tab-characteristics"><?php echo TEXT_ATTRIBS; ?></a></li><?php endif ?>
        <!--P_TAB_DOWNLOAD -->
        <?php if (!empty($product_downloads)) : ?>
            <li class="tab-item<?= $activeTab; ?>">
                <button class="tablinks"
                        onclick="openTab(this, '#tab-downloads')"><?php echo TEXT_DOWNLOADS; ?></button>
            </li>
            <?php $activeTab = ''; ?>
        <?php endif ?>

        <!-- P_TAB_COMMENTS   -->
        <?php if (COMMENTS_MODULE_ENABLED == 'true' and $template->show('P_TAB_COMMENTS')): ?>
            <li>
                <a id="tab-comments-anchor" data-toggle="tab" href="#tab-comments"><?php echo TEXT_REVIEWSES2; ?><span
                            class="nobold" id="comment-tab-count">(<?php echo $rating['count']; ?>)</span></a>
            </li>
        <?php endif ?>
        <!--P_TAB_PAYMENT_SHIPPING  -->
        <?php if ($template->show('P_TAB_PAYMENT_SHIPPING')): ?>
            <li>
            <a data-toggle="tab" href="#tab-payment-shipping"><?php echo TEXT_PAYM_SHIP; ?></a></li><?php endif ?>
    </ul>
    <div class="tab-content">
        <!-- P_TAB_DESCRIPTION   -->
        <?php if ($template->show('P_TAB_DESCRIPTION')): ?>
            <div id="tab-description"
                 class="tab-pane fade active show"><?php echo $product_info['products_description']; ?></div><?php endif ?>
        <!-- P_TAB_CHARACTERISTICS   -->
        <?php if ($template->show('P_TAB_CHARACTERISTICS')): ?>
            <div id="tab-characteristics"
                 class="tab-pane fade"><?php include(DIR_WS_MODULES . 'product_characteristics.php'); ?></div><?php endif ?>
        <!-- P_TAB_DOWNLOADS   -->
        <?php if (!empty($product_downloads)) : ?>
            <div id="tab-downloads" class="tab-pane tab-content-item<?= $activeTab; ?>">
                <?php include(DIR_WS_MODULES . 'product_downloads.php'); ?>
            </div>
            <?php $activeTab = ''; ?>
        <?php endif ?>
        <!-- P_TAB_COMMENTS   -->

        <!-- P_TAB_COMMENTS   -->
        <?php if (COMMENTS_MODULE_ENABLED == 'true' and $template->show('P_TAB_COMMENTS')): ?>
            <div id="tab-comments" class="tab-pane fade">
                <!--      <div id="comments" class="clearfix">-->
                <!--          <div class="add_comment__title">-->
                <!--          <h3>--><?php //echo TEXT_REVIEWSES2; ?><!-- --><?php //echo $products_name; ?><!--</h3>-->
                <!--        </div>-->
                <!--        --><?php //require_once ('ext/reviews/commentit/comment.php');?>
                <!--      </div>-->
                <h3><?php echo TEXT_REVIEWSES2; ?><?php echo $products_name; ?></h3>
                <ul class="reviews_list">
                    <li>
                        <div class="review_item">
                            <a class="review_logo" target="_blank" style="background: #00a9ff;">
                                AM
                            </a>
                            <div class="review_body">
                                <div class="review_body_info">
                                    <span class="review_name">Azabella Mabakova</span> <span class="review_time">31 минуту назад</span>
                                    <span class="quantity_like">13
                  <span class="arrow_block_review">
                    <i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i>
                  </span>
                </span>
                                </div>
                                <div class="review_body_text">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                    irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                    pariatur.
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="review_item">
                            <a class="review_logo" target="_blank" style="background: #9a2fff;">
                                JD
                            </a>
                            <div class="review_body">
                                <div class="review_body_info">
                                    <span class="review_name">Jelena Denisova</span> <span class="review_time">1 час назад</span>
                                    <span class="quantity_like">25
                  <span class="arrow_block_review">
                    <i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down" aria-hidden="true"></i>
                  </span>
                </span>
                                </div>
                                <div class="review_body_text">
                                    Tempor orci dapibus ultrices in iaculis nunc sed augue lacus. Amet risus nullam eget
                                    felis eget nunc lobortis mattis aliquam.
                                </div>
                            </div>
                        </div>
                        <div id="review_form_answer">
                            <div class="header_answer_block">
                                Ответить на комментарий -<span> Jelena Denisova</span>
                            </div>
                            <form action="">
                                <?= csrf() ?>
                                <input type="text" placeholder="Ваше имя">
                                <textarea name="" id="" placeholder="Введите ваш ответ"></textarea>
                                <div class="footer_answer_block">
                                    <span>Отменить</span>
                                    <button type="submit">Ответить</button>
                                </div>
                            </form>
                        </div>
                        <ul class="sub_reviews_list">
                            <li class="sub_reviews_prev_li">
                                <div class="review_item">
                                    <a class="review_logo" target="_blank" style="background: #e01e59;">
                                        HI
                                    </a>
                                    <div class="review_body">
                                        <div class="review_body_info">
                                            <span class="review_name">Henry Itondo</span> <span class="review_time">1 час назад</span>
                                            <span class="quantity_like">13
                      <span class="arrow_block_review">
                        <i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down"
                                                                            aria-hidden="true"></i>
                      </span>
                    </span>
                                        </div>
                                        <div class="review_body_text">
                                            Nulla aliquet enim tortor at auctor urna. Justo nec ultrices dui sapien eget
                                            mi proin sed. Porta non pulvinar neque laoreet suspendisse. Diam donec
                                            adipiscing tristique risus nec feugiat in fermentum posuere. Habitant morbi
                                            tristique senectus et netus et malesuada fames. Nulla aliquet enim tortor at
                                            auctor urna. Justo nec ultrices dui sapien eget mi proin sed. Porta non
                                            pulvinar neque laoreet suspendisse. Diam donec adipiscing tristique risus
                                            nec feugiat in fermentum posuere. Habitant morbi tristique senectus et netus
                                            et malesuada fames.
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="sub_reviews_prev_li">
                                <div class="review_item">
                                    <a class="review_logo" target="_blank" style=" background: #14ae75;">
                                        AS
                                    </a>
                                    <div class="review_body">
                                        <div class="review_body_info">
                                            <span class="review_name">Artem Sazonov</span> <span class="review_time">3 часа назад</span>
                                            <span class="quantity_like">13
                      <span class="arrow_block_review">
                        <i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down"
                                                                            aria-hidden="true"></i>
                      </span>
                    </span>
                                        </div>
                                        <div class="review_body_text">
                                            Sit amet dictum sit amet justo donec. Lorem donec massa sapien faucibus et.
                                            Volutpat consequat mauris nunc congue nisi vitae.
                                        </div>
                                    </div>
                                </div>
                                <ul class="sub_reviews_list">
                                    <li class="sub_reviews_prev_li">
                                        <div class="review_item">
                                            <a class="review_logo" target="_blank" style="background: #00a9ff;">
                                                AM
                                            </a>
                                            <div class="review_body">
                                                <div class="review_body_info">
                                                    <span class="review_name">Azabella Mabakova</span> <span
                                                            class="review_time">31 минуту назад</span> <span
                                                            class="quantity_like">13
                          <span class="arrow_block_review">
                            <i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down"
                                                                                aria-hidden="true"></i>
                          </span>
                        </span>
                                                </div>
                                                <div class="review_body_text">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                    ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                                    aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                                    pariatur.
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="review_item">
                                            <a class="review_logo" target="_blank" style="background: #00a9ff;">
                                                AM
                                            </a>
                                            <div class="review_body">
                                                <div class="review_body_info">
                                                    <span class="review_name">Azabella Mabakova</span> <span
                                                            class="review_time">31 минуту назад</span> <span
                                                            class="quantity_like">13
                          <span class="arrow_block_review">
                            <i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down"
                                                                                aria-hidden="true"></i>
                          </span>
                        </span>
                                                </div>
                                                <div class="review_body_text">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                    ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                                    aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                                    pariatur.
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="sub_reviews_list">
                                            <li>
                                                <div class="review_item">
                                                    <a class="review_logo" target="_blank" style="background: #9a2fff;">
                                                        JD
                                                    </a>
                                                    <div class="review_body">
                                                        <div class="review_body_info">
                                                            <span class="review_name">Jelena Denisova</span> <span
                                                                    class="review_time">1 час назад</span> <span
                                                                    class="quantity_like">25
                              <span class="arrow_block_review">
                                <i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down"
                                                                                    aria-hidden="true"></i>
                              </span>
                            </span>
                                                        </div>
                                                        <div class="review_body_text">
                                                            Tempor orci dapibus ultrices in iaculis nunc sed augue
                                                            lacus. Amet risus nullam eget felis eget nunc lobortis
                                                            mattis aliquam.
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="sub_reviews_prev_li">
                                <div class="review_item">
                                    <a class="review_logo" target="_blank" style="background: #e01e59;">
                                        HI
                                    </a>
                                    <div class="review_body">
                                        <div class="review_body_info">
                                            <span class="review_name">Henry Itondo</span> <span class="review_time">1 час назад</span>
                                            <span class="quantity_like">13
                      <span class="arrow_block_review">
                        <i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down"
                                                                            aria-hidden="true"></i>
                      </span>
                    </span>
                                        </div>
                                        <div class="review_body_text">
                                            Nulla aliquet enim tortor at auctor urna. Justo nec ultrices dui sapien eget
                                            mi proin sed. Porta non pulvinar neque laoreet suspendisse. Diam donec
                                            adipiscing tristique risus nec feugiat in fermentum posuere. Habitant morbi
                                            tristique senectus et netus et malesuada fames. Nulla aliquet enim tortor at
                                            auctor urna. Justo nec ultrices dui sapien eget mi proin sed. Porta non
                                            pulvinar neque laoreet suspendisse. Diam donec adipiscing tristique risus
                                            nec feugiat in fermentum posuere. Habitant morbi tristique senectus et netus
                                            et malesuada fames.
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="review_item">
                                    <a class="review_logo" target="_blank" style="background: #e01e59;">
                                        HI
                                    </a>
                                    <div class="review_body">
                                        <div class="review_body_info">
                                            <span class="review_name">Henry Itondo</span> <span class="review_time">1 час назад</span>
                                            <span class="quantity_like">13
                      <span class="arrow_block_review">
                        <i class="fa fa-caret-up" aria-hidden="true"></i><i class="fa fa-caret-down"
                                                                            aria-hidden="true"></i>
                      </span>
                    </span>
                                        </div>
                                        <div class="review_body_text">
                                            Nulla aliquet enim tortor at auctor urna. Justo nec ultrices dui sapien eget
                                            mi proin sed. Porta non pulvinar neque laoreet suspendisse. Diam donec
                                            adipiscing tristique risus nec feugiat in fermentum posuere. Habitant morbi
                                            tristique senectus et netus et malesuada fames. Nulla aliquet enim tortor at
                                            auctor urna. Justo nec ultrices dui sapien eget mi proin sed. Porta non
                                            pulvinar neque laoreet suspendisse. Diam donec adipiscing tristique risus
                                            nec feugiat in fermentum posuere. Habitant morbi tristique senectus et netus
                                            et malesuada fames.
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div id="review_form_enter">
                    <div class="header_answer_block">
                        Оставьте ваш комментарий
                    </div>
                    <form action="">
                        <?= csrf() ?>
                        <input type="text" placeholder="Ваше имя">
                        <textarea name="" id="" placeholder="Введите ваш ответ"></textarea>
                        <div class="footer_answer_block">
                            <button type="submit">Комментировать</button>
                        </div>
                    </form>
                </div>


            </div>
        <?php endif ?>
        <!--P_TAB_PAYMENT_SHIPPING  -->
        <?php if ($template->show('P_TAB_PAYMENT_SHIPPING')): ?>
            <div id="tab-payment-shipping" class="tab-pane fade"><?php echo renderArticle(
                'shipping_product_info_tab'); ?></div><?php endif ?>
    </div>

    <!-- END TABS -->
</div>
<!--P_DRUGIE-->
<?php if ($template->show('P_DRUGIE')): include(DIR_WS_MODULES . 'drugie.php'); endif ?>
<!--P_XSELL-->
<?php
if ($template->show('P_XSELL')) {
    if (is_file(DIR_WS_EXT . 'xsell_products_buynow/' . FILENAME_XSELL_PRODUCTS)) {
        require_once DIR_WS_EXT . 'xsell_products_buynow/' . FILENAME_XSELL_PRODUCTS;
    }
}
?>

