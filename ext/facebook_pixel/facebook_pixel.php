<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require_once "check.php";

if (!defined('DEFAULT_PIXEL_CURRENCY')) {
    define('DEFAULT_PIXEL_CURRENCY', 'USD');
}
if (FACEBOOK_PIXEL_MODULE_ENABLED === 'true' && tep_not_null(FACEBOOK_PIXEL_ID) && $assets) {
    $assets->jsInline[] = ' 
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version=\'2.0\';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,"script","https://connect.facebook.net/en_US/fbevents.js");
        fbq("init", "' . FACEBOOK_PIXEL_ID . '");';
} elseif ($assets) {
    $assets->jsInline[] = 'function fbq() {return false;}';
}
if (FACEBOOK_GOALS_PAGE_VIEW === 'true') {
    $assets->jsInline[] = 'addHookie("page_view","fbq(\"track\", \"PageView\")");';
}

if (FACEBOOK_GOALS_ADD_TO_CART === 'true') {
    $assets->jsInline[] = 'addHookie("add2cart","fbq(\"track\", \"AddToCart\",{content_type: \"product\",content_ids: [currentProductId], content_name: currentProductName, num_items: 1, content_category: currentProductCategoryName,value: productPriceOrign, currency: \"' . DEFAULT_PIXEL_CURRENCY . '\"});");';
}

//InitiateCheckout
if (FACEBOOK_GOALS_CHECKOUT_PROCESS === 'true') {
    $assets->jsCheckoutInline[] = 'addHookie("checkout_view","fbq(\"track\", \"InitiateCheckout\",{contents: checkoutContentIdsStr,content_type: \"product\", value: checkoutSumm, currency: \"USD\"});");';
}

//Search - ProductList Page + keywords
if (FACEBOOK_GOALS_SEARCH_RESULTS === 'true') {
    $assets->jsInline[] = 'addHookie("search","fbq(\"track\", \"Search\");");';
}

//CompleteRegistration
if (FACEBOOK_GOALS_COMPLETE_REGISTRATION === 'true') {
    $assets->jsInline[] = 'addHookie("complete_registration","fbq(\"track\", \"CompleteRegistration\");");';
}
//ViewContent
if (FACEBOOK_GOALS_VIEW_CONTENT === 'true') {
    $fJsScript = "addHookie(\"product_view\",\"fbq('track', 'ViewContent', {content_type: 'product',content_ids: [currentProductId],content_name: currentProductName, content_category: currentProductCategoryName,value: productPriceOrign,currency: '" . DEFAULT_PIXEL_CURRENCY . "'});\");";
    $assets->jsProductInline[] = $fJsScript;
}
//Lead
if (FACEBOOK_GOALS_CONTACT_US_REQUEST === 'true') {
    $assets->jsInline[] = 'addHookie("contact_us","fbq(\"track\", \"Lead\",{email:$(\'form[name=contact_us] input[name=email]\').val(),phone:$(\'form[name=contact_us] input[name=phone]\').val()});");';
}
//AddToWishlist
if (FACEBOOK_GOALS_ADD_TO_WISHLIST === 'true') {
    $assets->jsInline[] = 'addHookie("add_to_wishlist","fbq(\"track\", \"AddToWishlist\", {content_type: \"product\", content_ids: [prodId], content_name: prodName, num_items: 1, content_category: prodCatName, value: prodPrice, currency: \"' . DEFAULT_PIXEL_CURRENCY . '\"});");';
}
//AddPaymentInfo
if (FACEBOOK_GOALS_ADD_PAYMENT_INFO === 'true') {
    $assets->jsCheckoutInline[] = 'addHookie("add_payment_info","fbq(\"track\", \"AddPaymentInfo\");");';
}
//Purchase
if (FACEBOOK_GOALS_SUCCESS_PAGE === 'true') {
    $assets->jsInline[] = '
    if(page_name == "checkout_success"){
        addHookie("checkout_success","fbq(\"track\", \"Purchase\",{value: totalPrice,currency: \"' . DEFAULT_PIXEL_CURRENCY . '\",contents: contentsStr,content_type: \'product\'});");
    }';
}
//FastBy
if (FACEBOOK_GOALS_CLICK_FAST_BUY === 'true') {
    $assets->jsInline[] = 'addHookie("fast_buy","fbq(\"trackCustom\", \"FastBuy\",{content_type: \"product\",content_ids: [currentProductId], content_name: currentProductName, num_items: 1, content_category: currentProductCategoryName,value: productPriceOrign, currency: \"' . DEFAULT_PIXEL_CURRENCY . '\"});");';
}
//click Chat button
if (FACEBOOK_GOALS_CLICK_ON_CHAT === 'true') {
    $assets->jsInline[] = 'addHookie("click_chat","fbq(\"trackCustom\", \"ClickChat\")");';
}
//callback
if (FACEBOOK_GOALS_CALLBACK === 'true') {
    $assets->jsInline[] = 'addHookie("callback","fbq(\"trackCustom\", \"Callback\",{content_type:\"page\",url:location.href})");';
}
//phone_call
if (FACEBOOK_GOALS_PHONE_CALL === 'true') {
    $assets->jsInline[] = 'addHookie("phone_call","fbq(\"trackCustom\", \"PhoneCall\",{content_type:\"page\",url:location.href})");';
}
//filtered product
if (FACEBOOK_GOALS_FILTER === 'true') {
    $assets->jsInline[] = 'addHookie("filter","fbq(\"trackCustom\", \"filter\",{content_type:\"page\",url:location.href})");';
}
//subscribe
if (FACEBOOK_GOALS_SUBSCRIBE === 'true') {
    $assets->jsInline[] = 'addHookie("subscribe","fbq(\"track\", \"Subscribe\",{content_type:\"page\",email:$(\'.form_subscribe_news input[type=\"email\"]\').val()})");';
}
//login
if (FACEBOOK_GOALS_LOGIN === 'true') {
    $assets->jsInline[] = 'addHookie("login","var email_address = $(\'form[name=login] input[name=email_address]\').val(); if(typeof email_address == \"undefined\"){email_address = socEmailAddress} fbq(\"trackCustom\", \"login\",{content_type:\"page\",email:email_address})");';
}
//add_review
if (FACEBOOK_GOALS_ADD_REVIEW === 'true') {
    $assets->jsInline[] = 'addHookie("add_review","var userNick = $(\'#nickAnswer\').val(); var reviewProductId = $(\'.add_comment_box input[name=pid]\').val(); fbq(\"trackCustom\", \"add_review\",{content_type:\"page\",userNick:userNick,ProductId:reviewProductId})");';
}
//bug_report
if (FACEBOOK_GOALS_CLICK_ON_BUG_REPORT === 'true') {
    $assets->jsInline[] = 'addHookie("bug_report","fbq(\"trackCustom\", \"BugReport\",{content_type:\"page\",url:location.href})");';
}
