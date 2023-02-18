<?php

$module_name = 'browse_categories';
$module_is_ajax = isset($config['ajax']['val']) && $config['ajax']['val'] == '1' ? true : false;

if (isset($_POST['render']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' || !$module_is_ajax) {
    if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
        echo '<div class="' . ($template->getModuleSetting(
            'MAINPAGE',
            'M_BROWSE_CATEGORY',
            'content_width'
        ) ? 'container' : 'container-fluid') . '">';
    } ?>
    <div id="browse_category" class="row subcats_imgs">
        <?php
        if (is_array($cat_tree) and !empty($cat_tree)) {
            $category_str = '';
            foreach ($cat_tree as $cid => $cname) {
                $category_str .= '<div class="col-md-3 col-sm-3 col-xs-6 text-center">
                                        <a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cid, 'NONSSL') . '">';
                if (isset($cat_imgs[$cid]) && $cat_imgs[$cid]) {
                    $category_str .= '<img class="img-responsive lazyload" alt="' . $cat_names[$cid] . '" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/300x300/categories/' . $cat_imgs[$cid] . '" height="1" width="1">';
                } // show image
                $category_str .= $cat_names[$cid] . '
                                        </a>
                                      </div>';
            }

            echo $category_str;
        }
        ?>
    </div>
    <?php
    if (!$template->getMainconf('MC_SHOW_LEFT_COLUMN') || isMobile()) {
        echo '</div>';
    }
}
if ($module_is_ajax) {
    echo '<div data-module-id="' . $module_name . '" class="ajax-module-box lazy-data-block"><span class="lazy-data-loader"></span></div>';
}

?>
