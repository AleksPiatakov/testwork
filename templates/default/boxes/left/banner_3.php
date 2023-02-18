<?php

$banner = renderArticle($config['id']['val'] ?: 'banner_3', [
    'image',
]);
if ($banner) {
    echo '<div class="bn_sidebar">';

    if ($banner['articles_description']) {
        echo $banner['articles_description'];
    } elseif ($banner['articles_image']) {
        echo '<img class="img-responsive lazyload" alt="' . $banner['articles_image'] . '" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . HTTP_SERVER . '/getimage/' . $banner['articles_image'] . '" height="562" width="345"/>';
    }
    echo '</div>';
}
