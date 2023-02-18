<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 17.03.2021
 * Time: 14:14
 */

require_once "check.php";

if (GOOGLE_ANALYTICS_AND_TAGS_MODULE_ENABLED === 'true') {
    if ($assets && !isAjax()) {
        //initialization
        if (!empty(getConstantValue('GOOGLE_TAGS_ID')) || !empty(getConstantValue('GOOGLE_TAG_MANAGER_ID'))) {
            //set variables
            $assets->jsInline[] = 'var isNeedTimeout = true;';

            //set interact analytic function
            $assets->jsInline[] = '
            function gtag() {
                window.dataLayer = window.dataLayer || [];
                window.dataLayerBuffer = window.dataLayerBuffer || [];
                params = arguments.length == 1 ? arguments[0] : arguments;
                if(isNeedTimeout){
                    dataLayerBuffer.push(params);
                }else{
                    dataLayer.push(params);
                }
            }';

            //set interact ecommerce function
            $assets->jsInline[] = '
            function ge() {
                window.gaBuffer = window.gaBuffer || [];
                if (isNeedTimeout) {
                    gaBuffer.push(arguments);
                } else {
                    ga(arguments);
                }
            }';

            //function on gtag load
            //send all buffered data(events after dom load) and prevent future buffering
            $assets->jsInline[] = '
            function gtagLoad (){
                isNeedTimeout = false;
                /*gtag, gtm*/
                dataLayerBuffer.forEach(function(element) {
                    dataLayer.push(element);
                });
                /*ecommerce*/
                gaBuffer.forEach(function(element) {
                    ga(element);
                });
            }';
        } else {
            $assets->jsInline[] = 'function gtag() {return false;}';
            $assets->jsInline[] = 'function ge() {return false;}';
        }

        $googleTagsScripts = [];

        //gtag
        if (defined('GOOGLE_TAGS_ID') && tep_not_null(GOOGLE_TAGS_ID)) {
            //set gtag script
            $googleTagsScripts[] = '$.getScript("//www.googletagmanager.com/gtag/js?id=' . GOOGLE_TAGS_ID . '")';

            //set default data
            $assets->jsInline[] = '
            gtag("js", new Date());
            gtag("config", "' . GOOGLE_TAGS_ID . '");';
        }

        //gtm
        if (defined('GOOGLE_TAG_MANAGER_ID') && tep_not_null(GOOGLE_TAG_MANAGER_ID)) {
            //set gtm script
            $googleTagsScripts[] = '$.getScript("//www.googletagmanager.com/gtm.js?id=' . GOOGLE_TAG_MANAGER_ID . '")';

            //set default data
            $assets->jsInline[] = '
            gtag({
                "gtm.start": new Date().getTime(), 
                "event": "gtm.js"
            });';
        }

        //draw scripts
        if (!empty($googleTagsScripts)) {
            //format output
            $googleTagsScripts = '$.when(' . implode(', ', $googleTagsScripts) . ').done(function(){gtagLoad();});';

            //draw output
            $assets->jsInline[] = '
            if(page_name == "checkout_success"){
                ' . $googleTagsScripts . '
            } else {
                setTimeout(function(){' . $googleTagsScripts . '}, timeoutValue);
            }';
        }
    } elseif ($assets) {
        $assets->jsInline[] = 'function gtag() {return false;}';
        $assets->jsInline[] = 'function ge() {return false;}';
    }

    //google goals
    if (GOOGLE_GOALS_ADD_TO_CART === 'true') {
        $assets->jsInline[] = 'addHookie("add2cart","gtag(\"event\", \"add_to_cart\")");';
    }
    if (GOOGLE_GOALS_CLICK_ON_CHAT === 'true') {
        $assets->jsInline[] = 'addHookie("click_chat","gtag(\"event\", \"click_chat\")");';
    }
    if (GOOGLE_GOALS_ON_CHECKOUT === 'true') {
        $assets->jsCheckoutInline[] = 'addHookie("checkout_view","gtag(\"event\", \"checkout_view\")");';
    }
    if (GOOGLE_GOALS_CHECKOUT_PROCESS === 'true') {
        $assets->jsCheckoutInline[] = 'addHookie("checkout_progress","gtag(\"event\", \"checkout_progress\")");';
    }
    if (GOOGLE_GOALS_CLICK_FAST_BUY === 'true') {
        $assets->jsInline[] = 'addHookie("fast_buy","gtag(\"event\", \"fast_buy\")");';
    }
    if (GOOGLE_GOALS_CLICK_ON_PHONE === 'true') {
        $assets->jsInline[] = 'addHookie("phone_call","gtag(\"event\", \"phone_call\")");';
    }
    if (GOOGLE_GOALS_CLICK_ON_BUG_REPORT === 'true') {
        $assets->jsInline[] = 'addHookie("bug_report","gtag(\"event\", \"bug_report\")");';
    }
    if (GOOGLE_GOALS_PAGE_VIEW === 'true') {
        $assets->jsInline[] = 'addHookie("page_view","gtag(\"event\", \"page_view\")");';
    }
    if (GOOGLE_GOALS_CALLBACK === 'true') {
        $assets->jsInline[] = 'addHookie("callback","gtag(\"event\", \"callback\")");';
    }
    if (GOOGLE_GOALS_FILTER === 'true') {
        $assets->jsInline[] = 'addHookie("filter","gtag(\"event\", \"filter\")");';
    }
    if (GOOGLE_GOALS_SUBSCRIBE === 'true') {
        $assets->jsHomePageInline[] = 'addHookie("subscribe","gtag(\"event\", \"subscribe\")");';
    }
    if (GOOGLE_GOALS_LOGIN === 'true') {
        $assets->jsInline[] = 'addHookie("login","gtag(\"event\", \"login\")");';
    }
    if (GOOGLE_GOALS_ADD_REVIEW === 'true') {
        $assets->jsInline[] = 'addHookie("add_review","gtag(\"event\", \"add_review\")");';
    }
    if (GOOGLE_GOALS_CONTACT_US === 'true') {
        $assets->jsInline[] = 'addHookie("contact_us","gtag(\"event\", \"contact_us\")");';
    }
    if (GOOGLE_GOALS_CHECKOUT_SUCCESS === 'true') {
        $assets->jsInline[] = 'addHookie("checkout_success","gtag(\"event\", \"checkout_success\")");';
    }
    //google goals END

    //google ecommerce goals
    $gtagScriptPrefix = "gtag('event', 'page_view', {'send_to': '" . (constant('GOOGLE_TAGS_ID') ?: constant('GOOGLE_TAG_MANAGER_ID')) . "',";
    $gtagScriptPostfix = "});";

    //search page view (product list page + keywords)
    if (GOOGLE_ECOMM_SEARCH_RESULTS === 'true') {
        $gJsScript = '
        var productsPricesForAnalytics = document.querySelector(".productsPricesForAnalytics") ? document.querySelector(".productsPricesForAnalytics").value : "";
        var productsIdsForAnalytics = document.querySelector(".productsIdsForAnalytics") ? document.querySelector(".productsIdsForAnalytics").value : "";
        if(page_name == "index_products" && searchKeywords != "" && productsIdsForAnalytics != "" && productsPricesForAnalytics != ""){
            ' . $gtagScriptPrefix . PHP_EOL . '
            "ecomm_prodid": productsIdsForAnalytics,' . PHP_EOL . '
            "ecomm_pagetype": "searchresults",' . PHP_EOL . '
            "ecomm_totalvalue": productsPricesForAnalytics
            ' . PHP_EOL . $gtagScriptPostfix . '
        }
    ';
        $assets->jsInline[] = $gJsScript;
    }

    //homepage view
    if (GOOGLE_ECOMM_HOME_PAGE === 'true') {
        $gJsScript = '
        if(cPath == ""){
            ' . $gtagScriptPrefix . PHP_EOL . '
            "ecomm_pagetype": "home",' . PHP_EOL . '
            ' . $gtagScriptPostfix . '
        }';
        $assets->jsHomePageInline[] = $gJsScript;
    }

    //product detail page view
    if (GOOGLE_ECOMM_PRODUCT_DETAIL_PAGE === 'true') {
        $gJsScript = '
        ' . $gtagScriptPrefix . PHP_EOL . '
        "ecomm_prodid": currentProductId,' . PHP_EOL . '
        "ecomm_pagetype": "product",' . PHP_EOL . '
        "ecomm_totalvalue": currentProductPrice
        ' . $gtagScriptPostfix;
        $assets->jsProductInline[] = $gJsScript;
    }

    //checkout page view
    //TODO need to add for popup_cart.php
    if (GOOGLE_ECOMM_CHECKOUT_PAGE === 'true') {
        $gJsScript = '
        var checkoutProductsIds = []; 
        var checkoutProductsPrices = [];
        $("#checkout_cart .checkout__purchase_price .delete").each(function(){
            checkoutProductsIds.push($(this).attr("value"));
            checkoutProductsPrices.push($(this).attr("data-clear-price"));
        });
        checkoutProductsIds = "[\'"+checkoutProductsIds.join("\',\'")+"\']";
        checkoutProductsPrices = "[\'"+checkoutProductsPrices.join("\',\'")+"\']";
        ' . $gtagScriptPrefix . PHP_EOL . '
        "ecomm_prodid": checkoutProductsIds,' . PHP_EOL . '
        "ecomm_pagetype": "cart",' . PHP_EOL . '
        "ecomm_totalvalue": checkoutProductsPrices
        ' . $gtagScriptPostfix;
        $assets->jsCheckoutInline[] = $gJsScript;
    }

    //draw send data of order functions
    if (file_exists(DIR_WS_EXT . 'google_analytics_and_targets/google_ecommerce.php')) {
        if (GOOGLE_ECOMM_SUCCESS_PAGE === 'true' && $content == CONTENT_CHECKOUT_SUCCESS) {
            //checkout success event
            $order_id = (int)$_GET['order_id'];
            require('google_ecommerce.php');
            $assets->jsInline[] = 'drawEcommerce();';
        } elseif (GOOGLE_ECOMM_CLICK_FAST_BUY === 'true') {
            //fast buy success event
            $productsId = (int)$_GET['products_id'];
            require('google_ecommerce.php');
            $assets->jsInline[] = 'addHookie("fast_buy_success","drawEcommerce()");';
        }
    }

    //checkout success page view
    if (GOOGLE_ECOMM_SUCCESS_PAGE === 'true') {
        $gJsScript = '
        if(page_name == "checkout_success"){
            var successPageProductsIds = document.getElementById("successPageProductsIds") ? document.getElementById("successPageProductsIds").value : ""; 
            var successPageProductsPrices = document.getElementById("successPageProductsPrices") ? document.getElementById("successPageProductsPrices").value : "";
            ' . $gtagScriptPrefix . PHP_EOL . '
            "ecomm_prodid": successPageProductsIds,' . PHP_EOL . '
            "ecomm_pagetype": "purchase",' . PHP_EOL . '
            "ecomm_totalvalue": successPageProductsPrices
             ' . $gtagScriptPostfix . '
        }';

        $assets->jsInline[] = $gJsScript;
    }
    //google ecommerce goals END
}
