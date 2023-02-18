<?php

$cart_count = $cart->count_contents(); // products in cart
$cart_total = $currencies->format($cart->show_total()); // total amount with currency sign

// Show cart
if ($cart_count > 0) {
    $cart_img_class = 'cart_img_full';

    $cart_output = '<a href="#" class="img_basket popup_cart">
                              <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M352 128C352 57.421 294.579 0 224 0 153.42 0 96 57.421 96 128H0v304c0 44.183 35.817 80 80 80h288c44.183 0 80-35.817 80-80V128h-96zM224 32c52.935 0 96 43.065 96 96H128c0-52.935 43.065-96 96-96zm192 400c0 26.467-21.533 48-48 48H80c-26.467 0-48-21.533-48-48V160h64v48c0 8.837 7.164 16 16 16s16-7.163 16-16v-48h192v48c0 8.837 7.163 16 16 16s16-7.163 16-16v-48h64v272z"></path>
                              </svg>
                            </a>
                            <span class="quantity_basket">(+' . $cart_count . ')</span>';
} else {
    $cart_img_class = 'cart_img';

    $cart_output = '<a href="#" class="img_basket popup_cart">
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                  <path d="M352 128C352 57.421 294.579 0 224 0 153.42 0 96 57.421 96 128H0v304c0 44.183 35.817 80 80 80h288c44.183 0 80-35.817 80-80V128h-96zM224 32c52.935 0 96 43.065 96 96H128c0-52.935 43.065-96 96-96zm192 400c0 26.467-21.533 48-48 48H80c-26.467 0-48-21.533-48-48V160h64v48c0 8.837 7.164 16 16 16s16-7.163 16-16v-48h192v48c0 8.837 7.163 16 16 16s16-7.163 16-16v-48h64v272z"></path>
                                </svg>
                            </a>';
}

$cart_output = '<div class="basket" id="divShoppingCard">
                       ' . $cart_output . '
                   </div>';

$cart_output_mobile = '<a href="#" rel="nofollow" class="popup_cart basket_768">
                              <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M352 128C352 57.421 294.579 0 224 0 153.42 0 96 57.421 96 128H0v304c0 44.183 35.817 80 80 80h288c44.183 0 80-35.817 80-80V128h-96zM224 32c52.935 0 96 43.065 96 96H128c0-52.935 43.065-96 96-96zm192 400c0 26.467-21.533 48-48 48H80c-26.467 0-48-21.533-48-48V160h64v48c0 8.837 7.164 16 16 16s16-7.163 16-16v-48h192v48c0 8.837 7.163 16 16 16s16-7.163 16-16v-48h64v272z"></path>
                              </svg>
                           </a>
                           <span class="mobile_cart_count quantity_basket_768">' . ($cart_count != 0 ? '(+' . $cart_count . ')' : '') . '</span>';

$cart_count = $cart_count ? '<span>(+' . $cart_count . ')</span>' : '';
