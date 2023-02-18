<?php

/**
 * Created by PhpStorm.
 * User: Serhii
 * Date: 22.02.2020
 * Time: 21:09
 */

ini_set('max_execution_time', '0');
ini_set('memory_limit', '1024M');
ini_set('display_errors', '1');

require DIR_WS_CLASSES . 'sitemap/loader.php';


$typeCheck = !empty($_GET['type']) && in_array($_GET['type'], Sitemap::$types);
$type = $typeCheck ? $_GET['type'] : '';

switch ($type) {
    case 'categories':
        $linkBuilder = new CategoryLink();
        $format = new XmlDefaultFormat($linkBuilder);
        $xmlType = new Categories($format);
        break;
    case 'products':
        $linkBuilder = new ProductLink();
        $format = new XmlDefaultFormat($linkBuilder);
        $xmlType = new Products($format);
        break;
    case 'articles':
        $linkBuilder = new ArticleLink();
        $format = new XmlArticleFormat($linkBuilder);
        $xmlType = new Articles($format);
        break;
    case 'manufacturers':
        $linkBuilder = new ManufacturerLink();
        $format = new XmlDefaultFormat($linkBuilder);
        $xmlType = new Manufacturers($format);
        break;
    case 'images':
        $linkBuilder = new ProductLink();
        $format = new XmlImageFormat($linkBuilder);
        $xmlType = new Images($format);
        break;
// add alot of links
//    case 'filters':
//        $linkBuilder = new FilterLink();
//        $format = new XmlFilterFormat($linkBuilder);
//        $xmlType = new Filters($format);
//        break;
    /*case 'categorybrand':
        $linkBuilder = new FilterLink();
        $format = new XmlFilterFormat($linkBuilder);
        $xmlType = new CategoryBrand($format);
        break;*/
    case 'seo_filters':
        $customSeoUrlList = getCustomSeoUrlsList();
        $linkBuilder = new FilterLink();
        $format = new XmlSeoFilterFormat($linkBuilder);
        $xmlType = new SeoFilters($format);
        $optionValuesUrls = getOptionValuesSeoUrlsList();
        break;
    default:
        $linkBuilder = new XmlLink();
        $format = new XmlIndexFormat($linkBuilder);
        $xmlType = new Index($format);
        break;
}
$builder = new Sitemap($xmlType);
$builder->getData()->buildSitemap();
