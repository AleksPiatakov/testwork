<?php
require('includes/application_top.php');
$file = DIR_FS_EXT . "salemaker/admin/salemaker.php";

if (is_file($file) && getConstantValue('SALEMAKER_MODULE_ENABLED') == 'true') {
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
            <script type="text/javascript" src="../includes/javascript/lib/jquery-3.3.1.min.js"></script>
            <script type="text/javascript" src="includes/javascript/jquery-ui-1.9.2.custom.min.js"></script>
            <link rel="stylesheet" href="../includes/javascript/jqueryui/css/smoothness/jquery-ui-1.10.4.custom.min.css">
            <script type="text/javascript" src="includes/autocomplete/jquery.autocomplete.js"></script>
            <script type="text/javascript" src="includes/autocomplete/ac.js"></script>
            <link type="text/css" rel="stylesheet" href="includes/autocomplete/ac.css"/>
        </head>
    <body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
    <!-- header //-->
    <!-- header_smend //-->
    <!-- body //-->
    <table class="table_specials" border="0" width="100%" cellspacing="2" cellpadding="2">
        <tr>
            <td width="100%">
                <?php include DIR_WS_TABS . "products_discounts.php"; ?>
            </td>
        </tr>
        <tr>
            <td align="center" class="main">
                <?= getTextForDisabledModule(BOX_CATALOG_SALEMAKER, is_file($file)) ?>
            </td>
        </tr>
    </table>
<?php
}

require_once('footer.php');
require_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
