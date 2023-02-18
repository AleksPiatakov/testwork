<?php
//attributes
if ($optionsArray && is_array($products_stocks_array)) {
    $js_products_stocks_array = json_encode($products_stocks_array);
    //remove condition by attribute option with text type
    foreach ($products_stocks_array as $attributeCombination) {
        $newAttributeCombinationPart = [];
        foreach (explode(',', $attributeCombination) as $attributeCombinationPart) {
            $attributeCombinationPartOptionId = explode(
                '-',
                $attributeCombinationPart
            )[0];
            if (in_array($attributeCombinationPartOptionId, $optionsArray)) {
                $newAttributeCombinationPart[] = $attributeCombinationPart;
            }
        }
        $new_products_stocks_array[] = implode(',', $newAttributeCombinationPart);
    }
    $js_products_stocks_array = json_encode($new_products_stocks_array);
}
if ($js_products_stocks_array) {
    $js_products_stocks_array = ' data-attributestock = \'' . $js_products_stocks_array . '\' ';
}

//vendor code
if (is_array($products_stocks_vendor_code_array) && $new_products_stocks_array) {
    $js_products_stocks_vendor_code_array = json_encode($products_stocks_vendor_code_array);
    $products_stocks_vendor_code_array = $products_stocks_vendor_code_array;
        $i = 0;
    foreach ($products_stocks_vendor_code_array as $attributeCombination => $value) {
        $new_products_stocks_vendor_code_array[$new_products_stocks_array[$i]] = $value;
        $i++;
    }
        $js_products_stocks_vendor_code_array = json_encode($new_products_stocks_vendor_code_array);
}
if ($js_products_stocks_vendor_code_array) {
    $js_products_stocks_vendor_code_array = ' data-attributestockvendorcode = \'' . $js_products_stocks_vendor_code_array . '\' ';
}

//price
if (is_array($products_stocks_price_array) && $new_products_stocks_array) {
    $js_products_stocks_price_array = json_encode($products_stocks_price_array);
    $products_stocks_price_array = $products_stocks_price_array;
        $i = 0;
    foreach ($products_stocks_price_array as $attributeCombination => $value) {
        $new_products_stocks_price_array[$new_products_stocks_array[$i]] = $value;
        $i++;
    }
        $js_products_stocks_price_array = json_encode($new_products_stocks_price_array);
}
if ($js_products_stocks_price_array) {
    $js_products_stocks_price_array = ' data-attributestockprice = \'' . $js_products_stocks_price_array . '\' ';
}
//special price
if(is_array($products_stocks_special_price_array)){
    $js_products_stocks_special_price_array = json_encode($products_stocks_special_price_array);
    if($js_products_stocks_special_price_array) {
        $js_products_stocks_special_price_array = ' data-attributestockspecialprice = \'' . $js_products_stocks_special_price_array . '\' ';
    }
}
?>
<div class="prod_attributes_combination"
    <?php echo $js_products_stocks_array; ?>
    <?php echo $js_products_stocks_vendor_code_array; ?>
    <?php echo $js_products_stocks_price_array; ?>
    <?php echo $js_products_stocks_special_price_array; ?>
></div>
<span class="attribute_combination_text_list"></span>