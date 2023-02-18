<?php $conf = isset($template->settings['HEADER']['H_TOP_MENU']['infobox_data'])
    ? unserialize($template->settings['HEADER']['H_TOP_MENU']['infobox_data'])['toggle_mobile_visible']['val']
    : false; ?>

<div class="add_nav">
    <nav class="navbar navbar-default gradient">
        <div class="container container_add_nav categories_menu">
            <?php require $template->requireBox('H_SEARCH', $config); ?>
            <?php require $template->requireBox('H_LOGO'); ?>

            <!--        <div class="collapse navbar-collapse" id="responsive-add_nav">-->
            <div class="col-lg-6 col-md-7 col-sm-7 header-categories">
                <div class="header-menu">
                    <?php if (($conf == false and isMobile()) or $conf == true) : ?>
                        <div class="dropdown dropdown-hover header-menu-dropdown dropdown-animate" id="header-megamenu">
                            <div class="megamenu-fader"></div>

                            <button class="dropdown-toggle dropdown-button" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <div class="button-main-cursor">
                                    <span class="button-title"><?= TEXT_HEADING_CATALOG; ?></span> <span
                                            class="caret"></span>
                                </div>
                            </button>

                            <div class="dropdown-menu">
                                <span class="trinagle"></span>
                                <ul class="nav2 navbar-nav clearfix">
                                    <?php

                                    $catProductCounter_ready = countAllCategoryProductsRecursive();

                                    // get categories list as accordion:
                                    function tep_get_category_tree2($cat_tree, $category_str = '', $level = 0)
                                    {
                                        global $cat_names, $cat_imgs, $cat_icons, $cat_description, $catProductCounter_ready;

                                        if ($cat_tree) {
                                            foreach ($cat_tree as $cid => $cname) {
                                                /*   $description = ($cat_description[$cid]) ? strip_tags($cat_description[$cid]) : '';
                                                   $description = mb_substr($description, 0, 45, "utf-8") . ((strlen($description) >= 45) ? '...' : '');
                                                   $description = '<span class="cat_desc">'. $description .'</span>';      */
                                                $description = '';

                                                $image_file_name = '<span class="cat_img"><img  src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/' . SMALL_IMAGE_WIDTH . 'x' . SMALL_IMAGE_HEIGHT . '/categories/' . (($cat_icons[$cid] ?: $cat_imgs[$cid]) ?: 'default') . '" class="lazyload" alt="' . $cat_names[$cid] . '" title="' . $cat_names[$cid] . '" /></span>';
                                                //                                        $caret = '<span class="caret"></span>';
                                                $caret = '';

                                                if ($level == 0) {
                                                    if (is_array($cname)) {
                                                        $sub_categories = tep_get_category_tree2(
                                                            $cname,
                                                            $category_str,
                                                            $level + 1
                                                        );
                                                        $category_str .= '<li class="dropdown-submenu">';
                                                        $category_str .= '
                                                        <a href="' . tep_href_link(
                                                            FILENAME_DEFAULT,
                                                            'cPath=' . $cid,
                                                            'NONSSL'
                                                        ) . '" class="submenu">
                                                            ' . $image_file_name . '
                                                            <span class="cat_name">' . $cat_names[$cid] . '<span class="counter">' . ($catProductCounter_ready[$cid] ?: '') . '</span></span>
                                                            ' . $caret . '
                                                            ' . $description . '
                                                        </a>'; // link for current category
                                                    } else {
                                                        $category_str .= '<li>';
                                                        $category_str .= '
                                                        <a href="' . tep_href_link(
                                                            FILENAME_DEFAULT,
                                                            'cPath=' . $cid,
                                                            'NONSSL'
                                                        ) . '">
                                                            ' . $image_file_name . '
                                                            <span class="cat_name">' . $cat_names[$cid] . '<span class="counter">' . ($catProductCounter_ready[$cid] ?: '') . '</span></span>
                                                            ' . $description . '
                                                        </a>'; // link for current category
                                                    }

                                                    $category_str .= '</li>';
                                                } elseif ($level == 1) {
                                                    $category_str .= '<div class="sub"><a href="' . tep_href_link(
                                                        FILENAME_DEFAULT,
                                                        'cPath=' . $cid,
                                                        'NONSSL'
                                                    ) . '">' . $cat_names[$cid] . '<span class="counter">' . ($catProductCounter_ready[$cid] ?: 0) . '</span></a>';
                                                    if (is_array($cname)) { // if we have subcategories
                                                        $category_str = tep_get_category_tree2(
                                                            $cname,
                                                            $category_str,
                                                            $level + 1
                                                        );
                                                    }
                                                    $category_str .= '</div>';
                                                } elseif ($level == 2) {
                                                    $category_str .= '<div class="sub_sub"><a href="' . tep_href_link(
                                                        FILENAME_DEFAULT,
                                                        'cPath=' . $cid,
                                                        'NONSSL'
                                                    ) . '" >' . $cat_names[$cid] . '<span class="counter">' . ($catProductCounter_ready[$cid] ?: 0) . '</span></a></div>';
                                                }
                                            }
                                            return $category_str;
                                        }
                                        return false;
                                    }

                                    // run functions:
                                    if ($category = tep_get_category_tree2($cat_tree)) {
                                        echo $category;
                                    } else {
                                        echo '<h4 class="text-center">' . BOX_HEADING_NO_CATEGORY_OF_PRODUCTS;
                                        '</h4>';
                                    }

                                    ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!--                    <a href="-->
                    <?php //=tep_href_link('featured.html', '', 'NONSSL')?><!--" class="header-top-link">-->
                    <?php //= BOX_HEADING_FEATURED; ?><!--</a>-->
                    <div class="dropdown dropdown-hover dropdown-animate">
                        <button class="header-top-link dropdown-button dropdown-toggle" type="button"
                                data-toggle="dropdown">
                            <div class="button-main-cursor">
                                <span class="button-title"><?= BOX_HEADING_INFORMATION; ?></span>
                                <!--                                    <span class="label">Новое</span>-->
                                <span class="caret"></span>
                            </div>
                        </button>
                        <?php require $template->requireBox('H_TOP_LINKS', $config); ?>
                    </div>
                    <div class="dropdown dropdown-hover dropdown-animate">
                        <button class="header-top-link dropdown-button dropdown-toggle" type="button"
                                data-toggle="dropdown">
                            <div class="button-main-cursor">
                                <span class="button-title"><?= BOX_HEADING_MANUFACTURERS ?></span>
                                <!--                                    <span class="label">Новое</span>-->
                                <span class="caret"></span>
                            </div>
                        </button>
                        <ul class="dropdown-menu">
                            <span class="trinagle"></span>
                            <?php
                            if (is_array($manufacturers_array)) {
                                $manufacturers_list = '';
                                $i = 0;
                                foreach ($manufacturers_array as $mid => $mvals) {
                                    $i++;
                                    if ($i <= 7) {
                                        ($mid == $_GET['manufacturers_id'] ? ($marker_class = 'manuf_bg_current') : ($marker_class = 'manuf_bg'));
                                        $manufacturers_list .= '<li class="' . $marker_class . '">
                                                                <a href="' . tep_href_link(
                                            FILENAME_DEFAULT,
                                            'manufacturers_id=' . $mid,
                                            'NONSSL'
                                        ) . '">
                                                                    <span class="cat_name">' . substr(
                                            $mvals['name'],
                                            0,
                                            MAX_DISPLAY_MANUFACTURER_NAME_LEN
                                        ) . '
                                                                        <span class="counter">' . ($prodToManufacturers[$mid] ? '(' . $prodToManufacturers[$mid] . ')' : '') . '</span>
                                                                    </span>
                                                                </a>
                                                              </li>';
                                    }
                                }
                                echo $manufacturers_list;
                            }
                            ?>
                            <li>
                                <a href="<?= tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'); ?>brands"
                                   class="all_brands"><?= TEXT_NAVIGATION_BRANDS ?></a>
                            </li>
                        </ul>
                    </div>
                    <a href="<?php echo tep_href_link(FILENAME_ARTICLES, 'tPath=13'); ?>"
                       class="header-top-link"><?php echo BOX_HEADING_ARTICLES; ?></a>

                    <div class="settings-selector visible-xs">
                        <?php require $template->requireBox('H_LANGUAGES'); ?>
                        <?php require $template->requireBox('H_CURRENCIES'); ?>
                    </div>

                    <ul class="xs-menu-actions">
                        <li>
                            <a rel="nofollow" href="<?= tep_href_link('login.php'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M447.8 438.3c-7.2-31.8-48.3-47.3-62.5-52.3-15.6-5.5-37.8-6.8-52.1-10-8.2-1.8-20.1-6.3-24.1-11.1s-1.6-49.3-1.6-49.3 7.4-11.5 11.4-21.7c4-10.1 8.4-37.9 8.4-37.9s8.2 0 11.1-14.4c3.1-15.7 8-21.8 7.4-33.5-.6-11.5-6.9-11.2-6.9-11.2s6.1-16.7 6.8-51.3c.9-41.1-31.3-81.6-89.6-81.6-59.1 0-90.6 40.5-89.7 81.6.8 34.6 6.7 51.3 6.7 51.3s-6.3-.3-6.9 11.2c-.6 11.7 4.3 17.8 7.4 33.5 2.8 14.4 11.1 14.4 11.1 14.4s4.4 27.8 8.4 37.9c4 10.2 11.4 21.7 11.4 21.7s2.4 44.5-1.6 49.3c-4 4.8-15.9 9.3-24.1 11.1-14.3 3.2-36.5 4.5-52.1 10-14.2 5-55.3 20.5-62.5 52.3-1.1 5 2.7 9.7 7.9 9.7H440c5.1 0 8.9-4.7 7.8-9.7z"></path>
                                </svg>
                                <?= LOGIN_BOX_MY_CABINET; ?>
                            </a>
                        </li>
                    </ul>

                    <ul class="xs-user-menu visible-xs">
                        <li>
                            <a rel="nofollow" href="<?= tep_href_link('compare.php'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M434.8 137.6L285.4 69.5c-16.2-7.4-42.7-7.4-58.9 0L77.2 137.6c-17.6 8-17.6 21.1 0 29.1l148 67.5c16.9 7.7 44.7 7.7 61.6 0l148-67.5c17.6-8 17.6-21.1 0-29.1zM225.2 375.2l-99.8-45.5c-4.2-1.9-9.1-1.9-13.3 0l-34.9 15.9c-17.6 8-17.6 21.1 0 29.1l148 67.5c16.9 7.7 44.7 7.7 61.6 0l148-67.5c17.6-8 17.6-21.1 0-29.1l-34.9-15.9c-4.2-1.9-9.1-1.9-13.3 0l-99.8 45.5c-16.9 7.7-44.7 7.7-61.6 0z"></path>
                                    <path d="M434.8 241.6l-31.7-14.4c-4.2-1.9-9-1.9-13.2 0l-108 48.9c-15.3 5.2-36.6 5.2-51.9 0l-108-48.9c-4.2-1.9-9-1.9-13.2 0l-31.7 14.4c-17.6 8-17.6 21.1 0 29.1l148 67.5c16.9 7.7 44.7 7.7 61.6 0l148-67.5c17.7-8 17.7-21.1.1-29.1z"></path>
                                </svg>
                                <?= GO_COMPARE; ?>
                                <span class="counter"><?php if (
                                isset($_SESSION['compares']) && is_array(
                                    $_SESSION['compares']
                                )
) {
                                        echo count($_SESSION['compares']);
                                                      } ?></span>
                            </a>
                        </li>
                        <li>
                            <a rel="nofollow" href="<?= tep_href_link('wishlist.php'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 448l-30.164-27.211C118.718 322.442 48 258.61 48 179.095 48 114.221 97.918 64 162.4 64c36.399 0 70.717 16.742 93.6 43.947C278.882 80.742 313.199 64 349.6 64 414.082 64 464 114.221 464 179.095c0 79.516-70.719 143.348-177.836 241.694L256 448z"></path>
                                </svg>
                                <?= IN_WHISHLIST; ?>
                                <span class="counter"><?php if (
                                isset($wishList->wishID) && is_array(
                                    $wishList->wishID
                                )
) {
                                        echo count($wishList->wishID);
                                                      } ?></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--        </div>-->
            <button class="open-menu-xs">
                <div class="fader"></div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M64 384h384v-42.666H64V384zm0-106.666h384v-42.667H64v42.667zM64 128v42.665h384V128H64z"></path>
                </svg>
            </button>
            <div class="col-lg-3 pull-right header-actions">
                <!-- SHOPPING CART -->
                <?php require $template->requireBox('H_SHOPPING_CART'); ?>
                <?php echo $cart_output; ?>
                <!-- END SHOPPING CART -->
                <?php
                    require $template->requireBox('H_LANGUAGES');
                ?>
                <!-- LOGIN -->
                <?php require $template->requireBox('H_LOGIN'); ?>
                <!-- END LOGIN -->

                <div class="search-form-tooltip">
                    <div id="show_search_form" class="show_search_form" data-toggle="tooltip"
                         data-placement="auto bottom" title="<?php echo BOX_OPEN_SEARCH_FORM; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M443.5 420.2L336.7 312.4c20.9-26.2 33.5-59.4 33.5-95.5 0-84.5-68.5-153-153.1-153S64 132.5 64 217s68.5 153 153.1 153c36.6 0 70.1-12.8 96.5-34.2l106.1 107.1c3.2 3.4 7.6 5.1 11.9 5.1 4.1 0 8.2-1.5 11.3-4.5 6.6-6.3 6.8-16.7.6-23.3zm-226.4-83.1c-32.1 0-62.3-12.5-85-35.2-22.7-22.7-35.2-52.9-35.2-84.9 0-32.1 12.5-62.3 35.2-84.9 22.7-22.7 52.9-35.2 85-35.2s62.3 12.5 85 35.2c22.7 22.7 35.2 52.9 35.2 84.9 0 32.1-12.5 62.3-35.2 84.9-22.7 22.7-52.9 35.2-85 35.2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div><!-- END CONTAINER -->
    </nav>
</div>

<div class="search-form-fader" id="search-form-fader"></div>
