<?php
/*
  $Id: mail.php,v 1.31 2003/06/20 00:37:51 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

if (!empty($_GET['term'])) {
    $search = $_GET['term'];
    $sql="SELECT DISTINCT c.customers_id as id,
                          c.customers_firstname as first_name,
                          c.customers_lastname as last_name
                     FROM customers c
                    WHERE c.customers_id LIKE '{$search}%' OR c.customers_firstname LIKE '%{$search}%' OR c.customers_lastname LIKE '%{$search}%'
                       OR c.customers_telephone LIKE '%{$search}%' OR c.customers_email_address LIKE '%{$search}%'
                    LIMIT 10";
    $result = array();
    $sql = tep_db_query($sql);
    if ($count) {
        return $sql->num_rows;
    }
    while ($row = tep_db_fetch_array($sql)) {
        $result[] = $row;
    }
    echo json_encode($result);
    exit;
}

if(isset($_POST['action']) && $_POST['action'] == 'getCustomer'){
    $sql="SELECT DISTINCT c.customers_firstname, c.customers_lastname, c.customers_email_address
                 FROM customers c
                 WHERE c.customers_id = '{$_POST['id']}'";
    $result = array();
    $sql = tep_db_query($sql);
    if ($count) {
        return $sql->num_rows;
    }
    while ($row = tep_db_fetch_array($sql)) {
        $result[] = $row;
    }
    echo json_encode($result);
    exit;
}

    if(isset($_POST['email'])) $_POST['customers_email_address'] = $_POST['email'];
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
if(!$_POST['customers_email_address']){
    $_POST['customers_email_address'] = tep_db_prepare_input($_POST['search']);
}
  if ( ($action == 'send_email_to_user') && isset($_POST['customers_email_address']) ) {
    switch ($_POST['customers_email_address']) {
      case '***':
        $mail_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS);
        $mail_sent_to = TEXT_ALL_CUSTOMERS;
        break;
      case '**D':
        $mail_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_newsletter = '1'");
        $mail_sent_to = TEXT_NEWSLETTER_CUSTOMERS;
        break;
     default:
        $customers_email_address = tep_db_prepare_input($_POST['customers_email_address']);

        $mail_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($customers_email_address) . "'");
        $mail_sent_to = $_POST['customers_email_address'];
        break;
    }

    $from = tep_db_prepare_input($_POST['from']);
    $subject = tep_db_prepare_input($_POST['subject']);
    $message = tep_db_prepare_input($_POST['message']);

    while ($mail = tep_db_fetch_array($mail_query)) {
      tep_mail($mail['customers_firstname'] . ' ' . $mail['customers_lastname'], $mail['customers_email_address'], $subject, $message, STORE_OWNER, $from);
    }
    if ($mail_query->num_rows == 0 && !empty($_POST['customers_email_address'])) {
        tep_mail(TEXT_CUSTOMER . ' ' . $_POST['customers_email_address'], $_POST['customers_email_address'], $subject, $message, STORE_OWNER, $from);
    }

    tep_redirect(tep_href_link(FILENAME_MAIL, 'mail_sent_to=' . urlencode($mail_sent_to)));
  }

  if ( ($action == 'preview') && !isset($_POST['customers_email_address']) ) {
    $messageStack->add(ERROR_NO_CUSTOMER_SELECTED, 'error');
  }

  if (isset($_GET['mail_sent_to'])) {
    $messageStack->add(sprintf(NOTICE_EMAIL_SENT_TO, $_GET['mail_sent_to']), 'success');
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
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">


<!-- body //-->
<div class="container">
    <div>
        <?php include DIR_WS_TABS . "email_tools.php"; ?>
    </div>
    <div class="wrapper-title">
        <div class="bg-light lter ng-scope">
            <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE; ?></h1>
        </div>
    </div>

<!-- body_text //-->

<table border="0" width="100%" cellspacing="0" cellpadding="2">
                          <?php
                          if ( ($action == 'preview') && isset($_POST['customers_email_address']) ) {
                              switch ($_POST['customers_email_address']) {
                                  case '***':
                                      $mail_sent_to = TEXT_ALL_CUSTOMERS;
                                      break;
                                  case '**D':
                                      $mail_sent_to = TEXT_NEWSLETTER_CUSTOMERS;
                                      break;
                                  default:
                                      $mail_sent_to = $_POST['customers_email_address'];
                                      break;
                              }
                              ?>
                              <tr><?php echo tep_draw_form('mail', FILENAME_MAIL, 'action=send_email_to_user'); ?>
                                  <td><table border="0" width="100%" cellpadding="0" cellspacing="2" class="sendmail">
                                          <tr>
                                              <td class="smallText"><b><?php echo TEXT_CUSTOMER; ?></b><br><?php echo $mail_sent_to; ?></td>
                                          </tr>
                                          <tr>
                                              <td class="smallText"><b><?php echo TEXT_FROM; ?></b><br><?php echo htmlspecialchars(stripslashes($_POST['from'])); ?></td>
                                          </tr>
                                          <tr>
                                              <td class="smallText"><b><?php echo TEXT_SUBJECT; ?></b><br><?php echo htmlspecialchars(stripslashes($_POST['subject'])); ?></td>
                                          </tr>
                                          <tr>
                                              <td class="smallText"><b><?php echo TEXT_MESSAGE; ?></b><br><?php echo stripslashes($_POST['message']); ?></td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <?php
                                                  /* Re-Post all POST'ed variables */
                                                  reset($_POST);
                                                  foreach ($_POST as $key => $value) {
                                                  // while (list($key, $value) = each($_POST)) {
                                                      if (!is_array($_POST[$key])) {
                                                          echo tep_draw_hidden_field($key, htmlspecialchars(stripslashes($value)));
                                                      }
                                                  }
                                                  ?>
                                                  <table border="0" width="100%" cellpadding="0" cellspacing="2">
                                                      <tr>
                                                          <td align="right">        
                                                            <?php echo '<a href="' . tep_href_link(FILENAME_MAIL) . '" class="btn btn-default">' . IMAGE_CANCEL . '</a>'; ?>
                                                            <input type="submit" class="btn btn-success" value="<?php echo IMAGE_SEND_EMAIL; ?>">
                                                            
                                                          </td>
                                                      </tr>
                                                  </table></td>
                                          </tr>
                                      </table></td>
                                  </form></tr>
                              <?php
                          } else {
                              ?>

                              <tr>
                                  <td>
                                      <form action="<?php echo FILENAME_MAIL.'?action=preview'?>" name="mail" method="post">
                                      <table border="0" cellpadding="0" cellspacing="2" class="sendmail">
                                          <?php 
                                                $customers[] = array('id' => '', 'text' => TEXT_SINGLE_CUSTOMER);
                                                $customers[] = array('id' => '***', 'text' => TEXT_ALL_CUSTOMERS);
                                                $customers[] = array('id' => '**D', 'text' => TEXT_NEWSLETTER_CUSTOMERS);
                                          ?>
                                          <tr>
                                              <td class="main" width="25%"><?php echo addDoubleDot(TEXT_EMAIL_RECIPIENT); ?></td>
                                              <td>
                                                  <?php echo tep_draw_pull_down_menu('customers_email_address', $customers, (isset($_GET['customer']) ? $_GET['customer'] : ''));?>
                                              </td>
                                          </tr>
                                          <tr id="customer_field">
                                              <td class="main"><?php echo addDoubleDot(TEXT_SELECT_CUSTOMER); ?></td>
                                              <td id="res_text">
                                                  <input type="text" value="" name="search" class="form-control  ui-autocomplete-input" id="search" autocomplete="off" placeholder="<?php echo TEXT_SELECT_CUSTOMER_PLACEHOLDER; ?>">
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="main"><?php echo TEXT_FROM; ?></td>
                                              <td><?php echo tep_draw_input_field('from', STORE_OWNER_EMAIL_ADDRESS, 'class="form-control"'); ?></td>
                                          </tr>
                                          <tr>
                                              <td class="main"><?php echo TEXT_SUBJECT; ?></td>
                                              <td><?php echo tep_draw_input_field('subject', '', 'class="form-control"'); ?></td>
                                          </tr>
	                                      <tr>
		                                      <td valign="top" class="main" colspan="2"><?php echo TEXT_MESSAGE; ?></td>
	                                      </tr>
                                          <tr>
                                              <td colspan="2"><?php echo tep_draw_textarea_field('message', 'soft', '60', '15', '', 'class="form-control ckeditor"'); ?></td>
                                          </tr>
                                          <tr>
                                              <td colspan="2" align="right">
                                                  <input type="submit" class="btn btn-success" value="<?php echo IMAGE_SEND_EMAIL; ?>"></td>
                                          </tr>
                                      </table>
                                      </form>
                                  </td>
                                  </tr>
<script src="includes/ckeditor/ckeditor.js"></script>
<script src="includes/ckfinder/ckfinder.js"></script>
<script>
    var editor = CKEDITOR.replace('message', {
        extraPlugins: 'sourcedialog,colorbutton,font,justify,iframe,codemirror',
        on: {
            instanceReady: function() {
                this.dataProcessor.htmlFilter.addRules( {
                    elements: {
                        img: function( el ) {
                            // Add an attribute.
                            if ( !el.attributes.alt )
                                el.attributes.alt = '';

                            // Add some class.
                            if (typeof el.attributes.class === 'undefined' || el.attributes.class.indexOf('img-responsive') == -1){
                                el.addClass( ' img-responsive' );
                            }
                            if (typeof el.attributes.class === 'undefined' || el.attributes.class.indexOf('lazyload') == -1){
                                el.addClass( ' lazyload' );
                            }
                            el.attributes.style = '' ;
                        }
                    }
                });
            }
        }
    });
    CKFinder.setupCKEditor(editor, 'includes/ckfinder/');
</script>  
                              <?php
                          }
                          ?>
                          <!-- body_text_smend //-->
                      </table>
</div>
<!-- body_smend //-->
<script> 
    $(document).ready(function () {
        $('body').on('focus', '#search', function () {
            $("#search").autocomplete({
                source: window.location.pathname,
                delay: 100,
                minLength: 2,
                select: function (event, ui) {
                    //$("#search").closest('form')[0].reset();
                    //show_tooltip('<span style="font-size: 5em;" class="ajax-loader"></span>', 55555, $("#search").closest('form'));
                    $.post(window.location.pathname, {action: "getCustomer", id: ui.item.id}, function (response) {
                        var id = response[0]['customers_email_address'];
                        var textRes = (response[0]['customers_lastname'] + ', ' + response[0]['customers_firstname'] + ' (' + response[0]['customers_email_address'] + ')');

                        $('#id_res').remove();
                        $('select[name="customers_email_address"] option').prop("selected", false);
                        $('#search').val(textRes);
                        $('#res_text').append('<input type="hidden" value="'+id+'" name="email" class="form-control" id="id_res">')
                    }, "json").done(function () {
                        $('.tooltip_own').remove();
                    });
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item) {
                ul.css('z-index', 9999);
                return $("<li>")
                    .append("<div>(" + item.id + ") " + item.first_name + " " + item.last_name + "</div>")
                    .appendTo(ul);
            };
        });
        $('body').on('change', 'select[name="customers_email_address"]', function () {

         //   $('#id_res').remove();
            if($(this).val()!='') $('#customer_field').slideUp(200);
            else $('#customer_field').slideDown(200); 
        })
    });
</script>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_smend //-->
<br>

<?php

/**
 * footer
 */

include_once('footer.php');
include_once('html-close.php'); 

?>

<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
