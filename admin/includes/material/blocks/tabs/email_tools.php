<?php

$subMenuItems[FILENAME_MAIL] = MenuItemConfiguration::create()
    ->setTitle(BOX_TOOLS_MAIL . " " . renderTooltip(TOOLTIP_EMAILING))
    ->setAccessClosure(function () {
        return true;
    })
    ->setIsActiveClosure(function(){
        return (bool)strstr($_SERVER['PHP_SELF'], FILENAME_MAIL);
    });


$subMenuItems[FILENAME_NEWSLETTERS] = MenuItemConfiguration::create()
    ->setTitle(BOX_MENU_TOOLS_MASS_EMAILS . " " . renderTooltip(TOOLTIP_MASS_EMAILING))
    ->setAccessClosure(function () {
        return true;
    })
    ->setIsActiveClosure(function(){
        return (bool)strstr($_SERVER['PHP_SELF'], FILENAME_NEWSLETTERS);
    });


echo drawSubMenuTabs($subMenuItems);