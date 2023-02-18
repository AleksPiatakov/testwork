<?php

define('USE_SEO_REDIRECT_DEBUG', 'false');
/**
 * Ultimate SEO URLs Contribution - osCommerce MS-2.2
 *
 * Ultimate SEO URLs offers search engine optimized URLS for osCommerce
 * based applications. Other features include optimized performance and
 * automatic redirect script.
 * @package Ultimate-SEO-URLs
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 2.1
 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @copyright Copyright 2005, Bobby Easland
 * @author Bobby Easland
 * @filesource
 */

/**
 * SEO_DataBase Class
 *
 * The SEO_DataBase class provides abstraction so the databaes can be accessed
 * without having to use tep API functions. This class has minimal error handling
 * so make sure your code is tight!
 * @package Ultimate-SEO-URLs
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.1
 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @copyright Copyright 2005, Bobby Easland
 * @author Bobby Easland
 */
class SEO_DataBase
{
    /**
     * Database host (localhost, IP based, etc)
     * @var string
     */
    private $host;


    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getDb()
    {
        return $this->db;
    }


    /**
     * @return resource
     */
    public function getLinkId()
    {
        return $this->link_id;
    }

    /**
     * Database user
     * @var string
     */
    private $user;
    /**
     * Database name
     * @var string
     */
    private $db;
    /**
     * Database password
     * @var string
     */
    private $pass;
    /**
     * Database link
     * @var resource
     */
    private $link_id;


    /**
     * MySQL_DataBase class constructor
     * @author Bobby Easland
     * @version 1.0
     * @param string $host
     * @param string $user
     * @param string $db
     * @param string $pass
     * @param null $readyConnection
     */
    public function __construct($host, $user, $db, $pass, $readyConnection = null)
    {
        $this->host = $host;
        $this->user = $user;
        $this->db = $db;
        $this->pass = $pass;
        if ($readyConnection) {
            $this->setConnection($readyConnection);
        } else {
            $this->ConnectDB();
            $this->SelectDB();
        }
    }


    public function setConnection($connection)
    {
        $this->link_id = $connection;
    }
    /**
     * Function to connect to MySQL
     * @author Bobby Easland
     * @version 1.1
     */
    function ConnectDB()
    {
        $this->link_id = mysqli_connect($this->host, $this->user, $this->pass, $this->getDb());
    } # end function

    /**
     * Function to select the database
     * @author Bobby Easland
     * @version 1.0
     * @return resoource
     */
    function SelectDB()
    {
        return mysqli_select_db($this->getLinkId(), $this->getDb());
    } # end function

    /**
     * Function to perform queries
     * @author Bobby Easland
     * @version 1.0
     * @param string $query SQL statement
     * @return resource
     */
    function Query($query)
    {
        return tep_db_query($query);
    } # end function

    /**
     * Function to fetch array
     * @author Bobby Easland
     * @version 1.0
     * @param resource $resource_id
     * @param int|string $type MYSQL_BOTH or MYSQL_ASSOC
     * @return array
     */
    function FetchArray($resource_id, $type = MYSQLI_BOTH)
    {
        return @mysqli_fetch_array($resource_id, $type);
    } # end function

    /**
     * Function to fetch the number of rows
     * @author Bobby Easland
     * @version 1.0
     * @param resource $resource_id
     * @return mixed
     */
    function NumRows($resource_id)
    {
        if ($resource_id instanceof mysqli_result) {
            return tep_db_num_rows($resource_id);
        }
        return 0;
    } # end function

    /**
     * Function to fetch the last insertID
     * @author Bobby Easland
     * @version 1.0
     * @return integer
     */
    function InsertID()
    {
        return mysqli_insert_id($this->getLinkId());
    }

    /**
     * Function to free the resource
     * @author Bobby Easland
     * @version 1.0
     * @param resource $resource_id
     * @return boolean
     */
    function Free($resource_id)
    {
        if ($resource_id instanceof mysqli_result) {
            mysqli_free_result($resource_id);
        }
    } # end function

    /**
     * Function to add slashes
     * @author Bobby Easland
     * @version 1.0
     * @param string $data
     * @return string
     */
    function Slashes($data)
    {
        return addslashes($data);
    } # end function

    /**
     * Function to perform DB inserts and updates - abstracted from osCommerce-MS-2.2 project
     * @author Bobby Easland
     * @version 1.0
     * @param string $table Database table
     * @param array $data Associative array of columns / values
     * @param string $action insert or update
     * @param string $parameters
     * @return resource
     */
    function DBPerform($table, $data, $action = 'insert', $parameters = '')
    {
        reset($data);
        $data = tep_db_prepare_input($data);
        if ($action == 'insert') {
            $query = 'INSERT INTO `' . $table . '` (';
            foreach ($data as $columns => $val) {
//            while (list($columns,) = each($data)) {
                $query .= '`' . $columns . '`, ';
            }
            $query = substr($query, 0, -2) . ') values (';
            reset($data);
            foreach ($data as $key => $value) {
                //  while (list(, $value) = each($data)) {
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
//            while (list($columns, $value) = each($data)) {
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
 * Ultimate SEO URLs Installer and Configuration Class
 *
 * Ultimate SEO URLs installer and configuration class offers a modular
 * and easy to manage method of configuration.  The class enables the base
 * class to be configured and installed on the fly without the hassle of
 * calling additional scripts or executing SQL.
 * @package Ultimate-SEO-URLs
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.1
 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @copyright Copyright 2005, Bobby Easland
 * @author Bobby Easland
 */
class SEO_URL_INSTALLER
{
    /**
     * The default_config array has all the default settings which should be all that is needed to make the base class work.
     * @var array
     */
    var $default_config;
    /**
     * Database object
     * @var object
     */
    var $DB;
    /**
     * $attributes array holds information about this instance
     * @var array
     */
    var $attributes;

    /**
     * SEO_URL_INSTALLER class constructor
     * @author Bobby Easland
     * @version 1.1
     */
    function __construct()
    {

        $this->attributes = array();

        $x = 0;
        $this->default_config = array();
        $this->default_config['SEO_ENABLED'] = array('DEFAULT' => 'true',
                                                     'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
                                                     (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                     VALUES ('Enable SEO URLs?', 'SEO_ENABLED', 'true', 'Enable the SEO URLs?  This is a global setting and will turn them off completely.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
        $x++;
        $this->default_config['SEO_ADD_CPATH_TO_PRODUCT_URLS'] = array('DEFAULT' => 'false',
                                                                       'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
                                                                       (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                                       VALUES ('Add cPath to product URLs?', 'SEO_ADD_CPATH_TO_PRODUCT_URLS', 'false', 'This setting will append the cPath to the end of product URLs (i.e. - some-product-p-1.html?cPath=xx).', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
        $x++;
        $this->default_config['SEO_ADD_SLASH_BEFORE_PRODUCT_ID'] = array('DEFAULT' => 'true',
                                                                       'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "`
                                                                       (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                                       VALUES ('Add slash before product ID in URLs?', 'SEO_ADD_SLASH_BEFORE_PRODUCT_ID', 'true', 'This setting will add slash before product in URLs (i.e. - some-product/p-1.html) or remove slash (i.e. - some-product-p-1.html).', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
        $x++;
        $this->default_config['SEO_ADD_SLASH_BEFORE_CATEGORY_ID'] = array('DEFAULT' => 'true',
                                                                         'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "`
                                                                       (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                                       VALUES ('Add slash before category ID in URLs?', 'SEO_ADD_SLASH_BEFORE_CATEGORY_ID', 'true', 'This setting will add slash before category in URLs (i.e. - some-category/c-1.html) or remove slash (i.e. - some-category-c-1.html).', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
        $x++;
        $this->default_config['SEO_ADD_CAT_PARENT'] = array('DEFAULT' => 'true',
                                                            'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "`
                                                            (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                            VALUES ('Add category parent to begining of URLs?', 'SEO_ADD_CAT_PARENT', 'true', 'This setting will add the category parent name to the beginning of the category URLs (i.e. - parent-category-c-1.html).', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
        $x++;
        $this->default_config['SEO_URLS_FILTER_SHORT_WORDS'] = array('DEFAULT' => '3',
                                                                     'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "`
                                                                     (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) 
                                                                     VALUES ('Filter Short Words', 'SEO_URLS_FILTER_SHORT_WORDS', '3', 'This setting will filter words less than or equal to the value from the URL.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, NULL)"
        );
        $x++;
        $this->default_config['SEO_URLS_USE_W3C_VALID'] = array('DEFAULT' => 'true',
                                                                'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
                                                                (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                                VALUES ('Output W3C valid URLs (parameter string)?', 'SEO_URLS_USE_W3C_VALID', 'true', 'This setting will output W3C valid URLs.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
        $x++;
        $this->default_config['USE_SEO_CACHE_GLOBAL'] = array('DEFAULT' => 'true',
                                                              'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
                                                              (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                              VALUES ('Enable SEO cache to save queries?', 'USE_SEO_CACHE_GLOBAL', 'false', 'This is a global setting and will turn off caching completely.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
        $x++;
        $this->default_config['USE_SEO_CACHE_PRODUCTS'] = array('DEFAULT' => 'true',
                                                                'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "`
                                                                (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                                VALUES ('Enable product cache?', 'USE_SEO_CACHE_PRODUCTS', 'false', 'This will turn off caching for the products.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
        $x++;
        $this->default_config['USE_SEO_CACHE_CATEGORIES'] = array('DEFAULT' => 'true',
                                                                  'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
                                                                (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                                  VALUES ('Enable categories cache?', 'USE_SEO_CACHE_CATEGORIES', 'false', 'This will turn off caching for the categories.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );

        $x++;
        $this->default_config['USE_SEO_CACHE_MANUFACTURERS'] = array('DEFAULT' => 'true',
                                                                     'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
                                                                     (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                                     VALUES ('Enable manufacturers cache?', 'USE_SEO_CACHE_MANUFACTURERS', 'false', 'This will turn off caching for the manufacturers.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );

        $x++;
        $this->default_config['USE_SEO_CACHE_ARTICLES'] = array('DEFAULT' => 'true',
                                                                'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
                                                                (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                                VALUES ('Enable articles cache?', 'USE_SEO_CACHE_ARTICLES', 'false', 'This will turn off caching for the articles.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
        $x++;
        $this->default_config['USE_SEO_CACHE_TOPICS'] = array('DEFAULT' => 'true',
                                                              'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
                                                            (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                              VALUES ('Enable topics cache?', 'USE_SEO_CACHE_TOPICS', 'false', 'This will turn off caching for the article topics.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
        $x++;
        $this->default_config['USE_SEO_CACHE_INFO_PAGES'] = array('DEFAULT' => 'true',
                                                                  'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
                                                                  (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                                  VALUES ('Enable information cache?', 'USE_SEO_CACHE_INFO_PAGES', 'false', 'This will turn off caching for the information pages.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
//ojp b
        $x++;
        $this->default_config['USE_SEO_CACHE_LINKS'] = array('DEFAULT' => 'true',
                                                             'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
                                                            (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                             VALUES ('Enable link directory cache?', 'USE_SEO_CACHE_LINKS', 'false', 'This will turn off caching for the link category pages.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
//ojp e
        $x++;
        $this->default_config['USE_SEO_REDIRECT'] = array('DEFAULT' => 'true',
                                                          'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
                                                        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                          VALUES ('Enable automatic redirects?', 'USE_SEO_REDIRECT', 'true', 'This will activate the automatic redirect code and send 301 headers for old to new URLs.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
        $x++;
        $this->default_config['SEO_REWRITE_TYPE'] = array('DEFAULT' => 'Rewrite',
                                                          'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
                                                        (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                          VALUES ('Choose URL Rewrite Type', 'SEO_REWRITE_TYPE', 'Rewrite', 'Choose which SEO URL format to use.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''Rewrite''),')"
        );
        $x++;
        $this->default_config['SEO_CHAR_CONVERT_SET'] = array('DEFAULT' => '',
                                                              'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
(configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
VALUES ('Enter special character conversions', 'SEO_CHAR_CONVERT_SET', '', 'This setting will convert characters.<br><br>The format <b>MUST</b> be in the form: <b>char=>conv,char2=>conv2</b>', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, NULL)"
        );
        $x++;
        $this->default_config['SEO_REMOVE_ALL_SPEC_CHARS'] = array('DEFAULT' => 'false',
                                                                   'QUERY' => "INSERT INTO `" . TABLE_CONFIGURATION . "` 
                                                                   (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                                                                   VALUES ('Remove all non-alphanumeric characters?', 'SEO_REMOVE_ALL_SPEC_CHARS', 'false', 'This will remove all non-letters and non-numbers.  This should be handy to remove all special characters with 1 setting.', GROUP_INSERT_ID, " . $x . ", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')"
        );
        $x++;
        $this->default_config['SEO_URLS_CACHE_RESET'] = array('DEFAULT' => 'false',
                                                              'QUERY' => "
                INSERT INTO `" . TABLE_CONFIGURATION . "`
                (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function)
                VALUES 
                (
                 'Reset SEO URLs Cache'
                , 'SEO_URLS_CACHE_RESET'
                , 'false'
                , 'This will reset the cache data for SEO'
                , GROUP_INSERT_ID
                , " . $x . "
                , NOW()
                , NOW()
                , 'tep_reset_cache_data_seo_urls'
                , 'tep_cfg_select_option(array(''reset'', ''false''),')
        "
        );

        $this->init();
    } # end class constructor

    /**
     * Initializer - if there are settings not defined the default config will be used and database settings installed.
     * @author Bobby Easland
     * @version 1.1
     */
    function init()
    {
        $container = [];
        foreach ($this->default_config as $key => $value) {
            $container[] = defined($key) ? 'true' : 'false';
        } # end foreach
        $this->attributes['IS_DEFINED'] = in_array('false', $container) ? false : true;
        switch (true) {
            case (!$this->attributes['IS_DEFINED']):
                $this->eval_defaults();
                $this->DB = new SEO_DataBase(DB_SERVER, DB_SERVER_USERNAME, DB_DATABASE, DB_SERVER_PASSWORD, tep_db_connect());
//                $this->DB->setConnection(DB());

                $configurationKeysList = "'" . implode("', '", array_keys($this->default_config)) . "'";
                $sql = "SELECT configuration_key, configuration_value
						FROM " . TABLE_CONFIGURATION . "
						WHERE configuration_key IN ($configurationKeysList)";
                $result = $this->DB->Query($sql);
                $num_rows = $this->DB->NumRows($result);
                $this->DB->Free($result);
                $this->attributes['IS_INSTALLED'] = sizeof($container) == $num_rows;
                if (!$this->attributes['IS_INSTALLED']) {
                    $this->install_settings();
                }
                break;
            default:
                $this->attributes['IS_INSTALLED'] = true;
                break;
        } # end switch
    } # end function

    /**
     * This function evaluates the default serrings into defined constants
     * @author Bobby Easland
     * @version 1.0
     */
    function eval_defaults()
    {
        foreach ($this->default_config as $key => $value) {
            define($key, $value['DEFAULT']);
        } # end foreach
    } # end function

    /**
     * This function removes the database settings (configuration and cache)
     * @author Bobby Easland
     * @version 1.0
     */
    function uninstall_settings()
    {
        $configurationKeysList = "'" . implode("', '", array_keys($this->default_config)) . "'";
        $this->DB->Query("DELETE FROM `" . TABLE_CONFIGURATION_GROUP . "` WHERE `configuration_group_title` LIKE '%SEO%'");
        $this->DB->Query("DELETE FROM `" . TABLE_CONFIGURATION . "` WHERE `configuration_key` IN ($configurationKeysList)");
        $this->DB->Query("DROP TABLE IF EXISTS `cache`");
    } # end function

    /**
     * This function installs the database settings
     * @author Bobby Easland
     * @version 1.0
     */
    function install_settings()
    {
        $this->uninstall_settings();
        $sort_order_query = "SELECT MAX(sort_order) as max_sort FROM `" . TABLE_CONFIGURATION_GROUP . "`";
        $sort = $this->DB->FetchArray($this->DB->Query($sort_order_query));
        $next_sort = (int)$sort['max_sort'] + 1;
        $insert_group = "
            INSERT INTO `" . TABLE_CONFIGURATION_GROUP . "` 
            VALUES (NULL, '', 'SEO URLs', 'Options for Ultimate SEO URLs by Chemo', '" . $next_sort . "', '0')
        ";
        $this->DB->Query($insert_group);
        $group_id = $this->DB->InsertID();

        foreach ($this->default_config as $key => $value) {
            $sql = str_replace('GROUP_INSERT_ID', $group_id, $value['QUERY']);
            $this->DB->Query($sql);
        }

        $insert_cache_table = "CREATE TABLE IF NOT EXISTS `cache` (
		  `cache_id` varchar(32) NOT NULL default '',
		  `cache_language_id` tinyint(1) NOT NULL default '0',
		  `cache_name` varchar(255) NOT NULL default '',
		  `cache_data` mediumtext NOT NULL,
		  `cache_global` tinyint(1) NOT NULL default '1',
		  `cache_gzip` tinyint(1) NOT NULL default '1',
		  `cache_method` varchar(20) NOT NULL default 'RETURN',
		  `cache_date` datetime NOT NULL default '0000-00-00 00:00:00',
		  `cache_expires` datetime NOT NULL default '0000-00-00 00:00:00',
		  PRIMARY KEY  (`cache_id`,`cache_language_id`),
		  KEY `cache_id` (`cache_id`),
		  KEY `cache_language_id` (`cache_language_id`),
		  KEY `cache_global` (`cache_global`)
		);";
        $this->DB->Query($insert_cache_table);
    } # end function
} # end class

/**
 * Ultimate SEO URLs Base Class
 *
 * Ultimate SEO URLs offers search engine optimized URLS for osCommerce
 * based applications. Other features include optimized performance and
 * automatic redirect script.
 * @package Ultimate-SEO-URLs
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 2.1
 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @copyright Copyright 2005, Bobby Easland
 * @author Bobby Easland
 */
class SEO_URL
{
    /**
     * $cache is the per page data array that contains all of the previously stripped titles
     * @var array
     */
    var $cache;
    /**
     * $languages_id contains the language_id for this instance
     * @var integer
     */
    var $languages_id;
    /**
     * $attributes array contains all the required settings for class
     * @var array
     */
    var $attributes;
    /**
     * $base_url is the NONSSL URL for site
     * @var string
     */
    var $base_url;
    /**
     * $base_url_ssl is the secure URL for the site
     * @var string
     */
    var $base_url_ssl;
    /**
     * $performance array contains evaluation metric data
     * @var array
     */
    var $performance;
    /**
     * $timestamp simply holds the temp variable for time calculations
     * @var float
     */
    var $timestamp;
    /**
     * $reg_anchors holds the anchors used by the .htaccess rewrites
     * @var array
     */
    var $reg_anchors;
    /**
     * $cache_query is the resource_id used for database cache logic
     * @var resource
     */
    var $cache_query;
    /**
     * $cache_file is the basename of the cache database entry
     * @var string
     */
    var $cache_file;
    /**
     * $data array contains all records retrieved from database cache
     * @var array
     */
    var $data;
    /**
     * $need_redirect determines whether the URL needs to be redirected
     * @var boolean
     */
    var $need_redirect;
    /**
     * $is_seopage holds value as to whether page is in allowed SEO pages
     * @var boolean
     */
    var $is_seopage;
    /**
     * $uri contains the $_SERVER['REQUEST_URI'] value
     * @var string
     */
    var $uri;
    /**
     * $real_uri contains the $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING'] value
     * @var string
     */
    var $real_uri;
    /**
     * $uri_parsed contains the parsed uri value array
     * @var array
     */
    var $uri_parsed;
    /**
     * $path_info contains the getenv('PATH_INFO') value
     * @var string
     */
    var $path_info;
    /**
     * $DB is the database object
     * @var object
     */
    var $DB;
    /**
     * $installer is the installer object
     * @var object
     */
    var $installer;
    var $promUrls;

    /**
     * SEO_URL class constructor
     * @author Bobby Easland
     * @version 1.1
     * @param integer $languages_id
     */
    public function __construct($languages_id)
    {
        global $session_started, $SID, $promUrls;

        $this->installer = new SEO_URL_INSTALLER();

        $this->DB = new SEO_DataBase(DB_SERVER, DB_SERVER_USERNAME, DB_DATABASE, DB_SERVER_PASSWORD, tep_db_connect());
//        $this->DB->setConnection(DB());
        $this->languages_id = (int)$languages_id;

        $this->data = array();

//ojp FILENAME_LINKS
        $seo_pages = array(
            FILENAME_DEFAULT,
            FILENAME_PRODUCT_INFO
        );
        if (defined('FILENAME_ARTICLES')) {
            $seo_pages[] = FILENAME_ARTICLES;
        }
        if (defined('FILENAME_ARTICLE_INFO')) {
            $seo_pages[] = FILENAME_ARTICLE_INFO;
        }
        if (defined('FILENAME_INFORMATION')) {
            $seo_pages[] = FILENAME_INFORMATION;
        }
        //if ( defined('pollbooth.php') ) $seo_pages[] = 'pollbooth.php';
        //$seo_pages[] = 'pollbooth.php';
        // BOF: "Extra pages-info box w/ admin" support added by faaliyet
        if (defined('FILENAME_PAGES')) {
            $seo_pages[] = FILENAME_PAGES;
        }
        // EOF: "Extra pages-info box w/ admin" support added by faaliyet

//ojp USE_SEO_CACHE_LINKS
        $this->attributes = array('PHP_VERSION' => PHP_VERSION,
                                  'SESSION_STARTED' => $session_started,
                                  'SID' => $SID,
                                  'SEO_ENABLED' => defined('SEO_ENABLED') ? SEO_ENABLED : 'false',
                                  'SEO_ADD_CPATH_TO_PRODUCT_URLS' => defined('SEO_ADD_CPATH_TO_PRODUCT_URLS') ? SEO_ADD_CPATH_TO_PRODUCT_URLS : 'false',
                                  'SEO_ADD_SLASH_BEFORE_PRODUCT_ID' => defined('SEO_ADD_SLASH_BEFORE_PRODUCT_ID') ? SEO_ADD_SLASH_BEFORE_PRODUCT_ID : 'true',
                                  'SEO_ADD_SLASH_BEFORE_CATEGORY_ID' => defined('SEO_ADD_SLASH_BEFORE_CATEGORY_ID') ? SEO_ADD_SLASH_BEFORE_CATEGORY_ID : 'true',
                                  'SEO_ADD_CAT_PARENT' => defined('SEO_ADD_CAT_PARENT') ? SEO_ADD_CAT_PARENT : 'true',
                                  'SEO_URLS_USE_W3C_VALID' => defined('SEO_URLS_USE_W3C_VALID') ? SEO_URLS_USE_W3C_VALID : 'true',
                                  'USE_SEO_CACHE_GLOBAL' => defined('USE_SEO_CACHE_GLOBAL') ? USE_SEO_CACHE_GLOBAL : 'false',
                                  'USE_SEO_CACHE_PRODUCTS' => defined('USE_SEO_CACHE_PRODUCTS') ? USE_SEO_CACHE_PRODUCTS : 'false',
                                  'USE_SEO_CACHE_CATEGORIES' => defined('USE_SEO_CACHE_CATEGORIES') ? USE_SEO_CACHE_CATEGORIES : 'false',
                                  'USE_SEO_CACHE_MANUFACTURERS' => defined('USE_SEO_CACHE_MANUFACTURERS') ? USE_SEO_CACHE_MANUFACTURERS : 'false',
                                  'USE_SEO_CACHE_ARTICLES' => defined('USE_SEO_CACHE_ARTICLES') ? USE_SEO_CACHE_ARTICLES : 'false',
                                  'USE_SEO_CACHE_TOPICS' => defined('USE_SEO_CACHE_TOPICS') ? USE_SEO_CACHE_TOPICS : 'false',
                                  'USE_SEO_CACHE_INFO_PAGES' => defined('USE_SEO_CACHE_INFO_PAGES') ? USE_SEO_CACHE_INFO_PAGES : 'false',
                                  'USE_SEO_CACHE_LINKS' => defined('USE_SEO_CACHE_LINKS') ? USE_SEO_CACHE_LINKS : 'false',
                                  'USE_SEO_REDIRECT' => defined('USE_SEO_REDIRECT') ? USE_SEO_REDIRECT : 'false',
                                  'SEO_REWRITE_TYPE' => defined('SEO_REWRITE_TYPE') ? SEO_REWRITE_TYPE : 'false',
                                  'SEO_URLS_FILTER_SHORT_WORDS' => defined('SEO_URLS_FILTER_SHORT_WORDS') ? SEO_URLS_FILTER_SHORT_WORDS : 'false',
                                  'SEO_CHAR_CONVERT_SET' => defined('SEO_CHAR_CONVERT_SET') ? $this->expand(SEO_CHAR_CONVERT_SET) : 'false',
                                  'SEO_REMOVE_ALL_SPEC_CHARS' => defined('SEO_REMOVE_ALL_SPEC_CHARS') ? SEO_REMOVE_ALL_SPEC_CHARS : 'false',
                                  'SEO_PAGES' => $seo_pages,
                                  'SEO_INSTALLER' => $this->installer->attributes
        );

        $this->base_url = HTTP_SERVER . DIR_WS_HTTP_CATALOG;

        $this->base_url_ssl = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
        $this->cache = array();
        $this->timestamp = 0;
        $this->promUrls = isset($promUrls) ? $promUrls : false;

//ojp lPath -links- definition
        if ($this->promUrls) {
            $this->reg_anchors = [
                'products_id' => 'p',
                'cPath' => 'g',
                'manufacturers_id' => '/m-',
                'tPath' => '/t-',
                'articles_id' => 'a',
                //  'pages_id' => '/info-'
                //'pollid' => '-po-',
            ];
        } else {
            $this->reg_anchors = [
                'products_id' => ($this->attributes['SEO_ADD_SLASH_BEFORE_PRODUCT_ID'] == 'true' ? '/p-' : '-p-'),
                'cPath' => ($this->attributes['SEO_ADD_SLASH_BEFORE_CATEGORY_ID'] == 'true' ? '/c-' : '-c-'),
                'manufacturers_id' => '/m-',
                'tPath' => '/t-',
                'articles_id' => '/a-',
                //  'pages_id' => '/info-'
                //'pollid' => '-po-',
            ];
        }

        $this->performance = array('NUMBER_URLS_GENERATED' => 0,
                                   'NUMBER_QUERIES' => 0,
                                   'CACHE_QUERY_SAVINGS' => 0,
                                   'NUMBER_STANDARD_URLS_GENERATED' => 0,
                                   'TOTAL_CACHED_PER_PAGE_RECORDS' => 0,
                                   'TOTAL_TIME' => 0,
                                   'TIME_PER_URL' => 0,
                                   'QUERIES' => array()
        );
//ojp generate_link_cache
        if ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true') {
            $this->cache_file = 'seo_urls_v2_';
            $this->cache_gc();
            if ($this->attributes['USE_SEO_CACHE_PRODUCTS'] == 'true') {
                $this->generate_products_cache();
            }
            if ($this->attributes['USE_SEO_CACHE_CATEGORIES'] == 'true') {
                $this->generate_categories_cache();
            }
            if ($this->attributes['USE_SEO_CACHE_MANUFACTURERS'] == 'true') {
                $this->generate_manufacturers_cache();
            }
            if ($this->attributes['USE_SEO_CACHE_ARTICLES'] == 'true' && defined('TABLE_ARTICLES_DESCRIPTION')) {
                $this->generate_articles_cache();
            }
            if ($this->attributes['USE_SEO_CACHE_TOPICS'] == 'true' && defined('TABLE_TOPICS_DESCRIPTION')) {
                $this->generate_topics_cache();
            }
        } # end if

        if ($this->attributes['USE_SEO_REDIRECT'] == 'true') {
            $this->check_redirect();
        } # end if
    } # end constructor

    /**
     * Function take not encoded parameters
     * and encode all html chars
     *
     * @param array|string $parameters
     * @return string
     */
    function encodeUrlParameters($parameters)
    {
        if (is_string($parameters)) {
            $tempParameters = $parameters;
            parse_str($tempParameters, $parameters);
        }
        $encodedParameters = [];
        foreach ($parameters as $key => $value) {
            if (is_string($value)) { // // validation for case when try hack for example parameters like articles_id[]=73
                $encodedParameters[htmlspecialchars($key)] = htmlspecialchars($value);
            }
        }

        return http_build_query($encodedParameters);
    }

    /**
     * Function to return SEO URL link SEO'd with stock generattion for error fallback
     * @author Bobby Easland
     * @version 1.0
     * @param string $page Base script for URL
     * @param string $parameters URL parameters
     * @param string $connection NONSSL/SSL
     * @param boolean $add_session_id Switch to add osCsid
     * @return string Formed href link
     */
    function href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = false)
    {
        global $lng, $current_lang, $add_folder;

        if (!is_object($lng)) {
            require_once DIR_WS_CLASSES . 'language.php';
            $lng = new language();
        }

        $parameters = $this->encodeUrlParameters($parameters);

        $this->start($this->timestamp);
        $this->performance['NUMBER_URLS_GENERATED']++;

        // added to redirect not existing languages, for example solomono.net/fi
        $origUrl = preg_replace('/\//i', '', strip_tags($this->requested_page())); // delete slashes
        // if our url "/fi" is some of languages BUT its turned off in database - redirect to mainpage
        if (in_array($origUrl, array_keys($lng->languages)) and !in_array($origUrl, array_keys($lng->catalog_languages))) {
            header("HTTP/1.0 301 Moved Permanently"); //let the SE's know to not use this link
            header("Location: /");
        }

        if ($page == '/') {
            $page = 'index.php';
        }
        $current_lang = tep_db_prepare_input($_SESSION['language_short']);

        // solomono.net check ua, en, ru:
        $str_langs = implode("\/|", array_keys($lng->catalog_languages)); // checking all languages
        if (preg_match("/(" . $str_langs . "\/)/", $page)) { // searching coincidences in url
            $oldpage = $page;

            $page = preg_replace('/(' . $str_langs . '\/)/i', '', $page); // if we gat language here - delete it from url
            $page = preg_replace('/\//i', '', $page); // delete first slash (16.05.17)
            $current_lang_tmp = preg_replace('/' . $page . '/i', '', $oldpage); // find current url language
            $current_lang_tmp = preg_replace('/\//i', '', $current_lang_tmp); // delete last slash

            if (strlen($current_lang_tmp) != 2) { // if we see here roduct name, ex. paru/p-1.html - stop
                $page = $oldpage;
            } else {
                $current_lang = $current_lang_tmp;
            }
        }

        //  $link = $connection == 'NONSSL' ? $this->base_url : $this->base_url_ssl;
        $separator = '?';

        // solomono languages
        /*
        if($current_lang!=DEFAULT_LANGUAGE and $current_lang!='') {
          $link = rtrim($link, '/') . '/'; // reinsurance. clear from all slashes and then add slash in the end of line.
          $link = $link.$current_lang.'/';

        } elseif($current_lang==DEFAULT_LANGUAGE) {

        } elseif($lng->language['code']!=DEFAULT_LANGUAGE) {
          $link = rtrim($link, '/') . '/'; // reinsurance. clear from all slashes and then add slash in the end of line.
          $link = $link.$lng->language['code'].'/';
        }    */

        if ($current_lang != DEFAULT_LANGUAGE) {
            $link = '/' . $current_lang . '/';
        }

        // if our url not in array of seo_url urls, then NOT processing it, show as default.

        if (!in_array($page, $this->attributes['SEO_PAGES']) || $this->attributes['SEO_ENABLED'] == 'false') {
            $redirect_url = $link . $page . ($parameters ? '?' . $parameters : '');
            $redirect_url_parts = explode('://', $redirect_url);
            $redirect_url_parts[1] = preg_replace('~/{2,}~', '/', $redirect_url_parts[1]); // prevent like solomono.net//index.php
            $redirect_url = implode('://', $redirect_url_parts);

            return $link . $page . ($parameters ? '?' . $parameters : '');
        }

        if ($page == 'index.php' and !$this->not_null($parameters)) {
            $page = ''; // for SEO
        }
        if (strstr($parameters, 'keywords=') && $page == 'index.php') {
            $page = '';
        }

        if ($this->not_null($parameters)) {
            $link .= $this->parse_parameters($page, $parameters, $separator);
        } else {
            $link .= $page;
        }



        $link = $this->add_sid($link, $add_session_id, $connection, $separator);

        $this->stop($this->timestamp, $time);
        $this->performance['TOTAL_TIME'] += $time;

        if (empty($link)) {
            $link = $add_folder . '/';
        }

        switch ($this->attributes['SEO_URLS_USE_W3C_VALID']) {
            case ('true'):
                if (!isset($_SESSION['customer_id']) && defined('ENABLE_PAGE_CACHE') && ENABLE_PAGE_CACHE == 'true' && class_exists('page_cache')) {
                    return $link;
                } else {
                    return utf8_encode($link);
                }
                break;
            case ('false'):
                return $link;
                break;
        }
    } # end function

    /**
     * Stock function, fallback use
     */
    function stock_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true)
    {
        global $request_type, $session_started, $SID, $kill_sid; ///// SID-KILLER ( change) /// added $kill_sid.
        if (!$this->not_null($page)) {
            die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link!<br><br>');
        }
        $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
        if ($page == '/') {
            $page = '';
        }
        /*        if ($connection == 'NONSSL') {
                    $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
                } elseif ($connection == 'SSL') {
                    if (ENABLE_SSL == true) {
                        $link = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
                    } else {
                        $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
                    }
                } else {
                    die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL</b><br><br>');
                }*/
        if ($this->not_null($parameters)) {
            $link .= $page . '?' . $this->output_string($parameters);
            $separator = '&';
        } else {
            $link .= $page;
            $separator = '?';
        }
        while ((substr($link, -1) == '&') || (substr($link, -1) == '?')) {
            $link = substr($link, 0, -1);
        }
        if (($add_session_id == true) && ($session_started == true) && (SESSION_FORCE_COOKIE_USE == 'False')) {
            if ($this->not_null($SID)) {
                $_sid = $SID;
            }
            /*            elseif ((($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == true)) || (($request_type == 'SSL') && ($connection == 'NONSSL'))) {
                            if (HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
                                $_sid = $this->SessionName() . '=' . $this->SessionID();
                            }
                        }*/
        }

        switch (true) {
            case (!isset($_SESSION['customer_id']) && defined('ENABLE_PAGE_CACHE') && ENABLE_PAGE_CACHE == 'true' && class_exists('page_cache')):
                $page_cache = true;
                $return = $link . $separator . '<osCsid>';
                break;
            case (isset($_sid) && (!$kill_sid)): ///// SID-KILLER ( change ) /// ORG: case (isset($_sid)):
                $page_cache = false;
                $return = $link . $separator . tep_output_string($_sid);
                break;
            default:
                $page_cache = false;
                $return = $link;
                break;
        } # end switch
        $this->performance['NUMBER_STANDARD_URLS_GENERATED']++;
        $this->cache['STANDARD_URLS'][] = $link;
        $time = 0;
        $this->stop($this->timestamp, $time);
        $this->performance['TOTAL_TIME'] += $time;
        switch (true) {
            case ($this->attributes['SEO_URLS_USE_W3C_VALID'] == 'true' && !$page_cache):
                return htmlspecialchars(utf8_encode($return));
                break;
            default:
                return $return;
                break;
        }# end swtich
    } # end default tep_href function

    /**
     * Function to append session ID if needed
     * @author Bobby Easland
     * @version 1.2
     * @param string $link
     * @param boolean $add_session_id
     * @param string $connection
     * @param string $separator
     * @return string
     */
    function add_sid($link, $add_session_id, $connection, $separator)
    {
        global $request_type, $kill_sid; // global variable ///// SID-KILLER ( change ) /// added $kill_sid.
        if (($add_session_id) && ($this->attributes['SESSION_STARTED']) && (SESSION_FORCE_COOKIE_USE == 'False')) {
            if ($this->not_null($this->attributes['SID'])) {
                $_sid = $this->attributes['SID'];
            }
            /*            elseif ((($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == true)) || (($request_type == 'SSL') && ($connection == 'NONSSL'))) {
                            if (HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
                                $_sid = $this->SessionName() . '=' . $this->SessionID();
                            }
                        }*/
        }
        switch (true) {
            case (!isset($_SESSION['customer_id']) && defined('ENABLE_PAGE_CACHE') && ENABLE_PAGE_CACHE == 'true' && class_exists('page_cache')):
                $return = $link . $separator . '<osCsid>';
                break;
            case ($this->not_null($_sid) && (!$kill_sid)): ///// SID-KILLER ( change ) /// ORG: case ($this->not_null($_sid)):
                $return = $link . $separator . tep_output_string($_sid);
                break;
            default:
                $return = $link;
                break;
        } # end switch
        return $return;
    } # end function

    /**
     * SFunction to parse the parameters into an SEO URL
     * @author Bobby Easland
     * @version 1.2
     * @param string $page
     * @param string $params
     * @param string $separator NOTE: passed by reference
     * @return string
     */
    function parse_parameters($page, $params, &$separator)
    {

        global $lng, $current_lang, $connection;

        // reassign current language if its not = session language (for languages dropdown)
        if ($lng->language['code'] != $current_lang and $current_lang) {
            $this->languages_id = $lng->catalog_languages[$current_lang]['id'];
        } else {
            $this->languages_id = $lng->language['id'];
        }

        $p = @explode('&', $params);
        asort($p);
        $container = array();
        foreach ($p as $index => $valuepair) {
            $p2 = @explode('=', $valuepair);
            switch ($p2[0]) {
                case 'products_id':
                    //BOF: Attribute Fix
                    if ($this->is_attribute_string(urldecode($p2[1]))) {
                        $prodID = urldecode($p2[1]);
                        //Split the attributes from the product ID:
                        $prodAttr = substr($prodID, strpos($prodID, "{"));
                        $prodID = substr($prodID, 0, strpos($prodID, "{"));
                        $p2[1] = $prodID;
                        $container["options"] = $prodAttr;
                    }
                    //EOF: Attribute Fix

                    switch (true) {
                        case ($page == FILENAME_PRODUCT_INFO && !$this->is_attribute_string($p2[1])):
                            if ($this->get_product_name($p2[1]) == '') {
                                $r_prod_name = '-';
                            } else {
                                $r_prod_name = $this->get_product_name($p2[1]);
                            }
                            $url = $this->make_url($page, $r_prod_name, $p2[0], $p2[1], '.html', $separator);
                            $this->ValidateName($url, "p", $p2[1], $connection, $separator);
                            break;
                        default:
                            $container[$p2[0]] = $p2[1];
                            break;
                    } # end switch
                    break;
                case 'cPath':
                    switch (true) {
                        case ($page == FILENAME_DEFAULT):
                            if ($p2[1] == 0) {
                                //remove query params
                                $urlWithoutParams = explode('?', $_SERVER['REQUEST_URI'])[0];
                                //remove query params
                                $urlWithoutLanguage = array_reverse(array_unique(array_filter(explode('/', $urlWithoutParams))))[0];
                                $page = $urlWithoutLanguage;
                                if ($_GET['sort'] == 'new') {
                                    $page = 'new.html';
                                }
                                if ($_GET['type'] == 'specials') {
                                    $page = 'specials.html';
                                }
                                if ($_GET['sort'] == 'featured') {
                                    $page = 'featured.html';
                                }
                                $url = $page;
                                $this->ValidateName($url, "c", $p2[1], $connection, $separator);
                            } elseif ($this->promUrls) {
                                $url = $this->make_url($page, $this->get_category_name($p2[1]), $p2[0], $p2[1], '', $separator);
                                $this->ValidateName($url, "g", $p2[1], $connection, $separator);
                            } else {
                                $url = $this->make_url($page, $this->get_category_name($p2[1]), $p2[0], $p2[1], '.html', $separator);
                                $this->ValidateName($url, "c", $p2[1], $connection, $separator);
                            }
                            break;
                        case (!$this->is_product_string($params)):
                            if ($this->attributes['SEO_ADD_CPATH_TO_PRODUCT_URLS'] == 'true') {
                                $container[$p2[0]] = $p2[1];
                            }
                            break;
                        default:
                            $container[$p2[0]] = $p2[1];
                            break;
                    } # end switch
                    break;
                case 'manufacturers_id':
                    switch (true) {
                        case ($page == FILENAME_DEFAULT && !$this->is_cPath_string($params) && !$this->is_product_string($params)):
                            $url = $this->make_url($page, $this->get_manufacturer_name($p2[1]), $p2[0], $p2[1], '.html', $separator);
                            $this->ValidateName($url, "m", $p2[1], $connection, $separator);
                            break;
                        case ($page == FILENAME_PRODUCT_INFO):
                            break;
                        default:
                            $container[$p2[0]] = $p2[1];
                            break;
                    } # end switch
                    break;

                case 'tPath':
                    switch (true) {
                        case ($page == FILENAME_ARTICLES):
                            $url = $this->make_url($page, $this->get_topic_name($p2[1]), $p2[0], $p2[1], '.html', $separator);
                            $this->ValidateName($url, "t", $p2[1], $connection, $separator);
                            break;
                        default:
                            $container[$p2[0]] = $p2[1];
                            break;
                    } # end switch
                    break;
//ojp lPath
                case 'lPath':
                    switch (true) {
                        case ($page == FILENAME_LINKS):
                            $url = $this->make_url($page, $this->get_link_name($p2[1]), $p2[0], $p2[1], '.html', $separator);
                            $this->ValidateName($url, "l", $p2[1], $connection, $separator);
                            break;
                        default:
                            $container[$p2[0]] = $p2[1];
                            break;
                    } # end switch
                    break;

                case 'articles_id':
                    switch (true) {
                        case ($page == FILENAME_ARTICLE_INFO):
                            if (!empty($this->get_article_name($p2[1]))) {
                                $url = $this->make_url($page, $this->get_article_name($p2[1]), $p2[0], $p2[1], '.html', $separator);
                                $this->ValidateName($url, "a", $p2[1], $connection, $separator);
                            }
                            break;
                        default:
                            $container[$p2[0]] = $p2[1];
                            break;
                    } # end switch
                    break;

                // EOF: "Extra pages-info box w/ admin" support added by faaliyet
                /*
case 'pollid':
                                        switch(true){
                                                case ($page == 'pollbooth.php'):
                                                        $url = $this->make_url($page, $this->get_polls_name($p2[1]), $p2[0], $p2[1], '.html', $separator);
                                                        break;
                                                default:
                                                        $container[$p2[0]] = $p2[1];
                                                        break;
                                        } # end switch
                                        break;
*/

                default:
                    $container[$p2[0]] = $p2[1];
                    break;
            } # end switch
        } # end foreach $p
        $url = isset($url) ? $url : $page;
        if (sizeof($container) > 0) {
            if ($imploded_params = $this->implode_assoc($container)) {
                $url .= $separator . $this->output_string($imploded_params);
                $separator = '&';
            }
        }
        return $url;
    } # end function

    /**
     * Function to return the generated SEO URL
     * @author Bobby Easland
     * @version 1.0
     * @param string $page
     * @param string $string Stripped, formed anchor
     * @param string $anchor_type Parameter type (products_id, cPath, etc.)
     * @param integer $id
     * @param string $extension Default = .html
     * @param string $separator NOTE: passed by reference
     * @return string
     */
    function make_url($page, $string, $anchor_type, $id, $extension = '.html', &$separator)
    {
        // Right now there is but one rewrite method since cName was dropped
        // In the future there will be additional methods here in the switch

        switch ($this->attributes['SEO_REWRITE_TYPE']) {
            case 'Rewrite':
                if ($this->promUrls && $anchor_type !== "tPath") {
                    return $this->reg_anchors[$anchor_type] . $id . '-' . $string . $extension;
                } else {
                    return $string . $this->reg_anchors[$anchor_type] . $id . $extension;
                }
                break;
            default:
                break;
        } # end switch
    } # end function

    /**
     * Function to get the product name. Use evaluated cache, per page cache, or database query in that order of precedent
     * @author Bobby Easland
     * @version 1.1
     * @param integer $pID
     * @return string Stripped anchor text
     */
    function get_product_name($pID)
    {
        switch (true) {
            case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && defined('PRODUCT_NAME_' . $pID)):
                $this->performance['CACHE_QUERY_SAVINGS']++;
                $return = constant('PRODUCT_NAME_' . $pID);
                $this->cache['PRODUCTS'][$pID] = $return;
                break;
            case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && isset($this->cache['PRODUCTS'][$pID])):
                $this->performance['CACHE_QUERY_SAVINGS']++;
                $return = $this->cache['PRODUCTS'][$pID];
                break;
            default:
                $this->performance['NUMBER_QUERIES']++;
                //      $sql = "SELECT products_name as pName
                $sql = "SELECT products_name, products_url
						FROM " . TABLE_PRODUCTS_DESCRIPTION . "
						WHERE products_id=" . (int)$pID . "
						AND language_id=" . (int)$this->languages_id . "
						LIMIT 1";
                $result = $this->DB->FetchArray($this->DB->Query($sql));
                //raid
                if (!empty($result['products_url'])) {
                    $result['pName'] = $result['products_url'];
                } else {
                    $result['pName'] = $result['products_name'];
                }
                //-----
                $pName = $this->strip($result['pName']);
                $this->cache['PRODUCTS'][$pID] = $pName;
                $this->performance['QUERIES']['PRODUCTS'][] = $sql;
                $return = $pName;
                break;
        } # end switch

        $return = getCPathUrlPart($pID, $this->languages_id) . $return;

        //convert cyrilic symbols to latin
        $trdic = array(
            "С‘" => "yo", "Р¶" => "zh", "С„" => "ph", "С…" => "kh", "С†" => "ts", "С‡" => "ch", "С€" => "sh", "С‰" => "sch", "СЌ" => "e", "СЋ" => "ju", "СЏ" => "ja",

            "Р°" => "a", "Р±" => "b", "РІ" => "v", "Рі" => "g", "Рґ" => "d", "Рµ" => "e", "Р·" => "z", "Рё" => "i", "Р№" => "j", "Рє" => "k", "Р»" => "l", "Рј" => "m",
            "РЅ" => "n", "Рѕ" => "o", "Рї" => "p", "СЂ" => "r", "СЃ" => "s", "С‚" => "t", "Сѓ" => "u", "С…" => "h", "С†" => "c", "С‹" => "y",

            "РЃ" => "Yo", "Р–" => "ZH", "Р¤" => "PH", "РҐ" => "KH", "Р¦" => "TS", "Р§" => "CH", "РЁ" => "SH", "Р©" => "SCH", "Р­" => "E", "Р®" => "JU", "РЇ" => "JA",

            "Рђ" => "A", "Р‘" => "B", "Р’" => "V", "Р“" => "G", "Р”" => "D", "Р•" => "E", "Р—" => "Z", "Р" => "I", "Р™" => "J", "Рљ" => "K", "Р›" => "L", "Рњ" => "M", "Рќ" => "N",

            "Рћ" => "O", "Рџ" => "P", "Р " => "R", "РЎ" => "S", "Рў" => "T", "РЈ" => "U", "РҐ" => "H", "Р¦" => "C", "Р«" => "Y",
            // -----------------------
            "РЄ" => "", "Р¬" => "", "СЉ" => "", "СЊ" => ""
        );

        $txt = $return;
        return nl2br(strtr(stripslashes($txt), $trdic));
    } # end function

    /**
     * Function to get the category name. Use evaluated cache, per page cache, or database query in that order of precedent
     * @author Bobby Easland
     * @version 1.1
     * @param integer $cID NOTE: passed by reference
     * @return string Stripped anchor text
     */
    function get_category_name(&$cID)
    {
        if ($this->promUrls) {
            $cID = explode('-', $cID);
            $cID = array_pop($cID);
            $full_cPath = $single_cID = $cID;
        } else {
            if (getConstantValue('SEO_ADD_PARENT_CATEGORIES_TO_URL') === 'true') {
                $full_cPath = $this->get_full_cPath($cID, $single_cID); // full cPath needed for uniformity
            } else {
                $full_cPath = $single_cID = $cID;
            }
        }
        switch (true) {
            case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && defined('CATEGORY_NAME_' . $full_cPath)):
                $this->performance['CACHE_QUERY_SAVINGS']++;
                $return = constant('CATEGORY_NAME_' . $full_cPath);

                $this->cache['CATEGORIES'][$full_cPath] = $return;
                break;
            case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && isset($this->cache['CATEGORIES'][$full_cPath])):
                $this->performance['CACHE_QUERY_SAVINGS']++;
                $return = $this->cache['CATEGORIES'][$full_cPath];
                break;
            default:
                $this->performance['NUMBER_QUERIES']++;
                switch (true) {
                    case ($this->attributes['SEO_ADD_CAT_PARENT'] == 'true'):
                        $sql = "SELECT c.categories_id, c.parent_id, cd.categories_name as cName, cd2.categories_name as pName, cd.categories_seo_url as cURL, cd2.categories_seo_url as pURL
								FROM " . TABLE_CATEGORIES . " c
								JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd
								ON c.categories_id = cd.categories_id
								LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd2
								ON c.parent_id=cd2.categories_id AND cd2.language_id=" . (int)$this->languages_id . "
								WHERE c.categories_id=" . (int)$single_cID . "
								AND cd.categories_id=" . (int)$single_cID . "
								AND cd.language_id=" . (int)$this->languages_id . "
								LIMIT 1";
                        $result = $this->DB->FetchArray($this->DB->Query($sql));
                        //raid
                        $result['cName'] = $result['cURL'] ? $result['cURL'] : $result['cName'];
                        $result['pName'] = $result['pURL'] ? $result['pURL'] : $result['pName'];
                        //raid end
                        $cName = $this->not_null($result['pName']) ? $result['pName'] . ' ' . $result['cName'] : $result['cName'];
                        break;
                    default:
                        $sql = "SELECT categories_name as cName, categories_seo_url as cURL 
								FROM " . TABLE_CATEGORIES_DESCRIPTION . "
								WHERE categories_id=" . (int)$single_cID . "
								AND language_id=" . (int)$this->languages_id . "
								LIMIT 1";
                        $result = $this->DB->FetchArray($this->DB->Query($sql));
                        $cName = $result['cURL'] ? $result['cURL'] : $result['cName'];
                        break;
                }

                $cName = $this->strip($cName);
                $this->cache['CATEGORIES'][$full_cPath] = $cName;
                $this->performance['QUERIES']['CATEGORIES'][] = $sql;
                $return = $cName;
                break;
        } # end switch
        $cID = $full_cPath;

        if ($single_cID == 0) {
            return 'all';
        } elseif ($return == '') {
            return '-';
        } else {
            return $return;
        }
    } # end function

    function Validatename($url, $type, $realID, $connection, $separator)
    {
        global $lng, $current_lang, $skipValidation, $allowRedirect;

        // if language does not match - do not do any redirects:
        if ($lng->language['code'] == $current_lang && $current_lang && empty($skipValidation)) {
            $origUrl = strip_tags($this->requested_page());  //get the actual page requested
            $zaprosi = explode("?", $origUrl);
            $origUrl = $zaprosi[0];
            $parts = explode("/", $origUrl);

            $new_type = explode('-', $parts[count($parts) - 1]);

            if ($this->promUrls) {
                $check = $new_type[0][0] == $type;
            } else {
                $check = $new_type[0] == $type;
            }

            //  if ($new_type[count($new_type) - 2] == $type)
            if ($check) {  //make sure it is the correct type for this link
                if ($this->promUrls) {
                    $id = str_replace($type, '', explode('-', $parts[0])[0]);
                } else {
                    if (($pos = strpos($parts[count($parts) - 1], ".html")) !== false) {
                        $id = substr($parts[count($parts) - 1], 0, $pos);       //strip .html
                    }
                    $id = explode($new_type[0] . '-', $id);
                    $id = $id[1];
                }
                // raid:
                $id = urldecode($id);

                $id = preg_replace('/_/i', '-', $id);
                $id = preg_replace('/[^0-9,-]/i', '', $id);

                $realID = preg_replace('/_/i', '-', $realID);
                $realID = preg_replace('/[^0-9,-]/i', '', $realID);

                $catalog = DIR_WS_HTTP_CATALOG;
                if ($catalog[0] == '/') {
                    $catalog = substr(DIR_WS_HTTP_CATALOG, 1);             //strip leading slash if present
                }


                if (!empty($catalog) && strpos($origUrl, $catalog) !== false) {
                    $origUrl = substr($origUrl, strlen($catalog));         //remove the catalog from the url string
                }

                // solomono languages
                if ($lng->language['code'] != DEFAULT_LANGUAGE) {
                    $url = $lng->language['code'] . '/' . $url;
                }




                if (!empty($origUrl) && $id === $realID && $origUrl !== $url && isset($allowRedirect) && $allowRedirect) {
                    if (!empty($zaprosi[1])) {
                        $url = $this->base_url . $url . '?' . $zaprosi[1];
                    } else {
                        $url = $this->base_url . $url;
                    }
                    //    $link = $this->add_sid($url, true, $connection, $separator); //build the correct link with SID
                    header("HTTP/1.0 301 Moved Permanently");             //let the SE's know to not use this link
                    header("Location: $url");                            //redirect to the real page
                }
            } elseif ($allowRedirect && $_SERVER['REQUEST_URI'] === '/?cPath=' . $realID) {
                header("HTTP/1.0 301 Moved Permanently");             //let the SE's know to not use this link
                header("Location: $url");                            //redirect to the real page
            }
        }
        //   header("Location: ".$new_type[0]);
    }

    function requested_page()
    {
        $protocol = ((int)$_SERVER['SERVER_PORT'] === 443) ? 'https://' : 'http://';
        $current_page = $protocol . $_SERVER['HTTP_HOST'] . ((!empty($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '');
        $current_page = substr($current_page, strlen(HTTP_SERVER));
        if (($pos = strpos($current_page, "?osCsid")) !== false) {
            $current_page = substr($current_page, 0, $pos) . '<br>';
        }
        if ($current_page[0] == "/") {
            $current_page = substr($current_page, 1);
        }

        return $current_page;
    }

    /**
     * Function to get the manufacturer name. Use evaluated cache, per page cache, or database query in that order of precedent.
     * @author Bobby Easland
     * @version 1.1
     * @param integer $mID
     * @return string
     */
    function get_manufacturer_name($mID)
    {
        global $languages_id;
        switch (true) {
            case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && defined('MANUFACTURER_NAME_' . $mID)):
                $this->performance['CACHE_QUERY_SAVINGS']++;
                $return = constant('MANUFACTURER_NAME_' . $mID);
                $this->cache['MANUFACTURERS'][$mID] = $return;
                break;
            case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && isset($this->cache['MANUFACTURERS'][$mID])):
                $this->performance['CACHE_QUERY_SAVINGS']++;
                $return = $this->cache['MANUFACTURERS'][$mID];
                break;
            default:
                $this->performance['NUMBER_QUERIES']++;
                $sql = "SELECT mi.manufacturers_name as mName, manufacturers_seo_url as mURL
						FROM " . TABLE_MANUFACTURERS . " m
						JOIN " . TABLE_MANUFACTURERS_INFO . " mi on
						mi.manufacturers_id = m.manufacturers_id
						WHERE m.manufacturers_id=" . (int)$mID . "
						AND languages_id = " . (int)$languages_id . "
						LIMIT 1";
                $result = $this->DB->FetchArray($this->DB->Query($sql));
                //raid
                $result['mName'] = $result['mURL'] ? $result['mURL'] : $result['mName'];
                //raid end
                $mName = $this->strip($result['mName']);
                $this->cache['MANUFACTURERS'][$mID] = $mName;
                $this->performance['QUERIES']['MANUFACTURERS'][] = $sql;
                $return = $mName;
                break;
        } # end switch
        return $return;
    } # end function

    /**
     * Function to get the article name. Use evaluated cache, per page cache, or database query in that order of precedent.
     * @author Bobby Easland
     * @version 1.0
     * @param integer $aID
     * @return string
     */
    function get_article_name($aID)
    {
        switch (true) {
            case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && defined('ARTICLE_NAME_' . $aID)):
                $this->performance['CACHE_QUERY_SAVINGS']++;
                $return = constant('ARTICLE_NAME_' . $aID);
                $this->cache['ARTICLES'][$aID] = $return;
                break;
            case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && isset($this->cache['ARTICLES'][$aID])):
                $this->performance['CACHE_QUERY_SAVINGS']++;
                $return = $this->cache['ARTICLES'][$aID];
                break;
            default:
                $this->performance['NUMBER_QUERIES']++;
                $sql = "SELECT articles_name as aName, articles_url as aURL
						FROM " . TABLE_ARTICLES_DESCRIPTION . "
						WHERE articles_id=" . (int)$aID . "
						AND language_id=" . (int)$this->languages_id . "
						LIMIT 1";
                $result = $this->DB->FetchArray($this->DB->Query($sql));
                //raid
                $result['aName'] = $result['aURL'] ? $result['aURL'] : $result['aName'];
                //raid end
                $aName = $this->strip($result['aName']);
                $this->cache['ARTICLES'][$aID] = $aName;
                $this->performance['QUERIES']['ARTICLES'][] = $sql;
                $return = $aName;
                break;
        } # end switch
        return $return;
    } # end function

    /**
     * Function to get the authors name. Use evaluated cache, per page cache, or database query in that order of precedent.
     * @author Bobby Easland
     * @version 1.0
     * @param integer $aID
     * @return string
     */
    function get_authors_name($auID)
    {
        switch (true) {
            case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && defined('AUTHORS_NAME_' . $auID)):
                $this->performance['CACHE_QUERY_SAVINGS']++;
                $return = constant('AUTHORS_NAME_' . $auID);
                $this->cache['AUTHORS'][$auID] = $return;
                break;
            case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && isset($this->cache['AUTHORS'][$auID])):
                $this->performance['CACHE_QUERY_SAVINGS']++;
                $return = $this->cache['AUTHORS'][$auID];
                break;
            default:
                $this->performance['NUMBER_QUERIES']++;
                $sql = "SELECT authors_name as auName
						FROM " . TABLE_AUTHORS . "
						WHERE authors_id=" . (int)$auID . "

						LIMIT 1";
                $result = $this->DB->FetchArray($this->DB->Query($sql));
                $auName = $this->strip($result['auName']);
                $this->cache['AUTHORS'][$auID] = $auName;
                $this->performance['QUERIES']['AUTHORS'][] = $sql;
                $return = $auName;
                break;
        } # end switch
        return $return;
    } # end function

    /**
     * Function to get the topic name. Use evaluated cache, per page cache, or database query in that order of precedent.
     * @author Bobby Easland
     * @version 1.1
     * @param integer $tID
     * @return string
     */
    function get_topic_name($tID)
    {
        switch (true) {
            case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && defined('TOPIC_NAME_' . $tID)):
                $this->performance['CACHE_QUERY_SAVINGS']++;
                $return = constant('TOPIC_NAME_' . $tID);
                $this->cache['TOPICS'][$tID] = $return;
                break;
            case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && isset($this->cache['TOPICS'][$tID])):
                $this->performance['CACHE_QUERY_SAVINGS']++;
                $return = $this->cache['TOPICS'][$tID];
                break;
            default:
                $this->performance['NUMBER_QUERIES']++;
                $sql = "SELECT topics_name as tName
						FROM " . TABLE_TOPICS_DESCRIPTION . "
						WHERE topics_id=" . (int)$tID . "
						AND language_id=" . (int)$this->languages_id . "
						LIMIT 1";
                $result = $this->DB->FetchArray($this->DB->Query($sql));
                $tName = $this->strip($result['tName']);
                $tName = $tName ?: '-';
                $this->cache['ARTICLES'][$aID] = $tName;
                $this->performance['QUERIES']['TOPICS'][] = $sql;
                $return = $tName;
                break;
        } # end switch
        return $return;
    } # end function

    /**
     * Function to get the polls name. Use evaluated cache, per page cache, or database query in that order of precedent.
     * @author Antonello Venturino
     * @version 1.1
     * @param integer $poID
     * @return string

    function get_polls_name($poID){
     * switch(true){
     * case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && defined('POLLS_NAME_' . $poID)):
     * $this->performance['CACHE_QUERY_SAVINGS']++;
     * $return = constant('POLLS_NAME_' . $poID);
     * $this->cache['POLLS'][$poID] = $return;
     * break;
     * case ($this->attributes['USE_SEO_CACHE_GLOBAL'] == 'true' && isset($this->cache['POLLS'][$poID])):
     * $this->performance['CACHE_QUERY_SAVINGS']++;
     * $return = $this->cache['POLLS'][$poID];
     * break;
     * default:
     * $this->performance['NUMBER_QUERIES']++;
     * $sql = "SELECT optiontext as poName
     * FROM " . TABLE_PHESIS_POLL_DATA . "
     * WHERE pollid='".(int)$poID."'
     * AND language_id='".(int)$this->languages_id."'
     * LIMIT 1";
     * $result = $this->DB->FetchArray( $this->DB->Query( $sql ) );
     * $poName = $this->strip( $result['poName'] );
     * $this->cache['POLLS'][$poID] = $poName;
     * $this->performance['QUERIES']['POLLS'][] = $sql;
     * $return = $poName;
     * break;
     *
     * } # end switch
     * return $return;
     * } # end function
     */


    /**
     * Function to retrieve full cPath from category ID
     * @author Bobby Easland
     * @version 1.1
     * @param mixed $cID Could contain cPath or single category_id
     * @param integer $original Single category_id passed back by reference
     * @return string Full cPath string
     */
    function get_full_cPath($cID, &$original)
    {
        if (is_numeric(strpos($cID, '-'))) {
            $temp = @explode('-', $cID);
            $original = $temp[sizeof($temp) - 1];
            return $cID;
        } else {
            $c = array();
            $this->GetParentCategories($c, $cID);
            $c = array_reverse($c);
            $c[] = $cID;
            $original = $cID;
            $cID = sizeof($c) > 1 ? implode('-', $c) : $cID;
            return $cID;
        }
    } # end function

    /**
     * Recursion function to retrieve parent categories from category ID
     * @author Bobby Easland
     * @version 1.0
     * @param mixed $categories Passed by reference
     * @param integer $categories_id
     */
    function GetParentCategories(&$categories, $categories_id)
    {
        $sql = "SELECT parent_id
		        FROM " . TABLE_CATEGORIES . "
				WHERE categories_id=" . (int)$categories_id;
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

    /**
     * Function to check if a value is NULL
     * @author Bobby Easland as abstracted from osCommerce-MS2.2
     * @version 1.0
     * @param mixed $value
     * @return boolean
     */
    function not_null($value)
    {
        if (is_array($value)) {
            if (sizeof($value) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            if (($value !== '') && !is_null($value)) {
                //  if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
                return true;
            } else {
                return false;
            }
        }
    } # end function

    /**
     * Function to check if the products_id contains an attribute
     * @author Bobby Easland
     * @version 1.1
     * @param integer $pID
     * @return boolean
     */
    function is_attribute_string($pID)
    {
        if (is_numeric(strpos($pID, '{'))) {
            return true;
        } else {
            return false;
        }
    } # end function

    /**
     * Function to check if the params contains a products_id
     * @author Bobby Easland
     * @version 1.1
     * @param string $params
     * @return boolean
     */
    function is_product_string($params)
    {
        if (is_numeric(strpos('products_id', $params))) {
            return true;
        } else {
            return false;
        }
    } # end function

    /**
     * Function to check if cPath is in the parameter string
     * @author Bobby Easland
     * @version 1.0
     * @param string $params
     * @return boolean
     */
    function is_cPath_string($params)
    {
        if (preg_match('/cPath/i', $params)) {
            return true;
        } else {
            return false;
        }
    } # end function

    /**
     * Function used to output class profile
     * @author Bobby Easland
     * @version 1.0
     */
    function profile()
    {
        $this->calculate_performance();
        $this->PrintArray($this->attributes, 'Class Attributes');
        $this->PrintArray($this->cache, 'Cached Data');
    } # end function

    /**
     * Function used to calculate and output the performance metrics of the class
     * @author Bobby Easland
     * @version 1.0
     * @return mixed Output of performance data wrapped in HTML pre tags
     */
    function calculate_performance()
    {
        foreach ($this->cache as $type) {
            $this->performance['TOTAL_CACHED_PER_PAGE_RECORDS'] += sizeof($type);
        }
        $this->performance['TIME_PER_URL'] = $this->performance['TOTAL_TIME'] / $this->performance['NUMBER_URLS_GENERATED'];
        return $this->PrintArray($this->performance, 'Performance Data');
    } # end function

    /**
     * Function to strip the string of punctuation and white space
     * @author Bobby Easland
     * @version 1.1
     * @param string $string
     * @return string Stripped text. Removes all non-alphanumeric characters.
     */
    function strip($string)
    {
        global $lng, $current_lang;
//        if (($lng->language['code']!='en' || $current_lang != 'en') and is_array($this->attributes['SEO_CHAR_CONVERT_SET'])) $string = strtr($string, $this->attributes['SEO_CHAR_CONVERT_SET']);
        //translit for other languages:
        if (function_exists('transliterator_transliterate')) {
            $string = transliterator_transliterate('NFD; [:Nonspacing Mark:] Remove; NFC; Any-Latin; Latin-ASCII; Lower();', $string);
        } elseif (is_array($this->attributes['SEO_CHAR_CONVERT_SET'])) {
            $string = strtr($string, $this->attributes['SEO_CHAR_CONVERT_SET']);
        }
        $pattern = $this->attributes['SEO_REMOVE_ALL_SPEC_CHARS'] == 'true'
            ? "([^[:alnum:]])+"
            : "[[:punct:]]+"; // (?!-)
        $anchor = preg_replace('/' . $pattern . '/', '-', mb_convert_case($string, MB_CASE_LOWER, "utf-8"));
        $anchor = preg_replace('/[^\00-\255]+/u', '', $anchor);
        $pattern = "([[:space:]]|[[:blank:]])+";
        $anchor = preg_replace('/' . $pattern . '/', '-', $anchor);
        $anchor = preg_replace('/[[:punct:]]+/', '-', $anchor);
        return $this->short_name($anchor); // return the short filtered name
    } # end function

    /**
     * Function to expand the SEO_CONVERT_SET group
     * @author Bobby Easland
     * @version 1.0
     * @param string $set
     * @return mixed
     */
    function expand($set)
    {
        if (is_readable(DIR_WS_MODULES . 'cyrillic_conversion.php')) {
            include_once DIR_WS_MODULES . 'cyrillic_conversion.php';
            if (isset($cyryllic) && is_array($cyryllic)) {
                return $cyryllic;
            }
        }
        $container = array();
        if ($this->not_null($set)) {
            if ($data = @explode(',', $set)) {
                foreach ($data as $index => $valuepair) {
                    $p = @explode('=>', $valuepair);
                    $container[trim($p[0])] = trim($p[1]);
                }
                return $container;
            } else {
                return 'false';
            }
        } else {
            return 'false';
        }
    } # end function

    /**
     * Function to return the short word filtered string
     * @author Bobby Easland
     * @version 1.0
     * @param string $str
     * @param integer $limit
     * @return string Short word filtered
     */
    function short_name($str, $limit = 3)
    {
        if ($this->attributes['SEO_URLS_FILTER_SHORT_WORDS'] != 'false') {
            $limit = (int)$this->attributes['SEO_URLS_FILTER_SHORT_WORDS'];
        }
        $foo = @explode('/', $str);
        foreach ($foo as $index => $value) {
            switch (true) {
                case (strlen($value) <= $limit):
                    continue 2;
                default:
                    $container[] = $value;
                    break;
            }
        } # end foreach
        $container = ((is_array($container) and sizeof($container)) > 1 ? implode('/', $container) : $str);
        return $container;
    }

    /**
     * Function to implode an associative array
     * @author Bobby Easland
     * @version 1.0
     * @param array $array Associative data array
     * @param string $inner_glue
     * @param string $outer_glue
     * @return string
     */
    function implode_assoc($array, $inner_glue = '=', $outer_glue = '&')
    {
        $output = array();
        foreach ($array as $key => $item) {
            if ($this->not_null($key) && $this->not_null($item)) {
                $output[] = $key . $inner_glue . $item;
            }
        } # end foreach
        return @implode($outer_glue, $output);
    }

    /**
     * Function to print an array within pre tags, debug use
     * @author Bobby Easland
     * @version 1.0
     * @param mixed $array
     */
    function PrintArray($array, $heading = '')
    {
        echo '<fieldset style="border-style:solid; border-width:1px;">' . "\n";
        echo '<legend style="background-color:#FFFFCC; border-style:solid; border-width:1px;">' . $heading . '</legend>' . "\n";
        echo '<pre style="text-align:left;">' . "\n";
        print_r($array);
        echo '</pre>' . "\n";
        echo '</fieldset><br>' . "\n";
    } # end function

    /**
     * Function to start time for performance metric
     * @author Bobby Easland
     * @version 1.0
     * @param float $start_time
     */
    function start(&$start_time)
    {
        $start_time = explode(' ', microtime());
    }

    /**
     * Function to stop time for performance metric
     * @author Bobby Easland
     * @version 1.0
     * @param float $start
     * @param float $time NOTE: passed by reference
     */
    function stop($start, &$time)
    {
        $end = explode(' ', microtime());
        $time = number_format(array_sum($end) - array_sum($start), 8, '.', '');
    }

    /**
     * Function to translate a string
     * @author Bobby Easland
     * @version 1.0
     * @param string $data String to be translated
     * @param array $parse Array of tarnslation variables
     * @return string
     */
    function parse_input_field_data($data, $parse)
    {
        return strtr(trim($data), $parse);
    }

    /**
     * Function to output a translated or sanitized string
     * @author Bobby Easland
     * @version 1.0
     * @param string $sting String to be output
     * @param mixed $translate Array of translation characters
     * @param boolean $protected Switch for htemlspecialchars processing
     * @return string
     */
    function output_string($string, $translate = false, $protected = false)
    {
        if ($protected == true) {
            return htmlspecialchars($string);
        } else {
            if ($translate == false) {
                return $this->parse_input_field_data($string, array('"' => '&quot;'));
            } else {
                return $this->parse_input_field_data($string, $translate);
            }
        }
    }

    /**
     * Function to return the session ID
     * @author Bobby Easland
     * @version 1.0
     * @param string $sessid
     * @return string
     */
    function SessionID($sessid = '')
    {
        if (!empty($sessid)) {
            return session_id($sessid);
        } else {
            return session_id();
        }
    }

    /**
     * Function to return the session name
     * @author Bobby Easland
     * @version 1.0
     * @param string $name
     * @return string
     */
    function SessionName($name = '')
    {
        if (!empty($name)) {
            return session_name($name);
        } else {
            return session_name();
        }
    }

    /**
     * Function to generate products cache entries
     * @author Bobby Easland
     * @version 1.0
     */
    function generate_products_cache()
    {
        $this->is_cached($this->cache_file . 'products', $is_cached, $is_expired);
        if (!$is_cached || $is_expired) {
            $sql = "SELECT p.products_id as id, pd.products_name as name, pd.products_url as products_url, mi.manufacturers_name as manufacturer FROM " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS_INFO . " mi WHERE p.products_id=pd.products_id and m.manufacturers_id = p.manufacturers_id and mi.manufacturers_id = m.manufacturers_id and p.products_status='1' and pd.language_id = mi.languages_id and pd.language_id=" . (int)$this->languages_id;
            $product_query = $this->DB->Query($sql);
            $prod_cache = '';
            while ($product = $this->DB->FetchArray($product_query)) {
                if (!empty($product['products_url'])) {
                    $product['name'] = $product['products_url'];
                } else {
                    $product['name'] = $product['products_name'];
                }

                //  $define = 'define(\'PRODUCT_NAME_' . $product['id'] . '\', \'' .  $this->strip($product['manufacturer'] . ' - ' . $product['name']) . '\');';
                $define = 'define(\'PRODUCT_NAME_' . $product['id'] . '\', \'' . $this->strip($product['name']) . '\');';
                $prod_cache .= $define . "\n";
                eval("$define");
            }
            $this->DB->Free($product_query);
            $this->save_cache($this->cache_file . 'products', $prod_cache, 'EVAL', 1, 1);
            unset($prod_cache);
        } else {
            $this->get_cache($this->cache_file . 'products');
        }
    } # end function

    /**
     * Function to generate manufacturers cache entries
     * @author Bobby Easland
     * @version 1.0
     */
    function generate_manufacturers_cache()
    {
        $this->is_cached($this->cache_file . 'manufacturers', $is_cached, $is_expired);
        if (!$is_cached || $is_expired) { // it's not cached so create it
            $sql = "SELECT m.manufacturers_id as id, md.manufacturers_name as name
		        FROM " . TABLE_MANUFACTURERS . " m
				LEFT JOIN " . TABLE_MANUFACTURERS_INFO . " md
				ON m.manufacturers_id=md.manufacturers_id
				AND md.languages_id=" . (int)$this->languages_id;
            $manufacturers_query = $this->DB->Query($sql);
            $man_cache = '';
            while ($manufacturer = $this->DB->FetchArray($manufacturers_query)) {
                $define = 'define(\'MANUFACTURER_NAME_' . $manufacturer['id'] . '\', \'' . $this->strip($manufacturer['name']) . '\');';
                $man_cache .= $define . "\n";
                eval("$define");
            }
            $this->DB->Free($manufacturers_query);
            $this->save_cache($this->cache_file . 'manufacturers', $man_cache, 'EVAL', 1, 1);
            unset($man_cache);
        } else {
            $this->get_cache($this->cache_file . 'manufacturers');
        }
    } # end function

    /**
     * Function to generate categories cache entries
     * @author Bobby Easland
     * @version 1.1
     */
    function generate_categories_cache()
    {
        $this->is_cached($this->cache_file . 'categories', $is_cached, $is_expired);
        if (!$is_cached || $is_expired) { // it's not cached so create it
            switch (true) {
                case ($this->attributes['SEO_ADD_CAT_PARENT'] == 'true'):
                    $sql = "SELECT c.categories_id as id, c.parent_id, cd.categories_name as cName, cd2.categories_name as pName
							FROM " . TABLE_CATEGORIES . " c
							JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd
							ON c.categories_id = cd.categories_id
							LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd2
							ON c.parent_id=cd2.categories_id AND cd2.language_id=" . (int)$this->languages_id . "
							WHERE c.categories_id=cd.categories_id
							AND cd.language_id=" . (int)$this->languages_id;
                    break;
                default:
                    $sql = "SELECT categories_id as id, categories_name as cName
							FROM " . TABLE_CATEGORIES_DESCRIPTION . "
							WHERE language_id=" . (int)$this->languages_id;
                    break;
            } # end switch
            $category_query = $this->DB->Query($sql);
            $cat_cache = '';
            while ($category = $this->DB->FetchArray($category_query)) {
                $id = $this->get_full_cPath($category['id'], $single_cID);
                $name = $this->not_null($category['pName']) ? $category['pName'] . ' ' . $category['cName'] : $category['cName'];
                $define = 'define(\'CATEGORY_NAME_' . $id . '\', \'' . $this->strip($name) . '\');';
                $cat_cache .= $define . "\n";
                eval("$define");
            }
            $this->DB->Free($category_query);
            $this->save_cache($this->cache_file . 'categories', $cat_cache, 'EVAL', 1, 1);
            unset($cat_cache);
        } else {
            $this->get_cache($this->cache_file . 'categories');
        }
    } # end function

    /**
     * Function to generate articles cache entries
     * @author Bobby Easland
     * @version 1.0
     */
    function generate_articles_cache()
    {
        $this->is_cached($this->cache_file . 'articles', $is_cached, $is_expired);
        if (!$is_cached || $is_expired) { // it's not cached so create it
            $sql = "SELECT articles_id as id, articles_name as name
					FROM " . TABLE_ARTICLES_DESCRIPTION . "
					WHERE language_id = " . (int)$this->languages_id;
            $article_query = $this->DB->Query($sql);
            $article_cache = '';
            while ($article = $this->DB->FetchArray($article_query)) {
                $define = 'define(\'ARTICLE_NAME_' . $article['id'] . '\', \'' . $this->strip($article['name']) . '\');';
                $article_cache .= $define . "\n";
                eval("$define");
            }
            $this->DB->Free($article_query);
            $this->save_cache($this->cache_file . 'articles', $article_cache, 'EVAL', 1, 1);
            unset($article_cache);
        } else {
            $this->get_cache($this->cache_file . 'articles');
        }
    } # end function


    /**
     * Function to generate authors cache entries
     * @author Bobby Easland
     * @version 1.0
     */
    function generate_authors_cache()
    {
        $this->is_cached($this->cache_file . 'authors', $is_cached, $is_expired);
        if (!$is_cached || $is_expired) { // it's not cached so create it
            $sql = "SELECT authors_id as id, authors_name as name
					FROM " . TABLE_AUTHORS . "
					WHERE language_id=" . (int)$this->languages_id;
            $authors_query = $this->DB->Query($sql);
            $authors_cache = '';
            while ($authors = $this->DB->FetchArray($authors_query)) {
                $define = 'define(\'AUTHORS_NAME_' . $authors['id'] . '\', \'' . $this->strip($authors['name']) . '\');';
                $authors_cache .= $define . "\n";
                eval("$define");
            }
            $this->DB->Free($authors_query);
            $this->save_cache($this->cache_file . 'authors', $authors_cache, 'EVAL', 1, 1);
            unset($authors_cache);
        } else {
            $this->get_cache($this->cache_file . 'authors');
        }
    } # end function

    /**
     * Function to generate topics cache entries
     * @author Bobby Easland
     * @version 1.0
     */
    function generate_topics_cache()
    {
        $this->is_cached($this->cache_file . 'topics', $is_cached, $is_expired);
        if (!$is_cached || $is_expired) { // it's not cached so create it
            $sql = "SELECT topics_id as id, topics_name as name
					FROM " . TABLE_TOPICS_DESCRIPTION . "
					WHERE language_id=" . (int)$this->languages_id;
            $topic_query = $this->DB->Query($sql);
            $topic_cache = '';
            while ($topic = $this->DB->FetchArray($topic_query)) {
                $define = 'define(\'TOPIC_NAME_' . $topic['id'] . '\', \'' . $this->strip($topic['name']) . '\');';
                $topic_cache .= $define . "\n";
                eval("$define");
            }
            $this->DB->Free($topic_query);
            $this->save_cache($this->cache_file . 'topics', $topic_cache, 'EVAL', 1, 1);
            unset($topic_cache);
        } else {
            $this->get_cache($this->cache_file . 'topics');
        }
    } # end function

    /**
     * Function to save the cache to database
     * @author Bobby Easland
     * @version 1.0
     * @param string $name Cache name
     * @param mixed $value Can be array, string, PHP code, or just about anything
     * @param string $method RETURN, ARRAY, EVAL
     * @param integer $gzip Enables compression
     * @param integer $global Sets whether cache record is global is scope
     * @param string $expires Sets the expiration
     */
    function save_cache($name, $value, $method = 'RETURN', $gzip = 1, $global = 0, $expires = '30/days')
    {
        $expires = $this->convert_time($expires);
        if ($method == 'ARRAY') {
            $value = serialize($value);
        }
        $value = ($gzip === 1 ? base64_encode(gzdeflate($value, 1)) : addslashes($value));
        $sql_data_array = array('cache_id' => md5($name),
                                'cache_language_id' => (int)$this->languages_id,
                                'cache_name' => $name,
                                'cache_data' => $value,
                                'cache_global' => (int)$global,
                                'cache_gzip' => (int)$gzip,
                                'cache_method' => $method,
                                'cache_date' => date("Y-m-d H:i:s"),
                                'cache_expires' => $expires
        );
        $this->is_cached($name, $is_cached, $is_expired);
        $cache_check = ($is_cached ? 'true' : 'false');
        switch ($cache_check) {
            case 'true':
                $this->DB->DBPerform('cache', $sql_data_array, 'update', "cache_id='" . md5($name) . "'");
                break;
            case 'false':
                $this->DB->DBPerform('cache', $sql_data_array, 'insert');
                break;
            default:
                break;
        } # end switch ($cache check)
        # unset the variables...clean as we go
        unset($value, $expires, $sql_data_array);
    }# end function save_cache()

    /**
     * Function to get cache entry
     * @author Bobby Easland
     * @version 1.0
     * @param string $name
     * @param boolean $local_memory
     * @return mixed
     */
    function get_cache($name = 'GLOBAL', $local_memory = false)
    {
        $select_list = 'cache_id, cache_language_id, cache_name, cache_data, cache_global, cache_gzip, cache_method, cache_date, cache_expires';
        $global = ($name == 'GLOBAL' ? true : false); // was GLOBAL passed or is using the default?
        switch ($name) {
            case 'GLOBAL':
                $this->cache_query = $this->DB->Query("SELECT " . $select_list . " FROM cache WHERE cache_language_id=" . (int)$this->languages_id . " AND cache_global='1'");
                break;
            default:
                $this->cache_query = $this->DB->Query("SELECT " . $select_list . " FROM cache WHERE cache_id='" . md5($name) . "' AND cache_language_id=" . (int)$this->languages_id);
                break;
        } # end switch ($name)
        $num_rows = $this->DB->NumRows($this->cache_query);
        if ($num_rows) {
            $container = array();
            while ($cache = $this->DB->FetchArray($this->cache_query)) {
                $cache_name = $cache['cache_name'];
                if ($cache['cache_expires'] > date("Y-m-d H:i:s")) {
                    $cache_data = ($cache['cache_gzip'] == 1 ? gzinflate(base64_decode($cache['cache_data'])) : stripslashes($cache['cache_data']));
                    switch ($cache['cache_method']) {
                        case 'EVAL': // must be PHP code
                            eval("$cache_data");
                            break;
                        case 'ARRAY':
                            $cache_data = unserialize($cache_data);
                        case 'RETURN':
                        default:
                            break;
                    } # end switch ($cache['cache_method'])
                    if ($global) {
                        $container['GLOBAL'][$cache_name] = $cache_data;
                    } else {
                        $container[$cache_name] = $cache_data; // not global
                    }
                } else { // cache is expired
                    if ($global) {
                        $container['GLOBAL'][$cache_name] = false;
                    } else {
                        $container[$cache_name] = false;
                    }
                }# end if ( $cache['cache_expires'] > date("Y-m-d H:i:s") )
                if ($this->keep_in_memory || $local_memory) {
                    if ($global) {
                        $this->data['GLOBAL'][$cache_name] = $container['GLOBAL'][$cache_name];
                    } else {
                        $this->data[$cache_name] = $container[$cache_name];
                    }
                }
            } # end while ($cache = $this->DB->FetchArray($this->cache_query))
            unset($cache_data);
            $this->DB->Free($this->cache_query);
            switch (true) {
                case ($num_rows == 1):
                    if ($global) {
                        if ($container['GLOBAL'][$cache_name] == false || !isset($container['GLOBAL'][$cache_name])) {
                            return false;
                        } else {
                            return $container['GLOBAL'][$cache_name];
                        }
                    } else { // not global
                        if ($container[$cache_name] == false || !isset($container[$cache_name])) {
                            return false;
                        } else {
                            return $container[$cache_name];
                        }
                    } # end if ($global)
                case ($num_rows > 1):
                default:
                    return $container;
                    break;
            }# end switch (true)
        } else {
            return false;
        }# end if ( $num_rows )
    } # end function get_cache()

    /**
     * Function to get cache from memory
     * @author Bobby Easland
     * @version 1.0
     * @param string $name
     * @param string $method
     * @return mixed
     */
    function get_cache_memory($name, $method = 'RETURN')
    {
        $data = (isset($this->data['GLOBAL'][$name]) ? $this->data['GLOBAL'][$name] : $this->data[$name]);
        if (isset($data) && !empty($data) && $data != false) {
            switch ($method) {
                case 'EVAL': // data must be PHP
                    eval("$data");
                    return true;
                    break;
                case 'ARRAY':
                case 'RETURN':
                default:
                    return $data;
                    break;
            } # end switch ($method)
        } else {
            return false;
        } # end if (isset($data) && !empty($data) && $data != false)
    } # end function get_cache_memory()

    /**
     * Function to perform basic garbage collection for database cache system
     * @author Bobby Easland
     * @version 1.0
     */
    function cache_gc()
    {
        $this->DB->Query("DELETE FROM cache WHERE cache_expires <= '" . date("Y-m-d H:i:s") . "'");
    }

    /**
     * Function to convert time for cache methods
     * @author Bobby Easland
     * @version 1.0
     * @param string $expires
     * @return string
     */
    function convert_time($expires)
    {
 //expires date interval must be spelled out and NOT abbreviated !!
        $expires = explode('/', $expires);
        switch (strtolower($expires[1])) {
            case 'seconds':
                $expires = mktime(date("H"), date("i"), date("s") + (int)$expires[0], date("m"), date("d"), date("Y"));
                break;
            case 'minutes':
                $expires = mktime(date("H"), date("i") + (int)$expires[0], date("s"), date("m"), date("d"), date("Y"));
                break;
            case 'hours':
                $expires = mktime(date("H") + (int)$expires[0], date("i"), date("s"), date("m"), date("d"), date("Y"));
                break;
            case 'days':
                $expires = mktime(date("H"), date("i"), date("s"), date("m"), date("d") + (int)$expires[0], date("Y"));
                break;
            case 'months':
                $expires = mktime(date("H"), date("i"), date("s"), date("m") + (int)$expires[0], date("d"), date("Y"));
                break;
            case 'years':
                $expires = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y") + (int)$expires[0]);
                break;
            default: // if something fudged up then default to 1 month
                $expires = mktime(date("H"), date("i"), date("s"), date("m") + 1, date("d"), date("Y"));
                break;
        } # end switch( strtolower($expires[1]) )
        return date("Y-m-d H:i:s", $expires);
    } # end function convert_time()

    /**
     * Function to check if the cache is in the database and expired
     * @author Bobby Easland
     * @version 1.0
     * @param string $name
     * @param boolean $is_cached NOTE: passed by reference
     * @param boolean $is_expired NOTE: passed by reference
     */
    function is_cached($name, &$is_cached, &$is_expired)
    {
 // NOTE: $is_cached and $is_expired is passed by reference !!
        $this->cache_query = $this->DB->Query("SELECT cache_expires FROM cache WHERE cache_id='" . md5($name) . "' AND cache_language_id=" . (int)$this->languages_id . " LIMIT 1");
        $is_cached = ($this->DB->NumRows($this->cache_query) > 0 ? true : false);
        if ($is_cached) {
            $check = $this->DB->FetchArray($this->cache_query);
            $is_expired = ($check['cache_expires'] <= date("Y-m-d H:i:s") ? true : false);
            unset($check);
        }
        $this->DB->Free($this->cache_query);
    }# end function is_cached()

    /**
     * Function to initialize the redirect logic
     * @author Bobby Easland
     * @version 1.1
     */
    function check_redirect()
    {
        $this->need_redirect = false;
        $this->path_info = is_numeric(strpos(ltrim(getenv('PATH_INFO'), '/'), '/')) ? ltrim(getenv('PATH_INFO'), '/') : null;
        $this->uri = ltrim(basename($_SERVER['REQUEST_URI']), '/');
        $this->real_uri = ltrim(basename($_SERVER['SCRIPT_NAME']) . '?' . $_SERVER['QUERY_STRING'], '/');
        $this->uri_parsed = $this->not_null($this->path_info)
            ? parse_url(basename($_SERVER['SCRIPT_NAME']) . '?' . $this->parse_path($this->path_info))
            : parse_url(basename($_SERVER['REQUEST_URI']));
        $this->attributes['SEO_REDIRECT']['PATH_INFO'] = $this->path_info;
        $this->attributes['SEO_REDIRECT']['URI'] = $this->uri;
        $this->attributes['SEO_REDIRECT']['REAL_URI'] = $this->real_uri;
        $this->attributes['SEO_REDIRECT']['URI_PARSED'] = $this->uri_parsed;
        $this->need_redirect();
        $this->check_seo_page();
        if ($this->need_redirect && $this->is_seopage && $this->attributes['USE_SEO_REDIRECT'] == 'true') {
            $this->do_redirect();
        }
    } # end function

    /**
     * Function to check if the URL needs to be redirected
     * @author Bobby Easland
     * @version 1.2
     */
    function need_redirect()
    {
        foreach ($this->reg_anchors as $param => $value) {
            $pattern[] = $param;
        }
        switch (true) {
            case ($this->is_attribute_string($this->uri)):
                $this->need_redirect = false;
                break;
            case ($this->uri != $this->real_uri && !$this->not_null($this->path_info)):
                $this->need_redirect = false;
                break;
            case (is_numeric(strpos($this->uri, '.htm'))):
                $this->need_redirect = false;
                break;
            case (@preg_match("/(" . @implode('|', $pattern) . ")/i", $this->uri)):
                $this->need_redirect = true;
                break;
            case (@preg_match("/(" . @implode('|', $pattern) . ")/i", $this->path_info)):
                $this->need_redirect = true;
                break;
            default:
                break;
        } # end switch
        $this->attributes['SEO_REDIRECT']['NEED_REDIRECT'] = $this->need_redirect ? 'true' : 'false';
    } # end function set_seopage

    /**
     * Function to check if it's a valid redirect page
     * @author Bobby Easland
     * @version 1.1
     */
    function check_seo_page()
    {
        switch (true) {
            case (in_array($this->uri_parsed['path'], $this->attributes['SEO_PAGES'])):
                $this->is_seopage = true;
                break;
            case ($this->attributes['SEO_ENABLED'] == 'false'):
            default:
                $this->is_seopage = false;
                break;
        } # end switch
        $this->attributes['SEO_REDIRECT']['IS_SEOPAGE'] = $this->is_seopage ? 'true' : 'false';
    } # end function check_seo_page

    /**
     * Function to parse the path for old SEF URLs
     * @author Bobby Easland
     * @version 1.0
     * @param string $path_info
     * @return array
     */
    function parse_path($path_info)
    {
        $tmp = @explode('/', $path_info);
        if (sizeof($tmp) > 2) {
            $container = array();
            for ($i = 0, $n = sizeof($tmp); $i < $n; $i++) {
                $container[] = $tmp[$i] . '=' . $tmp[$i + 1];
                $i++;
            }
            return @implode('&', $container);
        } else {
            return @implode('=', $tmp);
        }
    } # end function parse_path

    /**
     * Function to perform redirect
     * @author Bobby Easland
     * @version 1.0
     */
    function do_redirect()
    {
        $p = @explode('&', $this->uri_parsed['query']);
        foreach ($p as $index => $value) {
            $tmp = @explode('=', $value);
            if (strtolower($tmp[0]) == 'cpath') {
                $tmp[0] = 'cPath'; // костиль для редіректів з неправильних cpath, Cpath, cpaTh...
            }
            switch ($tmp[0]) {
                case 'products_id':
                    if ($this->is_attribute_string($tmp[1])) {
                        $pieces = @explode('{', $tmp[1]);
                        $params[] = $tmp[0] . '=' . $pieces[0];
                    } else {
                        $params[] = $tmp[0] . '=' . $tmp[1];
                    }
                    break;
                default:
                    $params[] = $tmp[0] . '=' . $tmp[1];
                    break;
            }
        } # end foreach( $params as $var => $value )
        $params = (sizeof($params) > 1 ? implode('&', $params) : $params[0]);
        $url = $this->href_link($this->uri_parsed['path'], $params, 'NONSSL', false);
        switch (true) {
            case (defined('USE_SEO_REDIRECT_DEBUG') && USE_SEO_REDIRECT_DEBUG == 'true'):
                $this->attributes['SEO_REDIRECT']['REDIRECT_URL'] = $url;
                break;
            case ($this->attributes['USE_SEO_REDIRECT'] == 'true'):
                header("HTTP/1.0 301 Moved Permanently");
                header("Location: " . addHostnameToLink($url)); // redirect...bye bye
                break;
            default:
                $this->attributes['SEO_REDIRECT']['REDIRECT_URL'] = $url;
                break;
        } # end switch
    } # end function do_redirect
} # end class

# BC Redirects shouldn't have '&amp;'s in them
global $url;
$url = preg_replace('/&amp;/', '&', $url);
