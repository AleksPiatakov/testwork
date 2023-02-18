<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    require('includes/application_top.php');
    require $template->requireBox('H_SHOPPING_CART');
    $cart_key = $_POST['cartKey'];
    $in_cart = $cart->in_cart($cart_key);
    if ($in_cart) {
        $add_to_cart = RTPL_CART_BUTTON_PRODUCT_PAGE;
    } else {
        if (isset($_POST["is_modal"]) && $_POST["is_modal"] === 'true') {
            $add_to_cart = RTPL_ADD_TO_CART_BUTTON_MODAL;
        } else {
            $add_to_cart = RTPL_ADD_TO_CART_BUTTON_PRODUCT_PAGE;
        }
    }
    echo json_encode(array(/*'in_cart'=> $in_cart,*/ 'button_html' => $add_to_cart/*,'cartKey'=> $_POST['cartKey']*/));
}
