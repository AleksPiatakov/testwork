<?php $conf = isset($template->settings['HEADER']['H_TOP_MENU']['infobox_data'])
    ? unserialize($template->settings['HEADER']['H_TOP_MENU']['infobox_data'])['toggle_mobile_visible']['val']
    : false; ?>
<div class="add_nav">
    <nav class="navbar navbar-inverse gradient" id="navbar">
        <div class="container container_add_nav categories_menu">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#responsive-add_nav" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                            class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
                <?php require $template->requireBox('H_LOGO'); ?>
                <!-- SHOPPING CART LESS 768 PX -->
                <?php $cart_products = $cart->get_products(); // Shopping cart
                $cart_count = $cart->count_contents(); // products in cart ?>
                <a href="#" rel="nofollow" class="popup_cart basket_768">
                    <span class="mobile_cart_count quantity_basket_768"><?php echo $cart_count; ?></span>
                </a>
                <!-- END SHOPPING CART LESS 768 PX -->
            </div>
            <div class="collapse navbar-collapse" id="responsive-add_nav">
                <div class="search_site visible-xs">
                    <?php require $template->requireBox('H_SEARCH', $config); ?>
                </div>
                <?php if (($conf == false and isMobile()) or $conf == true) : ?>
                    <ul class="navbar-right navbar-nav clearfix">
                        <?php
                        // get categories list as accordion:
                        function tep_get_category_tree2($cat_tree, $category_str = '', $level = 0)
                        {
                            global $cat_names, $cat_imgs;

                            if ($cat_tree) {
                                foreach ($cat_tree as $cid => $cname) {
                                    if ($level == 0) {
                                        $category_str .= '<li class="nav2_dropdown"><a href="' . tep_href_link(
                                            FILENAME_DEFAULT,
                                            'cPath=' . $cid,
                                            'NONSSL'
                                        ) . '">' . $cat_names[$cid] . '</a>'; // link for current category
                                        if (is_array($cname)) { // if we have subcategories
                                            if (!empty($cat_imgs[$cid])) {
                                                $image_file_name = '<img class="lazyload" src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/250x250/categories/' . $cat_imgs[$cid] . '" alt="' . $cat_names[$cid] . '" title="' . $cat_names[$cid] . '" />';
                                            } else {
                                                $image_file_name = '';
                                            }

                                            $category_str .= '<ul class="sub_ul"><li class="wrapper"><a class="parent_category_image" href="' . tep_href_link(
                                                FILENAME_DEFAULT,
                                                'cPath=' . $cid,
                                                'NONSSL'
                                            ) . '">' . $image_file_name . '</a>';
                                            $category_str = tep_get_category_tree2($cname, $category_str, $level + 1);
                                            $category_str .= '</li></ul>';
                                        }
                                        $category_str .= '</li>';
                                    } elseif ($level == 1) {
                                        $category_str .= '<div class="sub"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg><a href="' . tep_href_link(
                                            FILENAME_DEFAULT,
                                            'cPath=' . $cid,
                                            'NONSSL'
                                        ) . '">' . $cat_names[$cid] . '</a>';
                                        if (is_array($cname)) { // if we have subcategories
                                            $category_str = tep_get_category_tree2($cname, $category_str, $level + 1);
                                        }
                                        $category_str .= '</div>';
                                    } elseif ($level == 2) {
                                        $category_str .= '<div class="sub_sub"><a href="' . tep_href_link(
                                            FILENAME_DEFAULT,
                                            'cPath=' . $cid,
                                            'NONSSL'
                                        ) . '" >' . $cat_names[$cid] . '</a></div>';
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
                            echo '<h4 class="text-center">' . BOX_HEADING_NO_CATEGORY_OF_PRODUCTS . '</h4>';
                        }

                        ?>
                    </ul>
                <?php endif; ?>
                <hr class="mob_hr visible-xs">
                <div class="lang_curr_block visible-xs">
                    <?php require $template->requireBox('H_LANGUAGES'); ?>
                    <?php require $template->requireBox('H_CURRENCIES'); ?>
                    <div class="login_block">
                        <?php if (userExists()) { ?>
                            <a rel="nofollow" href="<?= tep_href_link("account_history.php"); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M447.8 438.3c-7.2-31.8-48.3-47.3-62.5-52.3-15.6-5.5-37.8-6.8-52.1-10-8.2-1.8-20.1-6.3-24.1-11.1s-1.6-49.3-1.6-49.3 7.4-11.5 11.4-21.7c4-10.1 8.4-37.9 8.4-37.9s8.2 0 11.1-14.4c3.1-15.7 8-21.8 7.4-33.5-.6-11.5-6.9-11.2-6.9-11.2s6.1-16.7 6.8-51.3c.9-41.1-31.3-81.6-89.6-81.6-59.1 0-90.6 40.5-89.7 81.6.8 34.6 6.7 51.3 6.7 51.3s-6.3-.3-6.9 11.2c-.6 11.7 4.3 17.8 7.4 33.5 2.8 14.4 11.1 14.4 11.1 14.4s4.4 27.8 8.4 37.9c4 10.2 11.4 21.7 11.4 21.7s2.4 44.5-1.6 49.3c-4 4.8-15.9 9.3-24.1 11.1-14.3 3.2-36.5 4.5-52.1 10-14.2 5-55.3 20.5-62.5 52.3-1.1 5 2.7 9.7 7.9 9.7H440c5.1 0 8.9-4.7 7.8-9.7z"></path>
                                </svg>
                                <?= LOGIN_BOX_MY_CABINET; ?>
                            </a>
                            <a rel="nofollow" class="registration" href="<?= tep_href_link(FILENAME_LOGOFF); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M8 9v-4l8 7-8 7v-4h-8v-6h8zm2-7v2h12v16h-12v2h14v-20h-14z"/>
                                </svg>
                                <?= HEADER_TITLE_LOGOFF; ?>
                            </a>
                        <?php } else { ?>
                            <a rel="nofollow" class="enter_link" href="<?= tep_href_link("login.php"); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M447.8 438.3c-7.2-31.8-48.3-47.3-62.5-52.3-15.6-5.5-37.8-6.8-52.1-10-8.2-1.8-20.1-6.3-24.1-11.1s-1.6-49.3-1.6-49.3 7.4-11.5 11.4-21.7c4-10.1 8.4-37.9 8.4-37.9s8.2 0 11.1-14.4c3.1-15.7 8-21.8 7.4-33.5-.6-11.5-6.9-11.2-6.9-11.2s6.1-16.7 6.8-51.3c.9-41.1-31.3-81.6-89.6-81.6-59.1 0-90.6 40.5-89.7 81.6.8 34.6 6.7 51.3 6.7 51.3s-6.3-.3-6.9 11.2c-.6 11.7 4.3 17.8 7.4 33.5 2.8 14.4 11.1 14.4 11.1 14.4s4.4 27.8 8.4 37.9c4 10.2 11.4 21.7 11.4 21.7s2.4 44.5-1.6 49.3c-4 4.8-15.9 9.3-24.1 11.1-14.3 3.2-36.5 4.5-52.1 10-14.2 5-55.3 20.5-62.5 52.3-1.1 5 2.7 9.7 7.9 9.7H440c5.1 0 8.9-4.7 7.8-9.7z"></path>
                                </svg>
                                <?= IMAGE_BUTTON_LOGIN; ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <hr class="mob_hr visible-xs">
                <ul class="top_liks_mob visible-xs">
                    <?php
                    $art_array = getArticles(16, 7);  // 16 - id for "Information"
                    if (is_array($art_array)) {
                        foreach ($art_array as $articles) {
                            $link = $_SERVER['REQUEST_URI'];
                            $link = $link != '/' ? substr($link, 1, strlen($link)) : $link;
                            $active = $articles['link'] == $link ? 'class="active"' : '';
                            echo '<li><a ' . $active . ' href="' . $articles['link'] . '">' . $articles['name'] . '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>

        </div><!-- END CONTAINER -->
    </nav>
</div>
