<?php

$banner = renderArticle('banner_long', [
    'image',
]);

if (!empty($banner['articles_description'])) {
    echo $banner['articles_description'];
} elseif (!empty($banner['articles_image'])) {
    echo '<img class="img-responsive lazyload" alt="' . $banner['articles_image'] . '" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . HTTP_SERVER . '/getimage/' . $banner['articles_image'] . '" />';
}
