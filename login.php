<?php

require('includes/application_top.php');

if (tep_session_is_registered('customer_id')) {
    // $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
}
// Guest account start - reset to false
$guest_account = false;
// Guest account end

// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
if ($session_started == false) {
    tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
}

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);

try {
    if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
        if (!\Solomono\CSRF::isValid()) {
            throw new Exception("Invalid csrf token");
        }

        $email_address = tep_db_prepare_input($_POST['email_address']);
        $password = tep_db_prepare_input($_POST['password']);

        //TotalB2B start
        $check_customer_query = tep_db_query("
        select customers_id
             , customers_firstname
             , customers_lastname
             , customers_password
             , customers_groups_id
             , customers_email_address
             , customers_default_address_id
             , customers_status
             , customers_trylog_date
             , customers_try_count 
        from " . TABLE_CUSTOMERS . " 
        where customers_status = '1' 
          and customers_email_address = '" . tep_db_input($email_address) . "'
      ");

        if (!tep_db_num_rows($check_customer_query)) {
            throw new Exception("Customer with email $email_address not found");
        }

        $check_customer = tep_db_fetch_array($check_customer_query);

        if ((time() - strtotime($check_customer['customers_trylog_date'])) / 60 > 5) {
            tep_db_query("update customers c set c.customers_try_count = '" . 0 . "' where c.customers_email_address = '" . tep_db_input($email_address) . "'");
            $check_customer['customers_try_count'] = 0;
        }
        if ($check_customer['customers_try_count'] >= 3) {
            $_GET['login'] = 'fail_try';
        } else {

            //TotalB2B end

            // Check that password is good
            if (!tep_validate_password($password, $check_customer['customers_password'])) {
                throw new Exception("Invalid password");
            }

            if (SESSION_RECREATE == 'True') {
                tep_session_recreate();
            }

            $check_country_query = tep_db_query("
        select entry_country_id
             , entry_zone_id 
        from " . TABLE_ADDRESS_BOOK . " 
        where customers_id = '" . (int)$check_customer['customers_id'] . "' 
          and address_book_id = '" . (int)$check_customer['customers_default_address_id'] . "'
      ");

            $check_country = tep_db_fetch_array($check_country_query);

            $customer_id = $check_customer['customers_id'];
            $customer_default_address_id = $check_customer['customers_default_address_id'];
            $customer_first_name = $check_customer['customers_firstname'];
            $customer_last_name = $check_customer['customers_lastname'];
            $customer_country_id = $check_country['entry_country_id'];
            $customer_zone_id = $check_country['entry_zone_id'];

            tep_session_register('customer_id');
            tep_session_register('customer_default_address_id');
            tep_session_register('customer_first_name');
            tep_session_register('customer_last_name');
            tep_session_register('customer_country_id');
            tep_session_register('customer_zone_id');

            tep_db_query("
        update " . TABLE_CUSTOMERS_INFO . " 
        set customers_info_date_of_last_logon = now()
          , customers_info_number_of_logons = customers_info_number_of_logons+1 
        where customers_info_id = '" . (int)$customer_id . "'
      ");

            // restore cart contents
            $cart->restore_contents();

            // restore wishlist to sesssion
            $wishList->restore_wishlist();

            $redirect = strstr(
                $_SERVER['HTTP_REFERER'],
                FILENAME_LOGIN
            ) ? tep_href_link(FILENAME_DEFAULT) : $_SERVER['HTTP_REFERER'];
            tep_redirect($redirect);
            die;
        }
    }
} catch (Exception $e) {
    $messageStack->add('login', TEXT_LOGIN_ERROR);
}

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_LOGIN, '', 'SSL'), 'rel="nofollow"');

$content = CONTENT_LOGIN;
$javascript = $content . '.js';

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
