<?php
/**
 * @var array $additional_images
 */

define('THUMBNAILS_PER_ROW', 4);

$thumbnails_qty = count($additional_images);

if ($thumbnails_qty > 1 || !empty($products_video)) { ?>
    <div id="sync1" class="owl-carousel">
        <?php foreach ($additional_images as $image) : ?>
            <div class="item">
                <a href="getimage/products/<?php echo $image ?>" data-lightbox="image-1">
                    <img
                            class="lazyload"
                            src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
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
        <div id="sync2" class="thumbs row text-center">
            <?php foreach ($additional_images as $k => $image) : ?>
                <div class="col-xs-3">
                    <img class="lazyload" src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                         data-src="<?php echo 'getimage/' . $thumb_size_w . 'x' . $thumb_size_h . '/products/' . $image; ?>"
                         alt="<?php echo htmlentities($products_name) . ' - ' . ($k + 1); ?>">
                </div>
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
            <img class="lazyload" src="<?= DIR_WS_IMAGES_CDN ?>pixel_trans.png"
                 data-src="<?php echo 'getimage/' . $big_width . 'x' . $big_height . '/products/' . $image; ?>"
                 alt="<?php echo htmlentities($products_name); ?>"
                 title="<?php echo IMAGE_BUTTON_ADDTO_CART . ' ' . htmlentities($products_name); ?>"/>
        </a>
    </div>
<?php } ?>
