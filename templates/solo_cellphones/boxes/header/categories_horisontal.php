<?php
$manufacturers_query = tep_db_query(
    "SELECT DISTINCT m.`manufacturers_image`, m.`manufacturers_id`, mi.`manufacturers_name` FROM " . TABLE_MANUFACTURERS . " `m` JOIN " . TABLE_MANUFACTURERS_INFO . " `mi` on m.manufacturers_id = mi.manufacturers_id  WHERE `status` = '1' and mi.languages_id = $languages_id ORDER BY `manufacturers_name`"
);
?>

<div class="header-categories">
    <div class="header-menu">
        <ul class="xs-menu-actions">

            <li><span class="popup_cart">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <ellipse transform="rotate(-1.057 159.995 423.97) scale(.99997)" cx="160" cy="424"
                                             rx="24" ry="24"></ellipse>
                                    <ellipse transform="matrix(.02382 -.9997 .9997 .02382 -48.51 798.282)" cx="384.5"
                                             cy="424" rx="24" ry="24"></ellipse>
                                    <path d="M463.8 132.2c-.7-2.4-2.8-4-5.2-4.2L132.9 96.5c-2.8-.3-6.2-2.1-7.5-4.7-3.8-7.1-6.2-11.1-12.2-18.6-7.7-9.4-22.2-9.1-48.8-9.3-9-.1-16.3 5.2-16.3 14.1 0 8.7 6.9 14.1 15.6 14.1s21.3.5 26 1.9c4.7 1.4 8.5 9.1 9.9 15.8 0 .1 0 .2.1.3.2 1.2 2 10.2 2 10.3l40 211.6c2.4 14.5 7.3 26.5 14.5 35.7 8.4 10.8 19.5 16.2 32.9 16.2h236.6c7.6 0 14.1-5.8 14.4-13.4.4-8-6-14.6-14-14.6H188.9c-2 0-4.9 0-8.3-2.8-3.5-3-8.3-9.9-11.5-26l-4.3-23.7c0-.3.1-.5.4-.6l277.7-47c2.6-.4 4.6-2.5 4.9-5.2l16-115.8c.2-.8.2-1.7 0-2.6z"></path>
                                </svg>
                                <span class="title-name"><?= BUTTON_SHOPPING_CART_OPEN; ?></span>
                                <span class="counter mobile_cart_count"><?= $cart->count_contents() ?></span>
                            </span>
            </li>
            <li>
                <a rel="nofollow" href="<?= tep_href_link('login.php'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M447.8 438.3c-7.2-31.8-48.3-47.3-62.5-52.3-15.6-5.5-37.8-6.8-52.1-10-8.2-1.8-20.1-6.3-24.1-11.1s-1.6-49.3-1.6-49.3 7.4-11.5 11.4-21.7c4-10.1 8.4-37.9 8.4-37.9s8.2 0 11.1-14.4c3.1-15.7 8-21.8 7.4-33.5-.6-11.5-6.9-11.2-6.9-11.2s6.1-16.7 6.8-51.3c.9-41.1-31.3-81.6-89.6-81.6-59.1 0-90.6 40.5-89.7 81.6.8 34.6 6.7 51.3 6.7 51.3s-6.3-.3-6.9 11.2c-.6 11.7 4.3 17.8 7.4 33.5 2.8 14.4 11.1 14.4 11.1 14.4s4.4 27.8 8.4 37.9c4 10.2 11.4 21.7 11.4 21.7s2.4 44.5-1.6 49.3c-4 4.8-15.9 9.3-24.1 11.1-14.3 3.2-36.5 4.5-52.1 10-14.2 5-55.3 20.5-62.5 52.3-1.1 5 2.7 9.7 7.9 9.7H440c5.1 0 8.9-4.7 7.8-9.7z"></path>
                    </svg>
                    <span class="title-name"><?= LOGIN_BOX_MY_CABINET; ?></span>
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
                    <span class="title-name"><?= GO_COMPARE; ?></span> <span
                            class="counter"><?php if (isset($_SESSION['compares']) && is_array($_SESSION['compares'])) {
                                echo count($_SESSION['compares']);
                                            } ?></span>
                </a>
            </li>
            <li>
                <a rel="nofollow" href="<?= tep_href_link('wishlist.php'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M256 448l-30.164-27.211C118.718 322.442 48 258.61 48 179.095 48 114.221 97.918 64 162.4 64c36.399 0 70.717 16.742 93.6 43.947C278.882 80.742 313.199 64 349.6 64 414.082 64 464 114.221 464 179.095c0 79.516-70.719 143.348-177.836 241.694L256 448z"></path>
                    </svg>
                    <span class="title-name"><?= IN_WHISHLIST; ?></span> <span
                            class="counter"><?php if (isset($wishList->wishID) && is_array($wishList->wishID)) {
                                echo count($wishList->wishID);
                                            } ?></span>
                </a>
            </li>
        </ul>

        <div class="xs-search-input">
            <?php echo tep_draw_form(
                'quick_find',
                tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false),
                'get',
                'class="form_search_site"'
            ); ?>
            <input type="search" id="searchpr1" class="search_site_input search-form-input"
                   placeholder="<?php echo BOX_HEADING_SEARCH; ?>" name="keywords"
                   value="<?= stripslashes($_GET['keywords']); ?>">
            <!--            <span class="placeholder">--><?php //echo BOX_HEADING_SEARCH; ?><!--</span>-->
            <button type="submit" class="search-form-button search_site_submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M443.5 420.2L336.7 312.4c20.9-26.2 33.5-59.4 33.5-95.5 0-84.5-68.5-153-153.1-153S64 132.5 64 217s68.5 153 153.1 153c36.6 0 70.1-12.8 96.5-34.2l106.1 107.1c3.2 3.4 7.6 5.1 11.9 5.1 4.1 0 8.2-1.5 11.3-4.5 6.6-6.3 6.8-16.7.6-23.3zm-226.4-83.1c-32.1 0-62.3-12.5-85-35.2-22.7-22.7-35.2-52.9-35.2-84.9 0-32.1 12.5-62.3 35.2-84.9 22.7-22.7 52.9-35.2 85-35.2s62.3 12.5 85 35.2c22.7 22.7 35.2 52.9 35.2 84.9 0 32.1-12.5 62.3-35.2 84.9-22.7 22.7-52.9 35.2-85 35.2z"></path>
                </svg>
            </button>
            </form>
        </div>

        <div class="left-menu-categories">
            <div class="menu-block">
                <a href="/all/c-0.html" class="menu-block-title">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M96 176h80V96H96v80zm120 240h80v-80h-80v80zm-120 0h80v-80H96v80zm0-120h80v-80H96v80zm120 0h80v-80h-80v80zM336 96v80h80V96h-80zm-120 80h80V96h-80v80zm120 120h80v-80h-80v80zm0 120h80v-80h-80v80z"></path>
                    </svg>
                    <div class="name">
                        <span class="title"><?= TEXT_HEADING_CATALOG; ?></span>
                        <sub><?= BOX_INFORMATION_ALLPRODS ?></sub>
                    </div>
                </a>
                <ul>
                    <?php
                    $catProductCounter_ready = countAllCategoryProductsRecursive();
                    // get categories list as accordion:
                    function tep_get_category_tree2($cat_tree, $category_str = '', $level = 0)
                    {
                        global $cat_names, $cat_imgs, $cat_icons, $cat_description, $catProductCounter_ready;

                        if ($cat_tree) {
                            foreach ($cat_tree as $cid => $cname) {
                                $description = '';

                                $image_file_name = (!empty($cat_imgs[$cid]) or !empty($cat_icons[$cid])) ? '<div class="c-icon"><img  src="' . DIR_WS_IMAGES_CDN . 'pixel_trans.png" data-src="getimage/' . SMALL_IMAGE_WIDTH . 'x' . SMALL_IMAGE_HEIGHT . '/categories/' . ($cat_icons[$cid] ?: $cat_imgs[$cid]) . '" alt="' . $cat_names[$cid] . '" title="' . $cat_names[$cid] . '" class="lazyload" /></div>' : '';
                                $caret = (is_array($cname)) ? '<span class="caret"></span>' : '';


                                if ($level == 0) {
                                    // if we do not have subcats inside current category
                                    $category_str .= '<li class="dropdown-submenu">';
                                    $category_str .= '<a href="' . tep_href_link(
                                        FILENAME_DEFAULT,
                                        'cPath=' . $cid,
                                        'NONSSL'
                                    ) . '" class="submenu">
                                                                    ' . $image_file_name . '
                                                                    <span class="cat_name">' . $cat_names[$cid] . '<span class="counter">' . ($catProductCounter_ready[$cid] ?: '') . '</span></span>
                                                                    ' . $description . $caret . '
                                                                </a>'; // link for current category

                                    if (is_array($cname)) {
                                        $category_str .= '<ul class="sub_ul">
                                                                        <div class="xs-title">
                                                                            <button type="button" class="close-btn arrow">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                                    <path d="M427 234.625H167.296l119.702-119.702L256 85 85 256l171 171 29.922-29.924-118.626-119.701H427v-42.75z"></path>
                                                                                </svg>
                                                                            </button>
                                                                            <span>' . 'Go back to parent category' . '</span>
                                                                            <button type="button" class="close-btn">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                                    <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                        <li class="wrapper">
                                                                            <a class="parent_category_image" href="' . tep_href_link(
                                                                                FILENAME_DEFAULT,
                                                                                'cPath=' . $cid,
                                                                                'NONSSL'
                                                                            ) . '">
                                                                            ' . $image_file_name . '
                                                                                <span class="cat_name">' . $cat_names[$cid] . '<sub>' . BOX_INFORMATION_ALLPRODS . '</sub></span>
                                                                                <span class="counter">' . ($catProductCounter_ready[$cid] ?: '') . '</span>
                                                                            </a>';
                                        $category_str = tep_get_category_tree2($cname, $category_str, $level + 1);
                                        $category_str .= '</li></ul>';
                                    }

                                    $category_str .= '</li>';

                                } elseif ($level == 1) {
                                    $parent_cat_name = $cat_names[$cid];

                                    $category_str .= '<div class="sub dropdown-submenu"><a href="' . tep_href_link(
                                        FILENAME_DEFAULT,
                                        'cPath=' . $cid,
                                        'NONSSL'
                                    ) . '" class="">
                                                                    ' . $image_file_name . '
                                                                    <span class="cat_name">' . $cat_names[$cid] . '<span class="counter">' . ($catProductCounter_ready[$cid] ?: '') . '</span></span>
                                                                    ' . $description . $caret . '
                                                                </a>'; // link for current category
                                    if (is_array($cname)) { // if we have subcategories
                                        $category_str .= '<ul class="sub_ul">
                                                                    <div class="xs-title">
                                                                        <button type="button" class="close-btn arrow">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                                <path d="M427 234.625H167.296l119.702-119.702L256 85 85 256l171 171 29.922-29.924-118.626-119.701H427v-42.75z"></path>
                                                                            </svg>
                                                                        </button>
                                                                        <span>' . 'Go back to parent category' . '</span>
                                                                        <button type="button" class="close-btn">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                                <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                    <li class="wrapper">
                                                                        <a class="parent_category_image" href="' . tep_href_link(
                                                                            FILENAME_DEFAULT,
                                                                            'cPath=' . $cid,
                                                                            'NONSSL'
                                                                        ) . '">
                                                                            ' . $image_file_name . '
                                                                            <span class="cat_name">' . $cat_names[$cid] . '<sub>' . BOX_INFORMATION_ALLPRODS . '</sub></span>
                                                                            <span class="counter">' . ($catProductCounter_ready[$cid] ?: '') . '</span>
                                                                        </a>';
                                        $category_str = tep_get_category_tree2($cname, $category_str, $level + 1);
                                        $category_str .= '</li></ul>';
                                    }
                                    $category_str .= '</div>';
                                } elseif ($level == 2) {
                                    $category_str .= '<div class="sub_sub"><a href="' . tep_href_link(
                                        FILENAME_DEFAULT,
                                        'cPath=' . $cid,
                                        'NONSSL'
                                    ) . '" class="">
                                                                    ' . $image_file_name . '
                                                                    <span class="cat_name">' . $cat_names[$cid] . '<span class="counter">' . ($catProductCounter_ready[$cid] ?: '') . '</span></span>
                                                                    ' . $description . '
                                                                </a>'; // link for current category
                                    $category_str .= '</div>';
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
    </div>
</div>


<div class="search-form-fader" id="search-form-fader"></div>
