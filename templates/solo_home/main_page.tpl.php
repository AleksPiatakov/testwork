<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?> prefix="og: https://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="<?= $template->getMainconf('MC_COLOR_1') ?>">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="<?= $template->getMainconf('MC_COLOR_1') ?>">
    <?php
    echo "\n\t" . '<base href="' . HTTP_SERVER . DIR_WS_CATALOG . '">';
    require(DIR_WS_INCLUDES . 'header_tags.php');  // <title> , <meta name="Description", Keywords, Reply-to
    echo get_noindex_nofollow();
    echo get_canonical();
    echo get_custom_favicon(); // custom favicon
    echo get_rel_prevnext(); // <link rel="next" and "prev"
    echo outputGoogleVerificationMetaTag();

    if ($isFilter) {
        echo get_rel_alternate_seo_filters(); // <link rel="alternate"
    } else {
        echo get_rel_alternate(); // <link rel="alternate"
    }
    ?>
    <meta property="og:locale" content="<?php echo OG_LOCALE; ?>"/>
    <meta property="og:title" content="<?php echo $the_title; ?>"/>
    <meta property="og:type" content="<?php echo $content == 'product_info' ? 'product' : 'website'; ?>"/>
    <meta property="fb:app_id" content="<?php echo $fb_app_id; ?>"/>
    <meta property="og:description" content="<?php echo $the_desc; ?>"/>
    <meta property="og:url" content="<?= HTTP_SERVER . $_SERVER['REQUEST_URI']; ?>"/>
    <meta property="og:image"
          content="<?php echo !empty($product_info['products_image']) ? (HTTP_SERVER . '/getimage/421x421/products/' . urlencode(
              explode(';', $product_info['products_image'])[0]
          )) : LOGO_IMAGE; ?>"/>
    <?php
    if (!empty($product_info['products_id'])) {
        echo '<meta property="og:type" content="product" />
              <meta property="og:image:width" content="500"/>
              <meta property="og:image:height" content="500"/>';
    }
    require_once(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/bootstrap.php');
    $assets->renderCssBlock($content);
    ?>
    <?= str_replace(array('<p>', '</p>'), '', htmlspecialchars_decode(renderArticle(555))); ?>
</head>
<body class="<?php echo $body_class; ?>" data-page-name="<?= $content ?>" data-cpath="<?= $cPath ?>" data-ismobile="<?= $assets->isMobile?>">
<?php require_once(DIR_WS_MODULES . 'check_buy.php'); ?><!----><?php //require_once(DIR_WS_MODULES . 'edit_page.php'); ?>
<?php require $template->requireBox('H_COMPARE'); ?>
<div class="page-wrap">
    <?php if ($content != 'checkout') { ?>
        <header>
            <!-- TOP HEADER -->
            <div class="top_header hidden-xs hidden-sm">
                <div class="container container_top_header clearfix">
                    <div class="row">
                        <div class="col-lg-5 col-md-3">
                            <?php require $template->requireBox('H_LOGO'); ?>
                        </div>
                        <div class="col-lg-7 col-md-9">
                            <div class="row">
                                <div class="col-lg-4 col-md-5">
                                    <div class="search_site">
                                        <?php require $template->requireBox('H_SEARCH', $config); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="call_me clearfix">
                                        <div class="phones_header">
                                            <?php echo renderArticle('phones'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-4 container_top_header-items">
                                    <?php require $template->requireBox('H_LANGUAGES'); ?>
                                    <?php require $template->requireBox('H_CURRENCIES'); ?>
                                    <?php require $template->requireBox('H_LOGIN'); ?>
                                    <div class="wish_list-block">
                                        <?php if (!isMobile()) {
                                            require $template->requireBox('H_WISHLIST');
                                        } ?>
                                    </div>
                                    <?php require $template->requireBox('H_SHOPPING_CART'); ?>
                                    <!-- SHOPPING CART -->
                                    <?php echo $cart_output; ?>
                                    <!-- END SHOPPING CART -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END TOP HEADER -->

            <!-- HORIZONTAL MENU  -->
            <?php require $template->requireBox('H_TOP_MENU'); ?>

            <!-- END HORIZONTAL MENU -->
        </header>
    <?php } ?>
    <main>
        <?php include DIR_WS_MODULES . "AlertMessage.php"; ?>
        <!-- SLIDER  -->
        <?php if ($content == 'index_default' && $file = $template->getFiles('MAINPAGE', 'M_SLIDE_MAIN', $config)) {
            if ($config['width']['val'] != 0) {
                if ($config['width']['val'] == 1) {
                    $content_class = 'container';
                } // slider width: 1140px or in right column
                elseif ($config['width']['val'] == 2) {
                    $content_class = 'container-fluid padd-0';
                } // slider width: 100%;
                ?>
                <div class="<?php echo $content_class; ?>">
                    <?php require_once $file; ?>
                </div>
            <?php }
        } ?>
        <!-- END SLIDER  -->
        <div class="container">
            <div class="row">
                <!-- CENTER CONTENT -->
                <div class="<?php echo $center_classes ?> right_content">
                    <!-- BREADCRUMBS -->
                    <?php if ($show_breadcrumbs) {
                        echo $breadcrumb->trail(' ');
                    } ?>
                    <!-- END BREADCRUMBS -->


                    <!-- CONTENT -->
                    <?php
                    if (file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/' . $content . '.tpl.php')) {
                        require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/' . $content . '.tpl.php'); // content from current template (if exists)
                    } else {
                        require(DIR_WS_CONTENT . $content . '.tpl.php'); // content from default template
                    }
                    ?>
                    <!-- END CONTENT -->

                </div>
                <!-- END CENTER CONTENT -->

                <!-- COLUMN LEFT -->
                <?php if ($sidebar_left) : ?>
                    <div id="sidebar-left" class="col-sm-3 sidebar left_content">
                        <aside>
                            <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
                        </aside>
                    </div>
                    <button type="button" class="sidebar-toggle-back btn-link hidden-xs hidden-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                        </svg>
                    </button>
                <?php endif ?>
                <!-- END COLUMN LEFT -->
                <?php if ($content == 'index_products') : ?>
                    <div class="col-xs-12 viewed_slider_categories">
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
                <?php endif ?>
            </div>
        </div>
    </main>
</div>
<?php if ($content != 'checkout') { ?>
    <footer>
        <div class="footer_content">
            <div class="container">
                <div class="row row_menu_contacts_footer">
                    <div class="col-lg-12 col-xs-12">
                        <?php require $template->requireBox('H_LOGO'); ?>
                    </div>
                    <div class="col-lg-3  col-sm-3 col-xs-12">
                        <!-- FOOTER COPYRIGHT -->
                        <div class="copyright">
                            <p><?php echo FOOTER_COPYRIGHT; ?><?php echo date('Y'); ?><?php echo STORE_NAME; ?></p>
                        </div>
                        <!-- END FOOTER COPYRIGHT -->
                        <div class="short_description">
                            <?php echo renderArticle(117); ?>
                        </div>
                        <?php if ($template->show('F_MONEY_SYSTEM')) : ?>
                            <div class="money_systems">
                                <a href="#" class="mastercard">
                                    <img src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/images/footer/master_card.svg"
                                         alt="Mastercard">
                                </a>
                                <a href="#" class="visa">
                                    <img src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/images/footer/visa.svg"
                                         alt="Visa">
                                </a>
                                <a href="#" class="paypal">
                                    <img src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/images/footer/payPal.svg"
                                         alt="Pay-Pal">
                                </a>
                                <a href="#" class="stripe">
                                    <img src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/images/footer/stripe.svg"
                                         alt="Stripe">
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <?php require $template->requireBox('F_FOOTER_CATEGORIES_MENU', $config); ?>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <?php require $template->requireBox('F_TOP_LINKS', $config); ?>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-xs-12">
                        <div class="contacts_info_footer">
                            <?php
                            $footer_contacts = renderArticle('contacts_footer');
                            if (!empty($footer_contacts)) { ?>
                                <!-- FOOTER CONTACTS -->
                                <a href="#footer_phones" class="collapsed" data-toggle="collapse" aria-expanded="false"
                                   aria-controls="footer_phones">
                                    <div class="h3"><?php echo FOOTER_CONTACTS; ?></div>
                                    <span class="rotate_arrow">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"></path>
                                    </svg>
                                </span>
                                </a>
                                <div class="footer_phones collapse" id="footer_phones">
                                    <?php echo $footer_contacts; ?>
                                </div>
                                <!-- END FOOTER CONTACTS -->
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="link_webstudio">
                            <p><?php echo HOME_FOOTER_DEVELOPED; ?></p>
                            <a <?php echo $content == 'index_default' ? '' : 'rel="nofollow"'; ?>
                                    href="https://solomono.net<?php echo $solomono_link; ?>">
                                <img src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/images/solomono.png">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-6 col-xs-12">
                        <?php if (SOCIAL_WIDGETS_ENABLED == 'true' and $template->show('F_SOCIAL')) : ?>
                            <?php $config = $template->checkConfig('FOOTER', 'F_SOCIAL'); ?>
                            <!-- SOCIAL BUTTONS -->
                            <p class="social_group-title"><?= HOME_FOOTER_SOCIAL_TITLE; ?></p>
                            <div class="social_group_footer">
                                <?php if ($config['instagram']['val']) { ?>
                                    <a rel="nofollow" href="<?php echo $config['instagram']['val']; ?>"
                                       class="social_header_instagram" target="_blank">
                                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
                                        </svg>
                                    </a>
                                <?php } ?>
                                <?php if ($config['youtube']['val']) { ?>
                                    <a rel="nofollow" href="<?php echo $config['youtube']['val']; ?>"
                                       class="social_header_youtube" target="_blank">
                                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                            <path d="M20.2838235,29.7208546 L20.2817697,19.3775851 L30.0092421,24.5671906 L20.2838235,29.7208546 Z M41.6409276,17.5856462 C41.6409276,17.5856462 41.2890436,15.0488633 40.2097727,13.9319394 C38.8405739,12.4655276 37.3060444,12.4583393 36.6026186,12.3724221 C31.5649942,12 24.008044,12 24.008044,12 L23.9922983,12 C23.9922983,12 16.4356904,12 11.398066,12.3724221 C10.6939556,12.4583393 9.16045298,12.4655276 7.79091194,13.9319394 C6.71164104,15.0488633 6.36009927,17.5856462 6.36009927,17.5856462 C6.36009927,17.5856462 6,20.5646804 6,23.5437145 L6,26.3365376 C6,29.3152295 6.36009927,32.2946059 6.36009927,32.2946059 C6.36009927,32.2946059 6.71164104,34.8310466 7.79091194,35.9483127 C9.16045298,37.4147246 10.9592378,37.3681718 11.7605614,37.5218644 C14.6406709,37.8042616 24.0001711,37.8915481 24.0001711,37.8915481 C24.0001711,37.8915481 31.5649942,37.8799099 36.6026186,37.5074878 C37.3060444,37.4219129 38.8405739,37.4147246 40.2097727,35.9483127 C41.2890436,34.8310466 41.6409276,32.2946059 41.6409276,32.2946059 C41.6409276,32.2946059 42,29.3152295 42,26.3365376 L42,23.5437145 C42,20.5646804 41.6409276,17.5856462 41.6409276,17.5856462 L41.6409276,17.5856462 Z"></path>
                                        </svg>
                                    </a>
                                <?php } ?>
                                <?php if ($config['telegram']['val']) { ?>
                                    <a rel="nofollow" href="<?php echo $config['telegram']['val']; ?>"
                                       class="social_header_telegram" target="_blank">
                                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"></path>
                                        </svg>
                                    </a>
                                <?php } ?>
                                <?php if ($config['facebook']['val']) { ?>
                                    <a rel="nofollow" href="<?php echo $config['facebook']['val']; ?>"
                                       class="social_header_facebook" target="_blank">
                                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                            <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                                        </svg>
                                    </a>
                                <?php } ?>
                            </div>
                            <!-- END SOCIAL BUTTONS -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="scrollup">
        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path d="M240.971 130.524l194.343 194.343c9.373 9.373 9.373 24.569 0 33.941l-22.667 22.667c-9.357 9.357-24.522 9.375-33.901.04L224 227.495 69.255 381.516c-9.379 9.335-24.544 9.317-33.901-.04l-22.667-22.667c-9.373-9.373-9.373-24.569 0-33.941L207.03 130.525c9.372-9.373 24.568-9.373 33.941-.001z"></path>
        </svg>
    </div>
<?php } ?>
<?php require(DIR_WS_INCLUDES . '/javascript/javascript.php'); ?>
</body>
</html>
