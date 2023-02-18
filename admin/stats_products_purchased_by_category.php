<?php
require('includes/application_top.php');
$file = DIR_FS_EXT . "stats_products_purchased_by_category/admin/stats_products_purchased_by_category.php";
if (is_file($file) && getConstantValue('STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED') == 'true') {
    require_once($file);
} else {
    include_once('html-open.php');
    include_once('header.php');
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
                                        <td class="pageHeading"><?= getTextForDisabledModule(
                            STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED_TITLE,
                                                is_file($file)
                                            ) ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
<?php
}

require_once('footer.php');
require_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
