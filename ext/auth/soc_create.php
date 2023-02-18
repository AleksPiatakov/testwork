<?php

$text = '';

$text .= '<div class="row">';
$text .= '<div class="col-sm-2"><img style="border-radius:4px;" src="' . $photo . '" /></div>';
$text .= '<div class="col-sm-10">' . TEXT_CUSTOMER_GREETING_HEADER . ', <b>' . $first_name . '</b>!
        <br />';

if (!empty($city)) {
    $text .= '<br />' . ENTRY_CITY . ' <b>' . $city . '</b>';
}

if (!empty($email)) {
    $text .= '<br />' . CR_LOGIN . ': <b>' . $email . '</b><br />';
    $text .= CR_PASS . ': <b>' . $password . '</b><br />';
} else {
    $text .= '<br />' . CR_ADD_EMAIL;
    $text .= '<div class="left"><input id="proc_email" class="green_input" type="text" name="proc_email" /></div>';
    $text .= '<div class="left"><a href=javascript:if(document.getElementById(\'proc_email\').value!=\'\'){checkLoginvk("' . $id_social . '","' . $first_name . '","' . $last_name . '","' . $photo . '",document.getElementById(\'proc_email\').value,"' . $city . '","");} class="green_button" >' . CR_SUBMIT . '</a>
          </div>
          <div class="clear"></div>';
}
echo $text;


if (!empty($email)) {
    $sql_data_array = array('customers_firstname' => $first_name,
                           'customers_lastname' => $last_name,
                           'customers_email_address' => $email,
                           'customers_telephone' => '',
                           'customers_groups_id' => '7', // group named "5%"
                           'customers_fb_token' => $id_social,
                           'customers_password' => tep_encrypt_password($password));

       tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

       $customer_id = tep_db_insert_id();

       $sql_data_array = array('customers_id' => $customer_id,
                           'entry_firstname' => $first_name,
                           'entry_lastname' => $last_name,
                           'entry_street_address' => '',
                           'entry_postcode' => '',
                           'entry_city' => $city,
                           'entry_country_id' => $country);

       tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

       $address_id = tep_db_insert_id();

       tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");
       tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . tep_db_input($customer_id) . "', 1, now())");

       if (SESSION_RECREATE == 'True') {
           tep_session_recreate();
       }

       $customer_first_name = $first_name;
       $customer_last_name = $last_name;
       $customer_default_address_id = $address_id;
       $customer_country_id = $country;
       $customer_zone_id = $zone_id;
       tep_session_register('customer_id');
       tep_session_register('customer_first_name');
       tep_session_register('customer_last_name');
       tep_session_register('customer_default_address_id');
       tep_session_register('customer_country_id');
       tep_session_register('customer_zone_id');

// restore cart contents
       $cart->restore_contents();

// restore wishlist to sesssion
//      $wishList->restore_wishlist();

// build the message content
       $name = $first_name . ' ' . $last_name;
       $email_text = sprintf(EMAIL_GREET_NONE, $first_name);
       $email_text .= sprintf(EMAIL_WELCOME, STORE_NAME) . EMAIL_TEXT;
       $email_text .= '<br /><b>' . CR_LOGIN . ':</b> ' . $email . '<br />';
       $email_text .= '<b>' . CR_PASS . ':</b> ' . $password . '<br /><br />';
       $email_text .= sprintf(EMAIL_CONTACT, STORE_OWNER_EMAIL_ADDRESS) . sprintf(EMAIL_WARNING, STORE_OWNER_EMAIL_ADDRESS);
       $subject = sprintf(EMAIL_SUBJECT, STORE_NAME);
       if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
           require_once(DIR_FS_EXT . 'email_content/functions.php');
           $data = [
               'customers_name' => $first_name,
               'email_address' => $email,
               'password' => $password,
           ];
           $content_email_array = getCreateAccountText($_SESSION['languages_id'], $data);
           $email_text = $content_email_array['content_html'] ? : $email_text;
           $subject = $content_email_array['subject'] ? : $subject;
       }

       tep_mail($name, $email, $subject, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

       $text = '';
       $text .= '<br /><b style="color:#37AE22">' . CR_THX . '</b>';
       $text .= '</div>';
       $text .= '</div>';

       echo $text;
} else {
}
