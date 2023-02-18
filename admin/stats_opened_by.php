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
    <table border="0" width="100%" cellspacing="2" cellpadding="2" class="stats_opened_by">
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
                        <td>
                            <?php include DIR_WS_TABS . "clients_statistic.php"; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="wrapper-md">
                            <div class="bg-light lter wrapper-md ng-scope">
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
                        <td class="main wrapper-md">
                            <div class="bg-light lter wrapper-md ng-scope" style="background-color: #fff; margin: 10px 0 12px 0;">
                                <?php
                                $sold_by_array[] = array('text' => 'All', 'id' => 0);

                                $sold_by_query = tep_db_query("select admin_id, admin_firstname, admin_lastname from " . TABLE_ADMIN . " ");
                                while($sold_by = tep_db_fetch_array($sold_by_query))
                                    $sold_by_array[] = array('text' => $sold_by['admin_firstname'].' '.$sold_by['admin_lastname'], 'id' => $sold_by['admin_id']);

                                echo tep_draw_form('date_range','stats_opened_by.php' , '', 'get');
                                //                                echo 'New Accounts Opened For:'.tep_draw_pull_down_menu('sold_by', $sold_by_array, $_GET['sold_by'],'style="width: 150px;margin: 0 10px;"');
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
                                                <td class="dataTableHeadingContent" width="100"><?=DATE?></td>
                                                <td class="dataTableHeadingContent"><?=TOTAL_ACCOUNTS_OPENED?></td>
                                                <td class="dataTableHeadingContent"><?=TOTAL_ORDERS_CREATED?></td>
                                            </tr>
                                            <?php

                                            $entity = 0;
                                            $total = 0;

                                            function merge_by_date(array $arr1, array $arr2) {
                                                $result = [];

                                                foreach ($arr1 as $value) {

                                                    $key = array_search($value['date'], array_column($arr2, 'date'));

                                                    if($key !== false) {
                                                        $result[] = array_merge($value, $arr2[$key]);
                                                        unset($arr2[$key]);
                                                    } else {
                                                        $result[] = $value;
                                                    }
                                                }
                                                $result = array_merge($result, $arr2);

                                                return $result;
                                            }
                                            if (isset($_GET['start_date'])) {
                                                $start_date = $_GET['start_date'];
                                                $start_date = strtotime($start_date);
                                                $start_date = date('d.m.Y',$start_date);
                                            } else {
                                                $start_date = date('01.m.Y');
                                            }

                                            if (isset($_GET['end_date'])) {
                                                $end_date = $_GET['end_date'];
                                                $end_date = strtotime($end_date);
                                                $end_date = date('d.m.Y',$end_date);
                                            } else {
                                                $end_date = date('d.m.Y');
                                            }

                                            if($_GET['start_date']!='' and $_GET['end_date']!='') $dates_sql = "(date(ci.customers_info_date_account_created) BETWEEN str_to_date('" . $start_date . "', '%d.%m.%Y') AND str_to_date('" . $end_date . "', '%d.%m.%Y'))";
                                            else $dates_sql = "1=1";

                                            if($_GET['sold_by']!=0 and $_GET['sold_by']!='') $sold_by_sql = "and c.sold_by = '".(int)$_GET['sold_by']."'";

                                            $customers_query_raw = "select count(*) as total_account, DATE(ci.customers_info_date_account_created) as date from " . TABLE_CUSTOMERS . " c, " . TABLE_CUSTOMERS_INFO . " ci where ".$dates_sql." ".$sold_by_sql." and c.customers_id = ci.customers_info_id group by date order by ci.customers_info_date_account_created desc limit 100";
                                            $orders_query_raw = "SELECT
                                                                   count(*)                   AS `total_orders`,
                                                                   DATE(`o`.`date_purchased`) AS `date`
                                                                 FROM `orders` `o`
                                                                 WHERE (DATE(`o`.`date_purchased`) BETWEEN str_to_date('{$start_date}', '%d.%m.%Y') AND str_to_date('{$end_date}', '%d.%m.%Y'))
                                                                 GROUP BY `date`
                                                                 ORDER BY `o`.`date_purchased` DESC
                                                                 LIMIT 100";
                                            $customers_query = tep_db_query($customers_query_raw);
                                            $stats = [];
                                            while ($customers = tep_db_fetch_array($customers_query)){
                                                $stats[$customers['date']] = [
                                                  'total_account'=>$customers['total_account'],
                                                  'total_orders'=>0,
                                                  'date'=>$customers['date']
                                                ];
                                            }
                                            $orders_query = tep_db_query($orders_query_raw);
                                            while ($orders = tep_db_fetch_array($orders_query)){
                                                $stats[$orders['date']] = [
                                                  'total_account'=>isset($stats[$orders['date']])?$stats[$orders['date']]['total_account']:0,
                                                  'total_orders'=>$orders['total_orders'],
                                                  'date'=>$orders['date']
                                                ];
                                            }
                                            usort($stats,function($a,$b){
                                                $a_timestamp = strtotime($a['date']);
                                                $b_timestamp = strtotime($b['date']);
                                                return $a_timestamp <= $b_timestamp ? 1 : 0;
                                            });
                                            if(count($stats)>0) {
                                                foreach ($stats as $customers){

                                                    $accounts+=$customers['total_account'];
                                                    $orders+=$customers['total_orders'];

                                                    $date = date_create_from_format('Y-m-d', $customers['date']);
                                                    $date = @date_format($date,'d/m/Y');

                                                    ?>
                                                    <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
                                                        <td class="dataTableContent"><?php echo $date; ?></td>
                                                        <td class="dataTableContent"><?php echo $customers['total_account']; ?></td>
                                                        <td class="dataTableContent"><?php echo $customers['total_orders']; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                <tr class="dataTableRow">
                                                    <td class="dataTableContent"><b>TOTAL</b></td>
                                                    <td class="dataTableContent"><b><?php echo $accounts; ?></b></td>
                                                    <td class="dataTableContent"><b><?php echo $orders; ?></b></td>
                                                </tr>
                                                <?php
                                            } else {
                                                echo '<tr><td colspan="4" align="center">NO REPORTS FOUND</td></tr>';
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
