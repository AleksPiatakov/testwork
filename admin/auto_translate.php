<?php

require_once('includes/application_top.php');

$file = DIR_FS_EXT . "auto_translate/admin/auto_translate.php";
if (is_file($file) && getConstantValue('AUTO_TRANSLATE_MODULE_ENABLED') == 'true') {
    if (file_exists(DIR_FS_EXT . 'auto_translate/languages/' . $language . '/auto_translate.json')) {
        includeLanguages(DIR_FS_EXT . 'auto_translate/languages/' . $language . '/auto_translate.json');
    } elseif (file_exists(DIR_FS_EXT . 'auto_translate/languages/english/auto_translate.json')) {
        includeLanguages(DIR_FS_EXT . 'auto_translate/languages/english/auto_translate.json');
    }
    ini_set('memory_limit', '-1');
    require_once($file);
} else {
    include_once('html-open.php');
    include_once('header.php');
    ?>
    <div class="container backup">
        <h2><?= getTextForDisabledModule(AUTO_TRANSLATE_MODULE_ENABLED_TITLE, is_file($file)) ?></h2>
    </div>
    <?php
}

include_once('footer.php');
include_once('html-close.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
