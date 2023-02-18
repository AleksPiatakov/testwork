<?php

/**
 * Created by PhpStorm.
 * User: 'Serhii.M'
 * Date: 29.01.2019
 * Time: 13:02
 */

class GoogleMerchant
{

    const GOOGLE_MERCHANT_XML_NAMESPACE = 'http://base.google.com/ns/1.0';
    const NAMESPACE_MAP = 'g';
    const SHOP_NAME = STORE_NAME;
    const SHOP_LINK = HTTP_SERVER;
    public $products = [];
    public $product_image_path;
    public $currencies;
    public $currency_rate;
    public $currency;
    private $productsRaw = [];
    private $categories_to_xml = [];
    private $catList = [0];
    private $salesmaker = [];
    private $language_id = 1; //ru
    private $catTree = array();
    private $cPaths = array();
    private $catToNames = array();
    private $saleMakerDates = [];


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
        global $languages_id;
        $this->product_image_path = GoogleMerchant::SHOP_LINK . "/getimage/421x421/products/";
        $this->currency = isset($_GET['cur']) ? $_GET['cur'] : DEFAULT_CURRENCY;
        $this->language_id =  isset($languages_id) ? $languages_id : $this->language_id;
        $this->language_id =  isset($_GET['lang']) ? $_GET['lang'] : $this->language_id;
        $this->catToNames();

        if ($currencies) {
            if (!isset($currencies->currencies[$this->currency])) {
                echo 'Currency error';
                die;
            }
            $this->currency_rate = $currencies->currencies[$this->currency]['value'];
        }
    }

    private function makeAttributeName($attribute)
    {
        return GoogleMerchant::NAMESPACE_MAP . ':' . $attribute;
    }
    private function addNamespace($product)
    {
        return array_reduce(array_keys($product), function ($result, $item) use ($product) {
            $result[$this->makeAttributeName($item)] = $product[$item];
            return $result;
        }, array());
    }

    public function productsQuery()
    {
        $catList = implode(',', array_keys($this->categories_to_xml)); //active category
        $sql = "
        SELECT `p`.`products_id`,`p`.`products_model`,`pd`.`products_name`,`pd`.`products_description`,`pd`.`products_info`,`p`.`products_image`,`p`.`products_quantity`,`p`.`products_price`,
        `mi`.`manufacturers_name`, `m`.`manufacturers_id`, `s`.`specials_new_products_price`, `s`.`specials_date_added`, `s`.`expires_date`, `p2c`.`categories_id`
        FROM `products` `p`
        LEFT JOIN `products_to_categories` `p2c` ON `p`.`products_id` = `p2c`.`products_id`
        LEFT JOIN `products_description` `pd` ON `p`.`products_id` = `pd`.`products_id`
        LEFT JOIN `specials` `s` ON `p`.`products_id` = `s`.`products_id` and `s`.`status` = '1'
        LEFT JOIN `manufacturers` `m` ON `p`.`manufacturers_id` = `m`.`manufacturers_id`
        JOIN `manufacturers_info` mi on `m`.`manufacturers_id`=`mi`.`manufacturers_id`
        WHERE `p2c`.`categories_id` in ({$catList})
            AND `pd`.`language_id` = {$this->language_id}
            AND `mi`.`languages_id` = {$this->language_id}";
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

        //chars was got from includes\modules\cyrillic_conversion.php
        $regularRules = "/[^\.\=\/\<\>\&\[\]\#\$\^\;\+\*\%\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9А-Яа-яёЁЇїІіЄєҐґ\«\»\–\ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖŐØÙÚÛÜŰÝÞßàáâãäåæçèéêëìíîïðñòóôõöőøùúûüűýþÿΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩΆΈΊΌΎΉΏΪΫαβγδεζηθικλμνξοπρστυφχψωάέίόύήώςϊΰϋΐĘęĄąŚśŁłŻżŹźĆćŃń()]/u";
        while ($row = tep_db_fetch_array($query)) {
            $row['products_name'] = preg_replace($regularRules, '', $row['products_name']);
            $row['products_description'] = preg_replace($regularRules, '', $row['products_description']);
            $row['products_description'] = trim($row['products_description']) == '' ? $row['products_name'] : $row['products_description'];
            $row['products_description'] = strip_tags($row['products_description'], '<p><a><ul><li><font><strong><span><br>');
            if (strlen($row['products_description']) > 5000) {
                $row['products_description'] = mb_substr($row['products_description'], 0, 4997) . "...";
            }
            $this->productsRaw[] = $row;
        }
        $this->salesmaker = get_salemakers(tep_db_query($sql.$subQuery));
        $this->saleMakerDates = getSaleMakersDates();
    }
    private function formatPrice($price)
    {
        global $currencies;
        return number_format(tep_round($price * $currencies->currencies[$this->currency]['value'], $currencies->currencies[$this->currency]['decimal_places']), $currencies->currencies[$this->currency]['decimal_places'], $currencies->currencies[$this->currency]['decimal_point'], $currencies->currencies[$this->currency]['thousands_point']) . ' ' . $this->currency;
    }
    private function generateProductsType($cId)
    {
        $productsType = [GoogleMerchant::SHOP_NAME];
        foreach (explode('-', $this->cPaths[$cId]) as $catId) {
            $productsType[] = $this->catToNames[$catId];
        }
        return implode(' > ', $productsType);
    }
    public function getProducts()
    {
        foreach ($this->productsRaw as $row) {
            $image_link = explode(';', $row['products_image']);
            $image_link = array_slice($image_link, 0, 11); // google allows 10 images max
            $image_link = array_map(function ($img) {
                return $this->product_image_path . $img;
            }, $image_link);
            $image = array_shift($image_link);
            $description = !empty($row['products_description']) ? $row['products_description'] : $row['products_info'];
            $product = [
              'id' => $row['products_id'],
              'product_type' => htmlentities($this->generateProductsType($row['categories_id'])),
              'sku' => $row['products_model'],
              'title' => $row['products_name'],
              'description' => $description ?: $row['products_name'],
              'link' => tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $row['products_id']),
              'image_link' => $image,
              'availability' => $row['products_quantity'] > 0 ? 'in stock' : 'out of stock', // 'in stock','out of stock', 'preorder'
              'price' => $this->formatPrice($row['products_price']),
                //                'price' => $currencies->display_price($row['products_price'],0,1,1).' '.$this->currency,
              'brand' => $row['manufacturers_name'] ?: 'noname',
              'condition' => 'new',//new ,refurbished , used
            ];

            $product['link'] = strstr($product['link'], HTTP_SERVER) ? $product['link'] : HTTP_SERVER . '/' . $product['link'];
            if (isset($row['google_​​product_​​category'])) { //https://support.google.com/merchants/answer/6324436
                $product['google_​​product_​​category'] = $row['google_​​product_​​category'];
            }
            if (isset($row['gtin'])) {  //https://support.google.com/merchants/answer/6324461
                $product['gtin'] = $row['gtin']; //UPC,EAN,JAN,ISBN,ITF-14 etc
            }
            if (isset($row['MPN'])) {  //https://support.google.com/merchants/answer/6324482
                $product['MPN'] = $row['MPN'];
            }
            if (empty($row['gtin']) && $row['MPN']) {
                $product['identifier_exists'] = 'no';
            }
            if (!empty($image_link)) {
                $i = 0;
                foreach ($image_link as $image) {
                    if ($i >= 5) {
                        break;
                    }
                    $product['additional_image_link'][] = $image;
                    $i++;
                }
            }
            if ($row['specials_new_products_price']) {
                $product['sale_price'] = $this->formatPrice($row['specials_new_products_price']);
                $row['specials_date_added'] = empty($row['specials_date_added']) ? date("Y-m-d",time()) : $row['specials_date_added'];
                $sale_start = date('Y-m-d\TH:i:s',strtotime($row['specials_date_added']));
                $sale_end = (empty($row['expires_date']) || $row['expires_date']=='0000-00-00 00:00:00') ? strtotime('+1 month',time()) : strtotime($row['expires_date']);
                if($sale_end && $sale_end > 0) {
                    $sale_end = date('Y-m-d\TH:i:s',$sale_end);
                    $product['sale_price_effective_date'] =  $sale_start. "/" . $sale_end; //YYYY-MM-DD or YYYY-MM-DDThh:mm:ss or YYYY-MM-DDThh:mm:ssZ
                }
            } elseif (isset($this->salesmaker[$product['id']])) {
                $product['sale_price'] = $this->formatPrice($this->salesmaker[$product['id']]);
                $sale_start = (empty($this->saleMakerDates[$product['id']]['sale_date_start']) || $this->saleMakerDates[$product['id']]['sale_date_start'] === '0000-00-00') ? date('Y-m-d\TH:i:s') : date('Y-m-d\TH:i:s', strtotime($this->saleMakerDates[$product['id']]['sale_date_start']));
                $sale_end = (empty($this->saleMakerDates[$product['id']]['sale_date_end']) || $this->saleMakerDates[$product['id']]['sale_date_end'] === '0000-00-00') ? date('Y-m-d\TH:i:s', strtotime('+1 month',time())) : date('Y-m-d\TH:i:s', strtotime($this->saleMakerDates[$product['id']]['sale_date_end']));

                $product['sale_price_effective_date'] =  $sale_start. "/" . $sale_end; //YYYY-MM-DD or YYYY-MM-DDThh:mm:ss or YYYY-MM-DDThh:mm:ssZ
            }
            $this->products[] = $this->addNamespace($product);
        }
    }
    public function build()
    {
        $doc = new DOMDocument('1.0', 'UTF-8');

        $xmlRoot = $doc->createElement("rss");
        $xmlRoot = $doc->appendChild($xmlRoot);
        $xmlRoot->setAttribute('version', '2.0');
        $xmlRoot->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:g', GoogleMerchant::GOOGLE_MERCHANT_XML_NAMESPACE);

        $channelNode = $xmlRoot->appendChild($doc->createElement('channel'));
        $channelNode->appendChild($doc->createElement('title', GoogleMerchant::SHOP_NAME));
        $channelNode->appendChild($doc->createElement('link', GoogleMerchant::SHOP_LINK));

        foreach ($this->products as $product) {
            $itemNode = $channelNode->appendChild($doc->createElement('item'));
            foreach ($product as $key => $value) {
                if (!empty($value)) {
                    if (is_array($product[$key])) {
                        foreach ($product[$key] as $key2 => $value2) {
                            $itemNode->appendChild($doc->createElement($key))->appendChild($doc->createTextNode($value2));
                        }
                    } else {
                        $itemNode->appendChild($doc->createElement($key))->appendChild($doc->createTextNode($value));
                    }
                } else {
                    $itemNode->appendChild($doc->createElement($key));
                }
            }
        }


        $doc->formatOutput = true;
        header("Content-Type: text/xml");
        echo $doc->saveXML();
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
}
$merchant = new GoogleMerchant($currencies);
$merchant->prepareCategoriesToXml();
$merchant->productsQuery();
$merchant->getProducts();
$merchant->build();
