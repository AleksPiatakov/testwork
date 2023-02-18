<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?> prefix="og: https://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, user-scalable=no">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="<?= $template->getMainconf('MC_COLOR_1') ?>">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="<?= $template->getMainconf('MC_COLOR_1') ?>">
    <link rel="preload" href="/<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/fonts/OpenSans-Regular.ttf" as="font"
          type="font/ttf" crossorigin>
    <link rel="preload" href="/<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/fonts/OpenSans-SemiBold.ttf" as="font"
          type="font/ttf" crossorigin>
    <link rel="preload" href="/<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/fonts/OpenSans-Bold.ttf" as="font"
          type="font/ttf" crossorigin>
    <link rel="preload" href="/<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/fonts/OpenSans-ExtraBold.ttf" as="font"
          type="font/ttf" crossorigin>
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
    $assets->renderCssBlock($content); ?>
    <?= str_replace(array('<p>', '</p>'), '', htmlspecialchars_decode(renderArticle(555))); ?>

</head>
<body class="<?php echo $body_class . ' ' . $main_container; ?> product-aside fixed-header"
      data-page-name="<?= $content ?>" data-cpath="<?= $cPath ?>" data-ismobile="<?= $assets->isMobile?>">
<?php require_once(DIR_WS_MODULES . 'check_buy.php'); ?><!----><?php //require_once(DIR_WS_MODULES . 'edit_page.php'); ?>
<div class="page-wrap">
    <?php if ($content != 'checkout') { ?>
        <header>

            <div class="add_nav">
                <nav class="navbar navbar-default gradient">
                    <div class="container container_add_nav categories_menu">

                        <?php require $template->requireBox('H_LOGO'); ?>
                        <?php require $template->requireBox('H_SEARCH', $config); ?>

                        <div class="header-actions">
                            <!-- SHOPPING CART -->
                            <?php require $template->requireBox('H_SHOPPING_CART'); ?>
                            <?php echo $cart_output; ?>
                            <!-- END SHOPPING CART -->

                            <!-- LOGIN -->
                            <?php require $template->requireBox('H_LOGIN'); ?>
                            <!-- END LOGIN -->
                        </div>

                        <div class="wishlist-compare-box">
                            <?php require $template->requireBox('H_WISHLIST'); ?>
                            <?php require $template->requireBox('H_COMPARE'); ?>
                        </div>

                    </div><!-- END CONTAINER -->
                </nav>
            </div>
        </header>

        <aside class="main-aside">
            <div id="r-left-menu" class="r-left-menu">
                <!-- HORIZONTAL MENU  -->
                <?php require $template->requireBox('H_TOP_MENU'); ?>
                <!-- END HORIZONTAL MENU -->
            </div>
        </aside>
        <div class="main-aside-fader"></div>
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

        <?php if ($content == 'index_products' && !empty($cat_image)) {
            $page_heading_title = $current_category['categories_heading_title'];
            $page_title = $current_category['categories_name'];
            $page_desc = tep_cut(strip_tags($desc_text), 180) . (strlen(strip_tags($desc_text)) > 180 ? '...' : '');
            ?>

            <div class="category-page-bg_banner">
                <div class="thumb">
                    <?php if (!empty($cat_image) and $cat_image != 'categories/') {
                        echo '<img src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="images/' . $cat_image . '" class="lazyload" alt="' . $heading_text_box . '">';
                    } ?>
                </div>
                <div class="col-md-12 category-page-bg_banner-box">
                    <div class="col-lg-5 col-md-7 col-xs-12 col-sm-10">
                        <div class="info">
                            <!--                                <span class="category-type">&bull; Featured &bull;</span>-->
                            <span class="title"><?= $page_title; ?></span> <span
                                    class="description"><?php if (empty($_GET['page']) or $_GET['page'] == 1) {
                                        echo $page_desc;
                                                        } ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="container main-container">
            <div class="row">

                <?php if (in_array($content, $no_breadcrumbs_array)) {
                    echo '<div class="' . $empty_block_class . '"></div>';
                } else { ?>
                    <div class="col-sm-12 title-breadcrumbs">
                        <?php // echo '<h1 class="category_heading">'. $current_category['categories_name'] . '</h1>'; ?>
                        <!-- BREADCRUMBS -->
                        <?php if ($show_breadcrumbs) {
                            echo $breadcrumb->trail(' ');
                        } ?>
                        <!-- END BREADCRUMBS -->
                    </div>
                <?php } ?>

                <?php if ($content == 'index_products') { ?>
                    <?php
                    $manufacturersAllPids = $all_pids;
                    $tabs = getTabs(true, '421x421'); ?>
                    <div class="topical-categories col-md-12">
                        <div class="row">
                            <?php foreach ($tabs as $name => $tab) : ?>
                                <?php if ($tab['total']) : ?>
                                    <a href="<?= tep_href_link(FILENAME_DEFAULT, 'cPath=0&type=' . $name, 'NONSSL') ?>"
                                       class="box-list col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                        <div class="box box-1">
                                            <div class="image">
                                                <img src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                                                     data-src="<?= $tab['image'] ?>" class="lazyload">
                                            </div>
                                            <div class="title">
                                                <span class="name"><?= $tab['title'] ?></span> <span
                                                        class="products-counter"><?= BOX_HEADING_PRODUCTS ?> - <b><?= $tab['total'] ?></b></span>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>
                    </div>


                    <div class="col-sm-12">
                        <?php if (is_array($subcat_array)) { ?>
                            <div class="form-group row subcats_imgs">
                                <div class="col-md-12 categories-mainpage<?= $hide_categories_mainpage ? ' hidden' : '' ?>">
                                    <?php // subcategoriest columns:
                                    foreach ($subcat_array as $cid => $carr) {
                                        if (count($subcat_array) == 1) {
                                            $col_class = 'items-1 col-lg-3 col-md-3 col-sm-3 col-xs-3';
                                        } elseif (count($subcat_array) == 2) {
                                            $col_class = 'items-2 col-lg-3 col-md-3 col-sm-3 col-xs-3';
                                        } elseif (count($subcat_array) == 3) {
                                            $col_class = 'items-3 col-lg-4 col-md-4 col-sm-4 col-xs-6';
                                        } elseif (count($subcat_array) == 4) {
                                            $col_class = 'items-4 col-lg-3 col-md-3 col-sm-3 col-xs-3';
                                        } elseif (count($subcat_array) == 5) {
                                            $col_class = 'items-5 col-lg-3 col-md-3 col-sm-3 col-xs-3';
                                        } elseif (count($subcat_array) > 5) {
                                            $col_class = 'items-5-more col-lg-3 col-md-3 col-sm-3 col-xs-3';
                                        }

                                        $subsubcategories = '';
                                        if (is_array($carr['subcats'])) {
                                            foreach ($carr['subcats'] as $ss_id => $ss_arr) {
                                                $subsubcategories .= '<span>' . $ss_arr['name'] . '</span>';
                                            }
                                        }

                                        echo '
                                    <div class="item ' . $col_class . '">
                                        <a href="' . $carr['url'] . '">
                                            <div class="thumb">
                                                ' . $carr['img'] . '    
                                            </div>
                                            <span class="title">
                                                <div class="name">' . $carr['name'] . '</div>
                                                ' . $subsubcategories . '
                                            </span>
                                        </a>
                                    </div>';
                                    }
                                    ?>
                                </div>

                            </div>
                        <?php } ?>
                    </div>

                <?php } ?>

                <!-- COLUMN LEFT -->
                <?php if ($sidebar_left) : ?>
                    <div id="sidebar-left" class="col-sm-3 sidebar left_content">
                        <aside>
                            <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
                        </aside>
                    </div>
                    <?php if (isMobile()) { ?>
                        <button type="button" class="sidebar-toggle-back hidden-xs hidden-sm">
                      <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                          <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                        </svg>
                      </span>
                        </button>
                    <?php } ?>
                <?php endif ?>
                <!-- END COLUMN LEFT -->

                <!-- CENTER CONTENT -->
                <div class="<?php echo $center_classes ?> right_content">

                    <!-- CONTENT -->
                    <?php
                    if (file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/' . $content . '.tpl.php')) {
                        require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/content/' . $content . '.tpl.php');
                    } else {
                        require(DIR_WS_CONTENT . $content . '.tpl.php');
                    }
                    ?>
                    <!-- END CONTENT -->

                </div>
                <!-- END CENTER CONTENT -->


            </div>
        </div>

    </main>

    <div class="bottom_xs_menu">
        <div class="menu_list">
            <a href="#" class="list_item open-menu-xs">
                <div class="fader"></div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M255.8 218c-21 0-38 17-38 38s17 38 38 38 38-17 38-38-17-38-38-38zM102 218c-21 0-38 17-38 38s17 38 38 38 38-17 38-38-17-38-38-38zM410 218c-21 0-38 17-38 38s17 38 38 38 38-17 38-38-17-38-38-38z"></path>
                </svg>
                <span class="title">More</span>
            </a>
            <a href="#" class="list_item active">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M208 448V320h96v128h97.6V256H464L256 64 48 256h62.4v192z"></path>
                </svg>
                <span class="title">Home</span>
            </a>
            <a href="#" class="list_item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M96 176h80V96H96v80zm120 240h80v-80h-80v80zm-120 0h80v-80H96v80zm0-120h80v-80H96v80zm120 0h80v-80h-80v80zM336 96v80h80V96h-80zm-120 80h80V96h-80v80zm120 120h80v-80h-80v80zm0 120h80v-80h-80v80z"></path>
                </svg>
                <span class="title">Catalog</span>
            </a>
            <a href="#" class="list_item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M442 107v141L229.2 451.7c8 8 20.8 12.3 28.8 12.3s22.8-3.7 31.4-12.3L480 272V144l-38-37z"></path>
                    <path d="M384 48H224L44.3 235.6c-8 8-12 17.8-12.3 28.4-.3 11.3 3.7 23.3 12.3 31.9l123.8 123.6c8 8 20.8 12.5 28.8 12.5s22.7-3.9 31.3-12.5L416 240V80l-32-32zm-30.7 102.7c-21.7 6.1-41.3-10-41.3-30.7 0-17.7 14.3-32 32-32 20.7 0 36.8 19.6 30.7 41.3-2.9 10.3-11.1 18.5-21.4 21.4z"></path>
                </svg>
                <span class="title">Discount</span>
            </a>
            <a href="#" class="list_item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M256 256c52.805 0 96-43.201 96-96s-43.195-96-96-96-96 43.201-96 96 43.195 96 96 96zm0 48c-63.598 0-192 32.402-192 96v48h384v-48c0-63.598-128.402-96-192-96z"></path>
                </svg>
                <span class="title">Profile</span>
            </a>
        </div>
    </div>
</div>
<?php if ($content != 'checkout') { ?>
    <footer>
        <div class="top_footer">
            <div class="container main-container">
                <div class="row row_menu_contacts_footer">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="top-footer-section">
                                <div class="col-md-3 col-sm-3 col-xs-6 col-item">
                                    <?php require $template->requireBox('F_TOP_LINKS', $config); ?>
                                    <span class="footer-sitemap"><a href="<?php echo tep_href_link(
                                        'sitemap.html'
                                                                          ); ?>"><?php echo FOOTER_SITEMAP; ?></a></span>
                                    <?php require $template->requireBox('H_LANGUAGES'); ?>
                                    <?php require $template->requireBox('H_CURRENCIES'); ?>
                                </div>
                                <?php require $template->requireBox('F_FOOTER_CATEGORIES_MENU', $config); ?>
                                <?php // require $template->requireBox('F_ARTICLES_BOTTOM',$config); ?>

                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <!-- NEWS SUBMIT BUTTON -->
                                    <?php
                                    if (is_file(DIR_WS_EXT . 'subscribe/subscribe.php')) {
                                        require_once DIR_WS_EXT . 'subscribe/subscribe.php';
                                    }
                                    ?>
                                    <!-- END NEWS SUBMIT FORM -->
                                </div>

                                <div class="col-sm-5 col-xs-12 width-20 footer-social">
                                    <div class="section_top_footer">
                                        <div class="h3 title"><?php echo FOOTER_CONTACTS; ?></div>
                                        <?php if (SOCIAL_WIDGETS_ENABLED == 'true' and $template->show('F_SOCIAL')) { ?>
                                            <?php $config = $template->checkConfig('FOOTER', 'F_SOCIAL'); ?>
                                            <!-- SOCIAL BUTTONS -->
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
                                        <?php } ?>
                                    </div>
                                    <div class="contacts_info_footer">
                                        <?php
                                        $footer_contacts = renderArticle('contacts_footer');
                                        if (!empty($footer_contacts)) { ?>
                                            <!-- FOOTER CONTACTS -->

                                            <div class="phones"><?php echo $footer_contacts; ?></div>
                                            <!-- END FOOTER CONTACTS -->
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- FOOTER COPYRIGHT -->
        <div class="bottom_footer">
            <div class="container">
                <div class="row row_copyright">
                    <div class="col-sm-3 col-xs-12">
                        <div class="copyright">
                            <p><?php echo FOOTER_COPYRIGHT; ?> <?php echo date('Y'); ?> <b><?php echo STORE_NAME; ?></b>.
                                <br><?php echo FOOTER_ALLRIGHTS; ?></p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <?php if ($template->show('F_MONEY_SYSTEM')) : ?>
                            <div class="money_systems">
                                <nav>
                                    <ul>
                                        <li>
                                            <img src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                                                 data-src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/images/mainpage/master-card.png"
                                                 alt="master_card" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                                                 data-src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/images/mainpage/american-express.png"
                                                 alt="master_card" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                                                 data-src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/images/mainpage/paypal.png"
                                                 alt="master_card" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                                                 data-src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/images/mainpage/maestro.png"
                                                 alt="master_card" class="lazyload">
                                        </li>
                                        <li>
                                            <img src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                                                 data-src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/images/mainpage/visa.png"
                                                 alt="master_card" class="lazyload">
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <div class="link_webstudio">
                            <p><?php echo FOOTER_DEVELOPED; ?></p>
                            <a href="https://solomono.net<?php echo $solomono_link; ?>">SoloMono.net</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END FOOTER COPYRIGHT -->
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
