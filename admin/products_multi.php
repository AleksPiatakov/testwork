<?php
/*
  $Id: products_multi.php, v 2.6

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');
$file = DIR_FS_EXT . "products_multi/admin/products_multi.php";
if (is_file($file) && getConstantValue('PRODUCTS_MULTI_ENABLED') == 'true') {
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
            <td align="center" class="main">
                <?= getTextForDisabledModule(PRODUCTS_MULTI_ENABLED_TITLE, is_file($file)) ?>
            </td>
        </tr>
    </table>
<?php
}

require_once('footer.php');
require_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
