<?php

require_once('includes/application_top.php');

$file = DIR_FS_EXT . "api/admin/api_keys.php";
if (is_file($file) && getConstantValue('API_ENABLED') == 'true') {
    require_once($file);
} else {
    include_once('html-open.php');
    include_once('header.php');
    ?>
    <div class="container backup">
        <h2><?= getTextForDisabledModule('API', is_file($file)) ?></h2>
    </div>
    <?php
}

include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');