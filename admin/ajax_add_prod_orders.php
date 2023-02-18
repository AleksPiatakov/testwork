<?php

require_once('includes/application_top.php');

if ($_GET['action'] == 'show') {
    $search = tep_db_prepare_input($_GET['ord_prod']);
    $sql = "SELECT DISTINCT
          `p`.`products_id` as `id`, 
          `p`.`products_model` as `model`,
          `pd`.`products_name` as `label`,
          `p2c`.`categories_id` as `category_id`
        FROM " . TABLE_PRODUCTS . " `p`
        left join " . TABLE_PRODUCTS_DESCRIPTION . " `pd` on pd.products_id=p.products_id
        left join " . TABLE_PRODUCTS_TO_CATEGORIES . " `p2c` on p2c.products_id=p.products_id
        WHERE `pd`.`products_name` LIKE '%{$search}%' OR `p`.`products_model` LIKE '%{$search}%' and  `pd`.`language_id` = " . (int) $_SESSION['languages_id'] . " limit 20";

    $sql = tep_db_query($sql);
    while ($row = tep_db_fetch_array($sql)) {
        $result[] = $row;
    }
    echo json_encode($result);
    exit;

}

