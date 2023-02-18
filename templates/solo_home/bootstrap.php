<?php

// QUERIES FOR COLUMNS

$body_classes = array();
$center_margin = '';
$sidebar_left = $template->getMainconf('MC_SHOW_LEFT_COLUMN') ?: false;

$logoConfigs = $template->checkConfig('HEADER', 'H_LOGO');
if (isMobile()) {
    $logo_width = $logoConfigs['logo_width_mobile']['val'] ?: 25;
    $logo_height = $logoConfigs['logo_height_mobile']['val'] ?: 25;
    //$logo_width = $logo_height = 150;
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

if ((is_array($cPath_array) and count($cPath_array)) or isset($_GET['manufacturers_id'])) {
    $sidebar_left = true;
    array_push($body_classes, 'index_products');
}
// IF PRODUCT INFO
if (isset($_GET['products_id']) || $content == 'checkout' || $content == 'compare') {
    $sidebar_left = false;
    $show_breadcrumbs = true;
}
if (isset($_GET['products_id'])) {
    array_push($body_classes, 'product_page');
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
}

// DEFINE CLASSES FOR COLUMNS
if ($sidebar_left) {
    array_push($body_classes, 'one-sidebar', 'left-sidebar');
    $center_classes .= 'col-xs-12 col-sm-12 col-md-9';
} else {
    $center_margin = '';
    $center_classes .= 'col-xs-12 col-sm-12 col-md-12 ';
}

if (isset($_GET['products_id'])) {
    $squeeze_margin = "margin:0 0 0 0;";
}
if (!empty($body_classes) and is_array($body_classes)) {
    $body_class = implode(' ', $body_classes);
}
// echo '<pre>',var_dump($body_class),'</pre>';
$breadcrumb_container_begin = $breadcrumb_container_end = '';
if (
    ($content == 'product_info' and !$template->show(
        'P_BREADCRUMB'
    )) or ($content == 'index_products' and !$template->show('LIST_BREADCRUMB'))
) {
    $show_breadcrumbs = false;
}
$assets->cssFilesForClone = [$assets::CSS_FILE_PRODUCT_LIST, $assets::CSS_FILE_OTHER];
$assets->jsFilesForClone = [$assets::JS_FILE_OTHER];
$assets->css[] = DIR_WS_JAVASCRIPT . 'jqueryui/css/smoothness/jquery-ui-1.10.4.custom.min.css';
$assets->css[] = DIR_WS_JAVASCRIPT . 'owl-carousel/owl.carousel.css';
$assets->css[] = DIR_WS_JAVASCRIPT . 'owl-carousel/owl.theme.css';
$assets->css[] = DIR_WS_JAVASCRIPT . 'selectize/selectize.css';
$assets->css[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/bootstrap.min.css';
$assets->css[] = DIR_WS_TEMPLATES . 'default/stylesheet.css'; // <!-- default css -->
$assets->css[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/theme.css';
$assets->css[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/responsive.css';
$assets->css[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/fonts.css';
$assets->cssInline[] = ':root {
              --sm-text-color: ' . $template->getMainconf('MC_COLOR_1') . ';
              --sm-link-color: ' . $template->getMainconf('MC_COLOR_2') . ';
              --sm-background: ' . $template->getMainconf('MC_COLOR_3') . ';
              --sm-bg-footer: ' . $template->getMainconf('MC_COLOR_5') . ';
              --sm-bg-header: ' . $template->getMainconf('MC_COLOR_4') . ';
              --sm-btn-color: ' . $template->getMainconf('MC_COLOR_6') . ';
              --sm-btn-text-color: ' . $template->getMainconf('MC_COLOR_BTN_TEXT') . ';
              --sm-grey-color: ' . $template->getMainconf('MC_COLOR_GREY') . ';
              --lg-product: height:' . ((int)SMALL_IMAGE_HEIGHT + 93) . 'px;
 }
              .p_img_href {height: ' . (SMALL_IMAGE_HEIGHT) . 'px;line-height: ' . (SMALL_IMAGE_HEIGHT) . 'px;}
              .p_img_href_list{max-width: ' . SMALL_IMAGE_WIDTH . 'px;}
              .product_slider {height:' . ((int)SMALL_IMAGE_HEIGHT + 295) . 'px;}
              @media (max-width: 1199px) {
                .p_img_href {height: ' . ((int)SMALL_IMAGE_HEIGHT - 30) . 'px;line-height: ' . ((int)SMALL_IMAGE_HEIGHT - 30) . 'px;}
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
$assets->js[] = 'includes/javascript/jqueryui/js/jquery-ui-1.12.1.custom.min.js'; // <!-- Include all compiled plugins (below), or include individual files as needed -->
$assets->js[] = 'includes/javascript/bootstrap-tabcollapse.js';
$assets->js[] = 'includes/javascript/bootstrap-number-input.js';
$assets->js[] = 'includes/javascript/functions.js'; // <!-- Functions -->
$assets->js[] = 'includes/javascript/init.js'; // <!-- Initialization -->
$assets->js[] = 'includes/javascript/superfish/superfish.js'; // <!-- PLUGINS -->
$assets->js[] = 'includes/javascript/superfish/jquery.hoverintent.js';
$assets->js[] = 'includes/javascript/lib/jquery.form.js';
$assets->js[] = 'includes/javascript/owl-carousel/owl.carousel.min.js';
$assets->js[] = 'includes/javascript/lib/jquery.unveil.js';
$assets->js[] = 'includes/javascript/accordion/js/jquery.dcjqaccordion.js';
$assets->js[] = 'includes/javascript/lazyload.js';
$assets->js[] = 'includes/javascript/selectize/selectize.min.js';
$assets->js[] = 'includes/javascript/lib/bootstrap.min.js';
$assets->js[] = 'includes/javascript/google_oauth.js';
$assets->jsVariables[] = "var page_name = document.getElementsByTagName('body')[0].getAttribute('data-page-name');";
$assets->jsVariables[] = 'var mainPageModules = [];';

if ($template->show("LIST_MODAL_ON") == 'true') {
    $assets->js[] = DIR_WS_EXT . 'product_modal/product_modal.js';
    $assets->css[] = DIR_WS_EXT . 'product_modal/product_modal.css';
}
