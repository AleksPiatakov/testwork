<?php

require('includes/application_top.php');

includeLanguages(DIR_WS_LANGUAGES . $language . "/" . FILENAME_MANUFACTURERS);

$breadcrumb->add(CONTENT_MANUFACTURERS_TITLE);

$content = CONTENT_MANUFACTURERS;

if ($_SERVER['REQUEST_URI'] == $add_folder . '/' . $_GET['language'] . '/' . $content . '.php') {
    tep_redirect('/' . $_GET['language'] . $add_folder . '/brands');
} elseif ($_SERVER['REQUEST_URI'] == $add_folder . '/' . $content . '.php') {
    tep_redirect($add_folder . '/brands');
}

$manufacturers_query = tep_db_query("select distinct m.manufacturers_id, mi.manufacturers_name 
                                     from " . TABLE_MANUFACTURERS . " m 
                                     join " . TABLE_MANUFACTURERS_INFO . " mi on mi.manufacturers_id = m.manufacturers_id 
                                     where status = '1' and mi.languages_id = " . (int)$languages_id . " order by manufacturers_name");
$manufacturers_arr = [];
while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
    $manufacturers_arr[] = $manufacturers;
}

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
