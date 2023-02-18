<div class="container mobile_header visible-xs">
    <div class="col-xs-3 search-form-tooltip">
        <div id="show_search_form" class="show_search_form" data-toggle="tooltip" data-placement="auto bottom"
             title="<?php echo BOX_OPEN_SEARCH_FORM; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="50 0 512 512" class="open-mobile-search">
                <path d="M443.5 420.2L336.7 312.4c20.9-26.2 33.5-59.4 33.5-95.5 0-84.5-68.5-153-153.1-153S64 132.5 64 217s68.5 153 153.1 153c36.6 0 70.1-12.8 96.5-34.2l106.1 107.1c3.2 3.4 7.6 5.1 11.9 5.1 4.1 0 8.2-1.5 11.3-4.5 6.6-6.3 6.8-16.7.6-23.3zm-226.4-83.1c-32.1 0-62.3-12.5-85-35.2-22.7-22.7-35.2-52.9-35.2-84.9 0-32.1 12.5-62.3 35.2-84.9 22.7-22.7 52.9-35.2 85-35.2s62.3 12.5 85 35.2c22.7 22.7 35.2 52.9 35.2 84.9 0 32.1-12.5 62.3-35.2 84.9-22.7 22.7-52.9 35.2-85 35.2z"></path>
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="close-mobile-search d-none">
                <path d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"></path>
            </svg>
        </div>
    </div>
    <!-- search mobile//-->
    <div class="col-xs-12 search-block">
        <div class="main_search_form">
            <?php echo tep_draw_form(
                'quick_find',
                tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false),
                'get',
                'class="form_search_site"'
            ); ?>
            <input type="search" id="searchpr1" class="search_site_input search-form-input"
                   placeholder="<?php echo BOX_HEADING_SEARCH; ?>" name="keywords"
                   value="<?= stripslashes($_GET['keywords']); ?>">
            <button type="submit" name="find" id="search-form-button1" aria-label="<?php echo BOX_HEADING_SEARCH; ?>" class="search_site_submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M443.5 420.2L336.7 312.4c20.9-26.2 33.5-59.4 33.5-95.5 0-84.5-68.5-153-153.1-153S64 132.5 64 217s68.5 153 153.1 153c36.6 0 70.1-12.8 96.5-34.2l106.1 107.1c3.2 3.4 7.6 5.1 11.9 5.1 4.1 0 8.2-1.5 11.3-4.5 6.6-6.3 6.8-16.7.6-23.3zm-226.4-83.1c-32.1 0-62.3-12.5-85-35.2-22.7-22.7-35.2-52.9-35.2-84.9 0-32.1 12.5-62.3 35.2-84.9 22.7-22.7 52.9-35.2 85-35.2s62.3 12.5 85 35.2c22.7 22.7 35.2 52.9 35.2 84.9 0 32.1-12.5 62.3-35.2 84.9-22.7 22.7-52.9 35.2-85 35.2z"></path>
                </svg>
            </button>
            <button type="button" name="cancel" id="search-form-button-close1" aria-label="<?php echo IMAGE_CANCEL;?>" class="">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                    </svg>
                </span>
            </button>
            </form>
        </div>
    </div>
    <!-- search_sm end //-->
    <div class="col-xs-6 logo_block">
        <?php require $template->requireBox('H_LOGO'); ?>
    </div>
    <div class="col-xs-3 pull-right header-actions">
        <!-- SHOPPING CART -->
        <?php require $template->requireBox('H_SHOPPING_CART'); ?>
        <?php echo $cart_output_mobile; ?>
        <!-- END SHOPPING CART -->
        <button type="button" class="btn-mobile_menu">
            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <div class="mobile_menu">
        <?php if ($template->show('H_TOP_MENU_MOBILE')) { ?>
            <div class="block_categories">
                <div class="button-main-cursor">
                    <?= TEXT_HEADING_CATALOG; ?>
                    <span class="down">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                      <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                    </svg>
                </span>
                </div>
                <?php
                // get categories list as accordion:
                function tep_get_category_mobile($cat_tree, $category_str = '', $letBuildTree = false)
                {
                    global $cat_names, $current_category_id, $template;

                    $cPathTmp = isset($_GET['cPath']) ? $_GET['cPath'] : '';
                    $cPath_array = tep_parse_category_path($cPathTmp);

                    if ($cat_tree) {
                        foreach ($cat_tree as $cid => $cname) {
                            if ($cid == $current_category_id) {
                                $clink = '<span class="like_a">' . $cat_names[$cid] . '</span>';
                            } // show link to current category
                            else {
                                $clink = '<a href="' . tep_href_link(
                                    FILENAME_DEFAULT,
                                    'cPath=' . $cid,
                                    'NONSSL'
                                ) . '">' . $cat_names[$cid] . '</a>';
                            } // show link to current category

                            if (
                                $template->getModuleSetting(
                                    'HEADER',
                                    'H_TOP_MENU_MOBILE',
                                    'show_shortcut_mob_tree'
                                ) === "1"
                            ) {
                                if (
                                    is_array($cname) && ((in_array(
                                        $cid,
                                        $cPath_array
                                    )) || $letBuildTree)
                                ) { // if we have subcategories, then recursively execute same function but send them subcategories array from current category
                                    if ($letBuildTree === false) {
                                        $category_str .= '<ul class="mobile_cats" id="cat_accordion">';
                                    }
                                    $category_str .= '<li class="custom_id' . $cid . ' cutom-parent-li">' . $clink . '<span class="down"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg></span>';
                                    $category_str .= '<ul>';
                                    $category_str = tep_get_category_mobile($cname, $category_str, true);
                                    $category_str .= '</ul>';
                                    $category_str .= '</li>';
                                    if ($letBuildTree === false) {
                                        $category_str .= '</ul>';
                                    }
                                } else {
                                    if ($letBuildTree) {
                                        $category_str .= '<li class="custom_id' . $cid . '">' . $clink;
                                    } else {
                                        $category_str .= $clink;
                                    }
                                }
                                $category_str .= '</li>';
                            } else {
                                if (is_array($cname)) {
                                    $category_str .= '<li class="custom_id' . $cid . ' cutom-parent-li">' . $clink . '<span class="down"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg></span>';
                                    $category_str .= '<ul>';
                                    $category_str = tep_get_category_mobile($cname, $category_str);
                                    $category_str .= '</ul>';
                                } else {
                                    $category_str .= '<li class="custom_id' . $cid . '">' . $clink;
                                }
                                $category_str .= '</li>';
                            }
                        }
                        return $category_str;
                    }
                    return false;
                }

                // start functions
                echo '<div class="mob_cats_wrapper accordion">';
                if ($category = tep_get_category_mobile($cat_tree)) {
                    if ($template->getModuleSetting('HEADER', 'H_TOP_MENU_MOBILE', 'show_shortcut_mob_tree') === "1") {
                        echo $category;
                    } else {
                        echo '<ul class="mobile_cats" id="cat_accordion">' . $category . '</ul>';
                    }
                } else {
                    echo '<h3 class="text-center">' . BOX_HEADING_NO_CATEGORY_OF_PRODUCTS . '</h3>';
                }
                echo '</div>';
                ?>
            </div>
        <?php } ?>
        <div class="block_information">
            <div class="button-main-cursor">
                <?= BOX_HEADING_INFORMATION; ?>
                <span class="down">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                    </svg>
                </span>
            </div>
            <ul class="menu_information">
                <?php
                $art_array = getArticles(16, 7);
                if (is_array($art_array)) {
                    foreach ($art_array as $articles) {
                        echo '<li><a href="' . $articles['link'] . '">' . $articles['name'] . '</a></li>';
                    }
                }
                ?>
                <li>
                    <a href="<?php echo tep_href_link(FILENAME_ARTICLES, 'tPath=13'); ?>"
                       class="header-top-link"><?php echo BOX_HEADING_ARTICLES; ?></a>
                </li>
            </ul>
        </div>
        <div class="block_manuf">
            <div class="button-main-cursor">
                <?= BOX_HEADING_MANUFACTURERS ?>
                <span class="down">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                    </svg>
                </span>
            </div>
            <ul class="menu_manuf">
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

        <hr>
        <div class="settings-selector">
            <?php require $template->requireBox('H_LANGUAGES'); ?>
            <?php require $template->requireBox('H_CURRENCIES'); ?>
        </div>
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
        <div class="callback_block">
            <?php require $template->requireBox('H_CALLBACK'); ?>
        </div>
        <hr>
        <div class="phones_block">
            <?php echo renderArticle('phones'); ?>
        </div>
    </div>
</div><!-- END CONTAINER -->
<div class="search-form-fader" id="search-form-fader"></div>
