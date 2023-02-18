<?php

$banner = renderArticle($config['id']['val'] ?: 'banner_2', [
    'image',
]);
if ($banner) {
    if ($banner['articles_description']) {
        echo '<div class="bn_sidebar 222">' . $banner['articles_description'] . '</div>';
    } elseif ($banner['articles_image']) {
        echo '<div class="bn_sidebar 123"><img class="img-responsive" alt="' . $banner['articles_image'] . '" src="' . HTTP_SERVER . '/getimage/' . $banner['articles_image'] . '" /></div>';
    }
}
