<?php

/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 07.06.2019
 * Time: 13:45
 */

global $order_id, $productsId;

$order_id = (int)$order_id;
$productsId = (int)$productsId;

if (!empty($order_id)) {
    //set $order
    if (!class_exists('order')) {
        include(DIR_WS_CLASSES . 'order.php');
    }
    $order = new order($order_id);

    //collect $trans
    $trans = [
        'id' => $order_id,
        'affiliation' => getConstantValue('STORE_NAME', ''),
        'revenue' => 0,
        'shipping' => 0,
        'tax' => 0,
        'currency' => $order->info['currency'],
    ];

    $sql = "SELECT class, value
            FROM " . TABLE_ORDERS_TOTAL . "
            WHERE orders_id = " . (int)$order_id;
    $query = tep_db_query($sql);
    while ($row = tep_db_fetch_array($query)) {
        switch ($row['class']) {
            case 'ot_total':
                $trans['revenue'] = $row['value'];
                break;
            case 'ot_tax':
                $trans['tax'] = $row['value'];
                break;
            case 'ot_shipping':
                $trans['shipping'] = $row['value'];
                break;
            default:
                break;
        }
    }
    //collect $trans END

    $productsArray = $order->products;
} elseif (!empty($productsId)) {
    global $currency, $languages_id;

    //collect $productsData
    $query = tep_db_query("SELECT *
                FROM " . TABLE_PRODUCTS . " p
                LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd on pd.products_id = p.products_id and pd.language_id = " . $languages_id . "
                WHERE p.products_id = " . $productsId);
    $productsData = tep_db_fetch_array($query);
    $taxRate = tep_get_tax_rate_list($productsData['products_tax_class_id']);
    $tax = tep_calculate_tax($productsData['products_price'], $taxRate);
    $finalPrice = tep_add_tax($productsData['products_price'], $taxRate);
    //collect $productsData END

    //collect $productsArray
    $productsArray[] = [
            'qty' => 1,
            'id' => $productsId,
            'name' => $productsData['products_name'],
            'model' => $productsData['products_model'],
            'tax' => $tax,
            'price' => $productsData['products_price'],
            'final_price' => $finalPrice
    ];
    //collect $productsArray END

    //collect $trans
    $newId = tep_db_fetch_array(tep_db_query("SELECT max(quick_orders_id)+1 as new_id FROM " . TABLE_QUICK_ORDERS))['new_id'];
    $trans = [
        'id' => 'fast_buy_' . $newId,
        'affiliation' => getConstantValue('STORE_NAME', ''),
        'revenue' => $finalPrice,
        'shipping' => 0,
        'tax' => $tax,
        'currency' => $currency,
    ];
    //collect $trans END
}

if (!empty($order_id) || !empty($productsId)) {
    //ge functions
    //collect prodToCat
    function GEprodToCat($prodArray)
    {
        $sql = "SELECT p2c.`categories_id`, p2c.`products_id`
                FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " `p2c`
                LEFT JOIN " . TABLE_PRODUCTS . " `p` ON `p`.`products_id` = `p2c`.`products_id`
                WHERE `p`.`products_id` in (" . implode(',', $prodArray) . ")
                ORDER BY p2c.categories_id desc";
        $query = tep_db_query($sql);

        $prodToCat = [];
        if (tep_db_num_rows($query)) {
            while ($item = tep_db_fetch_array($query)) {
                $prodToCat[$item['products_id']] = $item['categories_id'];
            }
        }
        return $prodToCat;
    }

    //get JavaScript representation of a TransactionData object.(gtag)
    function GEgetTransactionJsNEW(&$trans)
    {
        return <<<HTML
gtag('event', 'purchase', {transaction_id: '{$trans['id']}', value: {$trans['revenue']}});
HTML;
    }

    //get JavaScript representation of a TransactionData object.(ge)
    function GEgetTransactionJs(&$trans)
    {
        return <<<HTML
ge('ecommerce:addTransaction', {
      'id': '{$trans['id']}',
      'affiliation': '{$trans['affiliation']}',
      'revenue': '{$trans['revenue']}',
      'shipping': '{$trans['shipping']}',
      'tax': '{$trans['tax']}'
    });
HTML;
    }

    //get JavaScript representation of an ItemData object.
    function GEgetItemJs(&$trans, &$item)
    {
        global $prodToCat, $cat_names;
        return <<<HTML
ge('ecommerce:addItem', {
      'id': '{$trans['id']}',
      'name': '{$item['name']}',
      'sku': '{$item['model']}',
      'category': '{$cat_names[$prodToCat[$item['id']]]}',
      'price': '{$item['final_price']}',
      'quantity': '{$item['qty']}',
      'currency': '{$trans['currency']}'
    });
HTML;
    }
    //ge functions END

    //collect prodToCat
    $prodArray = array_map(function ($arr) {
        return (int)$arr['id'];
    }, $productsArray);
    $prodToCat = GEprodToCat($prodArray);
    //collect prodToCat END

    ?>
    <script>
        //send data of order
        function drawEcommerce() {
            //gtag('event', 'purchase', {transaction_id ...})
            <?php echo GEgetTransactionJsNEW($trans); ?>

            ge('require', 'ecommerce');

            //ge('ecommerce:addTransaction', ...)
            <?php echo GEgetTransactionJs($trans); ?>

            <?php foreach ($productsArray as &$products) {
                //ge('ecommerce:addItem', ...)
                echo GEgetItemJs($trans, $products);
            } ?>

            ge('ecommerce:send');
        }
    </script>
    <?php
}
