<?php

$subMenuItems[FILENAME_STATS_CUSTOMERS] = MenuItemConfiguration::create()
    ->setTitle(BOX_CLIENTS_STATS_TOP_CLIENTS)
    ->setAccessClosure(function () {
        return true;
    })
    ->setIsActiveClosure(function(){
        return (bool)strstr($_SERVER['PHP_SELF'], FILENAME_STATS_CUSTOMERS);
    });


$subMenuItems[FILENAME_STATS_OPENED_BY] = MenuItemConfiguration::create()
    ->setTitle(BOX_CLIENTS_STATS_NEW_CLIENTS)
    ->setAccessClosure(function () {
        return true;
    })
    ->setIsActiveClosure(function(){
        return (bool)strstr($_SERVER['PHP_SELF'], FILENAME_STATS_OPENED_BY);
    });


echo drawSubMenuTabs($subMenuItems);
