<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    require('includes/application_top.php');
    require $template->requireBox('H_SHOPPING_CART');

    echo json_encode(array('cart_html' => $cart_output, 'cart_count' => $cart_count));
}
