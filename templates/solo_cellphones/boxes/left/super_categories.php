<?php

echo '<input type="hidden" name="current_hidden_cat_id" value="' . $current_category_id . '" />';

// show categories list as accordion
function tep_get_category_tree($cat_tree, $category_str = '')
{
    global $cat_names, $current_category_id;
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
                is_array(
                    $cname
                )
            ) { // if we have subcategories, then recursively execute same function but send them subcategories array from current category
                $category_str .= '<li class="custom_id' . $cid . ' cutom-parent-li">' . $clink .
                    '<span class="down">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M256 294.1L383 167c9.4-9.4 24.6-9.4 33.9 0s9.3 24.6 0 34L273 345c-9.1 9.1-23.7 9.3-33.1.7L95 201.1c-4.7-4.7-7-10.9-7-17s2.3-12.3 7-17c9.4-9.4 24.6-9.4 33.9 0l127.1 127z"></path>
                                        </svg>
                                    </span>';
                $category_str .= '<ul>';
                $category_str = tep_get_category_tree($cname, $category_str);
                $category_str .= '</ul>';
            } else {
                $category_str .= '<li class="custom_id' . $cid . '">' . $clink;
            }
            $category_str .= '</li>';
        }
        return $category_str;
    }
    return false;
}

// start functions
echo '<div class="box-category accordion"><ul id="cat_accordion">';
echo '<li class="sidebar-box-title">' . TEXT_HEADING_CATALOG . '</li>';
if ($category = tep_get_category_tree($cat_tree)) {
    echo $category;
} else {
    echo '<h3 class="text-center">' . BOX_HEADING_NO_CATEGORY_OF_PRODUCTS . '</h3>';
}
echo '</ul></div>';
