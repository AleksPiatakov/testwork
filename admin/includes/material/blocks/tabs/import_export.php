<?php
//todo remove if it not used
if (defined('EXCEL_IMPORT_MODULE_ENABLED') && constant('EXCEL_IMPORT_MODULE_ENABLED') == 'true') {

    $subMenuItems[FILENAME_IMPORT_EXPORT.'?import_type='.basename(FILENAME_EASYPOPULATE, '.php')] = MenuItemConfiguration::create()
        ->setTitle(BOX_EXEL_IMPORT_EXPORT . " " . renderTooltip(TOOLTIP_EXPORT_IMPORT_CSV))
        ->setAccessClosure(function () {
            $file = DIR_FS_EXT . "import/import.php";
            return file_exists($file) &&
                defined('EXCEL_IMPORT_MODULE_ENABLED') &&
                constant('EXCEL_IMPORT_MODULE_ENABLED') == 'true';
        })
        ->setIsActiveClosure(function(){
            return isset($_GET['import_type']) && $_GET['import_type'] === basename(FILENAME_EASYPOPULATE, '.php');
        });
} else {
    $subMenuItems[FILENAME_IMPORT_EXPORT.'?import_type='.basename(FILENAME_EASYPOPULATE, '.php')] = MenuItemConfiguration::create()
        ->setTitle(BOX_EXEL_IMPORT_EXPORT . " " . renderTooltip(TOOLTIP_TEXT_FORBIDDEN_MODULES))
        ->setAccessClosure(function () {
            return false;
        })->setIsActiveClosure(function(){
            return false;
        })->setExternalLink(LINK_TO_SHOP);
}

if (defined('PROM_EXCEL_MODULE_ENABLED') && constant('PROM_EXCEL_MODULE_ENABLED') == 'true') {
    $subMenuItems[FILENAME_IMPORT_EXPORT.'?import_type='.basename(FILENAME_PROM, '.php')] = MenuItemConfiguration::create()
        ->setTitle(BOX_PROM_IMPORT_EXPORT . " " . renderTooltip(TOOLTIP_EXPORT_IMPORT_PROM))
        ->setAccessClosure(function () {
            $file = DIR_FS_EXT . "prom_excel/prom.php";
            return file_exists($file) &&
                defined('PROM_EXCEL_MODULE_ENABLED') &&
                constant('PROM_EXCEL_MODULE_ENABLED') == 'true';
        })
        ->setIsActiveClosure(function(){
            return isset($_GET['import_type']) && $_GET['import_type'] === basename(FILENAME_PROM, '.php');
        });
} else {
    $subMenuItems[FILENAME_IMPORT_EXPORT.'?import_type='.basename(FILENAME_PROM, '.php')] = MenuItemConfiguration::create()
        ->setTitle(BOX_PROM_IMPORT_EXPORT . " " . renderTooltip(TOOLTIP_TEXT_FORBIDDEN_MODULES))
        ->setAccessClosure(function () {
            return false;
        })->setIsActiveClosure(function(){
            return false;
        })->setExternalLink(LINK_TO_SHOP);
}

if (defined('YML_MODULE_ENABLED') && constant('YML_MODULE_ENABLED') == 'true') {
    $subMenuItems[FILENAME_IMPORT_EXPORT.'?import_type='.basename(FILENAME_YML, '.php')] = MenuItemConfiguration::create()
        ->setTitle(BOX_CATALOG_YML)
        ->setAccessClosure(function () {
            $file = DIR_FS_EXT . "yml_import/yml_import.php";
            return file_exists($file) &&
                defined('YML_MODULE_ENABLED') &&
                constant('YML_MODULE_ENABLED') == 'true';
        })
        ->setIsActiveClosure(function(){
            return isset($_GET['import_type']) && $_GET['import_type'] === basename(FILENAME_YML, '.php');
        });
} else {
    $subMenuItems[FILENAME_IMPORT_EXPORT.'?import_type='.basename(FILENAME_YML, '.php')] = MenuItemConfiguration::create()
        ->setTitle(BOX_CATALOG_YML . " " . renderTooltip(TOOLTIP_TEXT_FORBIDDEN_MODULES))
        ->setAccessClosure(function () {
            return false;
        })->setIsActiveClosure(function(){
            return false;
        })->setExternalLink(LINK_TO_SHOP);
}

echo drawSubMenuTabs($subMenuItems);