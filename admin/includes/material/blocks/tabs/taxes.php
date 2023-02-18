<?php

$subMenuItems[FILENAME_TAX_CLASSES] = MenuItemConfiguration::create()
    ->setTitle(BOX_TAXES_TAX_CLASSES . " " . renderTooltip(TOOLTIP_TAX_ADD))
    ->setAccessClosure(function () {
        return true;
    })
    ->setIsActiveClosure(function(){
        return (bool)strstr($_SERVER['PHP_SELF'], FILENAME_TAX_CLASSES);
    });


$subMenuItems[FILENAME_TAX_RATES] = MenuItemConfiguration::create()
    ->setTitle(BOX_TAXES_TAX_RATES . " " . renderTooltip(TOOLTIP_TAX_RATE_ADD))
    ->setAccessClosure(function () {
        return true;
    })
    ->setIsActiveClosure(function(){
        return (bool)strstr($_SERVER['PHP_SELF'], FILENAME_TAX_RATES);
    });


$subMenuItems[FILENAME_GEO_ZONES] = MenuItemConfiguration::create()
    ->setTitle(BOX_TAXES_GEO_ZONES . " " . renderTooltip(TOOLTIP_TAX_ZONE_ADD))
    ->setAccessClosure(function () {
        return true;
    })
    ->setIsActiveClosure(function(){
        return (bool)strstr($_SERVER['PHP_SELF'], FILENAME_GEO_ZONES);
    });

echo drawSubMenuTabs($subMenuItems);