<?php

/**
 * Google XML Sitemap Feed Cron Script
 *
 * The Google sitemap service was announced on 2 June 2005 and represents
 * a huge development in terms of crawler technology.  This contribution is
 * designed to create the sitemap XML feed per the specification delineated
 * by Google.  This cron script will call the code to create the scripts and
 * eliminate the session auto start issues.
 * @package Google-XML-Sitemap-Feed
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.2
 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @link http://www.google.com/webmasters/sitemaps/docs/en/about.html About Google Sitemap
 * @copyright Copyright 2005, Bobby Easland
 * @author Bobby Easland
 * @version 2
 * @link http://www.eurobigstore.com
 * @link http://www.google.com/webmasters/sitemaps/docs/en/about.html About Google Sitemap
 * @copyright Copyright 2006, Davide Duca
 * @author Davide Duca
 * @filesource
 */

chdir('../../');
$language = $_GET['lang'];
require('includes/application_top.php');
includeLanguages(DIR_WS_LANGUAGES . $language . '/' . FILENAME_GOOGLE_SITEMAP);
//  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_GOOGLE_SITEMAP));

chdir('../');

/**
 * Option to compress the files
 */

define('GOOGLE_SITEMAP_COMPRESS', 'false');
/**
 * Option for change frequency of products
 */

define('GOOGLE_SITEMAP_PROD_CHANGE_FREQ', 'weekly');
/**
 * Option for change frequency of categories
 */

define('GOOGLE_SITEMAP_CAT_CHANGE_FREQ', 'weekly');
/**
 * Carried over from application_top.php for compatibility
 */
/*
    require_once('includes/configure.php');

    define('DIR_WS_CATALOG', DIR_WS_HTTP_CATALOG);

    require_once(DIR_WS_INCLUDES . 'filenames.php');
    require_once(DIR_WS_INCLUDES . 'database_tables.php');
    require_once(DIR_WS_FUNCTIONS . 'database.php');
    require_once(DIR_WS_FUNCTIONS . 'general.php');


    tep_db_connect() or die('Unable to connect to database server!');   */

$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);

while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
}

//function tep_not_null($value) {
//if (is_array($value)) {
//  if (sizeof($value) > 0) {
//return true;
//  } else {
//return false;
//  }
//} else {
//  if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
//return true;
//  } else {
//return false;
//  }
//}
//} # end function

if (!is_object($lng)) {
    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language();
}
$languages_id = $lng->language['id'];

//if ( defined('SEO_URLS') && SEO_URLS == 'true' || defined('SEO_ENABLED') && SEO_ENABLED == 'true' ) {


require_once('sitemap.class.php');

$google = new GoogleSitemap(DB_SERVER, DB_SERVER_USERNAME, DB_DATABASE, DB_SERVER_PASSWORD);
$submit = true;
echo '<pre>';

if ($google->GenerateProductSitemap()) {
    echo GOOGLE_SITEMAPS_PRODUCT_SUCCESS . "\n\n";
} else {
    $submit = false;

    echo GOOGLE_SITEMAPS_PRODUCT_ERROR . "\n\n";
}

if ($google->GenerateImageSitemap()) {
    echo GOOGLE_SITEMAPS_IMAGE_SUCCESS . "\n\n";
} else {
    $submit = false;

    echo GOOGLE_SITEMAPS_IMAGE_ERROR . "\n\n";
}

if ($google->GenerateCategorySitemap()) {
    echo GOOGLE_SITEMAPS_CATEGORY_SUCCESS . "\n\n";
} else {
    $submit = false;

    echo GOOGLE_SITEMAPS_CATEGORY_ERROR . "\n\n";
}
if ($google->GenerateArticlesSitemap()) {
    echo GOOGLE_SITEMAPS_ARTICLES_SUCCESS . "\n\n";
} else {
    $submit = false;

    echo GOOGLE_SITEMAPS_ARTICLES_ERROR . "\n\n";
}

if ($google->GenerateSitemapIndex()) {
    echo GOOGLE_SITEMAPS_INDEX_SUCCESS . "\n\n";
} else {
    $submit = false;

    echo GOOGLE_SITEMAPS_INDEX_ERROR . "\n\n";
}

if ($submit) {
    echo GOOGLE_SITEMAPS_CONGRATULATION . "\n\n";

    echo GOOGLE_SITEMAPS_ALREADY_SUBMITTED . "\n";

    echo GOOGLE_SITEMAPS_HIGHLY_RECCOMMEND . "\n\n";

    echo $google->GenerateSubmitURL() . "\n\n";

    echo GOOGLE_SITEMAPS_CONVENIENCE . "\n";

    echo 'php ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/sitemaps.index.php' . "\n\n";

    echo GOOGLE_SITEMAPS_HERE_INDEX . $google->base_url . 'sitemap.xml' . "\n";

    echo GOOGLE_SITEMAPS_HERE_PRODUCT . $google->base_url . 'sitemapproducts.xml' . "\n";

    echo GOOGLE_SITEMAPS_HERE_CATEGORY . $google->base_url . 'sitemapcategories.xml' . "\n";
    echo GOOGLE_SITEMAPS_HERE_ARTICLES . $google->base_url . 'sitemaparticles.xml' . "\n";
    echo GOOGLE_SITEMAPS_HERE_IMAGE . $google->base_url . 'sitemapimages.xml' . "\n";
} else {
    print_r($google->debug);
}

echo '</pre>';

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
    <script language="javascript" src="includes/general.js?t=<?= filesize(__DIR__ . DIRECTORY_SEPARATOR . DIR_WS_INCLUDES . 'general.js') ?>"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
