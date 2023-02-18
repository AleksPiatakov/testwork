<?php

// show categories through just ONE DB query
// by raid 25.04.16

// get current category:
echo '<input type="hidden" name="current_hidden_cat_id" value="' . $current_category_id . '" />';
// show categories list as accordion
function tep_get_category_tree($cat_tree, $category_str = '')
{
    global $cat_names, $current_category_id;


    if ($cat_tree) {
        foreach ($cat_tree as $cid => $cname) {
            $counter = countCategoryProductsRecursive($cname, 0);
            $counter = ($counter == 0 ? '' : '<span class="counter">' . $counter . '</span>');

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
                $category_str .= '<li class="custom_id' . $cid . ' custom-parent-li">' . $clink . $counter . '<span class="caret"></span>';
                $category_str .= '<ul>';
                $category_str = tep_get_category_tree($cname, $category_str);
                $category_str .= '</ul>';
            } else {
                $category_str .= '<li class="custom_id' . $cid . '">' . $clink . $counter;
            }
            $category_str .= '</li>';
        }
        return $category_str;
    }
    return false;
}

// start functions
echo '<div class="box-category accordion">
        <div class="title_section_block">
            <div class="title_section">' . DEMO2_LEFT_CAT_TITLE . '</div>
            <a class="link_whole_list" href="' . tep_href_link(
                FILENAME_DEFAULT,
                'cPath=0',
                'NONSSL'
            ) . '">' . DEMO2_LEFT_ALL_GOODS . '</a>
        </div>
        <ul id="left_cat_accordion">';
if ($category = tep_get_category_tree($cat_tree)) {
    echo $category;
} else {
    echo '<div class="h5 text-center">' . BOX_HEADING_NO_CATEGORY_OF_PRODUCTS . '</div>';
}
echo '</ul></div>';
