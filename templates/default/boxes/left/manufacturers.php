<?php

/*
  $Id: manufacturers.php,v 1.1.1.1 2003/09/18 19:05:50 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2001 osCommerce

  Released under the GNU General Public License
*/
if (!empty($manufacturers_array) && is_array($manufacturers_array)) {
    echo '<div class="like_h2">' . BOX_HEADING_MANUFACTURERS . '</div>';

if (is_array($manufacturers_array) && count($manufacturers_array) <= MAX_DISPLAY_MANUFACTURERS_IN_A_LIST) {
// Display a list
        $manufacturers_list = '';

        foreach ($manufacturers_array as $mid => $mvals) {
            ($mid == $_GET['manufacturers_id'] ? ($marker_class = 'manuf_bg_current') : ($marker_class = 'manuf_bg'));
            $manufacturers_list .= '<div class="' . $marker_class . '">
                                <a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $mid, 'NONSSL') . '">
                                  ' . mb_substr($mvals['name'], 0, MAX_DISPLAY_MANUFACTURER_NAME_LEN) . '</a>
                              </div>';
        }

        $select_box = $manufacturers_list;
    } else {
// Display a drop-down
        $select_box = '<select name="manufacturers_id" onChange="this.form.submit();" size="' . MAX_MANUFACTURERS_LIST . '" style="width: 160px;padding:0px;margin:0px;">';
        if (MAX_MANUFACTURERS_LIST < 2) {
            $select_box .= '<option value="">' . PULL_DOWN_DEFAULT . '</option>';
        }

        foreach ($manufacturers_array as $mid => $mvals) {
            ($mid == $_GET['manufacturers_id'] ? ($marker_class = 'SELECTED') : ($marker_class = ''));
            $select_box .= '<option ' . $marker_class . ' value="' . $mid . '">' . substr(
                    $mvals['name'],
                    0,
                    MAX_DISPLAY_MANUFACTURER_NAME_LEN
                ) . '</option>';
        }

        $select_box .= "</select>";
    }

    echo '<form name="manufacturers" method="get" action="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false) . '">
          ' . csrf() . $select_box . '
        </form>';
}
