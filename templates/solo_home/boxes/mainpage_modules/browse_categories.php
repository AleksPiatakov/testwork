<div id="browse_category" class="row subcats_imgs">
    <?php
    if (is_array($cat_tree) and !empty($cat_tree)) {
        $category_str = '';
        foreach ($cat_tree as $cid => $cname) {
            $category_str .= '<div class="col-xs-6 col-sm-4 col-md-3 text-center">
                                    <a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cid, 'NONSSL') . '">';
            if (isset($cat_imgs[$cid]) && $cat_imgs[$cid]) {
                $category_str .= '<img class="img-responsive" src="images/default.png" data-src="getimage/' . SMALL_IMAGE_WIDTH . 'x' . SMALL_IMAGE_HEIGHT . '/categories/' . $cat_imgs[$cid] . '">';
            } // show image
            $category_str .= '<span class="subcats_name">' . $cat_names[$cid] . '</span>
                                    </a>
                                  </div>';
        }

        echo $category_str;
    }
    ?>
</div>
