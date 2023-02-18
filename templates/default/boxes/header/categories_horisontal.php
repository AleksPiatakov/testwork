<?php $conf = isset($template->settings['HEADER']['H_TOP_MENU']['infobox_data'])
    ? unserialize($template->settings['HEADER']['H_TOP_MENU']['infobox_data'])['toggle_mobile_visible']['val']
    : false; ?>

<?php if ($conf == true) : ?>
    <div class="add_nav">
        <nav class="navbar navbar-default gradient">
            <div class="<?php echo $template->getMainconf(
                'CONTENT_WIDTH'
                        ) ? 'container' : 'container-fluid'; ?> container_add_nav categories_menu">
                <div class="block_categories">
                    <ul class="nav2 navbar-nav clearfix">
                        <?php
                        // get categories list as dropdown list:
                        if (!function_exists('tep_get_category_tree2')) {
                            function tep_get_category_tree2($cat_tree, $category_str = '', $level = 0)
                            {
                                global $cat_names, $cat_imgs;

                            if ($cat_tree) {
                                $i = 0;
                                $countCategory = 0;
                                foreach ($cat_tree as $cid => $cname) {
                                    if ($level == 0) {
                                        if ($countCategory < 10) {
                                            if (is_array($cname)) { // if we have subcategories
                                                $category_str .= '<li class="show-sub_ul"><a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cid, 'NONSSL') . '">' . $cat_names[$cid] . '</a>'; // link for current category

                                                $category_str .= '<ul class="sub_ul"><li class="wrapper">';
                                                $category_str = tep_get_category_tree2($cname, $category_str, $level + 1);
                                                $category_str .= '</li></ul>';
                                            } else {
                                                $category_str .= '<li><a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cid, 'NONSSL') . '">' . $cat_names[$cid] . '</a>'; // link for current category
                                            }
                                            $category_str .= '</li>';
                                            $countCategory++;
                                        } else {
                                            if ($countCategory === 10) {
                                                $category_str .= '<li><a href="#">' . CATEGORIES_HORIZONTAL_ALL_TEXT . '</a><ul class="sub_ul"><li class="wrapper">';
                                            }
                                            if (!empty($cat_imgs[$cid]))
                                                $image_file_name = '<img class="lazyload" src="'.DIR_WS_IMAGES_CDN.'pixel_trans.png" data-src="getimage/'.(isMobile()?'50x50':'80x80').'/categories/' . $cat_imgs[$cid] . '" alt="' . $cat_names[$cid] . '" title="' . $cat_names[$cid] . '" height="1" width="1"/>';
                                            else $image_file_name = '';
                                            $category_str .= '<div class="sub"><a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cid, 'NONSSL') . '">' . $image_file_name . ' ' . $cat_names[$cid] . '</a>';
                                            if (is_array($cname)) { // if we have subcategories
                                                $category_str .='<div class="sub_sub_list">';
                                                $category_str = tep_get_category_tree2($cname, $category_str, $level + 1);
                                                if (is_array($cname) and count($cname) > 6) $category_str .= '<div class="sub_sub"><br /><a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $cid, 'NONSSL') . '" >' . SHOW_ALL_SUBCATS . '</a></div>';
                                                $category_str .= '</div>';
                                            }
                                            $category_str .= '</div>';
                                            $countCategory++;
                                            if ($countCategory === count($cat_tree)) {
                                                $category_str .= '</li></ul></li>';
                                            }
                                        }

                                    } elseif ($level == 1) {
                                        if (!empty($cat_imgs[$cid]))
                                            $image_file_name = '<img class="lazyload" src="'.DIR_WS_IMAGES_CDN.'pixel_trans.png" data-src="getimage/'.(isMobile()?'50x50':'80x80').'/categories/' . $cat_imgs[$cid] . '" alt="' . $cat_names[$cid] . '" title="' . $cat_names[$cid] . '" height="1" width="1"/>';
                                        else $image_file_name = '';

                                            $category_str .= '<div class="sub"><a href="' . tep_href_link(
                                                FILENAME_DEFAULT,
                                                'cPath=' . $cid,
                                                'NONSSL'
                                            ) . '">' . $image_file_name . ' ' . $cat_names[$cid] . '</a>';

                                            if (is_array($cname)) { // if we have subcategories
                                                $category_str .= '<div class="sub_sub_list">';
                                                $category_str = tep_get_category_tree2(
                                                    $cname,
                                                    $category_str,
                                                    $level + 1
                                                );

                                                if (is_array($cname) and count($cname) > 6) {
                                                    $category_str .= '<div class="sub_sub"><br /><a href="' . tep_href_link(
                                                        FILENAME_DEFAULT,
                                                        'cPath=' . $cid,
                                                        'NONSSL'
                                                    ) . '" >' . SHOW_ALL_SUBCATS . '</a></div>';
                                                }
                                                $category_str .= '</div>';
                                            }
                                            $category_str .= '</div>';
                                        } elseif ($level == 2) {
                                            $i++;
                                            if ($i <= 6) {
                                                $category_str .= '<div class="sub_sub"><a href="' . tep_href_link(
                                                    FILENAME_DEFAULT,
                                                    'cPath=' . $cid,
                                                    'NONSSL'
                                                ) . '" >' . $cat_names[$cid] . '</a></div>';
                                            }
                                        }
                                    }
                                    return $category_str;
                                }
                                return false;
                            }
                        }
                        // run functions:
                        if ($category = tep_get_category_tree2($cat_tree)) {
                            echo $category;
                        } else {
                            echo '<h4 class="text-center">' . BOX_HEADING_NO_CATEGORY_OF_PRODUCTS . '</h4>';
                        }

                        ?>
                    </ul>
                </div>
            </div><!-- END CONTAINER -->
        </nav>
    </div>
<?php endif; ?>
