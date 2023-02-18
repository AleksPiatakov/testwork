<?php

$cart_count = $cart->count_contents(); // products in cart
$cart_total = $currencies->format($cart->show_total()); // total amount with currency sign

// Show cart
if ($cart_count > 0) {
    $cart_img_class = 'cart_img_full';

    $cart_output = '<div class="position-relative popup_cart cart-not-empty" data-toggle="tooltip" data-placement="auto bottom" title="' . BUTTON_SHOPPING_CART_OPEN . '">
                                <span class="quantity_basket">' . $cart_count . '</span>
                                <a href="#" class="img_basket">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <ellipse transform="rotate(-1.057 159.995 423.97) scale(.99997)" cx="160" cy="424" rx="24" ry="24"></ellipse>
                                        <ellipse transform="matrix(.02382 -.9997 .9997 .02382 -48.51 798.282)" cx="384.5" cy="424" rx="24" ry="24"></ellipse>
                                        <path d="M463.8 132.2c-.7-2.4-2.8-4-5.2-4.2L132.9 96.5c-2.8-.3-6.2-2.1-7.5-4.7-3.8-7.1-6.2-11.1-12.2-18.6-7.7-9.4-22.2-9.1-48.8-9.3-9-.1-16.3 5.2-16.3 14.1 0 8.7 6.9 14.1 15.6 14.1s21.3.5 26 1.9c4.7 1.4 8.5 9.1 9.9 15.8 0 .1 0 .2.1.3.2 1.2 2 10.2 2 10.3l40 211.6c2.4 14.5 7.3 26.5 14.5 35.7 8.4 10.8 19.5 16.2 32.9 16.2h236.6c7.6 0 14.1-5.8 14.4-13.4.4-8-6-14.6-14-14.6H188.9c-2 0-4.9 0-8.3-2.8-3.5-3-8.3-9.9-11.5-26l-4.3-23.7c0-.3.1-.5.4-.6l277.7-47c2.6-.4 4.6-2.5 4.9-5.2l16-115.8c.2-.8.2-1.7 0-2.6z"></path>
                                    </svg>
                                </a>
                            </div>';
} else {
    $cart_img_class = 'cart_img';

    $cart_output = '<div class="popup_cart" data-toggle="tooltip" data-placement="auto bottom" title="' . BUTTON_SHOPPING_CART_OPEN . '">
                                <span class="summ_basket empty_backet"></span>
                                <a href="#" class="img_basket">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <ellipse transform="rotate(-1.057 159.995 423.97) scale(.99997)" cx="160" cy="424" rx="24" ry="24"></ellipse>
                                        <ellipse transform="matrix(.02382 -.9997 .9997 .02382 -48.51 798.282)" cx="384.5" cy="424" rx="24" ry="24"></ellipse>
                                        <path d="M463.8 132.2c-.7-2.4-2.8-4-5.2-4.2L132.9 96.5c-2.8-.3-6.2-2.1-7.5-4.7-3.8-7.1-6.2-11.1-12.2-18.6-7.7-9.4-22.2-9.1-48.8-9.3-9-.1-16.3 5.2-16.3 14.1 0 8.7 6.9 14.1 15.6 14.1s21.3.5 26 1.9c4.7 1.4 8.5 9.1 9.9 15.8 0 .1 0 .2.1.3.2 1.2 2 10.2 2 10.3l40 211.6c2.4 14.5 7.3 26.5 14.5 35.7 8.4 10.8 19.5 16.2 32.9 16.2h236.6c7.6 0 14.1-5.8 14.4-13.4.4-8-6-14.6-14-14.6H188.9c-2 0-4.9 0-8.3-2.8-3.5-3-8.3-9.9-11.5-26l-4.3-23.7c0-.3.1-.5.4-.6l277.7-47c2.6-.4 4.6-2.5 4.9-5.2l16-115.8c.2-.8.2-1.7 0-2.6z"></path>
                                    </svg>
                                </a>
                            </div>';
}

$cart_output = '<div class="basket" id="divShoppingCard">
                       <div id="shopping_cart_box" class="shopping_cart_box">
                         ' . $cart_output . '
                       </div>
                     </div>';

$cart_output_mobile = '<a href="#" class="popup_cart basket_768 hidden">
                              <span class="mobile_cart_count quantity_basket_768">' . $cart_count . '</span>
                           </a>';
