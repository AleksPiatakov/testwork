<?php

$rootPath = dirname(dirname($_SERVER['SCRIPT_FILENAME']));
$sideApp = true;
$admin = (basename(__DIR__));
require $rootPath."/$admin/includes/application_top.php";
require_once $rootPath . '/ext/export_google_sitemap/check.php';
$googleSitemapPath = $rootPath.'/ext/export_google_sitemap/googlesitemap.php';
if (file_exists($googleSitemapPath) && defined('EXPORT_GOOGLE_SITEMAP_MODULE_ENABLED') && constant('EXPORT_GOOGLE_SITEMAP_MODULE_ENABLED') == 'true'){
    require ($googleSitemapPath);
}else{
    die('buy or enable module');
}