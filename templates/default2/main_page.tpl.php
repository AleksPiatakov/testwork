<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?> prefix="og: https://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    require_once(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/bootstrap.php');
    $assets->renderCssBlock($content);
    renderOpenGraphBlock();
    ?>
    <?= str_replace(array('<p>', '</p>'), '', htmlspecialchars_decode(renderArticle(555))); ?>

</head>
<body class="<?php echo $body_class; ?>" data-page-name="<?= $content ?>" data-cpath="<?= $cPath ?>">
<?php require_once(DIR_WS_MODULES . 'check_buy.php'); ?><!----><?php //require_once(DIR_WS_MODULES . 'edit_page.php'); ?>
<?php require DIR_WS_MODULES . 'AlertMessage.php'; ?>
<?php require $template->requireBox('H_COMPARE'); ?>
<?php require $template->requireBox('H_WISHLIST'); ?>

<div class="page-wrap">
    <?php if ($content != 'checkout') { ?>
        <header>
            <!-- TOP HEADER -->
            <?php if (!isMobile()) { ?>
                <div class="top_header d-flex align-items-center">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="first_top_blocks col-6 d-inline-flex align-items-center justify-content-start">
                                <?php require $template->requireBox('H_LOGO'); ?>
                                <div class="phones_header">
                                    <a class="dropdown-toggle" href="#" role="button" id="phones_top_btn"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo DEMO2_TOP_PHONES; ?>
                                    </a>
                                    <div class="phones_top_block dropdown-menu" aria-labelledby="phones_top_btn">
                                        <?php echo renderArticle('phones');

                                        $time_work = renderArticle('time_work');
                                        if (!empty($time_work)) :
                                            echo '<hr>' . $time_work;
                                        endif;
                                        ?>
                                    </div>
                                </div>
                                <?php require $template->requireBox('H_CALLBACK'); ?>
                                <?php require $template->requireBox('H_ONLINE'); ?>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-end">
                                <div class="second_top_blocks d-inline-flex align-items-center justify-content-end">
                                    <?php require $template->requireBox('H_SEARCH', $config); ?>
                                    <?php require $template->requireBox('H_LOGIN'); ?>
                                    <?php require $template->requireBox('H_SHOPPING_CART'); ?>
                                    <?php echo $cart_output; ?>
                                </div>
                                <div class="d-inline-flex">
                                    <?php require $template->requireBox('H_LANGUAGES'); ?>
                                    <?php require $template->requireBox('H_CURRENCIES'); ?>
                                    <?php require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/boxes/header/language_currency.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END TOP HEADER -->
            <?php } ?>
            <!-- END MIDDLE HEADER -->

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
                    $content_class = 'container-fluid p-0';
                } // slider width: 100%;
                ?>
                <div class="<?php echo $content_class; ?>">
                    <?php require_once $file; ?>
                </div>
            <?php }
        } ?>
        <!-- END SLIDER  -->
        <div class="container">
            <div class="row d-flex flex-row-reverse">

                <!-- CENTER CONTENT -->
                <div class="<?php echo $center_classes ?> right_content">

                    <!-- BREADCRUMBS -->
                    <?php if ($show_breadcrumbs) : ?>
                        <div class="breadcrumb_block">
                            <?php echo $breadcrumb->trail(' '); ?>
                            <span class="come_back" onclick="history.back();"><?php echo DEMO2_BTN_COME_BACK; ?></span>
                        </div>
                    <?php endif; ?>
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
                        <span class="glyphicon glyphicon-remove-circle"></span>
                    </button>
                <?php endif ?>
                <!-- END COLUMN LEFT -->
            </div>
        </div>
    </main>
</div>
<?php if ($content != 'checkout') { ?>
    <footer>
        <div class="top_footer container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-4 d-flex align-items-center justify-content-start">
                        <?php require $template->requireBox('H_LOGO'); ?>
                        <div class="copyright">
                            <span class="copyright_medium">&copy;</span><span class="copyright_bold">
                                <?php echo date('Y'); ?><?php echo STORE_NAME; ?></span>. <?php echo FOOTER_ALLRIGHTS; ?>.<br>
                            <?php echo FOOTER_DEVELOPED; ?>:
                            <a href="https://solomono.net<?php echo $solomono_link; ?>">SoloMono.net</a>
                        </div>
                    </div>
                    <div class="money_systems col-8 d-flex align-items-center justify-content-end">
                        <img class="lazyload" src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                             data-src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/images/master_card.png"
                             alt="master_card">
                        <img class="lazyload" src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                             data-src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/images/visa.png" alt="visa">
                        <img class="lazyload" src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                             data-src="<?php echo DIR_WS_TEMPLATES . TEMPLATE_NAME; ?>/images/paypal.png" alt="paypal">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="bottom_footer row">
                <div class="col-7">
                    <div class="row">
                        <?php require $template->requireBox('F_TOP_LINKS', $config); ?>
                        <?php require $template->requireBox('F_FOOTER_CATEGORIES_MENU', $config); ?>
                        <?php require $template->requireBox('F_ARTICLES_BOTTOM', $config); ?>
                    </div>
                </div>
                <div class="col-5">
                    <?php
                    $footer_contacts = renderArticle('contacts_footer');
                    if (!empty($footer_contacts)) { ?>
                        <!-- FOOTER CONTACTS -->
                        <div class="h3"><?php echo FOOTER_CONTACTS; ?></div>
                        <?php if (SOCIAL_WIDGETS_ENABLED == 'true' and $template->show('F_SOCIAL')) { ?>
                            <!-- SOCIAL BUTTONS -->
                            <div class="social_group_footer">
                                <a rel="nofollow"
                                   href="https://www.facebook.com/sharer/sharer.php?u=<?php echo HTTP_SERVER; ?>"
                                   class="social_facebook">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z"></path>
                                    </svg>
                                </a>
                                <a rel="nofollow" href="#" class="social_insta">
                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1" x="0px" y="0px"
                                         viewBox="0 0 551.034 551.034"
                                         style="enable-background:new 0 0 551.034 551.034;" xml:space="preserve">
                                        <g>
                                            <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="275.517"
                                                            y1="4.57" x2="275.517" y2="549.72"
                                                            gradientTransform="matrix(1 0 0 -1 0 554)">
                                                <stop offset="0" style="stop-color:#E09B3D"/>
                                                <stop offset="0.3" style="stop-color:#C74C4D"/>
                                                <stop offset="0.6" style="stop-color:#C21975"/>
                                                <stop offset="1" style="stop-color:#7024C4"/>
                                            </linearGradient>
                                            <path style="fill:url(#SVGID_1_);"
                                                  d="M386.878,0H164.156C73.64,0,0,73.64,0,164.156v222.722   c0,90.516,73.64,164.156,164.156,164.156h222.722c90.516,0,164.156-73.64,164.156-164.156V164.156   C551.033,73.64,477.393,0,386.878,0z M495.6,386.878c0,60.045-48.677,108.722-108.722,108.722H164.156   c-60.045,0-108.722-48.677-108.722-108.722V164.156c0-60.046,48.677-108.722,108.722-108.722h222.722   c60.045,0,108.722,48.676,108.722,108.722L495.6,386.878L495.6,386.878z"/>
                                            <linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="275.517"
                                                            y1="4.57" x2="275.517" y2="549.72"
                                                            gradientTransform="matrix(1 0 0 -1 0 554)">
                                                <stop offset="0" style="stop-color:#E09B3D"/>
                                                <stop offset="0.3" style="stop-color:#C74C4D"/>
                                                <stop offset="0.6" style="stop-color:#C21975"/>
                                                <stop offset="1" style="stop-color:#7024C4"/>
                                            </linearGradient>
                                            <path style="fill:url(#SVGID_2_);"
                                                  d="M275.517,133C196.933,133,133,196.933,133,275.516s63.933,142.517,142.517,142.517   S418.034,354.1,418.034,275.516S354.101,133,275.517,133z M275.517,362.6c-48.095,0-87.083-38.988-87.083-87.083   s38.989-87.083,87.083-87.083c48.095,0,87.083,38.988,87.083,87.083C362.6,323.611,323.611,362.6,275.517,362.6z"/>
                                            <linearGradient id="SVGID_3_" gradientUnits="userSpaceOnUse" x1="418.31"
                                                            y1="4.57" x2="418.31" y2="549.72"
                                                            gradientTransform="matrix(1 0 0 -1 0 554)">
                                                <stop offset="0" style="stop-color:#E09B3D"/>
                                                <stop offset="0.3" style="stop-color:#C74C4D"/>
                                                <stop offset="0.6" style="stop-color:#C21975"/>
                                                <stop offset="1" style="stop-color:#7024C4"/>
                                            </linearGradient>
                                            <circle style="fill:url(#SVGID_3_);" cx="418.31" cy="134.07" r="34.15"/>
                                        </g>
                                    </svg>
                                </a>
                                <a rel="nofollow" href="https://vk.com/share.php?url=<?php echo HTTP_SERVER; ?>"
                                   class="social_vk">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path d="M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z"></path>
                                    </svg>
                                </a>
                                <a rel="nofollow" href="#" class="social_skype">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M424.7 299.8c2.9-14 4.7-28.9 4.7-43.8 0-113.5-91.9-205.3-205.3-205.3-14.9 0-29.7 1.7-43.8 4.7C161.3 40.7 137.7 32 112 32 50.2 32 0 82.2 0 144c0 25.7 8.7 49.3 23.3 68.2-2.9 14-4.7 28.9-4.7 43.8 0 113.5 91.9 205.3 205.3 205.3 14.9 0 29.7-1.7 43.8-4.7 19 14.6 42.6 23.3 68.2 23.3 61.8 0 112-50.2 112-112 .1-25.6-8.6-49.2-23.2-68.1zm-194.6 91.5c-65.6 0-120.5-29.2-120.5-65 0-16 9-30.6 29.5-30.6 31.2 0 34.1 44.9 88.1 44.9 25.7 0 42.3-11.4 42.3-26.3 0-18.7-16-21.6-42-28-62.5-15.4-117.8-22-117.8-87.2 0-59.2 58.6-81.1 109.1-81.1 55.1 0 110.8 21.9 110.8 55.4 0 16.9-11.4 31.8-30.3 31.8-28.3 0-29.2-33.5-75-33.5-25.7 0-42 7-42 22.5 0 19.8 20.8 21.8 69.1 33 41.4 9.3 90.7 26.8 90.7 77.6 0 59.1-57.1 86.5-112 86.5z"></path>
                                    </svg>
                                </a>
                                <a rel="nofollow" href="#" class="social_viber">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" version="1.1">
                                        <path d="M44.781 13.156c-.781-2.789-2.328-4.992-4.593-6.55-2.86-1.973-6.149-2.668-8.989-3.094-3.93-.586-7.488-.668-10.883-.254-3.18.39-5.574 1.012-7.757 2.015-4.282 1.97-6.852 5.153-7.637 9.461a58.837 58.837 0 0 0-.79 5.79c-.343 4.171-.03 7.863.954 11.285.96 3.336 2.637 5.718 5.125 7.285.633.398 1.445.687 2.23.965.446.156.88.308 1.235.476.328.153.328.18.324.453-.027 2.371 0 7.02 0 7.02l.008.992h1.781l.29-.281c.19-.18 4.605-4.446 6.179-6.164l.215-.239c.27-.312.27-.312.547-.316 2.125-.043 4.296-.125 6.453-.242 2.613-.14 5.64-.395 8.492-1.582 2.61-1.09 4.515-2.82 5.66-5.14 1.195-2.423 1.902-5.044 2.168-8.016.469-5.227.137-9.762-1.012-13.864zM35.383 33.48c-.656 1.067-1.633 1.81-2.785 2.29-.844.351-1.703.277-2.535-.075-6.965-2.949-12.43-7.593-16.04-14.273-.746-1.375-1.261-2.875-1.855-4.328-.121-.297-.113-.649-.168-.977.05-2.347 1.852-3.672 3.672-4.07.695-.156 1.312.09 1.828.586a16.005 16.005 0 0 1 3.41 4.715c.371.777.203 1.465-.43 2.043-.132.12-.27.23-.414.34-1.445 1.085-1.656 1.91-.886 3.546 1.312 2.785 3.492 4.657 6.308 5.817.742.304 1.442.152 2.008-.45.078-.078.164-.156.219-.25 1.11-1.851 2.723-1.667 4.21-.613.977.696 1.927 1.43 2.891 2.137 1.473 1.082 1.461 2.098.567 3.562zM26.145 15c-.329 0-.657.027-.98.082a.999.999 0 1 1-.328-1.973c.429-.074.87-.109 1.308-.109C30.477 13 34 16.523 34 20.855c0 .442-.035.883-.11 1.31a1 1 0 0 1-1.972-.33A5.865 5.865 0 0 0 26.145 15zM31 21c0 .55-.45 1-1 1s-1-.45-1-1c0-1.652-1.348-3-3-3-.55 0-1-.45-1-1s.45-1 1-1c2.758 0 5 2.242 5 5zm5.71 2.223a1 1 0 0 1-1.952-.446 8.875 8.875 0 0 0 .219-1.96c0-4.86-3.957-8.817-8.817-8.817-.664 0-1.324.074-1.96.219a.996.996 0 0 1-1.196-.754.996.996 0 0 1 .754-1.195c.781-.18 1.59-.27 2.402-.27 5.965 0 10.817 4.852 10.817 10.816 0 .813-.09 1.622-.266 2.407z"/>
                                    </svg>
                                </a>
                            </div>
                            <!-- END SOCIAL BUTTONS -->
                        <?php } ?>

                        <a href="#" rel="nofollow" class="toggle-xs" data-target="#footer_contacts"></a>
                        <div class="phones" id="footer_contacts"><?php echo $footer_contacts; ?></div>
                        <!-- END FOOTER CONTACTS -->
                    <?php } ?>
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
