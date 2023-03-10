<?php
/*
  $Id: customers.php,v 1.2 2003/09/24 13:57:05 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  $error = false;
  $processed = false;

  if (tep_not_null($action)) {
    switch ($action) {
      case 'update':
        $customers_id = tep_db_prepare_input($_GET['cID']);
        $customers_firstname = tep_db_prepare_input($_POST['customers_firstname']);
        $customers_lastname = tep_db_prepare_input($_POST['customers_lastname']);
        $customers_email_address = tep_db_prepare_input($_POST['customers_email_address']);
        $customers_telephone = tep_db_prepare_input($_POST['customers_telephone']);
        $customers_osebe = tep_db_prepare_input($_POST['customers_osebe']);
        $customers_info4admin = tep_db_prepare_input($_POST['customers_info4admin']);
        $customers_firm = tep_db_prepare_input($_POST['customers_firm']);
        $customers_newsletter = tep_db_prepare_input($_POST['customers_newsletter']);

// add for SPPC shipment and payment module start 
	if ($_POST['customers_payment_allowed'] && $_POST['customers_payment_settings'] == '1') {
	$customers_payment_allowed = tep_db_prepare_input($_POST['customers_payment_allowed']);
	} else { // no error with subsequent re-posting of variables	
	$customers_payment_allowed = '';
	if ($_POST['payment_allowed'] && $_POST['customers_payment_settings'] == '1') {
	    foreach ($_POST['payment_allowed'] as $key => $val) {
		// while(list($key, $val) = each($_POST['payment_allowed'])) {
		    if ($val == true) { 
		    $customers_payment_allowed .= tep_db_prepare_input($val).';'; 
		    }
		 } // end while
		  $customers_payment_allowed = substr($customers_payment_allowed,0,strlen($customers_payment_allowed)-1);
	} // end if ($_POST['payment_allowed'])
	} // end else ($_POST['customers_payment_allowed']
	if ($_POST['customers_shipment_allowed'] && $_POST['customers_shipment_settings'] == '1') {
	$customers_shipment_allowed = tep_db_prepare_input($_POST['customers_shipment_allowed']);
	} else { // no error with subsequent re-posting of variables	

		$customers_shipment_allowed = '';
		if ($_POST['shipping_allowed'] && $_POST['customers_shipment_settings'] == '1') {
		    foreach ($_POST['shipping_allowed'] as $key => $val) {
		  // while(list($key, $val) = each($_POST['shipping_allowed'])) {
		    if ($val == true) { 
		    $customers_shipment_allowed .= tep_db_prepare_input($val).';'; 
		    }
		  } // end while
		  $customers_shipment_allowed = substr($customers_shipment_allowed,0,strlen($customers_shipment_allowed)-1);
		} // end if ($_POST['shipment_allowed'])
	} // end else ($_POST['customers_shipment_allowed']
// add for SPPC shipment and payment module end

        //TotalB2B start
		$customers_discount_sign = tep_db_prepare_input($_POST['customers_discount_sign']);
		$customers_discount = tep_db_prepare_input($_POST['customers_discount']);
        $customers_groups_id = tep_db_prepare_input($_POST['customers_groups_id']); 
        //TotalB2B end

        $customers_dob = tep_db_prepare_input($_POST['customers_dob']);

        $default_address_id = tep_db_prepare_input($_POST['default_address_id']);
        $entry_street_address = tep_db_prepare_input($_POST['entry_street_address']);
        $entry_suburb = tep_db_prepare_input($_POST['entry_suburb']);
        $entry_postcode = tep_db_prepare_input($_POST['entry_postcode']);
        $entry_city = tep_db_prepare_input($_POST['entry_city']);
        $entry_country_id = tep_db_prepare_input($_POST['entry_country_id']);

//-----------------------------------------------------------------------------------------------
          $customer_notified = '0';
          if (isset($_POST['notify']) && ($_POST['notify'] == 'on')) {     
            $groups_query2 = tep_db_query("select cg.customers_groups_id, cg.customers_groups_name from " . TABLE_CUSTOMERS_GROUPS ." as cg, " . TABLE_CUSTOMERS ." as cu where cu.customers_id ='".$customers_id."' and cu.customers_groups_id = cg.customers_groups_id");
            $groups2 = tep_db_fetch_array($groups_query2); 
            if ($groups2['customers_groups_id']!=$customers_groups_id) {
              $groups_array2 = $groups2['customers_groups_name'];
              $groups_query3 = tep_db_query("select cg.customers_groups_id, cg.customers_groups_name from " . TABLE_CUSTOMERS_GROUPS ." as cg where cg.customers_groups_id = '".$customers_groups_id."'");
              $groups3 = tep_db_fetch_array($groups_query3);                 

//if ($customers_groups_id==1) 
//   $gro_name = '<b>????????????????????????????????</b>. <br><br>???????????? ???? ???? ?????????????? ???????????? ???????? ???? ????????????.';
//else $gro_name = '<b>?????????????? ????????????????????</b>. <br>???????????? ???? ?????????????? ???????????? ?????? ???????? ???? ????????????, ???????????? ??????????, ???????????? ???????????? ????????????. ';
              tep_mail($customers_firstname,$customers_email_address, TEXT_CUST_STATUS_CHANGED, TEXT_CUST_HELLO.','. $customers_firstname .'&nbsp;'. $customers_lastname.'!<br>'.TEXT_CUST_STATUS_CHANGED_FROM.' '.$groups_array2 .' '.TEXT_CUST_STATUS_CHANGED_TO.' '.$groups3['customers_groups_name'] .'<br><br>'.TEXT_CUST_STATUS_THX.' '.STORE_NAME, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
              $customer_notified = '1'; 
            }
          }
//-----------------------------------------------------------------------------------------------
        $entry_company = tep_db_prepare_input($_POST['entry_company']);
        $entry_state = tep_db_prepare_input($_POST['entry_state']);
        if (isset($_POST['entry_zone_id'])) $entry_zone_id = tep_db_prepare_input($_POST['entry_zone_id']);

        if (strlen($customers_firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
          $error = true;
          $entry_firstname_error = true;
        } else {
          $entry_firstname_error = false;
        }

        if (strlen($customers_lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
          $error = true;
          $entry_lastname_error = true;
        } else {
          $entry_lastname_error = false;
        }

          if (ACCOUNT_DOB == 'true') {
              $monthDOB = substr(tep_date_raw($customers_dob), 4, 2);
              $dayDOB = substr(tep_date_raw($customers_dob), 6, 2);
              $yearDOB = substr(tep_date_raw($customers_dob), 0, 4);
              if (
                  !empty($monthDOB) && !empty($dayDOB) && !empty($yearDOB)
                  &&
                  checkdate((int)$monthDOB, (int)$dayDOB, (int)$yearDOB)
              ) {
                  $entry_date_of_birth_error = false;
              } else {
                  $error = true;
                  $entry_date_of_birth_error = true;
              }
          }

        if (strlen($customers_email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
          $error = true;
          $entry_email_address_error = true;
        } else {
          $entry_email_address_error = false;
        }

        if (!tep_validate_email($customers_email_address)) {
          $error = true;
          $entry_email_address_check_error = true;
        } else {
          $entry_email_address_check_error = false;
        }

        if (ACCOUNT_STREET_ADDRESS == 'true') {
	        if (strlen($entry_street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
          $error = true;
          $entry_street_address_error = true;
        } else {
          $entry_street_address_error = false;
        }
    	}

        if (ACCOUNT_POSTCODE == 'true') {
	        if (strlen($entry_postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
          $error = true;
          $entry_post_code_error = true;
        } else {
          $entry_post_code_error = false;
        }
    }

        if (ACCOUNT_CITY == 'true') {
	        if (strlen($entry_city) < ENTRY_CITY_MIN_LENGTH) {
          $error = true;
          $entry_city_error = true;
        } else {
          $entry_city_error = false;
        }
    }

        if (ACCOUNT_COUNTRY == 'true') {
	        if ($entry_country_id == false) {
          $error = true;
          $entry_country_error = true;
        } else {
          $entry_country_error = false;
        }
    }

        if (ACCOUNT_STATE == 'true') {
          if ($entry_country_error == true) {
            $entry_state_error = true;
          } else {
            $zone_id = 0;
            $entry_state_error = false;
            $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$entry_country_id . "'");
            $check_value = tep_db_fetch_array($check_query);
            $entry_state_has_zones = ($check_value['total'] > 0);
            if ($entry_state_has_zones == true) {
              $zone_query = tep_db_query("select zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$entry_country_id . "' and zone_name = '" . tep_db_input($entry_state) . "'");
              if (tep_db_num_rows($zone_query) == 1) {
                $zone_values = tep_db_fetch_array($zone_query);
                $entry_zone_id = $zone_values['zone_id'];
              } else {
                $error = true;
                $entry_state_error = true;
              }
            } else {
              if ($entry_state == false) {
                $error = true;
                $entry_state_error = true;
              }
            }
         }
      }

      if (ACCOUNT_TELE == 'true') {
	      if (strlen($customers_telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
        $error = true;
        $entry_telephone_error = true;
      } else {
        $entry_telephone_error = false;
      }
  }

      $check_email = tep_db_query("select customers_email_address from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($customers_email_address) . "' and customers_id != '" . (int)$customers_id . "'");
      if (tep_db_num_rows($check_email)) {
        $error = true;
        $entry_email_address_exists = true;
      } else {
        $entry_email_address_exists = false;
      }

      if ($error == false) {

        $sql_data_array = array('customers_firstname' => $customers_firstname,
                                'customers_lastname' => $customers_lastname,
                                'customers_email_address' => $customers_email_address,
                                'customers_telephone' => $customers_telephone,
                                'customers_osebe' => $customers_osebe,
								'customers_info4admin' => $customers_info4admin,
								'customers_firm' => $customers_firm,
                                //TotalB2B start
                                'customers_newsletter' => $customers_newsletter,
                                'customers_discount' => $customers_discount_sign . $customers_discount,
                                'customers_groups_id' => $customers_groups_id,
                                //TotalB2B end

//add for SPPC shipment and payment module start  
								'customers_payment_allowed' => $customers_payment_allowed,
								'customers_shipment_allowed' => $customers_shipment_allowed);
// add for SPPC shipment and payment module end 						

        
        if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($customers_dob);

        tep_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customers_id . "'");

        tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_account_last_modified = now() where customers_info_id = '" . (int)$customers_id . "'");

        if ($entry_zone_id > 0) $entry_state = '';

        $sql_data_array = array('entry_firstname' => $customers_firstname,
                                'entry_lastname' => $customers_lastname,
                                'entry_street_address' => $entry_street_address,
                                'entry_postcode' => $entry_postcode,
                                'entry_city' => $entry_city,
                                'entry_country_id' => $entry_country_id);

        if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $entry_company;
        if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $entry_suburb;

        if (ACCOUNT_STATE == 'true') {
          if ($entry_zone_id > 0) {
            $sql_data_array['entry_zone_id'] = $entry_zone_id;
            $sql_data_array['entry_state'] = '';
          } else {
            $sql_data_array['entry_zone_id'] = '0';
            $sql_data_array['entry_state'] = $entry_state;
          }
        }

        tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "customers_id = '" . (int)$customers_id . "' and address_book_id = '" . (int)$default_address_id . "'");

        tep_redirect(tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $customers_id));

        } else if ($error == true) {
          $cInfo = new objectInfo($_POST);
          $processed = true;
        }

        break;
      case 'deleteconfirm':
        $customers_id = tep_db_prepare_input($_GET['cID']);

        tep_db_query("delete from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customers_id . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customers_id . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customers_id . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customers_id . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customers_id . "'");
        tep_db_query("delete from " . TABLE_WHOS_ONLINE . " where customer_id = '" . (int)$customers_id . "'");

        tep_redirect(tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID', 'action'))));
        break;

	  //TotalB2B start
	  case 'setflag':
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          if ($_GET['cID']) {
            tep_set_customers_status($_GET['cID'], $_GET['flag']);
          }
        }
        tep_redirect(tep_href_link(FILENAME_CUSTOMERS, '', 'NONSSL'));
        break;
	  //TotalB2B end

      default:
	  
// add for SPPC shipment and payment module start 	       
        //TotalB2B start
        
        $customers_query = tep_db_query("select c.customers_id, c.customers_gender, c.customers_firstname, c.customers_lastname, c.customers_dob, c.customers_email_address, a.entry_company, a.entry_street_address, a.entry_suburb, a.entry_postcode, a.entry_city, a.entry_state, a.entry_zone_id, a.entry_country_id, c.customers_telephone, c.customers_osebe, c.customers_info4admin, c.customers_firm, c.customers_newsletter, c.customers_groups_id, c.customers_discount, c.customers_payment_allowed, c.customers_shipment_allowed, c.customers_default_address_id from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a on c.customers_default_address_id = a.address_book_id where a.customers_id = c.customers_id and c.customers_id = '" . (int)$_GET['cID'] . "'");

        //TotalB2B end

     $module_directory = DIR_FS_CATALOG_MODULES . 'payment/';
        $ship_module_directory = DIR_FS_CATALOG_MODULES . 'shipping/';

        $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
        $directory_array = array();
        if ($dir = @dir($module_directory)) {
        while ($file = $dir->read()) {
        if (!is_dir($module_directory . $file)) {
           if (substr($file, strrpos($file, '.')) == $file_extension) {
              $directory_array[] = $file; // array of all the payment modules present in includes/modules/payment
                  }
               }
            }
        sort($directory_array);
        $dir->close();
        }

        $ship_directory_array = array();
        if ($dir = @dir($ship_module_directory)) {
        while ($file = $dir->read()) {
        if (!is_dir($ship_module_directory . $file)) {
           if (substr($file, strrpos($file, '.')) == $file_extension) {
              $ship_directory_array[] = $file; // array of all shipping modules present in includes/modules/shipping
                }
              }
            }
            sort($ship_directory_array);
            $dir->close();
        }
	
	$existing_customers_query = tep_db_query("select customers_groups_id, customers_groups_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_groups_id ");
	
        $customers = tep_db_fetch_array($customers_query);
        $cInfo = new objectInfo($customers);
    }
  }
?>

<?php

/**
 * header
 */

include_once('html-open.php');
include_once('header.php'); 

?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" href="includes/solomono/css/overwrite.css" type="text/css" />
<?php
  if ($action == 'edit' || $action == 'update') {
?>
<script language="javascript"><!--

function check_form() {
  var error = 0;
  var error_message = "<?php echo JS_ERROR; ?>";

  var customers_firstname = document.customers.customers_firstname.value;
  var customers_lastname = document.customers.customers_lastname.value;
  var customers_email_address = document.customers.customers_email_address.value; 
    
<?php if (ACCOUNT_COMPANY == 'true') echo 'var entry_company = document.customers.entry_company.value;' . "\n"; ?>
<?php if (ACCOUNT_DOB == 'true') echo 'var customers_dob = document.customers.customers_dob.value;' . "\n"; ?>
<?php if (ACCOUNT_STREET_ADDRESS == 'true') echo 'var entry_street_address = document.customers.entry_street_address.value;' . "\n"; ?>
<?php if (ACCOUNT_POSTCODE == 'true') echo 'var entry_postcode = document.customers.entry_postcode.value;' . "\n"; ?>
<?php if (ACCOUNT_CITY == 'true') echo 'var entry_city = document.customers.entry_city.value;' . "\n"; ?>
<?php if (ACCOUNT_TELE == 'true') echo 'var customers_telephone = document.customers.customers_telephone.value;' . "\n"; ?>
  

  if (customers_firstname == "" || customers_firstname.length < <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_FIRST_NAME; ?>";
    error = 1;
  }

  if (customers_lastname == "" || customers_lastname.length < <?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_LAST_NAME; ?>";
    error = 1;
  }

  if (customers_email_address == "" || customers_email_address.length < <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_EMAIL_ADDRESS; ?>";
    error = 1;
  }

<?php if (ACCOUNT_STREET_ADDRESS == 'true') { ?>
  if (entry_street_address == "" || entry_street_address.length < <?php echo ENTRY_STREET_ADDRESS_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_ADDRESS; ?>";
    error = 1;
  }
<?php } ?>

<?php if (ACCOUNT_POSTCODE == 'true') { ?>
  if (entry_postcode == "" || entry_postcode.length < <?php echo ENTRY_POSTCODE_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_POST_CODE; ?>";
    error = 1;
  }
<?php } ?>

<?php if (ACCOUNT_CITY == 'true') { ?>
  if (entry_city == "" || entry_city.length < <?php echo ENTRY_CITY_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_CITY; ?>";
    error = 1;
  }
<?php } ?>

<?php
  if (ACCOUNT_STATE == 'true') {
?>
  if (document.customers.elements['entry_state'].type != "hidden") {
    if (document.customers.entry_state.value == '' || document.customers.entry_state.value.length < <?php echo ENTRY_STATE_MIN_LENGTH; ?> ) {
       error_message = error_message + "<?php echo JS_STATE; ?>";
       error = 1;
    }
  }
<?php
  }
?>

<?php
  if (ACCOUNT_COUNTRY == 'true') {
?>
  if (document.customers.elements['entry_country_id'].type != "hidden") {
    if (document.customers.entry_country_id.value == 0) {
      error_message = error_message + "<?php echo JS_COUNTRY; ?>";
      error = 1;
    }
  }
<?php
}
?>

<?php if (ACCOUNT_TELE == 'true') { ?>
  if (customers_telephone == "" || customers_telephone.length < <?php echo ENTRY_TELEPHONE_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_TELEPHONE; ?>";
    error = 1;
  }
<?php } ?>

  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}
//--></script>
<?php
  }
?>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="SetFocus();">


<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ($action == 'edit' || $action == 'update') {
    $newsletter_array = array(array('id' => '1', 'text' => ENTRY_NEWSLETTER_YES),
                              array('id' => '0', 'text' => ENTRY_NEWSLETTER_NO));
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>
      <tr><?php echo tep_draw_form('customers', FILENAME_CUSTOMERS, tep_get_all_get_params(array('action')) . 'action=update', 'post', 'onSubmit="return check_form();"') . tep_draw_hidden_field('default_address_id', $cInfo->customers_default_address_id); ?>
        <td class="formAreaTitle"><?php echo CATEGORY_PERSONAL; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_FIRST_NAME; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_firstname_error == true) {
      echo tep_draw_input_field('customers_firstname', $cInfo->customers_firstname, 'maxlength="32"') . '&nbsp;' . ENTRY_FIRST_NAME_ERROR;
    } else {
      echo $cInfo->customers_firstname . tep_draw_hidden_field('customers_firstname');
    }
  } else {
    echo tep_draw_input_field('customers_firstname', $cInfo->customers_firstname, 'maxlength="32"', true);
  }
?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_LAST_NAME; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_lastname_error == true) {
      echo tep_draw_input_field('customers_lastname', $cInfo->customers_lastname, 'maxlength="32"') . '&nbsp;' . ENTRY_LAST_NAME_ERROR;
    } else {
      echo $cInfo->customers_lastname . tep_draw_hidden_field('customers_lastname');
    }
  } else {
    echo tep_draw_input_field('customers_lastname', $cInfo->customers_lastname, 'maxlength="32"', true);
  }
?></td>
          </tr>
<?php
    if (ACCOUNT_DOB == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_DATE_OF_BIRTH; ?></td>
            <td class="main">

<?php
    if ($error == true) {
      if ($entry_date_of_birth_error == true) {
        echo tep_draw_input_field('customers_dob', tep_date_short($cInfo->customers_dob), 'maxlength="10"') . '&nbsp;' . ENTRY_DATE_OF_BIRTH_ERROR;
      } else {
        echo $cInfo->customers_dob . tep_draw_hidden_field('customers_dob');
      }
    } else {
      echo tep_draw_input_field('customers_dob', tep_date_short($cInfo->customers_dob), 'maxlength="10"', true);
    }
?></td>
          </tr>
<?php
    }
?>
          <tr>
            <td class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_email_address_error == true) {
      echo tep_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR;
    } elseif ($entry_email_address_check_error == true) {
      echo tep_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_CHECK_ERROR;
    } elseif ($entry_email_address_exists == true) {
      echo tep_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96"') . '&nbsp;' . ENTRY_EMAIL_ADDRESS_ERROR_EXISTS;
    } else {
      echo $customers_email_address . tep_draw_hidden_field('customers_email_address');
    }
  } else {
    echo tep_draw_input_field('customers_email_address', $cInfo->customers_email_address, 'maxlength="96"', true);
  }
?></td>
          </tr>
<?php
    if (ACCOUNT_TELE == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_TELEPHONE_NUMBER; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_telephone_error == true) {
      echo tep_draw_input_field('customers_telephone', $cInfo->customers_telephone, 'maxlength="32"') . '&nbsp;' . ENTRY_TELEPHONE_NUMBER_ERROR;
    } else {
      echo $cInfo->customers_telephone . tep_draw_hidden_field('customers_telephone');
    }
  } else {
    echo tep_draw_input_field('customers_telephone', $cInfo->customers_telephone, 'maxlength="32"', true);
  }
?></td>
          </tr>
<?php
}
?>
<?php
    if (ACCOUNT_STREET_ADDRESS == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_STREET_ADDRESS; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_street_address_error == true) {
      echo tep_draw_input_field('entry_street_address', $cInfo->entry_street_address, 'maxlength="64"') . '&nbsp;' . ENTRY_STREET_ADDRESS_ERROR;
    } else {
      echo $cInfo->entry_street_address . tep_draw_hidden_field('entry_street_address');
    }
  } else {
    echo tep_draw_input_field('entry_street_address', $cInfo->entry_street_address, 'maxlength="64"', true);
  }
?></td>
          </tr>
<?php
}
?>
        </table></td>
      </tr>
      <tr>
        <td ><table border="0" cellspacing="2" cellpadding="2">



<?php
    if (ACCOUNT_POSTCODE == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_POST_CODE; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_post_code_error == true) {
      echo tep_draw_input_field('entry_postcode', $cInfo->entry_postcode, 'maxlength="8"') . '&nbsp;' . ENTRY_POST_CODE_ERROR;
    } else {
      echo $cInfo->entry_postcode . tep_draw_hidden_field('entry_postcode');
    }
  } else {
    echo tep_draw_input_field('entry_postcode', $cInfo->entry_postcode, 'maxlength="8"', true);
  }
?></td>
          </tr>
<?php
}
?>
<?php
    if (ACCOUNT_CITY == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_CITY; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_city_error == true) {
      echo tep_draw_input_field('entry_city', $cInfo->entry_city, 'maxlength="32"') . '&nbsp;' . ENTRY_CITY_ERROR;
    } else {
      echo $cInfo->entry_city . tep_draw_hidden_field('entry_city');
    }
  } else {
    echo tep_draw_input_field('entry_city', $cInfo->entry_city, 'maxlength="32"', true);
  }
?></td>
          </tr>
<?php
}
?>
<?php
    if (ACCOUNT_STATE == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_STATE; ?></td>
            <td class="main">
<?php
    $entry_state = tep_get_zone_name($cInfo->entry_country_id, $cInfo->entry_zone_id, $cInfo->entry_state);
    if ($error == true) {
      if ($entry_state_error == true) {
        if ($entry_state_has_zones == true) {
          $zones_array = array();
          $zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . tep_db_input($cInfo->entry_country_id) . "' order by zone_name");
          while ($zones_values = tep_db_fetch_array($zones_query)) {
            $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
          }
          echo preg_replace('#class="[^"]*"#', '', tep_draw_pull_down_menu('entry_state', $zones_array)) . '&nbsp;' . ENTRY_STATE_ERROR;
        } else {
          echo tep_draw_input_field('entry_state', tep_get_zone_name($cInfo->entry_country_id, $cInfo->entry_zone_id, $cInfo->entry_state)) . '&nbsp;' . ENTRY_STATE_ERROR;
        }
      } else {
        echo $entry_state . tep_draw_hidden_field('entry_zone_id') . tep_draw_hidden_field('entry_state');
      }
    } else {
      echo tep_draw_input_field('entry_state', tep_get_zone_name($cInfo->entry_country_id, $cInfo->entry_zone_id, $cInfo->entry_state));
    }

?></td>
         </tr>
<?php
    }
?>
<?php
    if (ACCOUNT_COUNTRY == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_COUNTRY; ?></td>
            <td class="main">
<?php
  if ($error == true) {
    if ($entry_country_error == true) {
      echo preg_replace('#class="[^"]*"#', '', tep_draw_pull_down_menu('entry_country_id', tep_get_countries(), $cInfo->entry_country_id)) . '&nbsp;' . ENTRY_COUNTRY_ERROR;
    } else {
      echo tep_get_country_name($cInfo->entry_country_id) . tep_draw_hidden_field('entry_country_id');
    }
  } else {
    echo preg_replace('#class="[^"]*"#', '', tep_draw_pull_down_menu('entry_country_id', tep_get_countries(), $cInfo->entry_country_id));
  }
?></td>
          </tr>
<?php
}
?>
        </table></td>
      </tr>
<?php
    if (ACCOUNT_NEWS == 'true') {
?>      
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo CATEGORY_OPTIONS; ?></td>
      </tr>
<?php
}
?>
      <tr>
        <td ><table border="0" cellspacing="2" cellpadding="2">
<?php
    if (ACCOUNT_NEWS == 'true') {
?>          <tr>
            <td class="main"><?php echo ENTRY_NEWSLETTER; ?></td>
            <td class="main">
<?php
  if ($processed == true) {
    if ($cInfo->customers_newsletter == '1') {
      echo ENTRY_NEWSLETTER_YES;
    } else {
      echo ENTRY_NEWSLETTER_NO;
    }
    echo tep_draw_hidden_field('customers_newsletter');
  } else {
    echo preg_replace('#class="[^"]*"#', '', tep_draw_pull_down_menu('customers_newsletter', $newsletter_array, (($cInfo->customers_newsletter == '1') ? '1' : '0')));
  }
?></td>
</td>
</tr>
<?php
}
?>
</table>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo DISCOUNT_OPTIONS; ?></td>
      </tr>

      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">


     <!--TotalB2B start-->
	 <tr>
        <td class="main" width="500"><?php echo ENTRY_CUSTOMERS_DISCOUNT; ?></td>
        <td class="main">
              <select name="customers_discount_sign">
                 <option name="minus" value="-" <?php if (strstr($cInfo->customers_discount,"-")) echo "selected=\"selected\"" ?>>-</option>
                 <option name="plus" value="+" <?php if (strstr($cInfo->customers_discount,"+")) echo "selected=\"selected\"" ?>>+</option>
              </select>&nbsp;<?php echo tep_draw_input_field('customers_discount', substr($cInfo->customers_discount,1,strlen($cInfo->customers_discount)), 'maxlength="9"'); ?>&nbsp;%
        </td>
     </tr>
	 <tr>
       <td class="main"><?php echo ENTRY_CUSTOMERS_GROUPS_NAME; ?></td>
         <?php 
             $groups_query = tep_db_query("select customers_groups_id, customers_groups_name from " . TABLE_CUSTOMERS_GROUPS ." order by customers_groups_name");
             while($groups = tep_db_fetch_array($groups_query)) {
                $groups_array[] = array('text' => $groups['customers_groups_name'],
                                        'id' => $groups['customers_groups_id']);
             }
         ?>
        <td class="main"><?php echo preg_replace('#class="[^"]*"#', '', tep_draw_pull_down_menu('customers_groups_id', $groups_array, $customers['customers_groups_id'])); ?></td>
     </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
        <td class="main"><b><?php echo addDoubleDot(TEXT_CUST_NOTIFY); ?></b> <?php echo tep_draw_checkbox_field('notify', '', true); ?></td>
      </tr>    
	 <tr>
       <td class="main" colspan="2"><small><?php echo TEXT_HELP_TEXT; ?></small></td>
     </tr>
     <!--TotalB2B end-->


          </tr>
        </table></td>
      </tr>
	 </table>
	</td>
      </tr>
	 </table>
	</td>
      </tr>
      <tr>
        <td align="right" class="main"><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('action'))) .'">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'; ?></td>
      </tr></form>
<?php
  } else {
?>
	<tr>
		<td>
		<table border="0" width="400" cellspacing="0" cellpadding="0">
			<tr>
				<?php
					$groups_array[] = array('text' => TEXT_CUST_ALL,'id' => 0);
					$groups_query = tep_db_query("select customers_groups_id, customers_groups_name from " . TABLE_CUSTOMERS_GROUPS ." order by customers_groups_id");
					while($groups = tep_db_fetch_array($groups_query)) {
						$groups_array[] = array(
							'text' => $groups['customers_groups_name'],
							'id' => $groups['customers_groups_id']
						);
					}
				?>
				<form id="xls_form" style="padding:0;margin:0;" method="post" action="../includes/modules/pricexls/xls_customers.php" name="xls"> 
          <td class="main">
            <?php echo addDoubleDot(TEXT_CUST_XLS); ?> <?php echo preg_replace('#class="[^"]*"#', '', tep_draw_pull_down_menu('customers_groups_id_xls', $groups_array, $customers['customers_groups_id'])); ?>
						<input type="hidden" name="language" value="<?php echo $language; ?>">
            <input type="hidden" name="db_name" value="<?php echo $db_name; ?>">
            <input type="submit" value="<?php echo TEXT_CUST_XLS; ?>">
					</td>
				</form>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr><?php echo tep_draw_form('search', FILENAME_CUSTOMERS, '', 'get'); ?>
				<td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
				<td class="pageHeading" align="right">
					<?php echo tep_draw_separator('pixel_trans.png', 1, HEADING_IMAGE_HEIGHT); ?>
				</td>
				<td class="smallText" align="right">
					<?php echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search'); ?>
				</td>
			</form>
			</tr>
        </table></td>
	</tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td colspan="11">
                 <strong><?php echo addDoubleDot(TEXT_CUST_PERPAGE); ?></strong>
                 <?php $stro=$_SERVER['PHP_SELF'] .'?'. tep_get_all_get_params(); echo '<a href="'. $stro  . 'numb=50">50</a>, <a href="'. $stro  . 'numb=500">500</a>, <a href="'. $stro  . 'numb=1000">1000</a>'; ?>
                </td>
              </tr>
              <tr class="dataTableHeadingRow">
<?php
  $HEADING_LASTNAME = TABLE_HEADING_LASTNAME .'&nbsp;';
  $HEADING_LASTNAME .= '<a href="' . $_SERVER['PHP_SELF'] . '?sort=lastname&order=ascending">';
  $HEADING_LASTNAME .= '+</a>';
  $HEADING_LASTNAME .= '<a href="' . $_SERVER['PHP_SELF'] . '?sort=lastname&order=decending">';
  $HEADING_LASTNAME .= '-</a>';
  $HEADING_FIRSTNAME = TABLE_HEADING_FIRSTNAME .'&nbsp;';
  $HEADING_FIRSTNAME .= '<a href="' . $_SERVER['PHP_SELF'] . '?sort=firstname&order=ascending">';
  $HEADING_FIRSTNAME .= '+</a>';
  $HEADING_FIRSTNAME .= '<a href="' . $_SERVER['PHP_SELF'] . '?sort=firstname&order=decending">';
  $HEADING_FIRSTNAME .= '-</a>';
  $HEADING_ACCOUNT_CREATED = TABLE_HEADING_ACCOUNT_CREATED .'&nbsp;';
  $HEADING_ACCOUNT_CREATED .= '<a href="' . $_SERVER['PHP_SELF'] . '?sort=account_created&order=ascending">';
  $HEADING_ACCOUNT_CREATED .= '+</a>';
  $HEADING_ACCOUNT_CREATED .= '<a href="' . $_SERVER['PHP_SELF'] . '?sort=account_created&order=decending">';
  $HEADING_ACCOUNT_CREATED .= '-</a>';

  
  $HEADING_SUM = TEXT_CUST_SUM.'&nbsp;';
  $HEADING_SUM .= '<a href="' . $_SERVER['PHP_SELF'] . '?sort=sum&order=ascending">';
  $HEADING_SUM .= '+</a>';
  $HEADING_SUM .= '<a href="' . $_SERVER['PHP_SELF'] . '?sort=sum&order=decending">';
  $HEADING_SUM .= '-</a>';

?>
                <td class="dataTableHeadingContent"><?php echo $HEADING_LASTNAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo $HEADING_FIRSTNAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TEXT_CUST_CITY; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo $HEADING_ACCOUNT_CREATED; ?></td>
                <td class="dataTableHeadingContent"><?php echo $HEADING_SUM; ?></td>
				<!--TotalB2B start-->
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_CUSTOMERS_GROUP; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_CUSTOMERS_STATUS; ?></td>
				<!--TotalB2B end-->                

              </tr>
<?php
    $search = '';
    if (isset($_GET['search']) && tep_not_null($_GET['search'])) {
      $keywords = tep_db_input(tep_db_prepare_input($_GET['search']));
      $search = "where c.customers_lastname like '%" . $keywords . "%' or c.customers_firstname like '%" . $keywords . "%' or c.customers_email_address like '%" . $keywords . "%'";
    }
    
    // BOM Mod:provide an order by option
    $sortorder = 'order by c.customers_firstname';
    switch ($_GET["sort"]) {
      case 'lastname':
        if($_GET["order"]==ascending) {
          $sortorder = 'group by c.customers_id, c.customers_firstname order by c.customers_lastname asc';
        } else {
          $sortorder = 'group by c.customers_id, c.customers_firstname order by c.customers_lastname desc';
        }
        break;
      case 'firstname':
        if($_GET["order"]==ascending) {
          $sortorder = 'group by c.customers_id, c.customers_firstname order by c.customers_firstname asc';
        } else {
          $sortorder = 'group by c.customers_id, c.customers_firstname order by c.customers_firstname desc';
        }
        break;

      case 'nuber_logons':
        if($_GET["order"]==ascending) {
          $sortorder = 'group by c.customers_id, c.customers_firstname order by ci.customers_info_number_of_logons asc';
        } else {
          $sortorder = 'group by c.customers_id, c.customers_firstname order by ci.customers_info_number_of_logons desc';
        }
        break;
      case 'sum':
        if($_GET["order"]==ascending) {
          $sortorder = 'group by c.customers_id, c.customers_firstname order by ordersum asc';
        } else {
          $sortorder = 'group by c.customers_id, c.customers_firstname order by ordersum desc';
        }
        break;

      default:
        if($_GET["order"]==ascending) {
          $sortorder = 'group by c.customers_id, c.customers_firstname order by c.customers_id asc';
        } else {
          $sortorder = 'group by c.customers_id, c.customers_firstname order by c.customers_id desc';
        }
        break;
    }
    
    
	//TotalB2B start
		$customers_query_raw = "select c.customers_id, c.customers_lastname, c.customers_firstname, c.customers_status, c.customers_groups_id, ci.customers_info_date_account_created, a.entry_city as city, sum(ot.value) as ordersum, a.entry_country_id from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a on c.customers_id = a.customers_id and c.customers_default_address_id = a.address_book_id left join " . TABLE_CUSTOMERS_INFO . " ci on c.customers_id = ci.customers_info_id left join " . TABLE_ORDERS . " o on c.customers_id = o.customers_id left join " . TABLE_ORDERS_TOTAL . " ot on o.orders_id = ot.orders_id and ot.class='ot_total' " . $search . $sortorder ;
    
    $numb_per_page = 50;
    switch ($_GET['numb']) {
      case '100': 
        $numb_per_page = 100;
        break;
      case '500': 
        $numb_per_page = 500;
        break;
      case '1000': 
        $numb_per_page = 1000;
        break;
      case '5000': 
        $numb_per_page = 5000;
        break;
      default: 
        $numb_per_page = 50;
        break;
        }
     
    $customers_split = new splitPageResults($_GET['page'], $numb_per_page, $customers_query_raw, $customers_query_numrows);
    $customers_query = tep_db_query($customers_query_raw);
//    echo mysql_num_rows($customers_query);
    while ($customers = tep_db_fetch_array($customers_query)) {
     $b2b_coll = tep_db_query ("select customers_groups_id, customers_groups_name, color_bar, customers_groups_discount FROM ". TABLE_CUSTOMERS_GROUPS ." where customers_groups_id = ". (int)$customers['customers_groups_id'] ."");
	   $b2b = tep_db_fetch_array($b2b_coll);

      if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $customers['customers_id']))) && !isset($cInfo)) {
        $info_query = tep_db_query("select customers_info_date_account_created as date_account_created, customers_info_date_account_last_modified as date_account_last_modified, customers_info_date_of_last_logon as date_last_logon, customers_info_number_of_logons as number_of_logons from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . $customers['customers_id'] . "'");
        $info = tep_db_fetch_array($info_query);
      
        $country_query = tep_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$customers['entry_country_id'] . "'");
        $country = tep_db_fetch_array($country_query);

		$customer_info = array_merge((array)$country, (array)$info);

		$cInfo_array = array_merge((array)$customers, (array)$customer_info);

        $cInfo = new objectInfo($cInfo_array);
      }

      if (isset($cInfo) && is_object($cInfo) && ($customers['customers_id'] == $cInfo->customers_id)) {
        echo '          <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=edit') . '\'">' . "\n";
      } else {
        echo '          <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID')) . 'cID=' . $customers['customers_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo $customers['customers_lastname']; ?></td>
                <td class="dataTableContent"><?php echo $customers['customers_firstname']; ?></td>
                <td class="dataTableContent"><?php echo $customers['city']; ?></td>
                <td class="dataTableContent" style="text-align:center;color:#777;"><?php echo tep_date_short($customers['customers_info_date_account_created']); ?></td>   
                <td class="dataTableContent"><b><?php echo ($customers['ordersum']>0?$currencies->display_price($customers['ordersum'],0):''); ?></b></td>
                
				<!--TotalB2B start-->
                <td class="dataTableContent" style="background:<?php echo $b2b['color_bar'];?>; text-align:center"><font color="#364189"><b>
<?php   
// echo $b2b['customers_groups_name'], TEXT_GROUP, $color['color_bar'], $b2b['customers_groups_discount'],  TEXT_PERCENT;
echo $b2b['customers_groups_name'];

?>

                </b></font></td>
<!--                <td class="dataTableContent" style="background:#ffffff; text-align:center">
                
<?php
/*      $b2b1_query = tep_db_query("select customers_discount as discount from " . TABLE_CUSTOMERS . " where customers_id = '" . $customers['customers_id'] . "'");
      $b2b1 = tep_db_fetch_array($b2b1_query);

if ($b2b1['discount'] == '0') {
echo NO_PERSONAL_DISCOUNT;
} else {
echo $b2b1['discount'], TEXT_PERCENT;
}
*/
?>
                
                </td>
-->

				<td class="dataTableContent" style="text-align:center">
				<?php   if ($customers['customers_status'] == '1') {
                   echo '<a href="' . tep_href_link(FILENAME_CUSTOMERS, 'action=setflag&flag=0&cID=' . $customers['customers_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_RED_LIGHT, 16, 16) . '</a>';
                } else {
                    echo '<a href="' . tep_href_link(FILENAME_CUSTOMERS, 'action=setflag&flag=1&cID=' . $customers['customers_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 16, 16) . '</a>';
                } ?></td>

                <!--TotalB2B end-->
                
                
        <!--        <td class="dataTableContent" style="background:#ffffff; text-align:center"><?php if (isset($cInfo) && is_object($cInfo) && ($customers['customers_id'] == $cInfo->customers_id)) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID')) . 'cID=' . $customers['customers_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
          -->
              </tr>
<?php
    }
?>
              <tr>
                <td colspan="7"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $customers_split->display_count($customers_query_numrows, $numb_per_page, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_CUSTOMERS); ?></td>
                    <td class="smallText" align="right"><?php echo $customers_split->display_links($customers_query_numrows, $numb_per_page, $numb_per_page, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y', 'cID'))); ?></td>
                  </tr>
<?php  
    if (isset($_GET['search']) && tep_not_null($_GET['search'])) {
?>
                  <tr>
                    <td align="right" colspan="2"><?php echo '<a href="' . tep_href_link(FILENAME_CUSTOMERS) . '">' . tep_text_button(BUTTON_RESET_NEW) . '</a>'; ?></td>
                  </tr>
<?php
    }
?>
                </table></td>
              </tr>

            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'confirm':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_CUSTOMER . '</b>');

      $contents = array('form' => tep_draw_form('customers', FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_DELETE_INTRO . '<br><br><b>' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>');
      break;
    default:
      if (isset($cInfo) && is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=edit') . '">' . tep_text_button(BUTTON_EDIT_NEW) . '</a> <a href="' . tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_id . '&action=confirm') . '">' . tep_text_button(BUTTON_DELETE_NEW) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS, 'cID=' . $cInfo->customers_id) . '">' . tep_text_button(BUTTON_ORDERS_NEW) . '</a> <a href="' . tep_href_link(FILENAME_MAIL, 'selected_box=tools&customer=' . $cInfo->customers_email_address) . '">' . tep_text_button(BUTTON_EMAIL_NEW) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_DATE_ACCOUNT_CREATED . ' ' . tep_date_short($cInfo->date_account_created));
        $contents[] = array('text' => '<br>' . TEXT_DATE_ACCOUNT_LAST_MODIFIED . ' ' . tep_date_short($cInfo->date_account_last_modified));
        $contents[] = array('text' => '<br>' . TEXT_INFO_DATE_LAST_LOGON . ' '  . tep_date_short($cInfo->date_last_logon));
        $contents[] = array('text' => '<br>' . TEXT_INFO_NUMBER_OF_LOGONS . ' ' . $cInfo->number_of_logons);
        $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY . ' ' . $cInfo->countries_name);

      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  } 
?>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>

<?php

/**
 * footer
 */

include_once('footer.php');
include_once('html-close.php'); 

?>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
