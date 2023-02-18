<h3><?php echo  NEW_ADDRESS_TITLE ?></h3>

<?php

$messageStack->render('addressbook');

if (!isset($process)) {
    $process = false;
}
$filedValue = ($_POST['firstname'] && validateFormFields($_POST['firstname'])) ? stripslashes($_POST['firstname']) : stripslashes($entry['entry_firstname']);
echo '<div class="form-group">' . ENTRY_FIRST_NAME . ' ' . tep_draw_input_field('firstname', $filedValue, 'class="form-control"') . '</div>';

if (ACCOUNT_LAST_NAME == 'true') {
    $filedValue = ($_POST['lastname'] && validateFormFields($_POST['lastname'])) ? stripslashes($_POST['lastname']) : stripslashes($entry['entry_lastname']);
    echo '<div class="form-group">' . ENTRY_LAST_NAME . ' ' . tep_draw_input_field('lastname', $filedValue, 'class="form-control"') . '</div>';
}

if (ACCOUNT_COMPANY == 'true') {
    $filedValue = ($_POST['company'] && validateFormFields($_POST['company'], "/[?!^+()₴!\"№;%:?*_=\'~#^\[\]\.\,><]/u")) ? stripslashes($_POST['company']) : stripslashes($entry['entry_company']);
    echo '<div class="form-group">' . ENTRY_COMPANY . ' ' . tep_draw_input_field('company', $filedValue, 'class="form-control"') . '</div>';
}

if (ACCOUNT_STREET_ADDRESS == 'true') {
    $filedValue = ($_POST['street_address'] && validateFormFields($_POST['street_address'], "/[?!^+()₴!\";%:?*_=\'~@#$^&\[\]><]/u")) ? stripslashes($_POST['street_address']) : stripslashes($entry['entry_street_address']);
    echo '<div class="form-group">' . ENTRY_STREET_ADDRESS . ' ' . tep_draw_input_field('street_address', $filedValue, 'class="form-control"') . '</div>';
}

if (ACCOUNT_CITY == 'true') {
    $filedValue = ($_POST['city'] && validateFormFields($_POST['city'])) ? stripslashes($_POST['city']) : stripslashes($entry['entry_city']);
    echo '<div class="form-group">' . ENTRY_CITY . ' ' . tep_draw_input_field('city', $filedValue, 'class="form-control"') . '</div>';
}

if (ACCOUNT_COUNTRY == 'true' or ACCOUNT_STATE == 'true') {
    if (ACCOUNT_COUNTRY != 'true') {
        $non_show = 'style="display:none;"';
    }
    echo '<div class="form-group">' . ENTRY_STATE . '<span class="selectZone"></span></div>';
}

if (ACCOUNT_SUBURB == 'true') {
    $filedValue = ($_POST['suburb'] && validateFormFields($_POST['suburb'])) ? stripslashes($_POST['suburb']) : stripslashes($entry['entry_suburb']);
    echo '<div class="form-group">' . ENTRY_SUBURB . ' ' . tep_draw_input_field('suburb', $filedValue, 'class="form-control"') . '</div>';
}

if (ACCOUNT_POSTCODE == 'true') {
    $filedValue = ($_POST['postcode'] && validateFormFields($_POST['postcode'],"/[^0-9-a-zA-Z]/")) ? $_POST['postcode'] : $entry['entry_postcode'];
    echo '<div class="form-group">' . ENTRY_POST_CODE . ' ' . tep_draw_input_field('postcode', $filedValue, 'class="form-control"') . '</div>';
}

if ((isset($_GET['edit']) && ($customer_default_address_id != $_GET['edit'])) || (isset($_GET['edit']) == false)) {
    echo '<div class="form-group">' . tep_draw_checkbox_field('primary', 'on', $_POST['primary'], 'id="primary" style="display:none;"') . ' <label for="primary">' . SET_AS_PRIMARY . '</label></div>';
}

if (ACCOUNT_COUNTRY == 'true' or ACCOUNT_STATE == 'true') {
    if (ACCOUNT_COUNTRY != 'true') {
        $non_show = 'style="display:none;"';
    }
    $filedValue = ($_POST['country'] && validateFormFields($_POST['country'],"/[^0-9]/")) ? $_POST['country'] : $entry['entry_country_id'];
    $zoneId = $_POST['zone_id'] ? (int)$_POST['zone_id'] : $entry['entry_zone_id'];
    echo '<div class="form-group edit_acc_country" ' . $non_show . '>' . ENTRY_COUNTRY . ' ' . tep_get_country_list('country', $filedValue, 'data-zone="' . $zoneId . '" ') . '</div>';
}
?>
