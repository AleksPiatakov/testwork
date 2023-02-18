<?php
$assets->jsInline[] = "
var forms = document.getElementsByTagName('form');
var buttons, spans, links, formElements = [];
//collect form elements that may run submit form
for(var formIndex=0; formIndex < forms.length; formIndex++) { 
        buttons = forms[formIndex].getElementsByTagName('button');
        inputs = forms[formIndex].querySelectorAll('input[type=submit]');
        links = forms[formIndex].getElementsByTagName('a');
        if(buttons)formElements.push(buttons);
        if(inputs)formElements.push(inputs);
        if(links)formElements.push(links); 
}
//disable form elements that may run submit form
for(var tagIndex=0; tagIndex < formElements.length; tagIndex++) { 
            for(var elementIndex=0; elementIndex < formElements[tagIndex].length; elementIndex++) { 
                formElements[tagIndex][elementIndex].setAttribute('disabled',true);
            }
        }
";
$assets->js[] = 'includes/javascript/hookies.js';
if (file_exists('ext/autocomplete/autocomplete.js')) {
    $assets->js[] = 'includes/javascript/lib/jquery.autocomplete.js';
    $assets->js[] = 'ext/autocomplete/autocomplete.js';
}

$assets->jsCheckOut[] = 'includes/javascript/onepage/jquery.ajaxq-0.0.1.js';
$assets->jsCheckOut[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/checkout/config.js';
$assets->jsCheckOut[] = 'includes/javascript/checkout.js';

$assets->jsInline[] = 'makeJSConstantsFromJson();';
//template js:
if (file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/js/custom.js')) {
    $assets->js[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/js/custom.js';
}
if (file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/js/simplebar.js')) {
    $assets->js[] = DIR_WS_TEMPLATES . TEMPLATE_NAME . '/js/simplebar.js';
}

if (defined('COMPARE_MODULE_ENABLED') && COMPARE_MODULE_ENABLED == 'true') {
    $assets->js[] = 'ext/compare/compare.js';
}
if (defined('WISHLIST_MODULE_ENABLED') && WISHLIST_MODULE_ENABLED == 'true') {
    $assets->js[] = 'ext/wishlist/wishlist.js';
}
if (defined('MULTICOLOR_ENABLED') && MULTICOLOR_ENABLED == 'true') {
    $assets->js[] = 'ext/multicolor/multicolor.js';
} else {
    $assets->js[] = 'includes/javascript/change_image_attributes.js';
}

if (getConstantValue('GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED') === 'true') {
    if (is_file(DIR_WS_EXT . "google_analytics_and_targets/google_analytics_and_targets.php")) {
        require_once DIR_WS_EXT . "google_analytics_and_targets/google_analytics_and_targets.php";
    }
}

if (is_file(DIR_WS_EXT. "facebook_pixel/facebook_pixel.php")) {
    require_once DIR_WS_EXT. "facebook_pixel/facebook_pixel.php";
}

if (ATTRIBUTES_PRODUCTS_MODULE_ENABLED == 'true' && defined('SEO_FILTER') && constant('SEO_FILTER') == 'true') {
    $assets->jsProductList[] = 'ext/filter/filter_seo.js'; // <!--  Scripts for refreshing products-listing -->
    $assets->jsProductList[] = 'includes/javascript/jqueryui/js/jquery.ui.touch-punch.min.js';
} elseif (file_exists('ext/filter/filter.js')) {
    $assets->jsProductList[] = 'ext/filter/filter.js'; // <!--  Scripts for refreshing products-listing -->
    $assets->jsProductList[] = 'includes/javascript/jqueryui/js/jquery.ui.touch-punch.min.js';
}

$assets->jsProduct[] = 'includes/javascript/lightbox/lightbox.js';
$assets->jsProduct[] = 'includes/modules/rating/rating.js';

if (defined('GOOGLE_OAUTH_STATUS') && GOOGLE_OAUTH_STATUS == 'true') {
    $assets->jsVariables[] = "var googleClientID = '" . $googleClientID . "';var googleRedirectUri = '" . $googleRedirectUri . "';";
}
// scripts from admin
$assets->jsInline[] = strip_tags(renderArticle('scripts'));
$assets->jsInline[] = str_replace(array('<p>','</p>'),'',htmlspecialchars_decode(renderArticle(444)));

if(class_exists("\JsonLd\Container")) {
    \JsonLd\Container::generate();
}

$assets->jsVariables[] = "var timeoutValue = ".$assets::TIMEOUT_INTERVAL.';';
$assets->jsVariables[] = "var customizationPanelFlag = false;";
$assets->jsVariables[] = "var cPath = document.getElementsByTagName('body')[0].getAttribute('data-cpath');";
$assets->jsVariables[] = "var searchKeywords = document.getElementById('searchpr') ? document.getElementById('searchpr').value : '';";
$assets->jsVariables[] = "var productPriceOrign = document.querySelector('input[name=prod_price_orign]') ? document.querySelector('input[name=prod_price_orign]').value : '';";
$assets->jsVariables[] = "var currentProductPrice = document.querySelector('input[name=prod_price]') ? document.querySelector('input[name=prod_price]').value : '';";
$assets->jsVariables[] = "var currentProductId = document.getElementById('products_id') ? document.getElementById('products_id').value : '';";
$assets->jsVariables[] = "var currentProductName = document.querySelector('input[name=prod_name]') ? document.querySelector('input[name=prod_name]').value : '';";
$assets->jsVariables[] = "var currentProductCategoryName = document.querySelector('input[name=prod_category_name]') ? document.querySelector('input[name=prod_category_name]').value : '';";
$assets->jsVariables[] = "var IS_MOBILE = document.querySelector('body').getAttribute('data-ismobile')";
$assets->jsInline[] = "
    $('.ajax-module-box').each(function () {
        mainPageModules.push($(this).attr('data-module-id'));
    });
    //renderSlider(mainPageModules);
    makeMainSlider();
    if ($(window).width() > '991') {
      setTimeout(function () {
        $('.custom_panel_block').addClass('visible');
        $('.open_custom_panel_btn').removeClass('anim');
      }, 500);
    } else {
      $('.open_custom_panel_btn').addClass('anim');
    }
    blockUnveil(mainPageModules, 100);
    $(window).scroll(function() {
        blockUnveil(mainPageModules, 100);
        if(typeof window.loadFacebookWidget != 'undefined'){
            loadFacebookWidget();
        }
        checkIsCustomizationPanelVisible();
        checkAndAddMainStyles();
    });
    $(window).mousemove(function() {
        checkIsCustomizationPanelVisible();
        checkAndAddMainStyles();
    });
    ";
if (getConstantValue('GOOGLE_RECAPTCHA_STATUS', 'false') !== 'false' && is_file(DIR_WS_EXT . "recaptcha/recaptcha.php")) {
    $assets->jsInline[] = '
    function includeRecaptchaFile(){
        $.getScript("https://www.google.com/recaptcha/api.js");
    }
    function reCaptchaCallback(callback){
        $.ajax({
            url: "./ext/recaptcha/recaptcha.php",
            dataType: "json",
            method: "post",
            data: {"action": "checkResponseToken", "token": callback}
        }).done(function (response) {})
    }';
    $assets->jsInline[] = 'if(typeof includeRecaptchaFile == "function" && (page_name == "create_account" || page_name == "contact_us")){
        includeRecaptchaFile();
    }';
}
$assets->jsInTimeOut[] = '$.ajaxSetup({cache: true});
    $(".youtube_iframe").each(function () {
        $(this).attr("src",$(this).attr("data-src"));
    });';

/*if(file_exists(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/css/fonts.css')) {
    $assets->jsInTimeOut[] = 'if (!LongScriptsLoaded) {
        $("head").append("<link href=\''.DIR_WS_TEMPLATES . TEMPLATE_NAME.'\'/css/fonts.css\' rel=\'stylesheet\' type=\'text/css\'>"); // fonts
    }';
   }*/
if(SOCIAL_WIDGETS_ENABLED == 'true'){
    $assets->jsInline[] = '
    var loadFacebookWidgetFlag = false;
    function loadFacebookWidget(){
        if(IS_MOBILE == "0" && !loadFacebookWidgetFlag) { // dont start on mobile and main page
        loadFacebookWidgetFlag = true; 
        // facebook:
            $.getScript("//connect.facebook.net/'.$lng->language['code'].'_'.strtoupper($lng->language['code']).'/sdk.js", function(){
              FB.init({
                appId: "'.$fb_app_id.'",
                xfbml: true,
                version: "v3.2"
              });
              //   FB.Event.subscribe("edge.create", function(response) {alert("You will get discount 5%");});
              //   FB.Event.subscribe("edge.remove",function(response) {alert("Your discount 5% was canceled!");});
            });
        }
    }';
}
//JIVOSITE
if(is_file(DIR_WS_EXT . "jivosite/jivosite.php")) {
     require_once DIR_WS_EXT. "jivosite/jivosite.php";
}
//END JIVOSITE
    $assets->jsInline[] = '
     function makeMainSlider(){
         if($("#owl-frontslider").length == 0) {
             return false;
         }
         $.ajax({
             url: "./includes/modules/slider_main_config.php",
             type: "POST",
             data: {type:"get-slider"},
             success: function (response) {
                 $("#owl-frontslider").fadeOut(0,function(){
                     $("#owl-frontslider").html($(response).find("#owl-frontslider").html());
                     $("#owl-frontslider").after($(response).find("#carousel-custom-dots"));
                     $("#owl-frontslider").fadeIn(0);
                     $("#owl-frontslider").owlCarousel({
                         items: 1,
                         nav: true,
                         lazyLoad: true,
                         loop:true,
                         video:true,
                         navText:["<svg role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 320 512\"><path d=\"M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z\"></path></svg>","<svg role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 320 512\"><path d=\"M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z\"></path></svg>"],
                         autoplay: ' . ($autoplay ? : 'false'). ',
                         autoplayTimeout: ' . ($autoplay_delay ? : 1000 ). ',
                         dotsContainer: "#carousel-custom-dots",
                         autoplayHoverPause:true,
                         smartSpeed: 2000,
                         onInitialized:function () {$(".owl-carousel, .single_slide").removeAttr("style");$(".active .owl-video-play-icon").trigger("click");}, // autoplay video on slider load
                         onTranslated:function () {$(".active .owl-video-play-icon").trigger("click");} // autoplay video on change slide
                     });
                     $(".owl-dot").click(function () {
                         //  $(this).html();
                         $("#owl-frontslider").trigger("to.owl.carousel", [$(this).index(), 300]);
                     });
                 });
             }
         });
     }';
    $assets->jsInline[]="
    window.settings = {};
        window.settings.SHOW_BASKET_ON_ADD_TO_CART = " . getConstantValue('SHOW_BASKET_ON_ADD_TO_CART',"true") . ";
    ";
    $assets->jsInline[]='$(function() {
  // при нажатии на кнопку scrollup
  $(\'.scrollup\').click(function() {
    // переместиться в верхнюю часть страницы
    $("html, body").animate({
      scrollTop:0
    },1000);
  })
})
// при прокрутке окна (window)
$(window).scroll(function() {
  // если пользователь прокрутил страницу более чем на 200px
  if ($(this).scrollTop()>200) {
    // то сделать кнопку scrollup видимой
    $(\'.scrollup\').fadeIn();
    $(\'.scrollup\').css("display","flex");
      }
  // иначе скрыть кнопку scrollup
  else {
    $(\'.scrollup\').fadeOut();
  }
});';
$assets->jsInline[] = "
$('body').on('submit', 'form[name=\"cart_quantity\"]', function(event) {
    doHookie('add2cart');
});
$('body').on('click', '#jvlabelWrap, .online', function (event) {
    doHookie('click_chat');
});
$('body').on('click', '.phones_header a', function (event) {
    doHookie('phone_call');
});
$('body').on('submit', 'form[name=\"login\"]', function(event) {
    doHookie('login');
});
if(page_name == 'checkout_success'){
    var successPageProductsIds = document.getElementById(\"successPageProductsIds\") ? document.getElementById(\"successPageProductsIds\").value : \"\"; 
    var successPageProductsPrices = document.getElementById(\"successPageProductsPrices\") ? document.getElementById(\"successPageProductsPrices\").value : \"\";
    var contentsStr = '';
    var totalPrice = 0;
    if(successPageProductsIds != ''){
        contentsStr += '[';
        successPageProductsIds = eval(successPageProductsIds);
        for(i in successPageProductsIds){
            contentsStr += '{id: '+successPageProductsIds[i]+', quantity: 1},';
        }
        contentsStr = contentsStr.slice(0,-1)+']';
    }
    if(successPageProductsPrices != ''){
        successPageProductsPrices = eval(successPageProductsPrices);
        for(i in successPageProductsPrices){
            totalPrice += parseInt(successPageProductsPrices[i]);
        }
    }
    doHookie('checkout_success');
}
if(page_name == 'index_products' && searchKeywords != ''){
    doHookie('search');
}
if(page_name == 'logoff'){

    setTimeout(function(){

        location.reload();

    },1500);

}
if(page_name == 'create_account_success'){
    doHookie('complete_registration');
}
";
$assets->jsCheckoutInline[] = "var checkoutContentIdsStr = '';var checkoutSumm = 0;
$('#checkout_cart button.delete').each(function(){
    checkoutContentIdsStr += '{id: \"'+ $(this).attr('value') + '\", quantity:\"' + $(this).attr('data-quantity') + '\"},';
    checkoutSumm += parseInt($(this).attr('data-price-orign'))*parseInt($(this).attr('data-quantity'));
});
checkoutContentIdsStr = \"[\"+checkoutContentIdsStr.slice(0,-1)+\"]\";
doHookie('checkout_view');";
$assets->jsInDocumentReady[] = "doHookie('page_view');";
$assets->jsProductInline[] = "
$('body').on('click', '.add_comment_box [type=\"button\"]', function (event) {
    doHookie('add_review');
});
doHookie('product_view');
";

require(DIR_WS_JAVASCRIPT . 'onepagecheckout.js.php');

$assets->renderJsBlock($content);
if (isset($javascript) && file_exists(DIR_WS_JAVASCRIPT . basename($javascript))) {
    require(DIR_WS_JAVASCRIPT . basename($javascript));
}
echo "\t" . STORE_SCRIPTS(). "\n";
?>