<?php

$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
chdir('../../');
require_once $rootPath . '/includes/application_top.php';
$find = $_GET['term'];
$languages_id = $_GET['lang'];
if ($_GET['t'] == 'p') {
    $sql = tep_db_query(
        "SELECT pd.`products_id`,pd.`products_name`, p.`products_model`, p.`products_price` FROM `products_description` pd
             LEFT JOIN `products` p on p.`products_id`= pd.`products_id`
             WHERE (pd.`products_name` LIKE '%{$find}%' or  p.`products_model` LIKE '%{$find}%') AND pd.language_id = '{$languages_id}'  limit 10"
    );
} else {
    $sql = tep_db_query(
        "SELECT categories_id as products_id, categories_id as products_model, categories_name as products_name, 0 as products_price
            FROM " . TABLE_CATEGORIES_DESCRIPTION . " WHERE (categories_id LIKE  '%$find%' OR categories_name LIKE '%$find%') and language_id = $languages_id "
    );
}
$return = [];
while ($r = tep_db_fetch_array($sql)) {
    $return[] = $r;
}
die(json_encode($return));
