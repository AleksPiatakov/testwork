<?php
require('includes/application_top.php');
$file = DIR_FS_EXT . "quick_order/admin.php";
if(file_exists($file)) {
    require $file;
} else {
    tep_redirect(BUY_MODULES_LINK);
}