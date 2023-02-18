<?php

if ($messageStack->size('wishlist') > 0) {
    ?>
    <div><?php echo $messageStack->output('wishlist'); ?></div>

    <?php
}

if (is_array($wishList->wishID) && !empty($wishList->wishID)) {
    reset($wishList->wishID);

    ?>

    <div class="wishlist-table white-rounded-box">
        <div class="like_h2">
            <?= HEADING_TITLE; ?>
            <a class="remove-all-btn" href="<?php echo tep_href_link('wishlist.php', 'delete=all'); ?>">
                <span><?= COMP_PROD_CLEAR; ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                </svg>
            </a>
            <a class="btn-link go-back-btn" href="javascript:history.back()"><?php echo COMP_PROD_BACK; ?></a>
        </div>

        <table id="wishlist_table" class="typical_table" width="100%">

            <?php
            foreach ($wishList->wishID as $wishlist_id) {
//            while (list($wishlist_id, ) = each($wishList->wishID)) {

                $product_id = tep_get_prid($wishlist_id);
                $products_query = tep_db_query(
                    "select pd.products_id, pd.products_name, pd.products_description, p.products_image, p.products_status, CASE WHEN p." . $customer_price . " IS NULL THEN p.products_price ELSE p." . $customer_price . " END as products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = '" . $product_id . "' and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' order by products_name"
                );
                $products = tep_db_fetch_array($products_query);
                ?>
                <tr class="item">
                    <td valign="top" class="item-image productListing-data" align="left">
                        <a href="<?php echo tep_href_link(
                            FILENAME_PRODUCT_INFO,
                            'products_id=' . $wishlist_id,
                            'NONSSL'
                                 ); ?>">
                            <?php $wishlist_prod_image = explode(';', $products['products_image']); ?>
                            <img src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                                 data-src="getimage/160x160/products/<?php echo $wishlist_prod_image[0]; ?>"
                                 class="lazyload"/>
                    </td>
                    <td valign="top" class="item-name productListing-data" align="left" class="main">
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
                            $query_special_prices_hide_result = getConstantValue('SPECIAL_PRICES_HIDE', 'false');
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
                        if ($cart->in_cart(reset($wishlist_id))) {
                            echo '<br /><span><b>' . TEXT_ITEM_IN_CART . '</b></span>';
                        }
                        if ($products['products_status'] == 0) {
                            echo '<br /><span><b>' . TEXT_ITEM_NOT_AVAILABLE . '</b></span>';
                        }

                        ?>
                    </td>
                    <td valign="top" class="item-price productListing-data"><?php echo $products_price; ?></td>
                    <td valign="top" class="productListing-data wishlist-actions_btn" align="center">
                        <?php echo '<a class="btn btn-default gradient" href="' . tep_href_link(
                            'wishlist.php',
                            'delete_prod=' . reset($wishlist_id)
                        ) . '">' . IMAGE_BUTTON_DELETE . '</a>'; ?>
                        <?php

                        if ($cart->in_cart($wishlist_id)) {
                            $cart_button = '<a class="btn btn btn-primary popup_cart" href="' . tep_href_link(
                                FILENAME_SHOPPING_CART
                            ) . '">' . IMAGE_BUTTON_IN_CART . '</a>';
                        } else {
                            $cart_button = tep_draw_hidden_field('cart_quantity', 1) .
                                tep_draw_hidden_field('products_id', $wishlist_id) .
                                '<button class="btn btn-primary" type="submit">' . IMAGE_BUTTON_ADDTO_CART . '</button>';
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
                        <div class="r_buy' . $wishlist_id . '">' . $cart_button . '</div>
                     </form>';

                        ?>
                    </td>
                </tr>

                <?php
            }
            ?>
        </table>
    </div>

    <?php
} else { // Nothing in the customers wishlist
    ?>

    <div><?php echo BOX_TEXT_NO_ITEMS; ?></div>

    <?php
}
?>