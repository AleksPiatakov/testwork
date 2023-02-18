<?php

$count_addImgs = count($additional_images);
$big_width = 430;
$big_height = 430;
$thumb_size_w = 75;
$thumb_size_h = 98;
?>
<?php if (count($additional_images) > 1) { ?>
    <?php if (PRODUCT_LABELS_MODULE_ENABLED == 'true') { ?>
        <div class="product_labels">
            <?php echo $product_info['p_label']; ?>
        </div>
    <?php } ?>
    <div id="product_big_slider" class="owl-carousel">
        <?php foreach ($additional_images as $image) : ?>
            <!--      <div class="item" style="height: --><?php //echo $big_height;?><!-- px;">-->
            <div class="item">
                <a href="getimage/products/<?php echo $image ?>" data-lightbox="image-1">
                    <img class="lazyload" src="<?php echo DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                         data-src="<?php echo 'getimage/' . $big_width . 'x' . $big_height . '/products/' . $image; ?>"
                         alt="<?php echo htmlentities($products_name); ?>"
                         title="<?php echo IMAGE_BUTTON_ADDTO_CART . ' ' . htmlentities($products_name); ?>"/>
                </a>
            </div>
        <?php endforeach ?>
    </div>
    <div class="thumbs_row">
        <div id="product_small_slider" class="owl-carousel owl-theme">
            <?php foreach ($additional_images as $k => $image) : ?>
                <!--        <div class="item" style="height: --><?php //echo $thumb_size_h;?><!-- px;">-->
                <!--        <div class="item">-->
                <img class="lazyload" src="<?php echo DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                     data-src="<?php echo 'getimage/' . $thumb_size_w . 'x' . $thumb_size_h . '/products/' . $image; ?>"
                     alt="<?php echo htmlentities($products_name) . ' - ' . ($k + 1); ?>">
                <!--        </div>-->
            <?php endforeach ?>
        </div>
    </div>
<?php } else {
    $image = $additional_images[0] ?: 'default.png';
    ?>
    <div class="item single_image">
        <?php if (PRODUCT_LABELS_MODULE_ENABLED == 'true') { ?>
            <div class="product_labels">
                <?php echo $product_info['p_label']; ?>
            </div>
        <?php } ?>
        <a href="getimage/products/<?php echo $image ?>" data-lightbox="image-1">
            <img class="lazyload" src="<?php echo DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                 data-src="<?php echo 'getimage/' . $big_width . 'x' . $big_height . '/products/' . $image; ?>"
                 alt="<?php echo htmlentities($products_name); ?>"
                 title="<?php echo IMAGE_BUTTON_ADDTO_CART . ' ' . htmlentities($products_name); ?>"/>
        </a>
    </div>
<?php } ?>
