<?php

$count_addImgs = count($additional_images);
$big_width = 686;
$big_height = 553;
//    $thumb_size_w = 72;
//    $thumb_size_h = 92;
$thumb_size_w = 92;
$thumb_size_h = 92;
?>

<?php if (count($additional_images) > 1 || !empty($products_video)) { ?>
    <div id="sync1_1" class="owl-carousel owl-theme">
        <?php foreach ($additional_images as $image) : ?>
            <div class="item">
                <a href="getimage/products/<?php echo $image ?>" data-lightbox="image-1">
                    <?php if (PRODUCT_LABELS_MODULE_ENABLED == 'true') { ?>
                        <div class="product_labels item-list ">
                            <?php echo $product_info['p_label']; ?>
                        </div>
                    <?php } ?>
                    <img class="lazyload" src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                         data-src="<?php echo 'getimage/' . $big_width . 'x' . $big_height . '/products/' . $image; ?>"
                         alt="<?php echo htmlentities($products_name); ?>"
                         title="<?php echo IMAGE_BUTTON_ADDTO_CART . ' ' . htmlentities($products_name); ?>"
                    />
                </a>
            </div>
        <?php endforeach ?>
        <?php foreach ($products_video as $video) { ?>
            <div class="item">
                <a href="getimage/products/<?php echo $video['video_preview']; ?>" data-lightbox="image-1">
                    <iframe width="560" height="315" src="<?php echo $video['video_url']; ?>" title="<?php echo htmlentities($products_name); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </a>
            </div>
        <?php } ?>
    </div>
    <div class="thumbs_row">
        <div id="sync2" class="owl-carousel owl-theme">
            <?php foreach ($additional_images as $k => $image) : ?>
                <?php if (!isMobile()) { ?>
                    <img class="lazyload"
                         src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                         data-src="<?php echo 'getimage/' . $thumb_size_w . 'x' . $thumb_size_h . '/products/' . $image; ?>&rotate=90"
                         alt="<?php echo htmlentities($products_name); ?>">
                <?php } else { ?>
                    <img class="lazyload"
                         src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                         data-src="<?php echo 'getimage/' . $thumb_size_w . 'x' . $thumb_size_h . '/products/' . $image; ?>"
                         alt="<?php echo htmlentities($products_name); ?>">
                <?php } ?>
            <?php endforeach ?>
            <?php foreach ($products_video as $video) { ?>
                <div class="col-xs-3 play-video">
                    <img height="100" width="100" class="lazyload" src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                         class="product-carousel-video"
                         data-src="<?php echo 'getimage/' . $thumb_size_w . 'x' . $thumb_size_h . '/products/' . $video['video_preview']; ?>"
                         alt="<?php echo htmlentities($products_name) . ' - ' . ($k + 1); ?>">
                </div>
            <?php } ?>
        </div>
    </div>
<?php } else {
    $image = $additional_images[0] ?: 'default.png';
    ?>
    <div class="item single_image">
        <a href="getimage/products/<?php echo $image ?>" data-lightbox="image-1">
            <?php if (PRODUCT_LABELS_MODULE_ENABLED == 'true') { ?>
                <div class="product_labels item-list ">
                    <?php echo $product_info['p_label']; ?>
                </div>
            <?php } ?>
            <img class="lazyload"
                 src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                 data-src="<?php echo 'getimage/' . $big_width . 'x' . $big_height . '/products/' . $image; ?>"
                 alt="<?php echo htmlentities($products_name); ?>"
                 title="<?php echo IMAGE_BUTTON_ADDTO_CART . ' ' . htmlentities($products_name); ?>"/>
        </a>
    </div>
<?php } ?>
