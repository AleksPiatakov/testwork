<?php ob_start();  //Buffer ?>
<?php $messageStack->render('addressbook'); ?>
<?php
$addresses_query = tep_db_query(
    "select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' order by firstname, lastname"
);
?>
<div id="address_book" class="clearfix">
    <!-- <h1><?php /*echo PRIMARY_ADDRESS_TITLE; */ ?></h1>
    <div class="panel panel-success">
      <div class="panel-heading"><?php /*echo PRIMARY_ADDRESS_DESCRIPTION; */ ?></div>
      <div class="panel-body">
        <?php /*echo tep_address_label($customer_id, $customer_default_address_id, true, ' ', '<br>'); */ ?>
      </div>
    </div>-->

    <h1><?php echo ADDRESS_BOOK_TITLE; ?></h1>

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
                    ) . '">
                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z"></path></svg>
                      </a>
                      <a class="btn btn-group btn-info btn-xs" href="' . tep_href_link(
                        FILENAME_ADDRESS_BOOK_PROCESS,
                        'edit=' . $addresses['address_book_id'],
                        'SSL'
                    ) . '">
                        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path></svg>
                      </a>&nbsp;'; ?>
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
