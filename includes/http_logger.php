<?php

function validateUrlParams()
{
    $possibleParams = [
        //validate:
        'page' =>
            [
                'type' => 'int',
            ],
        //check:
        //many requests
        '_csrf' => [],      //'26a50472df903373668cd65e5e4545e9191bdcdc5932fffe9bc63c238767dc5f'

        //main
        //includes/modules/slider_main_config.php
        'type' => [],       //'get-slider'
        //routes.php
        'render' => [],     //'last_viewed_products'

        //product info
        //ajax_product_in_cart.php (change color)
        'cartKey' => [],    //'521{1}52{11}110'

        //cart
        //popup_cart.php
        //'_csrf' => [],        //duplicate //'26a50472df903373668cd65e5e4545e9191bdcdc5932fffe9bc63c238767dc5f',
        'id' => [],             //array ( '521{1}52{11}110' => array ( 1 => '52',  11 => '110', ), ),
        'cart_quantity' => [],  //array ( 0 => '1', ),
        'products_id' => [],    //array ( 0 => '521{1}52{11}110', ),

        //add to cart from product list
        //index.php
        //'products_id' => [],      //duplicate //'521'
        //'cart_quantity' => [],    //duplicate //'1'

        //add to cart from product info
        //product_info.php
        //'_csrf' => [],            //duplicate //'26a50472df903373668cd65e5e4545e9191bdcdc5932fffe9bc63c238767dc5f'
        //'products_id' => [],      //duplicate //'521',
        //'cart_quantity' => [],    //duplicate //'1',
        //'id' => [],               //duplicate //array ( 1 => '52', 11 => '110', )
        '1' => [],                  //'52'
        'option_name' => [],        //'11'
        'id_option_other' => [],    //'0'
        'id_color' => [],           //'1'
        'prod_price_orign' => [],   //'4'
        'old_prod_price' => [],     //'105'
        'prod_price' => [],         //'105'
        'prod_name' => [],          //'Meizu PRO 7 Plus'
        'prod_category_name' => [], //'Meizu'
        'prod_currency_left' => [], //'$'
        'prod_currency_right' => [], //'грн'
        'prod_thousands_point' => [], //'.'
        'prod_dec_point' => [],     //','
        'prod_dec_places' => [],    //'0'
        'color_id' => [],           //'1'
        'color_images' => [],       //'pro7_1.jpg;pro7_3.jpg;pro7_5.jpg;pro7_6.jpg;pro7_7.jpg;pro7_9.jpg'

        //cart delete
        //'_csrf' => [],        //duplicate // '26a50472df903373668cd65e5e4545e9191bdcdc5932fffe9bc63c238767dc5f'
        //'cart_quantity' => [],  //duplicate //array ( 0 => '1', )
        //'products_id' => [],  //duplicate //array ( 0 => '521', )
        'cart_delete' => [],    //array ( 0 => '521', )

        //checkout
        //checkout.php

        //update methods
        'action' => [],         //'updateShippingMethods', 'setCheckoutAddressField', 'getOrderTotals',
        'open_tab' => [],       //'false'
        'addresstype' => [],    //'shipping',
        'field' => [],          //'country_id',
        'value' => [],          //'223',
        'method' => [],         //'stripe',
        'randomNumber' => [],   //'0.38681295960489015',

        //checkEmailAddress
        'emailAddress' => [],   //'checkEmailAddress',

        //edit checkout form fields
        //'action' => [],               //duplicate //'setSendTo',
        'shipping_firstname' => [],     //'Name',
        'shipping_lastname' => [],      //'Lastname',
        'billing_email_address' => [],  //'test@gmail.com',
        'billing_telephone' => [],      //'+00000000000',
        'shipping_company' => [],       //'dsfdsf',
        'shipping_street_address' => [], //'1 april',
        'shipping_city' => [],          //'Kyiv',
        'shipping_zone_id' => [],       //'2',
        'shipping_suburb' => [],        //'',
        'shipping_zipcode' => [],       //'52000',
        'shipping_country' => [],       //'223',
        'password' => [],               //'',
        'confirmation' => [],           //'',

        //send checkout code
        //'action' => [],       //duplicate //'updateCheckoutCart',
        'gv_redeem_code' => [], //'tester-404',

        //products list

        //add to wishlist
        //ext/wishlist/ajax_wishlist.php
        //'action' => [],   //duplicate //'add'
        //'id' => [],       //duplicate //'521{1}52{11}110'
        'request' => [],    //'wishlist'

        //bug_message in footer
        //ajax.php
        //'request' => [],  //duplicate //'getBugReportForm',

        //on poll
        //pollcollect.php
        //'_csrf' => [],    //duplicate
        'pollid' => [],     //'7'
        'forwarder' => [],  //'pollbooth.php?op=results&pollid=7'
        'voteid' => [],     //'1'
        'submit_choice' => [], //''
        //login in modal or page
        //login.php
        'submit_enter' => [],
        'email_address' => [],
    ];

    doValidateUrlParams($_GET, $possibleParams, 'GET');
    doValidateUrlParams($_POST, $possibleParams, 'POST', true);
}

function doValidateUrlParams(array &$array, array $possibleParams, $fileLogName = 'POST', $saveUndefinedParams = false)
{
    foreach ($array as $param => $value) {
        if (isset($possibleParams[$param]) && is_array($possibleParams[$param])) {
            foreach ($possibleParams[$param] as $checkKey => $checkValue) {
                switch ($checkKey) {
                    case 'type':
                        switch ($checkValue) {
                            case 'int':
                                $array[$param] = (int)$value;
                        }
                        break;
                }
            }
        } elseif ($saveUndefinedParams) {
            //save to logs Requests Params If Is Undefined Param in Request
            $fileLogName = str_replace(' ', '', strtoupper($fileLogName));

            \App\Logger\Log::channel('all')->info("HTTP/{$fileLogName}", [
                'REQUEST_URI' => $_SERVER['REQUEST_URI'],
                'PHP_SELF' => $_SERVER['PHP_SELF'],
                $fileLogName => var_export($array, true)
            ]);
        }
    }
}
