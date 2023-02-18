<div id="billingAddress">
    <?php
    echo '<h3>' . TABLE_HEADING_BILLING_ADDRESS . '</h3>';
    if (tep_session_is_registered('customer_id')) {
        echo '<hr><a href="address_book.php" class="address_book_btn choose_modal" data-addresstype="billto">' . LOGIN_BOX_ADDRESS_BOOK . '</a><hr>';
    }

    if (tep_session_is_registered('onepage')) {
        $billingAddress = $onepage['billing'];
        $customerAddress = $onepage['customer'];
    }

    echo '<div class="form-group">';
    if (!isMobile()) {
        echo '<label>* ' . ENTRY_FIRST_NAME . tep_draw_input_field(
            'billing_firstname',
            (isset($billingAddress) ? $billingAddress['firstname'] : ''),
            'class="checkout_inputs required form-control" placeholder=""'
        ) . '</label>';
    } else {
        echo tep_draw_input_field(
            'billing_firstname',
            (isset($billingAddress) ? $billingAddress['firstname'] : ''),
            'class="checkout_inputs required form-control" placeholder="* ' . ENTRY_FIRST_NAME . '"'
        );
    }
    echo '</div>';

    if (ACCOUNT_LAST_NAME == 'true') {
        echo '<div class="form-group">';
        if (!isMobile()) {
            echo '<label>* ' . ENTRY_LAST_NAME . tep_draw_input_field(
                'billing_lastname',
                (isset($billingAddress) ? $billingAddress['lastname'] : ''),
                'class="checkout_inputs required form-control" placeholder=""'
            ) . '</label>';
        } else {
            echo tep_draw_input_field(
                'billing_lastname',
                (isset($billingAddress) ? $billingAddress['lastname'] : ''),
                'class="checkout_inputs required form-control" placeholder="* ' . ENTRY_LAST_NAME . '"'
            );
        }
        echo '</div>';
    }

    if (ONEPAGE_ADDRESS_TYPE_POSITION == 'billing_shipping') {
        if (!tep_session_is_registered('customer_id')) {
            echo '<div class="form-group">';
            if (!isMobile()) {
                echo '<label>* ' . ENTRY_EMAIL_ADDRESS . tep_draw_input_field(
                    'billing_email_address',
                    (isset($customerAddress) ? $customerAddress['email_address'] : ''),
                    'class="checkout_inputs required form-control" placeholder=""'
                ) . '</label>';
            } else {
                echo tep_draw_input_field(
                    'billing_email_address',
                    (isset($customerAddress) ? $customerAddress['email_address'] : ''),
                    'class="checkout_inputs required form-control" placeholder="* ' . ENTRY_EMAIL_ADDRESS . '"'
                );
            }
            echo '<span class="form-group" id="email_error" style="color:#DD703E;"></span></div>';
        }
        if (ACCOUNT_TELE == 'true') {
            echo '<div class="form-group">';
            if (!isMobile()) {
                echo '<label>* ' . ENTRY_TELEPHONE . tep_draw_input_field(
                    'billing_telephone',
                    (isset($customerAddress) ? $customerAddress['telephone'] : ''),
                    'class="checkout_inputs required form-control" placeholder=""'
                ) . '</label>';
            } else {
                echo tep_draw_input_field(
                    'billing_telephone',
                    (isset($customerAddress) ? $customerAddress['telephone'] : ''),
                    'class="checkout_inputs required form-control" placeholder="* ' . ENTRY_TELEPHONE . '"'
                );
            }
            echo '</div>';
        }
    }

    if (ACCOUNT_COMPANY == 'true') {
        echo '<div class="form-group shipping_company-block">';
        if (!isMobile()) {
            echo '<label>' . ENTRY_COMPANY . tep_draw_input_field(
                'billing_company',
                (isset($billingAddress) ? $billingAddress['company'] : ''),
                'class="checkout_inputs form-control" placeholder=""'
            ) . '</label>';
        } else {
            echo tep_draw_input_field(
                'billing_company',
                (isset($billingAddress) ? $billingAddress['company'] : ''),
                'class="checkout_inputs form-control" placeholder="* ' . ENTRY_COMPANY . '"'
            );
        }
        echo '</div>';
    }

    if (ACCOUNT_STREET_ADDRESS == 'true') {
        echo '<div class="form-group">';
        if (!isMobile()) {
            echo '<label>* ' . ENTRY_STREET_ADDRESS . tep_draw_input_field(
                'billing_street_address',
                (isset($billingAddress) ? $billingAddress['street_address'] : ''),
                'class="required checkout_inputs form-control" placeholder=""'
            ) . '</label>';
        } else {
            echo tep_draw_input_field(
                'billing_street_address',
                (isset($billingAddress) ? $billingAddress['street_address'] : ''),
                'class="required checkout_inputs form-control" placeholder="* ' . ENTRY_STREET_ADDRESS . '"'
            );
        }
        echo '</div>';
    }

    if (ACCOUNT_CITY == 'true') {
        echo '<div class="form-group">';
        if (!isMobile()) {
            echo '<label>* ' . ENTRY_CITY . tep_draw_input_field(
                'billing_city',
                (isset($billingAddress) ? $billingAddress['city'] : ''),
                'class="checkout_inputs required form-control" placeholder=""'
            ) . '</label>';
        } else {
            echo tep_draw_input_field(
                'billing_city',
                (isset($billingAddress) ? $billingAddress['city'] : ''),
                'class="checkout_inputs required form-control" placeholder="* ' . ENTRY_CITY . '"'
            );
        }
        echo '</div>';
    }

    if (ACCOUNT_STATE == 'true') {
        echo '<div class="form-group select_field">';
        if (!isMobile()) {
            echo '<span>* ' . ENTRY_STATE . '</span>';
        }
        $_GET['zone_field_name'] = 'billing_zone_id';
        $ajaxSelectRegionTrue = true;
        require 'ajax_select_region.php';
        echo '</div>';
    }

    if (ACCOUNT_SUBURB == 'true') {
        echo '<div class="form-group">';
        if (!isMobile()) {
            echo '<label>* ' . ENTRY_SUBURB . tep_draw_input_field(
                'billing_suburb',
                (isset($billingAddress) ? $billingAddress['suburb'] : ''),
                'class="required checkout_inputs form-control" placeholder=""'
            ) . '</label>';
        } else {
            echo tep_draw_input_field(
                'billing_suburb',
                (isset($billingAddress) ? $billingAddress['suburb'] : ''),
                'class="required checkout_inputs form-control" placeholder="* ' . ENTRY_SUBURB . '"'
            );
        }
        echo '</div>';
    }

    if (ACCOUNT_POSTCODE == 'true') {
        echo '<div class="form-group">';
        if (!isMobile()) {
            echo '<label>* ' . ENTRY_POST_CODE . tep_draw_input_field(
                'billing_zipcode',
                (isset($billingAddress) ? $billingAddress['postcode'] : ''),
                'class="checkout_inputs required form-control" placeholder=""'
            ) . '</label>';
        } else {
            echo tep_draw_input_field(
                'billing_zipcode',
                (isset($billingAddress) ? $billingAddress['postcode'] : ''),
                'class="checkout_inputs required form-control" placeholder="* ' . ENTRY_POST_CODE . '"'
            );
        }
        echo '</div>';
    }

    if (ACCOUNT_COUNTRY == 'true') {
        echo '<div class="form-group select_field">';
        if (!isMobile()) {
            echo '<span>* ' . ENTRY_COUNTRY . '</span>';
        }
        echo tep_get_country_list(
            'billing_country',
            (isset($billingAddress) && tep_not_null(
                $billingAddress['country_id']
            ) ? $billingAddress['country_id'] : STORE_COUNTRY),
            'class="checkout_inputs required" data-zone="' . ($billingAddress['zone_id'] ?: STORE_ZONE) . '" placeholder="' . (isMobile() ? '*' . ENTRY_COUNTRY : '') . '"'
        ) . '</div>';
    }
    ?>

</div>
