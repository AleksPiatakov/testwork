<?php
$banner = renderArticle($config['id']['val'] ?: 'banner_long', [
    'image',
]);

if (!empty($banner['articles_description']) || !empty($banner['articles_image'])) { ?>
    <!-- BANNER LONG -->
    <div class="row big_banner_block">
        <div class="col-12">
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