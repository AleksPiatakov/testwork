<?php

if ($rootPath == '') {
    chdir('../../../');
    $rootPath = dirname(dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME']))));
}
require($rootPath . '/includes/application_top.php');
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_INFO);


$product_info_query = tep_db_query(
    "select p.lable_3, p.lable_2, p.lable_1, p.products_id, pd.products_name, pd.products_viewed, pd.products_description, p.products_model, p.products_quantity, pd.products_info, p.products_image, pd.products_url, CASE WHEN p." . $customer_price . " IS NULL THEN p.products_price ELSE p." . $customer_price . " END as products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'"
);
if (tep_db_num_rows($product_info_query)) {
    $product_info = tep_db_fetch_array($product_info_query);
//        debug($product_info);
}

$images_array = explode(';', $product_info['products_image']);

//$product_info['products_price'] = tep_xppp_getproductprice($product_info['products_id']);

if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
    $query_special_prices_hide_result = SPECIAL_PRICES_HIDE;
    // Disable specials price if module SALES is disabled
    if ($query_special_prices_hide_result == 'true') {
        $products_price = '<div class="productSpecialPrice">' . $currencies->display_price(
            $new_price,
            tep_get_tax_rate($product_info['products_tax_class_id'])
        ) . '</div>';
    } else {
        $spec_price = $new_price;
        $products_price = '<span class="new_price_card_product">' . $currencies->display_price(
            $new_price,
            tep_get_tax_rate($product_info['products_tax_class_id'])
        ) . '</span><br>
                               <span class="old_price_card_product">' . $currencies->display_price(
            $product_info['products_price'],
            tep_get_tax_rate($product_info['products_tax_class_id'])
        ) . '</span>';
    }
} else {
    $products_price = '<span class="new_price_card_product">' . $currencies->display_price(
        $product_info['products_price'],
        tep_get_tax_rate($product_info['products_tax_class_id'])
    ) . '</span>';
}

if (!empty($product_info['products_url'])) {
    $product_href = tep_href_link($product_info['products_url']);
} // if "products_url" is set, show link without DB query to get names
else {
    $product_href = tep_href_link($seo_urls->strip($product_info['products_name']));
} // if "products_url" empty, then get name from DB
$product_href .= '/p-' . $product_info['products_id'] . '.html';
?>

<aside class="product-aside">
    <div class="products-list">
        <div class="item">
            <div class="close-popup">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                </svg>
            </div>
            <div class="image-slider">
                <div class="preview-icon main-icon">
                    <img src="getimage/300x300/products/<?php echo $images_array['0']; ?>">
                </div>

                <?php foreach ($images_array as $imgs => $img) {
                    echo '
                       <a class="image-previewer" href="' . $product_href . '">
                            <div class="preview-icon"><img src="getimage/250x250/products/' . $img . '"></div>
                            <span><img src="getimage/250x250/products/' . $img . '" ></span>
                        </a>';
                } ?>
            </div>

            <div class="name"><?php echo $product_info['products_name']; ?></div>

            <div class="item-price"><?php echo $products_price; ?></div>
            <form name="cart_quantity" action="?action=add_product" method="post">
                <?= csrf() ?>
                <input type="hidden" name="cart_quantity" value="1">
                <input type="hidden" name="products_id" value="<?php echo $product_info['products_id']; ?>">
                <button type="submit" class="btn-primary buy buy-button" id="buy-button-render"><span>Add to Cart</span>
                </button>
            </form>

            <!--            <div>--><?php //echo $product_info['products_description']; ?><!--</div>-->

            <div class="item-description">
                <div class="item-tabs">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#panel1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M80 280h256v48H80zM80 184h320v48H80zM80 88h352v48H80z"></path>
                                    <g>
                                        <path d="M80 376h288v48H80z"></path>
                                    </g>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#panel2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle cx="92" cy="256" r="28"></circle>
                                    <circle cx="92" cy="132" r="28"></circle>
                                    <circle cx="92" cy="380" r="28"></circle>
                                    <path d="M432 240H191.5c-8.8 0-16 7.2-16 16s7.2 16 16 16H432c8.8 0 16-7.2 16-16s-7.2-16-16-16zM432 364H191.5c-8.8 0-16 7.2-16 16s7.2 16 16 16H432c8.8 0 16-7.2 16-16s-7.2-16-16-16zM191.5 148H432c8.8 0 16-7.2 16-16s-7.2-16-16-16H191.5c-8.8 0-16 7.2-16 16s7.2 16 16 16z"></path>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#panel3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M425.9 170.4H204.3c-21 0-38.1 17.1-38.1 38.1v154.3c0 21 17.1 38 38.1 38h126.8c2.8 0 5.6 1.2 7.6 3.2l63 58.1c3.5 3.4 9.3 2 9.3-2.9v-50.6c0-6 3.8-7.9 9.8-7.9h1c21 0 42.1-16.9 42.1-38V208.5c.1-21.1-17-38.1-38-38.1z"></path>
                                    <path d="M174.4 145.9h177.4V80.6c0-18-14.6-32.6-32.6-32.6H80.6C62.6 48 48 62.6 48 80.6v165.2c0 18 14.6 32.6 32.6 32.6h61.1v-99.9c.1-18 14.7-32.6 32.7-32.6z"></path>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#panel4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 32c-88.004 0-160 70.557-160 156.801C96 306.4 256 480 256 480s160-173.6 160-291.199C416 102.557 344.004 32 256 32zm0 212.801c-31.996 0-57.144-24.645-57.144-56 0-31.357 25.147-56 57.144-56s57.144 24.643 57.144 56c0 31.355-25.148 56-57.144 56z"></path>
                                </svg>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="panel1" class="tab-pane fade in active">
                            <div class="content">
                                <h3>Описание</h3>
                                <?php echo $product_info['products_description']; ?>
                            </div>
                        </div>
                        <div id="panel2" class="tab-pane fade">
                            <div class="content">
                                <h3>Характеристики</h3>
                                <?php include(DIR_WS_MODULES . 'product_characteristics.php'); ?>
                            </div>
                        </div>
                        <div id="panel3" class="tab-pane fade">
                            <div class="content">
                                <h3>Комментарии</h3>
                                <?php require_once('ext/reviews/commentit/comment.php'); ?>
                            </div>
                        </div>
                        <div id="panel4" class="tab-pane fade">
                            <div class="content">
                                <h3>Доставка и Оплата</h3>
                                <?php echo renderArticle('shipping_product_info_right'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</aside>
