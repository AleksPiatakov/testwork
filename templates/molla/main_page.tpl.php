<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?> prefix="og: https://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="<?= $template->getMainconf('MC_COLOR_1') ?>">
    <meta name="msapplication-navbutton-color" content="<?= $template->getMainconf('MC_COLOR_1') ?>">
    <?php
    echo "\n\t" . '<base href="' . HTTP_SERVER . DIR_WS_CATALOG . '">';
    require DIR_WS_INCLUDES . 'header_tags.php';  // <title> , <meta name="Description", Keywords, Reply-to
    echo get_noindex_nofollow(); //returns <meta name="robots" content="noindex, nofollow" /> for the specified list of pages
    echo get_canonical(); //returns canonical tags depending on the page type
    echo outputGoogleVerificationMetaTag(); // returns google-site-verification code if exist
    echo get_custom_favicon(); // custom favicon
    echo get_rel_prevnext(); // <link rel="next" and "prev"
    echo get_rel_alternate(); // <link rel="alternate"
    require_once DIR_WS_TEMPLATES . TEMPLATE_NAME . '/bootstrap.php';
    $assets->renderCssBlock($content);
    renderOpenGraphBlock(); ?>
    <?= str_replace(array('<p>', '</p>'), '', htmlspecialchars_decode(renderArticle(555))); ?>

</head>

<body class="<?php echo $body_class; ?>" data-page-name="<?= $content ?>" data-cpath="<?= $cPath ?>" data-ismobile="<?= $assets->isMobile?>">
<?php require DIR_WS_MODULES . 'check_buy.php'; ?>
<?php require DIR_WS_MODULES . 'AlertMessage.php'; ?>
<?php require $template->requireBox('H_COMPARE'); ?>
<?php require $template->requireBox('H_WISHLIST'); ?>

<div class="page-wrap">
    <header>
        <!-- TOP HEADER -->
        <?php if (!isMobile()) { ?>
            <div class="top_header hidden-xs visible-sm-block">
                <div class="<?php echo $template->getMainconf(
                    'CONTENT_WIDTH'
                            ) ? 'container' : 'container-fluid'; ?> container_top_header clearfix">
                    <?php require $template->requireBox('H_LANGUAGES'); ?>
                    <?php require $template->requireBox('H_CURRENCIES'); ?>
                    <div class="phones_header">
                        <?php echo renderArticle('phones'); ?>
                    </div>
                    <?php require $template->requireBox('H_CALLBACK'); ?>
                    <?php require $template->requireBox('H_ONLINE'); ?>

                    <?php require $template->requireBox('H_LOGIN'); ?>
                    <?php require $template->requireBox('H_TOP_LINKS', $config); ?>
                </div>
            </div>
            <!-- END TOP HEADER --><!-- MIDDLE HEADER -->
            <div class="middle_header hidden-xs visible-sm-block">
                <div class="<?php echo $template->getMainconf(
                    'CONTENT_WIDTH'
                            ) ? 'container' : 'container-fluid'; ?> container_middle_header">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
                            <?php require $template->requireBox('H_LOGO'); ?>
                        </div>
                        <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
                            <div class="search_site">
                                <?php require $template->requireBox('H_SEARCH', $config); ?>
                                <?php require $template->requireBox('H_SHOPPING_CART'); ?>
                                <!-- SHOPPING CART LESS 768 PX -->
                                <?php echo $cart_output_mobile; ?>
                                <!-- END SHOPPING CART LESS 768 PX -->
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                            <!-- SHOPPING CART -->
                            <?php echo $cart_output; ?>
                            <!-- END SHOPPING CART -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MIDDLE HEADER -->

            <!--  HORIZONTAL MENU -->
            <?php require $template->requireBox('H_TOP_MENU');
            // END HORIZONTAL MENU
        } else {
            // MOBILE MENU
            require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/boxes/header/categories_mobile.php');
            // END MOBILE MENU
        } ?>
    </header>
    <main>
        <?php echo $template_container_begin ?>
        <!-- CENTER CONTENT -->
        <div class="<?php echo $center_classes ?> right_content">
            <!-- BREADCRUMBS -->
            <?php echo $breadcrumb->trail(' '); ?>
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
                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z"></path>
                </svg>
            </button>
            <?php if (isMobile()) { ?>
                <div class="sidebar_fader visible-xs"></div>
            <?php } ?>
        <?php endif ?>
        <!-- END COLUMN LEFT -->
        <?php echo $template_container_end; ?>
    </main>
</div>
<footer>
    <div class="top_footer">
        <div class="<?php echo $template->getMainconf('CONTENT_WIDTH') ? 'container' : 'container-fluid'; ?>">
            <div class="row row_menu_contacts_footer">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <?php require $template->requireBox('F_TOP_LINKS', $config); ?>
                        <?php require $template->requireBox('F_FOOTER_CATEGORIES_MENU', $config); ?>
                        <?php require $template->requireBox('F_ARTICLES_BOTTOM', $config); ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="contacts_info_footer">
                        <?php require $template->requireBox('F_CONTACTS_FOOTER'); ?>
                        <?php require $template->requireBox('F_SOCIAL'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER COPYRIGHT -->
    <div class="bottom_footer">
        <div class="<?php echo $template->getMainconf('CONTENT_WIDTH') ? 'container' : 'container-fluid'; ?>">
            <div class="row row_copyright">
                <div class="col-sm-3 col-xs-12">
                    <div class="copyright">
                        <p><?php echo FOOTER_COPYRIGHT; ?> <?php echo date('Y'); ?> <?php echo STORE_NAME; ?>
                            . <?php echo FOOTER_ALLRIGHTS; ?></p>
                        <a href="<?php echo tep_href_link('sitemap.html'); ?>"><?php echo FOOTER_SITEMAP; ?></a>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12"><?php require $template->requireBox('F_MONEY_SYSTEM'); ?></div>
                <div class="col-sm-3 col-xs-12"><?php require $template->requireBox('F_WEB_STUDIO_LINK'); ?></div>
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
<?php require(DIR_WS_INCLUDES . '/javascript/javascript.php'); ?>
</body>

</html>
