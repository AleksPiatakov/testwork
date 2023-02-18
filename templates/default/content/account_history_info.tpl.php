<?php ob_start();  //Buffer ?>
<h1 class="category_heading"><?php echo sprintf(HEADING_ORDER_NUMBER, $_GET['order_id']); ?></h1>

<div id="account_order_info">
    <div class="row order_header">
        <div class="col-sm-5">
            <strong><?php echo HEADING_ORDER_DATE . tep_date_long($order->info['date_purchased']); ?></strong></div>
        <div class="col-sm-7"><strong><?php echo HEADING_ORDER_TOTAL . $order->info['total']; ?></strong></div>
    </div>
    <div class="row order_body">
        <div class="col-sm-5">

            <?php if ($order->delivery != false) : ?>
                <h2><?php echo HEADING_DELIVERY_ADDRESS; ?></h2>
                <?php
                if ($order->delivery["shipping_method_code"] === "nwposhtanew") {
                    echo $order->delivery["nwposhta_address"];
                } else {
                    echo tep_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br>');
                }
                ?>
                <?php if (tep_not_null($order->info['shipping_method'])): ?>
                    <h2><?php echo HEADING_SHIPPING_METHOD; ?></h2>
                    <?php //echo $order->info['shipping_method']; ?>

                    <?php
                    foreach ($order->totals as $total) {
                        echo '<div class="row account_delivery_method">' . "\n" .
                            '<div class="col-sm-8 col-xs-6">' . $total['title'] . '</div>' . "\n" .
                            '<div class="col-sm-4 col-xs-6">' . $total['text'] . '</div>' . "\n" .
                            '</div>' . "\n";
                    }
                    ?>
                <?php endif; ?>

            <?php endif; ?>
            <h2><?php echo HEADING_PAYMENT_METHOD; ?></h2>
            <?php echo $order->info['payment_method']; ?>
        </div>
        <div class="col-sm-7">
            <?php if (sizeof($order->info['tax_groups']) > 1): ?>
                <h2><?php echo HEADING_PRODUCTS; ?></h2>
                <?php echo HEADING_TAX; ?>
                <?php echo HEADING_TOTAL; ?>
            <?php else: ?>
                <h2><?php echo HEADING_PRODUCTS; ?></h2>
            <?php endif; ?>
            <div class="row account_product">
                <?php foreach ($order->products as $product) : ?>
                    <div class="<?php echo (sizeof(
                            $order->info['tax_groups']) > 1) ? 'col-sm-6' : 'col-sm-9 col-xs-6'; ?>">

                        <span class="qty"><?php echo $product['qty']; ?> x </span>
                        <?php echo $product['name']; ?>
                        <?php if (isset($product['attributes']) && $product['attributes'] > 0): ?>
                            <!-- GET ATTRIBUTES -->
                            <ul class="attributes">
                                <?php
                                foreach ($product['attributes'] as $key => $attribute) {
                                    echo '<li>' . $attribute['option'] . ':' . $attribute['value'] . '</li>';
                                }
                                ?>
                            </ul>
                            <!-- /GET ATTRIBUTES -->
                        <?php endif; ?>
                        <?php
                        if ($order->info['downloads_flag'] == 1) {
                            $allow_download = true;
                        }
                        ?>
                        <?php if ($product_info['is_download_product'] = tep_is_download_product($product['id'])) {
                            $product_downloads = tep_get_products_downloads($product['id'], $_GET['order_id']);
                            if (!empty($product_downloads)) {
                                include(DIR_WS_MODULES . 'product_downloads.php');
                            }
                        } ?>
                    </div>
                    <?php if (sizeof($order->info['tax_groups']) > 1): ?>
                        <div class="col-sm-3 col-xs-3">
                            <?php echo tep_display_tax_value($product['tax']) . '%'; ?>
                        </div>
                    <?php endif; ?>
                    <div class="col-sm-3 <?php echo (sizeof(
                            $order->info['tax_groups']) > 1) ? 'col-xs-3' : 'col-xs-6'; ?>">
                        <strong><?php echo $currencies->format(
                                tep_add_tax(
                                    $product['final_price'],
                                    $product['tax']) * $product['qty'],
                                true,
                                $order->info['currency'],
                                $order->info['currency_value']); ?></strong>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<br/>
<h2 align="center"><?php echo HEADING_ORDER_HISTORY; ?></h2>
<div class="table-responsive">
    <table id="account_history_table" class="table table-striped table-bordered" width="100%" border="0">
        <thead>
        <th class="active"><?php echo HEADING_ORDER_DATE; ?></th>
        <th class="active"><?php echo TABLE_HEADING_STATUS; ?></th>
        <th class="active"><?php echo TABLE_HEADING_COMMENTS; ?></th>
        </thead>
        <tbody>
        <?php
        $orders_history_query = tep_db_query(
            "SELECT os.orders_status_name, osh.orders_status_id, osh.date_added, osh.customer_notified, osh.comments FROM " . TABLE_ORDERS_STATUS_HISTORY . " osh left join " . TABLE_ORDERS_STATUS . " os on
          osh.orders_status_id=os.orders_status_id
          where osh.orders_id = '" . $_GET['order_id'] . "'
          and os.language_id = '" . (int)$languages_id . "'
          order by osh.date_added");

        if (tep_db_num_rows($orders_history_query)) {
            while ($orders_history = tep_db_fetch_array($orders_history_query)) {
                echo '<tr>' .
                    '<td data-title="' . HEADING_ORDER_DATE . '">' . $orders_history['date_added'] . '</td>' .
                    '<td data-title="' . TABLE_HEADING_STATUS . '">' . $orders_history['orders_status_name'] . '</td>' .
                    '<td data-title="' . TABLE_HEADING_COMMENTS . '">' . $orders_history['comments'] . '</td>' .
                    '</tr>';
            }
        } else {
            echo '<tr>' .
                '<td class="info" colspan="3">' . TEXT_NO_ORDER_HISTORY . '</td>' .
                '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<?php
$data['content'] = ob_get_contents();
ob_end_clean();
?>
<?php //$data['content'] = $content; ?>
<?php include_once 'account_template.tpl.php'; ?>
