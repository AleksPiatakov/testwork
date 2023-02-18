<?php
/*

  $Id: stats_products_purchased.php,v 1.29 2003/06/29 22:50:52 hpdl Exp $
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2003 osCommerce
  Released under the GNU General Public License */

if (isset($_GET['start_date'])) {
    $start_date = $_GET['start_date'];
} else {
    $start_date = date('Y-m-01');
}

if (isset($_GET['end_date'])) {
    $end_date = $_GET['end_date'];
} else {
    $end_date = date('Y-m-d');
}

include_once('html-open.php');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <link rel="stylesheet" href="includes/solomono/css/overwrite.css" type="text/css"/>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<?php

/**
 * header
 */

if ($printable != 'on') {
    include_once('header.php');
    include DIR_WS_TABS . "products_statistic.php";
}
?>
<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2" class="stats_products_purchased_by_category">
    <tr>
        <!-- body_text //-->
        <td width="100%" valign="top">
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                    <td>
                        <table border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                                <td class="pageHeading" align="right"><?php echo tep_draw_separator(
                                        'pixel_trans.png',
                                        HEADING_IMAGE_WIDTH,
                                        HEADING_IMAGE_HEIGHT
                                    ); ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="text-align:left;">
                    <td class="border-top" style="background: #fff; padding-left: 10px;">
                        <table border="0" width="100%" cellspacing="0" cellpadding="2" style="margin: 10px 0 10px 0;">
                            <tr>
                                <td></td>
                                <td class="main">
                                    <?php
                                    echo tep_draw_form(
                                        'date_range',
                                        'stats_products_purchased_by_category.php',
                                        '',
                                        'get'
                                    );
                                    echo ENTRY_STARTDATE . tep_draw_input_field('start_date', $start_date);
                                    echo ' <td> ';
                                    echo '<label>' . ENTRY_TODATE . tep_draw_input_field(
                                            'end_date',
                                            $end_date
                                        ) . '</label>';
                                    echo '<label>' . ENTRY_PRINTABLE . tep_draw_checkbox_field(
                                            'printable',
                                            $print
                                        ) . '</label>';
                                    echo '<input type="submit" value="' . ENTRY_SUBMIT . '">';
                                    echo '</td></form>';
                                    $totalgross = 0;
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" width="100%" cellspacing="0" cellpadding="2"
                               class="table table-hover table-bordered bg-white-only b-t b-light">
                            <thead>
                            <tr class="dataTableHeadingRow">
                                <td class="dataTableHeadingContent"
                                    style="width: 40px"><?php echo TABLE_HEADING_NUMBER; ?></td>
                                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CATEGORY; ?></td>
                                <td class="dataTableHeadingContent"
                                    align="center"><?php echo TABLE_HEADING_PURCHASED; ?>&nbsp;
                                </td>
                                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_GROSS; ?>
                                    &nbsp;
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $products_query_raw = "
                                select 
                                    op.products_id, 
                                    op.products_model, 
                                    op.products_name, 
                                    sum(op.products_quantity) as quantitysum , 
                                    sum(op.products_price*op.products_quantity) as gross 
                                FROM 
                                    " . TABLE_ORDERS . " as o, 
                                    " . TABLE_ORDERS_PRODUCTS . " AS op 
                                WHERE 
                                    o.date_purchased BETWEEN '" . $start_date . "' AND '" . $end_date . " 23:59:59' AND 
                                    o.orders_id = op.orders_id 
                                GROUP BY op.products_id ";
                            if ($gross == 'on') {
                                $products_query_raw .= "ORDER BY gross DESC,quantitysum DESC, op.products_model";
                            } else {
                                $products_query_raw .= "ORDER BY quantitysum DESC, op.products_model";
                            }

                            $rows = 0;
                            $products_query = tep_db_query($products_query_raw);
                            /**
                             * Получаем список товаров и категорий: товар(ид) -- категория(ид)
                             */

                            //$products_to_categories_query = tep_db_query("SELECT `products_id`, `categories_id` FROM " . TABLE_PRODUCTS_TO_CATEGORIES);
                            //$products_to_categories_array = array();
                            //while($row = tep_db_fetch_array($products_to_categories_query))
                            //$products_to_categories_array[$row['products_id']] = $row['categories_id'];
                            //debug($products_to_categories_array);

                            $category_description_query = tep_db_query("SELECT `categories_id`, `categories_name` FROM " . TABLE_CATEGORIES_DESCRIPTION);
                            $category_description_array = array();
                            while ($row = tep_db_fetch_array($category_description_query)) {
                                $category_description_array[$row['categories_id']] = $row['categories_name'];
                            }

                            $totalGrossForCategory = [];
                            foreach ($category_description_array as $category_id => $category_name) {
                                $totalGrossForCategory[$category_id] = 0;
                            }

                            $totalQuantityPurchased[$category_id] = 0;
                            $products_to_categories_array = array();

                            while ($products = tep_db_fetch_array($products_query)) {
                                $rows++;
                                $products_to_categories_query = tep_db_query("
                                    SELECT 
                                        `products_id`, 
                                        `categories_id` 
                                    FROM 
                                        " . TABLE_PRODUCTS_TO_CATEGORIES . " 
                                    WHERE 
                                        `products_id` = '" . $products['products_id'] . "'");
                                $row = tep_db_fetch_array($products_to_categories_query);
                                $products_to_categories_array[$row['products_id']] = $row['categories_id'];
                                $totalgross = $totalgross + $products['gross'];
                                $totalQuantityPurchased[$products_to_categories_array[$products['products_id']]] += $products['quantitysum'];
                                $totalGrossForCategory[$products_to_categories_array[$products['products_id']]] += $products['gross'];

                                if (strlen($rows) < 2) {
                                    $rows = '0' . $rows;
                                }
                                ?>
                                <!--<tr bgcolor="--><?php //echo ((++$cnt)%2==0) ? '#e0e0e0' : '#ffffff'
                                ?><!--">-->
                                <!--<td class="dataTableContent">--><?php //echo $rows  ;
                                ?><!--.</td>-->
                                <!--<td class="dataTableContent">--><?php //echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=new_product_preview&read=only&pID=' . $products['products_id'] . '&origin=' . FILENAME_STATS_PRODUCTS_PURCHASED . '?page=' . $_GET['page'], 'NONSSL') . '">' . $category_description_array[$products_to_categories_array[$products['products_id']]] . '</a>';
                                ?><!--</td>-->
                                <!--<td class="dataTableContent" align="center">--><?php //echo $products['quantitysum'];
                                ?><!--&nbsp;</td>-->
                                <!--<td class="dataTableContent" align="right">--><?php //echo sprintf("%01.2f", $products['gross']);
                                ?><!--&nbsp;</td>-->
                                <!--</tr>-->
                                <?php
                            }

                            $cnt = 0; //$totalPurchasedForCategory = [];
                            foreach ($totalGrossForCategory as $key => $value) { ?>
                                <tr bgcolor="<?php ++$cnt ?>">
                                    <td class=""><?php echo $cnt; ?>.</td>
                                    <td class=""><?php echo $category_description_array[$key]; ?></td>
                                    <td class="" align="center"><?php echo $totalQuantityPurchased[$key] ?: 0; ?>&nbsp;
                                    </td>
                                    <td class="" align="right"><?php echo sprintf("%01.2f", $value); ?>&nbsp;</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="dataTableContent" align="right" colspan="5"
                                    style="border: 1px solid #eaeaea;">
                                    <b><?php echo ENTRY_TOTAL ?>:</b><b><?php echo sprintf("%01.2f", $totalgross); ?>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- body_text_smend //-->
        </td>
    </tr>
</table>
<!-- body_smend //-->
<!-- footer //-->
<?php
if ($printable != 'on') {
    require(DIR_WS_INCLUDES . 'footer.php');
}
?>
