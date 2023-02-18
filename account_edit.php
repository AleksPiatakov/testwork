<?php

require('includes/application_top.php');

if (!tep_session_is_registered('customer_id')) {
    // $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}

// needs to be included earlier to set the success message in the messageStack
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_EDIT);
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT);

if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    $firstname = tep_db_prepare_input($_POST['firstname']);
    $lastname = tep_db_prepare_input($_POST['lastname']);

    $old_email_address_query = tep_db_query("select customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
    $old_email_address = tep_db_fetch_array($old_email_address_query);
    $old_email_address = $old_email_address['customers_email_address'];

    $email_address = tep_db_prepare_input($_POST['email_address']);
    $telephone = tep_db_prepare_input($_POST['telephone']);

    $error = false;

    if (!\Solomono\CSRF::isValid()) {
        $error = true;
    }

    $validate = validateFormFields($firstname);
    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH || !$validate) {
        $error = true;

        $messageStack->add('account_edit', sprintf(ENTRY_FIRST_NAME_ERROR, ENTRY_FIRST_NAME_MIN_LENGTH));
    }

    $validate = validateFormFields($lastname);
    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH || !$validate) {
        $error = true;

        $messageStack->add('account_edit', sprintf(ENTRY_LAST_NAME_ERROR, ENTRY_LAST_NAME_MIN_LENGTH));
    }

    if (ACCOUNT_DOB == 'true') {
        $dob = str_replace('/', '-', $_POST['dob']);
        $dob = strtotime(tep_db_prepare_input($dob));
        if (!$dob) {
            $error = true;
            $messageStack->add('account_edit', ENTRY_DATE_OF_BIRTH_ERROR);
        }
    }
    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
        $error = true;
        $messageStack->add('account_edit', sprintf(ENTRY_EMAIL_ADDRESS_ERROR, ENTRY_EMAIL_ADDRESS_MIN_LENGTH));
    }
// Guest Account Start
    $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' and customers_id != '" . tep_db_input($customer_id) . "' and guest_flag != '1'");
//    $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' and customers_id != '" . (int)$customer_id . "'");
// Guest Account End
    if (!tep_validate_email($email_address)) {
        $error = true;
        $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }

    $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' and customers_id != '" . (int)$customer_id . "'");
    $check_email = tep_db_fetch_array($check_email_query);
    if($check_email['total'] == 0){
        $validate = validatePhoneNumber($telephone);
        if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH  || !$validate) {
            $error = true;
            $messageStack->add('account_edit', sprintf(ENTRY_TELEPHONE_NUMBER_ERROR, ENTRY_TELEPHONE_MIN_LENGTH));
        }

        if ($error == false) {
            $sql_data_array = array(
                'customers_firstname' => $firstname,
                'customers_lastname' => $lastname,
                'customers_email_address' => $email_address,
                'customers_telephone' => $telephone
            );

            if (ACCOUNT_DOB == 'true') {
                $sql_data_array['customers_dob'] = date('Y-m-d', $dob);
            }

// Guest Account Start
            if (!$guest_account) {
                $sql_data_array['guest_flag'] = '0';
            }
            tep_db_query("update " . TABLE_CUSTOMERS . " set customers_email_address = '@_" . $email_address . "' where customers_email_address = '" . $email_address . "' and guest_flag = '1'");
            tep_db_query("update " . TABLE_CUSTOMERS . " set customers_lastname = '@_" . $lastname . "' where customers_email_address = '@_" . $email_address . "'");
// Guest Account End


            tep_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customer_id . "'");

            tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_account_last_modified = now() where customers_info_id = '" . (int)$customer_id . "'");

            $sql_data_array = array(
                'entry_firstname' => $firstname,
                'entry_lastname' => $lastname
            );

            tep_db_perform(
                TABLE_ADDRESS_BOOK,
                $sql_data_array,
                'update',
                "customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$customer_default_address_id . "'"
            );

            $email_text = sprintf(SUCCESS_EMAIL_NEW_SENT, $email_address);
            $subject = sprintf(SUCCESS_EMAIL_SENT, STORE_NAME);

            if($email_address != $old_email_address){
                //sent to new email
                tep_mail(
                    $firstname . ' ' . $lastname,
                    "$email_address,$old_email_address",
                    $subject,
                    $email_text,
                    STORE_OWNER,
                    STORE_OWNER_EMAIL_ADDRESS
                );
                /*
                        //sent to old email
                        tep_mail(
                            $firstname . ' ' . $lastname,
                            $old_email_address,
                            $subject,
                            $email_text,
                            STORE_OWNER,
                            STORE_OWNER_EMAIL_ADDRESS
                        );*/
            }

// reset the session variables
            $customer_first_name = $firstname;

            $messageStack->add_session('account_edit', SUCCESS_ACCOUNT_UPDATED, 'success');

            tep_redirect(tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'));
        }
    } else {
        $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
    }

}

$account_query = tep_db_query("select customers_gender, customers_firstname, customers_lastname, customers_dob, customers_email_address, customers_telephone from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
$account = tep_db_fetch_array($account_query);

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'));

$content = CONTENT_ACCOUNT_EDIT;
$javascript = 'form_check.js.php';

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
