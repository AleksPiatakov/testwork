</div></div></div>
<?php
$banner = renderArticle($config['id']['val'] ?: 'banner_long', [
    'image',
]);
if (!empty($banner['articles_description']) || !empty($banner['articles_image'])) { ?>
    <!-- BANNER LONG -->
    <div class="row_big_banner">
        <div class="big_banner">
            <?php
            if ($banner['articles_description']) {
                echo $banner['articles_description'];
            } else {
                echo '<img class="img-responsive lazyload" alt="' . $banner['articles_image'] . '" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . HTTP_SERVER . '/getimage/' . $banner['articles_image'] . '" />';
            }
            ?>
        </div>
    </div><!-- END BANNER LONG -->
<?php } ?>
<div class="container">
    <div class="row">
        <div class="<?php echo $center_classes ?> right_content">

