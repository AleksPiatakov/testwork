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
                                <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M448 192V77.25c0-8.49-3.37-16.62-9.37-22.63L393.37 9.37c-6-6-14.14-9.37-22.63-9.37H96C78.33 0 64 14.33 64 32v160c-35.35 0-64 28.65-64 64v112c0 8.84 7.16 16 16 16h48v96c0 17.67 14.33 32 32 32h320c17.67 0 32-14.33 32-32v-96h48c8.84 0 16-7.16 16-16V256c0-35.35-28.65-64-64-64zm-64 256H128v-96h256v96zm0-224H128V64h192v48c0 8.84 7.16 16 16 16h48v96zm48 72c-13.25 0-24-10.75-24-24 0-13.26 10.75-24 24-24s24 10.74 24 24c0 13.25-10.75 24-24 24z"></path>
                                </svg>
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
$content = ob_get_contents();
ob_end_clean();
?>
<?php $data['content'] = $content; ?>
<?php include_once 'account_template.tpl.php'; ?>
