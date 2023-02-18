<?php

$sliderAjaxRequest = false;
//don't change next line to isAjax() - we will have error
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && isset($_POST['type']) && $_POST['type'] == 'get-slider') {
    chdir('../../');
    require_once('includes/application_top.php');
    $config = $template->checkConfig('MAINPAGE', 'M_SLIDE_MAIN');
    $sliderAjaxRequest = true;
}

if (!function_exists('getConstantValue')) {
    if (empty($rootPath)) {
        chdir('../../');
        $rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
    }
    require($rootPath . '/includes/application_top.php');
} else {
    require_once(getConstantValue("DIR_WS_FUNCTIONS") . 'general.php');
}
$autoplay = $config['autoplay']['val'] ? 'true' : 'false';
$autoplay_delay = $config['autoplay_delay']['val'] ? $config['autoplay_delay']['val'] : '1000';
$item_limit_mobile = $config['limit_mobile']['val'] ?: 5;
$item_limit = $config['limit']['val'] ?: 5;
$banner_mobile_width = '395';
$banner_height = $bannerDesktopHeight = $config['height']['val'];
$slider_images = getArticles($config['id']['val'] ?: 22, isMobile() ? $item_limit_mobile : $item_limit, true, true);
if ($slider_images && count($slider_images)) {
    if (count($slider_images) > 1) {
        $slider_class = 'id="owl-frontslider" class="owl-carousel ' . (isMobile() ? 'mobile' : 'desktop') . '"';
        $slide_class = 'owl-lazy';
    } else {
        $slider_class = 'class="single_slide ' . (isMobile() ? 'mobile' : 'desktop') . '"';
        $slide_class = 'lazyload';
    }

    $sliderLocation = $template->settings['MAINPAGE']['M_SLIDE_MAIN']['location']; // is slider placed on 1st place?

    if ($config['width']['val'] == 2 and (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') or $sliderLocation == 1)) {
        $banner_width = '1920';
        $mainPadding0Class = 'class="mainPadding0Class"';
    } elseif ($config['width']['val'] == 1 and (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') or $sliderLocation == 1)) {
        $banner_width = '1410';
    } else {
        $banner_width = '1035';
    }


    $desktopRatio = (100 / $banner_width * $banner_height);

    //$bannerMobileHeight = (int)($banner_mobile_width * $banner_height / $banner_width); //  ratio depends on desktop sizes
    $bannerMobileHeight = (int)$config['height_mobile']['val']; // - ratio depends on mobile height
    $mobileRatio = (int)(100 / $banner_mobile_width * $bannerMobileHeight);

    if (isMobile()) {
        $banner_height = $bannerMobileHeight;
        $banner_width = $banner_mobile_width;
        $mobile_ratio = '&r=x';
    } else {
        $mobile_ratio = '';
    }

    $banner_size = '&w=' . $banner_width . '&h=' . $banner_height . $mobile_ratio;
    $banner_size2 = $banner_width . 'x' . $banner_height;
    if (!$sliderAjaxRequest) {
        //add slider style to to AppAssets
        $assets->cssHomePageInline[] = '
            #owl-frontslider.desktop .item, .single_slide .item, #owl-frontslider .item-video {padding-top : ' . $desktopRatio . '%;}
            #owl-frontslider.mobile .item, #owl-frontslider .item-video {padding-top : ' . $mobileRatio . '%;}
            #owl-frontslider.desktop .item > *, .single_slide .item > *, #owl-frontslider .item-video > * {margin-top : -' . $desktopRatio . '%;}
            #owl-frontslider.mobile .item > *, .single_slide .item > *, #owl-frontslider .item-video > * {margin-top : -' . $mobileRatio . '%;}
            @media (min-width : 481px) {
                #owl-frontslider {height: auto; max-height : ' . $bannerDesktopHeight . 'px;}
            }';
    }

    if ($sliderAjaxRequest) {
        echo require_once(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/boxes/mainpage_modules/slider_main.php');
        die;
    }
}
