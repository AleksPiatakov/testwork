<div id="billingAddress">
    <?php
    echo '<h3>' . TABLE_HEADING_BILLING_ADDRESS . '</h3>';
    if (tep_session_is_registered('customer_id')) {
        echo '<a href="address_book.php" class="btn btn-default choose_modal" data-addresstype="billto">' . LOGIN_BOX_ADDRESS_BOOK . '</a>';
    }
    ?>
    <?php
    /*   if (tep_session_is_registered('customer_id') && ONEPAGE_CHECKOUT_SHOW_ADDRESS_INPUT_FIELDS == 'False') {
           echo tep_address_label($customer_id, $billto, true, ' ', '<br>');

           $address_query = tep_db_query("select entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$billto . "'");
           $address = tep_db_fetch_array($address_query);

           echo '<input type="hidden" name="billing_firstname" value="' . $address['firstname'] . '" />';
           echo '<input type="hidden" name="billing_lastname" value="' . $address['lastname'] . '" />';
           echo '<input type="hidden" name="billing_country" value="' . $address['country_id'] . '" />';
           echo '<input type="hidden" name="billing_city" value="' . $address['city'] . '" />';
           echo '<input type="hidden" name="billing_street_address" value="' . $address['street_address'] . '" />';

       } else {   */
    if (tep_session_is_registered('onepage')) {
        $billingAddress = $onepage['billing'];
        $customerAddress = $onepage['customer'];
    }

    echo '<div class="form-group">' . tep_draw_input_field(
        'billing_firstname',
        (isset($billingAddress) ? $billingAddress['firstname'] : ''),
        'class="checkout_inputs required form-control" placeholder="' . ENTRY_FIRST_NAME . '"'
    ) . '</div>';

    if (ACCOUNT_LAST_NAME == 'true') {
        echo '<div class="form-group">' . tep_draw_input_field(
            'billing_lastname',
            (isset($billingAddress) ? $billingAddress['lastname'] : ''),
            'class="checkout_inputs required form-control" placeholder="' . ENTRY_LAST_NAME . '"'
        ) . '</div>';
    }

    if (ONEPAGE_ADDRESS_TYPE_POSITION == 'billing_shipping') {
        if (!tep_session_is_registered('customer_id')) {
            echo '<div class="form-group">' . tep_draw_input_field(
                'billing_email_address',
                (isset($customerAddress) ? $customerAddress['email_address'] : ''),
                'class="checkout_inputs required form-control" placeholder="' . ENTRY_EMAIL_ADDRESS . '"'
            ) .
                '<span class="form-group" id="email_error" style="color:#DD703E;"></span></div>';
        }

        if (ACCOUNT_TELE == 'true') {
            echo '<div class="form-group">' . tep_draw_input_field(
                'billing_telephone',
                (isset($customerAddress) ? $customerAddress['telephone'] : ''),
                'class="checkout_inputs required form-control" placeholder="' . ENTRY_TELEPHONE . '"'
            ) . '</div>';
        }
    }

    if (ACCOUNT_COMPANY == 'true') {
        echo '<div class="form-group shipping_company-block">' . tep_draw_input_field(
            'billing_company',
            (isset($billingAddress) ? $billingAddress['company'] : ''),
            'class="checkout_inputs form-control" placeholder="' . ENTRY_COMPANY . '"'
        ) . '</div>';
    }


    if (ACCOUNT_STREET_ADDRESS == 'true') {
        echo '<div class="form-group">' . tep_draw_input_field(
            'billing_street_address',
            (isset($billingAddress) ? $billingAddress['street_address'] : ''),
            'class="required checkout_inputs form-control" placeholder="' . ENTRY_STREET_ADDRESS . '"'
        ) . '</div>';
    }

    if (ACCOUNT_CITY == 'true') {
        echo '<div class="form-group">' . tep_draw_input_field(
            'billing_city',
            (isset($billingAddress) ? $billingAddress['city'] : ''),
            'class="checkout_inputs required form-control" placeholder="' . ENTRY_CITY . '"'
        ) . '</div>';
    }

    if (ACCOUNT_STATE == 'true') {
        echo '<div class="form-group select_field"><span class="billing_zone_select"></span></div>';
    }

    if (ACCOUNT_SUBURB == 'true') {
        echo '<div class="form-group">' . tep_draw_input_field(
            'billing_suburb',
            (isset($billingAddress) ? $billingAddress['suburb'] : ''),
            'class="required checkout_inputs form-control" placeholder="' . ENTRY_SUBURB . '"'
        ) . '</div>';
    }

    if (ACCOUNT_POSTCODE == 'true') {
        echo '<div class="form-group">' . tep_draw_input_field(
            'billing_zipcode',
            (isset($billingAddress) ? $billingAddress['postcode'] : ''),
            'class="checkout_inputs required form-control" placeholder="' . ENTRY_POST_CODE . '"'
        ) . '</div>';
    }

    if (ACCOUNT_COUNTRY == 'true') {
        echo '<div class="form-group">' . tep_get_country_list(
            'billing_country',
            (isset($billingAddress) && tep_not_null(
                $billingAddress['country_id']
            ) ? $billingAddress['country_id'] : STORE_COUNTRY),
            'class="checkout_inputs required" data-zone="' . ($billingAddress['zone_id'] ?: STORE_ZONE) . '" placeholder="' . ENTRY_COUNTRY . '"'
        ) . '</div>';
    }

    //  }

    ?>

</div>
