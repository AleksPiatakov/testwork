<?php

require('includes/application_top.php');

require('includes/classes/http_client.php');

// if the customer is not logged on, redirect them to the login page
if (!tep_session_is_registered('customer_id')) {
    // $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_GV_SEND);

if (($_POST['back_x']) || ($_POST['back_y'])) {
    $_GET['action'] = '';
}
if ($_GET['action'] == 'send') {
    $error = false;
    if (!tep_validate_email(trim($_POST['email']))) {
        $error = true;
        $error_email = ERROR_ENTRY_EMAIL_ADDRESS_CHECK;
    }
    $gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
    $gv_result = tep_db_fetch_array($gv_query);
    $customer_amount = $gv_result['amount'];
    $gv_amount = trim($_POST['amount']);
    if (preg_match('/[^0-9/.]/', $gv_amount)) {
        $error = true;
        $error_amount = ERROR_ENTRY_AMOUNT_CHECK;
    }
    if ($gv_amount > $customer_amount || $gv_amount == 0) {
        $error = true;
        $error_amount = ERROR_ENTRY_AMOUNT_CHECK;
    }
}
if ($_GET['action'] == 'process') {
    $id1 = create_coupon_code($mail['customers_email_address']);
    $gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id='" . $customer_id . "'");
    $gv_result = tep_db_fetch_array($gv_query);
    $new_amount = $gv_result['amount'] - $_POST['amount'];
    if ($new_amount < 0) {
        $error = true;
        $error_amount = ERROR_ENTRY_AMOUNT_CHECK;
        $_GET['action'] = 'send';
    } else {
        $gv_query = tep_db_query("update " . TABLE_COUPON_GV_CUSTOMER . " set amount = '" . $new_amount . "' where customer_id = '" . $customer_id . "'");
        $gv_query = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . $customer_id . "'");
        $gv_customer = tep_db_fetch_array($gv_query);
        $gv_query = tep_db_query("insert into " . TABLE_COUPONS . " (coupon_type, coupon_code, date_created, coupon_amount) values ('G', '" . $id1 . "', NOW(), '" . $_POST['amount'] . "')");
        $insert_id = tep_db_insert_id($gv_query);
        $gv_query = tep_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, sent_lastname, emailed_to, date_sent) values ('" . $insert_id . "' ,'" . $customer_id . "', '" . addslashes($gv_customer['customers_firstname']) . "', '" . addslashes($gv_customer['customers_lastname']) . "', '" . $_POST['email'] . "', now())");

        $gv_email = STORE_NAME . "\n" .
            EMAIL_SEPARATOR . "\n" .
            sprintf(EMAIL_GV_TEXT_HEADER, $currencies->format($_POST['amount'])) . "\n" .
            EMAIL_SEPARATOR . "\n" .
            sprintf(EMAIL_GV_FROM, stripslashes($_POST['send_name'])) . "\n";
        if (isset($_POST['message'])) {
            $gv_email .= EMAIL_GV_MESSAGE . "\n";
            if (isset($_POST['to_name'])) {
                $gv_email .= sprintf(EMAIL_GV_SEND_TO, stripslashes($_POST['to_name'])) . "\n\n";
            }
            $gv_email .= stripslashes($_POST['message']) . "\n\n";
        }
        $gv_email .= sprintf(EMAIL_GV_REDEEM, $id1) . "\n\n";
        $gv_email .= EMAIL_GV_LINK . tep_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $id1, 'NONSSL', false);

        $gv_email .= "\n\n";
        $gv_email .= EMAIL_GV_FIXED_FOOTER . "\n\n";
        $gv_email .= EMAIL_GV_SHOP_FOOTER . "\n\n";

        $gv_email_subject = sprintf(EMAIL_GV_TEXT_SUBJECT, stripslashes($_POST['send_name']));
        tep_mail('', $_POST['email'], $gv_email_subject, nl2br($gv_email), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, '');
    }
}
$breadcrumb->add(NAVBAR_TITLE);
$content = CONTENT_GV_SEND;

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');
