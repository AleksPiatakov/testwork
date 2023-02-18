<?php

interface XmlType
{
    public static function getQuery();

    public function getTopTagName();

    public function getTagName();

    public static function getEnabledCategories();
}

abstract class AbstractXmlType implements XmlType
{

    public function getTopTagName()
    {
        return $this::TOP_TAG_NAME;
    }

    public function getTagName()
    {
        return $this::TAG_NAME;
    }
    public static function getEnabledCategories()
    {
        global $cat_names;

        if($cat_names) {
            return implode(',', array_keys($cat_names));
        }
        return "0";
    }

}

class Categories extends AbstractXmlType
{


    const TOP_TAG_NAME = 'urlset';

    const TAG_NAME = 'url';

    public $format;

    public $query;

    public function __construct(XmlDataFormat $format)
    {
        $this->format = $format;
        $this->query = self::getQuery();
    }

    public static function getQuery()
    {
        global $cat_names;
        return "SELECT c.categories_id as id, c.last_modified, c.parent_id,c.sort_order, c.date_added
			       FROM " . TABLE_CATEGORIES . " c
                   WHERE c.categories_status = 1 and c.categories_id IN (" . self::getEnabledCategories() . ")
				   ORDER BY c.parent_id ASC, c.sort_order ASC, c.categories_id ASC";
    }
}

class Filters extends AbstractXmlType
{


    const TOP_TAG_NAME = 'urlset';

    const TAG_NAME = 'url';

    public $format;

    public $query;

    public function __construct(XmlDataFormat $format)
    {
        global $manufacturersUrl, $optionValuesUrls, $customSeoUrlList;
        $this->format = $format;
        $this->query = self::getQuery();
        $manufacturersUrl = getFilterSeoUrlsList();
        $optionValuesUrls = getOptionValuesSeoUrlsList();
        $customSeoUrlList = getCustomSeoUrlsList();
    }

    public static function getQuery()
    {
        return "SELECT `p2c`.`categories_id`, `m`.`manufacturers_id`, `pa`.`options_id`, `pa`.`options_values_id`
 FROM " . TABLE_PRODUCTS_ATTRIBUTES . " `pa` 
 INNER JOIN " . TABLE_PRODUCTS . " `p` ON `p`.`products_id` = `pa`.`products_id`
 INNER JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " `p2c` ON `p2c`.`products_id` = `p`.`products_id`
 INNER JOIN " . TABLE_CATEGORIES . " `c` ON `p2c`.`categories_id` = `c`.`categories_id`
 INNER JOIN " . TABLE_MANUFACTURERS . " `m` on `p`.`manufacturers_id` = `m`.`manufacturers_id` 
 WHERE `p`.`products_status` = 1 AND `p`.`manufacturers_id` != 0 AND `c`.`categories_status` = 1 
 GROUP BY `p2c`.`categories_id`, `manufacturers_id`, `pa`.`options_id`, `pa`.`options_values_id`";
    }
}

class CategoryBrand extends AbstractXmlType
{


    const TOP_TAG_NAME = 'urlset';

    const TAG_NAME = 'url';

    public $format;

    public $query;

    public function __construct(XmlDataFormat $format)
    {
        global $manufacturersUrl, $optionValuesUrls, $customSeoUrlList;
        $this->format = $format;
        $this->query = self::getQuery();
        $manufacturersUrl = getFilterSeoUrlsList();
        $optionValuesUrls = getOptionValuesSeoUrlsList();
        $customSeoUrlList = getCustomSeoUrlsList();
    }

    public static function getQuery()
    {
        return "SELECT `p2c`.`categories_id`, `m`.`manufacturers_id`
 FROM " . TABLE_PRODUCTS_ATTRIBUTES . " `pa` 
 INNER JOIN " . TABLE_PRODUCTS . " `p` ON `p`.`products_id` = `pa`.`products_id`
 INNER JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " `p2c` ON `p2c`.`products_id` = `p`.`products_id`
 INNER JOIN " . TABLE_CATEGORIES . " `c` ON `p2c`.`categories_id` = `c`.`categories_id`
 INNER JOIN " . TABLE_MANUFACTURERS . " `m` on `p`.`manufacturers_id` = `m`.`manufacturers_id` 
 WHERE `p`.`products_status` = 1 AND `p`.`manufacturers_id` != 0 AND `c`.`categories_status` = 1 
 GROUP BY `p2c`.`categories_id`, `manufacturers_id`";
    }
}

class SeoFilters extends AbstractXmlType
{


    const TOP_TAG_NAME = 'urlset';

    const TAG_NAME = 'url';

    public $format;

    public $query;

    private $lng;
    private $languageIds = [];

    public function __construct(XmlDataFormat $format)
    {
        $this->format = $format;
        $this->query = self::getQuery();
    }

    public static function getQuery()
    {
        return "SELECT sf.id,
                       sf.manufacturers_id, 
                       sf.categories_id, 
                       sf.filter_id_1, 
                       sf.filter_id_2                
			       FROM " . TABLE_SEO_FILTER . "  sf
				   ORDER BY sf.id ASC";
    }
}

class Manufacturers extends AbstractXmlType
{


    const TOP_TAG_NAME = 'urlset';

    const TAG_NAME = 'url';

    public $format;

    public $query;

    public function __construct(XmlDataFormat $format)
    {
        $this->format = $format;
        $this->query = self::getQuery();
    }

    public static function getQuery()
    {
        return "SELECT m.manufacturers_id as id, m.last_modified, m.date_added
                          FROM " . TABLE_MANUFACTURERS . " m
                          WHERE m.status = '1'";
    }
}

class Articles extends AbstractXmlType
{


    const TOP_TAG_NAME = 'urlset';

    const TAG_NAME = 'url';

//    const EXCLUDED_TOPICS = [15, 22];

    public $format;

    public $query;

    public function __construct(XmlDataFormat $format)
    {
        $this->format = $format;
        $this->query = self::getQuery();
    }

    public static function getExcludedTopics()
    {
        $excludedTopicsQuery = tep_db_query("
                                SELECT topics_id 
                                FROM " . TABLE_TOPICS . " 
                                WHERE show_in_sitemap = '0'
                                             ");
        $excludedTopics =  [0];
        while ($row = tep_db_fetch_array($excludedTopicsQuery)) {
            $excludedTopics[] = $row['topics_id'];
        }
        return $excludedTopics;
    }

    public static function getQuery()
    {
        $excludedTopics = implode(',', self::getExcludedTopics());
        return "SELECT DISTINCT a.articles_id as id, a.articles_last_modified as last_modified, a.articles_date_added as date_added
					      FROM " . TABLE_ARTICLES . " a
					      LEFT JOIN " . TABLE_ARTICLES_TO_TOPICS . " att  ON a.articles_id = att.articles_id
					      WHERE a.articles_status = '1'
					      and att.topics_id NOT IN ($excludedTopics)  and a.articles_link = ''
					      and a.articles_code not like '%banner%'
					      ORDER BY a.articles_last_modified DESC, 
					               a.articles_date_added DESC";
    }
}

class Images extends AbstractXmlType
{


    const TOP_TAG_NAME = 'urlset';

    const TAG_NAME = 'url';


    public $format;

    public $query;

    public function __construct(XmlDataFormat $format)
    {
        $this->format = $format;
        $this->query = self::getQuery();
    }

    public static function getQuery()
    {
        return "SELECT p.products_id as id,p.products_image as image, p.products_sort_order
			              FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_PRODUCTS_DESCRIPTION . " pd 
                          WHERE p.products_status='1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id 
                          and p2c.categories_id in(" . self::getEnabledCategories() . ") and p.products_image != '' and p.products_image is not null
                          GROUP BY p.products_id
				          ORDER BY p.products_sort_order ASC, p.products_id ASC";
    }
}

class Products extends AbstractXmlType
{


    const TOP_TAG_NAME = 'urlset';

    const TAG_NAME = 'url';

    public $format;

    public $query;

    public function __construct(XmlDataFormat $format)
    {
        $this->format = $format;
        $this->query = self::getQuery();
    }

    public static function getQuery()
    {
        return "SELECT DISTINCT p.products_id as id, p.products_ordered, p.products_last_modified as last_modified, p.products_date_added as date_added  
			              FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c , " . TABLE_PRODUCTS_DESCRIPTION . " pd 
				          WHERE p.products_status='1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id 
				          and p2c.categories_id in(" . self::getEnabledCategories() . ")
				          ORDER BY p.products_ordered DESC";
    }
}
//fixme переписать индекс, оставить один класс индекс который отдаёт массив в класс Sitemap
class Index extends AbstractXmlType
{

    const TOP_TAG_NAME = 'sitemapindex';

    const TAG_NAME = 'sitemap';

    static $typeToClass = [
        'products' => 'Products',
        'categories' => 'Categories',
        'articles' => 'Articles',
        'images' => 'Images',
        'manufacturers' => 'Manufacturers',
        //        'filters' => 'Filters',
        'seo_filters' => 'SeoFilters',
        //'categorybrand' => 'CategoryBrand',
    ];



    public $format;

    public $query;

    public function __construct(XmlDataFormat $format)
    {
        $this->format = $format;
    }


    public static function getQuery()
    {
        // TODO: Implement getQuery() method.
    }
}
