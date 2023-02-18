<?php
/*
  $Id: form_check.js.php,v 1.1.1.1 2003/09/18 19:05:06 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<script language="javascript">
var form = "";
var submitted = false;
var error = false;
var error_message = "";

function check_input(field_name, field_size, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;
    if (field_value == '' || field_value.length < field_size) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_radio(field_name, message) {
  var isChecked = false;

  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var radio = form.elements[field_name];

    for (var i=0; i<radio.length; i++) {
      if (radio[i].checked == true) {
        isChecked = true;
        break;
      }
    }

    if (isChecked == false) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_select(field_name, field_default, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == field_default) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_password(field_name_1, field_name_2, field_size, message_1, message_2) {
  if (form.elements[field_name_1] && (form.elements[field_name_1].type != "hidden")) {
    var password = form.elements[field_name_1].value;
    var confirmation = form.elements[field_name_2].value;

    if (password == '' || password.length < field_size) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;
    } else if (password != confirmation) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    }
  }
}

function check_password_new(field_name_1, field_name_2, field_name_3, field_size, message_1, message_2, message_3) {
  if (form.elements[field_name_1] && (form.elements[field_name_1].type != "hidden")) {
    var password_current = form.elements[field_name_1].value;
    var password_new = form.elements[field_name_2].value;
    var password_confirmation = form.elements[field_name_3].value;

    if (password_current == '' || password_current.length < field_size) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;
    } else if (password_new == '' || password_new.length < field_size) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    } else if (password_new != password_confirmation) {
      error_message = error_message + "* " + message_3 + "\n";
      error = true;
    }
  }
}

function check_form(form_name) {
  if (submitted == true) {
    alert("<?php echo JS_ERROR_SUBMITTED; ?>");
    return false;
  }

  error = false;
  form = form_name;
  error_message = "<?php echo JS_ERROR; ?>";

    //name
    <?php if ($result_required['ACCOUNT_FIRST_NAME'] == 'true') echo ' check_input("firstname", '. ENTRY_FIRST_NAME_MIN_LENGTH.', "' . sprintf(ENTRY_FIRST_NAME_ERROR,ENTRY_FIRST_NAME_MIN_LENGTH).'");' . "\n"; ?>
    //lastname
    <?php if ($result_required['ACCOUNT_LAST_NAME'] == 'true') echo ' check_input("lastname", '. ENTRY_LAST_NAME_MIN_LENGTH.', "' . sprintf(ENTRY_LAST_NAME_ERROR,ENTRY_LAST_NAME_MIN_LENGTH).'");' . "\n"; ?>
    //date of birth
    <?php if ($result_required['ACCOUNT_DOB'] == 'true') echo ' check_input("dob", '. ENTRY_DOB_MIN_LENGTH.', "' . sprintf(ENTRY_DOB_ERROR,ENTRY_DOB_MIN_LENGTH).'");' . "\n"; ?>
    //company
    <?php if ($result_required['ACCOUNT_COMPANY'] == 'true') echo ' check_input("company", '. ENTRY_COMPANY_MIN_LENGTH.', "' . sprintf(ENTRY_COMPANY_ERROR,ENTRY_COMPANY_MIN_LENGTH).'");' . "\n"; ?>
    //email
    check_input("email_address", <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>, "<?php echo sprintf(ENTRY_EMAIL_ADDRESS_ERROR,ENTRY_EMAIL_ADDRESS_MIN_LENGTH); ?>");
    //phone
    <?php if ($result_required['ACCOUNT_TELE'] == 'true') echo ' check_input("telephone", ' . ENTRY_TELEPHONE_MIN_LENGTH . ', "' . sprintf(ENTRY_TELEPHONE_NUMBER_ERROR,ENTRY_TELEPHONE_MIN_LENGTH) . '");' . "\n"; ?>
    //address
    <?php if ($result_required['ACCOUNT_STREET_ADDRESS'] == 'true') echo ' check_input("street_address", '.  ENTRY_STREET_ADDRESS_MIN_LENGTH.', "'. sprintf(ENTRY_STREET_ADDRESS_ERROR,ENTRY_STREET_ADDRESS_MIN_LENGTH).'");' . "\n"; ?>
    //city
    <?php if ($result_required['ACCOUNT_CITY'] == 'true') echo ' check_input("city", '.  ENTRY_CITY_MIN_LENGTH.', "'. sprintf(ENTRY_CITY_ERROR,ENTRY_CITY_MIN_LENGTH).'");' . "\n"; ?>
    //state
    <?php if ($result_required['ACCOUNT_STATE'] == 'true') echo '  check_input("selectRegion", ' . ENTRY_STATE_MIN_LENGTH . ', "' . sprintf(ENTRY_STATE_ERROR,ENTRY_STATE_MIN_LENGTH) . '");' . "\n"; ?>
    //suburb
    <?php if ($result_required['ACCOUNT_SUBURB'] == 'true') echo '  check_input("suburb", ' . ENTRY_SUBURB_MIN_LENGTH . ', "' . sprintf(ENTRY_SUBURB_ERROR,ENTRY_SUBURB_MIN_LENGTH) . '");' . "\n"; ?>
    //postcode
    <?php if ($result_required['ACCOUNT_POSTCODE'] == 'true') echo ' check_input("postcode", '. ENTRY_POSTCODE_MIN_LENGTH.', "'. sprintf(ENTRY_POST_CODE_ERROR,ENTRY_POSTCODE_MIN_LENGTH).'");' . "\n"; ?>
    //country
    <?php if ($result_required['ACCOUNT_COUNTRY'] == 'true') echo ' check_input("selectCountry", '.  ENTRY_COUNTRY_MIN_LENGTH.', "'. sprintf(ENTRY_COUNTRY_ERROR,ENTRY_COUNTRY_MIN_LENGTH).'");' . "\n"; ?>
    //fax
    <?php if ($result_required['ACCOUNT_FAX'] == 'true') echo ' check_input("fax", '. ENTRY_FAX_MIN_LENGTH.', "' . sprintf(ENTRY_FAX_NUMBER_ERROR,ENTRY_FAX_MIN_LENGTH).'");' . "\n"; ?>
    //password
    check_password("password", "confirmation", <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>, "<?php echo sprintf(ENTRY_PASSWORD_ERROR,ENTRY_PASSWORD_MIN_LENGTH); ?>", "<?php echo ENTRY_PASSWORD_ERROR_NOT_MATCHING; ?>");
    check_password_new("password_current", "password_new", "password_confirmation", <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>, "<?php echo sprintf(ENTRY_PASSWORD_ERROR,ENTRY_PASSWORD_MIN_LENGTH); ?>", "<?php echo sprintf(ENTRY_PASSWORD_NEW_ERROR,ENTRY_PASSWORD_MIN_LENGTH); ?>", "<?php echo ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING; ?>");

<?php
// Guest account start
  if ($guest_account == false) {
?>
    check_password("password", "confirmation", <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>, "<?php echo sprintf(ENTRY_PASSWORD_ERROR,ENTRY_PASSWORD_MIN_LENGTH); ?>", "<?php echo ENTRY_PASSWORD_ERROR_NOT_MATCHING; ?>");
    check_password_new("password_current", "password_new", "password_confirmation", <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>, "<?php echo sprintf(ENTRY_PASSWORD_ERROR,ENTRY_PASSWORD_MIN_LENGTH); ?>", "<?php echo sprintf(ENTRY_PASSWORD_NEW_ERROR,ENTRY_PASSWORD_MIN_LENGTH); ?>", "<?php echo ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING; ?>");
<?php
  }
// Guest account end
?>

  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}

</script>