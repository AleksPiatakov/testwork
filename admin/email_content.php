<?php

require_once('includes/application_top.php');

$file = DIR_FS_EXT . "email_content/admin/email_content.php";
if (is_file($file) && getConstantValue('EMAIL_CONTENT_MODULE_ENABLED') == 'true') {
    require_once($file);
} else {
    include_once('html-open.php');
    include_once('header.php');
}

include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');