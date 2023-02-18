<?php
require('includes/application_top.php');


$sql = "SELECT 
          `ps`.`products_stock_attributes`,
          `ps`.`products_vendor_code`,
          `ps`.`products_combination_price`
        FROM " . TABLE_PRODUCTS_STOCK . " `ps`
        WHERE `ps`.`products_id` = " . $_POST['product_id'] .
    " order by `ps`.`products_vendor_code`";

$sql = tep_db_query($sql);
while ($row = tep_db_fetch_array($sql)) {
    $result[$row['products_stock_attributes']] = [
        'vendor_code' => $row['products_vendor_code'],
        'price' => $row['products_combination_price']
    ];
}

echo json_encode($result);
exit;