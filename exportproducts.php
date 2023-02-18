<?php

// export products for 1C , Solomono, 03.08.17

define('DELIM', ';');
define('PRICES', '10');

require('includes/application_top.php');

$prices = '';
for ($pr = 2; $pr <= PRICES; $pr++) {
    $prices_headers .= '"price ' . $pr . '"' . DELIM;
    $prices .= ', p.products_price_' . $pr . ' ';
}

$csv = '';

$csv .= '"id"' . DELIM;
$csv .= '"model"' . DELIM;
$csv .= '"name"' . DELIM;
$csv .= '"images"' . DELIM;
$csv .= '"stock"' . DELIM;
$csv .= '"price 1"' . DELIM;
$csv .= $prices_headers;

$csv .= "\n";

// query to get prices:
$products_query = tep_db_query("select p.products_id, p.products_model, pd.products_name, p.products_images, p.products_quantity, p.products_price $prices 
                                    from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                                   where p.products_status = '1' 
                                     and p.products_id = p2c.products_id 
                                     and pd.products_id = p2c.products_id 
                                     and pd.language_id = " . (int)$languages_id);

while ($products = tep_db_fetch_array($products_query)) {
    $csv .= '"' . $products['products_id'] . '"' . DELIM;
    $csv .= '"' . $products['products_model'] . '"' . DELIM;
    $csv .= '"' . $products['products_name'] . '"' . DELIM;
    $csv .= '"' . $products['products_images'] . '"' . DELIM;
    $csv .= '"' . $products['products_quantity'] . '"' . DELIM;
    $csv .= '"' . $products['products_price'] . '"' . DELIM;

    for ($pr = 2; $pr <= PRICES; $pr++) {
        $csv .= '"' . ($products['products_price_' . $pr] ?: $products['products_price']) . '"' . DELIM;
    }

    $csv .= "\n";
}

// print to *.csv:

header("Content-Type: application/force-download\n");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
header("Content-Disposition: attachment; filename=products_out_" . date("Ymd") . ".csv");

print iconv('utf-8', 'cp1251', $csv);
exit;
