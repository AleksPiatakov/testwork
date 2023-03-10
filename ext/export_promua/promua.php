<?php

/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 29.01.2019
 * Time: 13:02
 */
$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
require_once $rootPath . '/includes/application_top.php';

class RozetkaMerchant
{

    const SHOP_NAME = STORE_NAME;
    const FIRM_ID = '123';
    const SHOP_LINK = HTTP_SERVER;
    const PRODUCT_IMAGE_PATH = RozetkaMerchant::SHOP_LINK . "/getimage/products/";
    private $currencies;
    private $currencies_array = [
        [
            'id' => 'UAH',
            'rate' => '1',
        ]
    ];
    private $salesmaker = [];
    private $products = [];
    private $categories = [];
    private $productsRaw = [];
    private $categoriesRaw = [];
    private $rate = 0;
    private $doc;
    private $catList = [0];
    private $catToNames = array();
    private $catTree = array();
    private $categories_to_xml = [];
    private $cPaths = array();
    private $language_id = 1; //ru

    private function catToNames()
    {
        $sql = "SELECT cd.categories_name, cd.categories_id FROM " . TABLE_CATEGORIES_DESCRIPTION . " cd WHERE cd.language_id = '{$this->language_id}'";
        $query = tep_db_query($sql);
        while ($category = tep_db_fetch_array($query)) {
            $this->catToNames[$category['categories_id']] = $category['categories_name'];
        }
    }

    public function __construct($currencies = false)
    {
        if ($currencies) {
            if (DEFAULT_CURRENCY === 'USD') {
                if ($currencies) {
                    $this->rate = $currencies->get_value('UAH');
                    $this->currencies_array[] = ['id' => 'USD','rate' => $this->rate];
                }
            }
        }
        $this->catToNames();
    }

    public function productsQuery()
    {
        $catList = implode(',', array_keys($this->categories_to_xml)); //active category
        $sql = "
        SELECT 
        `p`.`products_id`                  as id
        ,`p`.`products_id`                 as products_id
        ,`p`.`products_model`              as code
        ,`pd`.`products_name`              as name
        ,`p2c`.`categories_id`             as categoryId
        ,`pd`.`products_description`       as description
        ,`p`.`products_image`              as image
        ,`p`.`products_quantity`           as available
        ,`p`.`products_price`              as price
        ,`mi`.`manufacturers_name`         as vendor
        ,`s`.`specials_new_products_price` as special_price
        FROM `products` `p` 
        LEFT JOIN `products_description` `pd` ON `p`.`products_id` = `pd`.`products_id`  
        LEFT JOIN `specials` `s` ON `p`.`products_id` = `s`.`products_id`  
        LEFT JOIN `manufacturers_info` `mi` ON `p`.`manufacturers_id` = `mi`.`manufacturers_id` 
        LEFT JOIN `products_to_categories` `p2c` ON `p2c`.`products_id` = `p`.`products_id` 
        WHERE `p2c`.`categories_id` in ({$catList})
            AND `mi`.`languages_id` = {$this->language_id}
            AND `pd`.`language_id` = {$this->language_id}";

        $subQuery = '';
        if(getConstantValue('GOOGLE_FEED_CHOOSE_ALL_PRODUCTS','false') === 'true') {
            $subQuery .= " AND `p`.`products_status` = 1";
        }
        if(getConstantValue('GOOGLE_FEED_CHOOSE_PRODUCTS_2','false') === 'true'){
            $catList = implode(',', $this->catList); //category status XML
            $subQuery .= " AND `p`.`products_to_xml` = 1 AND `p2c`.`categories_id` in ({$catList})";
        }
        if (getConstantValue('GOOGLE_FEED_CHOOSE_PRODUCTS_3','false') === 'true'){
            $subQuery .= " AND `p`.`products_quantity` > 0";
        }
        $query = tep_db_query($sql.$subQuery);

        while ($row = tep_db_fetch_array($query)) {
            if(mb_strlen($row['description']) > 50000){
                $row['description'] = mb_substr($row['description'],0,49980).'...';
            }
            $this->productsRaw[$row['id']] = $row;
            $this->productsRaw[$row['id']]['param'] = $this->getAttributes($row['id']);
        }
        $this->salesmaker = get_salemakers(tep_db_query($sql.$subQuery));
    }

    private function getAttributes($id)
    {
        $query = tep_db_query("
                            SELECT po.products_options_name as name, GROUP_CONCAT(pov.products_options_values_name SEPARATOR ', ') as value
                            FROM `products_attributes` `pa`
                              left join products_options po on pa.options_id = po.products_options_id
                              left join products_options_values pov on pa.options_values_id = pov.products_options_values_id
                            WHERE `products_id` = $id and po.language_id = {$this->language_id} and pov.language_id = {$this->language_id}
                            group by po.products_options_name");
        $attr = [];
        while ($row = tep_db_fetch_array($query)) {
            $attr[] = $row;
        }
        return $attr;
    }

    public function getProducts()
    {
        foreach ($this->productsRaw as $row) {
            $image_link = explode(';', $row['image']);
            $image_link = array_map(function ($img) {
                return RozetkaMerchant::PRODUCT_IMAGE_PATH . $img;
            }, $image_link);
            $row['price'] = round($row['price'], 2);
            $product = [
                'id' => $row['id'],
                'code' => $row['code'],
                'name' => $row['name'],
                'currencyId' => DEFAULT_CURRENCY,
                'categoryId' => $row['categoryId'],
                'price' => $row['price'],
                'description' => $row['description'],
                'url' => tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $row['id']),
                'picture' => $image_link,
                'availability' => $row['available'] > 0 ? 'true' : 'false',
                // 'in stock','out of stock', 'preorder'
                'vendor' => $row['vendor'],
                'param' => $row['param'],
                'condition' => '0',
                // ?????? 0 - "??????????",
                // 1 - "refurbished" (?????????????????? ????????????????????????????, ?????? ?????????????????? ?????????????????????????? (Refurbished Grade A)),
                // 2 - "??????????????????",
                // 3 -"???????????? ?? ???????????????????????? (?? ?????? ?????????? Refurbished Grade B, C)".
            ];
            $product['url'] = strstr($product['url'], HTTP_SERVER) ? $product['url'] : HTTP_SERVER . '/' . $product['url'];

            if ($row['special_price']) {
                $product['oldprice'] = $row['price'];
                $product['price'] = $row['special_price'];
                $product['discount'] = ceil((1 - $row['special_price'] / $row['price']) * 100);
            } elseif (isset($this->salesmaker[$product['id']])) {
                $product['oldprice'] = $row['price'];
                $product['price'] = $this->salesmaker[$product['id']];
                $product['discount'] = ceil((1 - $this->salesmaker[$product['id']] / $row['price']) * 100);
            }

            $this->products[] = $product;
        }
    }

    public function build()
    {
        $this->doc = new DOMDocument('1.0', 'UTF-8');

        $implementation = new DOMImplementation();
        $this->doc->appendChild($implementation->createDocumentType('yml_catalog SYSTEM "shops.dtd"'));
        $xmlRoot = $this->doc->appendChild($this->doc->createElement("yml_catalog"));
        $xmlRoot->setAttribute('date', date('Y-d-m H:i'));
        $shopNode = $this->doc->createElement("shop");
        $xmlRoot->appendChild($shopNode);

        $shopNode->appendChild($this->doc->createElement('name', RozetkaMerchant::SHOP_NAME));
        $shopNode->appendChild($this->doc->createElement('company', RozetkaMerchant::SHOP_NAME));
        $shopNode->appendChild($this->doc->createElement('url', RozetkaMerchant::SHOP_LINK));
        $shopNode->appendChild($this->doc->createElement('platform', 'OSCommerce Solomono'));
        $currencyNode = $shopNode->appendChild($this->doc->createElement('currencies'));
        $this->buildXMLData($currencyNode, $this->currencies_array, 'currency', 'category');
        $categoriesNode = $shopNode->appendChild($this->doc->createElement('categories'));
        $this->buildXMLData($categoriesNode, $this->categories, 'category', 'category');
        $itemsNode = $shopNode->appendChild($this->doc->createElement('offers'));
        $this->buildXMLData($itemsNode, $this->products, 'offer');


        $this->doc->formatOutput = true;
        header("Content-Type: text/xml");
        echo $this->doc->saveXML();
    }

    private function buildXMLData(&$node, $items, $name, $type = 'offer')
    {
        foreach ($items as $item) {
            $itemNode = $node->appendChild($this->doc->createElement($name));

            foreach ($item as $key => $value) {
                if ($type === 'offer') {
                    if (!empty($value)) {
                        if (is_array($item[$key])) {
                            foreach ($item[$key] as $key2 => $value2) {
                                if (is_array($value2)) {
                                    $child = $itemNode->appendChild($this->doc->createElement($key));
                                    $child->setAttribute('name', $value2['name']);
                                    $child->appendChild($this->doc->createTextNode($value2['value']));
                                } else {
                                    $itemNode->appendChild($this->doc->createElement($key))->appendChild($this->doc->createTextNode($value2));
                                }
                            }
                        } else {
                            if (in_array($key, ['id','availability'])) {
                                $itemNode->setAttribute($key, $value);
                            } elseif ($key === 'description') {
                                $itemNode->appendChild($this->doc->createElement($key))->appendChild($this->doc->createCDATASection($value));
                            } else {
                                $itemNode->appendChild($this->doc->createElement($key))->appendChild($this->doc->createTextNode($value));
                            }
                        }
                    } else {
                        $itemNode->appendChild($this->doc->createElement($key));
                    }
                } elseif ($type === 'category') {
                    if ($key == 'name') {
                        $itemNode->appendChild($this->doc->createTextNode($value));
                    } else {
                        $itemNode->setAttribute($key, $value);
                    }
                }
            }
        }
    }
    public function categoriesQuery()
    {
        $query = tep_db_query("SELECT c.categories_id as id,c.parent_id as parentId,cd.categories_name as name
                  FROM categories c
                  LEFT JOIN categories_description cd ON c.categories_id = cd.categories_id
                  WHERE c.categories_status = 1 and cd.language_id = " . $this->language_id);
        while ($row = tep_db_fetch_array($query)) {
            $this->categoriesRaw[] = $row;
        }
    }

    public function getCategories()
    {
        foreach ($this->categoriesRaw as $category) {
            $item = [
                'id' => $category['id'],
                'name' => $category['name'],
            ];
            if ($category['parentId']) {
                $item['parentId'] = $category['parentId'];
            }
            $this->categories[] = $item;
        }
    }
    public function prepareCategoriesToXml()
    {
        $sql = "SELECT c.categories_to_xml, c.categories_id,c.parent_id ,
                  (select count(*) as cnt from categories cc where  cc.parent_id = `c`.`categories_id`) as childs FROM " . TABLE_CATEGORIES . " c WHERE c.categories_status = '1'";
        $query = tep_db_query($sql);
        $cat_tree = [];
        while ($row = tep_db_fetch_array($query)) {
            $this->categories_to_xml[$row['categories_id']] = (int)$row['categories_to_xml'];
            $cat_tree[$row['categories_id']] = [
                'id' => $row['categories_id'],
                'parent_id' => $row['parent_id'],
                'childs' => $row['childs'],
            ];
        }
        return $this->mapTree($cat_tree);
    }
    function mapTree($dataset, $exclude = '', $parent_cat = 0)
    {
        foreach ($dataset as $id => &$node) {
            $parent_id = $node['parent_id'];
            $childs = $node['childs'];
            
            unset($node['parent_id']);
            unset($node['id']);
            unset($node['childs']);
            if ($this->categories_to_xml[$id]) {
                if ($parent_id == $parent_cat && $id != $exclude) {
                    if ($childs) {
                        $this->catTree[$id] =& $node;
                    } else {
                        $this->catTree[$id] = $id;
                    }
                } elseif ($exclude && ($parent_id == $exclude || $id == $exclude)) {
                    continue;
                } elseif (isset($dataset[$parent_id])) {
                    if ($childs) {
                        $dataset[$parent_id][$id] =& $node;
                    } else {
                        $dataset[$parent_id][$id] = $id;
                    }
                }
            }
        }
        $this->cPaths = tep_get_cpath_global($this->catTree);
        $this->catToList($this->catTree);
    }
    
    function catToList($tree)
    {
        foreach ($tree as $k => $v) {
            $this->catList[] = $k;
            if (is_array($v)) {
                $this->catToList($v);
            }
        }
    }
    public function setLanguage($languages_id){
        $this->language_id = $languages_id;
    }
}

$merchant = new RozetkaMerchant($currencies);
$merchant->setLanguage($languages_id);
$merchant->prepareCategoriesToXml();
$merchant->productsQuery();
$merchant->getProducts();
$merchant->categoriesQuery();
$merchant->getCategories();
$merchant->build();
