<div id="browse_category">
    <div class="like_h2">
        <?= DEMO2_LEFT_CAT_TITLE; ?>
        <a class="link_whole_list"
           href="<?= tep_href_link(FILENAME_DEFAULT, 'cPath=0', 'NONSSL'); ?>"><?= DEMO2_TITLE_SLIDER_LINK; ?></a>
    </div>
    <div class="subcats_imgs">
        <?php
        switch (count($cat_tree)) {
            case 1:
                $browse_categories_class = 'col-3';
                break;
            case 2:
                $browse_categories_class = 'col-4';
                break;
            case 3:
                $browse_categories_class = 'col-4';
                break;
            case 4:
                $browse_categories_class = 'col-3';
                break;
            case 6:
                $browse_categories_class = 'col-2';
                break;
            default:
                $browse_categories_class = 'col-half-2';
                break;
        }
        if (is_array($cat_tree) and !empty($cat_tree)) {
            $category_str = '';
            foreach ($cat_tree as $cid => $cname) {
                $category_str .= '<div class="' . $browse_categories_class . ' browse_categories_item">
                                    <a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cid, 'NONSSL') . '">';
                if (isset($cat_imgs[$cid]) && $cat_imgs[$cid]) {
                    $category_str .= '<img class="lazyload" alt="' . $cat_names[$cid] . '" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/' . SMALL_IMAGE_WIDTH . 'x' . SMALL_IMAGE_HEIGHT . '/categories/' . $cat_imgs[$cid] . '">';
                } // show image
                $category_str .= '<span>';
                $category_str .= $cat_names[$cid] . '</span>
                                    </a>
                                  </div>';
            }
            echo $category_str;
        }
        ?>
    </div>
</div>
