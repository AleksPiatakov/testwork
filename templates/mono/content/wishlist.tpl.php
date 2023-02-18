<h1><?php echo HEADING_TITLE; ?></h1>
<?php
if ($messageStack->size('wishlist') > 0) {
    ?>
    <div><?php echo $messageStack->output('wishlist'); ?></div>

    <?php
}

if (is_array($wishList->wishID) && !empty($wishList->wishID)) {
    reset($wishList->wishID);

    ?>

    <table id="wishlist_table" class="typical_table" width="100%">
        <thead>
        <th align="left"><?php echo BOX_TEXT_IMAGE; ?></th>
        <th align="left"><?php echo BOX_TEXT_PRODUCT; ?></th>
        <th align="center"><?php echo BOX_TEXT_PRICE; ?></th>
        <th></th>
        <th></th>
        </thead>

        <?php
        foreach ($wishList->wishID as $wishlist_id => $val) {
            // while (list($wishlist_id, ) = each($wishList->wishID)) {

            $product_id = tep_get_prid($wishlist_id);
            $products_query = tep_db_query(
                "select pd.products_id, pd.products_name, pd.products_description, p.products_image, p.products_status, CASE WHEN p." . $customer_price . " IS NULL THEN p.products_price ELSE p." . $customer_price . " END as products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = '" . $product_id . "' and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' order by products_name"
            );
            $products = tep_db_fetch_array($products_query);
            ?>
            <tr>
                <td valign="top" class="productListing-data" align="left">
                    <a
                            href="<?php echo tep_href_link(
                                FILENAME_PRODUCT_INFO,
                                'products_id=' . $wishlist_id,
                                'NONSSL'
                                  ); ?>">
                        <?php $wishlist_prod_image = explode(';', $products['products_image']); ?>
                        <img class="lazyload" src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                             data-src="getimage/100x100/products/<?php echo $wishlist_prod_image[0]; ?>"/>
                </td>
                <td valign="top" class="productListing-data" align="left" class="main">
                    <b>
                        <a href="<?php echo tep_href_link(
                            FILENAME_PRODUCT_INFO,
                            'products_id=' . $wishlist_id,
                            'NONSSL'
                                 ); ?>"><?php echo $products['products_name']; ?></a>
                    </b>
                    <?php

                    //TotalB2B start
                    //$products['products_price'] = tep_xppp_getproductprice($product_id);
                    //TotalB2B end

                    if ($new_price = tep_get_products_special_price($product_id)) {
                        $query_special_prices_hide_result = defined(
                            'SPECIAL_PRICES_HIDE'
                        ) ? SPECIAL_PRICES_HIDE : 'false';
                        if ($query_special_prices_hide_result == 'true') {
                            $products_price = '<span class="productSpecialPrice">' . $currencies->display_price(
                                $new_price + $attributes_addon_price,
                                tep_get_tax_rate($products['products_tax_class_id'])
                            ) . '</span>';
                        } else {
                            $products_price = '<s>' . $currencies->display_price(
                                $products['products_price'] + $attributes_addon_price,
                                tep_get_tax_rate($products['products_tax_class_id'])
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

                    if ($cart->in_cart($wishlist_id)) {
                        echo '<br /><span><b>' . TEXT_ITEM_IN_CART . '</b></span>';
                    }

                    if ($products['products_status'] == 0) {
                        echo '<br /><span><b>' . TEXT_ITEM_NOT_AVAILABLE . '</b></span>';
                    }

                    ?>
                </td>
                <td valign="top" class="productListing-data"><?php echo $products_price; ?></td>
                <td valign="top" class="productListing-data">
                    <?php echo '<a class="btn btn-default gradient" href="' . tep_href_link(
                        'wishlist.php',
                        'delete_prod=' . $wishlist_id
                    ) . '">' . IMAGE_BUTTON_DELETE . '</a>'; ?>
                </td>
                <td valign="top" class="productListing-data" align="center">
                    <?php

                    if ($cart->in_cart($wishlist_id)) {
                        $cart_button = '<a class="btn btn btn-primary popup_cart added2cart" data-id="' . $wishlist_id . '" href="' . tep_href_link(
                            FILENAME_SHOPPING_CART
                        ) . '">' . IMAGE_BUTTON_IN_CART . '</a>';
                    } else {
                        $cart_button = tep_draw_hidden_field('cart_quantity', 1) .
                            tep_draw_hidden_field('products_id', $wishlist_id) .
                            '<button class="btn btn-primary add2cart" data-id="' . $wishlist_id . '" type="submit">' . IMAGE_BUTTON_ADDTO_CART . '</button>';
                    }

                    echo tep_draw_form(
                        'cart_quantity',
                        tep_href_link(
                            basename($PHP_SELF),
                            tep_get_all_get_params(
                                array('action', 'language', 'ajaxloading')
                            ) . 'action=add_product',
                            'NONSSL'
                        )
                    ) . '
                    ' . $cart_button . '
                 </form>';

                    ?>
                </td>
            </tr>

            <?php
        }
        ?>
    </table>

    <?php
} else { // Nothing in the customers wishlist
    ?>

    <div><?php echo BOX_TEXT_NO_ITEMS; ?></div>


    <?php
}
?>
