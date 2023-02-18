<?php

if ($_GET['selected_box']) {
    $_GET['action'] = '';
    $_GET['old_action'] = '';
}

if (($_GET['action'] == 'send_email_to_user') && ($_POST['customers_email_address']) && (!$_POST['back_x'])) {
    switch ($_POST['customers_email_address']) {
        case '***':
            $mail_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS);
            $mail_sent_to = TEXT_ALL_CUSTOMERS;
            break;
        case '**D':
            $mail_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_newsletter = '1'");
            $mail_sent_to = TEXT_NEWSLETTER_CUSTOMERS;
            break;
        default:
            $customers_email_address = tep_db_prepare_input($_POST['customers_email_address']);
            $mail_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($customers_email_address) . "'");
            $mail_sent_to = $_POST['customers_email_address'];
            break;
    }
    $coupon_query = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_id = '" . $_GET['cid'] . "'");
    $coupon_result = tep_db_fetch_array($coupon_query);
    $coupon_name_query = tep_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $_GET['cid'] . "' and language_id = '" . $languages_id . "'");
    $coupon_name = tep_db_fetch_array($coupon_name_query);

    $from = tep_db_prepare_input($_POST['from']);
    $subject = tep_db_prepare_input($_POST['subject']);
    while ($mail = tep_db_fetch_array($mail_query)) {
        $message = tep_db_prepare_input($_POST['message']);
        $message .= "\n\n" . TEXT_TO_REDEEM . "\n\n";
        $message .= TEXT_VOUCHER_IS . $coupon_result['coupon_code'] . "\n\n";
        $message .= TEXT_REMEMBER . "\n\n";
        $message .= TEXT_VISIT . "\n\n";

        //Let's build a message object using the email class
        $mimemessage = new email(['X-Mailer: osCommerce bulk mailer']);
        // add the message to the object
        // MaxiDVD Added Line For WYSIWYG HTML Area: BOF (Send TEXT Email when WYSIWYG Disabled)
        $mimemessage->add_html($message);

        // MaxiDVD Added Line For WYSIWYG HTML Area: EOF (Send HTML Email when WYSIWYG Enabled)
        $mimemessage->build_message();
        $mimemessage->send($mail['customers_firstname'] . ' ' . $mail['customers_lastname'], $mail['customers_email_address'], '', $from, $subject);
    }
    //tep_redirect(tep_href_link(FILENAME_COUPON_ADMIN, 'mail_sent_to=' . urlencode($mail_sent_to)));
}

if (($_GET['action'] == 'preview_email') && (!$_POST['customers_email_address'])) {
    $_GET['action'] = 'email';
    $messageStack->add(ERROR_NO_CUSTOMER_SELECTED, 'error');
}

if ($_GET['mail_sent_to']) {
    $messageStack->add(sprintf(NOTICE_EMAIL_SENT_TO, $_GET['mail_sent_to']), 'notice');
}

switch ($_GET['action']) {
    case 'update':
        // get all $_POST and validate
        $_POST['coupon_code'] = trim($_POST['coupon_code']);

        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
            $language_id = $languages[$i]['id'];
            $_POST['coupon_name'][$language_id] = trim($_POST['coupon_name'][$language_id]);
            $_POST['coupon_desc'][$language_id] = trim($_POST['coupon_desc'][$language_id]);
        }

        $_POST['coupon_amount'] = trim($_POST['coupon_amount']);

        $update_errors = 0;
        $errors = [];
        if (!array_filter($_POST['coupon_name'])) {
            $update_errors = 1;
            $errors[] = ERROR_NO_COUPON_NAME;
        }

        if ((!$_POST['coupon_amount']) && (!$_POST['coupon_free_ship'])) {
            $update_errors = 1;
            $errors[] = ERROR_NO_COUPON_AMOUNT;
        }

        if (!$_POST['coupon_code']) {
            $coupon_code = create_coupon_code();
        }

        if ($_POST['coupon_code']) {
            $coupon_code = $_POST['coupon_code'];
        }

        $query1 = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_code = '" . tep_db_prepare_input($coupon_code) . "'");
        if (tep_db_num_rows($query1) && $_POST['coupon_code'] && $_GET['oldaction'] != 'voucheredit') {
            $update_errors = 1;
            $errors[] = ERROR_COUPON_EXISTS;
        }

        if ($update_errors != 0) {
            $_GET['action'] = 'new';
            $_GET['errors'] = $errors;
        } else {
            $_GET['action'] = 'update_preview';
        }

        break;
    case 'update_confirm':
        if (($_POST['back_x']) || ($_POST['back_y'])) {
            $_GET['action'] = 'new';
        } else {
            $coupon_type = "F";

            $date = new DateTime($_POST['coupon_startdate']);
            $_POST['coupon_startdate'] = $date->format('Y-m-d H:i:s');
            $date = new DateTime($_POST['coupon_finishdate']);
            $_POST['coupon_finishdate'] = $date->format('Y-m-d H:i:s');
            $coupon_active = (date("Y-m-d H:i:s", time()) >= $_POST['coupon_startdate'] && date("Y-m-d H:i:s", time()) < $_POST['coupon_finishdate']) ? "Y" : "N";
            if (substr($_POST['coupon_amount'], -1) == '%') {
                $coupon_type = 'P';
                $_POST['coupon_amount'] = substr($_POST['coupon_amount'], 0, strlen($_POST['coupon_amount']) - 1);
            }
            if ($_POST['coupon_free_ship']) {
                $coupon_type .= 'S';
            }
            if ($_POST['coupon_for_every_product']) {
                $coupon_type .= 'E';
            }
            if (!$_POST['coupon_code']) {
                $_POST['coupon_code'] = create_coupon_code();
            }
            if (empty($_POST['coupon_uses_user'])) {
                $_POST['coupon_uses_user'] = 0;
            }
            if (substr($_POST['coupon_categories'], 0, 1) === ',') {
                $_POST['coupon_categories'] = substr($_POST['coupon_categories'], 1, strlen($_POST['coupon_categories']) - 1);
            }
            $sql_data_array = [
                'coupon_code' => tep_db_prepare_input($_POST['coupon_code']),
                'coupon_amount' => tep_db_prepare_input($_POST['coupon_amount']),
                'coupon_type' => tep_db_prepare_input($coupon_type),
                'uses_per_coupon' => tep_db_prepare_input($_POST['coupon_uses_coupon']),
                'uses_per_user' => tep_db_prepare_input($_POST['coupon_uses_user']),
                'coupon_minimum_order' => tep_db_prepare_input($_POST['coupon_min_order']),
                'restrict_to_products' => tep_db_prepare_input($_POST['coupon_products']),
                'restrict_to_categories' => tep_db_prepare_input($_POST['coupon_categories']),
                'coupon_start_date' => $_POST['coupon_startdate'],
                'coupon_expire_date' => $_POST['coupon_finishdate'],
                'coupon_active' => $coupon_active,
                'date_created' => 'now()',
                'date_modified' => 'now()',
            ];
            $languages = tep_get_languages();
            for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                $language_id = $languages[$i]['id'];
                $sql_data_marray[$i] = [
                    'coupon_name' => tep_db_prepare_input($_POST['coupon_name'][$language_id]),
                    'coupon_description' => tep_db_prepare_input($_POST['coupon_desc'][$language_id]),
                ];
            }
            //        $query = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_code = '" . tep_db_prepare_input($_POST['coupon_code']) . "'");
            //        if (!tep_db_num_rows($query)) {
            if ($_GET['oldaction'] == 'voucheredit') {
                tep_db_perform(TABLE_COUPONS, $sql_data_array, 'update', "coupon_id='" . $_GET['cid'] . "'");
                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                    $language_id = $languages[$i]['id'];
                    $update = tep_db_query("update " . TABLE_COUPONS_DESCRIPTION . " set coupon_name = '" . tep_db_prepare_input($_POST['coupon_name'][$language_id]) . "', coupon_description = '" . tep_db_prepare_input($_POST['coupon_desc'][$language_id]) . "' where coupon_id = '" . $_GET['cid'] . "' and language_id = '" . $language_id . "'");
                    //            tep_db_perform(TABLE_COUPONS_DESCRIPTION, $sql_data_marray[$i], 'update', "coupon_id='" . $_GET['cid']."'");
                }
            } else {
                $query = tep_db_perform(TABLE_COUPONS, $sql_data_array);
                $insert_id = tep_db_insert_id($query);

                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                    $language_id = $languages[$i]['id'];
                    $sql_data_marray[$i]['coupon_id'] = $insert_id;
                    $sql_data_marray[$i]['language_id'] = $language_id;
                    tep_db_perform(TABLE_COUPONS_DESCRIPTION, $sql_data_marray[$i]);
                }
                //        }
            }
        }
}
