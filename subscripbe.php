<?php

if (
    $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' and preg_match(
        '/^.+@.+\..+$|^\s*((\+?\s*(\(\s*)?3)?[\s-]*(\(\s*)?8[\s-]*)g/',
        $_POST['email_address']
    )
) {
    require('includes/application_top.php');
    global $languages_id;
    $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($_POST['email_address']) . "'");
    $check_email = tep_db_fetch_array($check_email_query);

    $password = tep_create_random_value(ENTRY_PASSWORD_MIN_LENGTH);

    if ($check_email['total'] == 0) {
        $sql_data_array = array(
            'customers_firstname' => SB_SUBSCRIBER,
            'customers_lastname' => '',
            'customers_email_address' => tep_db_prepare_input($_POST['email_address']),
            'customers_newsletter' => 1,
            'customers_groups_id' => 8,
            'customers_password' => tep_encrypt_password($password)
        );

        tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

        $customer_id = tep_db_insert_id();

        $sql_data_array = array(
            'customers_id' => $customer_id,
            'entry_firstname' => SB_SUBSCRIBER . ' ' . tep_db_prepare_input($_POST['customer_name'])
        );

        tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
        $address_id = tep_db_insert_id();

        tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");
        tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . tep_db_input($customer_id) . "', '0', now())");

        if ($_POST['sendSubscriptionCoupon']){
            $coupon_name = isset($_POST['coupon_id']) ? getCoupon($_POST['coupon_id'])['coupon_code'] : '';
        }else{
            $coupon_name = '';
        }

        $couponDiscount = $_POST['couponDiscount'] ?? '';
        $subject = SB_EMAIL_NAME;

        if(!$_POST['sendSubscriptionCoupon'] && !isset($_POST['couponDiscount'])){
            // to customer, subscription only
            $email_text = SB_EMAIL_USER . ' ' . $_POST['email_address'] . ' (' . ENTRY_PASSWORD . ' ' . $password . ') ' . SB_EMAIL_WAS_SUBSCRIBED;
        }

        if(!$_POST['sendSubscriptionCoupon'] && isset($_POST['couponDiscount'])) {
            // to customer, subscription discount
            $email_text = SB_EMAIL_USER . ' ' . $_POST['email_address'] . ' (' . ENTRY_PASSWORD . ' ' . $password . ') ' . SB_EMAIL_WAS_SUBSCRIBED . '</br>' . SB_YOUR_SPECIAL . ' ' . $couponDiscount;
        }

        if($_POST['sendSubscriptionCoupon'] && $_POST['couponDiscount']) {
            // to customer, subscription discount and send coupon
            $email_text = SB_EMAIL_USER . ' ' . $_POST['email_address'] . ' ' . SB_EMAIL_WAS_SUBSCRIBED . '.' . '</br>' . SB_YOUR_COUPON . $coupon_name . '</br>' . SB_YOUR_SPECIAL . ' ' . $couponDiscount;
        }

        if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {

            require_once(DIR_FS_EXT . 'email_content/functions.php');
            $data = [
                'email_address' => $_POST['email_address'],
                'customers_discount' => $couponDiscount,
                'customers_coupon' => $coupon_name,
            ];
            $content_email_array = getSubscribeNewText($languages_id, $data);
            $subject = $content_email_array['subject'] ? : $subject;
            $email_text = $content_email_array['content_html'] ? : $email_text;
        }

        if (!$_POST['sendSubscriptionCoupon'] && !isset($_POST['couponDiscount'])) {

            // to store owner:
            tep_mail(
                STORE_OWNER,
                STORE_OWNER_EMAIL_ADDRESS,
                SB_EMAIL_NAME,
                SB_EMAIL_USER . ' ' . $_POST['email_address'] . ' ' . SB_EMAIL_WAS_SUBSCRIBED,
                SB_EMAIL_NAME,
                $_POST['email_address']
            );
            // to customer:
            tep_mail(
                $_POST['email_address'],
                $_POST['email_address'],
                $subject,
                $email_text,
                STORE_OWNER,
                STORE_OWNER_EMAIL_ADDRESS
            );

            //send a subscription coupon and discount
        } elseif ($_POST['sendSubscriptionCoupon'] && $couponDiscount !== '') {
            // to store owner:
            tep_mail(
                STORE_OWNER,
                STORE_OWNER_EMAIL_ADDRESS,
                SB_EMAIL_NAME,
                SB_EMAIL_USER . ' ' . $_POST['email_address'] . ' ' . SB_EMAIL_WAS_SUBSCRIBED . '.' . '</br>' . SB_YOUR_COUPON . $coupon_name . '</br>' . SB_YOUR_SPECIAL . ' ' . $couponDiscount,
                SB_EMAIL_NAME,
                $_POST['email_address']
            );
            // to customer:
            tep_mail(
                $_POST['email_address'],
                $_POST['email_address'],
                $subject,
                $email_text,
                STORE_OWNER,
                STORE_OWNER_EMAIL_ADDRESS
            );

           //send discount
        }else{
            // to store owner:
            tep_mail(
                STORE_OWNER,
                STORE_OWNER_EMAIL_ADDRESS,
                SB_EMAIL_NAME,
                SB_EMAIL_USER . ' ' . $_POST['email_address'] . ' ' . SB_EMAIL_WAS_SUBSCRIBED . '.' . '</br>' . SB_YOUR_SPECIAL . ' ' . $couponDiscount,
                SB_EMAIL_NAME,
                $_POST['email_address']
            );
            // to customer:
            tep_mail(
                $_POST['email_address'],
                $_POST['email_address'],
                $subject,
                $email_text,
                STORE_OWNER,
                STORE_OWNER_EMAIL_ADDRESS
            );
        }


        $response = array(
            'success' => true,
            'message' => '<span>' . SB_EMAIL_USER . ' ' . tep_db_prepare_input($_POST['email_address']) . ' ' . SB_EMAIL_WAS_SUBSCRIBED . '</span>'
        );

    } else {

        $response = array(
            'success' => false,
            'message' => tep_db_prepare_input($_POST['email_address']) . ' ' . SB_EMAIL_ALREADY
        );
    }

    echo json_encode($response);
}
