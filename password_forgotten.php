<?php

require('includes/application_top.php');

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PASSWORD_FORGOTTEN);

if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $email_address = tep_db_prepare_input($_POST['email_address']);

    $check_customer_query = tep_db_query("select customers_firstname, customers_lastname, customers_password, customers_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
    if (tep_db_num_rows($check_customer_query)) {
        $check_customer = tep_db_fetch_array($check_customer_query);

        $new_password = tep_create_random_value(ENTRY_PASSWORD_MIN_LENGTH);
        $crypted_password = tep_encrypt_password($new_password);

        tep_db_query("update " . TABLE_CUSTOMERS . " set customers_password = '" . tep_db_input($crypted_password) . "' where customers_id = '" . (int)$check_customer['customers_id'] . "'");
        $email_text = sprintf(EMAIL_PASSWORD_REMINDER_BODY, $REMOTE_ADDR, STORE_NAME, $new_password);
        $subject = sprintf(EMAIL_PASSWORD_REMINDER_SUBJECT, STORE_NAME);
        if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
            require_once(DIR_FS_EXT . 'email_content/functions.php');
            $content_email_array = getPasswordForgottenText($new_password);
            $email_text = $content_email_array['content_html'] ?: $email_text;
            $subject = $content_email_array['subject'] ?: $subject;
        }
        tep_mail(
            $check_customer['customers_firstname'] . ' ' . $check_customer['customers_lastname'],
            $email_address,
            $subject,
            $email_text,
            STORE_OWNER,
            STORE_OWNER_EMAIL_ADDRESS
        );

        $messageStack->add_session('login', SUCCESS_PASSWORD_SENT, 'success');

        tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
    } else {
        $messageStack->add('password_forgotten', TEXT_NO_EMAIL_ADDRESS_FOUND);
    }
}

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_LOGIN, '', 'SSL'), 'rel="nofollow"');
$breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL'), 'rel="nofollow"');

$content = CONTENT_PASSWORD_FORGOTTEN;

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
