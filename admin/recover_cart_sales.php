<?php

define('TABLE_SCART', 'scart');

/*
 $Id: recover_cart_sales.php,v 1.6 2005/08/16 20:56:37 lane Exp $
 Recover Cart Sales Tool v2.22

 Copyright (c) 2003-2005 JM Ivler / Ideas From the Deep / OSCommerce
 Released under the GNU General Public License

 Based on an original release of unsold carts by: JM Ivler

 That was modifed by Aalst (aalst@aalst.com) until v1.7 of stats_unsold_carts.php

 Then, the report was turned into a sales tool (recover_cart_sales.php) by
 JM Ivler based on the scart.php program that was written off the Oct 8 unsold carts code release.

 Modifed by Aalst (recover_cart_sales.php,v 1.2 ... 1.36)
 aalst@aalst.com

 Modifed by willross (recover_cart_sales.php,v 1.4)
 reply@qwest.net
 - don't forget to flush the 'scart' db table every so often

 Modified by Lane Roathe (recover_cart_sales.php,v 1.4d .. v2.22)
 lane@ifd.com	www.osc-modsquad.com / www.ifd.com
*/
require('includes/application_top.php');
require(DIR_WS_CLASSES . 'currencies.php');

//link_post_variable('custid');	// fix to allow turning off register_globals in php - does not work w/standard osC (requires some other mod!)

$currencies = new currencies();

// Delete Entry Begin
if ($HTTP_GET_VARS['action'] == 'delete') {
    $reset_query_raw = "delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id=" . $HTTP_GET_VARS[customer_id] . " AND customers_basket_date_added = " . $HTTP_GET_VARS[dateadded];
    tep_db_query($reset_query_raw);

    $reset_query_raw2 = "delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id=" . $HTTP_GET_VARS[customer_id];
    tep_db_query($reset_query_raw2);

    tep_redirect(tep_href_link(FILENAME_RECOVER_CART_SALES, 'delete=1&customer_id=' . $HTTP_GET_VARS['customer_id'] . '&tdate=' . $HTTP_GET_VARS['tdate']));
}

if ($HTTP_GET_VARS['delete']) {
    $messageStack->add(MESSAGE_STACK_CUSTOMER_ID . $HTTP_GET_VARS['customer_id'] . MESSAGE_STACK_DELETE_SUCCESS, 'success');
}


// Delete Entry End
$tdate = $_POST['tdate'];
if ($tdate == '') $tdate = RCS_BASE_DAYS;

$sdate = $_POST['sdate'];
if ($sdate == '') $sdate = RCS_SKIP_DAYS;

//require(DIR_WS_INCLUDES . 'template_top.php'); ?>

<!-- header_eof //-->

<!-- body //-->
<?php
include_once('html-open.php');
include_once('header.php');


function seadate($day)
{
    $rawtime = strtotime("-" . $day . " days");
    $ndate = date("Ymd", $rawtime);
    return $ndate;
}

function cart_date_short($raw_date)
{
    if (($raw_date == '00000000') || ($raw_date == '')) return false;

    $year = substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 4, 2);
    $day = (int)substr($raw_date, 6, 2);

    if (@date('Y', mktime(0, 0, 0, $month, $day, $year)) == $year) {
        return date(DATE_FORMAT, mktime(0, 0, 0, $month, $day, $year));
    } else {
        return preg_replace('2037' . '$', $year, date(DATE_FORMAT, mktime(0, 0, 0, $month, $day, 2037)));
    }
}


// This will return a list of customers with sessions. Handles either the mysql or file case
// Returns an empty array if the check sessions flag is not true (empty array means same SQL statement can be used)
function _GetCustomerSessions()
{
    $cust_ses_ids = array();

    if (RCS_CHECK_SESSIONS == 'true') {
        if (STORE_SESSIONS == 'mysql') {
            // --- DB RECORDS ---
            $sesquery = tep_db_query("select value from " . TABLE_SESSIONS . " where 1");
            while ($ses = tep_db_fetch_array($sesquery)) {
                //	if ( ereg( "customer_id[^\"]*\"([0-9]*)\"", $ses['value'], $custval ) )
                if (preg_match("/customer_id[^\"]*\"([0-9]*)\"/", $ses['value'], $custval))

                    $cust_ses_ids[] = $custval[1];
            }
        } else    // --- FILES ---
        {
            if ($handle = opendir(tep_session_save_path())) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        $file = tep_session_save_path() . '/' . $file;    // create full path to file!
                        if ($fp = fopen($file, 'r')) {
                            $val = fread($fp, filesize($file));
                            fclose($fp);

//                            if ( ereg( "customer_id[^\"]*\"([0-9]*)\"", $val, $custval ) )
                            if (preg_match("/customer_id[^\"]*\"([0-9]*)\"/", $ses['value'], $custval))
                                $cust_ses_ids[] = $custval[1];
                        }
                    }
                }
                closedir($handle);
            }
        }
    }
    return $cust_ses_ids;
}


?>


<td width="100%" valign="top">
    <table border="0" width="100%" cellspacing="0" cellpadding="2" class="rcs_table">
        <?php
        $custid = $_POST['custid'];
        // Are we doing an e-mail to some customers?
        if (!empty($custid) > 0) { ?>
            <tr>
                <td class="pageHeading" align="left" colspan=2 width="50%"><?php echo HEADING_TITLE; ?> </td>
                <td class="pageHeading" align="left" colspan=4 width="50%"><?php echo HEADING_EMAIL_SENT; ?> </td>
            </tr>
            <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left" colspan="1" width="15%"
                    nowrap><?php echo TABLE_HEADING_CUSTOMER; ?></td>
                <td class="dataTableHeadingContent" align="left" colspan="1" width="30%" nowrap>&nbsp;</td>
                <td class="dataTableHeadingContent" align="left" colspan="1" width="25%" nowrap>&nbsp;</td>
                <td class="dataTableHeadingContent" align="left" colspan="1" width="10%" nowrap>&nbsp;</td>
                <td class="dataTableHeadingContent" align="left" colspan="1" width="10%" nowrap>&nbsp;</td>
                <td class="dataTableHeadingContent" align="left" colspan="1" width="10%" nowrap>&nbsp;</td>
            </tr>
            <tr>&nbsp;<br></tr>
            <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left" colspan="1" width="15%"
                    nowrap><?php echo TABLE_HEADING_MODEL; ?></td>
                <td class="dataTableHeadingContent" align="left" colspan="2" width="55%"
                    nowrap><?php echo TABLE_HEADING_DESCRIPTION; ?></td>
                <td class="dataTableHeadingContent" align="center" colspan="1" width="10%"
                    nowrap> <?php echo TABLE_HEADING_QUANTY; ?></td>
                <td class="dataTableHeadingContent" align="right" colspan="1" width="10%"
                    nowrap><?php echo TABLE_HEADING_PRICE; ?></td>
                <td class="dataTableHeadingContent" align="right" colspan="1" width="10%"
                    nowrap><?php echo TABLE_HEADING_TOTAL; ?></td>
            </tr>
            <?php
            foreach ($custid as $cid) {
                unset($email);

                $query1 = tep_db_query("select cb.products_id pid,
                                    cb.customers_basket_quantity qty,
                                    cb.customers_basket_date_added bdate,
                                    cus.customers_firstname fname,
                                    cus.customers_lastname lname,
                                    cus.customers_telephone phone,
                                    cus.customers_email_address email
                          from      " . TABLE_CUSTOMERS_BASKET . " cb,
                                    " . TABLE_CUSTOMERS . " cus
                          where     cb.customers_id = cus.customers_id  and
                                    cus.customers_id = '" . $cid . "'
                          order by  cb.customers_basket_date_added desc ");

                $knt = tep_db_num_rows($query1);
                for ($i = 0; $i < $knt; $i++) {
                    $inrec = tep_db_fetch_array($query1);

                    // set new cline and curcus
                    if ($lastcid != $cid) {
                        if (!empty($lastcid)) {
                            $cline .= "
			  <tr>
				 <td class='dataTableContent' align='right' colspan='6' nowrap><b>" . TABLE_CART_TOTAL . "</b>" . $currencies->format($tprice) . "</td>
			  </tr>
			  <tr>
				 <td colspan='8' align='right'><a href=" . tep_href_link(FILENAME_RECOVER_CART_SALES, "action=delete&customer_id=" . $cid . "&tdate=" . $tdate . "&sdate=" . $sdate) . ">" . tep_text_button(IMAGE_DELETE) . "</a></td>
			  </tr>\n";
                            echo $cline;
                        }
                        $cline = "<tr> <td class='dataTableContent' align='left' colspan='6' nowrap><a href='" . tep_href_link(FILENAME_CUSTOMERS, 'search=' . $inrec['lname'], 'NONSSL') . "'>" . $inrec['fname'] . " " . $inrec['lname'] . "</a>" . $customer . "</td></tr>";
                        $tprice = 0;
                    }
                    $lastcid = $cid;

                    // get the shopping cart
                    $query2 = tep_db_query("select   p.products_price price,
                                                        p.products_image image,
												p.products_tax_class_id taxclass,
												p.products_model model,
                                    pd.products_name name
                            from    " . TABLE_PRODUCTS . " p,
                                    " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                    " . TABLE_LANGUAGES . " l
                            where   p.products_id = '" . $inrec['pid'] . "' and
                                    pd.products_id = p.products_id and
                                    pd.language_id = " . (int)$languages_id);

                    $inrec2 = tep_db_fetch_array($query2);
                    $sprice = tep_get_products_special_price($inrec['pid']);
                    if ($sprice < 1)
                        $sprice = $inrec2['price'];
                    // Some users may want to include taxes in the pricing, allow that. NOTE HOWEVER that we don't have a good way to get individual tax rates based on customer location yet!
                    if (RCS_INCLUDE_TAX_IN_PRICES == 'true')
                        $sprice += ($sprice * tep_get_tax_rate($inrec2['taxclass']) / 100);
                    else if (RCS_USE_FIXED_TAX_IN_PRICES == 'true' && RCS_FIXED_TAX_RATE > 0)
                        $sprice += ($sprice * RCS_FIXED_TAX_RATE / 100);

                    $tprice = $tprice + ($inrec['qty'] * $sprice);
                    $pprice_formated = $currencies->format($sprice);
                    $tpprice_formated = $currencies->format(($inrec['qty'] * $sprice));

                    $cline .= "<tr class='dataTableRow'>
                    <td class='dataTableContent' align='left'   width='15%' nowrap>" . $inrec2['model'] . "</td>
                    <td class='dataTableContent' align='left'  colspan='2' width='55%'><a href='" . tep_href_link(FILENAME_CATEGORIES, 'action=new_product_preview&read=only&pID=' . $inrec['pid'] . '&origin=' . FILENAME_RECOVER_CART_SALES . '?page=' . $HTTP_GET_VARS['page'], 'NONSSL') . "'>" . $inrec2['name'] . "</a></td>
                    <td class='dataTableContent' align='center' width='10%' nowrap>" . $inrec['qty'] . "</td>
                    <td class='dataTableContent' align='right'  width='10%' nowrap>" . $pprice_formated . "</td>
                    <td class='dataTableContent' align='right'  width='10%' nowrap>" . $tpprice_formated . "</td>
                 </tr>";

//                        $mline .= $inrec['qty'] . ' x ' . $inrec2['name'] . "\n";
//
//                        if( EMAIL_USE_HTML == 'true' )
//                            $mline .= '   <blockquote><a href="' . tep_catalog_href_link(FILENAME_PRODUCT_INFO, 'products_id='. $inrec['pid']) . '">' . tep_catalog_href_link(FILENAME_PRODUCT_INFO, 'products_id='. $inrec['pid']) . "</a></blockquote>\n\n";
//                        else
//                            $mline .= '   (' . tep_catalog_href_link(FILENAME_PRODUCT_INFO, 'products_id='. $inrec['pid']).")\n\n";


                    $products_block .= '<div style="display:inline-block;font-size: 13px;text-align:left;width:50%;min-width:120px;max-width:100%;width:-webkit-calc(230400px - 48000%);min-width: -webkit-calc(50%);width:calc(230400px - 48000%);min-width: calc(50%);margin-bottom:5px;">
                                          <div style="display: inline-block;box-shadow: 0 2px 4px rgba(3,27,78,.06);padding: 10px;border: 1px solid #e5e8ed;border-radius: 0;width: calc(100% - 21px);margin: 0 0 -1px;">';

                    if (!empty($inrec2['image'])) {
                        $image_array = explode(';', $inrec2['image']);

                        $products_block .= '<span style="height:48px;width:48px;margin-right: 10px;float:left;text-align:center;line-height:48px;">
                                              <img src="' . HTTP_SERVER . '/getimage/48x48/products/' . array_shift($image_array) . '" style="max-height:48px;max-width:48px;vertical-align: middle;">
                                            </span>';
                    }
                    // $tprice + ($inrec['qty'] * $sprice);
                    //                                              <div style="text-overflow: ellipsis; overflow: hidden;  white-space: nowrap;min-height: 20px;">'.$products_ordered_attributes.'</div>

                    $products_block .= '<div style="display:block;margin-left:58px;">
                                              <span style="display:block;text-overflow: ellipsis; overflow: hidden;height: 60px;">' . ($inrec2['qty'] > 1 ? ('(<b>' . $inrec2['qty'] . '</b>)') : '') . ' <b>#' . $inrec2['model'] . '</b> ' . $inrec2['name'] . '</span>
                                              <span style="display:inline-block;font-weight:600;">' . $tpprice_formated . '</span>
                                            </div>
                                          </div>
                                        </div>';


                }

                $cline .= "</td></tr>";



                // E-mail Processing - Requires EMAIL_* defines in the
                // includes/languages/english/recover_cart_sales.php file
                $cquery = tep_db_query("select * from orders where customers_id = '" . $cid . "'");
                $email = EMAIL_TEXT_LOGIN;

                if (EMAIL_USE_HTML == 'true')
                    $email .= '  <a HREF="' . tep_catalog_href_link(FILENAME_LOGIN, '', 'SSL') . '">' . tep_catalog_href_link(FILENAME_CATALOG_LOGIN, '', 'SSL') . '</a>';
                else
                    $email .= '  (' . tep_catalog_href_link(FILENAME_LOGIN, '', 'SSL') . ')';

                $email .= "\n" . EMAIL_SEPARATOR . "\n\n";

                if (RCS_EMAIL_FRIENDLY == 'true')
                    $email .= EMAIL_TEXT_SALUTATION . $inrec['fname'] . ",";
                else
                    $email .= STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n";

                if (tep_db_num_rows($cquery) < 1)
                    $email .= sprintf(EMAIL_TEXT_NEWCUST_INTRO, $mline);
                else
                    $email .= sprintf(EMAIL_TEXT_CURCUST_INTRO, $mline);

                $email .= EMAIL_TEXT_BODY_HEADER . $mline . EMAIL_TEXT_BODY_FOOTER;

                if (EMAIL_USE_HTML == 'true')
                    $email .= '<a HREF="' . tep_catalog_href_link('', '') . '">' . STORE_OWNER . "\n" . tep_catalog_href_link('', '') . '</a>';
                else
                    $email .= STORE_OWNER . "\n" . tep_catalog_href_link('', '');

                $email .= "\n\n" . $_POST['message'];
                $custname = $inrec['fname'] . " " . $inrec['lname'];

                $outEmailAddr = '"' . $custname . '" <' . $inrec['email'] . '>';
                if (tep_not_null(RCS_EMAIL_COPIES_TO))
                    $outEmailAddr .= ', ' . RCS_EMAIL_COPIES_TO;

//                    debug(['', $outEmailAddr, EMAIL_TEXT_SUBJECT, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS]); die;


//                   tep_mail('', $outEmailAddr, EMAIL_TEXT_SUBJECT, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);


                //$day_passes = abs(cart_date_short($inrec['bdate']) - date('m/d/Y'));

                // for less than 1 day, more than 1 day but less than 5, and more than 5 days and so on
//                if ($day_passes < 1) {
//                    $email_template = 'rcs_email';
//                } elseif ($day_passes >= 1 && $day_passes < 5) {
////                    $email_template = 'rcs_email_2';
//                    $email_template = 'rcs_email';
//                } else {
////                    $email_template = 'rcs_email_3';
//                    $email_template = 'rcs_email';
//                }

                $email_template = 'rcs_email';
                $subject = EMAIL_TEXT_SUBJECT;

                if (checkConst('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
                    require_once(DIR_FS_EXT . 'email_content/functions.php');
                    $orderComment = '';
                    if (isset($_POST['message']) && !empty($_POST['message'])) {
                        $orderComment = '<li style="margin-bottom:5px;margin-left: 0;"><b>' . COMMENT_BY_ADMIN . ':</b> ' . $_POST['message'] . '</li>';
                    }
                    $data = [
                        'customers_name'=>$custname,
                        'customers_email'=>$inrec['email'],
                        'customers_phone'=>$inrec['phone'],
                        'date_purchased'=>cart_date_short($inrec['bdate']),
                        'days'=>date_diff(new DateTime(), new DateTime(cart_date_short($inrec['bdate'])))->days,
                        'products_block'=>$products_block,
                        'comments'=>$orderComment
                    ];
                    $content_email_array = getRecoverCartSales($languages_id, $data, $email_template);
                    $email = $content_email_array['content_html'] ? : $email;
                    $subject = $content_email_array['subject'] ? : $subject;
                }

                //$('input[type="checkbox"]').each(function(item){$(this).attr('checked', false)});
                //mikkenarko@enayu.com
                tep_mail($custname, $inrec['email'], $subject, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);


                $mline = "";
                $products_block = "";

                // See if a record for this customer already exists; if not create one and if so update it
                $donequery = tep_db_query("select * from " . TABLE_SCART . " where customers_id = '" . $cid . "'");
                if (tep_db_num_rows($donequery) == 0)
                    tep_db_query("insert into " . TABLE_SCART . " (customers_id, dateadded, datemodified ) values ('" . $cid . "', '" . seadate('0') . "', '" . seadate('0') . "')");
                else {
                    $mail_sent_data = tep_db_fetch_array($donequery);
                    $counter = $mail_sent_data['count_of_mailed'] ?: 0;
                    $counter++;
                    tep_db_query("update " . TABLE_SCART . " set datemodified = '" . seadate('0') . "', count_of_mailed = '".(int)$counter."' where customers_id = " . $cid);
                }
                echo $cline;
                $cline = "";
            }
            echo "<tr><td colspan=8 align='right' class='dataTableContent'><b>" . TABLE_CART_TOTAL . "</b>" . $currencies->format($tprice) . "</td> </tr>";
            echo "<tr><td colspan=8 align='right'><a href=" . tep_href_link(FILENAME_RECOVER_CART_SALES, "action=delete&customer_id=" . $cid . "&tdate=" . $tdate . "&sdate=" . $sdate) . ">" . tep_text_button(IMAGE_DELETE) . "</a></td>  </tr>\n";
            echo "<tr><td colspan=6 align=center><a href=" . $PHP_SELF . ">" . TEXT_RETURN . "</a></td></tr>";
        } else     //we are NOT doing an e-mail to some customers
        {
            ?>
            <!-- REPORT TABLE BEGIN //-->
            <tr>
                <td class="pageHeading" align="left" width="50%" colspan="4"><?php echo HEADING_TITLE; ?></td>
                <td class="pageHeading" align="right" width="50%" colspan="4">
                    <form method=post action=<?php echo $PHP_SELF; ?>>
                        <table align="right" width="100%">
                            <tr class="dataTableContent" align="right">
                                <td><?php echo DAYS_FIELD_PREFIX; ?><input type=text size=4 width=4
                                                                           value=<?php echo $sdate; ?> name=sdate> -
                                    <input type=text size=4 width=4
                                           value=<?php echo $tdate; ?> name=tdate><?php echo DAYS_FIELD_POSTFIX; ?>
                                    <input type=submit value="<?php echo DAYS_FIELD_BUTTON; ?>"></td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
            <form method=post action=<?php echo $PHP_SELF; ?>>
                <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent" align="left" colspan="2" width="10%"
                        nowrap><?php echo TABLE_HEADING_CONTACT; ?></td>
                    <td class="dataTableHeadingContent" align="left" colspan="1" width="15%"
                        nowrap><?php echo TABLE_HEADING_DATE; ?></td>
                    <td class="dataTableHeadingContent" align="left" colspan="1" width="30%"
                        nowrap><?php echo TABLE_HEADING_CUSTOMER; ?></td>
                    <td class="dataTableHeadingContent" align="left" colspan="2" width="30%"
                        nowrap><?php echo TABLE_HEADING_EMAIL; ?></td>
                    <td class="dataTableHeadingContent" align="left" colspan="2" width="15%"
                        nowrap><?php echo TABLE_HEADING_PHONE; ?></td>
                </tr>
                <tr>&nbsp;<br></tr>
                <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent" align="left" colspan="2" width="10%" nowrap>&nbsp;</td>
                    <td class="dataTableHeadingContent" align="left" colspan="1"
                        nowrap><?php echo 'Mail count'; ?></td>
                    <td class="dataTableHeadingContent" align="left" colspan="1" width="15%"
                        nowrap><?php echo TABLE_HEADING_MODEL; ?></td>
                    <td class="dataTableHeadingContent" align="left" colspan="2" width="55%"
                        nowrap><?php echo TABLE_HEADING_DESCRIPTION; ?></td>
                    <td class="dataTableHeadingContent" align="center" colspan="1" width="5%"
                        nowrap> <?php echo TABLE_HEADING_QUANTY; ?></td>
                    <td class="dataTableHeadingContent" align="right" colspan="1" width="5%"
                        nowrap><?php echo TABLE_HEADING_PRICE; ?></td>
                    <td class="dataTableHeadingContent" align="right" colspan="1" width="10%"
                        nowrap><?php echo TABLE_HEADING_TOTAL; ?></td>
                </tr>
                <?php
                $cust_ses_ids = _GetCustomerSessions();
                $bdate = seadate($sdate);
                $ndate = seadate($tdate);
                $query1 = tep_db_query("select cb.customers_id cid,
                                cb.products_id pid,
                                cb.customers_basket_quantity qty,
                                cb.customers_basket_date_added bdate,
                                cus.customers_firstname fname,
                                cus.customers_lastname lname,
                                cus.customers_telephone phone,
                                cus.customers_email_address email
                         from   " . TABLE_CUSTOMERS_BASKET . " cb,
                                " . TABLE_CUSTOMERS . " cus
                         where  cb.customers_basket_date_added <= '" . $bdate . "' and
                         		  cb.customers_basket_date_added > '" . $ndate . "' and
                                cus.customers_id not in ('" . implode(", ", $cust_ses_ids) . "') and
                                cb.customers_id = cus.customers_id order by cb.customers_basket_date_added desc,
                                cb.customers_id ");
                $results = 0;
                $curcus = "";
                $tprice = 0;
                $totalAll = 0;
                $first_line = true;
                $skip = false;

                $knt = tep_db_num_rows($query1);
                for ($i = 0; $i <= $knt; $i++) {
                    $inrec = tep_db_fetch_array($query1);

                    // If this is a new customer, create the appropriate HTML
                    if ($curcus != $inrec['cid']) {
                        // output line
                        $totalAll += $tprice;
                        $cline .= "       </td>
                        <tr>
                          <td class='dataTableContent' align='right' colspan='8'><b>" . TABLE_CART_TOTAL . "</b>" . $currencies->format($tprice) . "</td>
                        </tr>
                        <tr>
                          <td colspan='8' align='right'><a href=" . tep_href_link('recover_cart_sales.php', "action=delete&customer_id=" . $curcus . "&tdate=" . $tdate . "&sdate=" . $sdate . "&dateadded=" . $curcus_date_added) . ">" . tep_text_button(IMAGE_DELETE) . "</a>
                          </td>
                        </tr>\n";
                        if (!empty($curcus) && !$skip)
                            echo $cline;

                        // set new cline and curcus
                        $curcus = $inrec['cid'];
                        $curcus_date_added = $inrec['bdate'];

                        if (!empty($curcus)) {
                            $tprice = 0;

                            // change the color on those we have contacted add customer tag to customers
                            $fcolor = RCS_UNCONTACTED_COLOR;
                            $checked = 1;    // assume we'll send an email
                            $new = 1;
                            $skip = false;
                            $sentdate = "";
                            $beforeDate = RCS_CARTS_MATCH_ALL_DATES ? '0' : $inrect['bdate'];
                            $customer = $inrec['fname'] . " " . $inrec['lname'];
                            $status = "";



                            $donequery = tep_db_query("select * from " . TABLE_SCART . " where customers_id = '" . $curcus . "'");
                            $emailttl = seadate(RCS_EMAIL_TTL);

                            if (tep_db_num_rows($donequery) > 0) {
                                $ttl = tep_db_fetch_array($donequery);
                                if ($ttl) {
                                    if (tep_not_null($ttl['datemodified']))    // allow for older scarts that have no datemodified field data
                                        $ttldate = $ttl['datemodified'];
                                    else
                                        $ttldate = $ttl['dateadded'];

                                    if(tep_not_null($ttl['count_of_mailed']))
                                    {
                                        $count_of_mailed = (int)$ttl['count_of_mailed'];
                                    }
                                    else
                                    {
                                        $count_of_mailed = 0;
                                    }

                                    if ($emailttl <= $ttldate) {
                                        $sentdate = $ttldate;
                                        $fcolor = RCS_CONTACTED_COLOR;
                                        $checked = 0;
                                        $new = 0;
                                    }
                                }
                            }

                            // See if the customer has purchased from us before
                            // Customers are identified by either their customer ID or name or email address
                            // If the customer has an order with items that match the current order, assume order completed, bail on this entry!
                            $ccquery = tep_db_query('select orders_id, orders_status from ' . TABLE_ORDERS . ' where (customers_id = ' . (int)$curcus . ' OR customers_email_address like "' . $inrec['email'] . '" or customers_name like "' . $inrec['fname'] . ' ' . $inrec['lname'] . '") and date_purchased >= "' . $beforeDate . '"');
                            if (tep_db_num_rows($ccquery) > 0) {
                                // We have a matching order; assume current customer but not for this order
                                $customer = '<font color=' . RCS_CURCUST_COLOR . '><b>' . $customer . '</b></font>';

                                // Now, look to see if one of the orders matches this current order's items
                                while ($orec = tep_db_fetch_array($ccquery)) {
                                    $ccquery = tep_db_query('select products_id from ' . TABLE_ORDERS_PRODUCTS . ' where orders_id = ' . (int)$orec['orders_id'] . ' AND products_id = ' . (int)$inrec['pid']);
                                    if (tep_db_num_rows($ccquery) > 0) {
                                        if ($orec['orders_status'] > RCS_PENDING_SALE_STATUS)
                                            $checked = 0;

                                        // OK, we have a matching order; see if we should just skip this or show the status
                                        if (RCS_SKIP_MATCHED_CARTS == 'true' && !$checked) {
                                            $skip = true;    // reset flag & break us out of the while loop!
                                            break;
                                        } else {
                                            // It's rare for the same customer to order the same item twice, so we probably have a matching order, show it
                                            $fcolor = RCS_MATCHED_ORDER_COLOR;
                                            $ccquery = tep_db_query("select orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = " . (int)$languages_id . " AND orders_status_id = " . (int)$orec['orders_status']);

                                            if ($srec = tep_db_fetch_array($ccquery))
                                                $status = ' [' . $srec['orders_status_name'] . ']';
                                            else
                                                $status = ' [' . TEXT_CURRENT_CUSTOMER . ']';
                                        }
                                    }
                                }
                                if ($skip)
                                    continue;    // got a matched cart, skip to next one
                            }
                            $sentInfo = TEXT_NOT_CONTACTED;

                            if (!empty($sentdate))
                                $sentInfo = cart_date_short($sentdate);

                            $cline = "
				<tr bgcolor=" . $fcolor . ">
				<td class='dataTableContent' align='center' width='1%'>" . tep_draw_checkbox_field('custid[]', $curcus, RCS_AUTO_CHECK == 'true' ? $checked : 0) . "</td>
				<td class='dataTableContent' align='left' width='3%' nowrap><b>Sent: " . $count_of_mailed . "</b></td>
				<td class='dataTableContent' align='left' width='9%' nowrap><b>" . $sentInfo . "</b></td>
				<td class='dataTableContent' align='left' width='15%' nowrap> " . cart_date_short($inrec['bdate']) . "</td>
				<td class='dataTableContent' align='left' width='30%' nowrap><a href='" . tep_href_link(FILENAME_CUSTOMERS, 'search=' . $inrec['lname'], 'NONSSL') . "'>" . $customer . "</a>" . $status . "</td>
				<td class='dataTableContent' align='left' colspan='2' width='30%' nowrap><a href='" . tep_href_link('mail.php', 'selected_box=tools&customer=' . $inrec['email']) . "'>" . $inrec['email'] . "</a></td>
				<td class='dataTableContent' align='left' colspan='2' width='15%' nowrap>" . $inrec['phone'] . "</td>
				</tr>";
                        }
                    }

                    // We only have something to do for the product if the quantity selected was not zero!
                    if ($inrec['qty'] != 0) {
                        // Get the product information (name, price, etc)
                        $query2 = tep_db_query("select  p.products_price price,
													p.products_tax_class_id taxclass,
													p.products_model model,
													pd.products_name name
										 from    " . TABLE_PRODUCTS . " p,
													" . TABLE_PRODUCTS_DESCRIPTION . " pd,
													" . TABLE_LANGUAGES . " l
										 where   p.products_id = '" . (int)$inrec['pid'] . "' and
													pd.products_id = p.products_id and
													pd.language_id = " . (int)$languages_id);
                        $inrec2 = tep_db_fetch_array($query2);

                        // Check to see if the product is on special, and if so use that pricing
                        $sprice = tep_get_products_special_price($inrec['pid']);
                        if ($sprice < 1)
                            $sprice = $inrec2['price'];
                        // Some users may want to include taxes in the pricing, allow that. NOTE HOWEVER that we don't have a good way to get individual tax rates based on customer location yet!
                        if (RCS_INCLUDE_TAX_IN_PRICES == 'true')
                            $sprice += ($sprice * tep_get_tax_rate($inrec2['taxclass']) / 100);
                        else if (RCS_USE_FIXED_TAX_IN_PRICES == 'true' && RCS_FIXED_TAX_RATE > 0)
                            $sprice += ($sprice * RCS_FIXED_TAX_RATE / 100);

                        // BEGIN OF ATTRIBUTE DB CODE
                        $prodAttribs = ''; // DO NOT DELETE

                        if (RCS_SHOW_ATTRIBUTES == 'true') {
                            $attribquery = tep_db_query("select  cba.products_id pid,
															 po.products_options_name poname,
															 pov.products_options_values_name povname
												  from    " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " cba,
															 " . TABLE_PRODUCTS_OPTIONS . " po,
															 " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov,
															 " . TABLE_LANGUAGES . " l
												  where   cba.products_id ='" . $inrec['pid'] . "' and
			 												 cba.customers_id = " . $curcus . " and
			 												 po.products_options_id = cba.products_options_id and
															 pov.products_options_values_id = cba.products_options_value_id and
															 po.language_id = " . (int)$languages_id . " and
															 pov.language_id = " . (int)$languages_id
                            );
                            $hasAttributes = false;

                            if (tep_db_num_rows($attribquery)) {
                                $hasAttributes = true;
                                $prodAttribs = '<br>';

                                while ($attribrecs = tep_db_fetch_array($attribquery))
                                    $prodAttribs .= '<small><i> - ' . $attribrecs['poname'] . ' ' . $attribrecs['povname'] . '</i></small><br>';
                            }
                        }
                        // END OF ATTRIBUTE DB CODE
                        $tprice = $tprice + ($inrec['qty'] * $sprice);
                        $pprice_formated = $currencies->format($sprice);
                        $tpprice_formated = $currencies->format(($inrec['qty'] * $sprice));

                        $cline .= "<tr class='dataTableRow'>
                    <td class='dataTableContent' align='left' vAlign='top' colspan='2' width='12%' nowrap> &nbsp;</td>
                    <td class='dataTableContent' align='left' vAlign='top' width='13%' nowrap>" . $inrec2['model'] . "</td>
                    <td class='dataTableContent' align='left' vAlign='top' colspan='2' width='55%'><a href='" . tep_href_link(FILENAME_CATEGORIES, 'action=new_product_preview&read=only&pID=' . $inrec['pid'] . '&origin=' . FILENAME_RECOVER_CART_SALES . '?page=' . $HTTP_GET_VARS['page'], 'NONSSL') . "'><b>" . $inrec2['name'] . "</b></a>
                    " . $prodAttribs . "
                    </td>
                    <td class='dataTableContent' align='center' vAlign='top' width='5%' nowrap>" . $inrec['qty'] . "</td>
                    <td class='dataTableContent' align='right'  vAlign='top' width='5%' nowrap>" . $pprice_formated . "</td>
                    <td class='dataTableContent' align='right'  vAlign='top' width='10%' nowrap>" . $tpprice_formated . "</td>
                 </tr>";
                    }
                }
                $totalAll_formated = $currencies->format($totalAll);
                $cline = "<tr></tr><td class='dataTableContent' align='right' colspan='8'><hr align=right width=55><b>" . TABLE_GRAND_TOTAL . "</b>" . $totalAll_formated . "</td>
              </tr>";
                echo $cline;
                echo "<tr><td colspan=8><hr size=1 color=000080><b>" . PSMSG . "</b><br>" . tep_draw_textarea_field('message', 'soft', '80', '5') . "<br>" . tep_draw_selection_field('submit_button', 'submit', TEXT_SEND_EMAIL) . "</td></tr>";
                ?>
            </form>
        <?php }
        //
        // end footer of both e-mail and report
        //
        ?>
        <!-- REPORT TABLE END //-->
    </table>
</td>
<!-- body_text_eof //-->
</tr>
</table>
<!-- body_eof //-->
<!-- footer //-->
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?> ?>