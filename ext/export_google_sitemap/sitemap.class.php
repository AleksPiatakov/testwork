<?php

/**
 * Google XML Sitemap Feed
 *
 * The Google sitemap service was announced on 2 June 2005 and represents
 * a huge development in terms of crawler technology.  This contribution is
 * designed to create the sitemap XML feed per the specification delineated
 * by Google.
 * @package Google-XML-Sitemap-Feed
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.0
 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @link http://www.google.com/webmasters/sitemaps/docs/en/about.html About Google Sitemap
 * @copyright Copyright 2005, Bobby Easland
 * @author Bobby Easland
 * @version 2.0
 * @link http://www.eurobigstore.com
 * @link http://www.google.com/webmasters/sitemaps/docs/en/about.html About Google Sitemap
 * @copyright Copyright 2006, Davide Duca
 * @author Davide Duca
 * @filesource
 */

/**
 * MySQL_Database Class
 *
 * The MySQL_Database class provides abstraction so the databaes can be accessed
 * without having to use tep API functions. This class has minimal error handling
 * so make sure your code is tight!
 * @package Google-XML-Sitemap-Feed
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.1
 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @copyright Copyright 2005, Bobby Easland
 * @author Bobby Easland
 */
class MySQL_DataBase
{

    /**
     * Database host (localhost, IP based, etc)
     * @var string
     */

    var $host;

    /**
     * Database user
     * @var string
     */

    var $user;

    /**
     * Database name
     * @var string
     */

    var $db;

    /**
     * Database password
     * @var string
     */

    var $pass;

    /**
     * Database link
     * @var resource
     */

    var $link_id;

    /**
     * MySQL_DataBase class constructor
     * @param string $host
     * @param string $user
     * @param string $db
     * @param string $pass
     * @author Bobby Easland
     * @version 1.0
     */

    function __construct($host, $user, $db, $pass)
    {

        $this->host = $host;

        $this->user = $user;

        $this->db = $db;

        $this->pass = $pass;

        $this->ConnectDB();

        $this->SelectDB();
    } # end function

    /**
     * Function to connect to MySQL
     * @author Bobby Easland
     * @version 1.0
     */

    function ConnectDB()
    {

        $this->link_id = tep_db_connect($this->host, $this->user, $this->pass);
    } # end function

    /**
     * Function to select the database
     * @return resoource
     * @version 1.0
     * @author Bobby Easland
     */

    function SelectDB()
    {

        return mysqli_select_db($this->link_id, $this->db);
    } # end function

    /**
     * Function to perform queries
     * @param string $query SQL statement
     * @return resource
     * @author Bobby Easland
     * @version 1.0
     */

    function Query($query)
    {

        return tep_db_query($query, $this->link_id);
    } # end function

    /**
     * Function to fetch array
     * @param resource $resource_id
     * @param string $type MYSQL_BOTH or MYSQL_ASSOC
     * @return array
     * @version 1.0
     * @author Bobby Easland
     */

    function FetchArray($resource_id, $type = MYSQLI_BOTH)
    {

        return tep_db_fetch_array($resource_id, $type);
    } # end function

    /**
     * Function to fetch the number of rows
     * @param resource $resource_id
     * @return mixed
     * @author Bobby Easland
     * @version 1.0
     */

    function NumRows($resource_id)
    {

        return tep_db_num_rows($resource_id);
    } # end function

    /**
     * Function to free the resource
     * @param resource $resource_id
     * @return boolean
     * @author Bobby Easland
     * @version 1.0
     */

    function Free($resource_id)
    {

        return mysqli_free_result($resource_id);
    } # end function

    /**
     * Function to add slashes
     * @param string $data
     * @return string
     * @author Bobby Easland
     * @version 1.0
     */

    function Slashes($data)
    {

        return addslashes($data);
    } # end function

    /**
     * Function to perform DB inserts and updates - abstracted from osCommerce-MS-2.2 project
     * @param string $table Database table
     * @param array $data Associative array of columns / values
     * @param string $action insert or update
     * @param string $parameters
     * @return resource
     * @version 1.0
     * @author Bobby Easland
     */

    function DBPerform($table, $data, $action = 'insert', $parameters = '')
    {

        reset($data);

        if ($action == 'insert') {
            $query = 'INSERT INTO `' . $table . '` (';

            foreach ($data as $columns => $val) {
                //while (list($columns, )  each($data)) {

                $query .= '`' . $columns . '`, ';
            }

            $query = substr($query, 0, -2) . ') values (';

            reset($data);

            foreach ($data as $key => $value) {
                // while (list(, $value) = each($data)) {

                switch ((string)$value) {
                    case 'now()':
                        $query .= 'now(), ';

                        break;

                    case 'null':
                        $query .= 'null, ';

                        break;

                    default:
                        $query .= "'" . $this->Slashes($value) . "', ";

                        break;
                }
            }

            $query = substr($query, 0, -2) . ')';
        } elseif ($action == 'update') {
            $query = 'UPDATE `' . $table . '` SET ';

            foreach ($data as $columns => $value) {
                // while (list($columns, $value) = each($data)) {

                switch ((string)$value) {
                    case 'now()':
                        $query .= '`' . $columns . '`=now(), ';

                        break;

                    case 'null':
                        $query .= '`' . $columns .= '`=null, ';

                        break;

                    default:
                        $query .= '`' . $columns . "`='" . $this->Slashes($value) . "', ";

                        break;
                }
            }

            $query = substr($query, 0, -2) . ' WHERE ' . $parameters;
        }

        return $this->Query($query);
    } # end function
} # end class

/**
 * Google Sitemap Base Class
 *
 * The MySQL_Database class provides abstraction so the databaes can be accessed
 * @package Google-XML-Sitemap-Feed
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.2
 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @link http://www.google.com/webmasters/sitemaps/docs/en/about.html About Google Sitemap
 * @copyright Copyright 2005, Bobby Easland
 * @author Bobby Easland
 */
class GoogleSitemap
{

    /**
     * $DB is the database object
     * @var object
     */

    var $DB;

    /**
     * $filename is the base name of the feeds (i.e. - 'sitemap')
     * @var string
     */

    var $filename;

    /**
     * $savepath is the path where the feeds will be saved - store root
     * @var string
     */

    var $savepath;

    /**
     * $base_url is the URL for the catalog
     * @var string
     */

    var $base_url;

    /**
     * $debug holds all the debug data
     * @var array
     */

    var $debug;

    /**
     * GoogleSitemap class constructor
     * @param string $host Database host setting (i.e. - localhost)
     * @param string $user Database user
     * @param string $db Database name
     * @param string $pass Database password
     * @author Bobby Easland
     * @version 1.0
     */

    function __construct($host, $user, $db, $pass)
    {

        $this->DB = new MySQL_Database($host, $user, $db, $pass);

        $this->filename = "sitemap";

        $this->savepath = DIR_FS_CATALOG;

        $this->base_url = HTTP_SERVER . DIR_WS_HTTP_CATALOG;

        $this->debug = array();
    } # end class constructor

    /**
     * Function to save the sitemap data to file as either XML or XML.GZ format
     * @param string $data XML data
     * @param string $type Feed type (index, products, categories)
     * @return boolean
     * @version 1.1
     * @author Bobby Easland
     */

    function SaveFile($data, $type)
    {

        $filename = $this->savepath . $this->filename . $type;

        $compress = defined('GOOGLE_SITEMAP_COMPRESS') ? GOOGLE_SITEMAP_COMPRESS : 'false';

        if ($type == 'index') {
            $compress = 'false';
        }

        switch ($compress) {
            case 'true':
                $filename .= '.xml.gz';

                if ($gz = gzopen($filename, 'wb9')) {
                    gzwrite($gz, $data);

                    gzclose($gz);

                    $this->debug['SAVE_FILE_COMPRESS'][] = array('file' => $filename, 'status' => 'success', 'file_exists' => 'true');

                    return true;
                } else {
                    $file_check = file_exists($filename) ? 'true' : 'false';

                    $this->debug['SAVE_FILE_COMPRESS'][] = array('file' => $filename, 'status' => 'failure', 'file_exists' => $file_check);

                    return false;
                }

                break;

            default:
                $filename .= '.xml';

                if ($fp = fopen($filename, 'w+')) {
                    fwrite($fp, $data);

                    fclose($fp);

                    $this->debug['SAVE_FILE_XML'][] = array('file' => $filename, 'status' => 'success', 'file_exists' => 'true');

                    return true;
                } else {
                    $file_check = file_exists($filename) ? 'true' : 'false';

                    $this->debug['SAVE_FILE_XML'][] = array('file' => $filename, 'status' => 'failure', 'file_exists' => $file_check);

                    return false;
                }

                break;
        } # end switch
    } # end function

    /**
     * Function to compress a normal file
     * @param string $file
     * @return boolean
     * @author Bobby Easland
     * @version 1.0
     */

    function CompressFile($file)
    {

        $source = $this->savepath . $file . '.xml';

        $filename = $this->savepath . $file . '.xml.gz';

        $error_encountered = false;

        if ($gz_out = gzopen($filename, 'wb9')) {
            if ($fp_in = fopen($source, 'rb')) {
                while (!feof($fp_in)) {
                    gzwrite($gz_out, fread($fp_in, 1024 * 512));
                }

                fclose($fp_in);
            } else {
                $error_encountered = true;
            }

            gzclose($gz_out);
        } else {
            $error_encountered = true;
        }

        if ($error_encountered) {
            return false;
        } else {
            return true;
        }
    } # end function

    /**
     * Function to generate sitemap file from data
     * @param array $data
     * @param string $file
     * @return boolean
     * @version 1.0
     * @author Bobby Easland
     */

    function GenerateSitemap($data, $file)
    {

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:xhtml="http://www.w3.org/1999/xhtml"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd
    http://www.w3.org/1999/xhtml
    http://www.w3.org/2002/08/xhtml/xhtml1-strict.xsd">' . "\n";

        foreach ($data as $url) {
            $content .= "\t" . '<url>' . "\n";

            $content .= "\t\t" . '<loc>' . $url['loc'] . '</loc>' . "\n";
            if (isset($url['xhtml:link'])) {
                foreach ($url['xhtml:link'] as $lang_link) {
                    $content .= "\t\t" . '<xhtml:link rel="alternate" hreflang="' . $lang_link['hreflang'] . '" href="' . $lang_link['href'] . '" />' . "\n";
                }
            } else {
                $content .= "\t\t" . '<lastmod>' . $url['lastmod'] . '</lastmod>' . "\n";

                $content .= "\t\t" . '<changefreq>' . $url['changefreq'] . '</changefreq>' . "\n";

                $content .= "\t\t" . '<priority>' . $url['priority'] . '</priority>' . "\n";
            }
            $content .= "\t" . '</url>' . "\n";
        } # end foreach

        $content .= '</urlset>';

        return $this->SaveFile($content, $file);
    } # end function

    /**
     * Function to generate sitemap index file
     * @return boolean
     * @version 1.1
     * @author Bobby Easland
     */

    function GenerateSitemapIndex()
    {

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

        $content .= '<sitemapindex xmlns="http://www.google.com/schemas/sitemap/0.84">' . "\n";

        $pattern = defined('GOOGLE_SITEMAP_COMPRESS')

            ? GOOGLE_SITEMAP_COMPRESS == 'true'

                ? "{sitemap*.xml.gz}"

                : "{sitemap*.xml}"

            : "{sitemap*.xml}";

        foreach (glob($this->savepath . $pattern, GLOB_BRACE) as $filename) {
            //  if ( preg_match('/index/i', $filename) ) continue;

            if (basename($filename) != 'sitemap.xml') {
                $content .= "\t" . '<sitemap>' . "\n";

                $content .= "\t\t" . '<loc>' . $this->base_url . basename($filename) . '</loc>' . "\n";

                $content .= "\t\t" . '<lastmod>' . date("Y-m-d", filemtime($filename)) . '</lastmod>' . "\n";

                $content .= "\t" . '</sitemap>' . "\n";
            }
        } # end foreach

        $content .= '</sitemapindex>';

        return $this->SaveFile($content, '');
    } # end function

    /**
     * Function to generate product sitemap data
     * @return boolean
     * @version 1.1
     * @author Bobby Easland
     */

    function GenerateProductSitemap()
    {
        global $seo_urls, $cat_list;

        //   $r_current_subcats = tep_make_cat_list(); // get all turned on categories
        $r_current_subcats = $cat_list[0];

        $sql = "SELECT pd.products_id as pID, pd.language_id, lg.code, pd.products_name, pd.products_url, p.products_date_added as date_added, p.products_last_modified as last_mod, p.products_ordered 

			    FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_LANGUAGES . " lg on pd.language_id = lg.languages_id, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c 

				WHERE p.products_status='1' and p.products_id = pd.products_id and lang_status = '1' and p.products_id = p2c.products_id and c.categories_id = p2c.categories_id and p2c.categories_id in(" . implode(',',
                $r_current_subcats) . ")  

				ORDER BY p.products_ordered DESC";

        if ($products_query = $this->DB->Query($sql)) {
            $this->debug['QUERY']['PRODUCTS']['STATUS'] = 'success';

            $this->debug['QUERY']['PRODUCTS']['NUM_ROWS'] = $this->DB->NumRows($products_query);

            $container = array();
            $number = 0;
            $top = 0;


            while ($result = $this->DB->FetchArray($products_query)) {
                $top = max($top, $result['products_ordered']);

                if ($result['code'] == DEFAULT_LANGUAGE) {
                    $lng_code = '';
                } else {
                    $lng_code = $result['code'] . '/';
                }


                if (!empty($result['products_url'])) {
                    $location = tep_href_link($lng_code . $result['products_url'] . '/p-' . $result['pID'] . '.html'); // if "products_url" is set, show link without DB query to get names
                } else {
                    $location = tep_href_link($lng_code . $seo_urls->strip($result['products_name']) . '/p-' . $result['pID'] . '.html');
                }

                //$location = $this->hrefLink(FILENAME_PRODUCT_INFO, 'products_id=' . $result['pID'], 'NONSSL', false);

                $lastmod = $this->NotNull($result['last_mod']) ? $this->checkLastmod($result['last_mod']) : $this->checkLastmod($result['date_added']);

                $changefreq = GOOGLE_SITEMAP_PROD_CHANGE_FREQ;

                $ratio = $top > 0 ? $result['products_ordered'] / $top : 0;

                $priority = $ratio < .1 ? .1 : number_format($ratio, 1, '.', '');

                $container[] = array(
                    'loc' => htmlspecialchars(utf8_encode($location)),

                    'lastmod' => date("Y-m-d", strtotime($lastmod)),

                    'changefreq' => $changefreq,

                    'priority' => $priority

                );

                if (sizeof($container) >= 50000) {
                    $type = $number == 0 ? 'products' : 'products' . $number;

                    $this->GenerateSitemap($container, $type);

                    $container = array();

                    $number++;
                }
            } # end while

            $this->DB->Free($products_query);

            if (sizeof($container) > 1) {
                $type = $number == 0 ? 'products' : 'products' . $number;

                return $this->GenerateSitemap($container, $type);
            } # end if
        } else {
            $this->debug['QUERY']['PRODUCTS']['STATUS'] = 'false';

            $this->debug['QUERY']['PRODUCTS']['NUM_ROWS'] = '0';
        }
    } # end function

    /**
     * Funciton to generate category sitemap data
     * @return boolean
     * @version 1.1
     * @author Bobby Easland
     */

    function GenerateCategorySitemap()
    {

        $sql = "SELECT cd.categories_id as cID, c.date_added, c.last_modified as last_mod , lg.code

			    FROM " . TABLE_CATEGORIES . " c left join " . TABLE_CATEGORIES_DESCRIPTION . " cd on cd.categories_id = c.categories_id
				left join " . TABLE_LANGUAGES . " lg on cd.language_id = lg.languages_id

          WHERE   c.categories_status = '1'

				ORDER BY c.parent_id ASC, c.sort_order ASC, c.categories_id ASC";

        if ($categories_query = $this->DB->Query($sql)) {
            $this->debug['QUERY']['CATEOGRY']['STATUS'] = 'success';

            $this->debug['QUERY']['CATEOGRY']['NUM_ROWS'] = $this->DB->NumRows($categories_query);

            $container = array();

            $number = 0;

            while ($result = $this->DB->FetchArray($categories_query)) {
                if ($result['code'] == DEFAULT_LANGUAGE) {
                    $lng_code = '';
                } else {
                    $lng_code = $result['code'] . '/';
                }
                //$location = $this->hrefLink('category' . $this->GetFullcPath($result['cID']) . FILENAME_DEFAULT, 'source=google', 'NONSSL', false);
                $location = $this->hrefLink($lng_code . FILENAME_DEFAULT, 'cPath=' . $this->GetFullcPath($result['cID']), 'NONSSL', false);
                $location = strstr($location, HTTP_SERVER) ? $location : HTTP_SERVER . '/' . $location;
                $lastmod = $this->NotNull($result['last_mod']) ? $this->checkLastmod($result['last_mod']) : $this->checkLastmod($result['date_added']);

                $changefreq = GOOGLE_SITEMAP_CAT_CHANGE_FREQ;

                $priority = .5;

                $container[] = array(
                    'loc' => htmlspecialchars(utf8_encode($location)),

                    'lastmod' => date("Y-m-d", strtotime($lastmod)),

                    'changefreq' => $changefreq,

                    'priority' => $priority

                );

                if (sizeof($container) >= 50000) {
                    $type = $number == 0 ? 'categories' : 'categories' . $number;

                    $this->GenerateSitemap($container, $type);

                    $container = array();

                    $number++;
                }
            } # end while

            $this->DB->Free($categories_query);

            if (sizeof($container) > 1) {
                $type = $number == 0 ? 'categories' : 'categories' . $number;

                return $this->GenerateSitemap($container, $type);
            } # end if
        } else {
            $this->debug['QUERY']['CATEOGRY']['STATUS'] = 'false';

            $this->debug['QUERY']['CATEOGRY']['NUM_ROWS'] = '0';
        }
    } # end function

    /**
     * Function to retrieve full cPath from category ID
     * @param mixed $cID Could contain cPath or single category_id
     * @return string Full cPath string
     * @author Bobby Easland
     * @version 1.0
     */

    function GetFullcPath($cID)
    {

        if (preg_match('/_/', $cID)) {
            return $cID;
        } else {
            $c = array();

            $this->GetParentCategories($c, $cID);

            $c = array_reverse($c);

            $c[] = $cID;

            $cID = sizeof($c) > 1 ? implode('-', $c) : $cID;

            return $cID;
        }
    } # end function

    /**
     * Recursion function to retrieve parent categories from category ID
     * @param mixed $categories Passed by reference
     * @param integer $categories_id
     * @author Bobby Easland
     * @version 1.0
     */

    function GetParentCategories(&$categories, $categories_id)
    {

        $sql = "SELECT parent_id 

		        FROM " . TABLE_CATEGORIES . " 

				WHERE categories_id='" . (int)$categories_id . "'";

        $parent_categories_query = $this->DB->Query($sql);

        while ($parent_categories = $this->DB->FetchArray($parent_categories_query)) {
            if ($parent_categories['parent_id'] == 0) {
                return true;
            }

            $categories[sizeof($categories)] = $parent_categories['parent_id'];

            if ($parent_categories['parent_id'] != $categories_id) {
                $this->GetParentCategories($categories, $parent_categories['parent_id']);
            }
        }
    } # end function

    function checkLastmod($date)
    {
        return $date == '0000-00-00 00:00:00' ? date('Y-m-d H:i:s') : $date;
    }

    /**
     * Function to check if a value is NULL
     * @param mixed $value
     * @return boolean
     * @author Bobby Easland as abstracted from osCommerce-MS2.2
     * @version 1.0
     */

    function NotNull($value)
    {

        if (is_array($value)) {
            if (sizeof($value) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            if (!empty($value) && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
                return true;
            } else {
                return false;
            }
        }
    } # end function

    /**
     * Function to return href_link
     * @param mixed $value
     * @return boolean
     * @author Bobby Easland
     * @version 1.0
     */

    function hrefLink($page, $parameters, $connection, $add_session_id)
    {

        if (defined('SEO_URLS') && SEO_URLS == 'true' || defined('SEO_ENABLED') && SEO_ENABLED == 'true') {
            return tep_href_link($page, $parameters, $connection, $add_session_id);
        } else {
            return $this->base_url . $page . '?' . $parameters;
        }
    } # end function

    /**
     * Utility function to read and return the contents of a GZ formatted file
     * @param string $file File to open
     * @return string
     * @author Bobby Easland
     * @version 1.0
     */

    function ReadGZ($file)
    {

        $file = $this->savepath . $file;

        $lines = gzfile($file);

        return implode('', $lines);
    } # end function

    /**
     * Utility function to generate the submit URL
     * @return string
     * @version 1.0
     * @author Bobby Easland
     */

    function GenerateSubmitURL()
    {

        $url = urlencode($this->base_url . 'sitemap.xml');

        return htmlspecialchars(utf8_encode('http://www.google.com/webmasters/sitemaps/ping?sitemap=' . $url));
    } # end function

    function GenerateImgSitemap($data, $file)
    {

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

        foreach ($data as $url) {
            $content .= "\t" . '<url>' . "\n";

            $content .= "\t\t" . '<loc>' . $url['loc'] . '</loc>' . "\n";
            foreach ($url['image'] as $img) {
                $content .= "\t\t" . '<image:image>' . "\n";
                $content .= "\t\t\t" . '<image:loc>' . $this->base_url . $img['loc'] . '</image:loc>' . "\n";
                $content .= "\t\t\t" . '<image:title>' . htmlspecialchars($img['title']) . '</image:title>' . "\n";
                $content .= "\t\t" . '</image:image>' . "\n";
            }


            $content .= "\t" . '</url>' . "\n";
        } # end foreach

        $content .= '</urlset>';

        return $this->SaveFile($content, $file);
    } # end function

    function GenerateImageSitemap()
    {
        global $seo_urls;
        $sql = "SELECT p.products_id as pID,p.products_image as image, pd.products_url
                ,pd.products_name, pd.language_id, lg.code
			    FROM " . TABLE_PRODUCTS . " p
                LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON pd.products_id = p.products_id
                LEFT JOIN " . TABLE_LANGUAGES . " lg ON lg.languages_id = pd.language_id
                WHERE p.products_status='1'
				ORDER BY p.products_sort_order ASC, p.products_id ASC";

        if ($products_image_query = $this->DB->Query($sql)) {
            $this->debug['QUERY']['IMAGE']['STATUS'] = 'success';

            $this->debug['QUERY']['IMAGE']['NUM_ROWS'] = $this->DB->NumRows($products_image_query);

            $container = array();

            $number = 0;

            while ($result = $this->DB->FetchArray($products_image_query)) {
                if ($result['code'] == DEFAULT_LANGUAGE) {
                    $lng_code = '';
                } else {
                    $lng_code = $result['code'] . '/';
                }
                //$location = $this->hrefLink('category' . $this->GetFullcPath($result['cID']) . FILENAME_DEFAULT, 'source=google', 'NONSSL', false);

                $location = tep_href_link($lng_code . $seo_urls->strip($result['products_name']) . '/p-' . $result['pID'] . '.html');


                $image_title = $result['products_name'];
                $image = array_map(function ($name) use ($image_title) {
                    return [
                        'loc' => 'getimage/products/' . $name,
                        'title' => $image_title
                    ];
                }, explode(';', $result['image']));

                $container[] = array(
                    'loc' => htmlspecialchars(utf8_encode($location)),
                    'image' => $image,
                );
                if (sizeof($container) >= 50000) {
                    $type = $number == 0 ? 'images' : 'images' . $number;

                    $this->GenerateImgSitemap($container, $type);

                    $container = array();

                    $number++;
                }
            } # end while

            $this->DB->Free($products_image_query);

            if (sizeof($container) > 1) {
                $type = $number == 0 ? 'images' : 'images' . $number;

                return $this->GenerateImgSitemap($container, $type);
            } # end if
        } else {
            $this->debug['QUERY']['IMAGE']['STATUS'] = 'false';

            $this->debug['QUERY']['IMAGE']['NUM_ROWS'] = '0';
        }
    } # end function

    function GenerateArticlesSitemap()
    {
        global $lng;
        $sql = "SELECT DISTINCT a.articles_id as pID, 
								 a.articles_date_added as date_added, 
								 a.articles_last_modified as last_mod 
					FROM " . TABLE_ARTICLES . " a
					LEFT JOIN " . TABLE_ARTICLES_TO_TOPICS . " att  ON a.articles_id = att.articles_id
					WHERE a.articles_status = '1'
					and att.topics_id NOT IN (15,22) 
					ORDER BY a.articles_last_modified DESC, 
					         a.articles_date_added DESC";

        if ($articles_query = $this->DB->Query($sql)) {
            $this->debug['QUERY']['ARTICLES']['STATUS'] = 'success';

            $this->debug['QUERY']['ARTICLES']['NUM_ROWS'] = $this->DB->NumRows($articles_query);

            $container = array();

            $number = 0;

            $top = 0;

            $art = 0;

            while ($result = $this->DB->FetchArray($articles_query)) {
                //$location = $this->hrefLink('category' . $this->GetFullcPath($result['cID']) . FILENAME_DEFAULT, 'source=google', 'NONSSL', false);
                $top = max($top, $art);
                $location = tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $result['pID'], 'NONSSL', false);
                if (tep_not_null($result['last_mod'])) {
                    $lastmod = $result['last_mod'];
                } else {
                    $lastmod = $result['date_added'];
                }
                $changefreq = 'Daily';
                $ratio = ($top > 0) ? ($art / $top) : 0;
                $priority = $ratio < .1 ? .1 : number_format($ratio, 1, '.', '');
                $alternate = [];
                foreach ($lng->catalog_languages as $hreflang => $language_info) {
                    $alternate[] = [
                        'href' => tep_href_link($hreflang . '/' . FILENAME_ARTICLE_INFO, 'articles_id=' . $result['pID']),
                        'hreflang' => $hreflang
                    ];
                }

                $container[] = array(
                    'loc' => htmlspecialchars(utf8_encode($location)),

                    'xhtml:link' => $alternate,
                    'lastmod' => date("Y-m-d", strtotime($lastmod)),

                    'changefreq' => $changefreq,

                    'priority' => $priority

                );

                if (sizeof($container) >= 50000) {
                    $type = $number == 0 ? 'articles' : 'articles' . $number;

                    $this->GenerateSitemap($container, $type);

                    $container = array();

                    $number++;
                }
            } # end while

            $this->DB->Free($articles_query);

            if (sizeof($container) > 1) {
                $type = $number == 0 ? 'articles' : 'articles' . $number;

                return $this->GenerateSitemap($container, $type);
            } # end if
        } else {
            $this->debug['QUERY']['ARTICLES']['STATUS'] = 'false';

            $this->debug['QUERY']['ARTICLES']['NUM_ROWS'] = '0';
        }
    } # end function
} #  end class
