<?php

require('includes/application_top.php');
$file = DIR_FS_EXT . "stats_keywords_popular/admin/stats_keywords_popular.php";
if (is_file($file) && getConstantValue('STATS_KEYWORDS_POPULAR_ENABLED') == 'true') {
    require_once($file);
} else {
    include_once('html-open.php');
    include_once('header.php');
    ?>
    <div class="container backup">
        <h2><?= getTextForDisabledModule(STATS_KEYWORDS_POPULAR_ENABLED_TITLE, is_file($file)) ?></h2>
    </div>
    <?php
}

require_once('footer.php');
require_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
