<?php ob_start();  //Buffer ?>
<?php $messageStack->render('addressbook'); ?>
<?php
$addresses_query = tep_db_query(
    "select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' order by firstname, lastname"
);
?>
<div id="address_book" class="clearfix">
    <p><?php echo ADDRESS_BOOK_TITLE; ?></p>

    <?php
    // While
    while ($addresses = tep_db_fetch_array($addresses_query)) {
        $format_id = tep_get_address_format_id($addresses['country_id']); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                    <span class="firstname_lastname"><?php echo tep_output_string_protected(stripslashes($addresses['firstname'] . ' ' . $addresses['lastname'])); ?></span>
                <?php
                if ($addresses['address_book_id'] == $customer_default_address_id) {
                    echo '<span class="label label-primary">' . PRIMARY_ADDRESS . '</span>';
                }
                ?>
                <div class="btn-group pull-right">
                    <?php echo '<a class="btn btn-group btn-danger btn-xs" href="' . tep_href_link(
                            FILENAME_ADDRESS_BOOK_PROCESS,
                            'delete=' . $addresses['address_book_id'],
                            'SSL'
                        ) . '"><span class="glyphicon glyphicon-remove"></span></a>
          <a class="btn btn-group btn-info btn-xs" href="' . tep_href_link(
                            FILENAME_ADDRESS_BOOK_PROCESS,
                            'edit=' . $addresses['address_book_id'],
                            'SSL'
                        ) . '"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;'; ?>
                </div>
            </div>
            <div class="panel-body">
                <?php echo stripslashes(tep_address_format($format_id, $addresses, true, ' ', '<br>')); ?>
            </div>
        </div>


    <?php } //end while ?>

    <div class="clearfix">
        <?php echo '<a class="btn btn-default btn-xs" href="' . tep_href_link(
                FILENAME_ACCOUNT,
                '',
                'SSL'
            ) . '">' . IMAGE_BUTTON_BACK . '</a>'; ?>
        <?php if (tep_count_customer_address_book_entries() < MAX_ADDRESS_BOOK_ENTRIES) { ?>
            <span class="right">
                <?php echo '<a class="btn btn-danger btn-xs" href="' . tep_href_link(
                        FILENAME_ADDRESS_BOOK_PROCESS,
                        '',
                        'SSL'
                    ) . '">' . IMAGE_BUTTON_ADD_ADDRESS . '</a>'; ?>
        </span>
        <?php } ?>
    </div>
    <br>
    <div class="clearfix"><?php echo sprintf(TEXT_MAXIMUM_ENTRIES, MAX_ADDRESS_BOOK_ENTRIES); ?></div>
</div>

<?php
$data['content'] = ob_get_contents();
ob_end_clean();
?>
<?php //$data['content'] = $content; ?>
<?php include_once 'account_template.tpl.php'; ?>
