<div id="shippingAddress">
    <?php
    global $geoplugin, $onepage;
    echo '<h3>' . TABLE_HEADING_SHIPPING_ADDRESS . '</h3>';
    if (tep_session_is_registered('customer_id')) {
        echo '<a href="' . tep_href_link(
            'address_book.php'
        ) . '" class="btn btn-default choose_modal" data-addresstype="sendto">' .
            LOGIN_BOX_ADDRESS_BOOK .
            '</a><hr>';
    }

    if (tep_session_is_registered('onepage')) {
        $shippingAddress = $onepage['delivery'];
        $customerAddress = $onepage['customer'];
        $fName = !empty($shippingAddress['firstname']) ? $shippingAddress['firstname'] : $customerAddress['firstname'];
        $lName = !empty($shippingAddress['lastname']) ? $shippingAddress['lastname'] : $customerAddress['lastname'];
    }

    if (!tep_session_is_registered('customer_id') && !isset($_SESSION['updated_country'])) {
        $country_sql = "SELECT `countries_id` FROM " .
            TABLE_COUNTRIES . " WHERE `countries_iso_code_2` = '" . $geoplugin->countryCode . "'";
        $country_query = tep_db_query($country_sql);
        $country_id = tep_db_fetch_array($country_query);
        if (tep_not_null($country_id)) {
            $shippingAddress['country_id'] = $country_id['countries_id'];
        }
        $_SESSION['updated_country'] = true;
    } else {
        $fName = $fName ?: $_SESSION['customer_first_name'];
        $lName = $lName ?: $_SESSION['customer_last_name'];
        $shippingAddress['country_id'] = $shippingAddress['country_id'] ?: $_SESSION['customer_country_id'];
        $shippingAddress['zone_id'] = $shippingAddress['zone_id'] ?: $_SESSION['customer_zone_id'];
    }

    echo '<div class="form-group">';
    if (!isMobile()) {
        echo '<label>* ' . ENTRY_FIRST_NAME .
            tep_draw_input_field(
                'shipping_firstname',
                $fName,
                'class="checkout_inputs required form-control" placeholder=""'
            ) . '</label>';
    } else {
        echo tep_draw_input_field(
            'shipping_firstname',
            $fName,
            'class="checkout_inputs required form-control" placeholder="*' . ENTRY_FIRST_NAME . '"'
        );
    }
    echo '</div>';

    if (ACCOUNT_LAST_NAME == 'true') {
        echo '<div class="form-group">';
        if (!isMobile()) {
            echo '<label>* ' . ENTRY_LAST_NAME .
                tep_draw_input_field(
                    'shipping_lastname',
                    $lName,
                    'class="checkout_inputs required form-control" placeholder=""'
                ) . '</label>';
        } else {
            echo tep_draw_input_field(
                'shipping_lastname',
                $lName,
                'class="checkout_inputs required form-control" placeholder="* ' . ENTRY_LAST_NAME . '"'
            );
        }
        echo '</div>';
    }

    if (ONEPAGE_ADDRESS_TYPE_POSITION == 'shipping_billing') {
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
            'shipping_company',
            (isset($shippingAddress) ? $shippingAddress['company'] : ''),
            'class="checkout_inputs form-control" placeholder="' . ENTRY_COMPANY . '"'
        ) . '</div>';
    }

    if (ACCOUNT_STREET_ADDRESS == 'true') {
        echo '<div class="form-group">' . tep_draw_input_field(
            'shipping_street_address',
            (isset($shippingAddress) ? $shippingAddress['street_address'] : ''),
            'class="required checkout_inputs form-control" placeholder="' . ENTRY_STREET_ADDRESS . '"'
        ) . '</div>';
    } else {
        //echo '<div class="form-group hidden">' . tep_draw_hidden_field('shipping_street_address', (isset($shippingAddress) ? $shippingAddress['street_address'] : ''), 'class="required checkout_inputs form-control" placeholder="' . ENTRY_STREET_ADDRESS . '"') . '</div>';
    }

    if (ACCOUNT_CITY == 'true') {
        echo '<div class="form-group">' . tep_draw_input_field(
            'shipping_city',
            (isset($shippingAddress) ? $shippingAddress['city'] : ''),
            'class="checkout_inputs required form-control" placeholder="' . ENTRY_CITY . '"'
        ) . '</div>';
    } else {
        //echo '<div class="form-group hidden">' . tep_draw_hidden_field('shipping_city', (isset($shippingAddress) ? $shippingAddress['city'] : ''), 'class="checkout_inputs required form-control" placeholder="' . ENTRY_CITY . '"') . '</div>';
    }

    if (ACCOUNT_STATE == 'true') {
        echo '<div class="form-group select_field "><span class="shipping_zone_select"></span></div>';
    }

    if (ACCOUNT_SUBURB == 'true') {
        echo '<div class="form-group">' . tep_draw_input_field(
            'shipping_suburb',
            (isset($shippingAddress) ? $shippingAddress['suburb'] : ''),
            'class="required checkout_inputs form-control" placeholder="' . ENTRY_SUBURB . '"'
        ) . '</div>';
    }

    if (ACCOUNT_POSTCODE == 'true') {
        echo '<div class="form-group">' . tep_draw_input_field(
            'shipping_zipcode',
            (isset($shippingAddress) ? $shippingAddress['postcode'] : ''),
            'class="checkout_inputs required form-control" placeholder="' . ENTRY_POST_CODE . '"'
        ) . '</div>';
    }

    if (ACCOUNT_COUNTRY == 'true') {
        echo '<div class="form-group">' . tep_get_country_list(
            'shipping_country',
            (isset($shippingAddress) && tep_not_null(
                $shippingAddress['country_id']
            ) ? $shippingAddress['country_id'] : STORE_COUNTRY),
            'class="checkout_inputs required" data-zone="' . ($shippingAddress['zone_id'] ?: STORE_ZONE) . '" placeholder="' . ENTRY_COUNTRY . '" '
        ) . '</div>';
    }

    if (!tep_session_is_registered('customer_id')) {
        echo '<div class="form-group" style="display:none">
            ' . tep_draw_password_field(
            'password',
            rand(10000, 99999),
            'autocomplete="off" ' . (ONEPAGE_ACCOUNT_CREATE == 'required' ? 'class="checkout_inputs required form-control" maxlength="40" ' : 'maxlength="40" ') . 'id="bg_register_pass"'
        ) . '
            ' . tep_draw_password_field(
            'confirmation',
            '',
            'autocomplete="off" ' . (ONEPAGE_ACCOUNT_CREATE == 'required' ? 'class="checkout_inputs required form-control" ' : '') . 'maxlength="40" id="bg_register_pass2" style="width:140px;"'
        ) . '
            <div id="pstrength_password"></div>
          </div>';
    }
    ?>
</div>
