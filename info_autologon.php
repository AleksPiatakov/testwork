<?php
/*
  $Id: info_autologon.php,v 1.01 2002/10/08 12:00:00

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  Copyright (c) 2002 HMCservices
  Released under the GNU General Public License
*/

require("includes/application_top.php");

includeLanguages(DIR_WS_LANGUAGES . $language . '/' . "info_autologon.php");
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <title><?php echo TITLE ?></title>
    <base href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<p class="main"><b><?php echo HEADING_TITLE; ?></b><br></p>
<p class="main"><b><i><?php echo SUB_HEADING_TITLE_1; ?></i></b><br><?php printf(SUB_HEADING_TEXT_1, STORE_NAME); ?></p>
<p class="main"><b><i><?php echo SUB_HEADING_TITLE_2; ?></i></b><br><?php printf(SUB_HEADING_TEXT_2, STORE_NAME); ?></p>
<p class="main"><b><i><?php echo SUB_HEADING_TITLE_3; ?></i></b><br><?php printf(SUB_HEADING_TEXT_3, STORE_NAME); ?></p>
<p align="right" class="main">
    <a href="javascript:window.close();"><?php echo TEXT_CLOSE_WINDOW; ?></a>
</p>
</body>
</html>
<?php
require("includes/counter.php");
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
