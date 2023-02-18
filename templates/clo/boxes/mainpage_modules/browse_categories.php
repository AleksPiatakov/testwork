<div id="browse_category" class="container subcats_imgs">
    <div class="row">
        <?php
        if (is_array($cat_tree) and !empty($cat_tree)) {
            $category_str = '';
            foreach ($cat_tree as $cid => $cname) {
                $category_str .= '<div class="category_block">
                                    <a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cid, 'NONSSL') . '">';
                if (isset($cat_imgs[$cid]) && $cat_imgs[$cid]) {
                    $category_str .= '<img class="img-responsive lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/' . SMALL_IMAGE_WIDTH . 'x' . SMALL_IMAGE_HEIGHT . '/categories/' . $cat_imgs[$cid] . '">';
                } // show image
                $category_str .= $cat_names[$cid] . '
                                    </a>
                                  </div>';
            }

            echo $category_str;
        }
        ?>
    </div>
</div>
