<?php

if (is_file( DIR_FS_EXT . "specials/admin/specials.php")) {
    if (getConstantValue('SPECIALS_MODULE_ENABLED') == 'true') {
        $subMenuItems[FILENAME_SPECIALS] = MenuItemConfiguration::create()
            ->setTitle(BOX_CATALOG_SPECIALS . " " . renderTooltip(TOOLTIP_SPECIALS))
            ->setAccessClosure(function () {
                return true;
            })
            ->setIsActiveClosure(function(){
                return (bool)strstr($_SERVER['PHP_SELF'], FILENAME_SPECIALS);
            });
    } else {
        $subMenuItems[FILENAME_SPECIALS] = MenuItemConfiguration::create()
            ->setTitle(BOX_CATALOG_SPECIALS . " " . renderTooltip(TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON))
            ->setAccessClosure(function () {
                return false;
            })->setIsActiveClosure(function(){
                return false;
            })->setExternalLink(tep_href_link(FILENAME_CONFIGURATION, 'gID=277'));
    }
} else {
    $subMenuItems[FILENAME_SPECIALS] = MenuItemConfiguration::create()
        ->setTitle(BOX_CATALOG_SPECIALS . " " . renderTooltip(TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY))
        ->setAccessClosure(function () {
            return false;
        })->setIsActiveClosure(function(){
            return false;
        })->setExternalLink(LINK_TO_SHOP);
}

if (is_file( DIR_FS_EXT . "salemaker/salemaker.php")) {
    if (getConstantValue('SALEMAKER_MODULE_ENABLED') == 'true') {
        $subMenuItems[FILENAME_SALEMAKER] = MenuItemConfiguration::create()
            ->setTitle(BOX_CATALOG_SALEMAKER . " " . renderTooltip(TOOLTIP_SALES_MAKERS))
            ->setAccessClosure(function () {
                return true;
            })
            ->setIsActiveClosure(function(){
                return (bool)strstr($_SERVER['PHP_SELF'], FILENAME_SALEMAKER);
            });
    } else {
        $subMenuItems[FILENAME_SALEMAKER] = MenuItemConfiguration::create()
            ->setTitle(BOX_CATALOG_SALEMAKER . " " . renderTooltip(TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON))
            ->setAccessClosure(function () {
                return false;
            })->setIsActiveClosure(function(){
                return false;
            })->setExternalLink(tep_href_link(FILENAME_CONFIGURATION, 'gID=277'));
    }
} else {
    $subMenuItems[FILENAME_SALEMAKER] = MenuItemConfiguration::create()
        ->setTitle(BOX_CATALOG_SALEMAKER . " " . renderTooltip(TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY))
        ->setAccessClosure(function () {
            return false;
        })->setIsActiveClosure(function(){
            return false;
        })->setExternalLink(LINK_TO_SHOP);
}

echo drawSubMenuTabs($subMenuItems);