<?php

if (is_array($wishList->wishID) && !empty($wishList->wishID)) {
    $wishlist_show = 'd-iblock';
}

echo '<div id="wishlist_box2" class="' . $wishlist_show . '">';
?>

<div class="dropdown">
    <div class="wishlist-icon dropdown-toggle" data-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M256 448l-30.164-27.211C118.718 322.442 48 258.61 48 179.095 48 114.221 97.918 64 162.4 64c36.399 0 70.717 16.742 93.6 43.947C278.882 80.742 313.199 64 349.6 64 414.082 64 464 114.221 464 179.095c0 79.516-70.719 143.348-177.836 241.694L256 448z"></path>
        </svg>
        <div class="counter"><span><?= is_array($wishList->wishID) ? count($wishList->wishID) : 0; ?></span></div>
    </div>
    <div class="dropdown-menu stop_propagation">
        <div class="content">
            <div class="clearfix block-header">
                <p><?php echo BOX_HEADING_WISHLIST; ?></p>
            </div>

            <div class="body">
                <?php

                $wishIDt_arr = $wishList->wishID;

                $i = 0;
                if ($wishIDt_arr) {
                    foreach ($wishIDt_arr as $key => $val) {
                        $i++;
                        if ($i <= 3) {
                            $wishlist_query = tep_db_query(
                                "SELECT `p`.`products_id`, `pd`.`products_name`, `pd`.`products_description`, `p`.`products_model`, `p`.`products_image`, `pd`.`products_url`, `p`.`products_price`, `p`.`products_tax_class_id`, `p`.`manufacturers_id` FROM " . TABLE_PRODUCTS . " `p`, " . TABLE_PRODUCTS_DESCRIPTION . " `pd` WHERE `p`.`products_status` = '1' AND `p`.`products_id` = '" . $key . "' AND `pd`.`products_id` = `p`.`products_id` AND `pd`.`language_id` = '" . (int)$languages_id . "'"
                            );
                            $wishlist_item = tep_db_fetch_array($wishlist_query);


                            if ($_GET['compare_id'] == $wishlist_item['products_id']) {
                                $opacity = 0;
                            } else {
                                $opacity = 1;
                            }

                            $compare_prod_img = explode(';', $wishlist_item['products_image']);
                            $compare_prod_price = $wishlist_item['products_price'];
                            // debug($compare_prod_img);
                            $compare_html = '<div id="compare_block' . $wishlist_item['products_id'] . '" class="compare_item clearfix">';
                            $compare_html .= '<div class="inner clearfix">';
                            // Image
                            $compare_html .= '<div class="compare_block__prod_img left">
                                  <a href="' . tep_href_link(
                                FILENAME_PRODUCT_INFO,
                                'products_id=' . $wishlist_item['products_id']
                            ) . '">
                                      <img src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/80x80/products/' . $compare_prod_img[0] . '" class="lazyload" alt="">
                                  </a>
                                  <span class="image-previewer">
                                    <img src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/260x260/products/' . $compare_prod_img[0] . '" alt="" class="lazyload"></span>
                                </div>';
                            //Name
                            $compare_html .= '<div class="compare_block__prod_name left">
                                  <a href="' . tep_href_link(
                                FILENAME_PRODUCT_INFO,
                                'products_id=' . $wishlist_item['products_id']
                            ) . '">' . $wishlist_item['products_name'] . '</a>
                                  <p class="price"><span class="new_price">' . $wishlist_item['products_price'] . '</span></p>
                                </div>';
                            // Delete btn
                            $compare_html .= '<a class="compare_block__delete" onclick="go_compare(' . $wishlist_item['products_id'] . ',' . $current_category_id . ',\'delete\')" href="' . tep_href_link(
                                'wishlist.php',
                                'delete_prod=' . $wishlist_item['products_id']
                            ) . '"><span class="icon-remove-compare">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                            <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                                                        </svg>
                                                    </a>';
                            $compare_html .= '</div>';
                            $compare_html .= '</div>';

                            echo $compare_html;
                        }
                    }
                }
                ?>
            </div>

            <div class="block-view-all">
                <a class="gocomparelink"
                   href="<?php echo tep_href_link('wishlist.php'); ?>"><?php echo BOX_HEADING_WISHLIST; ?>
                    (<?= count($wishList->wishID ?: []); ?>)
                </a>
            </div>
        </div>
    </div>
</div>

<?php
//    include('ext/compare/r_wishlist_box2.php');
echo '</div>';


?>
