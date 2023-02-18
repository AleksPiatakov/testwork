<?php

$subMenuItems[FILENAME_STATS_PRODUCTS_PURCHASED] = MenuItemConfiguration::create()
    ->setTitle(BOX_REPORTS_PRODUCTS_PURCHASED . " " . renderTooltip(TOOLTIP_STATS_SALES_PRODUCTS_BY_TIME_PERIOD))
    ->setAccessClosure(function () {
        return true;
    })
    ->setIsActiveClosure(function(){
        return (bool)strstr($_SERVER['PHP_SELF'], FILENAME_STATS_PRODUCTS_PURCHASED);
    });


if (is_file( DIR_FS_EXT . "stats_products_purchased_by_category/admin/stats_products_purchased_by_category.php")) {
    if (getConstantValue('STATS_PRODUCTS_PURCHASED_BY_CATEGORY_MODULE_ENABLED') == 'true') {
        $subMenuItems[FILENAME_STATS_PRODUCTS_PURCHASED_BY_CATEGORY] = MenuItemConfiguration::create()
            ->setTitle(BOX_REPORTS_PRODUCTS_PURCHASED_BY_CATEGORY . " " . renderTooltip(TOOLTIP_STATS_SALES_CATEGORIES_BY_TIME_PERIOD))
            ->setAccessClosure(function () {
                return true;
            })
            ->setIsActiveClosure(function(){
                return (bool)strstr($_SERVER['PHP_SELF'], FILENAME_STATS_PRODUCTS_PURCHASED_BY_CATEGORY);
            });
    } else {
        $subMenuItems[FILENAME_STATS_PRODUCTS_PURCHASED_BY_CATEGORY] = MenuItemConfiguration::create()
            ->setTitle(BOX_REPORTS_PRODUCTS_PURCHASED_BY_CATEGORY . " " . renderTooltip(TOOLTIP_TEXT_FORBIDDEN_MODULES_TURN_ON))
            ->setAccessClosure(function () {
                return false;
            })->setIsActiveClosure(function(){
                return false;
            })->setExternalLink(tep_href_link(FILENAME_CONFIGURATION, 'gID=277'));
    }
} else {
    $subMenuItems[FILENAME_STATS_PRODUCTS_PURCHASED_BY_CATEGORY] = MenuItemConfiguration::create()
        ->setTitle(BOX_REPORTS_PRODUCTS_PURCHASED_BY_CATEGORY . " " . renderTooltip(TOOLTIP_TEXT_FORBIDDEN_MODULES_BUY))
        ->setAccessClosure(function () {
            return false;
        })->setIsActiveClosure(function(){
            return false;
        })->setExternalLink(LINK_TO_SHOP);
}


$subMenuItems[FILENAME_STATS_PRODUCTS_VIEWED] = MenuItemConfiguration::create()
    ->setTitle(TEXT_MENU_PRODUCTS_VIEWS . " " . renderTooltip(TOOLTIP_STATS_VIEWED_PRODUCTS))
    ->setAccessClosure(function () {
        return true;
    })
    ->setIsActiveClosure(function(){
        return (bool)strstr($_SERVER['PHP_SELF'], FILENAME_STATS_PRODUCTS_VIEWED);
    });


$subMenuItems[FILENAME_STATS_ZEROQTY] = MenuItemConfiguration::create()
    ->setTitle(TEXT_MENU_ZEROQTY . " " . renderTooltip(TOOLTIP_STATS_ZERO_QUANTITY_PRODUCTS))
    ->setAccessClosure(function () {
        return true;
    })
    ->setIsActiveClosure(function(){
        return (bool)strstr($_SERVER['PHP_SELF'], FILENAME_STATS_ZEROQTY);
    });



echo drawSubMenuTabs($subMenuItems);