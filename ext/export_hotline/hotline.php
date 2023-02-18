<?php

/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 29.01.2019
 * Time: 13:02
 */

$rootPath = dirname(dirname(dirname($_SERVER['SCRIPT_FILENAME'])));
require_once $rootPath . '/includes/application_top.php';

class HotlineMerchant
{

    const SHOP_NAME = STORE_NAME;
    const FIRM_ID = '123';
    const SHOP_LINK = HTTP_SERVER;
    const PRODUCT_IMAGE_PATH = HotlineMerchant::SHOP_LINK . "/getimage/products/";
    private $currencies;
    private $products = [];
    private $categories = [];
    private $productsRaw = [];
    private $categoriesRaw = [];
    private $categories_to_xml = [];
    private $catList = [0];
    private $salesmaker = [];
    private $rate = 0;
    private $doc;
    private $language_id = 1; //ru
    private $catTree = array();
    private $cPaths = array();
    private $catToNames = array();

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
            $this->currencies = $currencies;
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
        ,`pd`.`products_head_desc_tag`     as description
        ,`p`.`products_image`              as image
        ,`p`.`products_quantity`           as availability
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
            $this->productsRaw[] = $row;
        }
        $this->salesmaker = get_salemakers(tep_db_query($sql.$subQuery));
    }

    public function getProducts()
    {
        foreach ($this->productsRaw as $row) {
            $image_link = explode(';', $row['image']);
            $image_link = array_map(function ($img) {
                return HotlineMerchant::PRODUCT_IMAGE_PATH . $img;
            }, $image_link);
            $image = array_shift($image_link);
            $row['price'] = round($row['price'], 2);
            $product = [
                'id' => $row['id'],
                'code' => $row['code'],
                'name' => $row['name'],
                'categoryId' => $row['categoryId'],
                'description' => $row['description'],
                'url' => tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $row['id']),
                'image' => $image,
                'availability' => $row['availability'] > 0 ? 'В наличии' : 'Под заказ',
                // 'in stock','out of stock', 'preorder'
                'vendor' => $row['vendor'],
                'condition' => '0',
                // Где 0 - "новый",
                // 1 - "refurbished" (заводское восстановление, без признаков использования (Refurbished Grade A)),
                // 2 - "уцененный",
                // 3 -"бывший в употреблении (в том числе Refurbished Grade B, C)".
            ];
            $product['url'] = strstr($product['url'], HTTP_SERVER) ? $product['url'] : HTTP_SERVER . '/' . $product['url'];

            if (DEFAULT_CURRENCY === 'UAH') {
                if ($row['special_price']) {
                    $product['priceRUAH'] = $row['special_price'];
                    $product['oldprice'] = $row['price'];
                } else {
                    $product['priceRUAH'] = $row['price'];
                }
            } elseif (DEFAULT_CURRENCY === 'USD') {
                $product['priceRUSD'] = $row['price'];
                if ($this->currencies) {
                    $this->rate = $this->currencies->get_value('UAH');
                    if ($row['special_price']) {
                        $product['priceRUAH'] = round($row['special_price'] * $this->rate, 2);
                        $product['oldprice'] = round($row['price'] * $this->rate, 2);
                    } elseif (isset($this->salesmaker[$product['id']])) {
                        $product['priceRUAH'] =  round($this->salesmaker[$product['id']] * $this->rate, 2);
                        $product['oldprice'] = round($row['price'] * $this->rate, 2);
                    } else {
                        $product['priceRUAH'] = round($row['price'] * $this->rate, 2);
                    }
                }
            }

            $this->products[] = $product;
        }
    }

    public function build()
    {
        $this->doc = new DOMDocument('1.0', 'UTF-8');

        $xmlRoot = $this->doc->createElement("price");
        $xmlRoot = $this->doc->appendChild($xmlRoot);

        $xmlRoot->appendChild($this->doc->createElement('date', date('Y-m-d H:i')));
        $xmlRoot->appendChild($this->doc->createElement('firmName', HotlineMerchant::SHOP_NAME));
        $xmlRoot->appendChild($this->doc->createElement('firmId', HotlineMerchant::FIRM_ID));
        if ($this->rate) {
            $xmlRoot->appendChild($this->doc->createElement('rate', $this->rate));
        }
        $categoriesNode = $xmlRoot->appendChild($this->doc->createElement('categories'));
        $this->buildXMLData($categoriesNode, $this->categories, 'category');
        $itemsNode = $xmlRoot->appendChild($this->doc->createElement('items'));
        $this->buildXMLData($itemsNode, $this->products, 'item');


        $this->doc->formatOutput = true;
        header("Content-Type: text/xml");
        echo $this->doc->saveXML();
    }

    private function buildXMLData(&$node, $items, $name)
    {
        foreach ($items as $item) {
            $itemNode = $node->appendChild($this->doc->createElement($name));
            foreach ($item as $key => $value) {
                if (!empty($value)) {
                    if (is_array($item[$key])) {
                        foreach ($item[$key] as $key2 => $value2) {
                            $itemNode->appendChild($this->doc->createElement($key))->appendChild($this->doc->createTextNode($value2));
                        }
                    } else {
                        $itemNode->appendChild($this->doc->createElement($key))->appendChild($this->doc->createTextNode($value));
                    }
                } else {
                    $itemNode->appendChild($this->doc->createElement($key));
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

$merchant = new HotlineMerchant($currencies);
$merchant->setLanguage($languages_id);
$merchant->prepareCategoriesToXml();
$merchant->productsQuery();
$merchant->getProducts();
$merchant->categoriesQuery();
$merchant->getCategories();
$merchant->build();
