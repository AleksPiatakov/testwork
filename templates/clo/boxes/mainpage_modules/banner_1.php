<?php

$banner = renderArticle('banner_1', [
    'image',
]);

if ($banner['articles_description']) {
    echo $banner['articles_description'];
} else {
    echo '<img class="img-responsive lazyload" alt="' . $banner['articles_image'] . '" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . HTTP_SERVER . '/getimage/' . $banner['articles_image'] . '" />';
}
