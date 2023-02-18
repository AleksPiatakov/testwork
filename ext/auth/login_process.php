<?php

    $rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
    chdir('../../');
    require($rootPath . '/includes/application_top.php');
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);

  $first_name = $_GET['first_name'];
  $last_name = $_GET['last_name'];
  $photo = $_GET['photo'];
  $email = $_GET['email'];
  $city = $_GET['city'];
  $id_social = $_GET['id'];
  $country = STORE_COUNTRY;

  $guest_pass = tep_create_random_value(ENTRY_PASSWORD_MIN_LENGTH, 'mixed');
if ($_GET['password'] == '') {
    $password = tep_db_prepare_input($guest_pass);
} else {
    $password = $_GET['password'];
}

if (!empty($_GET['password'])) { // if not from social network, then use typical login  - process
    $check_customer_query = tep_db_query("select customers_fb_token, customers_id, customers_firstname, customers_lastname, customers_password, customers_groups_id, customers_email_address, customers_default_address_id, customers_status, customers_fax from " . TABLE_CUSTOMERS . " where customers_status = '1' and customers_email_address = '" . tep_db_input($email) . "'");
    if (!tep_db_num_rows($check_customer_query)) {
        echo NO_CUSTOMER;
    } else {
        $check_social = tep_db_fetch_array($check_customer_query);

        if (!tep_validate_password($password, $check_social['customers_password'])) {
            echo NO_PASS;
        } else {
            $first_name = $check_social['customers_firstname'];
            $photo = '';
            $id_social = $check_social['customers_fax'];
            $country = STORE_COUNTRY;

            require('ext/auth/soc_login.php');
        }
    }
} elseif (!empty($id_social)) {
    $check_social_query = tep_db_query("select customers_fb_token, customers_id, customers_firstname, customers_lastname, customers_password, customers_groups_id, customers_email_address, customers_default_address_id, customers_status, customers_fax from " . TABLE_CUSTOMERS . " where customers_fb_token = '" . $id_social . "' and guest_flag != '1'");
    $check_social = tep_db_fetch_array($check_social_query);
    if (!empty($check_social['customers_fb_token'])) {  // if there is social network ID
        if ($email == '') {
            $email = $check_social['customers_email_address'];
        }
        require('ext/auth/soc_login.php');
    } else {
        $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . $email . "' and guest_flag != '1'");
        $check_email = tep_db_fetch_array($check_email_query);
        if ($check_email['total'] > 0) {
            tep_db_query("UPDATE " . TABLE_CUSTOMERS . "  SET customers_fb_token = '$id_social' where customers_email_address = '" . $email . "' and guest_flag != '1'");
            $check_social_query = tep_db_query("select customers_fb_token, customers_id, customers_firstname, customers_lastname, customers_password, customers_groups_id, customers_email_address, customers_default_address_id, customers_status, customers_fax from " . TABLE_CUSTOMERS . " where customers_fb_token = '" . $id_social . "' and guest_flag != '1'");
            $check_social = tep_db_fetch_array($check_social_query);

            require('ext/auth/soc_login.php');
        } else {
  // REGISTRATION -----------------
            require('ext/auth/soc_create.php');
  // REGISTRATION END-----------------
        }
    }
} else {  // if not from social network, then use typical login  - form
    echo '
                <table align="center" border="0" width="300" cellspacing="0" cellpadding="2" style="padding:5px;color:#333;text-align:left;">
                  <tr>
                    <td class="main" style="padding-top:9px;font-size:17px;">' . ENTRY_EMAIL_ADDRESS . '</td>
                    <td class="main" align="right">' . tep_draw_input_field('email', '', 'class="green_input" id="pop_email"', '', '', false) . '</td>
                  </tr>
                  <tr>
                    <td class="main" style="padding-top:4px;font-size:17px;">' . ENTRY_PASSWORD . '</td>
                    <td class="main" align="right">' . tep_draw_password_field('password', '', 'class="green_input" id="pop_pass" style="margin-top:5px;"') . '</td>
                  </tr>
                  <tr>
                    <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr> 
                        <td align="right" style="padding-top:8px;">
                          <a class="a_normal" href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a><br />
                          <a class="a_normal" style="color:#3CA029;" href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">' . TEXT_NEW_CUSTOMER . '</a>
                        </td>
                        <td align="right" width="70">
                          <a href=javascript:checkLoginvk("","","","",document.getElementById(\'pop_email\').value,"",document.getElementById(\'pop_pass\').value); class="green_button" >' . IMAGE_BUTTON_LOGIN . '</a>
                        </td>
                      </tr>
                    </table></td>
                  </tr>                  
                </table>';
}
