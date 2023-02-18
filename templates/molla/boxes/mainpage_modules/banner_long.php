<?php

$module_name = 'banner_long';
$module_is_ajax = isset($config['ajax']['val']) && $config['ajax']['val'] == '1' ? true : false;

if (isset($_POST['render']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' || !$module_is_ajax) {
    if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
        echo '<div class="' . ($template->getModuleSetting(
            'MAINPAGE',
            'M_BANNER_LONG',
            'content_width'
        ) ? 'container' : 'container-fluid') . '">';
    }
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
                        echo '<img class="img-responsive lazyload" alt="' . $banner['articles_image'] . '" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="' . HTTP_SERVER . '/getimage/' . $banner['articles_image'] . '" />';
                    }
                    ?>
                </div>
            </div>
        </div><!-- END BANNER LONG -->
    <?php }
    if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
        echo '</div>';
    }
}
if ($module_is_ajax) { ?>
    <div data-module-id="<?= $module_name ?>" class="ajax-module-box lazy-data-block"><span
                class="lazy-data-loader"></span></div>
<?php }
?>
