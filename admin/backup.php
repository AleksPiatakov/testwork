<?php
/*
  $Id: products_multi.php, v 2.6

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');
require ("includes/languages/$language/products_multi.php");

$file = DIR_FS_EXT . "backup/admin/backup.php";
if (is_file($file) && getConstantValue('BACKUP_ENABLED') == 'true') {
    require_once($file);
} else {
    include_once('html-open.php');
    include_once('header.php');
?>
   <div class="container backup">
       <h2><?= getTextForDisabledModule(TEXT_DUMPER_HEADER_TITLE, is_file($file)) ?></h2>
   </div>
<?php
}

include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
