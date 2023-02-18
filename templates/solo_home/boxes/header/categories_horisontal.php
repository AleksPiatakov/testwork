<?php function tep_get_category_tree_home($cat_tree, $category_str = '', $level = 0, $id = 0, $parent_id = 0)
{
    global $cat_names, $languages_id;

    if ($cat_tree) {
        $j = 0;
        $cat_column = (int)ceil(count($cat_tree) / 2);
        $last = end($cat_tree);

        foreach ($cat_tree as $cid => $cname) {
            if ($level == 1 && $j == 0) {
                $category_str .= '<ul class="sub1">';
            }

            $j++;
            $clink = '<a href="' . tep_href_link(
                FILENAME_DEFAULT,
                'cPath=' . $cid,
                'NONSSL'
            ) . '">' . $cat_names[$cid] . '</a>'; // show link to current category
            if (
                is_array(
                    $cname
                ) && $level < 2
            ) { // if we have subcategories, then recursively execute same function but send them subcategories array from current category
                $li_class = $level ? "sub{$level}_list" : 'sub_list';
                $div_class = $level ? "sub1_sub-wrapper collapse" : 'wrapper_list';

                $ul_class = $level ? "sub1_sub" : 'sub1';
//                $ul_r_div = $level ? "ul" : 'div';

                $category_str .= '<li class="' . $li_class . '">' . $clink;
                switch ($level) {
                    case 0:
                        $sub_menu_id = 'wrapper_list_' . $id;
                        break;
                    case 1:
                        $sub_menu_id = 'sub1_sub_wrapper_' . $id;
                        break;
                }
                $sub_menu_id .= 'wrapper_list_' . $id;
                $category_str .= '<a href="#' . $sub_menu_id . '" class="wrapper_list-collapse collapsed down" data-toggle="collapse" aria-expanded="false" aria-controls="' . $sub_menu_id . '">
<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"><path fill="currentColor" d="M17.525 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L205.947 256 10.454 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L34.495 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg>                                 </a>';
                $category_str .= '<div class="' . $div_class . '" id="' . $sub_menu_id . '">';
                if ($level) {
                    $category_str .= '<ul class="' . $ul_class . '">';
                }
                $category_str = tep_get_category_tree_home($cname, $category_str, $level + 1, $id + 1, $cid);
                if ($level) {
                    $category_str .= '</ul>';
                }


                $category_str .= '</div>';
            } else {
                $category_str .= '<li>' . $clink;
            }
            $category_str .= '</li>';
            $id++;
            if ($level == 1 && ($j === $cat_column || $last == $cname)) {
                $j = 0;
                $category_str .= '</ul>';
            }
        }


        return $category_str;
    }
    return false;
}

function get_cid_list_recursivly($input, &$output = [])
{
    foreach ($input as $cid) {
        if (is_array($cid)) {
            get_cid_list_recursivly($cid, $output);
        } else {
            $output[] = $cid;
        }
    }
    return $output;
}

?>
<?php $conf = isset($template->settings['HEADER']['H_TOP_MENU']['infobox_data'])
    ? unserialize($template->settings['HEADER']['H_TOP_MENU']['infobox_data'])['toggle_mobile_visible']['val']
    : false; ?>
<div class="add_navbar">
    <div class="container new_nav-wrapper">
        <div class="row">
            <div class="col-xs-2 search-form-tooltip hidden-md hidden-lg">
                <div id="show_search_form" class="show_search_form" data-toggle="tooltip" data-placement="auto bottom"
                     title="<?php echo BOX_OPEN_SEARCH_FORM; ?>">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"></path>
                    </svg>
                </div>
            </div>
            <div class="col-xs-12 search-block hidden-md hidden-lg">
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
                    <button type="submit" id="search-form-button1" class="search_site_submit">
                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"></path>
                        </svg>
                    </button>
                    <button type="button" id="search-form-button-close1" class="">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"></path>
                                </svg>
                            </span>
                    </button>
                    </form>
                </div>
            </div>
            <div class="col-xs-7 col-sm-8 logo_block hidden-md hidden-lg">
                <?php require $template->requireBox('H_LOGO'); ?>
            </div>
            <div class="col-xs-3 col-sm-2 pull-right header-actions hidden-md hidden-lg">
                <!-- SHOPPING CART -->
                <?php require $template->requireBox('H_SHOPPING_CART'); ?>
                <div class="basket_block">
                    <?php echo $cart_output_mobile; ?>
                </div>
                <!-- END SHOPPING CART -->
                <button type="button" class="btn-mobile_menu">
                    <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
            </div>
        </div>
        <nav class="new_nav mobile_menu">
            <?php if (($conf == false and isMobile()) or $conf == true) { ?>
                <div class="new_nav-item block_categories">
                    <a href="#block_categories-collapse" class="button-main-cursor collapsed" data-toggle="collapse"
                       aria-expanded="false" aria-controls="block_categories-collapse">
                        <span class="button-title"><?= TEXT_HEADING_CATALOG; ?></span> <span class="down">
                            <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                            </svg>
                        </span>
                    </a>
                    <div class="wrapper_main_list container collapse" id="block_categories-collapse">
                        <ul class="main_list">
                            <?= tep_get_category_tree_home($cat_tree); ?>
                        </ul>
                    </div>
                    <div class="overlay"></div>
                </div>
            <?php } ?>
            <div class="new_nav-item block_information">
                <a href="#block_information-collapse" class="button-main-cursor visible-xs collapsed"
                   data-toggle="collapse" aria-expanded="false" aria-controls="block_information-collapse">
                    <span class="button-title"><?= BOX_HEADING_INFORMATION; ?></span> <span class="down">
                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                        </svg>
                    </span>
                </a>
                <ul class="menu_information collapse" id="block_information-collapse">
                    <?php require $template->requireBox('H_TOP_LINKS', $config); ?>
                    <li>
                        <a href="<?php echo tep_href_link(FILENAME_ARTICLES, 'tPath=13'); ?>"
                           class="header-top-link"><?php echo BOX_HEADING_ARTICLES; ?></a>
                    </li>
                </ul>
            </div>
            <div class="new_nav-item block_manuf visible-xs visible-sm">
                <a href="#block_manuf-collapse" class="button-main-cursor visible-xs collapsed" data-toggle="collapse"
                   aria-expanded="false" aria-controls="block_manuf-collapse">
                    <span class="button-title"><?= BOX_HEADING_MANUFACTURERS; ?></span> <span class="down">
                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                            <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                        </svg>
                    </span>
                </a>
                <ul class="menu_manuf collapse" id="block_manuf-collapse">
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
                                                                ' . substr(
                                    $mvals['name'],
                                    0,
                                    MAX_DISPLAY_MANUFACTURER_NAME_LEN
                                ) . ' 
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
            <div class="new_nav-item settings-selector visible-xs visible-sm">
                <?php require $template->requireBox('H_LANGUAGES'); ?>
                <?php require $template->requireBox('H_CURRENCIES'); ?>
            </div>
            <div class="new_nav-item wish_list-block visible-xs visible-sm">
                <?php if (isMobile()) {
                    require $template->requireBox('H_WISHLIST');
                } ?>
            </div>
            <div class="new_nav-item login_block visible-xs visible-sm">
                <a rel="nofollow" href="<?= tep_href_link('login.php'); ?>">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"
                              class=""></path>
                    </svg><?= LOGIN_BOX_MY_CABINET; ?>
                </a>
            </div>
            <div class="new_nav-item callback_block visible-xs visible-sm">
                <?php require $template->requireBox('H_CALLBACK'); ?>
            </div>
            <div class="new_nav-item phones_block visible-xs visible-sm">
                <?php echo renderArticle('phones'); ?>
            </div>
        </nav>
    </div>
    <!-- ANIMATED BACKGROUND ELEMENT -->

</div>
<div class="splash"></div>
<div class="search-form-fader" id="search-form-fader"></div>
