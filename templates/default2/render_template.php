<?php

// $rtplExeptionForJson for json constants, not minify constants
$rtplExeptionForJson = [
    'RTPL_PRODUCTS_IMAGE',
    'RTPL_PRODUCTS_STOCK',
    'RTPL_PRODUCTS_OUTSTOCK',
    'RTPL_CART_BUTTON',
    'RTPL_CART_BUTTON_PRODUCT_PAGE',
    'RTPL_ADD_TO_CART_BUTTON',
    'RTPL_ADD_TO_CART_BUTTON_PRODUCT_PAGE'
];
// define current template constants:
$rtpl = [
    'RTPL_PRODUCTS_IMAGE' => '<img src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/%s/products/%s" alt="%s" title="' . IMAGE_BUTTON_ADDTO_CART . ' %s" %s />',
    'RTPL_NUMBER_OF_ROWS' => '<input type="hidden" name="number_of_rows" value="%s">',
    'RTPL_PAGES_HTML' => '<div class="pagination_list clearfix">%s</div>',
    'RTPL_PRODUCTS_MODEL' => '<span class="label %s">#%s</span>',
    'RTPL_PRODUCTS_STOCK' => '<span class="label %s label-black">' . LIST_TEMP_INSTOCK . '</span>',
    'RTPL_PRODUCTS_OUTSTOCK' => '<span class="label %s label-default">' . LIST_TEMP_OUTSTOCK . '</span>',
    'RTPL_PRODUCTS_SPEC_PRICE' => '<span class="new_price">%s</span><span class="old_price">%s</span>',
    'RTPL_PRODUCTS_PRICE' => '<span class="new_price">%s</span>',
    'RTPL_PRODUCTS_OLD_PRICE' => '<span class="old-price-label">%s</span>',
    'RTPL_CART_BUTTON' => '<a class="btn btn_success popup_cart added2cart" data-id="%s" href="/">' . IMAGE_BUTTON_IN_CART . '</a>',
    'RTPL_CART_BUTTON_PRODUCT_PAGE' => '<a title="' . IMAGE_BUTTON_IN_CART . '" class="btn btn-lg btn-success popup_cart open-modalcart-buttom" href="' . tep_href_link(
        FILENAME_SHOPPING_CART
    ) . '">' . IMAGE_BUTTON_IN_CART . '</a>',
    'RTPL_ADD_TO_CART_BUTTON' => '<button class="btn btn_second add2cart" data-id="%s" data-qty="%s" >' . IMAGE_BUTTON_ADDTO_CART . '</button>',
    'RTPL_ADD_TO_CART_BUTTON_PRODUCT_PAGE' => '<button type="submit" class="btn btn_second buy">' . IMAGE_BUTTON_ADDTO_CART . '</button>',
    'RTPL_ADD_TO_CART_BUTTON_MODAL' => '<button type="submit" class="btn btn-primary buy">' . IMAGE_BUTTON_ADDTO_CART . '</button>',
    'RTPL_PRODUCTS_COMPARE' => '<span data-id="%s" class="compare_button"><input type="checkbox" id="compare_%s" name="compare_%s" %s /><label for="compare_%s">%s</label></span>',
    'RTPL_PRODUCTS_WISHLIST' => '<span data-id="%s" class="wishlisht_button"><input type="checkbox" id="wishlist_%s" name="wishlist_%s" %s /><label for="wishlist_%s">%s</label></span>',
    'RTPL_COMPARE_OUTPUT' => '<div class="%s">%s</div>',
    'RTPL_PRODUCTS_ATTR_LISTING_LIST' => '<li class="li_list">%s: %s</li>',
    'RTPL_PRODUCTS_ATTR_LISTING_DEFAULT_VALUES' => '<input class="default_attribute" type="hidden" name="%s" value="%s">',
    'RTPL_PRODUCTS_ATTR_BODY_LIST' => '<div class="listing_attrs_list"><ul class="ul_list">%s</ul></div>',
    'RTPL_PRODUCTS_ATTR_LISTING_COL' => '<span class="attr_name">%s:</span><span class="attr_val">%s</span>',
    'RTPL_PRODUCTS_ATTR_BODY_COL' => '<div class="listing_attrs">%s</div>',
    'RTPL_LISTING_HEADER' => '<div class="pdf_link"><span class="btn-link" data-href="%s"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zm-22.6 22.7c2.1 2.1 3.5 4.6 4.2 7.4H256V32.5c2.8.7 5.3 2.1 7.4 4.2l83.9 83.9zM336 480H48c-8.8 0-16-7.2-16-16V48c0-8.8 7.2-16 16-16h176v104c0 13.3 10.7 24 24 24h104v304c0 8.8-7.2 16-16 16zm-22-171.2c-13.5-13.3-55-9.2-73.7-6.7-21.2-12.8-35.2-30.4-45.1-56.6 4.3-18 12-47.2 6.4-64.9-4.4-28.1-39.7-24.7-44.6-6.8-5 18.3-.3 44.4 8.4 77.8-11.9 28.4-29.7 66.9-42.1 88.6-20.8 10.7-54.1 29.3-58.8 52.4-3.5 16.8 22.9 39.4 53.1 6.4 9.1-9.9 19.3-24.8 31.3-45.5 26.7-8.8 56.1-19.8 82-24 21.9 12 47.6 19.9 64.6 19.9 27.7.1 28.9-30.2 18.5-40.6zm-229.2 89c5.9-15.9 28.6-34.4 35.5-40.8-22.1 35.3-35.5 41.5-35.5 40.8zM180 175.5c8.7 0 7.8 37.5 2.1 47.6-5.2-16.3-5-47.6-2.1-47.6zm-28.4 159.3c11.3-19.8 21-43.2 28.8-63.7 9.7 17.7 22.1 31.7 35.1 41.5-24.3 4.7-45.4 15.1-63.9 22.2zm153.4-5.9s-5.8 7-43.5-9.1c41-3 47.7 6.4 43.5 9.1z"></path></svg> PDF</span></div>',
    'RTPL_PDF_BLOCK_SELECTOR' => '#pdf_block span.btn-link',
    'RTPL_LISTING_HEADER_SLIDER' => '<div class="row row_catalog_products"><div id="%s" class="%s" >',
    'RTPL_LISTING_HEADER_NORMAL' => '<div class="row row_catalog_products %s" id="%s" >',
    'RTPL_ARROW_LEFT' => '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M231.293 473.899l19.799-19.799c4.686-4.686 4.686-12.284 0-16.971L70.393 256 251.092 74.87c4.686-4.686 4.686-12.284 0-16.971L231.293 38.1c-4.686-4.686-12.284-4.686-16.971 0L4.908 247.515c-4.686 4.686-4.686 12.284 0 16.971L214.322 473.9c4.687 4.686 12.285 4.686 16.971-.001z"></path></svg>',
    'RTPL_ARROW_RIGHT' => '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path d="M24.707 38.101L4.908 57.899c-4.686 4.686-4.686 12.284 0 16.971L185.607 256 4.908 437.13c-4.686 4.686-4.686 12.284 0 16.971L24.707 473.9c4.686 4.686 12.284 4.686 16.971 0l209.414-209.414c4.686-4.686 4.686-12.284 0-16.971L41.678 38.101c-4.687-4.687-12.285-4.687-16.971 0z"></path></svg>',
    //    'RTPL_COLS' => serialize(array('xs'=>'2','sm'=>'2','md'=>'3','lg'=>'4')),
    'RTPL_PDF_ENABLED' => $template->show('LIST_SHOW_PDF_LINK'),
    // RTPL_PDF_ENABLED - from template. PRODUCT_LIST_FILTER - from admin configures.
    'RTPL_LABEL' => '<div class="label%s product_label">%s</div>',
];

if ($template->show("P_SHOW_QUANTITY_INPUT") != 0) :
    $rtpl['RTPL_ADD_TO_CART_BUTTON_PRODUCT_PAGE'] = '<input class="count" name="cart_quantity" type="text" value="1" size="5" min="1" max="100000"/>' . $rtpl['RTPL_ADD_TO_CART_BUTTON_PRODUCT_PAGE'];
endif;

foreach ($rtpl as $def => $val) {
    define($def, $val); // for direct PHP make it as constants
    if (in_array($def, $rtplExeptionForJson)) {
        $assets->constantsJSON[$def] = $val; // constants for JSON
    } else {
        $assets->jsConstants[$def] = addslashes($val); // constants for JS:
    }
}
