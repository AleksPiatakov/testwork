<div id="shippingAddress">
    <?php
    global $geoplugin, $onepage;

    if (tep_session_is_registered('customer_id')) {
        echo '<a href="' . tep_href_link(
            'address_book.php'
        ) . '" class="address_book_btn choose_modal" data-addresstype="sendto">' .
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

    if (ACCOUNT_FIRST_NAME == 'true') {
        echo '<div class="form-group">';
    if (!isMobile()) {
        if ($result_required['ACCOUNT_FIRST_NAME'] == 'true') {
            echo '<label>* ' . ENTRY_FIRST_NAME .
                tep_draw_input_field(
                    'shipping_firstname',
                    $fName,
                    'class="checkout_inputs required form-control" placeholder=""'
                ) . '</label>';
        } else {
            echo '<label>' . ENTRY_FIRST_NAME .
                tep_draw_input_field(
                    'shipping_firstname',
                    $fName,
                    'class="checkout_inputs form-control" placeholder=""'
                ) . '</label>';
        }
    } else if ($result_required['ACCOUNT_FIRST_NAME'] == 'true') {
        echo tep_draw_input_field(
            'shipping_firstname',
            $fName,
            'class="checkout_inputs required form-control" placeholder="*' . ENTRY_FIRST_NAME . '"'
        );
        } else {
            echo tep_draw_input_field(
                'shipping_firstname',
                $fName,
                'class="checkout_inputs form-control" placeholder="' . ENTRY_FIRST_NAME . '"'
            );
        }
    echo '</div>';
    }

    if (ACCOUNT_LAST_NAME == 'true') {
        echo '<div class="form-group">';
        if (!isMobile()) {
            if ($result_required['ACCOUNT_LAST_NAME'] == 'true') {
                echo '<label>* ' . ENTRY_LAST_NAME .
                    tep_draw_input_field(
                        'shipping_lastname',
                        $lName,
                        'class="checkout_inputs required form-control" placeholder=""'
                    ) . '</label>';
            } else {
                echo '<label> ' . ENTRY_LAST_NAME .
                    tep_draw_input_field(
                        'shipping_lastname',
                        $lName,
                        'class="checkout_inputs form-control" placeholder=""'
                    ) . '</label>';
            }
        } else if ($result_required['ACCOUNT_LAST_NAME'] == 'true') {
            echo tep_draw_input_field(
                'shipping_lastname',
                $lName,
                'class="checkout_inputs required form-control" placeholder="* ' . ENTRY_LAST_NAME . '"'
            );
            } else {
            echo tep_draw_input_field(
                'shipping_lastname',
                $lName,
                'class="checkout_inputs form-control" placeholder=" ' . ENTRY_LAST_NAME . '"'
            );
            }
        echo '</div>';
    }

    if (ACCOUNT_COMPANY == 'true') {
        echo '<div class="form-group shipping_company-block">';
        if (!isMobile()) {
            if($result_required['ACCOUNT_COMPANY'] == 'true') {
                echo '<label>*' . ENTRY_COMPANY . tep_draw_input_field(
                        'shipping_company',
                        (isset($shippingAddress) ? $shippingAddress['company'] : ''),
                        'class="checkout_inputs required form-control" placeholder=""'
                    ) . '</label>';
            } else {
                echo '<label>' . ENTRY_COMPANY . tep_draw_input_field(
                        'shipping_company',
                        (isset($shippingAddress) ? $shippingAddress['company'] : ''),
                        'class="checkout_inputs form-control" placeholder=""'
                    ) . '</label>';
            }
        } else if($result_required['ACCOUNT_COMPANY'] == 'true') {
            echo tep_draw_input_field(
                'shipping_company',
                (isset($shippingAddress) ? $shippingAddress['company'] : ''),
                'class="checkout_inputs required form-control" placeholder="*' . ENTRY_COMPANY . '"'
            );
            } else {
                echo tep_draw_input_field(
                    'shipping_company',
                    (isset($shippingAddress) ? $shippingAddress['company'] : ''),
                    'class="checkout_inputs form-control" placeholder="' . ENTRY_COMPANY . '"'
                );
            }
        echo '</div>';
    }

    if (ONEPAGE_ADDRESS_TYPE_POSITION == 'shipping_billing') {
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
    }

    if (ONEPAGE_ADDRESS_TYPE_POSITION == 'shipping_billing') {
        if (ACCOUNT_TELE == 'true') {
            echo '<div class="form-group">';
            if (!isMobile()) {
                if ($result_required['ACCOUNT_TELE'] == 'true') {
                    echo '<label>* ' . ENTRY_TELEPHONE . tep_draw_input_field(
                            'billing_telephone',
                            (isset($customerAddress) ? $customerAddress['telephone'] : ''),
                            'class="checkout_inputs required form-control" placeholder=""'
                        ) . '</label>';
                } else {
                    echo '<label>' . ENTRY_TELEPHONE . tep_draw_input_field(
                            'billing_telephone',
                            (isset($customerAddress) ? $customerAddress['telephone'] : ''),
                            'class="checkout_inputs form-control" placeholder=""'
                        ) . '</label>';
                }
            } else if ($result_required['ACCOUNT_TELE'] == 'true') {
                echo tep_draw_input_field(
                    'billing_telephone',
                    (isset($customerAddress) ? $customerAddress['telephone'] : ''),
                    'class="checkout_inputs required form-control" placeholder="* ' . ENTRY_TELEPHONE . '"'
                );
                } else {
                    echo tep_draw_input_field(
                        'billing_telephone',
                        (isset($customerAddress) ? $customerAddress['telephone'] : ''),
                        'class="checkout_inputs form-control" placeholder="' . ENTRY_TELEPHONE . '"'
                    );
                }
            echo '</div>';
        }
    }

    if (ACCOUNT_STREET_ADDRESS == 'true') {
        echo '<div class="form-group">';
        if (!isMobile()) {
            if ($result_required['ACCOUNT_STREET_ADDRESS'] == 'true') {
                echo '<label>* ' . ENTRY_STREET_ADDRESS_LABEL . tep_draw_input_field(
                        'shipping_street_address',
                        (isset($shippingAddress) ? $shippingAddress['street_address'] : ''),
                        'class="required checkout_inputs form-control" placeholder="' . ENTRY_STREET_ADDRESS . '"'
                    ) . '</label>';
            } else {
                echo '<label>' . ENTRY_STREET_ADDRESS_LABEL . tep_draw_input_field(
                        'shipping_street_address',
                        (isset($shippingAddress) ? $shippingAddress['street_address'] : ''),
                        'class="checkout_inputs form-control" placeholder="' . ENTRY_STREET_ADDRESS . '"'
                    ) . '</label>';
            }
        } else if($result_required['ACCOUNT_STREET_ADDRESS'] == 'true') {
            echo tep_draw_input_field(
                'shipping_street_address',
                (isset($shippingAddress) ? $shippingAddress['street_address'] : ''),
                'class="required checkout_inputs form-control" placeholder="* ' . ENTRY_STREET_ADDRESS . '"'
            );
            } else {
                echo tep_draw_input_field(
                    'shipping_street_address',
                    (isset($shippingAddress) ? $shippingAddress['street_address'] : ''),
                    'class="checkout_inputs form-control" placeholder="' . ENTRY_STREET_ADDRESS . '"'
                );
            }
        echo '</div>';
    } else {
        //echo '<div class="form-group hidden">' . tep_draw_hidden_field('shipping_street_address', (isset($shippingAddress) ? $shippingAddress['street_address'] : ''), 'class="required checkout_inputs form-control" placeholder="' . ENTRY_STREET_ADDRESS . '"') . '</div>';
    }

    if (ACCOUNT_CITY == 'true') {
        echo '<div class="form-group">';
        if (!isMobile()) {
            if($result_required['ACCOUNT_CITY'] == 'true') {
                echo '<label>* ' . ENTRY_CITY . tep_draw_input_field(
                        'shipping_city',
                        (isset($shippingAddress) ? $shippingAddress['city'] : ''),
                        'class="checkout_inputs required form-control" placeholder=""'
                    ) . '</label>';
            } else {
                echo '<label>' . ENTRY_CITY . tep_draw_input_field(
                        'shipping_city',
                        (isset($shippingAddress) ? $shippingAddress['city'] : ''),
                        'class="checkout_inputs form-control" placeholder=""'
                    ) . '</label>';
            }
        } else if($result_required['ACCOUNT_CITY'] == 'true') {
            echo tep_draw_input_field(
                'shipping_city',
                (isset($shippingAddress) ? $shippingAddress['city'] : ''),
                'class="checkout_inputs required form-control" placeholder="* ' . ENTRY_CITY . '"'
            );
            } else {
                echo tep_draw_input_field(
                    'shipping_city',
                    (isset($shippingAddress) ? $shippingAddress['city'] : ''),
                    'class="checkout_inputs form-control" placeholder="' . ENTRY_CITY . '"'
                );
            }
        echo '</div>';
    } else {
        //echo '<div class="form-group hidden">' . tep_draw_hidden_field('shipping_city', (isset($shippingAddress) ? $shippingAddress['city'] : ''), 'class="checkout_inputs required form-control" placeholder="' . ENTRY_CITY . '"') . '</div>';
    }

    if (ACCOUNT_STATE == 'true') {
        echo '<div class="form-group select_field ">';
        if (!isMobile()) {
            if($result_required['ACCOUNT_STATE'] == 'true') {
                echo '<span>* ' . ENTRY_STATE . '</span>';
            } else {
                echo '<span>' . ENTRY_STATE . '</span>';
            }
        }
        $_GET['zone_field_name'] = 'shipping_zone_id';
        $ajaxSelectRegionTrue = true;
        require 'ajax_select_region.php';
        echo '</div>';
    }

    if (ACCOUNT_SUBURB == 'true') {
        echo '<div class="form-group">';
        if (!isMobile()) {
            if ($result_required['ACCOUNT_SUBURB'] == 'true') {
                echo '<label>* ' . ENTRY_SUBURB . tep_draw_input_field(
                        'shipping_suburb',
                        (isset($shippingAddress) ? $shippingAddress['suburb'] : ''),
                        'class="required checkout_inputs form-control" placeholder=""'
                    ) . '</label>';
            } else {
                echo '<label>' . ENTRY_SUBURB . tep_draw_input_field(
                        'shipping_suburb',
                        (isset($shippingAddress) ? $shippingAddress['suburb'] : ''),
                        'class="checkout_inputs form-control" placeholder=""'
                    ) . '</label>';
            }
        } else if ($result_required['ACCOUNT_SUBURB'] == 'true') {
            echo tep_draw_input_field(
                'shipping_suburb',
                (isset($shippingAddress) ? $shippingAddress['suburb'] : ''),
                'class="required checkout_inputs form-control" placeholder="* ' . ENTRY_SUBURB . '"'
            );
            } else {
                echo tep_draw_input_field(
                    'shipping_suburb',
                    (isset($shippingAddress) ? $shippingAddress['suburb'] : ''),
                    'class="checkout_inputs form-control" placeholder="' . ENTRY_SUBURB . '"'
                );
            }
        echo '</div>';
    }

    if (ACCOUNT_POSTCODE == 'true') {
        echo '<div class="form-group">';
        if (!isMobile()) {
            if($result_required['ACCOUNT_POSTCODE'] == 'true') {
                echo '<label>* ' . ENTRY_POST_CODE . tep_draw_input_field(
                        'shipping_zipcode',
                        (isset($shippingAddress) ? $shippingAddress['postcode'] : ''),
                        'class="checkout_inputs required form-control" data-sent-value="" placeholder=""'
                    ) . '</label>';
            } else {
                echo '<label>' . ENTRY_POST_CODE . tep_draw_input_field(
                        'shipping_zipcode',
                        (isset($shippingAddress) ? $shippingAddress['postcode'] : ''),
                        'class="checkout_inputs form-control" data-sent-value="" placeholder=""'
                    ) . '</label>';
            }
        } else if ($result_required['ACCOUNT_POSTCODE'] == 'true') {
            echo tep_draw_input_field(
                'shipping_zipcode',
                (isset($shippingAddress) ? $shippingAddress['postcode'] : ''),
                'class="checkout_inputs required form-control" data-sent-value="" placeholder="* ' . ENTRY_POST_CODE . '"'
            );
            } else {
                echo tep_draw_input_field(
                    'shipping_zipcode',
                    (isset($shippingAddress) ? $shippingAddress['postcode'] : ''),
                    'class="checkout_inputs form-control" data-sent-value="" placeholder="' . ENTRY_POST_CODE . '"'
                );
            }
        echo '</div>';
    }

    if (ACCOUNT_COUNTRY == 'true') {
        echo '<div class="form-group select_field">';
        if (!isMobile()) {
            if ($result_required['ACCOUNT_COUNTRY'] == 'true') {
                echo '<span>* ' . ENTRY_COUNTRY . '</span>';
            } else {
                echo '<span>' . ENTRY_COUNTRY . '</span>';
            }
        }
        if ($result_required['ACCOUNT_COUNTRY'] == 'true') {
            echo tep_get_country_list(
                    'shipping_country',
                    (isset($shippingAddress) && tep_not_null(
                        $shippingAddress['country_id']
                    ) ? $shippingAddress['country_id'] : STORE_COUNTRY),
                    'class="checkout_inputs required" data-zone="' . ($shippingAddress['zone_id'] ?: STORE_ZONE) . '" placeholder="' . (isMobile() ? '*' . ENTRY_COUNTRY : '') . '" '
                ) . '</div>';
        } else {
            echo tep_get_country_list(
                    'shipping_country',
                    (isset($shippingAddress) && tep_not_null(
                        $shippingAddress['country_id']
                    ) ? $shippingAddress['country_id'] : STORE_COUNTRY),
                    'class="checkout_inputs" data-zone="' . ($shippingAddress['zone_id'] ?: STORE_ZONE) . '" placeholder="' . (isMobile() ? ' ' . ENTRY_COUNTRY : '') . '" '
                ) . '</div>';
        }
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
