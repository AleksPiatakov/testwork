<?php
/*
  no photo, by solomono.net 18.08.18
*/

require('includes/application_top.php');
?>

<?php


include_once('html-open.php');
include_once('header.php');

?>

<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" href="includes/solomono/css/overwrite.css" type="text/css"/>
<div class="container edit_orders">

    <!-- body //-->
    <table border="0" width="100%" cellspacing="2" cellpadding="2" class="stats_nophoto">
        <tr>
            <!-- body_text //-->
            <td width="100%" valign="top">
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="wrapper-md">
                            <div class="bg-light lter wrapper-md ng-scope" style="background: #f0f3f4;">
                                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="m-n font-thin h3"><?= HEADING_TITLE ?></td>
                                        <td class="pageHeading"
                                            align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="wrapper-md">
                            <table border="0" width="100%" cellspacing="0" cellpadding="0"
                                   class="stats_products_viewed">
                                <tr>
                                    <td valign="top" class=" panel panel-default">
                                        <table border="0" width="100%" cellspacing="0" cellpadding="2"
                                               class="table table-bordered table-hover table-condensed bg-white-only b-t b-light">
                                            <tr class="dataTableHeadingRow" style="background: #fff;">
                                                <td class="dataTableHeadingContent"><?= NAME ?></td>
                                                <td class="dataTableHeadingContent"><?= MODEL ?></td>
                                                <td class="dataTableHeadingContent"><?= IMAGE ?></td>
                                            </tr>
                                            <?php
                                            if (isset($_GET['page']) && ($_GET['page'] > 1)) $rows = $_GET['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;

                                            $products_query_raw = "SELECT `p`.`products_id`, `p`.`products_model`, `p`.`products_image`, `pd`.`products_name` FROM " . TABLE_PRODUCTS . " `p`, " . TABLE_PRODUCTS_DESCRIPTION . " `pd` WHERE `p`.`products_id` = `pd`.`products_id` group by pd.products_id";
                                            $products_query = tep_db_query($products_query_raw);
                                            while ($products = tep_db_fetch_array($products_query)) {
                                                $products_images = explode(';', $products['products_image']);
                                                foreach ($products_images as $image) {
                                                    if ($image == '' || !file_exists(DIR_FS_CATALOG . 'images/products/' . $image)) { ?>
                                                        <tr class="dataTableRow"
                                                            onmouseover="<!---rowOverEffect(this)-->"
                                                            onmouseout="<!---rowOutEffect(this)-->">
                                                            <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS, 'action=new_product&read=only&pID=' . $products['products_id'] . '&origin=' . FILENAME_STATS_PRODUCTS_VIEWED, 'NONSSL') . '">' . $products['products_name'] . '</a>'; ?></td>
                                                            <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS, 'action=new_product&read=only&pID=' . $products['products_id'] . '&origin=' . FILENAME_STATS_PRODUCTS_VIEWED, 'NONSSL') . '">' . $products['products_model'] . '</a>'; ?></td>
                                                            <td>
                                                                <a href="<?php echo HTTP_SERVER . '/images/products/' . $image; ?>"><?php echo $image == '' ? TEXT_IMAGE_NONEXISTENT : $image; ?></a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                            if (!$products) { ?>
                                                <tr class="dataTableRow" onmouseover="<!---rowOverEffect(this)-->"
                                                    onmouseout="<!---rowOutEffect(this)-->">
                                                    <td colspan="3" class="dataTableContent text-center"><?= TEXT_EMPTY_PRODUCT ?></td>
                                                </tr>
                                                <?
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
</div>
<?php

/**
 * footer
 */

include_once('footer.php');
include_once('html-close.php');

?>

<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
