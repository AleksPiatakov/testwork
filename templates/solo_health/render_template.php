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
    'RTPL_PRODUCTS_MODEL' => '<span class="label %s">#<span>%s</span></span>',
    'RTPL_PRODUCTS_STOCK' => '<div class="label-class-success"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M362.6 192.9L345 174.8c-.7-.8-1.8-1.2-2.8-1.2-1.1 0-2.1.4-2.8 1.2l-122 122.9-44.4-44.4c-.8-.8-1.8-1.2-2.8-1.2-1 0-2 .4-2.8 1.2l-17.8 17.8c-1.6 1.6-1.6 4.1 0 5.7l56 56c3.6 3.6 8 5.7 11.7 5.7 5.3 0 9.9-3.9 11.6-5.5h.1l133.7-134.4c1.4-1.7 1.4-4.2-.1-5.7z"></path><path d="M256 76c48.1 0 93.3 18.7 127.3 52.7S436 207.9 436 256s-18.7 93.3-52.7 127.3S304.1 436 256 436c-48.1 0-93.3-18.7-127.3-52.7S76 304.1 76 256s18.7-93.3 52.7-127.3S207.9 76 256 76m0-28C141.1 48 48 141.1 48 256s93.1 208 208 208 208-93.1 208-208S370.9 48 256 48z"></path></svg><span>' . LIST_TEMP_INSTOCK . '</span></div>',
    'RTPL_PRODUCTS_OUTSTOCK' => '<div class="label-class-danger"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M331.3 308.7L278.6 256l52.7-52.7c6.2-6.2 6.2-16.4 0-22.6-6.2-6.2-16.4-6.2-22.6 0L256 233.4l-52.7-52.7c-6.2-6.2-15.6-7.1-22.6 0-7.1 7.1-6 16.6 0 22.6l52.7 52.7-52.7 52.7c-6.7 6.7-6.4 16.3 0 22.6 6.4 6.4 16.4 6.2 22.6 0l52.7-52.7 52.7 52.7c6.2 6.2 16.4 6.2 22.6 0 6.3-6.2 6.3-16.4 0-22.6z"></path><path d="M256 76c48.1 0 93.3 18.7 127.3 52.7S436 207.9 436 256s-18.7 93.3-52.7 127.3S304.1 436 256 436c-48.1 0-93.3-18.7-127.3-52.7S76 304.1 76 256s18.7-93.3 52.7-127.3S207.9 76 256 76m0-28C141.1 48 48 141.1 48 256s93.1 208 208 208 208-93.1 208-208S370.9 48 256 48z"></path></svg><span>' . LIST_TEMP_OUTSTOCK . '</span></div>',
    'RTPL_PRODUCTS_SPEC_PRICE' => '<span class="new_price">%s</span><span class="old_price">%s</span>',
    'RTPL_PRODUCTS_PRICE' => '<span class="new_price">%s</span>',
    'RTPL_PRODUCTS_OLD_PRICE' => '<span class="old-price-label">%s</span>',
    'RTPL_CART_BUTTON' => '<a class="btn btn-primary popup_cart list-in-cart-button added2cart" data-id="%s" href="/">' . IMAGE_BUTTON_IN_CART . '</a>',
    'RTPL_CART_BUTTON_PRODUCT_PAGE' => '<a class="btn-success popup_cart open-modalcart-buttom" href="' . tep_href_link(
        FILENAME_SHOPPING_CART
    ) . '" data-toggle="tooltip" data-placement="auto top" title="' . BUTTON_SHOPPING_CART_OPEN . '">' . IMAGE_BUTTON_IN_CART . '</a>',
    'RTPL_ADD_TO_CART_BUTTON' => '<button class="btn btn-primary preview-buy-button add2cart" data-id="%s" data-qty="%s">' . IMAGE_BUTTON_ADDTO_CART_2 . '</button>',
    'RTPL_ADD_TO_CART_BUTTON_PRODUCT_PAGE' => '<button type="submit" class="btn-primary buy buy-button" id="buy-button-render"><span>' . IMAGE_BUTTON_ADDTO_CART_2 . '</span></button>',
    'RTPL_ADD_TO_CART_BUTTON_MODAL' => '<button type="submit" class="btn btn-primary buy">' . IMAGE_BUTTON_ADDTO_CART . '</button>',
    'RTPL_PRODUCTS_COMPARE' => '<a data-id="%s" class="compare_button" href="#"><input type="checkbox" id="compare_%s" name="compare_%s" %s /><label for="compare_%s"  data-toggle="tooltip" data-placement="auto top" title="' . COMPARE . '">%s</label></a>',
    'RTPL_PRODUCTS_WISHLIST' => '<a data-id="%s" class="wishlisht_button" href="#"><input type="checkbox" id="wishlist_%s" name="wishlist_%s" %s /><label for="wishlist_%s" data-toggle="tooltip" data-placement="auto top" title="' . WHISH . '">%s</label></a>',
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
    'RTPL_ARROW_LEFT' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M217.9 256L345 129c9.4-9.4 9.4-24.6 0-33.9-9.4-9.4-24.6-9.3-34 0L167 239c-9.1 9.1-9.3 23.7-.7 33.1L310.9 417c4.7 4.7 10.9 7 17 7s12.3-2.3 17-7c9.4-9.4 9.4-24.6 0-33.9L217.9 256z"></path></svg>',
    'RTPL_ARROW_RIGHT' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M294.1 256L167 129c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.3 34 0L345 239c9.1 9.1 9.3 23.7.7 33.1L201.1 417c-4.7 4.7-10.9 7-17 7s-12.3-2.3-17-7c-9.4-9.4-9.4-24.6 0-33.9l127-127.1z"></path></svg>',
    //              'RTPL_COLS' => serialize(array('xs'=>'1','sm'=>'2','md'=>'3','lg'=>'3')),
    'RTPL_PDF_ENABLED' => $template->show('LIST_SHOW_PDF_LINK'),
    // RTPL_PDF_ENABLED - from template. PRODUCT_LIST_FILTER - from admin configures.
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
