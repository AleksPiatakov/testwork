<?php

// Settings
$cart_count = $cart->count_contents(); // products in cart
$cart_total = $currencies->format($cart->show_total()); // total amount with currency sign

// Show cart
if ($cart_count > 0) {
    $cart_img_class = 'cart_img_full';

    $cart_output = '<a href="#" class="img_basket new_popup_cart dropdown-toggle" role="button" id="basked_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17" height="16" viewBox="0 0 17 16">
                            <defs>
                                <rect id="b" width="259" height="191" rx="3"/>
                                <filter id="a" width="113.5%" height="118.3%" x="-6.8%" y="-6.5%" filterUnits="objectBoundingBox">
                                    <feOffset dy="5" in="SourceAlpha" result="shadowOffsetOuter1"/>
                                    <feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="5"/>
                                    <feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0"/>
                                </filter>
                            </defs>
                            <g fill="none" fill-rule="evenodd">
                                <path fill="#F8F9FA" d="M-858-7771H582V274H-858z"/>
                                <g transform="translate(-151 -50)">
                                    <use fill="#000" filter="url(#a)" xlink:href="#b"/>
                                    <use fill="#FFF" xlink:href="#b"/>
                                </g>
                                <g fill="#555" fill-rule="nonzero">
                                    <ellipse cx="4.577" cy="14.963" rx="1" ry="1" transform="rotate(-1.057 4.577 14.963)"/>
                                    <ellipse cx="13.752" cy="14.964" rx="1" ry="1" transform="rotate(-88.635 13.752 14.964)"/>
                                    <path d="M16.992 2.868a.241.241 0 0 0-.213-.174L3.47 1.39c-.114-.013-.253-.087-.306-.195a4.227 4.227 0 0 0-.499-.771C2.35.033 1.757.046.67.037.302.033.004.253.004.622c0 .36.282.584.638.584.355 0 .87.02 1.062.079.192.058.347.377.405.655 0 .004 0 .008.004.012.008.05.081.423.081.427L3.83 11.15c.098.601.298 1.099.593 1.48.343.448.797.672 1.344.672h9.669c.31 0 .576-.24.588-.556a.574.574 0 0 0-.572-.605H5.758c-.082 0-.2 0-.34-.116-.142-.124-.338-.41-.47-1.078l-.175-.982c0-.013.004-.021.016-.025l11.349-1.948a.24.24 0 0 0 .2-.216l.654-4.8a.24.24 0 0 0 0-.108z"/>
                                </g>
                            </g>
                        </svg>
                        <span class="quantity_basket">' . $cart_count . '</span>
                        ' . DEMO2_SHOPPING_CART . '
                     </a>
                     <div id="new_basked_block" class="basked_block dropdown-menu" aria-labelledby="basked_btn"></div>';
} else {
    $cart_img_class = 'cart_img';

    $cart_output = '<a href="#" class="img_basket new_popup_cart dropdown-toggle" role="button" id="basked_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17" height="16" viewBox="0 0 17 16">
                            <defs>
                                <rect id="b" width="259" height="191" rx="3"/>
                                <filter id="a" width="113.5%" height="118.3%" x="-6.8%" y="-6.5%" filterUnits="objectBoundingBox">
                                    <feOffset dy="5" in="SourceAlpha" result="shadowOffsetOuter1"/>
                                    <feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="5"/>
                                    <feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0"/>
                                </filter>
                            </defs>
                            <g fill="none" fill-rule="evenodd">
                                <path fill="#F8F9FA" d="M-858-7771H582V274H-858z"/>
                                <g transform="translate(-151 -50)">
                                    <use fill="#000" filter="url(#a)" xlink:href="#b"/>
                                    <use fill="#FFF" xlink:href="#b"/>
                                </g>
                                <g fill="#555" fill-rule="nonzero">
                                    <ellipse cx="4.577" cy="14.963" rx="1" ry="1" transform="rotate(-1.057 4.577 14.963)"/>
                                    <ellipse cx="13.752" cy="14.964" rx="1" ry="1" transform="rotate(-88.635 13.752 14.964)"/>
                                    <path d="M16.992 2.868a.241.241 0 0 0-.213-.174L3.47 1.39c-.114-.013-.253-.087-.306-.195a4.227 4.227 0 0 0-.499-.771C2.35.033 1.757.046.67.037.302.033.004.253.004.622c0 .36.282.584.638.584.355 0 .87.02 1.062.079.192.058.347.377.405.655 0 .004 0 .008.004.012.008.05.081.423.081.427L3.83 11.15c.098.601.298 1.099.593 1.48.343.448.797.672 1.344.672h9.669c.31 0 .576-.24.588-.556a.574.574 0 0 0-.572-.605H5.758c-.082 0-.2 0-.34-.116-.142-.124-.338-.41-.47-1.078l-.175-.982c0-.013.004-.021.016-.025l11.349-1.948a.24.24 0 0 0 .2-.216l.654-4.8a.24.24 0 0 0 0-.108z"/>
                                </g>
                            </g>
                        </svg>
                        ' . DEMO2_SHOPPING_CART . '
                      </a>
                      <div id="new_basked_block" class="basked_block dropdown-menu" aria-labelledby="basked_btn"></div>';
}

$cart_output = '<div class="basket" id="divShoppingCard">
                   ' . $cart_output . '
               </div>';

$cart_output_mobile = '<a href="#" rel="nofollow" class="basket_768 new_popup_cart">
                           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17" height="16" viewBox="0 0 17 16">
                                <defs>
                                    <rect id="b" width="259" height="191" rx="3"/>
                                    <filter id="a" width="113.5%" height="118.3%" x="-6.8%" y="-6.5%" filterUnits="objectBoundingBox">
                                        <feOffset dy="5" in="SourceAlpha" result="shadowOffsetOuter1"/>
                                        <feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="5"/>
                                        <feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0"/>
                                    </filter>
                                </defs>
                                <g fill="none" fill-rule="evenodd">
                                    <path fill="#F8F9FA" d="M-858-7771H582V274H-858z"/>
                                    <g transform="translate(-151 -50)">
                                        <use fill="#000" filter="url(#a)" xlink:href="#b"/>
                                        <use fill="#FFF" xlink:href="#b"/>
                                    </g>
                                    <g fill="#555" fill-rule="nonzero">
                                        <ellipse cx="4.577" cy="14.963" rx="1" ry="1" transform="rotate(-1.057 4.577 14.963)"/>
                                        <ellipse cx="13.752" cy="14.964" rx="1" ry="1" transform="rotate(-88.635 13.752 14.964)"/>
                                        <path d="M16.992 2.868a.241.241 0 0 0-.213-.174L3.47 1.39c-.114-.013-.253-.087-.306-.195a4.227 4.227 0 0 0-.499-.771C2.35.033 1.757.046.67.037.302.033.004.253.004.622c0 .36.282.584.638.584.355 0 .87.02 1.062.079.192.058.347.377.405.655 0 .004 0 .008.004.012.008.05.081.423.081.427L3.83 11.15c.098.601.298 1.099.593 1.48.343.448.797.672 1.344.672h9.669c.31 0 .576-.24.588-.556a.574.574 0 0 0-.572-.605H5.758c-.082 0-.2 0-.34-.116-.142-.124-.338-.41-.47-1.078l-.175-.982c0-.013.004-.021.016-.025l11.349-1.948a.24.24 0 0 0 .2-.216l.654-4.8a.24.24 0 0 0 0-.108z"/>
                                    </g>
                                </g>
                            </svg>
                           <span class="mobile_cart_count quantity_basket_768">' . ($cart_count != 0 ? '.$cart_count.' : '') . '</span>
                       </a>';

$cart_count = $cart_count ? '<span>' . $cart_count . '</span>' : '';
