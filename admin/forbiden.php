<?php
/*
  $Id: forbiden.php,v 1.2 2003/09/24 13:57:06 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  
  $current_boxes = DIR_FS_ADMIN . DIR_WS_BOXES;
  
?>
<?php
include_once('html-open.php');
include_once('header.php');
?>

  <!-- body //-->
  <div class="container backup">
    <div class="wrapper-title">
      <div class="bg-light lter ng-scope">
        <h1 class="m-n font-thin h3"><?php echo HEADING_TITLE; ?></h1>
      </div>
    </div>
    <!-- body_text //-->
          <table border="0" width="100%" cellspacing="0" cellpadding="2" align="center">
            <tr class="dataTableHeadingRow">
              <td class="dataTableHeadingContent"><?php echo NAVBAR_TITLE; ?></td>
            </tr>
            <tr class="dataTableRow">
              <td style="text-align:left;" class="dataTableContent"><?php echo TEXT_MAIN; ?></td>
            </tr>
            <tr class="dataTableRow">
              <td style="text-align:left;"><?php echo '&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT) . '"><input type="button" class="btn btn-default" value="'.BUTTON_BACK_NEW.'" /></a>&nbsp;'; ?></td>
            </tr>
          </table>
    <!-- body_text_smend //-->
  </div>
<!-- body_smend //-->
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>