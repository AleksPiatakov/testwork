<?php

// Settings
$any_out_of_stock = false;
$products = $cart->get_products();
$output = '';
foreach ($products as $product) {
    $products_name = '<a href="' . tep_href_link(
        FILENAME_PRODUCT_INFO,
        'products_id=' . $product['id']
    ) . '">' . $product['name'] . '</a>';
    $products_image = explode(';', $product['image']);
//        debug($products_image);die;
    $products_price = $currencies->display_price($product['final_price'], tep_get_tax_rate($product['tax_class_id']));
    $output .= '<div class="basket_product">
                        <div class="left">
                            ' . $products_name . '
                            <span>' . $product['quantity'] . ' x ' . $products_price . '</span>
                        </div>
                        <div class="right">
                            <a class="prod_img" href="' . tep_href_link(
                                FILENAME_PRODUCT_INFO,
                                'products_id=' . $product['id']
                            ) . '">
                                <img src="getimage/60x60/products/' . $products_image[0] . '" class="img-responsive">
                            </a>
                            <span style="visibility: hidden;">
                                    ' . tep_draw_hidden_field('products_id[]', $product['id']) . tep_draw_hidden_field(
                                    'cart_quantity[]',
                                    $product['quantity']
                                ) . '
                                <input style="display:none;" type="checkbox" name="cart_delete[]" value="' . $product['id'] . '">
                             </span>
                             <button class="delete" value="' . urlencode(
                                    $product['id']
                                ) . '" data-clearpid="' . current(explode('{', $product['id'])) . '" title="' . (defined(
                                    "TABLE_HEADING_REMOVE"
                                ) ? TABLE_HEADING_REMOVE : '') . ' ' . (defined(
                                    "TABLE_HEADING_REMOVE_FROM"
                                ) ? TABLE_HEADING_REMOVE_FROM : '') . '" name="press1" type="button">
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                    <path d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"></path>
                                </svg>
                             </button>
                        </div>     
                    </div>';
}


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
    $cart_output = '<div class="basked_open dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path d="M551.991 64H129.28l-8.329-44.423C118.822 8.226 108.911 0 97.362 0H12C5.373 0 0 5.373 0 12v8c0 6.627 5.373 12 12 12h78.72l69.927 372.946C150.305 416.314 144 431.42 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-17.993-7.435-34.24-19.388-45.868C506.022 391.891 496.76 384 485.328 384H189.28l-12-64h331.381c11.368 0 21.177-7.976 23.496-19.105l43.331-208C578.592 77.991 567.215 64 551.991 64zM240 448c0 17.645-14.355 32-32 32s-32-14.355-32-32 14.355-32 32-32 32 14.355 32 32zm224 32c-17.645 0-32-14.355-32-32s14.355-32 32-32 32 14.355 32 32-14.355 32-32 32zm38.156-192H171.28l-36-192h406.876l-40 192z"></path>
                                </svg>
                                <span class="mobile_cart_count quantity_basket_768">' . $cart_count . '</span>
                                ' . DEMO2_SHOPPING_CART . '
                            </div>';
    $cart_output .= '<div class="basked_dropdown dropdown-menu dropdown-menu-right" aria-labelledby="divShoppingCard">' .
        tep_draw_form('cart_quantity', 'popup_cart.php?action=update_product', 'post', 'id="shopping_cart_form"')
        . $output .
        '<div class="basked_total"><span>' . TOTAL_CART . '</span>' . $currencies->display_price(
            $cart->show_total(),
            0
        ) . '</div>
                                    <div class="basked_action">
                                        <span class="popup_cart">' . MOLLA_BASKED_DETAILS . '</span>
                                        <a href="' . tep_href_link(FILENAME_CHECKOUT, '', 'SSL') . '" id="checkoutButton_small_cart" class="btn">
                                            ' . MOLLA_BASKED_CHECKOUT . '
                                            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path d="M311.03 131.515l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887l-83.928 83.444c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l116.485-116c4.686-4.686 4.686-12.284 0-16.971L328 131.515c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </form>
                            </div>';
} else {
    $cart_output = '<div class="basked_open">
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path d="M551.991 64H129.28l-8.329-44.423C118.822 8.226 108.911 0 97.362 0H12C5.373 0 0 5.373 0 12v8c0 6.627 5.373 12 12 12h78.72l69.927 372.946C150.305 416.314 144 431.42 144 448c0 35.346 28.654 64 64 64s64-28.654 64-64a63.681 63.681 0 0 0-8.583-32h145.167a63.681 63.681 0 0 0-8.583 32c0 35.346 28.654 64 64 64 35.346 0 64-28.654 64-64 0-17.993-7.435-34.24-19.388-45.868C506.022 391.891 496.76 384 485.328 384H189.28l-12-64h331.381c11.368 0 21.177-7.976 23.496-19.105l43.331-208C578.592 77.991 567.215 64 551.991 64zM240 448c0 17.645-14.355 32-32 32s-32-14.355-32-32 14.355-32 32-32 32 14.355 32 32zm224 32c-17.645 0-32-14.355-32-32s14.355-32 32-32 32 14.355 32 32-14.355 32-32 32zm38.156-192H171.28l-36-192h406.876l-40 192z"></path>
                                </svg>
                                ' . DEMO2_SHOPPING_CART . '
                            </div>';
}


$cart_output = '<div class="basked" id="divShoppingCard">
                           ' . $cart_output . '
                    </div>';
