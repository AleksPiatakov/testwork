<?php

require('includes/application_top.php');

if (!tep_session_is_registered('customer_id')) {
    // $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}

// needs to be included earlier to set the success message in the messageStack
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_PASSWORD);
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT);

if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    $password_current = tep_db_prepare_input($_POST['password_current']);
    $password_new = tep_db_prepare_input($_POST['password_new']);
    $password_confirmation = tep_db_prepare_input($_POST['password_confirmation']);

    $error = false;

    if (strlen($password_current) < ENTRY_PASSWORD_MIN_LENGTH) {
        $error = true;

        $messageStack->add('account_password', sprintf(ENTRY_PASSWORD_CURRENT_ERROR, ENTRY_PASSWORD_MIN_LENGTH));
    } elseif (strlen($password_new) < ENTRY_PASSWORD_MIN_LENGTH) {
        $error = true;

        $messageStack->add('account_password', sprintf(ENTRY_PASSWORD_NEW_ERROR, ENTRY_PASSWORD_MIN_LENGTH));
    } elseif ($password_new != $password_confirmation) {
        $error = true;

        $messageStack->add('account_password', ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING);
    } elseif (!\Solomono\CSRF::isValid()) {
        $error = true;
    }

    if ($error == false) {
        $check_customer_query = tep_db_query("select customers_password from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
        $check_customer = tep_db_fetch_array($check_customer_query);

        if (tep_validate_password($password_current, $check_customer['customers_password'])) {
            // HMCS: Begin Autologon    **********************************************************
            $new_encrypted_password = tep_encrypt_password($password_new);

            tep_db_query("update " . TABLE_CUSTOMERS . " set customers_password = '" . $new_encrypted_password . "' where customers_id = '" . (int)$customer_id . "'");

            tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_account_last_modified = now() where customers_info_id = '" . (int)$customer_id . "'");


            if (tep_not_null($_COOKIE['password'])) {   //Autologon, Was it enabled?
                $cookie_url_array = parse_url(HTTP_SERVER . substr(DIR_WS_CATALOG, 0, -1));
                $cookie_path = $cookie_url_array['path'];
                setcookie(
                    'password',
                    $new_encrypted_password,
                    time() + (365 * 24 * 3600),
                    $cookie_path,
                    '',
                    ((getenv('HTTPS') == 'on') ? 1 : 0)
                );
            }
            // HMCS: End Autologon      **********************************************************
            $messageStack->add_session('account', SUCCESS_PASSWORD_UPDATED, 'success');

            tep_redirect(tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
        } else {
            $error = true;

            $messageStack->add('account_password', ERROR_CURRENT_PASSWORD_NOT_MATCHING);
        }
    }
}

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'));

$content = CONTENT_ACCOUNT_PASSWORD;
$javascript = 'form_check.js.php';

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
