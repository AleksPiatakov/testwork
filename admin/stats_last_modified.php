<?php
/*
  Last modified, by solomono.net 18.08.18
*/

  require('includes/application_top.php');
?>

<?php


include_once('html-open.php');
include_once('header.php'); 

?>

<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" href="includes/solomono/css/overwrite.css" type="text/css" />
<div class="container edit_orders">

<!-- body //-->
    <table border="0" width="100%" cellspacing="2" cellpadding="2" class="stats_last_modified">
        <tr>
            <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
                    <!-- left_navigation //-->
<!--                    --><?php //require(DIR_WS_INCLUDES . 'column_left.php'); ?>
                    <!-- left_navigation_smend //-->
                </table>
            </td>
            <!-- body_text //-->
            <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="wrapper-md" style="padding-bottom: 20px">
                            <div class="bg-light lter b-b wrapper-md ng-scope" style=" background: #f0f3f4;">
                                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="m-n font-thin h3"><?=HEADING_TITLE?></td>
                                        <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr style="background-color: #fff; border: 1px solid #e3e3e3; border-bottom: none;">
                        <td class="main wrapper-md" style="background-color: #fff; margin: 10px 0 12px 0;">
                            <div class="bg-light lter b-b wrapper-md ng-scope" style="background-color: #fff; padding-top: 10px; padding-bottom: 13px">
                                <?php

                                echo tep_draw_form('date_range','stats_last_modified.php' , '', 'get');
                                echo ENTRY_STARTDATE . tep_draw_input_field('start_date', $_GET['start_date']);
                                echo '&nbsp;&nbsp;&nbsp;';
                                echo ENTRY_TODATE . tep_draw_input_field('end_date', $_GET['end_date']);
                                echo '&nbsp;&nbsp;&nbsp;';
                                echo '<input type="submit" value="'. ENTRY_SUBMIT .'" class="form-control btn btn-info w-auto h-half-xxs"></form>';

                                $totalgross = 0;
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="wrapper-md">
                            <table border="0" width="100%" cellspacing="0" cellpadding="0" class="stats_products_viewed">
                                <tr>
                                    <td valign="top" class=" panel panel-default">
                                        <table border="0" width="100%" cellspacing="0" cellpadding="2" class="table table-bordered table-hover table-condensed bg-white-only b-t b-light">
                                            <tr class="dataTableHeadingRow" style="background: #fff;">
                                                <td class="dataTableHeadingContent">No</td>
                                                <td class="dataTableHeadingContent"><?=MODEL?></td>
                                                <td class="dataTableHeadingContent"><?=NAME?></td>
                                                <td class="dataTableHeadingContent" width="200"><?=MODIFICATION?></td>
                                            </tr>
                                            <?php
                                            if (isset($_GET['page']) && ($_GET['page'] > 1)) $rows = $_GET['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;
                                            $rows = 0;
                                            
                                            if (isset($_GET['start_date'])) {
                                                $start_date = $_GET['start_date'];
                                                $start_date = strtotime($start_date);
                                                $start_date = date('Y-m-d H:i:s',$start_date);
                                            } else {
                                                $start_date = '';//date('m/01/Y');
                                            }
            
                                            if (isset($_GET['end_date'])) {
                                                $end_date = $_GET['end_date'];
                                                $end_date = strtotime($end_date);
                                                $end_date = date('Y-m-d H:i:s',$end_date);
                                            } else {
                                                $end_date = '';//date('m/d/Y');
                                            }
                                            
                                            if($_GET['start_date']!='' and $_GET['end_date']!='') $dates_sql = "p.products_last_modified BETWEEN '" . $start_date . "' AND '" . $end_date . " 23:59:59'";  
                                            else $dates_sql = "1=1";  

                                            $products_query_raw = "select p.products_id, p.products_model, pd.products_name, p.products_last_modified from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where ".$dates_sql." ".$addzipcode." and p.products_id = pd.products_id group by pd.products_id order by p.products_last_modified asc limit 100";
                                            //  $products_split = new splitPageResults($_GET['page'], 50, $products_query_raw, $products_query_numrows);
                                            $products_query = tep_db_query($products_query_raw);
                                            while ($products = tep_db_fetch_array($products_query)) {
                                                $rows++;
                                                $date = date_create_from_format('Y-m-d H:i:s', $products['products_last_modified']);
                                                $date = @date_format($date,'m/d/Y');
                                                if (strlen($rows) < 2) {
                                                    $rows = '0' . $rows;
                                                }
                                                ?>
                                                <tr class="dataTableRow" onmouseover="<!--rowOverEffect(this)-->" onmouseout="<!--rowOutEffect(this)-->">
                                                    <td class="dataTableContent"><?php echo $rows; ?>.</td>
                                                    <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS, 'action=new_product&read=only&pID=' . $products['products_id'] . '&origin=' . FILENAME_STATS_PRODUCTS_VIEWED, 'NONSSL') . '">' . $products['products_model'] . '</a>'; ?></td>
                                                    <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS, 'action=new_product&read=only&pID=' . $products['products_id'] . '&origin=' . FILENAME_STATS_PRODUCTS_VIEWED, 'NONSSL') . '">' . $products['products_name'] . '</a>'; ?></td>
                                                    <td class="dataTableContent"><?php echo $date; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </table>
                                    </td>
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
<!-- body_smend //-->
    <script>
        $(document).ready(function () {
            $('body').on('focus', '[name=start_date],[name=end_date]', function () {
                $(this).datepicker({
                    dateFormat: "yy-mm-dd"
                });
            });
        });
                </script>
<?php

/**
 * footer
 */

include_once('footer.php');
include_once('html-close.php'); 

?>

<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
