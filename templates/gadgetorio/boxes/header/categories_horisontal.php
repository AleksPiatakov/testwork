<?php $conf = isset($template->settings['HEADER']['H_TOP_MENU']['infobox_data'])
    ? unserialize($template->settings['HEADER']['H_TOP_MENU']['infobox_data'])['toggle_mobile_visible']['val']
    : false; ?>

<div class="add_nav">
    <nav class="navbar navbar-default gradient">
        <div class="container container_add_nav categories_menu">
            <?php require $template->requireBox('H_LOGO'); ?>
            <div class="header-categories">
                <div class="header-menu">
                    <div class="megamenu-fader"></div>
                    <?php if (($conf == false and isMobile()) or $conf == true) : ?>
                        <div class="dropdown header-menu-dropdown dropdown-animate" id="header-megamenu">
                            <div class="megamenu-fader"></div>
                            <button class="dropdown-toggle dropdown-button" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                <div class="button-main-cursor">
                                    <span class="button-title"><?= TEXT_HEADING_CATALOG; ?></span> <span
                                            class="caret"></span>
                                </div>
                            </button>
                            <div class="dropdown-menu stop_propagation">
                                <ul class="nav2 navbar-nav clearfix">
                                    <?php

                                    $catProductCounter_ready = countAllCategoryProductsRecursive();

                                    // get categories list as accordion:
                                    function tep_get_category_tree2($cat_tree, $category_str = '', $level = 0)
                                    {
                                        global $cat_names, $cat_imgs, $cat_icons, $cat_description, $catProductCounter_ready;

                                        if ($cat_tree) {
                                            foreach ($cat_tree as $cid => $cname) {
                                                $image_file_name = (!empty($cat_imgs[$cid]) or !empty($cat_icons[$cid])) ? '<div class="c-icon"><img src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/64x64/categories/' . ($cat_icons[$cid] ?: $cat_imgs[$cid]) . '" alt="' . $cat_names[$cid] . '" title="' . $cat_names[$cid] . '" class="lazyload" /></div>' : '';
                                                $caret = '<span class="caret"></span>';
//                                            $caret = '';

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
                                                        ) . '" class="submenu level-0">
                                                            ' . $cat_names[$cid] . '
                                                            <span class="counter">' . ($catProductCounter_ready[$cid] ?: '') . '</span>
                                                            ' . $caret . '
                                                        </a>'; // link for current category

                                                        $category_str .= '<div class="submenu-list"><div class="go-back-xs">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                            <path d="M217.9 256L345 129c9.4-9.4 9.4-24.6 0-33.9-9.4-9.4-24.6-9.3-34 0L167 239c-9.1 9.1-9.3 23.7-.7 33.1L310.9 417c4.7 4.7 10.9 7 17 7s12.3-2.3 17-7c9.4-9.4 9.4-24.6 0-33.9L217.9 256z"></path>
                                                                        </svg>
                                                                        ' . COMP_PROD_BACK . '
                                                                        </div>
                                                                    <div class="scroll-content">';
                                                        $category_str = tep_get_category_tree2(
                                                            $cname,
                                                            $category_str,
                                                            $level + 1
                                                        );
                                                        $category_str .= '</div></div>';
                                                    } else {
                                                        $category_str .= '<li>';
                                                        $category_str .= '
                                                        <a href="' . tep_href_link(
                                                            FILENAME_DEFAULT,
                                                            'cPath=' . $cid,
                                                            'NONSSL'
                                                        ) . '">
                                                            ' . $cat_names[$cid] . '
                                                            <span class="counter">' . ($catProductCounter_ready[$cid] ?: '') . '</span>
                                                        </a>'; // link for current category
                                                    }
                                                    $category_str .= '</li>';
                                                } elseif ($level == 1) {
                                                    $category_str .= '<div class="sub">';
                                                    // if category has a sub category
                                                    if (is_array($cname)) {
                                                        $category_str .= '<a href="' . tep_href_link(
                                                            FILENAME_DEFAULT,
                                                            'cPath=' . $cid,
                                                            'NONSSL'
                                                        ) . '" class="submenu">
                                                                            ' . $cat_names[$cid] . '
                                                                            <span class="counter">' . ($catProductCounter_ready[$cid] ?: '') . '</span>
                                                                        </a>';
                                                        // adding child subcategory to this category
                                                        $category_str .= '<div class="bottom-submenu-list">';
                                                        $category_str = tep_get_category_tree2(
                                                            $cname,
                                                            $category_str,
                                                            $level + 1
                                                        );
                                                        $category_str .= '</div>';
                                                    } else {
                                                        // if category doesn't have sub category
                                                        $category_str .= '<a href="' . tep_href_link(
                                                            FILENAME_DEFAULT,
                                                            'cPath=' . $cid,
                                                            'NONSSL'
                                                        ) . '">
                                                                            ' . $cat_names[$cid] . '
                                                                            <span class="counter">' . ($catProductCounter_ready[$cid] ?: '') . '</span>
                                                                        </a>';
                                                    }
                                                    $category_str .= '</div>';
                                                } elseif ($level == 2) {
                                                    $category_str .= '<div class="sub_sub">
                                                                    <a href="' . tep_href_link(
                                                        FILENAME_DEFAULT,
                                                        'cPath=' . $cid,
                                                        'NONSSL'
                                                    ) . '">
                                                                        ' . $cat_names[$cid] . '
                                                                        <span class="counter">' . ($catProductCounter_ready[$cid] ?: '') . '</span>
                                                                    </a>
                                                                </div>';
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
                    <div class="dropdown header-menu-dropdown dropdown-animate">
                        <div class="megamenu-fader"></div>
                        <div class="dropdown-toggle dropdown-button" data-toggle="dropdown" aria-haspopup="true"
                             aria-expanded="false">
                            <div class="button-main-cursor">
                                <span class="button-title"><?= FOOTER_INFO ?></span> <span class="caret"></span>
                            </div>
                        </div>
                        <div class="dropdown-menu discover-menu">
                            <?php require $template->requireBox('H_TOP_LINKS', $config); ?>
                        </div>
                    </div>
                    <div class="dropdown header-menu-dropdown dropdown-animate">
                        <div class="megamenu-fader"></div>
                        <button class="header-top-link dropdown-button dropdown-toggle" type="button"
                                data-toggle="dropdown">
                            <div class="button-main-cursor">
                                <span class="button-title"><?= BOX_HEADING_MANUFACTURERS ?></span> <span
                                        class="caret"></span>
                            </div>
                        </button>
                        <div class="dropdown-menu">
                            <?php
                            if (is_array($manufacturers_array)) {
                                $manufacturers_list = '';
                                $i = 0;
                                foreach ($manufacturers_array as $mid => $mvals) {
                                    $i++;
                                    if ($i <= 7) {
                                        ($mid == $_GET['manufacturers_id'] ? ($marker_class = 'manuf_bg_current') : ($marker_class = 'manuf_bg'));
                                        $manufacturers_list .= '<a class="' . $marker_class . '" href="' . tep_href_link(
                                            FILENAME_DEFAULT,
                                            'manufacturers_id=' . $mid,
                                            'NONSSL'
                                        ) . '">
                                                                    ' . substr(
                                            $mvals['name'],
                                            0,
                                            MAX_DISPLAY_MANUFACTURER_NAME_LEN
                                        ) . '
                                                                    <span class="counter">' . ($prodToManufacturers[$mid] ? '(' . $prodToManufacturers[$mid] . ')' : '') . '</span>
                                                                </a>';
                                    }
                                }
                                echo $manufacturers_list;
                            }
                            ?>
                            <li>
                                <a href="<?= tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'); ?>brands"
                                   class="all_brands"><?= TEXT_NAVIGATION_BRANDS ?></a>
                            </li>
                        </div>
                    </div>

                    <ul class="xs-menu-actions">

                        <li>
                            <span class="popup_cart">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <ellipse transform="rotate(-1.057 159.995 423.97) scale(.99997)" cx="160" cy="424"
                                             rx="24" ry="24"></ellipse>
                                    <ellipse transform="matrix(.02382 -.9997 .9997 .02382 -48.51 798.282)" cx="384.5"
                                             cy="424" rx="24" ry="24"></ellipse>
                                    <path d="M463.8 132.2c-.7-2.4-2.8-4-5.2-4.2L132.9 96.5c-2.8-.3-6.2-2.1-7.5-4.7-3.8-7.1-6.2-11.1-12.2-18.6-7.7-9.4-22.2-9.1-48.8-9.3-9-.1-16.3 5.2-16.3 14.1 0 8.7 6.9 14.1 15.6 14.1s21.3.5 26 1.9c4.7 1.4 8.5 9.1 9.9 15.8 0 .1 0 .2.1.3.2 1.2 2 10.2 2 10.3l40 211.6c2.4 14.5 7.3 26.5 14.5 35.7 8.4 10.8 19.5 16.2 32.9 16.2h236.6c7.6 0 14.1-5.8 14.4-13.4.4-8-6-14.6-14-14.6H188.9c-2 0-4.9 0-8.3-2.8-3.5-3-8.3-9.9-11.5-26l-4.3-23.7c0-.3.1-.5.4-.6l277.7-47c2.6-.4 4.6-2.5 4.9-5.2l16-115.8c.2-.8.2-1.7 0-2.6z"></path>
                                </svg>
                                <?= BUTTON_SHOPPING_CART_OPEN; ?>
                                <span class="counter mobile_cart_count"><?= $cart->count_contents() ?></span>
                            </span>
                        </li>
                        <li>
                            <a rel="nofollow" href="<?= tep_href_link('login.php'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 256c52.805 0 96-43.201 96-96s-43.195-96-96-96-96 43.201-96 96 43.195 96 96 96zm0 48c-63.598 0-192 32.402-192 96v48h384v-48c0-63.598-128.402-96-192-96z"></path>
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

            <?php require $template->requireBox('H_SEARCH', $config); ?>

            <div class="header-actions">
                <!-- SHOPPING CART -->
                <?php require $template->requireBox('H_SHOPPING_CART'); ?>
                <?php echo $cart_output; ?>
                <!-- END SHOPPING CART -->

                <!-- LOGIN -->
                <?php require $template->requireBox('H_LOGIN'); ?>
                <!-- END LOGIN -->
            </div>
            <button class="open-menu-xs">
                <div class="fader"></div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M64 384h384v-42.666H64V384zm0-106.666h384v-42.667H64v42.667zM64 128v42.665h384V128H64z"></path>
                </svg>
            </button>
        </div><!-- END CONTAINER -->
    </nav>
</div>

<div class="search-form-fader" id="search-form-fader"></div>
