<?php
/*
  $Id: packingslip.php,v 1.2 2003/09/24 15:18:15 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $oID = tep_db_prepare_input($_GET['oID']);
  $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . tep_db_input($oID) . "'");
  include (DIR_WS_LANGUAGES.$language.'/invoice.php');
  include(DIR_WS_CLASSES . 'order.php');
  $order = new order($oID);
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE . ' - ' . TITLE_PRINT_ORDER . ' #' . $_GET['order_id']; ?></title>
<base href="<?php echo HTTP_SERVER . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="admin/includes/print.css">
</head>
<body marginwidth="10" marginheight="10" topmargin="10" bottommargin="10" leftmargin="10" rightmargin="10">


<div class="delivery_note">

  <div class="top_bar">
    
    <a href="javascript:window.close();" class="close_btn">
        <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"></path></svg>
        <?=PACKINGSLIP_CLOSE_BTN; ?>
    </a>
    
    <script language="JavaScript">
      if (window.print) {
        document.write('<a class="print_btn" href="javascript:;" onClick="javascript:window.print()" onMouseOut=document.imprim.src="<?php echo (DIR_WS_IMAGES . 'printimage.gif'); ?>" onMouseOver=document.imprim.src="<?php echo (DIR_WS_IMAGES . 'printimage_over.gif'); ?>"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M448 192V77.25c0-8.49-3.37-16.62-9.37-22.63L393.37 9.37c-6-6-14.14-9.37-22.63-9.37H96C78.33 0 64 14.33 64 32v160c-35.35 0-64 28.65-64 64v112c0 8.84 7.16 16 16 16h48v96c0 17.67 14.33 32 32 32h320c17.67 0 32-14.33 32-32v-96h48c8.84 0 16-7.16 16-16V256c0-35.35-28.65-64-64-64zm-64 256H128v-96h256v96zm0-224H128V64h192v48c0 8.84 7.16 16 16 16h48v96zm48 72c-13.25 0-24-10.75-24-24 0-13.26 10.75-24 24-24s24 10.74 24 24c0 13.25-10.75 24-24 24z"></path></svg>' + '<?php echo IMAGE_BUTTON_PRINT; ?></a>');
      }
      else document.write ('<h2><?php echo IMAGE_BUTTON_PRINT; ?></h2>')
    </script>

  </div>

  <div class="container">
    
    <div class="head_logo">
      <div class="logo"><img src="<?=HTTP_SERVER . "/" . LOGO_IMAGE?>"></div>
      <div class="logo_text"><?php echo stripcslashes(nl2br('<span>' . STORE_NAME . '</span>' . STORE_ADDRESS)); ?></div>
    </div>

    <div class="inform_box">

      <div class="box_item buyer">
        <div class="top_line"><?php echo ENTRY_SOLD_TO; ?></div>

        <div class="info">
          <div class="name">
            <?php echo $order->customer['name']; ?>
            <span> <?php echo $order->customer['telephone']; ?></span>
          </div>
          <div class="email" href="#">
              <?php echo $order->customer['email_address']; ?>
          </div>
          <?php
          $buyerStr = '';
          if (!empty($order -> delivery['street_address'])) {
              $buyerStr .= $order -> delivery['street_address'] . ',<br>';
          }
          if (!empty($order -> delivery['city'])) {
              $buyerStr .= $order -> delivery['city'] . ', ';
          }
          if(!empty($order->delivery['state'])){
              $buyerStr .= $order->delivery['state'] .', ';
          }
          if(!empty($order->delivery['postcode'])){
              $buyerStr .= $order->delivery['postcode'] .',<br>';
          }
          if(!empty($order->delivery['country'])){
              $buyerStr .= $order->delivery['country'];
          }
          echo $buyerStr
          ?>
        </div>
      </div>

      <div class="box_item seller">
        <div class="top_line"><?= PACKINGSLIP_SELLER_TITLE; ?></div>

        <div class="info">
            <?php echo stripcslashes(nl2br('<span>' . STORE_NAME . '</span><br>' . STORE_OWNER_EMAIL_ADDRESS .'<br>' . STORE_ADDRESS)); ?>
            <?php echo renderArticle('phones');?><br>
          <p><?php echo stripcslashes(STORE_BANK_INFO); ?></p>
        </div>
      </div>

      <div class="box_item booking">
        <div class="top_line"><?php echo PACKINGSLIP_BOX_ORDER . $_GET['oID']; ?></div>

        <div class="info info-booking">
            <div class="data">
                <?=PACKINGSLIP_BOX_ORDER_DATE; ?>
                <span><?php echo date('d/m/y', strtotime($order->info['date_purchased'])); ?></span>
            </div>

            <div class="pay">
                <?php echo ENTRY_PAYMENT_METHOD; ?>
                <span><?php echo $order->info['payment_method']; ?></span>
            </div>

            <div class="method-delivery">
                <?=PACKINGSLIP_BOX_ORDER_DELIVERY; ?>
                <span>
                    <?= ($order->delivery["shipping_method_code"] === 'nwposhtanew') ?
                        $order->info['shipping_name'] . PHP_EOL . $order->delivery["nwposhta_address"] :
                        $order->info['shipping_name']; ?>
                </span>
            </div>
        </div>
      </div>
      
    </div>

    <div class="product_list">
      <div class="top_line">
          <span style="width: 180px"><?= TABLE_HEADING_PRODUCTS; ?></span>
          <span><?= TABLE_HEADING_PRODUCTS_QUANTITY; ?></span>
          <span><?= TABLE_HEADING_PRODUCTS_PRICE; ?></span>
          <span><?= TABLE_HEADING_PRODUCTS_TOTAL; ?></span>
      </div>

      <?php
        for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
          echo '<div class="product_list-item">' . '<div class="item">' .
          '<div>' . $order->products[$i]['name'] . '</div>' .
            '<p>' . TABLE_HEADING_PRODUCTS_MODEL .  ': ' . $order->products[$i]['model'] . '</p></div>' .
            '<span>x ' . $order->products[$i]['qty'] . '</span>' .
            '<span>' .  $currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']) . '</span>' .
            '<span>' . $currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</span>' .
          '</div>';
        }
      ?>

      <div class="footer">
          <div class="score_box" style="margin-bottom: 30px;">
              <?php
              $modulesTitles = [
                  'ot_better_together' => 'MODULE_ORDER_TOTAL_BETTER_TOGETHER_TITLE',
                  'ot_country_discount' => 'MODULE_ORDER_TOTAL_COUNTRY_DISCOUNT_TEXT_TITLE',
                  'ot_coupon' => 'MODULE_ORDER_TOTAL_COUPON_TITLE',
                  'ot_gv' => 'MODULE_ORDER_TOTAL_GV_TITLE',
                  'ot_lev_discount' => 'MODULE_LEV_DISCOUNT_TITLE',
                  'ot_loworderfee' => 'MODULE_ORDER_TOTAL_LOWORDERFEE_TITLE',
                  'ot_payment' => 'MODULE_PAYMENT_DISC_TITLE',
                  'ot_qty_discount' => 'MODULE_QTY_DISCOUNT_TITLE',
                  'ot_shipping' => 'MODULE_ORDER_TOTAL_SHIPPING_TITLE',
                  'ot_subtotal' => 'MODULE_ORDER_TOTAL_SUBTOTAL_TITLE',
                  'ot_tax' => 'MODULE_ORDER_TOTAL_TAX_TITLE',
                  'ot_total' => 'MODULE_ORDER_TOTAL_TOTAL_TITLE'
              ];
              for ($i = 0; $i < count($order->totals); $i++) { ?>
                    <div class="score-line">
                        <?php
                        //default title from DB->orders_total
                        $title = $order->totals[$i]['title'];
                        //change title on title of appropriate module
                        switch ($order->totals[$i]['class']) {
                            case 'ot_shipping':
                                //get active shipping module
                                $activeShippingModule = $order->delivery["shipping_method_code"];
                                if (!empty($activeShippingModule)) {
                                    //init appropriate shipping module
                                    if (is_file(DIR_FS_CATALOG_MODULES_SHIPPING . $activeShippingModule . '.php')) {
                                        include_once(DIR_FS_CATALOG_MODULES_SHIPPING . $activeShippingModule . '.php');
                                        includeLanguages(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/shipping/' . $activeShippingModule . '.php');
                                    } else {
                                        include_once(DIR_FS_EXT . 'shipping/' . $activeShippingModule . '/' . $activeShippingModule . '.php');
                                        includeLanguages(DIR_FS_EXT . 'shipping/' . $activeShippingModule . '/languages/' . $language . '/' . $activeShippingModule . '.json');
                                    }
                                    $class = $activeShippingModule;
                                    $module = new $class;
                                    $title = $module->title . ': ';
                                }
                                break;
                            default:
                                $moduleTitle = $modulesTitles[$order->totals[$i]['class']];
                                if (isset($moduleTitle)) {
                                    includeLanguages(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/order_total/' . $order->totals[$i]['class'] . '.php');
                                    $title = getConstantValue($moduleTitle) . ': ';
                                }
                        }
                        echo $title . '<div>' . $order->totals[$i]['text'] . '</div>'; ?>
                    </div>
        <?php } ?>
          </div>
        <div class="getting"><?=PACKINGSLIP_GETTING_GOODS; ?></div>
        <div class="painting"><?=PACKINGSLIP_PAINTING_GOODS; ?></div>
      </div> 
      
    </div>

  </div> 
     
</div>


<!-- body_text -->
<!--<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr> 
    <td align="center" class="main"><table align="center" width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr> 
        <td valign="top" align="left" class="main"><script language="JavaScript">
  if (window.print) {
    document.write('<a href="javascript:;" onClick="javascript:window.print()" onMouseOut=document.imprim.src="<?php echo (DIR_WS_IMAGES . 'printimage.gif'); ?>" onMouseOver=document.imprim.src="<?php echo (DIR_WS_IMAGES . 'printimage_over.gif'); ?>"><img src="<?php echo (DIR_WS_IMAGES . 'printimage.gif'); ?>" width="43" height="28" align="absbottom" border="0" name="imprim">' + '<?php echo IMAGE_BUTTON_PRINT; ?></a></center>');
  }
  else document.write ('<h2><?php echo IMAGE_BUTTON_PRINT; ?></h2>')
        </script></td>
        <td align="right" valign="bottom" class="main"><p align="right" class="main"><a href="javascript:window.close();"><img src='images/close_window.jpg' border=0></a></p></td>
      </tr>
    </table></td>
  </tr>
  <tr align="left"> 
    <td class="titleHeading"><?php echo tep_draw_separator('pixel_trans.png', '1', '15'); ?></td>
  </tr>
  <tr> 
    <td><table border="0" align="center" width="100%" cellspacing="0" cellpadding="0">
      <tr> 
        <td><table border="0" align="center" width="75%" cellspacing="0" cellpadding="0">
          <tr> 
            <td class="pageHeading"><?php echo nl2br(defined('STORE_NAME_ADDRESS') ? STORE_NAME_ADDRESS : ''); ?></td>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . LOGO_IMAGE, STORE_NAME); ?></td>
          </tr>
          <tr> 
            <td colspan="2" align="center" class="titleHeading"><b><?php echo 'Order#' . $_GET['oID']; ?></b></td>
          </tr>
          <tr align="left"> 
            <td colspan="2" class="titleHeading"><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr> 
    <td align="center"><table align="center" width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr> 
        <td align="center" valign="top"><table align="center" width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td align="center" valign="top"><table align="center" width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow"> 
                <td class="dataTableHeadingContent"><b><?php echo ENTRY_SOLD_TO; ?></b></td>
              </tr>
              <tr class="dataTableRow"> 
                <td class="dataTableContent"><?php echo tep_address_format($order->customer['format_id'], $order->customer, 1, '&nbsp;', '<br>'); ?></td>
              </tr>
              <tr class="dataTableRow"> 
                <td class="dataTableContent"><?php echo tep_draw_separator('pixel_trans.png', '1', '5'); ?></td>
              </tr>
              <tr class="dataTableRow"> 
                <td class="dataTableContent"><?php echo '&nbsp;<b>Telephone#</b>' . '<br>&nbsp;' . $order->customer['telephone']; ?></td>
              </tr>
              <tr class="dataTableRow"> 
                <td class="dataTableContent"><?php echo '&nbsp;<b>eMail Address:</b>' . '<br>&nbsp;' . $order->customer['email_address']; ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        <td align="center" valign="top"><table align="center" width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td align="center" valign="top"><table align="center" width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow"> 
                <td class="dataTableHeadingContent"><b><?php echo ENTRY_SHIP_TO; ?></b></td>
              </tr>
              <tr class="dataTableRow"> 
                <td class="dataTableContent"><?php echo tep_address_format($order->delivery['format_id'], $order->delivery, 1, '&nbsp;', '<br>'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="dataTableHeadingContent"><b><?php echo ENTRY_PAYMENT_METHOD; ?></b></td>
        <td class="dataTableContent"><?php echo $order->info['payment_method']; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="1">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="dataTableHeadingRow"> 
            <td class="dataTableHeadingContent" colspan="2"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
          </tr>
<?php
    for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
      echo '      <tr class="dataTableRow">' . "\n" .
           '        <td class="dataTableContent" valign="top" align="right">' . $order->products[$i]['qty'] . '&nbsp;x</td>' . "\n" .
           '        <td class="dataTableContent" valign="top">' . $order->products[$i]['name'];

      if (sizeof((array)$order->products[$i]['attributes']) > 0) {
        for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {
          echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          echo '</i></small></nobr>';
        }
      }

      echo '        </td>' . "\n" .
           '        <td class="dataTableContent" valign="top">' . $order->products[$i]['model'] . '</td>' . "\n" .
           '      </tr>' . "\n";
    }
?>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<!-- body_text_smend
<br> -->


</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
