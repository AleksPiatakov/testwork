<?php

die;
require('includes/application_top.php');

//$cat_tabs_sql = "INSERT INTO `infobox_configuration` (`template_id`, `infobox_file_name`, `infobox_define`, `display_in_column`)
//                 VALUES ('31', 'categories_tabs.php', 'M_CATEGORIES_TABS', 'MAINPAGE');";
//"ALTER TABLE `infobox_configuration`
// CHANGE COLUMN `display_in_column` `display_in_column` ENUM('GENERAL','MAINPAGE','LEFT','OTHER','FOOTER','HEADER','MAINCONF') NOT NULL AFTER `infobox_display`;";
$check_qq = tep_db_fetch_array(tep_db_query("SELECT * FROM infobox_configuration LIMIT 1"));
if (!array_key_exists('infobox_data', $check_qq)) {
    tep_db_query(' ALTER TABLE `infobox_configuration`
                    ADD COLUMN `infobox_data` TEXT NULL DEFAULT NULL AFTER `location`');
}
$sql = tep_db_query("SELECT template_id as id ,template_name as name FROM template");
$templates = [];
while ($row = tep_db_fetch_array($sql)) {
    $templates[$row['id']] = $row['name'];
}
foreach ($templates as $id => $name) {
    $filename = false;
    if (file_exists(DIR_FS_CATALOG . 'templates/' . $name . '/boxes/configuration.php')) {
        $filename = DIR_FS_CATALOG . 'templates/' . $name . '/boxes/configuration.php';
        echo "<p style='color:red;font-weight: bold;'>Start import $name conf file</p>";
    } elseif (file_exists(DIR_FS_CATALOG . 'templates/default/boxes/configuration.php')) {
        echo "<p style='color:red;font-weight: bold;'>Start import default conf file for $name</p>";

        $filename = DIR_FS_CATALOG . 'templates/default/boxes/configuration.php';
    }
    if ($filename) {
        $infobox_array = require($filename);
        updateInfoboxData($infobox_array, $id, $name);
    } else {
        echo "<p style='color:red;font-weight: bold;'>Template $name havent conf file</p>";
    }
}
echo 'done';
function updateInfoboxData($infobox_array, $template_id, $template_name)
{
//    $tbl_name = $template_name == 'default' ? 'demo_demo' : 'demo_'.$template_name;
//    tep_db_query('use information_schema');

//    $field_check_sql = tep_db_query("
//        SELECT *
//        FROM information_schema.COLUMNS
//        WHERE
//            TABLE_SCHEMA = '$tbl_name'
//        AND TABLE_NAME = 'infobox_configuration'
//        AND COLUMN_NAME = 'infobox_data'");
//    tep_db_query('use '.$tbl_name);
//    if (!$field_check_sql->num_rows) {

//    }
    foreach ($infobox_array as $box_name => $arr) {
        $display_in_column = str_replace('_modules', '', $box_name);

        foreach ($arr as $infobox_define => $infobox_data) {
            $temp_q = tep_db_query('SELECT * FROM `infobox_configuration` WHERE `infobox_define` = \'' . $infobox_define . '\'
                                    AND `display_in_column` = \'' . $display_in_column . '\'
                                    AND `template_id` = \'' . $template_id . '\'');
            if ($display_in_column == 'MAINCONF' && !$temp_q->num_rows) {
                    $sql = 'INSERT INTO `infobox_configuration` (template_id, infobox_define, infobox_data, display_in_column) VALUES (\'' . $template_id . '\',\'' . $infobox_define . '\',\'' . serialize($infobox_data) . '\',\'' . $display_in_column . '\')';
            } else {
                $sql = 'UPDATE `infobox_configuration`
                                    SET  `infobox_data` = \'' . serialize($infobox_data) . '\'
                                    WHERE `infobox_define` = \'' . $infobox_define . '\'
                                    AND `display_in_column` = \'' . $display_in_column . '\'
                                    AND `template_id` = \'' . $template_id . '\'';
            }
            echo $sql;
            echo nl2br(PHP_EOL);
            echo '--------';
            echo nl2br(PHP_EOL);
            tep_db_query($sql);
        }
    }
}
