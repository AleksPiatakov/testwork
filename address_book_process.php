<?php

require('includes/application_top.php');

if (!tep_session_is_registered('customer_id')) {
//    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}

// needs to be included earlier to set the success message in the messageStack
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADDRESS_BOOK_PROCESS);
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT);

if (isset($_GET['action']) && ($_GET['action'] == 'deleteconfirm') && isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    tep_db_query("delete from " . TABLE_ADDRESS_BOOK . " where address_book_id = '" . (int)$_GET['delete'] . "' and customers_id = '" . (int)$customer_id . "'");
    $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_DELETED, 'success');
    tep_redirect(tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
}

//error checking when updating or adding an entry
$process = false;
$refresh = false;

if ($_POST['action'] == 'process' || $_POST['action'] == 'update' || $_POST['action'] == 'refresh') {
    //check token
    if (!\Solomono\CSRF::isValid()) {
        tep_redirect($_SERVER['REQUEST_URI']);
    }

    //set options
    $refresh = $_POST['action'] == 'refresh';
    $process = true;
    $error = false;

    //get data
    $company = getConstantValue('ACCOUNT_COMPANY') == 'true' ? tep_db_prepare_input($_POST['company']) : '';
    $firstname = tep_db_prepare_input($_POST['firstname']);
    $lastname = getConstantValue('ACCOUNT_LAST_NAME') == 'true' ? tep_db_prepare_input($_POST['lastname']) : '';
    $street_address = getConstantValue('ACCOUNT_STREET_ADDRESS') == 'true' ? tep_db_prepare_input($_POST['street_address']) : '';
    $suburb = getConstantValue('ACCOUNT_SUBURB') == 'true' && validateFormFields($_POST['suburb']) ? tep_db_prepare_input($_POST['suburb']) : '';
    $postcode = getConstantValue('ACCOUNT_POSTCODE') == 'true' ? tep_db_prepare_input($_POST['postcode']) : '';
    $city = getConstantValue('ACCOUNT_CITY') == 'true' ? tep_db_prepare_input($_POST['city']) : '';
    $country = getConstantValue('ACCOUNT_COUNTRY') == 'true' or getConstantValue('ACCOUNT_STATE') == 'true' ? tep_db_prepare_input($_POST['country']) : '';
    if (getConstantValue('ACCOUNT_STATE') == 'true') {
        $zone_id = isset($_POST['zone_id']) ? tep_db_prepare_input($_POST['zone_id']) : false;
        $state = tep_db_prepare_input($_POST['state']);
    }
    $state = !$refresh ? $state : '';

    //check data
    if ($process) {
        if (strlen($firstname) < getConstantValue('ENTRY_FIRST_NAME_MIN_LENGTH') || !validateFormFields($firstname)) {
            $error = true;
            $messageStack->add('addressbook', sprintf(ENTRY_FIRST_NAME_ERROR, getConstantValue('ENTRY_FIRST_NAME_MIN_LENGTH', '3')));
        }

        if (getConstantValue('ACCOUNT_LAST_NAME') == 'true' and (strlen($lastname) < getConstantValue('ENTRY_LAST_NAME_MIN_LENGTH') || !validateFormFields($lastname))) {
            $error = true;
            $messageStack->add('addressbook', sprintf(ENTRY_LAST_NAME_ERROR, getConstantValue('ENTRY_LAST_NAME_MIN_LENGTH', '3')));
        }

        if (getConstantValue('ACCOUNT_STREET_ADDRESS') == 'true' and (strlen($street_address) < getConstantValue('ENTRY_STREET_ADDRESS_MIN_LENGTH') || !validateFormFields($street_address, "/[?!^+()₴!\";%:?*_=\'~@#$^&\[\]><]/u"))) {
            $error = true;
            $messageStack->add('addressbook', sprintf(ENTRY_STREET_ADDRESS_ERROR, getConstantValue('ENTRY_STREET_ADDRESS_MIN_LENGTH', '3')));
        }

        if (getConstantValue('ACCOUNT_POSTCODE') == 'true' and (strlen($postcode) < getConstantValue('ENTRY_POSTCODE_MIN_LENGTH') || !validateFormFields($postcode, "/[^0-9-a-zA-Z]/"))) {
            $error = true;
            $messageStack->add('addressbook', sprintf(ENTRY_POST_CODE_ERROR, getConstantValue('ENTRY_POSTCODE_MIN_LENGTH', '3')));
        }

        if (getConstantValue('ACCOUNT_CITY') == 'true' and (strlen($city) < getConstantValue('ENTRY_CITY_MIN_LENGTH') || !validateFormFields($city))) {
            $error = true;
            $messageStack->add('addressbook', sprintf(ENTRY_CITY_ERROR, getConstantValue('ENTRY_CITY_MIN_LENGTH', '3')));
        }

        if (getConstantValue('ACCOUNT_COUNTRY') == 'true' and !validateFormFields($country, "/[^0-9]/")) {
            $error = true;
            $messageStack->add('addressbook', ENTRY_COUNTRY_ERROR);
        }

        if (getConstantValue('ACCOUNT_STATE') == 'true' and $zone_id == 0 and strlen($state) < getConstantValue('ENTRY_STATE_MIN_LENGTH')) {
            $error = true;
            $messageStack->add('addressbook', sprintf(ENTRY_STATE_ERROR, getConstantValue('ENTRY_STATE_MIN_LENGTH', '3')));
        }

        $queryAddressBookId = !empty($_GET['edit']) ? " and address_book_id = '" . (int)$_GET['edit'] . "'" : "";
        $checkAddressId = tep_db_query("select entry_firstname from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "'" . $queryAddressBookId);
        if (!tep_db_num_rows($checkAddressId)) {
            $error = true;
            $messageStack->add('addressbook', getConstantValue('ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY', 'ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY'));
        }
    }

    if (!$refresh) {
        if ($error == false) {
            $sql_data_array = array(
                'entry_firstname' => $firstname,
                'entry_lastname' => $lastname,
                'entry_street_address' => $street_address,
                'entry_postcode' => $postcode,
                'entry_city' => $city,
                'entry_country_id' => (int)$country
            );

            if (getConstantValue('ACCOUNT_COMPANY') == 'true') {
                $sql_data_array['entry_company'] = $company;
            }
            if (getConstantValue('ACCOUNT_SUBURB') == 'true') {
                $sql_data_array['entry_suburb'] = $suburb;
            }
            if (getConstantValue('ACCOUNT_STATE') == 'true') {
                if ($zone_id > 0) {
                    $sql_data_array['entry_zone_id'] = (int)$zone_id;
                    $sql_data_array['entry_state'] = '';
                } else {
                    $sql_data_array['entry_zone_id'] = '0';
                    $sql_data_array['entry_state'] = $state;
                }
            }

            if ($_POST['action'] == 'update') {
                tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "address_book_id = '" . (int)$_GET['edit'] . "' and customers_id ='" . (int)$customer_id . "'");

                // reregister session variables
                if ((isset($_POST['primary']) && ($_POST['primary'] == 'on')) || ($_GET['edit'] == $customer_default_address_id)) {
                    $customer_first_name = $firstname;
                    $customer_country_id = $country;
                    $customer_zone_id = (($zone_id > 0) ? (int)$zone_id : '0');
                    $customer_default_address_id = (int)$_GET['edit'];

                    $sql_data_array = array(
                        'customers_firstname' => $firstname,
                        'customers_lastname' => $lastname,
                        'customers_default_address_id' => (int)$_GET['edit']
                    );


                    tep_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customer_id . "'");
                    $new_address_book_id = (int)$_GET['edit'];
                }
            } else {
                $sql_data_array['customers_id'] = (int)$customer_id;
                tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

                $new_address_book_id = tep_db_insert_id();
            }

            if (isset($_POST['primary']) && ($_POST['primary'] == 'on')) {
                $_SESSION['customer_default_address_id'] = $_SESSION['sendto'] = $_SESSION['billto'] = $new_address_book_id;
                tep_db_perform(TABLE_CUSTOMERS, array('customers_default_address_id' => $new_address_book_id), 'update', "customers_id = '" . (int)$customer_id . "'");
            }

            $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED, 'success');

            tep_redirect(tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
        }
    }
}

if ($refresh) {
    //Recreate $entry from post values collected above
    $entry = array(
        'entry_firstname' => $firstname,
        'entry_lastname' => $lastname,
        'entry_street_address' => $street_address,
        'entry_postcode' => $postcode,
        'entry_city' => $city,
        'entry_state' => "",
        'entry_zone_id' => 0,
        'entry_country_id' => (int)$country,
        'entry_company' => getConstantValue('ACCOUNT_COMPANY') == 'true' ? $company : '',
        'entry_suburb' => getConstantValue('ACCOUNT_SUBURB') == 'true' ? $suburb : ''
    );
} else {
    if (isset($_GET['edit'])) {
        if (is_numeric($_GET['edit'])) {
            //get address book data
            $entry_query = tep_db_query("select entry_gender, entry_company, entry_firstname, entry_lastname, entry_street_address, entry_suburb, entry_postcode, entry_city, entry_state, entry_zone_id, entry_country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$_GET['edit'] . "'");
            $entry = tep_db_fetch_array($entry_query);
        }
        //check get data and address book data
        if (!is_numeric($_GET['edit']) || !tep_db_num_rows($entry_query)) {
            //redirect with error message
            $messageStack->add_session('addressbook', getConstantValue('ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY', 'ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY'));
            tep_redirect(tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
        }
    } elseif (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
        if ($_GET['delete'] == $customer_default_address_id) {
            $messageStack->add_session('addressbook', WARNING_PRIMARY_ADDRESS_DELETION, 'warning');
            tep_redirect(tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
        } else {
            $check_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where address_book_id = '" . (int)$_GET['delete'] . "' and customers_id = '" . (int)$customer_id . "'");
            $check = tep_db_fetch_array($check_query);

            if ($check['total'] < 1) {
                $messageStack->add_session('addressbook', ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY);

                tep_redirect(tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
            }
        }
    } else {
        $entry = array();

        if (!isset($country)) {
            $country = DEFAULT_COUNTRY;
        }
        $entry['entry_country_id'] = $country;
    }
}

//redirect if address book is overflowing
if (!isset($_GET['delete']) && !isset($_GET['edit'])) {
    if (tep_count_customer_address_book_entries() >= getConstantValue('MAX_ADDRESS_BOOK_ENTRIES', 5)) {
        $messageStack->add_session('addressbook', ERROR_ADDRESS_BOOK_FULL);
        tep_redirect(tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
    }
}

//collect breadcrumbs
$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
if (is_numeric($_GET['edit'])) {
    $breadcrumb->add(NAVBAR_TITLE_MODIFY_ENTRY, tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $_GET['edit'], 'SSL'));
} elseif (is_numeric($_GET['delete'])) {
    $breadcrumb->add(NAVBAR_TITLE_DELETE_ENTRY, tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $_GET['delete'], 'SSL'));
} else {
    $breadcrumb->add(NAVBAR_TITLE_ADD_ENTRY, tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, '', 'SSL'));
}

$content = CONTENT_ADDRESS_BOOK_PROCESS;
$javascript = $content . '.php';

require(DIR_WS_TEMPLATES . TEMPLATE_NAME . '/' . TEMPLATENAME_MAIN_PAGE);

require(DIR_WS_INCLUDES . 'application_bottom.php');