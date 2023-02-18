<?php

echo '<p>' . BOX_HEADING_MANUFACTURERS . '</p>';

$manufacturers_query = tep_db_query(
    "SELECT DISTINCT m.`manufacturers_image`, m.`manufacturers_id`, mi.`manufacturers_name` FROM " . TABLE_MANUFACTURERS . " `m` JOIN " . TABLE_MANUFACTURERS_INFO . " `mi` on m.manufacturers_id = mi.manufacturers_id  WHERE `status` = '1' and mi.languages_id = $languages_id ORDER BY `manufacturers_name`"
);

if (tep_db_num_rows($manufacturers_query) <= MAX_DISPLAY_MANUFACTURERS_IN_A_LIST) {
// Display a list
    $manufacturers_list = '';
    ($_GET['manufacturers_id'] == '' ? ($marker_class = 'manuf_bg_current') : ($marker_class = 'manuf_bg'));
    $manufacturers_list .= '<div class="' . $marker_class . '">
                                <a href="index.php">
                                  ' . FILTER_ALL . '</a>
                              </div>';
    while ($manufacturers_values = tep_db_fetch_array($manufacturers_query)) {
        ($manufacturers_values['manufacturers_id'] == $_GET['manufacturers_id'] ? ($marker_class = 'manuf_bg_current') : ($marker_class = 'manuf_bg'));
        $manufacturers_list .= '<div class="' . $marker_class . '">
                                <a href="' . tep_href_link(
            FILENAME_DEFAULT,
            'manufacturers_id=' . $manufacturers_values['manufacturers_id'],
            'NONSSL'
        ) . '">
                                  ' . substr(
            $manufacturers_values['manufacturers_name'],
            0,
            MAX_DISPLAY_MANUFACTURER_NAME_LEN
        ) . '</a>
                              </div>';
    }

    $select_box = $manufacturers_list;
} else {
// Display a drop-down
    $select_box = '<select name="manufacturers_id" onChange="this.form.submit();" size="' . MAX_MANUFACTURERS_LIST . '" style="width: 160px;padding:0px;margin:0px;">';
    if (MAX_MANUFACTURERS_LIST < 2) {
        $select_box .= '<option value="">' . PULL_DOWN_DEFAULT . '</option>';
    }
    while ($manufacturers_values = tep_db_fetch_array($manufacturers_query)) {
        $select_box .= '<option value="' . $manufacturers_values['manufacturers_id'] . '"';
        if ($_GET['manufacturers_id'] == $manufacturers_values['manufacturers_id']) {
            $select_box .= ' SELECTED';
        }
        $select_box .= '>' . substr(
            $manufacturers_values['manufacturers_name'],
            0,
            MAX_DISPLAY_MANUFACTURER_NAME_LEN
        ) . '</option>';
    }
    $select_box .= "</select>";
    $select_box .= tep_hide_session_id();
}

echo '<form name="manufacturers" method="get" action="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false) . '">
          ' . csrf() . $select_box . '
        </form>';
