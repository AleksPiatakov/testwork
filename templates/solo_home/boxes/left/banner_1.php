<?php

$banner = renderArticle($config['id']['val'] ?: 'banner_1', [
    'image',
]);
if ($banner) {
    echo '<div class="bn_sidebar">';
    if ($banner['articles_description']) {
        echo $banner['articles_description'];
    } elseif ($banner['articles_image']) {
        echo '<img class="img-responsive" alt="' . $banner['articles_image'] . '" src="' . HTTP_SERVER . '/getimage/' . $banner['articles_image'] . '" />';
    }
    echo '</div>';
}
