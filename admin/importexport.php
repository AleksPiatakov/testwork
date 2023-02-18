<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes/application_top.php');
switch ($_GET['import_type']) {
    case 'easypopulate':
        $file = __DIR__ . "/easypopulate.php";
        $const = 'EXCEL_IMPORT_MODULE_ENABLED';
        require_once(__DIR__ . DIRECTORY_SEPARATOR . 'includes/languages/' . $language . '/easypopulate.php');
        break;
    case 'prom':
        $file = DIR_FS_EXT . "prom_excel/prom.php";
        $const = 'PROM_EXCEL_MODULE_ENABLED';
        break;
    case 'yml':
        $file = DIR_FS_EXT . "yml_import/yml_import.php";
        $const = 'YML_MODULE_ENABLED';
        break;
    default:
        $file = '';
        $const = '';
}
$filePath = checkModuleIsActiveAndExist($file, $const) ? $file : '';
function checkModuleIsActiveAndExist($file, $const)
{
    return file_exists($file) && defined($const) && constant($const) == 'true';
}

if ($_GET['download'] !== 'activestream') {
    require_once(__DIR__ . DIRECTORY_SEPARATOR . 'html-open.php');
    require_once(__DIR__ . DIRECTORY_SEPARATOR . 'header.php');
    ?>
    <div class="container">
        <div class="col-md-12">
            <?php require_once(__DIR__ . DIRECTORY_SEPARATOR . "includes/material/blocks/tabs/import_export.php") ?>
        </div>
    </div>
<?php }
if ($filePath) {
    require_once($filePath);
}
require_once('footer.php');
require_once('html-close.php');
require_once(DIR_WS_INCLUDES . 'application_bottom.php');