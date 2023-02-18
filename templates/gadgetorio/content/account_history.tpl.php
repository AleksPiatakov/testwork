<?php ob_start();  //Buffer ?>

<h1><?php echo HEADING_TITLE; ?></h1>

<div class="table-responsive">
    <?php
    $orders_total = tep_count_customer_orders();

    if ($orders_total > 0) {
        $history_query_raw = "select o.orders_id, o.date_purchased, o.delivery_name, o.billing_name, ot.text as order_total, s.orders_status_name from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$customer_id . "' and o.orders_id = ot.orders_id and ot.class = 'ot_total' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and o.orders_status != '99999' order by orders_id DESC";
        $history_split = new splitPageResults($history_query_raw, MAX_DISPLAY_ORDER_HISTORY);
        $history_query = tep_db_query($history_split->sql_query);

        ?>
        <table id="account_history_table" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="active">#</th>
                <th class="active"><?php echo TEXT_ORDER_DATE; ?></th>
                <th class="active text-center"><?php echo TEXT_ORDER_PC; ?></th>
                <th class="active"><?php echo TEXT_ORDER_COST; ?></th>
                <th class="active" colspan="2"><?php echo TEXT_ORDER_STATUS; ?></th>

            </tr>
            </thead>
            <tbody>
            <?php
            while ($history = tep_db_fetch_array($history_query)) {
                $products_query = tep_db_query(
                    "select count(*) as count from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$history['orders_id'] . "'"
                );
                $products = tep_db_fetch_array($products_query);

                if (tep_not_null($history['delivery_name'])) {
                    $order_type = TEXT_ORDER_SHIPPED_TO;
                    $order_name = $history['delivery_name'];
                } else {
                    $order_type = TEXT_ORDER_BILLED_TO;
                    $order_name = $history['billing_name'];
                }
                ?>
                <tr>
                <tr>
                    <td data-title="#"><?php echo $history['orders_id']; ?></td>
                    <td data-title="<?php echo TEXT_ORDER_DATE; ?>"><?php echo tep_date_long(
                            $history['date_purchased']
                        ); ?></td>
                    <td class="text-center"
                        data-title="<?php echo TEXT_ORDER_PC; ?>"><?php echo $products['count']; ?></td>
                    <td data-title="<?php echo TEXT_ORDER_COST; ?>"><?php echo strip_tags(
                            $history['order_total']
                        ); ?></td>
                    <td data-title="<?php echo TEXT_ORDER_STATUS; ?>"><?php echo $history['orders_status_name']; ?></td>
                    <td class="account_history_actions"
                        width="100%"><?php echo '<a class="btn btn-xs btn-danger" href="' . tep_href_link(
                                FILENAME_ACCOUNT_HISTORY_INFO,
                                (isset($HTTP_GET_VARS['page']) ? 'page=' . $HTTP_GET_VARS['page'] . '&' : '') . 'order_id=' . $history['orders_id'],
                                'SSL'
                            ) . '">' . SMALL_IMAGE_BUTTON_VIEW . '</a>'; ?>
                        <a class="btn btn-default popupPrintReceipt" href="<?php echo tep_href_link(
                            FILENAME_PRINT_MY_INVOICE,
                            'order_id=' . $history['orders_id'],
                            'SSL'
                        ); ?>">
                            <i class="fa fa-print" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            <?php } // end while ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="alert alert-info"><?php echo TEXT_NO_PURCHASES; ?></p>
    <?php } ?>
</div>

<?php if ($orders_total > 0) { ?>
    <div class="row pagerss">
        <div class="col-md-6 text-left"><?php echo $history_split->display_count(
                TEXT_DISPLAY_NUMBER_OF_ORDERS
            ); ?></div>
        <div class="col-md-6 text-right pull-right">
            <div class="pull-right">
                <?php echo $history_split->display_links(
                    MAX_DISPLAY_PAGE_LINKS,
                    tep_get_all_get_params(array('page', 'info', 'x', 'y'))
                ); ?>
            </div>
            <div class="pull-right"><?php echo TEXT_RESULT_PAGE; ?></div>
        </div>
    </div>

<?php } ?>


<?php
$data['content'] = ob_get_contents();
ob_end_clean();
?>
<?php //$data['content'] = $content; ?>
<?php include_once 'account_template.tpl.php'; ?>
