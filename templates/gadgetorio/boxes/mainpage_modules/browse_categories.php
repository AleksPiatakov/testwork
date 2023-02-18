<?php if (is_array($cat_tree) and !empty($cat_tree)) { ?>
    <div id="browse_category" class="row subcats_imgs">

        <div class="col-md-12 categories-mainpage">
            <?php

            $category_str = '';
            foreach ($cat_tree as $cid => $cname) {
//                debug($subcat_tree);

                $categoryImage = "";
                if (!empty($cat_icons[$cid])) {
                    $categoryImage = $cat_icons[$cid];
                } else {
                    if (!empty($cat_imgs[$cid])) {
                        $categoryImage = $cat_imgs[$cid];
                    }
                }

                $category_str .= '<div class="item col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                      <a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cid, 'NONSSL') . '">';
                if ($categoryImage) {
                    $category_str .= '<div class="thumb"><img class="img-responsive" src="getimage/' . SMALL_IMAGE_WIDTH . 'x' . SMALL_IMAGE_HEIGHT . '/categories/' . $categoryImage . '"></div>'; // show image
                }
                $category_str .= '<span class="title">
                                            <div class="name">' . $cat_names[$cid] . '</div>
                                          </span>
                                      </a>
                                  </div>';
            }

            echo $category_str;

            ?>
        </div>
    </div>

<?php } ?>
