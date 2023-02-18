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
    'RTPL_PRODUCTS_STOCK' => '<span class="label %s label-black"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg>' . LIST_TEMP_INSTOCK . '</span>',
    'RTPL_PRODUCTS_OUTSTOCK' => '<span class="label %s label-default">' . LIST_TEMP_OUTSTOCK . '</span>',
    'RTPL_PRODUCTS_SPEC_PRICE' => '<span class="new_price">%s</span><span class="old_price">%s</span>',
    'RTPL_PRODUCTS_PRICE' => '<span class="new_price">%s</span>',
    'RTPL_PRODUCTS_OLD_PRICE' => '<span class="old-price-label">%s</span>',
    'RTPL_CART_BUTTON' => '<a class="btn btn btn-primary popup_cart" href="/">' . IMAGE_BUTTON_IN_CART . '</a>',
    'RTPL_CART_BUTTON_PRODUCT_PAGE' => '<a title="' . IMAGE_BUTTON_IN_CART . '" class="btn btn-dark popup_cart" href="' . tep_href_link(
        FILENAME_SHOPPING_CART
    ) . '">' . IMAGE_BUTTON_IN_CART . '</a>',
    'RTPL_ADD_TO_CART_BUTTON' => '<button class="btn btn-primary add2cart" data-id="%s" data-qty="%s">' . IMAGE_BUTTON_ADDTO_CART . '</button>',
    'RTPL_ADD_TO_CART_BUTTON_PRODUCT_PAGE' => '<button type="submit" class="btn btn-dark">' . IMAGE_BUTTON_ADDTO_CART_CLO . '</button>',
    'RTPL_ADD_TO_CART_BUTTON_MODAL' => '<button type="submit" class="btn btn-primary buy">' . IMAGE_BUTTON_ADDTO_CART . '</button>',
    'RTPL_PRODUCTS_COMPARE' => '<span data-id="%s" class="compare_button"><input type="checkbox" id="compare_%s" name="compare_%s" %s /><label for="compare_%s">%s</label></span>',
    'RTPL_PRODUCTS_WISHLIST' => '<span data-id="%s" class="wishlisht_button"><input type="checkbox" id="wishlist_%s" name="wishlist_%s" %s /><label for="wishlist_%s">%s</label></span>',
    'RTPL_COMPARE_OUTPUT' => '<div class="%s">%s</div>',
    'RTPL_PRODUCTS_ATTR_LISTING_LIST' => '<li class="li_list">%s: %s</li>',
    'RTPL_PRODUCTS_ATTR_LISTING_DEFAULT_VALUES' => '<input class="default_attribute" type="hidden" name="%s" value="%s">',
    'RTPL_PRODUCTS_ATTR_BODY_LIST' => '<div class="listing_attrs_list"><ul class="ul_list">%s</ul></div>',
    'RTPL_PRODUCTS_ATTR_LISTING_COL' => '<tr><td>%s:</td><td>%s</td></tr>',
    'RTPL_PRODUCTS_ATTR_BODY_COL' => '<table class="listing_attrs">%s</table>',
    'RTPL_LISTING_HEADER' => '<div class="pdf_link"><span class="btn-link" data-href="%s"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zm-22.6 22.7c2.1 2.1 3.5 4.6 4.2 7.4H256V32.5c2.8.7 5.3 2.1 7.4 4.2l83.9 83.9zM336 480H48c-8.8 0-16-7.2-16-16V48c0-8.8 7.2-16 16-16h176v104c0 13.3 10.7 24 24 24h104v304c0 8.8-7.2 16-16 16zm-22-171.2c-13.5-13.3-55-9.2-73.7-6.7-21.2-12.8-35.2-30.4-45.1-56.6 4.3-18 12-47.2 6.4-64.9-4.4-28.1-39.7-24.7-44.6-6.8-5 18.3-.3 44.4 8.4 77.8-11.9 28.4-29.7 66.9-42.1 88.6-20.8 10.7-54.1 29.3-58.8 52.4-3.5 16.8 22.9 39.4 53.1 6.4 9.1-9.9 19.3-24.8 31.3-45.5 26.7-8.8 56.1-19.8 82-24 21.9 12 47.6 19.9 64.6 19.9 27.7.1 28.9-30.2 18.5-40.6zm-229.2 89c5.9-15.9 28.6-34.4 35.5-40.8-22.1 35.3-35.5 41.5-35.5 40.8zM180 175.5c8.7 0 7.8 37.5 2.1 47.6-5.2-16.3-5-47.6-2.1-47.6zm-28.4 159.3c11.3-19.8 21-43.2 28.8-63.7 9.7 17.7 22.1 31.7 35.1 41.5-24.3 4.7-45.4 15.1-63.9 22.2zm153.4-5.9s-5.8 7-43.5-9.1c41-3 47.7 6.4 43.5 9.1z"></path></svg> PDF</span></div>',
    'RTPL_PDF_BLOCK_SELECTOR' => '#pdf_block span.btn-link',
    'RTPL_LISTING_HEADER_SLIDER' => '<div class="row row_catalog_products"><div id="%s" class="%s" >',
    'RTPL_LISTING_HEADER_NORMAL' => '<div class="row row_catalog_products %s" id="%s" >',
    'RTPL_ARROW_LEFT' => '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg>',
    'RTPL_ARROW_RIGHT' => '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>',
    //              'RTPL_COLS' => serialize(array('xs'=>'2','sm'=>'2','md'=>'3','lg'=>'4')),
    'RTPL_PDF_ENABLED' => false,
    'RTPL_LABEL' => '<div class="label%s product_label">%s</div>',
];

foreach ($rtpl as $def => $val) {
    define($def, $val); // for direct PHP make it as constants
    if (in_array($def, $rtplExeptionForJson)) {
        $assets->constantsJSON[$def] = $val; // constants for JSON
    } else {
        $assets->jsConstants[$def] = addslashes($val); // constants for JS:
    }
}
