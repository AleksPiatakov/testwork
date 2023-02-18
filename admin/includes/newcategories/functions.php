<?php
/**
 * Categories functions - new categories on solomono. Exclusively on Solomono Market: https://solomono.net
 * @encoding           UTF-8
 * @version            1.0.0
 * @copyright          Copyright (C) 2016 - 2021 Solomono (https://solomono.net). All rights reserved.
 * @license            Solomono Standard Licenses
 * @author             Bokov Oleksandr
 * @support            admin@solomono.net
 */

/**
 * @param int $tPath
 * @param array $tree
 * @return false|string
 */
function makeCategory ($tPath, $tree) {
    ob_start();
    getTreeOption($tree, '', $tPath);
    $categories = ob_get_clean();

    return $categories;
}

/**
 * @param array $arr
 * @param array $prodAmountByCatId
 * @return string
 */
function getTree($arr, $prodAmountByCatId)
{
    static $show;

    foreach ($arr as $key => $value) {
        $amountStr = '';

        if (!empty($prodAmountByCatId[$value['id']])) {
            $amountStr = ' (' . $prodAmountByCatId[$value['id']] . ') ';
        }

        $show .= '
        <li data-category="' . $value['id'] . '">
            <span class="settings_cat">
                <svg width="16px" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <g class="fa-group">
                        <path fill="rgba(73, 80, 86, 0.3)" d="M487.75 315.6l-42.6-24.6a192.62 192.62 0 0 0 0-70.2l42.6-24.6a12.11 12.11 0 0 0 5.5-14 249.2 249.2 0 0 0-54.7-94.6 12 12 0 0 0-14.8-2.3l-42.6 24.6a188.83 188.83 0 0 0-60.8-35.1V25.7A12 12 0 0 0 311 14a251.43 251.43 0 0 0-109.2 0 12 12 0 0 0-9.4 11.7v49.2a194.59 194.59 0 0 0-60.8 35.1L89.05 85.4a11.88 11.88 0 0 0-14.8 2.3 247.66 247.66 0 0 0-54.7 94.6 12 12 0 0 0 5.5 14l42.6 24.6a192.62 192.62 0 0 0 0 70.2l-42.6 24.6a12.08 12.08 0 0 0-5.5 14 249 249 0 0 0 54.7 94.6 12 12 0 0 0 14.8 2.3l42.6-24.6a188.54 188.54 0 0 0 60.8 35.1v49.2a12 12 0 0 0 9.4 11.7 251.43 251.43 0 0 0 109.2 0 12 12 0 0 0 9.4-11.7v-49.2a194.7 194.7 0 0 0 60.8-35.1l42.6 24.6a11.89 11.89 0 0 0 14.8-2.3 247.52 247.52 0 0 0 54.7-94.6 12.36 12.36 0 0 0-5.6-14.1zm-231.4 36.2a95.9 95.9 0 1 1 95.9-95.9 95.89 95.89 0 0 1-95.9 95.9z" class="fa-secondary"></path>
                        <path fill="currentColor" d="M256.35 319.8a63.9 63.9 0 1 1 63.9-63.9 63.9 63.9 0 0 1-63.9 63.9z" class="fa-primary"></path>
                    </g>
                </svg>
            </span>
            <span data-count="' . $prodAmountByCatId[$value['id']] . '" class="item">
                <a href="' . $_SERVER['PHP_SELF'] . '?tPath=' . $value['id'] . '">
                <span class="category_ttl">'
                    . $value['categories_name'] . $amountStr .
                '</span>';

        if (isset($value['childs'])) {
            $show .= '
                <i class="openSubcatRow fa fa-caret-right" aria-hidden="true"></i>
                <span class="badge">
                    <i class="fa fa-folder fa-fw" aria-hidden="true"></i>'
                . count($value['childs']) .
                '</span></a></span>';
            $show .= '<ul>';
            getTree($value['childs'], $prodAmountByCatId);
            $show .= '</ul>';

        } else {
            $show .= '</a></span>';
        }

        $show.='</li>';
    }

    return $show;
}

/**
 * @param array $arr
 * @param string $str
 * @param int|bool $find
 */
function getTreeOption($arr, $str = '', $find = false)
{
    foreach ($arr as $key => $value) {
        if ($value['parent'] != 0) {
            echo '<option value="' . $value['id'] . '">' . $value['categories_name'] . '</option>';
        } else {
            $select = $find == $value['id'] ? 'selected' : '';
            echo '<option ' . $select . ' value="' . $value['id'] . '">' . $str . ' ' . $value['categories_name'] . '</option>';
        }

        if (isset($value['childs'])) {
            $i = 1;
            for ($j = 0; $j < $i; $j++) {
                $str .= '→';
            }

            $i++;
            echo getTreeOption($value['childs'], $str, $find);
            $str = '';
        }
    }
}

function tep_get_newcategories_tree(
    $catId = 0,
    $cat_list = [],
    $categoriesName = [],
    $include_itself = true
) {
    $categories_tree = [];
    if ($include_itself) {
        $categories_tree[] = ['id' => $catId, 'text' => $categoriesName[$catId]['text']];
    }

    if (is_array($cat_list[$catId])) {
        foreach ($cat_list[$catId] as $catId) {
            $categories_tree[] = ['id' => $catId, 'text' => $categoriesName[$catId]['text']];
        }
    }

    return $categories_tree;
}
