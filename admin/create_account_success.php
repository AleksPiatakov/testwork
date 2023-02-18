<?php
/*
  $Id: create_account_success.php,v 1.1 2003/09/24 14:33:18 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
   
  THIS IS BETA - Use at your own risk!
  Step-By-Step Manual Order Entry Verion 0.5
  Customer Entry through Admin 
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT_SUCCESS);


?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">

  <title><?php echo TITLE ?></title>

<base href="<?php echo HTTP_SERVER . DIR_WS_ADMIN; ?>">
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_smend //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            
            <td valign="top" class="main"><div align="center" class="pageHeading"><?php echo HEADING_TITLE; ?></div><br><?php echo TEXT_ACCOUNT_CREATED; ?><br><br></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="right"><?php echo '<a href="' . $origin_href . '">' . tep_text_button(BUTTON_BACK_NEW) . '</a>'; ?>&nbsp;&nbsp;<?php echo '<a href="' . FILENAME_CREATE_ORDER . '">' . tep_text_button(BUTTON_CONTINUE_NEW) . '</a>'; ?></td>
      </tr>
    </table></td>
<!-- body_text_smend //-->

  </tr>
</table>
<!-- body_smend //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_smend //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
