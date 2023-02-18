<?php

require('includes/application_top.php');
if (tep_session_is_registered('customer_id')) {
    // $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
}

// needs to be included earlier to set the success message in the messageStack
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);
$_POST['state'] = $_POST['selectRegion'];
$_POST['country'] = $_POST['selectCountry'];
$postFirstname = $postLastname = $postDob = $postCompany = $postEmailAddress = $postTelephone = $postStreetAddress = $postCity = $postSuburb = $postPostcode = $postFax = '';
$postCountry = STORE_COUNTRY;
$postZone = STORE_ZONE;
$country_sql = "SELECT `countries_id` FROM `" . TABLE_COUNTRIES . "` WHERE `countries_iso_code_2` = '" . $geoplugin->countryCode . "'";
$country_query = tep_db_query($country_sql);
$country_id = tep_db_fetch_array($country_query);

$required_value_sql = "SELECT `configuration_key`,`configuration_required_value` FROM `" . TABLE_CONFIGURATION . "` WHERE `configuration_group_id` = 5";
$required_value_query = tep_db_query($required_value_sql);
$result_required = [];

while ($required_value = tep_db_fetch_array($required_value_query)) {
    $result_required[$required_value['configuration_key']] = $required_value['configuration_required_value'];
}

//  if(tep_not_null($country_id))
//    $_POST['selectCountry'] = $country_id;

// guest account
if (isset($_GET['guest_account'])) {
    $guest_account = true;
}
// guest account end
// Guest account start
if (isset($_POST['guest_account']) && ($_POST['guest_account'] == true)) {
    tep_session_register('guest_account');
    global $guest_account;
    $guest_account = true;
}
// Guest account end

$process = false;
// +Country-State Selector
if (isset($_POST['action']) && (($_POST['action'] == 'process') || ($_POST['action'] == 'refresh'))) {
    if ($_POST['action'] == 'process') {
        $process = true;
    }
    // -Country-State Selector

    //name
    if (ACCOUNT_FIRST_NAME == 'true') {
        $firstname = tep_db_prepare_input($_POST['firstname']);
    }
    //lastname
    if (ACCOUNT_LAST_NAME == 'true') {
        $lastname = tep_db_prepare_input($_POST['lastname']);
    }
    //date of birth
    if (ACCOUNT_DOB == 'true') {
        $dob = str_replace('/', '-', $_POST['dob']);
        $dob = strtotime(tep_db_prepare_input($dob));
    }
    //company
    if (ACCOUNT_COMPANY == 'true') {
        $company = tep_db_prepare_input($_POST['company']);
    }
    //email
    $email_address = tep_db_prepare_input($_POST['email_address']);
    //phone
    if (ACCOUNT_TELE == 'true') {
        $telephone = tep_db_prepare_input($_POST['telephone']);
    }
    //address
    if (ACCOUNT_STREET_ADDRESS == 'true') {
        $street_address = tep_db_prepare_input($_POST['street_address']);
    }
    //city
    if (ACCOUNT_CITY == 'true') {
        $city = tep_db_prepare_input($_POST['city']);
    }
    //state
    if (ACCOUNT_STATE == 'true') {
        $state = tep_db_prepare_input($_POST['state']);
        if (isset($_POST['zone_id'])) {
            $zone_id = tep_db_prepare_input($_POST['zone_id']);
        } else {
            $zone_id = false;
        }
    }
    //suburb
    if (ACCOUNT_SUBURB == 'true') {
        $suburb = tep_db_prepare_input($_POST['suburb']);
    }
    //postcode
    if (ACCOUNT_POSTCODE == 'true') {
        $postcode = tep_db_prepare_input($_POST['postcode']);
    }
    //country
    if (ACCOUNT_COUNTRY == 'true' or ACCOUNT_STATE == 'true') {
        $country = tep_db_prepare_input($_POST['country']);
    } else {
        $country = STORE_COUNTRY;
    }
    //fax
    if (ACCOUNT_FAX == 'true') {
        $fax = tep_db_prepare_input($_POST['fax']);
    }
    //newsletter
    if (isset($_POST['newsletter'])) {
        $newsletter = tep_db_prepare_input($_POST['newsletter']);
    } else {
        $newsletter = false;
    }
    //password
    $password = tep_db_prepare_input($_POST['password']);
    $confirmation = tep_db_prepare_input($_POST['confirmation']);

    // +Country-State Selector
    if ($process) {
        // -Country-State Selector
        $error = false;

        // Guest Account Start
        if ($guest_account) {
            $guest_pass = tep_create_random_value(ENTRY_PASSWORD_MIN_LENGTH, 'mixed');
            $password = tep_db_prepare_input($guest_pass);
        }

        // fail account creation process if token is invalid
        if (!\Solomono\CSRF::isValid()) {
            $error = true;
        }

        if (getConstantValue('DEFAULT_CAPTCHA_STATUS', 'false') !== 'false') {
            if (isset($_SESSION['captcha_keystring']) && $_POST['keystring'] !== $_SESSION['captcha_keystring']) {
                $error = true;
                $messageStack->add('create_account', 'Captcha error');
            } else {
                unset($_SESSION['captcha_keystring']);
            }
        } else {
            unset($_SESSION['captcha_keystring']);
        }

        //Check captcha
        if (
            getConstantValue(
                'GOOGLE_RECAPTCHA_STATUS',
                'false'
            ) !== 'false' && file_exists(DIR_WS_EXT . 'recaptcha/recaptcha.php')
        ) {
            if ($_SESSION['recaptcha'] !== true) {
                $error = true;
                $messageStack->add('create_account', 'reCaptcha error');
            }
        }
        //End Check captcha

        //check fields errors:
        //name
        if (ACCOUNT_FIRST_NAME == 'true' && $result_required['ACCOUNT_FIRST_NAME'] == 'true') {
            $validate = validateFormFields($firstname);
            $postFirstname = $validate ? stripslashes($firstname) : '';
            if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH || !$validate) {
                $error = true;
                $messageStack->add('create_account', sprintf(ENTRY_FIRST_NAME_ERROR, ENTRY_FIRST_NAME_MIN_LENGTH));
            }
        }
        //lastname
        if (ACCOUNT_LAST_NAME == 'true' && $result_required['ACCOUNT_LAST_NAME'] == 'true') {
            $validate = validateFormFields($lastname);
            $postLastname = $validate ? stripslashes($lastname) : '';
            if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH || !$validate) {
                $error = true;
                $messageStack->add('create_account', sprintf(ENTRY_LAST_NAME_ERROR, ENTRY_LAST_NAME_MIN_LENGTH));
            }
        }
        //date of birth
        if (ACCOUNT_DOB == 'true' && $result_required['ACCOUNT_DOB'] == 'true') {
            if ($dob) {
                $postDob = $_POST['dob'];
            } else {
                $error = true;
                $messageStack->add('create_account', ENTRY_DATE_OF_BIRTH_ERROR);
            }
        }
        //company
        if (ACCOUNT_COMPANY == 'true' && $result_required['ACCOUNT_COMPANY'] == 'true') {
            $validate = validateFormFields($company, "/[?!^+()₴!\"№;%:?*_=~#^\[\]\.\,><]/u");
            $postCompany = $validate ? stripslashes($company) : '';
            if (strlen($company) < ENTRY_COMPANY_MIN_LENGTH || !$validate) {
                $error = true;
                $messageStack->add('create_account', sprintf(ENTRY_COMPANY_ERROR, ENTRY_COMPANY_MIN_LENGTH));
            }
        }
        //email
        $postEmailAddress = tep_validate_email($email_address) ? $email_address : '';
        if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
            $error = true;
            $messageStack->add('create_account', sprintf(ENTRY_EMAIL_ADDRESS_ERROR, ENTRY_EMAIL_ADDRESS_MIN_LENGTH));
        } elseif (tep_validate_email($email_address) == false) {
            $error = true;
            $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
        } else {
            // Guest Account added guest_flag
            $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' and guest_flag != '1'");
            $check_email = tep_db_fetch_array($check_email_query);
            if ($check_email['total'] > 0) {
                $error = true;
                $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
            }
        }
        //phone
        if (ACCOUNT_TELE == 'true' && $result_required['ACCOUNT_TELE'] == 'true') {
            $validate = validatePhoneNumber($telephone);
            $postTelephone = $validate ? $telephone : '';
            if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH || !$validate) {
                $error = true;
                $messageStack->add('create_account', sprintf(ENTRY_TELEPHONE_NUMBER_ERROR, ENTRY_TELEPHONE_MIN_LENGTH));
            }
        }
        //address
        if (ACCOUNT_STREET_ADDRESS == 'true' && $result_required['ACCOUNT_STREET_ADDRESS'] == 'true') {
            $validate = validateFormFields($street_address, "/[?!^+()₴!\";%:?*_=~@#$^&\[\]><]/u");
            $postStreetAddress = $validate ? stripslashes($street_address) : '';
            if(strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH || !$validate) {
                $error = true;
                $messageStack->add('create_account', sprintf(ENTRY_STREET_ADDRESS_ERROR, ENTRY_STREET_ADDRESS_MIN_LENGTH));
            }
        }
        //city
        if (ACCOUNT_CITY == 'true' && $result_required['ACCOUNT_CITY'] == 'true') {
            $validate = validateFormFields($city);
            $postCity = $validate ? stripslashes($city) : '';
            if (strlen($city) < ENTRY_CITY_MIN_LENGTH || !$validate) {
                $error = true;
                $messageStack->add('create_account', sprintf(ENTRY_CITY_ERROR, ENTRY_CITY_MIN_LENGTH));
            }
        }
        //state
        if (ACCOUNT_STATE == 'true' && $result_required['ACCOUNT_STATE'] == 'true') {
            $zone_id = 0;
            $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = " . (int)$country);
            $check = tep_db_fetch_array($check_query);
            $entry_state_has_zones = ($check['total'] > 0);
            if ($entry_state_has_zones == true) {
                // $zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and zone_name = '" . tep_db_input($state) . "'");
                $zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = " . (int)$country . " and zone_id = " . (int)tep_db_input($state));
                if (tep_db_num_rows($zone_query) == 1) {
                    $zone = tep_db_fetch_array($zone_query);
                    $zone_id = $zone['zone_id'];
                    $postZone = (int)$zone_id;
                } else {
                    $error = true;
                    $messageStack->add('create_account', ENTRY_STATE_ERROR_SELECT);
                }
            } else {
                $validate = validateFormFields($state);
                $postZone = $validate ? stripslashes($state) : STORE_ZONE;
                if (strlen($state) < ENTRY_STATE_MIN_LENGTH || !$validate) {
                    $error = true;
                    $messageStack->add('create_account', sprintf(ENTRY_STATE_ERROR, ENTRY_STATE_MIN_LENGTH));
                }
            }
        }
        //suburb
        if (ACCOUNT_SUBURB == 'true' && $result_required['ACCOUNT_SUBURB'] == 'true') {
            $validate = validateFormFields($suburb);
            $postSuburb = $validate ? stripslashes($suburb) : '';
            if(strlen($suburb) < ENTRY_SUBURB_MIN_LENGTH || !$validate) {
                $error = true;
                $messageStack->add('create_account', sprintf(ENTRY_SUBURB_ERROR, ENTRY_SUBURB_MIN_LENGTH));
            }
        }
        //postcode
        if (ACCOUNT_POSTCODE == 'true' && $result_required['ACCOUNT_POSTCODE'] == 'true') {
            $validate = validateFormFields($postcode, "/[^0-9-a-zA-Z]/");
            $postPostcode = $validate ? $postcode : '';
            if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH || !$validate) {
                $error = true;
                $messageStack->add('create_account', sprintf(ENTRY_POST_CODE_ERROR, ENTRY_POSTCODE_MIN_LENGTH));
            }
        }
        //country
        if (ACCOUNT_COUNTRY == 'true' && $result_required['ACCOUNT_COUNTRY'] == 'true') {
            $validate = validateFormFields($country,"/[^0-9]/");
            $postCountry = $validate ? $country : STORE_COUNTRY;
            if (!$validate) {
                $error = true;
                $messageStack->add('create_account', ENTRY_COUNTRY_ERROR);
            }
        }
        //fax
        if (ACCOUNT_FAX == 'true' && $result_required['ACCOUNT_FAX'] == 'true') {
            $validate = validatePhoneNumber($fax);
            $postFax = $validate ? $fax : '';
            if(strlen($fax) < ENTRY_FAX_MIN_LENGTH || !$validate) {
                $error = true;
                $messageStack->add('create_account', sprintf(ENTRY_FAX_NUMBER_ERROR, ENTRY_FAX_MIN_LENGTH));
            }
        }

        // Guest Account Start
        if ($guest_account == false) {
            if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH) {
                $error = true;

                $messageStack->add('create_account', sprintf(ENTRY_PASSWORD_ERROR, ENTRY_PASSWORD_MIN_LENGTH));
            } elseif ($password != $confirmation) {
                $error = true;

                $messageStack->add('create_account', ENTRY_PASSWORD_ERROR_NOT_MATCHING);
            }
        }
        // guest account end

        if ($error == false) {
            $sql_data_array = array(
                'customers_firstname' => $firstname,
                'customers_lastname' => $lastname,
                'customers_email_address' => $email_address,
                'customers_telephone' => $telephone,
                'customers_dob' => date('Y-m-d'),
                'customers_fax' => $fax,
                'customers_osebe' => '',

                'customers_newsletter' => $newsletter,
                'customers_password' => tep_encrypt_password($password)
            );

            if (ACCOUNT_DOB == 'true') {
                $sql_data_array['customers_dob'] = date('Y-m-d', $dob);
            }

            // Guest Account Start
            if ($guest_account) {
                $sql_data_array['guest_flag'] = '1';
            }
            tep_db_query("update " . TABLE_CUSTOMERS . " set customers_email_address = '@_" . $email_address . "' where customers_email_address = '" . $email_address . "' and guest_flag = '1'");
            tep_db_query("update " . TABLE_CUSTOMERS . " set customers_lastname = '@_" . $lastname . "' where customers_email_address = '@_" . $email_address . "'");
            // Guest Account End

            tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

            $customer_id = tep_db_insert_id();

            $sql_data_array = array(
                'customers_id' => $customer_id,
                'entry_firstname' => $firstname,
                'entry_lastname' => $lastname,
                'entry_street_address' => $street_address,
                'entry_postcode' => $postcode,
                'entry_city' => $city,
                'entry_country_id' => $country
            );

            if (ACCOUNT_COMPANY == 'true') {
                $sql_data_array['entry_company'] = $company;
            }
            if (ACCOUNT_SUBURB == 'true') {
                $sql_data_array['entry_suburb'] = $suburb;
            }
            if (ACCOUNT_STATE == 'true') {
                if ($zone_id > 0) {
                    $sql_data_array['entry_zone_id'] = $zone_id;
                    $sql_data_array['entry_state'] = '';
                } else {
                    $sql_data_array['entry_zone_id'] = '0';
                    $sql_data_array['entry_state'] = $state;
                }
            }

            tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

            $address_id = tep_db_insert_id();

            tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = " . (int)$address_id . " where customers_id = " . (int)$customer_id);

// Guest Account Start
            if (!$guest_account) {
                tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . tep_db_input($customer_id) . "', '0', now())");
            } else {
                tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . tep_db_input($customer_id) . "', '-1', now())");
            }
// Guest Account End

            if (SESSION_RECREATE == 'True') {
                tep_session_recreate();
            }

            $customer_first_name = $firstname;
            $customer_last_name = $lastname;
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
            $wishList->restore_wishlist();

// build the message content
            $name = $firstname . ' ' . $lastname;

            $email_text = sprintf(EMAIL_GREET_NONE, $firstname);
            $subject = sprintf(EMAIL_SUBJECT, STORE_NAME);

            // Guest Account Start
            if ($guest_account == true) {
                $redirectUrl = tep_href_link(FILENAME_CHECKOUT, '', 'SSL');
                $redirectUrl = str_replace('//', '/', '/' . $redirectUrl);
                tep_redirect(HTTP_SERVER . $redirectUrl);
            } elseif (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                require_once(DIR_FS_EXT . 'email_content/functions.php');
                $data = [
                    'customers_name' => $firstname,
                    'email_address' => $email_address,
                    'password' => $password,
                ];
                $content_email_array = getCreateAccountText($lng->language['id'], $data);
                $email_text = $content_email_array['content_html'] ?: $email_text;
                $subject = $content_email_array['subject'] ?: $subject;
            } else {
                $email_text .= sprintf(EMAIL_WELCOME, STORE_NAME) . EMAIL_TEXT . sprintf(
                    EMAIL_CONTACT,
                    STORE_OWNER_EMAIL_ADDRESS
                ) . sprintf(EMAIL_WARNING, STORE_OWNER_EMAIL_ADDRESS);
            }

            tep_mail($name, $email_address, $subject, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            $redirectUrl = tep_href_link(FILENAME_CREATE_ACCOUNT_SUCCESS, '', 'SSL');
            $redirectUrl = str_replace('//', '/', '/' . $redirectUrl);
            tep_redirect(HTTP_SERVER . $redirectUrl);
        }
    }

    // +Country-State Selector
}
if (!isset($country)) {
    $country = DEFAULT_COUNTRY;
}
// -Country-State Selector

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));

$content = CONTENT_CREATE_ACCOUNT;
$javascript = 'form_check.js.php';

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);
require(DIR_WS_INCLUDES . 'application_bottom.php');
