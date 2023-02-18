<?php


if ($messageStack->size('wishlist') > 0) {
    ?>
    <div><?php echo $messageStack->output('wishlist'); ?></div>

    <?php
}

if (is_array($wishList->wishID) && !empty($wishList->wishID)) {
    reset($wishList->wishID);

    ?>

    <div class="wishlist_block_wrapper container">
        <div class="like_h2">
            <?= HOME_BOX_HEADING_WISHLIST; ?>
        </div>
        <div class="wishlist_block row">
            <?php
            foreach ($wishList->wishID as $wishlist_id => $val) {
                // while (list($wishlist_id, ) = each($wishList->wishID)) {

                $product_id = tep_get_prid($wishlist_id);
                $products_query = tep_db_query(
                    "select pd.products_id, pd.products_name, pd.products_description, p.products_image, p.products_model, p.products_status, CASE WHEN p." . $customer_price . " IS NULL THEN p.products_price ELSE p." . $customer_price . " END as products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = '" . $product_id . "' and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' order by products_name"
                );
                $products = tep_db_fetch_array($products_query);
                ?>
                <div class="wish_item col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                    <div class="row">
                        <div class="wish_item-img col-xs-5">
                            <a href="<?php echo tep_href_link(
                                FILENAME_PRODUCT_INFO,
                                'products_id=' . $wishlist_id,
                                'NONSSL'
                                     ); ?>">
                                <?php $wishlist_prod_image = explode(';', $products['products_image']); ?>
                                <img src="getimage/265x310/products/<?php echo $wishlist_prod_image[0]; ?>"/>
                            </a>
                        </div>
                        <div class="wish_item-details col-xs-7">
                            <a class="wish_item-details_title" href="<?php echo tep_href_link(
                                FILENAME_PRODUCT_INFO,
                                'products_id=' . $wishlist_id,
                                'NONSSL'
                                                                     ); ?>"><?php echo $products['products_name']; ?></a>
                            <div class="wish_item-price_block">
                                <?php

                                //TotalB2B start
                                //$products['products_price'] = tep_xppp_getproductprice($product_id);
                                //TotalB2B end

                                if ($new_price = tep_get_products_special_price($product_id)) {
                                    $query_special_prices_hide_result = getConstantValue(
                                        'SPECIAL_PRICES_HIDE',
                                        'false'
                                    );
                                    if ($query_special_prices_hide_result == 'true') {
                                        $products_price = '<span class="productSpecialPrice">' . $currencies->display_price(
                                            $new_price + $attributes_addon_price,
                                            tep_get_tax_rate($products['products_tax_class_id'])
                                        ) . '</span>';
                                    } else {
                                        $products_price = '<s>' . $currencies->display_price(
                                            $products['products_price'] + $attributes_addon_price,
                                            tep_get_tax_rate(
                                                $products['products_tax_class_id']
                                            )
                                        ) . '</s> <span class="productSpecialPrice">' . $currencies->display_price(
                                            $new_price + $attributes_addon_price,
                                            tep_get_tax_rate($products['products_tax_class_id'])
                                        ) . '</span>';
                                    }
                                } else {
                                    $products_price = $currencies->display_price(
                                        $products['products_price'] + $attributes_addon_price,
                                        tep_get_tax_rate($products['products_tax_class_id'])
                                    );
                                }
                                ?>

                                <span class="wish_item-price"><?php echo $products_price; ?></span>
                            </div>

                            <?php echo '<a class="wish_item-delete_btn" href="' . tep_href_link(
                                'wishlist.php',
                                'delete_prod=' . $wishlist_id
                            ) . '" title="' . IMAGE_BUTTON_DELETE . '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path></svg></a>'; ?>

                            <?php if ($product_info['products_model'] > 0) { ?>
                                <span class="art_card_product">
                                <?= HOME_PROD_VENDOR_CODE . $product_info['products_model']; ?>
                            </span>
                            <?php } ?>
                            <div class="count_buy">
                                <div class="input-group">
                                    <span class="minus">-</span>
                                    <input class="count" name="cart_quantity" type="text" value="1" size="5" min="1"
                                           max="100000"/>
                                    <span class="plus">+</span>
                                </div>
                                <?php
                                if ($cart->in_cart($wishlist_id)) {
                                    $cart_button = '<a class="btn btn btn-primary popup_cart"  href="' . tep_href_link(
                                        FILENAME_SHOPPING_CART
                                    ) . '"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                  <path d="M352 128C352 57.421 294.579 0 224 0 153.42 0 96 57.421 96 128H0v304c0 44.183 35.817 80 80 80h288c44.183 0 80-35.817 80-80V128h-96zM224 32c52.935 0 96 43.065 96 96H128c0-52.935 43.065-96 96-96zm192 400c0 26.467-21.533 48-48 48H80c-26.467 0-48-21.533-48-48V160h64v48c0 8.837 7.164 16 16 16s16-7.163 16-16v-48h192v48c0 8.837 7.163 16 16 16s16-7.163 16-16v-48h64v272z"></path>
                                                </svg>' . HOME_IMAGE_BUTTON_IN_CART . '</a>';
                                } else {
                                    $cart_button = '<button class="btn btn-primary add2cart" data-id="' . $wishlist_id . '" data-qty="1" type="submit"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                  <path d="M352 128C352 57.421 294.579 0 224 0 153.42 0 96 57.421 96 128H0v304c0 44.183 35.817 80 80 80h288c44.183 0 80-35.817 80-80V128h-96zM224 32c52.935 0 96 43.065 96 96H128c0-52.935 43.065-96 96-96zm192 400c0 26.467-21.533 48-48 48H80c-26.467 0-48-21.533-48-48V160h64v48c0 8.837 7.164 16 16 16s16-7.163 16-16v-48h192v48c0 8.837 7.163 16 16 16s16-7.163 16-16v-48h64v272z"></path>
                                                </svg>' . HOME_IMAGE_BUTTON_ADDTO_CART . '</button>';
                                }

                                echo '<div class="r_buy' . $wishlist_id . '">' . $cart_button . '</div>';

                                ?>
                            </div>
                        </div>

                    </div>
                </div>
                <?php
            }
            ?>
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-xs-12">
                <div class="subscribe_news">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <p><?php echo HOME_MAIN_NEWS_SUBSCRIBE; ?></p>
                        </div>
                        <div class="col-sm-8 col-xs-12">
                            <form class="form_subscribe_news" action="subscripbe.php" method="POST">
                                <?= csrf() ?>
                                <input type="hidden" name="podpiska" value="yes">
                                <input type="email" class="form-control form_subscribe_input" required
                                       autocomplete="off"
                                       placeholder="<?php echo HOME_MAIN_NEWS_EMAIL; ?>" name="email_address">
                                <button type="submit"
                                        class="btn btn-default"><?php echo MAIN_NEWS_SUBSCRIBE_BUT; ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <?php
} else { // Nothing in the customers wishlist
    ?>

    <div><?php echo BOX_TEXT_NO_ITEMS; ?></div>

    <?php
}
?>
