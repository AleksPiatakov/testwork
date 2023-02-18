<?php

// QUERIES FOR COLUMNS

$body_classes = array();
$center_margin = '';
$sidebar_left = $template->getMainconf('MC_SHOW_LEFT_COLUMN') ?: false;

$big_height = 510;
$big_width = 510;

$logoConfigs = $template->checkConfig('HEADER', 'H_LOGO');
if (isMobile()) {
    $logo_width = $logoConfigs['logo_width_mobile']['val'] ?: 50;
    $logo_height = $logoConfigs['logo_height_mobile']['val'] ?: 50;
} else {
    $logo_width = $logoConfigs['logo_width']['val'] ?: 35;
    $logo_height = $logoConfigs['logo_height']['val'] ?: 35;
}

define('LOGO_WIDTH', $logo_width);
define('LOGO_HEIGHT', $logo_height);

$show_breadcrumbs = true;

// FIND CLASSES FOR COLUMNS
if ($_GET['cPath'] == '') {
    $show_breadcrumbs = true;
}

/**
 * Turn off left sidebar for manufacturers page
 */
if (basename($PHP_SELF) === FILENAME_MANUFACTURERS) {
    $sidebar_left = false;
    $center_classes .= 'col-xs-12 col-sm-12 col-md-12 ';
}

if ((is_array($cPath_array) and count($cPath_array)) or isset($_GET['manufacturers_id'])) {
    $sidebar_left = true;
}
// IF PRODUCT INFO
if (isset($_GET['products_id']) || $content == 'checkout' || $content == 'compare') {
    $sidebar_left = false;
    $show_breadcrumbs = true;
}
if (isset($_GET['products_id'])) {
    array_push($body_classes, 'product_page');
}
if ($content == 'compare') {
    array_push($body_classes, 'compare_page');
}
if ($content == 'wishlist') {
    array_push($body_classes, 'wishlist_page');
}
if ($content == 'checkout') {
    array_push($body_classes, 'checkout_page');
    $show_breadcrumbs = false;
}

// IF MAINPAGE
if ($content == 'index_default') {
    $show_breadcrumbs = false;
    array_push($body_classes, 'frontpage');
} else {
    array_push($body_classes, 'not-front');
}

//HIDE SIDEBAR_LEFT
if ($page_not_found) {
    $sidebar_left = false;
//    $content = CONTENT_ERROR_404;
}

if (isMobile()) {
    $sidebar_left = false;
    if ($content == 'index_products') {
        $sidebar_left = true;
    }
}

// DEFINE CLASSES FOR COLUMNS
if ($sidebar_left) {
    array_push($body_classes, 'one-sidebar', 'left-sidebar');
    $center_classes .= 'col-xs-12 col-sm-12 col-md-9';
} else {
    $center_margin = '';
    $center_classes .= 'col-xs-12 padd-0';
}

if (isset($_GET['products_id'])) {
    $squeeze_margin = "margin:0 0 0 0;";
}
if (!empty($body_classes) and is_array($body_classes)) {
    $body_class = implode(' ', $body_classes);
}
// echo '<pre>',var_dump($body_class),'</pre>';
if (($content == 'product_info' and !$template->show('P_BREADCRUMB')) or ($content == 'index_products' and !$template->show('LIST_BREADCRUMB'))) {
    $show_breadcrumbs = false;
}
$template_container_begin = $template_container_end = '';
if ($sidebar_left || isset($_GET['products_id']) || $content == 'compare' || $content == 'manufacturers' || $content == 'wishlist' || (isset($tPath) && !empty($tPath))) {
    $template_container_begin .= '<div class="' . ($template->getMainconf('CONTENT_WIDTH') ? 'container' : 'container-fluid') . '"><div class="row">';
    $template_container_end .= '</div></div>';
}

$breadcrumb_container_begin = $breadcrumb_container_end = '';
if (!$sidebar_left && ($_GET['articles_id'] || $_GET['tPath'])) {
    $breadcrumb_container_begin .= '<div class="' . ($template->getMainconf('CONTENT_WIDTH') ? 'container' : 'container-fluid') . '">';
    $breadcrumb_container_end .= '</div>';
}
if ($template->show("LIST_MODAL_ON") == 'true') {
    $assets->css[] = DIR_WS_EXT . 'product_modal/product_modal.css';
}
$assets->cssFilesForClone = [$assets::CSS_FILE_PRODUCT_LIST, $assets::CSS_FILE_OTHER];
$assets->jsFilesForClone = [$assets::JS_FILE_OTHER];
$assets->fonts[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/fonts/ptsans_l.woff2';
$assets->fonts[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/fonts/ptsans_l400.woff2';

if ($language == 'russian' or $language == 'ukrainian') {
    $assets->fonts[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/fonts/ptsans_c.woff2';
    $assets->fonts[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/fonts/ptsans_c400.woff2';
}

//CSS
$assets->css[] = DIR_WS_JAVASCRIPT . 'jqueryui/css/smoothness/jquery-ui-1.10.4.custom.min.css';
$assets->css[] = DIR_WS_JAVASCRIPT . 'owl-carousel/owl.carousel.css';
$assets->css[] = DIR_WS_JAVASCRIPT . 'owl-carousel/owl.theme.css';
$assets->css[] = DIR_WS_JAVASCRIPT . 'selectize/selectize.css';
$assets->css[] = DIR_WS_JAVASCRIPT . 'datepicker/daterangepicker.css';
$assets->css[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/bootstrap.min.css';
$assets->css[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/stylesheet.css';
$assets->css[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/responsive.css';
$assets->css[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/fonts.css';
$assets->css[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/popup_cart.css';
$assets->cssInline[] = ':root {
            --sm-text-color: ' . $template->getMainconf('MC_COLOR_1') . ';
            --sm-link-color: ' . $template->getMainconf('MC_COLOR_2') . ';
            --sm-background: ' . $template->getMainconf('MC_COLOR_3') . ';
            --sm-bg-footer: ' . $template->getMainconf('MC_COLOR_5') . ';
            --sm-bg-header: ' . $template->getMainconf('MC_COLOR_4') . ';
            --sm-btn-color: ' . $template->getMainconf('MC_COLOR_6') . ';
            --sm-btn-text-color: ' . $template->getMainconf('MC_COLOR_BTN_TEXT') . ';
            --sm-grey-color: ' . $template->getMainconf('MC_COLOR_GREY') . ';
            }
          .p_img_href {height: ' . (SMALL_IMAGE_HEIGHT + 10) . 'px;
          line-height: ' . (SMALL_IMAGE_HEIGHT + 10) . 'px;}
          .p_img_href_list{max-width: ' . SMALL_IMAGE_WIDTH . 'px;}
          .product {height:' . (SMALL_IMAGE_HEIGHT + 134) . 'px;}
          .product_slider {height:' . (SMALL_IMAGE_HEIGHT + 140) . 'px;}
          @media (max-width:415px) {
            .product {height:' . (SMALL_IMAGE_HEIGHT + 175) . 'px;}
            .product_slider {height:' . (SMALL_IMAGE_HEIGHT + 185) . 'px;}
          }';

//listing labels
if ($template->show('LIST_LABELS')) {
    $labelConfig = $template->checkConfig('LISTING', 'LIST_LABELS');
    //mobile
    $assets->cssInline[] = '@media (max-width:415px) {';
    if ($labelConfig['show_all_on_mobile']['val']) {
        //display all
        $assets->cssInline[] = '.product .product_listing_labels .product_label {display: flex;}';
    } else {
        //hide all exclude first
        $assets->cssInline[] = '.product .product_listing_labels .product_label:not(:first-child) {display: none;}';
    }
    $assets->cssInline[] = '}';
    //desktop
    $assets->cssInline[] = '@media (min-width:415px) {';
    if ($labelConfig['show_all_on_desktop']['val']) {
        //display all
        $assets->cssInline[] = '.product .product_listing_labels .product_label {display: flex;}';
    } else {
        //hide all exclude first
        $assets->cssInline[] = '.product .product_listing_labels .product_label:not(:first-child) {display: none;}
            .product:hover .product_listing_labels .product_label {display: flex;}';
    }
    $assets->cssInline[] = '}';
} else {
    $assets->cssInline[] = '.product .product_listing_labels .product_label {display: none;}';
}

//BASIC styles for homePage, productDetail, productIndex, otherPage
$assets->mergeCss();

//CSS ProductDetail page
$assets->cssProductDetail[] = 'includes/javascript/lightbox/lightbox.min.css';
//CSS checkout page
$assets->cssCheckout[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/checkout.css';

//JS
$assets->js[] = 'includes/javascript/lib/jquery-3.5.1_fix_eventlistenter.min.js'; // <!-- Jquery Library-->
$assets->jsProductList[] = 'includes/javascript/jqueryui/js/jquery-ui-1.12.1.custom.min.js'; // <!-- Include all compiled plugins (below), or include individual files as needed -->
$assets->js[] = 'includes/javascript/functions.js'; // <!-- Functions -->
$assets->js[] = 'includes/javascript/init.js'; // <!-- Initialization -->
$assets->js[] = 'includes/javascript/superfish/superfish.js'; // <!-- PLUGINS -->
$assets->js[] = 'includes/javascript/superfish/jquery.hoverintent.js';
$assets->jsHomePage[] = 'includes/javascript/owl-carousel/owl.carousel.min.js';
$assets->jsProduct[] = 'includes/javascript/owl-carousel/owl.carousel.min.js';
$assets->jsProductList[] = 'includes/javascript/owl-carousel/owl.carousel.min.js';
$assets->jsHomePage[] = 'includes/javascript/lib/jquery.unveil.js';
$assets->jsProduct[] = 'includes/javascript/lib/jquery.unveil.js';
$assets->jsProductList[] = 'includes/javascript/lib/jquery.unveil.js';
$assets->js[] = 'includes/javascript/accordion/js/jquery.dcjqaccordion.js';
$assets->js[] = 'includes/javascript/lazyload.js';
$assets->js[] = 'includes/javascript/selectize/selectize.min.js';
$assets->js[] = 'includes/javascript/lib/bootstrap.min.js';
$assets->js[] = 'includes/javascript/google_oauth.js';
$assets->js[] = 'includes/javascript/datepicker/moment.min.js';
$assets->js[] = 'includes/javascript/datepicker/daterangepicker.js';
$assets->jsVariables[] = "var page_name = document.getElementsByTagName('body')[0].getAttribute('data-page-name');";
$assets->jsVariables[] = 'var mainPageModules = [];';
if ($template->show("LIST_MODAL_ON") == 'true') {
    $assets->js[] = DIR_WS_EXT . 'product_modal/product_modal.js';
}
/*$assets->jsInDocumentReady[] = 'if (!LongScriptsLoaded) {
        var cookie_date = new Date ( );
        cookie_date.setTime ( cookie_date.getTime()+60*60*28*1000); //24 hours
        document.cookie = "LongScriptsLoaded=1;path=/;expires=" + cookie_date.toGMTString();
    };';*/

//SLIDER CONFIG BLOCK
//when MINIFY_CSSJS == 1 we need add slider style to minify file
if ($file = $template->getFiles('MAINPAGE', 'M_SLIDE_MAIN', $config) && ($content == 'index_default' || MINIFY_CSSJS == 1)) {
    require_once(DIR_WS_MODULES . 'slider_main_config.php');
}
?>