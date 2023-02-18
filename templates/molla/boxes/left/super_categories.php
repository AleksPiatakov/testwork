<?php

// show categories through just ONE DB query
// by raid 25.04.16

// get current category:
echo '<input type="hidden" name="current_hidden_cat_id" value="' . $current_category_id . '" />';

// show categories list as accordion
function tep_get_category_tree($cat_tree, $category_str = '', $letBuildTree = false)
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

            if ($template->getModuleSetting('LEFT', 'L_SUPER', 'show_shortcut_mob_tree') == "1") {
                if (
                    is_array($cname) && ((in_array(
                        $cid,
                        $cPath_array
                    )) || $letBuildTree)
                ) { // if we have subcategories, then recursively execute same function but send them subcategories array from current category
                    if ($letBuildTree === false) {
                        $category_str .= '<ul id="cat_accordion">';
                    }
                    $category_str .= '<li class="custom_id' . $cid . ' cutom-parent-li">' . $clink . '<span class="down"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg></span>';
                    $category_str .= '<ul>';
                    $category_str = tep_get_category_tree($cname, $category_str, true);
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
                    $category_str = tep_get_category_tree($cname, $category_str);
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
if (!isMobile() || (isMobile() && !$template->show('H_TOP_MENU_MOBILE'))) {
    echo '<div class="box-category accordion">';
    if ($category = tep_get_category_tree($cat_tree)) {
        if ($template->getModuleSetting('LEFT', 'L_SUPER', 'show_shortcut_mob_tree') == "1") {
            echo $category;
        } else {
            echo '<ul id="cat_accordion">' . $category . '</ul>';
        }
    } else {
        echo '<h3 class="text-center">' . BOX_HEADING_NO_CATEGORY_OF_PRODUCTS . '</h3>';
    }
    echo '</div>';
}
