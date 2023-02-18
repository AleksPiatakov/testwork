<?php
if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    require('includes/application_top.php');
    includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT);

    ?>

    <a href="<?= tep_href_link('address_book.php'); ?>" class="btn btn-warning"><?php echo ADDRESS_BOOK; ?></a>
    <div class="clear"></div><br/>
    <?php
    $addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' order by firstname, lastname");
    while ($addresses = tep_db_fetch_array($addresses_query)) {
        $format_id = tep_get_address_format_id($addresses['country_id']);

        if ($addresses['address_book_id'] == $_SESSION['sendto']) {
            $checked = 'checked';
            $ab_checked = 'ab_checked';
        } else {
            $checked = '';
            $ab_checked = '';
        }

        echo '<div class="text-left addresses_block ' . $ab_checked . '">
                <input type="radio" name="' . $_POST['addresstype'] . '" value="' . $addresses['address_book_id'] . '" id="' . $addresses['address_book_id'] . '" ' . $checked . '> 
                <label for="' . $addresses['address_book_id'] . '"><b>' . tep_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']) . '</b><br />' .
            tep_address_format($format_id, $addresses, true, ' ', '<br>') . '</label>
              </div>';
    }

    ?>

    <div class="row">
        <div class="col-sm-12 ull-right text-right">
            <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo BUTTON_CANCEL; ?></button>
            <span class="btn btn-default confirmbuton p" id="confirm_change_address"><?php echo TEXT_CHANGE_ADDRESS; ?></span>
        </div>
    </div>

<?php } ?>
