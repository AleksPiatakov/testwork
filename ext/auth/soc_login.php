<?php

          $check_country_query = tep_db_query("select entry_country_id, entry_zone_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$check_social['customers_id'] . "' and address_book_id = '" . (int)$check_social['customers_default_address_id'] . "'");
          $check_country = tep_db_fetch_array($check_country_query);

          $check_customers_groups_query = tep_db_query("select customers_groups_id from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$check_social['customers_id'] . "'");
          $check_customers_groups = tep_db_fetch_array($check_customers_groups_query);

          $customer_id = $check_social['customers_id'];
          $customer_default_address_id = $check_social['customers_default_address_id'];
          $customer_first_name = $check_social['customers_firstname'];
          $customer_last_name = $check_social['customers_lastname'];
          $customer_country_id = $check_country['entry_country_id'];
          $customer_zone_id = $check_country['entry_zone_id'];

          tep_session_register('customer_id');
          tep_session_register('customer_default_address_id');
          tep_session_register('customer_first_name');
          tep_session_register('customer_last_name');
          tep_session_register('customer_country_id');
          tep_session_register('customer_zone_id');

          tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(), customers_info_number_of_logons = customers_info_number_of_logons+1 where customers_info_id = '" . (int)$customer_id . "'");

          if(!$check_customers_groups){
              // add to group 5% if he logged through social network
              tep_db_query("update " . TABLE_CUSTOMERS . " set customers_groups_id = 7 where customers_id = '" . (int)$customer_id . "'");
          }

// restore cart contents
        $cart->restore_contents();

// restore wishlist to sesssion
//        $wishList->restore_wishlist();

$text2 = '';
$text2 .= '<div class="row">';
  $text2 .= '<div class="col-sm-2"><img style="border-radius:4px;" src="' . $photo . '" /></div>';
  $text2 .= '<div class="col-sm-10">' . TEXT_CUSTOMER_GREETING_HEADER . ',  <b>' . $first_name . '</b>!
        <br />';

if (!empty($city)) {
    $text2 .= '<br />' . ENTRY_CITY . ' <b>' . $city . '</b>';
}

if (!empty($email)) {
    $text2 .= '<br />' . CR_LOGIN . ': <b>' . $email . '</b><br />';
}
  $text2 .= '<br /><b style="color:#37AE22">' . SOC_LOGIN_THX . '</b>';
  $text2 .= '</div>';
$text2 .= '</div>';

//$text2 = iconv('UTF-8', 'windows-1251', $text2);
echo $text2;
