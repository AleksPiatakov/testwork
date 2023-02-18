<?php

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_POST['action']) && in_array($_POST['action'], ['getOrderTotalsData','setTransactionId'])) {
    chdir('../../');
    $rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
    require $rootPath . '/includes/application_top.php';
    if (isset($_POST['action']) && $_POST['action'] === 'getOrderTotalsData') {
        require(DIR_WS_CLASSES . 'order.php');
        $order = new order();
        $next_order_id = tep_db_fetch_array(tep_db_query('select max(orders_id)+1 as max from orders'))['max'];
        $onepage = $_SESSION['onepage'];
        $title = $_SESSION['PAYLIKE_TITLE'] ?: STORE_NAME;
        $products = [];
        foreach ($order->products as $product) {
            $products[] = [
                    'ID' => $product['id'],
                    'name' => $product['name'],
                    'quantity' => $product['qty']
            ];
        }
        $outputData = [
            'store_name' => $title,
            'currency' => $order->info['currency'],
            'amount' => (float)number_format($order->info['total'] * $order->info['currency_value'], 2, '.', '') * 100,
            'locale' => $current_lang,
            'custom' => [
                'email' => $onepage['customer']['email_address'],
                'order_id' => $next_order_id,
                'products' => $products,
                'customer' => [
                        'name' => $onepage['customer']['firstname'],
                        'email' => $onepage['customer']['email_address'],
                        'phoneNo' => $onepage['customer']['telephone'],
                        'address' => $onepage['customer']['country']['iso_code2'] . ' ' . $onepage['customer']['city'] . ' ' . $onepage['customer']['street_address'],
                        'IP' => $_SERVER['REMOTE_ADDR']
                ],
                'platform' => ['name' => 'osCommerce','version' => '2.2'],
                'ecommerce' => ['name' => 'Solomono','version' => '2.0'],
                'paylikePluginVersion' => '0.2',
                ],
            ];
        echo json_encode($outputData);
        die;
    }
    if (isset($_POST['action']) && $_POST['action'] === 'setTransactionId' && isset($_POST['id']) && $_POST['id']) {
        $_SESSION['paylikeId'] = $_POST['id'];
        die(json_encode(['err' => false]));
    } else {
        die(json_encode(['err' => true]));
    }
}
?>
<script>
    setTimeout(function () {
        var paylike = Paylike('<?=$GLOBALS['paylike']->key?>');
        if (jQuery('#payLikeCheckout').length === 0) {
            jQuery('#checkoutButton').clone().attr('id', 'payLikeCheckout').insertAfter('#checkoutButton');
            jQuery('#checkoutButton').addClass('hidden');
        }

        jQuery('#paymentMethods .paymentRow').click(function(){
            jQuery('#payLikeCheckout').remove();
            jQuery('#checkoutButton').removeClass('hidden');
        })
    }, 100);
</script>