<?php

// Settings
$any_out_of_stock = false;
foreach ($cart->contents as $id => $val) {
    $stock_check = tep_check_stock((int)$id, $val['qty']);
    if (tep_not_null($stock_check)) {
        $any_out_of_stock = true;
    }
}
$cart_count = $cart->count_contents(); // products in cart
$cart_total = $currencies->display_price($cart->show_total(), 0); // total amount with currency sign

// Show cart
if ($cart_count > 0) {
    $cart_img_class = 'cart_img_full';

    $cart_output = '<div>
              								<span class="quantity_basket popup_cart">' . $cart_count . '</span>
              								<span class="summ_basket popup_cart">' . BOX_HEADING_PRODUCTS . ' (' . $cart_total . ')</span>
              								<div class="img_basket popup_cart">
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                  <path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path>
                                </svg>
              								</div>
              							</div><div class="vertical_line"></div>
              							<a class="backet_checkout" href="' . tep_href_link(
                                                'checkout.php'
                                            ) . '"' . ($any_out_of_stock ? ' style="pointer-events: none;color:#999;"' : "") . '><span>' . IMAGE_BUTTON_CHECKOUT . '</span></a>';
} else {
    $cart_img_class = 'cart_img';

    $cart_output = '<div>
              								<span class="summ_basket empty_backet">' . BOX_SHOPPING_CART_EMPTY . '</span>
              								<div class="img_basket popup_cart">
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                  <path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path>
                                </svg>
              								</div>
              							</div>';
}

$cart_output = '<div class="basket" id="divShoppingCard">
                     <div id="shopping_cart_box">
                       ' . $cart_output . '
                     </div>
                   </div>';

$cart_output_mobile = '<a href="#" rel="nofollow" class="popup_cart basket_768">
                              <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path>
                              </svg>
                              <span class="mobile_cart_count quantity_basket_768">' . $cart_count . '</span>
                           </a>';
