<?php
/*
  $Id: tax_rates.php,v 1.2 2003/09/24 15:18:15 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');

$action=(isset($_GET['action']) ? $_GET['action'] : '');

if (tep_not_null($action)) {
    switch ($action) {
        case 'insert':
            $tax_zone_id=tep_db_prepare_input($_POST['tax_zone_id']);
            $tax_class_id=tep_db_prepare_input($_POST['tax_class_id']);
            $tax_rate=tep_db_prepare_input($_POST['tax_rate']);
            $tax_description=tep_db_prepare_input($_POST['tax_description']);
            $tax_priority=tep_db_prepare_input($_POST['tax_priority']);

            tep_db_query("insert into " . TABLE_TAX_RATES . " (tax_zone_id, tax_class_id, tax_rate, tax_description, tax_priority, date_added) values ('" . (int)$tax_zone_id . "', '" . (int)$tax_class_id . "', '" . tep_db_input($tax_rate) . "', '" . tep_db_input($tax_description) . "', '" . tep_db_input($tax_priority) . "', now())");

            tep_redirect(tep_href_link(FILENAME_TAX_RATES));
            break;
        case 'save':
            $tax_rates_id=tep_db_prepare_input($_GET['tID']);
            $tax_zone_id=tep_db_prepare_input($_POST['tax_zone_id']);
            $tax_class_id=tep_db_prepare_input($_POST['tax_class_id']);
            $tax_rate=tep_db_prepare_input($_POST['tax_rate']);
            $tax_description=tep_db_prepare_input($_POST['tax_description']);
            $tax_priority=tep_db_prepare_input($_POST['tax_priority']);

            tep_db_query("update " . TABLE_TAX_RATES . " set tax_rates_id = '" . (int)$tax_rates_id . "', tax_zone_id = '" . (int)$tax_zone_id . "', tax_class_id = '" . (int)$tax_class_id . "', tax_rate = '" . tep_db_input($tax_rate) . "', tax_description = '" . tep_db_input($tax_description) . "', tax_priority = '" . tep_db_input($tax_priority) . "', last_modified = now() where tax_rates_id = '" . (int)$tax_rates_id . "'");

            tep_redirect(tep_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $tax_rates_id));
            break;
        case 'deleteconfirm':
            $tax_rates_id=tep_db_prepare_input($_GET['tID']);

            tep_db_query("delete from " . TABLE_TAX_RATES . " where tax_rates_id = '" . (int)$tax_rates_id . "'");

            tep_redirect(tep_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page']));
            break;
    }
}
?>
<?php
include_once('html-open.php');
include_once('header.php');
?>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<div class="container">
    <table border="0" width="100%" cellspacing="2" cellpadding="2">
        <tr>
            <!-- body_text //-->
            <td width="100%" valign="top">
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                    <tr>
                        <td>
                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                                    <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td valign="top">
                                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                            <tr class="dataTableHeadingRow">
                                                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TAX_RATE_PRIORITY; ?></td>
                                                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TAX_CLASS_TITLE; ?></td>
                                                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ZONE; ?></td>
                                                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TAX_RATE; ?></td>
                                                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>
                                                    &nbsp;</td>
                                            </tr>
                                            <?php
                                            $rates_query_raw="select r.tax_rates_id, z.geo_zone_id, z.geo_zone_name, tc.tax_class_title, tc.tax_class_id, r.tax_priority, r.tax_rate, r.tax_description, r.date_added, r.last_modified from " . TABLE_TAX_CLASS . " tc, " . TABLE_TAX_RATES . " r left join " . TABLE_GEO_ZONES . " z on r.tax_zone_id = z.geo_zone_id where r.tax_class_id = tc.tax_class_id";
                                            $rates_split=new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $rates_query_raw, $rates_query_numrows);
                                            $rates_query=tep_db_query($rates_query_raw);
                                            while ($rates=tep_db_fetch_array($rates_query)) {
                                                if ((!isset($_GET['tID']) || (isset($_GET['tID']) && ($_GET['tID']==$rates['tax_rates_id']))) && !isset($trInfo) && (substr($action, 0, 3)!='new')) {
                                                    $trInfo=new objectInfo($rates);
                                                }

                                                if (isset($trInfo) && is_object($trInfo) && ($rates['tax_rates_id']==$trInfo->tax_rates_id)) {
                                                    echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id . '&action=edit') . '\'">' . "\n";
                                                }else {
                                                    echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $rates['tax_rates_id']) . '\'">' . "\n";
                                                }
                                                ?>
                                                <td class="dataTableContent"><?php echo $rates['tax_priority']; ?></td>
                                                <td class="dataTableContent"><?php echo $rates['tax_class_title']; ?></td>
                                                <td class="dataTableContent"><?php echo $rates['geo_zone_name']; ?></td>
                                                <td class="dataTableContent"><?php echo tep_display_tax_value($rates['tax_rate']); ?>
                                                    %
                                                </td>
                                                <td class="dataTableContent" align="right"><?php if (isset($trInfo) && is_object($trInfo) && ($rates['tax_rates_id']==$trInfo->tax_rates_id)) {
                                                        echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
                                                    }else {
                                                        echo '<a href="' . tep_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $rates['tax_rates_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
                                                    } ?>&nbsp;</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="5">
                                                    <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                                        <tr>
                                                            <td class="smallText" valign="top"><?php echo $rates_split->display_count($rates_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_TAX_RATES); ?></td>
                                                            <td class="smallText" align="right"><?php echo $rates_split->display_links($rates_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                                                        </tr>
                                                        <?php
                                                        if (empty($action)) {
                                                            ?>
                                                            <tr>
                                                                <td colspan="5" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&action=new') . '">' . tep_text_button(BUTTON_NEW_TAX_RATE_NEW) . '</a>'; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php
                                    $heading=array();
                                    $contents=array();

                                    switch ($action) {
                                        case 'new':
                                            $heading[]=array('text'=>'<b>' . TEXT_INFO_HEADING_NEW_TAX_RATE . '</b>');

                                            $contents=array('form'=>tep_draw_form('rates', FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&action=insert'));
                                            $contents[]=array('text'=>TEXT_INFO_INSERT_INTRO);
                                            $contents[]=array('text'=>'<br>' . TEXT_INFO_CLASS_TITLE . '<br>' . tep_tax_classes_pull_down('name="tax_class_id" style="font-size:10px"'));
                                            $contents[]=array('text'=>'<br>' . TEXT_INFO_ZONE_NAME . '<br>' . tep_geo_zones_pull_down('name="tax_zone_id" style="font-size:10px"'));
                                            $contents[]=array('text'=>'<br>' . TEXT_INFO_TAX_RATE . '<br>' . tep_draw_input_field('tax_rate'));
                                            $contents[]=array('text'=>'<br>' . TEXT_INFO_RATE_DESCRIPTION . '<br>' . tep_draw_input_field('tax_description'));
                                            $contents[]=array('text'=>'<br>' . TEXT_INFO_TAX_RATE_PRIORITY . '<br>' . tep_draw_input_field('tax_priority'));
                                            $contents[]=array(
                                                'align'=>'center',
                                                'text'=>'<br>' . tep_image_submit('button_insert.gif', IMAGE_INSERT) . '&nbsp;<a href="' . tep_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page']) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                            );
                                            break;
                                        case 'edit':
                                            $heading[]=array('text'=>'<b>' . TEXT_INFO_HEADING_EDIT_TAX_RATE . '</b>');

                                            $contents=array('form'=>tep_draw_form('rates', FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id . '&action=save'));
                                            $contents[]=array('text'=>TEXT_INFO_EDIT_INTRO);
                                            $contents[]=array('text'=>'<br>' . TEXT_INFO_CLASS_TITLE . '<br>' . tep_tax_classes_pull_down('name="tax_class_id" style="font-size:10px"', $trInfo->tax_class_id));
                                            $contents[]=array('text'=>'<br>' . TEXT_INFO_ZONE_NAME . '<br>' . tep_geo_zones_pull_down('name="tax_zone_id" style="font-size:10px"', $trInfo->geo_zone_id));
                                            $contents[]=array('text'=>'<br>' . TEXT_INFO_TAX_RATE . '<br>' . tep_draw_input_field('tax_rate', $trInfo->tax_rate));
                                            $contents[]=array('text'=>'<br>' . TEXT_INFO_RATE_DESCRIPTION . '<br>' . tep_draw_input_field('tax_description', $trInfo->tax_description));
                                            $contents[]=array('text'=>'<br>' . TEXT_INFO_TAX_RATE_PRIORITY . '<br>' . tep_draw_input_field('tax_priority', $trInfo->tax_priority));
                                            $contents[]=array(
                                                'align'=>'center',
                                                'text'=>'<br>' . tep_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                            );
                                            break;
                                        case 'delete':
                                            $heading[]=array('text'=>'<b>' . TEXT_INFO_HEADING_DELETE_TAX_RATE . '</b>');

                                            $contents=array('form'=>tep_draw_form('rates', FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id . '&action=deleteconfirm'));
                                            $contents[]=array('text'=>TEXT_INFO_DELETE_INTRO);
                                            $contents[]=array('text'=>'<br><b>' . $trInfo->tax_class_title . ' ' . number_format($trInfo->tax_rate, 0) . '%</b>');
                                            $contents[]=array(
                                                'align'=>'center',
                                                'text'=>'<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . tep_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id) . '">' . tep_text_button(BUTTON_CANCEL_NEW) . '</a>'
                                            );
                                            break;
                                        default:
                                            if (is_object($trInfo)) {
                                                $heading[]=array('text'=>'<b>' . $trInfo->tax_class_title . '</b>');
                                                $contents[]=array(
                                                    'align'=>'center',
                                                    'text'=>'<a href="' . tep_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id . '&action=edit') . '">' . tep_text_button(BUTTON_EDIT_NEW) . '</a> <a href="' . tep_href_link(FILENAME_TAX_RATES, 'page=' . $_GET['page'] . '&tID=' . $trInfo->tax_rates_id . '&action=delete') . '">' . tep_text_button(BUTTON_DELETE_NEW) . '</a>'
                                                );
                                                $contents[]=array('text'=>'<br>' . TEXT_INFO_DATE_ADDED . ' ' . tep_date_short($trInfo->date_added));
                                                $contents[]=array('text'=>'' . TEXT_INFO_LAST_MODIFIED . ' ' . tep_date_short($trInfo->last_modified));
                                                $contents[]=array('text'=>'<br>' . TEXT_INFO_RATE_DESCRIPTION . '<br>' . $trInfo->tax_description);
                                            }
                                            break;
                                    }

                                    if ((tep_not_null($heading)) && (tep_not_null($contents))) {
                                        echo '            <td width="25%" valign="top">' . "\n";

                                        $box=new box;
                                        echo $box->infoBox($heading, $contents);

                                        echo '            </td>' . "\n";
                                    }
                                    ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
            <!-- body_text_smend //-->
        </tr>
    </table>
</div>
<?php
include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
