<?php
/*
  Out of Stock Products, by solomono.net 18.08.18
*/

require('includes/application_top.php');
?>

<?php


include_once('html-open.php');
include_once('header.php');

include DIR_WS_TABS . "products_statistic.php";

?>

<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" href="includes/solomono/css/overwrite.css" type="text/css" />
<div class="container edit_orders">

    <!-- body //-->
    <table border="0" width="100%" cellspacing="2" cellpadding="2" class="stats_zeroqty">
        <tr>
            <td width="<?php echo BOX_WIDTH; ?>" valign="top">
                <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
                    <!-- left_navigation //-->
<!--                    --><?php //require(DIR_WS_INCLUDES . 'column_left.php'); ?>
                    <!-- left_navigation_smend //-->
                </table>
            </td>
            <!-- body_text //-->
            <td width="100%" valign="top">
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="wrapper-md">
                            <div class="bg-light lter wrapper-md ng-scope" style="background: #f0f3f4;">
                                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="m-n font-thin h3"><?=HEADING_TITLE?></td>
                                        <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td  class="wrapper-md">
                            <table border="0" width="100%" cellspacing="0" cellpadding="0" class="stats_products_viewed ">
                                <tr>
                                    <td valign="top"  class="panel panel-default">
                                        <table border="0" width="100%" cellspacing="0" cellpadding="2" class="table table-bordered table-hover table-condensed bg-white-only b-t b-light"class="table table-bordered table-hover table-condensed bg-white-only b-t b-light">
                                            <tr class="dataTableHeadingRow" style="background: #fff;">
                                                <td class="dataTableHeadingContent">No</td>
                                                <td class="dataTableHeadingContent"><?=MODEL?></td>
                                                <td class="dataTableHeadingContent"><?=NAME?></td>
                                            </tr>
                                            <?php
                                            $rows = 0;
                                            if (isset($_GET['page']) && ($_GET['page'] > 1)) $rows = ($_GET['page'] - 1) * MAX_DISPLAY_SEARCH_RESULTS;
                                            $products_query_raw = "select distinct p.products_id, p.products_model, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and products_quantity <=0";
                                            $products_query_totals = tep_db_num_rows(tep_db_query($products_query_raw));
                                            $products_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $products_query_raw, $products_query_numrows);
                                            $products_query = tep_db_query($products_query_raw);
                                            while ($products = tep_db_fetch_array($products_query)) {
                                                $rows++;

                                                if (strlen($rows) < 2) {
                                                    $rows = '0' . $rows;
                                                }
                                                if ($products['products_model'] || $products['products_name']):
                                                    ?>
                                                    <tr class="dataTableRow" onmouseover="<!--rowOverEffect(this)-->" onmouseout="<!--rowOutEffect(this)-->">
                                                        <td class="dataTableContent"><?php echo $rows; ?>.</td>
                                                        <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS, 'action=new_product&read=only&pID=' . $products['products_id'] . '&origin=' . FILENAME_STATS_PRODUCTS_VIEWED, 'NONSSL') . '">' . $products['products_model'] . '</a>'; ?></td>
                                                        <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS, 'action=new_product&read=only&pID=' . $products['products_id'] . '&origin=' . FILENAME_STATS_PRODUCTS_VIEWED, 'NONSSL') . '">' . $products['products_name'] . '</a>'; ?></td>
                                                    </tr>
                                                <?php
                                                endif;}
                                            ?>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table border="0" width="100%" cellspacing="0" cellpadding="2">
                                            <tr>
                                                <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_totals - 1, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
                                                <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_totals, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table></td>
                    </tr>
                </table></td>
            <!-- body_text_smend //-->
        </tr>
    </table>
    <!-- body_smend //-->
</div>
    <?php

    /**
     * footer
     */

    include_once('footer.php');
    include_once('html-close.php');

    ?>

    <?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
