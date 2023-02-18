<?php
$banner = renderArticle($config['id']['val'] ?: 'banner_long', [
    'image',
]);
if (!empty($banner['articles_description']) || !empty($banner['articles_image'])) { ?>
<!-- BANNER LONG -->
<div class="row row_big_banner">
    <div class="col-xs-12">
        <div class="big_banner">
            <?php
            if ($banner['articles_description']) {
                echo $banner['articles_description'];
            } else {
                echo '<img class="img-responsive lazyload anim" alt="' . $banner['articles_image'] . '" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . HTTP_SERVER . '/getimage/' . $banner['articles_image'] . '" />';
            }
            ?>
        </div>
    </div>
</div><!-- END BANNER LONG -->
<?php } ?>