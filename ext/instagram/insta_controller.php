<?php

include_once __DIR__ . '/insta_config.php';

$instaStatus = false;
$instagramConfig = $template->checkConfig('MAINPAGE', 'M_INSTAGRAM');

if ($template->show('M_INSTAGRAM') && !empty($instagramConfig['url']['val'])) {
    $instaStatus = true;
    //this code need for js file where will be this module show
    $instaJsCode = '
            var instaIsSlider = "' . ($instaIsSlider ? 1 : 0) . '";
            function instaBlockToSlider(){
                $("#' . $instaBlockId . '").owlCarousel({
                items:' . $instaDefaultItems . ',
                responsive:{
                    0:{items:' . $instaResponsiveArray[0] . ',nav:true},
                    600:{items:' . $instaResponsiveArray[1] . ',nav:true},
                    992:{items:' . $instaResponsiveArray[2] . ',nav:true,loop:true},
                    1200:{items:' . $instaResponsiveArray[3] . ',nav:true,loop:true},
                    1600:{items:' . $instaResponsiveArray[4] . ',nav:true,loop:true}
                },
                nav: true,
                loop:true,
                dots: false,
                navText:[\'' . $instaRtplArrowLeft . '\',\'' . $instaRtplArrowRight . '\'],
                slideSpeed: 200,
            });
            $("#' . $instaBlockId . '").on(\'changed.owl.carousel\', function(e) {
                    $("#' . $instaBlockId . ' img").lazyload();
                });
            }
            if(page_name == "index_default"){
                document.addEventListener("DOMContentLoaded", function () {
                    $.get( "' . $instaSolomonoApi . '", function( params ) {
                        $.post("' . DIR_WS_EXT . 'instagram/' . 'insta_feed.php", {insta_url: "' . $instagramConfig['url']['val'] . '",pixel_trans_url: "' . DIR_WS_IMAGES_CDN . 'pixel_trans.png",cookie:params.cookie}, function (data) {
                            $("#' . $instaBlockId . '").html(data);
                            $("#' . $instaBlockId . ' img").lazyload();
                            if(instaIsSlider == "1"){
                                instaBlockToSlider();
                            }
                        });
                    },"json");
                });
            }';
    $assets->jsHomePageInline[] = $instaJsCode;
    $assets->cssHomePage[] = 'ext/instagram/insta-style.css';
}
